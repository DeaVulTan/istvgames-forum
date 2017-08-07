<?php

/*
+--------------------------------------------------------------------------
|   [HSC] Recent Posts (Sidebar Block) 1.0.0.0
|   =============================================
|   by Esther Eisner
|   Copyright 2011 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class boardIndexRecentPosts
{
    protected $version;
    protected $parser;
    
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
        $this->DB = $this->registry->DB();
        $this->settings =& $this->registry->fetchSettings();
        $this->memberData =& $this->registry->member()->fetchMemberData();
        
        $this->version = IPSLib::fetchVersionNumber();
        if($this->version['long'] >= 34000)
        {
            require_once(IPS_ROOT_PATH . 'sources/classes/text/parser.php');
            $this->parser = new classes_text_parser();
            
            $this->parser->set(array('parseArea' => 'topics',
                            'memberData' => $this->memberData,
                            'parseBBCode' => 1,
                            'parseHtml' => 0,
                            'parseEmoticons' => true));
        }
    }
    
    public function getOutput()
    {
        if($this->settings['hsc_rp_groups'] && !IPSMember::isInGroup($this->memberData, explode(",", $this->settings['hsc_rp_groups'])))
        {
            return;
        }
            
        $topics = $this->_getTopics();
        if(!is_array($topics) || !count($topics))
            return '';            
        
        foreach($topics as $id => $t)
        {
            if($this->settings['hsc_rp_post']!='N')
            {
                if($this->version['long'] < 34000)
                {
                    $topics[$id]['post'] = $this->_formatPost($t['post']);
                }
                else
                {
                    $topics[$id]['post'] = $this->_formatPost34($t['post']);
                }
            }
        }
        
        return $this->registry->output->getTemplate('boards')->recentPosts($topics);
    }
    
    private function _getTopics()
    {
        $forumIds = $this->_loadForumIds();
        if(!is_array($forumIds) || !count($forumIds))
            return '';
            
        // figure out the list of fields we need to retrieve
        $select = 't.tid, t.forum_id, t.title, t.title_seo';
        if($this->settings['hsc_rp_start'])
        {
            $select .= ', t.starter_name, t.starter_id, t.seo_first_name, t.start_date';
            $joins[] = array('select' => 'sm.member_group_id as starter_group_id', 
                                         'from' => array('members' => 'sm'), 
                                         'where' => 't.starter_id=sm.member_id', 
                                         'type' => 'left');
        }
            
        if($this->settings['hsc_rp_views'])
            $select .= ', t.views, t.posts';
        if($this->settings['hsc_rp_last'])
        {
            $select .= ', t.last_poster_name, t.last_poster_id, t.seo_last_name, t.last_post';
            $joins[] = array('select' => 'lm.member_group_id as last_group_id', 
                                         'from' => array('members' => 'lm'), 
                                         'where' => 't.last_poster_id=lm.member_id', 
                                         'type' => 'left');
        }
        
        // basic query    
        $query = array('select' => $select,
                        'from' => array('topics' => 't'),
                        'where' => "t.state='open' and t.approved=1 and t.forum_id in (".implode(",",$forumIds).")",
                        'order' => 't.last_post desc',
                        'limit' => array(0,$this->settings['hsc_rp_limit']));
                        
        if(is_array($joins) && count($joins))
            $query['add_join'] = $joins;
        
        // are we showing forum info? Add the forum query
        if($this->settings['hsc_rp_showforum'])
        {                
            $query['add_join'][] = array('select' => 'f.name as forum_name, f.name_seo as forum_name_seo', 
                                        'from' => array('forums' => 'f'), 
                                        'where' => 't.forum_id=f.id', 
                                        'type' => 'left');
        }
                        
        // are we showing the first post? Join to the posts table
        if ($this->settings['hsc_rp_post'] == 'F')
        {
            $query['add_join'][] = array('select' => 'p.pid, p.post',
                                        'from' => array('posts' => 'p'),
                                        'where' => 't.topic_firstpost=p.pid',
                                        'type' => 'left');
        }
        
        // Go for it
        $this->DB->build($query);
        $tQuery = $this->DB->execute();
        while($t = $this->DB->fetch($tQuery))
        {
            // Showing the last post? Get the last post info for each topic
            if($this->settings['hsc_rp_post']=='L')
            {
                $post = $this->DB->buildAndFetch(array('select' => 'pid,post', 'from' => 'posts', 'where' => 'queued=0 and pdelete_time=0 and topic_id='.$t['tid'],
                                'order' => 'post_date desc', 'limit' => array(0,1)));
                $t = array_merge($t,$post);
            }
            
            $topics[] = $t;
        }
            
        return $topics;
    }
    
    private function _formatPost($post)
    {
        // Strip out line breaks or the regex does not work
        $post = preg_replace('/[\n\r]/i','',$post);
        
        // Strip out quotes
        $post = preg_replace('/\[quote(.*?)\[\/quote\]/i','',$post);
        
        // Strip out emoticon images
        $post = preg_replace('/<img(.*?)\/>/i','',$post);
        
        // Strip out other images
        $post = preg_replace('/\[img(.*?)\[\/img\]/i','',$post);
        
        // parse for display
        $post = $this->_parseBBCode($post);
        
        // strip out all HTML
        $post = strip_tags($post);
        
        // Cut post?
        if($this->settings['hsc_rp_postlimit'] && strlen($post) > $this->settings['hsc_rp_postlimit'])
        {
            $post = IPSText::truncate($post, $this->settings['hsc_rp_postlimit']);
            if(substr($post, strlen($post) - 3) != '...')
            {
                $post .= '...';
            }
        }
        
        return $post;
    }
    
    private function _formatPost34($post)
    {
        // strip attachments
        $post = IPSText::stripAttachTag($post);
        
        // parse for display
        $post = $this->parser->display($post);
        
        // Strip out line breaks or the regex does not work
        $post = preg_replace('/[\n\r]/i','',$post);
        
        // Strip out quotes
        $post = preg_replace('/<blockquote(.+?)<\/blockquote>/i', '', $post);
        
        // Strip out images
        $post = preg_replace('/<img(.*?)\/>/i','',$post);
        
        // Strip all HTML tags
        $post = strip_tags($post);
        
        // Cut post?
        if($this->settings['hsc_rp_postlimit'] && strlen($post) > $this->settings['hsc_rp_postlimit'])
        {
            $post = IPSText::truncate($post, $this->settings['hsc_rp_postlimit']);
            if(substr($post, strlen($post) - 3) != '...')
            {
                $post .= '...';
            }
        }
        
        return $post;
    }
    
    private function _parseBBCode($post)
    {
        IPSText::stripAttachTag($post);
        
        IPSText::getTextClass( 'bbcode' )->parse_smilies			= 1;
        IPSText::getTextClass( 'bbcode' )->parse_html				= 1;
		IPSText::getTextClass( 'bbcode' )->parse_nl2br				= 1;
		IPSText::getTextClass( 'bbcode' )->parse_bbcode				= 1;
		IPSText::getTextClass( 'bbcode' )->parsing_section			= 'topics';
		IPSText::getTextClass( 'bbcode' )->parsing_mgroup			= $this->memberdata['member_group_id'];
		IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others	= $this->memberData['mgroup_others'];
		        
		return IPSText::getTextClass('bbcode')->preDisplayParse( $post );
    }
    
    private function _loadForumIds()
    {
        $forums = $this->registry->getClass('class_forums')->fetchSearchableForumIds();
        
        if(!$this->settings['hsc_rp_forums'])
            return $forums;
        
        if($this->settings['hsc_rp_exclude'])
        {
            return array_diff($forums, explode(",",$this->settings['hsc_rp_forums']));
        }
        else
        {
            return array_intersect($forums, explode(",",$this->settings['hsc_rp_forums']));
        }
    }
}