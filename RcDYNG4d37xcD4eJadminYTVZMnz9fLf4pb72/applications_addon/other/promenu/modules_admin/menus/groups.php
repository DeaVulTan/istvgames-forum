<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			groups.php
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
 
class admin_promenu_menus_groups extends ipsCommand
{
	public $html;
	
	public function doExecute( ipsRegistry $registry )
	{
		/* Load Languages */
		$this->registry->class_localization->loadLanguageFile( array( 'admin_tools' ), 'core' );
		$this->registry->class_localization->loadLanguageFile( array( 'admin_lang' ), 'promenu' );
		
		/* Grab, init and load settings */
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir('core').'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings    = new $classToLoad();
		$settings->makeRegistryShortcuts( $this->registry );

		/* Load Templates*/		
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_groups' );
		$this->form_code_groups 	= $this->html->form_code_groups	    		= 'module=menus&amp;section=groups';
		$this->form_code_js_groups 	= $this->html->form_code_js_groups			= 'module=menus&section=groups';
		$this->form_code_menu 		= $this->html->form_code_menu    			= 'module=menus&amp;section=menus';
		$this->form_code_js_menu 	= $this->html->form_code_js_menu			= 'module=menus&section=menus';
		$this->return_after_save_group	= $this->settings['base_url'] . $this->form_code_groups;
		
		//BEGONE breadcrumb
		$this->registry->output->ignoreCoreNav = TRUE;
		
		// Lets build the new breadcrumb
		$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'].$this->form_code_groups, "{$this->lang->words['promenu_menu_groups']}" );	

		/* Which do .. do we do? :O */
		switch( $this->request['do'] )
		{

			case "view":
				$this->View();
				break;				
			case "add":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_groups' );
				$this->Add();
				break;
			case "doadd":
				$this->_doAdd();
				break;
			case "edit":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_groups' );	
				$this->Edit();
				break;
			case "doedit":
				$this->_doEdit();
				break;
			case "delete":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_groups_delete' );	
				$this->_doDelete();
				break;
			case "doreorder":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_groups' );
				$this->_doReorder();
				break;
			default:
				$this->View();
				break;

		}
		/* Output */

		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		$this->registry->getClass('output')->sendOutput();	
	}

	private function View()
	{
			
		// Lets do the {$this->lang->words['promenu_help_guides']}
		if ( $this->settings['promenu_view_help'] == 1 )
		{
		$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
		$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
		$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_group_view_desc']}</li></ul>";
		$this->registry->output->sidebar_extra .= "</li></ul>";	
		}
		/* Add to Output */
		$this->registry->output->html .= $this->html->groups();
	}

	private function Add()
	{
		// Lets do the {$this->lang->words['promenu_help_guides']}
		if ( $this->settings['promenu_view_help'] == 1 )
		{
		$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
		$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
		$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_group_add_desc']}</li></ul>";
		$this->registry->output->sidebar_extra .= "</li></ul>";	
		}
		/* Load New Template */
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_add_group' );
		/* Navigation */
		$this->registry->output->extra_nav[] = array( '', "{$this->lang->words['promenu_new_group']}" );
		/* Add to Output */
		$this->registry->output->html .= $this->html->add_group();
	}
	
