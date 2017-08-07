<?php

/**
 * The library
 *
 * @copyright   Copyright (C) 2013, Stuart Silvester
 * @author      Stuart Silvester
 * @package     Trader Feedback
 * @version     1.4.1
 */

class feedbackLib
{
	function __construct()
	{
		$this->registry	=	ipsRegistry::instance();
		$this->request	=&	$this->registry->fetchRequest();
		$this->settings	=&	$this->registry->fetchSettings();
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->DB		=	$this->registry->DB();

		/* Load the main langs */
		$this->registry->class_localization->loadLanguageFile( array( 'public_global' ), 'feedback' );

		/* Badges for the 'icons' */
		$this->badges	= array(	0 => array(	'colour'	=>	'red',
												'symbol'	=>	$this->lang->words['fb_symbol_neg']),
									1 => array(	'colour'	=>	'lightgrey',
												'symbol'	=>	$this->lang->words['fb_symbol_neu']),
									2 => array(	'colour'	=>	'green',
												'symbol'	=>	$this->lang->words['fb_symbol_pos']));
	}

	/**
	 * Get permissions, if not loaded load them
	 *
	 * @return	array		IPS Permission array
	 */
	public function getPermissions()
	{
		if(isset($this->_permissions) && is_array($this->_permissions))
        {
            return $this->_permissions;
        }

		return $this->_loadPermissions();
	}

	public function recountMembersScore($id)
	{
		/* Working out the currently pointless feedback score */
		$pos	= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
													'from'	=> array('feedback' => 'f'),
													'where'	=> 'receiver='.$id.' AND score=2' ) );

		$neu	= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
													'from'	=> array('feedback' => 'f'),
													'where' => 'receiver='.$id.' AND score=1' ) );

		$neg	= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
													'from'	=> array('feedback' => 'f'),
													'where' => 'receiver='.$id.' AND score=0' ) );

		if($pos['cnt'] || $neg['cnt'] || $neu['cnt'])
		{
			if($pos['cnt'] == 0 && $neg['cnt'] == 0)
			{
				$percent = 0;
			}
			else
			{
				$percent = round((100 / ($pos['cnt'] + $neg['cnt'] + $neu['cnt'])) * $pos['cnt'], 0);
			}
		}
		else
		{
			$percent = -1;
		}

		$this->DB->update(	'members',
							array(	'feedb_percent'	=> $percent,
									'feedb_pos'		=> $pos['cnt'],
									'feedb_neu'		=> $neu['cnt'],
									'feedb_neg'		=> $neg['cnt']),
							"member_id = ".$id );
	}

	/**
	 * Takes an input url and extracts the topic id
	 *
	 * @access	public
	 * @return	integer		Topic id
	 */
	public function getTopicIdFromUrl()
	{
	    $tmp = strtr($this->request['topic_url'], array(
	        'http://' => '', 'https://' => '', 'www.' => ''
	    ));

	    if (strpos($tmp, str_replace('www.', '', $_SERVER['SERVER_NAME'])) === 0) {
	        return $this->request['topic_url'];
	    }
	    
	    return false;
	
		/* Try to intval the url */
		if( ! intval( $this->request['topic_url'] ) )
		{
			$templates	= IPSLib::buildFurlTemplates();

			/* Friendly URL */
			if( $this->settings['use_friendly_urls'] && !stristr($this->request['topic_url'], 'showtopic='))
			{
				/* remove base url from url */
				$this->request['topic_url'] = str_replace( $this->settings['_original_base_url'], '', $this->request['topic_url'] );
				$this->request['topic_url'] = str_replace( array( '/index.php/', '/index.php?/' ), '/', $this->request['topic_url'] );

				preg_match( $templates['showtopic']['in']['regex'], $this->request['topic_url'], $match );
				$oldId = intval( trim( $match[1] ) );
			}
			/* Normal URL */
			else
			{
				preg_match( $templates['showtopic']['out'][0], $this->request['topic_url'], $match );
				$oldId = intval( trim( $match[1] ) );
			}
		}
		else
		{
			$oldId = intval($this->request['topic_url']);
		}

		return $oldId;
	}

	/**
	 * Takes an input url and extracts the classifieds item id
	 *
	 * @access	public
	 * @return	integer		Item id
	 */
	public function getClassifiedsIdFromUrl()
	{
	    return $this->request['topic_url'];
	
		/* Try to intval the url */
		if( ! intval( $this->request['topic_url'] ) )
		{
			$templates	= IPSLib::buildFurlTemplates();

			/* Friendly URL */
			if( $this->settings['use_friendly_urls'] && !stristr($this->request['topic_url'], 'app=classifieds'))
			{
				/* remove base url from url */
				$this->request['topic_url'] = str_replace( $this->settings['_original_base_url'], '', $this->request['topic_url'] );
				$this->request['topic_url'] = str_replace( array( '/index.php/', '/index.php?/' ), '/', $this->request['topic_url'] );

				preg_match( $templates['view_item']['in']['regex'], $this->request['topic_url'], $match );
				$oldId = intval( trim( $match[1] ) );
			}
			/* Normal URL */
			else
			{
				preg_match( $templates['view_item']['out'][0], $this->request['topic_url'], $match );
				$oldId = intval( trim( $match[1] ) );
			}
		}
		else
		{
			$oldId = intval($this->request['topic_url']);
		}

		return $oldId;
	}

    /**
     * Load permissions for the application from the database
     *
     * @return  array   IPS Permission Array
     */
    private function _loadPermissions()
    {
		$this->_permissions = $this->DB->buildAndFetch(array(		'select' => 'p.*',
																'from'   => array( 'permission_index' => 'p' ),
																'where'  => "p.perm_type='feedback' AND perm_type_id=1"));

        return $this->_permissions;
    }
}
?>
