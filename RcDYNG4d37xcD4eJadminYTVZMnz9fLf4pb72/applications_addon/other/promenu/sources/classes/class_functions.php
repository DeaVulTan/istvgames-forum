<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			class_functions.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

if ( !defined('IN_ACP') )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
} 

class class_functions
{
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	public $menu_cache;
	function __construct( ipsRegistry $registry )
	{
		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->cache    = $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();
		$this->lang     = $this->registry->getClass('class_localization');
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}
	public function parseIt($content,$type)
	{
	
		if ( IPS_IS_UPGRADER !== TRUE && IPS_IS_INSTALLER !== TRUE )
		{	
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' ); 
		$this->editor = new $classToLoad(); 
		$this->editor->setAllowHtml("1");
		}
		if($type == "display")
		{
			IPSText::getTextClass('bbcode')->parsing_section	    = 'Block Content';
			IPSText::getTextClass('bbcode')->parse_smilies = TRUE;
			IPSText::getTextClass('bbcode')->parse_bbcode = TRUE;
			IPSText::getTextClass('bbcode')->parse_html = TRUE;
			IPSText::getTextClass('bbcode')->parse_nl2br = TRUE;
			
			IPSText::getTextClass('bbcode')->bypass_badwords = FALSE;
			IPSText::getTextClass( 'bbcode' )->parsing_mgroup = $this->memberData['member_group_id'];
			IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others = $this->memberData['mgroup_others'];
				
			$content = IPSText::getTextClass('bbcode')->preDisplayParse($content);
				
			//$content = IPSText::getTextClass('bbcode')->preDisplayParse($content);
				
			return $content;
		}
		elseif($type == "db")
		{
			$content = $this->editor->process(trim($content));
			
			IPSText::getTextClass('bbcode')->parsing_section	    = 'Block Content';
			IPSText::getTextClass('bbcode')->parse_smilies = TRUE;
			IPSText::getTextClass('bbcode')->parse_bbcode = TRUE;
			IPSText::getTextClass('bbcode')->parse_html = FALSE;
			IPSText::getTextClass('bbcode')->parse_nl2br = TRUE;
			
			IPSText::getTextClass('bbcode')->bypass_badwords = FALSE;
			IPSText::getTextClass( 'bbcode' )->parsing_mgroup = $this->memberData['member_group_id'];
			IPSText::getTextClass( 'bbcode' )->parsing_mgroup_others = $this->memberData['mgroup_others'];

			$content = IPSText::getTextClass('bbcode')->preDbParse(trim($content));
			
			
			return $content;
		}
		elseif($type == "edit")
		{
	
			$content = IPSText::getTextClass('bbcode')->convertForRTE($content);
				
			return $content;
		}
	}	
	public function parseMenuURL($menudata)
	{
		$return = array();
			
		foreach($menudata as $key => $menuItem)
		{
			if ( $menuItem['promenu_url'] )
			{
				$menuItem['promenu_url'] = $menuItem['promenu_url'];
			}		
			else if(($menuItem['promenu_is_cat']==1 AND !$menuItem['promenu_url']) OR ($this->settings['behavior'] != 0 AND $menuitem['has_subs'] == 1))
			{
				/* 
				 * The onclick event doesn't require a full encapsulation 
				 * because the template bit is handling the suffixed quote
				*/ 
				$menuItem['promenu_url'] = '#-'.$menuItem['promenu_id'].'" onclick="return false;';
			}
			else
			{
				if( $menuItem['promenu_use_app'] == 'ccs' ) 
				{
					if(IPSLib::appIsInstalled('ccs'))
					{
						/*Load up ccsFunctions if not loaded already*/
						if( !$this->registry->isClassLoaded( 'ccsFunctions' ) )
						{
						$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir('ccs') . '/sources/functions.php', 'ccsFunctions', 'ccs' );
						$this->registry->setClass( 'ccsFunctions', new $classToLoad( $this->registry ) );
						}

						$menuItem['promenu_url'] = $this->registry->ccsFunctions->returnPageUrl( array( 'page_seo_name' => $menuItem['promenu_app_page_seo'], 'page_folder' => $menuItem['promenu_app_page_folder'], 'page_id' => $menuItem['promenu_app_page'] ) );
					}
				}
				else if ( $menuItem['promenu_use_app'] == 'core' )
				{
					
						$menuItem['promenu_url'] = $this->registry->output->buildSEOUrl("app={$menuItem['promenu_use_app']}&module=help", 'public', $menuItem['promenu_use_app'], 'core', '', '' );
					
				}

				else if(!in_array($menuItem['promenu_use_app'], array('ccs', 'core')))
				{
					$menuItem['promenu_url'] = $this->registry->output->buildSEOUrl("app={$menuItem['promenu_use_app']}", 'public', $menuItem['promenu_use_app'], "app={$menuItem['promenu_use_app']}", '', '' );	
				}
			}
			
			if($menuItem['has_subs']==1)
			{
				$menuItem[$menuItem['promenu_parent_id']] = $this->parseMenuURL($menuItem[$menuItem['promenu_parent_id']]);
			}
			
			$return[$menuItem['promenu_id']] = $menuItem;
		}