	private function _doAdd()
	{
		/* Check for a title, if one isn't present we show an error */
		if ( !strlen( $this->request['group_title'] ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_group_title']}", 'PG0001');	
		}
		
		/* Check for a key, if one isn't present we show an error */
		if ( !strlen( $this->request['group_key'] ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_group_key_req']}", 'PG0002');	
		}
			
		/* Init some vars */
		$addGroup = array();

		/* Lets build an array to feed to the database */
		$addGroup['promenu_group_title'] = trim($this->request['group_title']);
		$addGroup['promenu_group_description'] = trim($this->request['group_description']);
		$addGroup['promenu_group_displayorder'] = 0;
		$addGroup['promenu_group_key'] = $this->request['group_key'] ? trim( preg_replace( "/[^a-zA-Z0-9\-_]/", '', $this->request['group_key'] ) ) : md5( uniqid( microtime(), true ) );		
		$addGroup['promenu_group_mega'] = intval($this->request['group_mega']);

		/* Time to see if we have a unique key */
		 $check = $this->checkKey(0, trim($this->request['group_key']));
		/* no? we rand the fuker */
		if ( !strlen($addGroup['promenu_group_key']) || $check !== FALSE) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_group_key_dup']}", 'PG0006');
		}
		
		/* Key must be unique, so lets insert the array and build a new group */
		$this->DB->insert(
				"promenu_groups",
				$addGroup
		);
		
		$id = $this->DB->getInsertId();
		
		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------

		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_added_group_log']} " .$addGroup['promenu_group_title'], $id ));

		/* Global Display Message */
		$this->registry->output->global_message = sprintf( "{$this->lang->words['promenu_new_group_added']}" );	
		
		/* Add to Output */
		$this->registry->output->html .= $this->html->groups();
	}

	private function Edit()
	{
		// Grab the ID
		$id = intval($this->request['group_id']);
		$oldkey = trim( $this->request['group_key']);	
		/* Check for a ID, if one isn't present we show an error */
		if ( !$id ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
			/* Check for a ID, if one isn't present we show an error */
		if ( !$oldkey ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}
		// If we have an ID, we grab the title
		$title = $this->registry->getClass("class_groups")->get_group_title( $id );
		// Lets do the {$this->lang->words['promenu_help_guides']}
		if ( $this->settings['promenu_view_help'] == 1 )
		{
		$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
		$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
		$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_group_edit_desc']}</li></ul>";
		$this->registry->output->sidebar_extra .= "</li></ul>";	
		}
		/* Load New Template */
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_edit_group' );
		/* Navigation */
		$this->registry->output->extra_nav[] = array( '', "{$this->lang->words['promenu_edit_group']}: {$title}" );
		/* Add to Output */
		$this->registry->output->html .= $this->html->edit_group($id, $oldkey);
	}
	
	private function _doEdit()
	{	
		$id = intval( $this->request['group_id']);
		$oldkey = trim( $this->request['old_group_key']);	
			
		/* Check for a title, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_title']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_group_title']}", 'PG0001');	
		}
		
		/* Check for a key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_group_key_req']}", 'PG0002');	
		}
		
		/* Check for an ID, if one isn't present we show an error */
		if ( !id ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0005');	
		}

		/* Init some vars */
		$editGroup = array();
        $editMenu  = array();
        
		/* Lets build an array to feed to the database */
		$editGroup['promenu_group_title'] = trim($this->request['group_title']);
		$editGroup['promenu_group_description'] = trim($this->request['group_description']);
		$editGroup['promenu_group_key'] = $this->request['group_key'] ? trim( preg_replace( "/[^a-zA-Z0-9\-_]/", '', $this->request['group_key'] ) ) : md5( uniqid( microtime(), true ) );	
		$editGroup['promenu_group_mega'] = intval($this->request['group_mega']);

		if ($oldkey != trim($this->request['group_key']))
		{
			/* Time to see if we have a unique key */
			$check = $this->checkKey($editGroup['promenu_group_id'], $editGroup['promenu_group_key']);
			
			/* no? rand the fucker */
			if ( !strlen( $editGroup['promenu_group_key'] ) || $check !== FALSE)
			{
				$this->registry->output->showError( "{$this->lang->words['promenu_group_key_dup']}", 'PG0006');
			}
		}
		
		$mega = $editGroup['promenu_group_mega'];
		
		$editMenu['promenu_group_mega']  = $mega;

		$this->DB->update( 'promenu_groups', $editGroup, 'promenu_group_id=' . $id );

		$groupkey = $editGroup['promenu_group_key'];
		
		$title = $this->registry->getClass("class_groups")->get_group_title( $id );
		
		if ($oldkey != trim($this->request['group_key']))
		{
			$this->DB->update( 'promenu', array('promenu_group_mega' => $mega), "promenu_group_id='{$id}'" );
			$this->DB->update( 'promenu', array('promenu_group_key' => $groupkey), "promenu_group_key='{$oldkey['promenu_group_key']}'" );
		}
		else 
		{
			$this->DB->update( 'promenu', array('promenu_group_mega' => $mega), "promenu_group_id='{$id}'" );
		}

		$this->registry->getClass('class_functions')->recacheMenus($rebuild='yes', $group=$groupkey, $updateCaches=true);
		
		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_group_log']} '{$title}'", $id ));
		
		/* Global Display Message */
		$this->registry->output->global_message = sprintf( "{$this->lang->words['promenu_group_edited']}" );
		
		/* Add to Output */
		$this->registry->output->html .= $this->html->groups();		
	}
	
	private function _doDelete()
	{
		/*Grab The Key*/
		$groupKey = trim( $this->request['group_key'] );

		/* Check for a key, if one isn't present we show an error */
		if ( !$groupKey ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}
			
		/* Lets delete this group from the permission index */		
		$this->DB->delete( "permission_index", "app='promenu' AND perm_type='group' AND perm_type_id=" . intval( $this->request['group_id'] ) );
		
		/* Lets delete all menus in this group */	
		$this->DB->delete( "promenu", "promenu_group_key='" . $groupKey  . "'" );

		/* Lets delete this group from the database */		
		$this->DB->delete( "promenu_groups", "promenu_group_key='" . $groupKey . "'" );

		$this->registry->getClass('class_functions')->recacheMenus();
	
		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_delete_group_log']} '{$title}'", intval( $this->request['group_id'] ) ));	
	
		/* Global Display Message */
		$this->registry->output->global_message = sprintf( "{$this->lang->words['promenu_group_deleted']}" );
		
		/* Add to Output */
		$this->registry->output->html .= $this->html->groups();
	}

	private function _doPermEdit()
	{
		/* Lets check our security */
		$this->registry->adminFunctions->checkSecurityKey();
		
		/* Time to save the menu permissions */
		$this->registry->getClass('class_group_perms')->savePermissionsMatrix( intval( $this->request['group_id'] ) );	

	}
	
	private function _doReorder()
	{
		/* Create a new Ajax */
		require_once( IPS_KERNEL_PATH . 'classAjax.php' );
		$ajax			= new classAjax();

		/* Lets check our security, if we fail the test show an error */
		if( $this->registry->adminFunctions->checkSecurityKey( $this->request['md5check'], true ) === false )
		{
			$ajax->returnString( $this->lang->words['postform_badmd5'] );
			exit();
		}

		/* Define the position */
		$position	= 1;
		
		/* Check if the array is present and count the menus */
		if( is_array($this->request['groups']) AND count($this->request['groups']) )
		{
			/* Time to update the database with the new position */
			foreach( $this->request['groups'] as $this_id )
			{
				$this->DB->update( 'promenu_groups', array( 'promenu_group_displayorder' => $position ), 'promenu_group_id=' . $this_id );
				
				$position++;
			}
		}
		
		/* output and exit */
		$ajax->returnString( 'OK' );
		exit();
	}
	
	private function checkKey($groupID, $groupKey)
	{
		$id = intval($id);
		$this->DB->addSlashes(IPSText::mbstrtolower(IPSText::alphanumericalClean(trim($groupKey))));
	$check =	$this->DB->buildAndFetch( array(
				'select'	=> 'promenu_group_key',
				'from'		=> 'promenu_groups',
				'where'		=> "promenu_group_id != '{$groupID}' AND promenu_group_key='{$groupKey}'"
								)
						);
	
				if ($check['promenu_group_key'] )
				{
			return TRUE;
				}
				

		return FALSE;
	}
}
