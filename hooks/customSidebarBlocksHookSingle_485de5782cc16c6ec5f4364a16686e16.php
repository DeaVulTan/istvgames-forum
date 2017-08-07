<?php

class customSidebarBlocksHookSingle
{
    public $registry;
    
    public function __construct()
    {
        $this->registry     =  ipsRegistry::instance();
        $this->DB           =  $this->registry->DB();
        $this->settings     =& $this->registry->fetchSettings();
        $this->request      =& $this->registry->fetchRequest();
        $this->lang         =  $this->registry->getClass('class_localization');
        $this->member       =  $this->registry->member();
        $this->memberData     =& $this->registry->member()->fetchMemberData();
        $this->cache        =  $this->registry->cache();
        $this->caches       =& $this->registry->cache()->fetchCaches(); 
 
        IPSText::getTextClass('bbcode')->parse_html			= 1;
		IPSText::getTextClass('bbcode')->parse_nl2br		= 1;
		IPSText::getTextClass('bbcode')->parse_smilies  	= 1;
		IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
		IPSText::getTextClass('bbcode')->parsing_section	= 'global';
    }
    
	public function getOutput()
	{
		$blocks = "";
		if ( $this->settings['e_CSB_on'] )
		{
			#grab blocks from cache
			if ( !is_array( $this->caches['custom_sidebar_blocks'] ) )
			{
				$this->cache->rebuildCache('custom_sidebar_blocks','customSidebarBlocks');
			}

			foreach ( $this->caches['custom_sidebar_blocks'] AS $block )
			{
				if ( $block['csb_id'] != 9999)
				{
					continue;		
				}			
				if ( !$block['csb_on'] )
				{
					continue;		
				}			
				if ( $block['csb_use_perms'] && !$this->registry->permissions->check( 'view', $block ) )
				{
					continue;		
				}

				#format content
				#eval PHP (added in 1.5.2+)
				if (!$block['csb_raw'])
				{
					$block['csb_content'] = (!$block['csb_php']) ? IPSText::getTextClass('bbcode')->preDisplayParse( $block['csb_content'] ) : eval($block['csb_content']);				
				}

				#add block
				$blocks .= $this->registry->getClass('output')->getTemplate('boards')->customSidebarBlock( $block );
			}

			#output!
			return $blocks;
		}
	}
}?>