	return $return;
	}	

	public function parseMenuActive($menudata)
	{
		$return = array();
			
		foreach($menudata as $key => $menuItem)
		{
			$menuItem['_active'] = 0;
	
			if( $menuItem['promenu_use_app'] == 'ccs' && ($this->request['app']=='ccs' || IPS_DEFAULT_PUBLIC_APP == 'ccs')) 
			{
				if(IPSLib::appIsInstalled('ccs'))
				{
					/*Load up ccsFunctions if not loaded already*/
					if( !$this->registry->isClassLoaded( 'ccsFunctions' ) )
					{
					$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir('ccs') . '/sources/functions.php', 'ccsFunctions', 'ccs' );
					$this->registry->setClass( 'ccsFunctions', new $classToLoad( $this->registry ) );
					}

					 //Active?... ugh, revisited
					if($this->registry->ccsFunctions->getPageName()==$menuItem['promenu_app_page_seo'] && $this->registry->ccsFunctions->getFolder()== $menuItem['promenu_app_page_folder'])
					{
						$menuItem['_active'] = 1;
					}
					
					
					if(!$this->registry->getClass('ccsFunctions')->getPageName() || $this->registry->getClass('ccsFunctions')->getPageName() == '')
					{
						if($this->request['module']=='pages' && $this->request['id'] == $menuItem['promenu_app_page'])
						{
							$menuItem['_active'] = 1;
						}
						if(!$menuItem['promenu_app_page_folder'] && $menuItem['promenu_app_page_seo'] == $this->settings['ccs_default_page'] && !$this->request['id']) 
						{ 
							$menuItem['_active'] = 1; 
						}
					}
							   
				}
			}
			if ( $menuItem['promenu_use_app'] == 'core' && $this->request['module']=='help')
			{
				$menuItem['_active'] = 1;
			}

			if( $menuItem['promenu_use_app'] == $this->registry->getCurrentApplication() && !in_array($menuItem['promenu_use_app'], array( 'ccs', 'core' ) ) )
			{
				$menuItem['_active'] = 1;
			}

			if(!$menuItem['link_to_app'])
			{
				$menuItem['_active'] = 0;
			}
			
			if($menuItem['has_subs']==1)
			{
				$menuItem[$menuItem['promenu_parent_id']] = $this->parseMenuActive($menuItem[$menuItem['promenu_parent_id']]);
				
				if($this->settings['promenu_recursive']==1 && $menuItem['_active']!=1)
				{
				//that got all the individual actives... now a quick check to make parents active
				$menuItem['_active'] = $this->_parseMenuActiveLookUP($menuItem, $menuItem['promenu_parent_id']);
				
				}
			}
			
			if($menuItem['promenu_disable_active']==1)
			{
				$menuItem['_active'] = 0;
			}
			
		$return[$menuItem['promenu_id']] = $menuItem;
		
		}

	return $return;
	}	

	//helper internal look-up active while we look-down above function
	protected function _parseMenuActiveLookUP($menudata, $id)
	{		
		if ( is_array( $menudata[$id] ) && count( $menudata[$id]) > 0 )
		{
			$menus = array();

			foreach($menudata[$id] as $key => $menu)
			{
				if ( $menu['_active']==1 && $menu['promenu_disable_active']==0)
				{		
						$menus[] = $menu;
				}	
			}
			if(count($menus))
			{
				return TRUE;
			}
		}
	return FALSE;
	}

	//dunno wth this is doing here.	
	public function GetTheDamnKids($menudata,$parent)
	{
	$return = array();	
		foreach($menudata as $key => $menu)
		{
			if($menu['promenu_parent_id'] == $parent['promenu_id'] || $menu['promenu_parent_id'] == $parent)
			{
			$menu['is_sub'] = 1;
			$menu['has_subs'] = $this->CheckChildrenTree($menudata, $menu['promenu_id']);
			if($menu['has_subs']==1)
			{
			$menu[$menu['promenu_parent_id']] = $this->GetTheDamnKids($menudata, $menu);
			}
			$return[$menu['promenu_id']] = $menu;

			}
			
		}
		
	return $return;
	}

	public function CheckChildrenTree($menu,$current)
	{
		$has_subs = 0;
		$parent[] = $current;
		foreach($menu as $key => $item)
		{
			if (in_array($item['promenu_parent_id'],$parent))
			{
				$parent[] = $item['promenu_id'];
				$has_subs = 1;
			}
		}
		return $has_subs;
	}

	/********************** Global query for both sides ************************************/
    public function get_menus($group="primary_menus")  
	{  
		if(!is_array( $this->caches['promenu'] ))  
		{  
			$this->caches['promenu'] =    $this->cache->getCache('promenu');         
		}  
		$menus_cache = $this->caches['promenu'][$group];              
		return $menus_cache;  
	}
	
