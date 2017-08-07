<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			class_menus.php
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

class class_menus
{
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;

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

	public function edit_menu()
	{
		$id = intval($this->request['menu_id']);
		$this->DB->build( array( 
			'select'	=> 'm.*',
			'from'		=> array( 'promenu' => 'm' ),
			'where'     => 'promenu_id = '.$id,
			'add_join'	=> array(
						array(
							'select'	=> 'p.*',
							'from'	
							=> array( 'permission_index'	=> 'p' ),
							'where'		=> "p.perm_type = 'menu' AND p.app = 'promenu' AND p.perm_type_id = m.promenu_id",
							'type'		=> 'left'
							)
						)
					)
				);

		$q = $this->DB->execute();
		
		$menu_item	= array();
		
		while( $menuitem = $this->DB->fetch( $q ) )
		{
			
					
			$menu_item[$menuitem['promenu_id']] = $menuitem;
		}

		return $menu_item;
	}
	
	public function count_menus()
	{
	
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'promenu'
					)
				);

		$q = $this->DB->execute();
		
		while ( $count = $this->DB->fetch($q) )
		{

			$output[] = $count;
		}
		
		$output = count($output);
		
		return $output;

	}
	
	public function getPages()
	{
		$pages = array();

		$this->DB->build( array( 'select'   => 'page_name, page_folder, page_seo_name, page_id, page_omit_filename, page_view_perms',
														 'from'     => 'ccs_pages',
														'order' => 'page_folder, page_seo_name'
		 ) );
		$_page = $this->DB->execute();
		
		$pages[] = array( 0, ' --- None --- ' );
					
		while ( $pa = $this->DB->fetch($_page) )
		{
			$pages[] = array( $pa['page_id'], $pa['page_folder'].'/'.$pa['page_seo_name'] );
		}
		return $pages;
	}
	
/******************** start Drop Down For Parent ************************************/
/* 	public function GatherTheChildren($menudata, $sub, $id)
	{
		if(count($menudata))
		{
			for($i = 1; $i <= $sub+1;$i++)
			{
			$mark .= "&rarr;&nbsp;"; 
			}
			
			foreach($menudata as $key => $menu)
			{

				$build[] =  array($menu['promenu_id'], $mark.$menu['promenu_title'] );

				if($menu['has_subs'] && $menu['promenu_parent_id'] != $id)
				{
				$builder = $this->GatherTheChildren($menu[$menu['promenu_parent_id']], $sub+1, $id);
				$build = array_merge($build, $builder);

				}
			}
		}
		
	return $build;
	}
	
	public function getParent($group, $id)
	{
		$menudata = $this->registry->getClass('class_functions')->get_menus($group);
		$_id = intval($id);
		$menus[] = array( 0, 'None');
		
		if( is_array( $menudata ) && count( $menudata ) )
		{		
			foreach($menudata as $key => $menu)
			{
			
				$menus[] = array($menu['promenu_id'], $menu['promenu_title']);
	
				if($menu['has_subs'])
				{
					$subs =  $this->GatherTheChildren($menu[$menu['promenu_parent_id']], "0", $_id);
					$menus = array_merge_recursive($menus, $subs);	
				}
				
			}
		}
			
		$output = $this->registry->output->formDropdown( 'parent', $menus, $_id );
		
		return $output;
	} */
	
public function GatherTheChildren($menudata, $sub, $id)
	{
		if(count($menudata))
		{
			for($i = 1; $i <= $sub+1;$i++)
			{
				$mark .= "&rarr;&nbsp;"; 
			}
			
			foreach($menudata as $key => $menu)
			{
				if($menu['promenu_parent_id'] != 0)
				{
					if($menu['promenu_id'] != $id)
					{
						$build[] =  array($menu['promenu_id'], $mark.$menu['promenu_title'] );
					}
					
					if($menu['has_subs'] && $menu['promenu_id'] != $id)
					{
						$builder = $this->GatherTheChildren($menu[$menu['promenu_parent_id']], $sub+1, $id);
						
						if( count( $builder ) )
						{
							$build = array_merge($build, $builder);
						}
					}
				}
			}
		}
		
	return $build;
	}
	
	public function getParent($group, $id="", $pid="")
	{
		$menudata = $this->registry->getClass('class_functions')->get_menus($group);
		$_id = intval($id);
		$menus[] = array( 0, ' --- None --- ');
		
		if( is_array( $menudata ) && count( $menudata ) )
		{		
			foreach($menudata as $key => $menu)
			{
				if($menu['promenu_parent_id'] == 0)
				{
					if($menu['promenu_id'] != $id)
					{
						$menus[] = array($menu['promenu_id'], $menu['promenu_title']);
					}
					if($menu['has_subs'])
					{
						$subs =  $this->GatherTheChildren($menu[$menu['promenu_parent_id']], "0", $_id);
						
						if( count($subs) )
						{
							$menus = array_merge_recursive($menus, $subs);
						}	
					}
				}
			}
		}
			
		$output = $this->registry->output->formDropdown( 'parent', $menus, $pid );
		
		return $output;
	}

/******************** ending Drop Down For Parent ************************************/
	
	public function get_menu_query($groupKey)
	{
	if(IPSLib::appIsInstalled('ccs'))
		{
		$addjoin = array(
		array(
				'select'	=> 'p.perm_view',
				'from'		=> array( 'permission_index'	=> 'p' ),
				'where'		=> "p.perm_type = 'menu' AND p.app = 'promenu' AND p.perm_type_id = promenu_id",
				'type'		=> 'left'
							),
							array(
				'select'	=> 'pa.page_seo_name, pa.page_folder',
				'from'		=> array( 'ccs_pages'	=> 'pa' ),
				'where'		=> "m.promenu_app_page=pa.page_id",
				'type'		=> 'left'
							)
							);
							
						
		}
		else
		{
		$addjoin = array( 
		array(
				'select'	=> 'p.perm_view',
				'from'		=> array( 'permission_index'	=> 'p' ),
				'where'		=> "p.perm_type = 'menu' AND p.app = 'promenu' AND p.perm_type_id = m.promenu_id",
				'type'		=> 'left'
							)
							);
					
		}
		$this->DB->build( array( 
							'select'	=> 'm.*',
							'from'		=> array( 'promenu' => 'm' ),
							'where'		=> "m.promenu_group_key = '".$groupKey."'",
							'order'		=> 'm.promenu_displayorder, m.promenu_parent_id',
							'add_join'	=> $addjoin
									)
						);


		$q = $this->DB->execute();

		$menu_list	= array();

		while( $menu_item = $this->DB->fetch( $q ) )
		{
			$menu_list[$menu_item['promenu_id']] = $menu_item;
		}
 
		return $menu_list;
	}	
	
	public function getAppList() 
	{ 
		$apps = array(); 
				   
		foreach (ipsRegistry::$applications as $app_key => $app ) 
		{   
			if($app_key !='promenu' && IPSLib::appIsInstalled($app_key) && $app['app_enabled']) 
			{ 
				$apps[] = array( $app_key, $app['app_public_title'] ); 
			} 
		} 
		
		return $apps; 
	}
	



	

}
