<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			class_perms.php
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
 
class class_perms
{
	/**
	* Registry Object Shortcuts
	*/
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;

	protected $permissions;

	private $default_permissions = array(
										'promenu_id'		=>	0,
										'perm_view'	=>	'*'
									);

	/**
	* Constructor
	*/
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
		
		require_once( IPS_ROOT_PATH . 'sources/classes/class_public_permissions.php' );
		
		$this->permissions = new classPublicPermissions( $this->registry );
	}
	
	public function getDefaultPermissions()
	{
		return $this->default_permissions;
	}
	
	public function getPermissionsMatrix($menu)
	{
		$matrix_html = $this->permissions->adminPermMatrix( 'menu', $menu );
		
		return $matrix_html;
	}

	public function checkPermissions($menus=array(), $in_loop = 0)
	{
		$output = array();
		
		if( is_array( $menus ) && count( $menus ) )
		{
			foreach( $menus as $menu_id => $menu)
			{
		 
				if ( $this->registry->getClass('permissions')->check( 'view', $menu ) == TRUE )
				{
					// Let's check the menus for permissions...
				
					$output[ $menu_id ] = $menu;
					
					// Let's check the children's permissions while we're here!!!
					if ( is_array( $menu[$menu['promenu_parent_id']] ) && count( $menu[$menu['promenu_parent_id']]) > 0 )
					{
						$output[ $menu_id ][$menu['promenu_parent_id']] = $this->checkPermissions( $menu[$menu['promenu_parent_id']], 1 );
						$output[ $menu_id ]['has_subs'] = $this->_checkPermissions($menu, $menu['promenu_parent_id']);
					}
				}
				
			}
		}
		return $output;
	}
	
	/*******************
	@method _checkPermissions
	@Last Updated 2012 Jan 1, 2012 3:21:21 PM
	@Author MarcherTech
	*************/
	
	//helper internal look-up active while we look-down above function
	protected function _checkPermissions($menudata, $id)
	{
		if ( is_array( $menudata[$id] ) && count( $menudata[$id]) > 0 )
		{
			foreach($menudata[$id] as $key => $menu)
			{
				if ( $this->registry->getClass('permissions')->check( 'view', $menu ) == TRUE )
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
	
	public function savePermissionsMatrix($menu)
	{
		$this->permissions->savePermMatrix( $this->request['perms'], $menu, 'menu' );
	}

	public function addManualPermissions($menu)
	{
		$this->DB->insert( 'permission_index',
			array (
				'perm_type_id'	=>	$menu,
				'app'			=>	'promenu',
				'perm_view'		=>	'*',
				'perm_2'		=>	'*',
				'perm_3'		=>	'*',
				'perm_4'		=>	'*',
				'perm_5'		=>	'*',
				'perm_6'		=>	'*',
				'perm_7'		=>	'*',
				'perm_type'		=>	'menu'
			)
		);
	}
/*********************** End Permissions Matrix **********************************/
	
/*********************** Begin Group Visibility **********************************/

	public function checkGroupView($menus=array(), $in_loop = 0)
	{
		$output = array();
		if( is_array( $menus ) && count( $menus ) )
		{		
			foreach( $menus as $menu_id => $menu)
			{	// if the ID matches the current users group ID, we continue 
				if(!IPSMember::isInGroup($this->memberData, explode( ",", $menu['promenu_view_menu']) )) 	 
				{
					// Let's check to make sure we aren't doing a global hide...
					if( $menu['promenu_view_override'] != 1 )
					{	// we passed all checks .. lets display the menu
						$output[ $menu_id ] = $menu;
						
						// Let's check the children's visibility while we're here!!!
						if ( is_array( $menu[$menu['promenu_parent_id']] ) && count( $menu[$menu['promenu_parent_id']]) > 0 )
						{
							$output[ $menu_id ][$menu['promenu_parent_id']] = $this->checkGroupView( $menu[$menu['promenu_parent_id']], 1 );
							$output[ $menu_id ]['has_subs'] = $this->_checkGroupView($menu, $menu['promenu_parent_id']);
						}
					}
				}		
			}
		}
		return $output;
	}
	
	protected function _checkGroupView($menudata, $id)
	{
		if ( is_array( $menudata[$id] ) && count( $menudata[$id]) > 0 )
		{
			foreach($menudata[$id] as $key => $menu)
			{	// if the ID matches the current users group ID, we continue 
				if(!IPSMember::isInGroup($this->memberData, explode( ",", $menu['promenu_view_menu']) ))
				{	// Let's check to make sure we aren't doing a global hide...
					if($menu['promenu_view_override'] != 1)
					{	// we passed all checks .. lets display the menu	
						$menus[] = $menu;
					}
				}
			}
			
			if(count($menus))
			{
				return TRUE;
			}
		}
		return FALSE;
	}
	
/*********************** End Group Visibility **********************************/

}
?>