/********************** End global query ************************************/
	
	
	public function recacheMenus( $rebuild='', $updateCaches=true )  
	{

          /* Setup vars */  
          $cache[] = array();  
       
          if(IPSLib::appIsInstalled('ccs'))  
          {  
          $addjoin = array(  
          array(  
                    'select'     => 'p.perm_view',  
                    'from'          => array( 'permission_index'     => 'p' ),  
                    'where'          => "p.perm_type = 'menu' AND p.app = 'promenu' AND p.perm_type_id = promenu_id",  
                    'type'          => 'left'  
                                   ),  
                                   array(  
                    'select'     => 'pa.page_seo_name, pa.page_folder',  
                    'from'          => array( 'ccs_pages'     => 'pa' ),  
                    'where'          => "m.promenu_app_page=pa.page_id",  
                    'type'          => 'left'  
                                   )  
                                   );  
                                     
                                
          }  
          else  
          {  
          $addjoin = array(   
          array(  
                    'select'     => 'p.perm_view',  
                    'from'          => array( 'permission_index'     => 'p' ),  
                    'where'          => "p.perm_type = 'menu' AND p.app = 'promenu' AND p.perm_type_id = m.promenu_id",  
                    'type'          => 'left'  
                                   )  
                                   );  
                           
          }  
          $this->DB->build( array(   
               'select'     => 'm.*',  
               'from'          => array( 'promenu' => 'm' ),  
               'order'          => 'm.promenu_displayorder ASC',  
               'add_join'     => $addjoin 
                         )  
                    );  
                      
          $q = $this->DB->execute();  
  
          $menu_list     = array();  
  
          while( $menu_item = $this->DB->fetch( $q ) )  
          {  
               //standard me!!  
          $menu_item['promenu_block_content']	= $this->parseIt($menu_item['promenu_block_content'],"display");  
          $menu_item['promenu_app_page_seo'] = $menu_item['page_seo_name'];  
          $menu_item['promenu_app_page_folder'] = $menu_item['page_folder'];  
        
          unset($menu_item['page_seo_name']);  
          unset($menu_item['page_folder']);
		
      
          $menu_list[] = $menu_item;  
          }  
          if(array_keys($menu_list)) 
          { 
          $menus = array();  
          foreach($menu_list as $menu)  
          {  
	          $menu_cache = array();  
	          if( $menu['promenu_parent_id'] == 0)  
	          {  
	          $menu_cache = $menu;  
	       
	               $menu_cache['has_subs'] = $this->CheckChildrenTree($menu_list, $menu['promenu_id']);  
	                 
	               if($menu_cache['has_subs'] == 1 )  
	               {  
	                    $menu_cache[] = $this->GetTheDamnKids($menu_list, $menu);  
	               }  
	                 
	               $menus[$menu['promenu_group_key']][$menu['promenu_id']] = $menu_cache;  
	          }

          }   
          } 
          $cache = $menus;  
            
          /* Update local caches? */  
          if ( $updateCaches )  
          {  
  
               $this->menus_cache = $cache;  
          }  
            
          /* Finally update cache */  
          $this->cache->setCache( 'promenu', $cache, array( 'array' => 1, 'donow' => 1 ) );  
     }	
	
}