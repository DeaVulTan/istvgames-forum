<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			class_groups.php
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

class class_groups
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

	
/********************** Global query for both sides ************************************/

	public function get_groups()
	{
		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'promenu_groups',
			'order'		=> 'promenu_group_displayorder asc',
					)
				);

		$q = $this->DB->execute();

		$group_list	= array();

		while( $group_item = $this->DB->fetch( $q ) )
		{
			$groupitem = array();
			$groupitem['promenu_group_id'] = $group_item['promenu_group_id'];
			$groupitem['promenu_group_title'] = $group_item['promenu_group_title'];
			$groupitem['promenu_group_description'] = $group_item['promenu_group_description'];
			$groupitem['promenu_group_displayorder'] = $group_item['promenu_app_display'];
			$groupitem['promenu_group_key'] = $group_item['promenu_group_key'];

			$group_list[$group_item['promenu_group_id']] = $groupitem;
		}
 
		return $group_list;

	}

	public function getGroupList() 
	{
		$groups = array();

		$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'promenu_groups',
			'order'		=> 'promenu_group_displayorder asc',
					)
				);
				
		$q = $this->DB->execute();
					
		while ( $group = $this->DB->fetch($q) )
		{
			$groups[] = array( $group['promenu_group_key'], $group['promenu_group_title'] );
		}
		return $groups;
	}
	
	public function get_group_title($id)
	{
		$this->DB->build( array( 
			'select'	=> 'promenu_group_title',
			'from'		=> 'promenu_groups',
			'where'		=> "promenu_group_id = '{$id}'"
					)
				);

		$q = $this->DB->execute();

		while( $group_item = $this->DB->fetch( $q ) )
		{
			$group_title = $group_item['promenu_group_title'];
		}
 
		return $group_title;

	}
	
	public function get_group_id($key)
	{
		$this->DB->build( array( 
			'select'	=> 'promenu_group_id',
			'from'		=> 'promenu_groups',
			'where'		=> "promenu_group_key = '{$key}'"
					)
				);

		$q = $this->DB->execute();

		while( $group_item = $this->DB->fetch( $q ) )
		{
			$group_id = $group_item['promenu_group_id'];
		}
 
		return $group_id;

	}

	public function get_group_key($groupID)
	{
		$this->DB->build( array( 
			'select'	=> 'promenu_group_key',
			'from'		=> 'promenu_groups',
			'where'		=> "promenu_group_id = '{$groupID}'"
					)
				);

		$q = $this->DB->execute();

		while( $group_item = $this->DB->fetch( $q ) )
		{
			$group_key = $group_item['promenu_group_key'];
		}
 
		return $group_key;

	}
	
	public function get_group_mega($groupID)
	{
		$this->DB->build( array( 
			'select'	=> 'promenu_group_mega',
			'from'		=> 'promenu_groups',
			'where'		=> "promenu_group_id = '{$groupID}'"
					)
				);

		$q = $this->DB->execute();

		while( $group_item = $this->DB->fetch( $q ) )
		{
			$group_mega = $group_item['promenu_group_mega'];
		}
 
		return $group_mega;

	}
/********************** End global query ************************************/
	public function edit_group($oldkey)
	{
		$this->DB->build( array( 
			'select'	=> 'g.*',
			'from'		=> array( 'promenu_groups' => 'g' ),
			'where'     => "promenu_group_key = '".$oldkey."'"
					)
				);

		$q = $this->DB->execute();
		
		$group_item	= array();
		
		while( $groupitem = $this->DB->fetch( $q ) )
		{
			$groupitem['promenu_group_id'];
			$groupitem['promenu_group_title'];
			$groupitem['promenu_group_description'];
			$groupitem['promenu_group_displayorder'];
			$groupitem['promenu_app_display'];
			$groupitem['promenu_page_display'];
			$groupitem['promenu_display_loc'];
			$groupitem['perm_view'];
						
			$group_item[$groupitem['promenu_group_id']] = $groupitem;
		}

		return $group_item;
	}

	public function doCompare($test, $compare, $true, $false)
	{
		return ( $test == $compare ? $true : $false );	
	}
}
