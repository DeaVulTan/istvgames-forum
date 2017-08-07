<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			menus.php
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
 
class admin_promenu_menus_menus extends ipsCommand
{
	public $html;
	
	public function doExecute( ipsRegistry $registry )
	{
		$groupID = intval($this->request['group_id']);
		$groupKey = trim($this->request['group_key']);
		/* Load Languages */
		$this->registry->class_localization->loadLanguageFile( array( 'admin_tools' ), 'core' );
		$this->registry->class_localization->loadLanguageFile( array( 'admin_lang' ), 'promenu' );
		
		if ( ipsRegistry::$vn_full >= 32000 ) 
		{
			$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'core' ) . '/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
			$this->settingsClass		= new $classToLoad();
			$this->settingsClass->makeRegistryShortcuts( $this->registry );
			$this->settingsClass->html				= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
			$this->settingsClass->form_code			= $this->settingsClass->html->form_code	= 'module=menus&amp;section=menus';
			$this->settingsClass->form_code_js		= $this->settingsClass->html->form_code_js	= 'module=menus&section=menus';
			$this->settingsClass->return_after_save	= $this->settings['base_url'] . $this->settingsClass->form_code;
		}
		
		/* Grab, init and load settings */
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir('core').'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings    = new $classToLoad();
		$settings->makeRegistryShortcuts( $this->registry );

		/* Load Templates*/		
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_menus' );		
		$this->form_code    			= 'module=menus&amp;section=groups';
		$this->form_code_js	= 'module=menus&section=groups';

		//BEGONE breadcrumb
		$this->registry->output->ignoreCoreNav = TRUE;
		
		// Lets build the new breadcrumb
		$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
		$this->registry->output->extra_nav[] = array( $this->settings['base_url']."module=menus&amp;section=groups", "{$this->lang->words['promenu_menu_groups']}" );	
		$this->registry->output->extra_nav[] = array( $this->settings['base_url']."module=menus&amp;section=menus&amp;group_id=".$groupID."&group_key=".$groupKey, $this->registry->getClass('class_groups')->get_group_title($groupID) );

		
		/* Which do .. do we do? :O */
		switch( $this->request['do'] )
		{
			case "viewsub":
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_menu_view_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				/* Add to Output */
				$this->registry->output->html .= $this->html->submenus();
				$this->registry->output->html .= "<script type='text/javascript'>
	jQ('#submenu_container').ipsSortable('main', { 
		url: '{$this->settings['base_url']}&{$this->form_code_js}module=menus&amp;section=menus&amp;&do=doreorder&md5check={$this->registry->adminFunctions->getSecurityKey()}'.replace( /&amp;/g, '&' ),
		serializeOptions: { key: 'menus[]' }
	} );        
</script>
";
				break;
			case "add":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu' );
				
				/* Load New Template */
				$this->html = $this->registry->output->loadTemplate( 'cp_skin_add_menu' );
				
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_add_menu_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				/* Navigation */
				$this->registry->output->extra_nav[] = array( '', $this->lang->words['promenu_add_menu'] );
				/* Add to Output */
				$this->registry->output->html .= $this->html->add_menu();
				break;
			case "edit":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu' );
				
				/* Load New Template */
				$this->html = $this->registry->output->loadTemplate( 'cp_skin_edit_menu' );
				
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_menus_setting_disclaim']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}								
				/* Navigation */
				$this->registry->output->extra_nav[] = array( '', $this->lang->words['promenu_edit_menu'] );
				/* Add to Output */
				$this->registry->output->html .= $this->html->edit_menu();
				break;
			case "permedit":
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu' );
				
				/* Load New Template */
				$this->html = $this->registry->output->loadTemplate( 'cp_skin_edit_perms' );
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_menus_setting_disclaim']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				/* Navigation */
				$this->registry->output->extra_nav[] = array( '', $this->lang->words['promenu_edit_perms'] );
				/* Add to Output */
				$this->registry->output->html .= $this->html->edit_menu_perm();
				break;
			case "vedit":
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu' );
				
				/* Load New Template */
				$this->html = $this->registry->output->loadTemplate( 'cp_skin_edit_visibility' );
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_menus_setting_disclaim']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				/* Navigation */
				$this->registry->output->extra_nav[] = array( '', $this->lang->words['promenu_edit_visible'] );
				/* Add to Output */
				$this->registry->output->html .= $this->html->edit_menu_visibility();
				break;
			case "doadd":
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_add_menu_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				$this->_doAdd();
				/* Add to Output */
				$this->View();
				/* Display Message */
				$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_added'] );
				break;
			case "doedit":
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_edit_menu_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				$this->_doEdit();
				/* Add to Output */
				$this->View();
				/* Display Message */
				$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_edited'] );
				break;
			case "dopermedit":
				$this->_doPermEdit();
				/* Add to Output */
				$this->View();
				/* Display Message */
				$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_perm_edited'] ); 
				break;
			case "dovedit":
				$this->_dovEdit();
				/* Add to Output */
				$this->View();
				/* Display Message */
				$this->registry->output->global_message = sprintf( "{$this->lang->words['promenu_menu_visual_edit']}" ); 
				break;
			case "dodelete":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu_delete' );
				/* Lets grab a menu count, the current menu data, and our IP.Content check */
				$groupKey = trim($this->request['group_key']);
				$groupID = intval($this->request['group_id']);		
				$id = intval($this->request['menu_id']);	
		        $menudata = $this->registry->getClass('class_menus')->get_menu_query($groupKey);
		
		        $subs = $this->registry->getClass('class_functions')->CheckChildrenTree($menudata, $id);
		        
		        if ($subs == 1)
		        {
	 				/* Load New Template */
					$this->html = $this->registry->output->loadTemplate( 'cp_skin_edit_menu' );
					
					// Lets do the {$this->lang->words['promenu_help_guides']}
					if ( $this->settings['promenu_view_help'] == 1 )
					{
					$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
					$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
					$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_delete_menu_desc']}</li></ul>";
					$this->registry->output->sidebar_extra .= "</li></ul>";	
					}								
					/* Navigation */
					$this->registry->output->extra_nav[] = array( '', "{$this->lang->words['promenu_deleting_menu']}" );
					/* Add to Output */
					$this->registry->output->html .= $this->html->delete_menu();       
		        }
		        else 
		        {
					$this->_doDelete();
					/* Add to Output */
					$this->View();
					/* Display Message */
					$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_deleted'] );
        		}
				break;
			case "dodeletewkids":
				$this->_doDeleteWKids();		
				
				/* Add to Output */
				$this->View();
				
				/* Display Message */
				$this->registry->output->global_message = sprintf( $this->lang->words['promenu_delete_parent_with_sub'] );
				break;
			case "dodeletewokids":
				$this->_doDeleteWOKids();
				/* Add to Output */
				$this->View();
				/* Display Message */
				$this->registry->output->global_message = sprintf( $this->lang->words['promenu_delete_parent_no_sub'] );
				break;
			case "doreorder":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu' );
				$this->_doReorder();
				break;
			default:
				// Lets do the {$this->lang->words['promenu_help_guides']}
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_menu_view_main']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}	
				$this->View();
				break;
		}
		/* Output */
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		$this->registry->getClass('output')->sendOutput();	
	}
	
	private function View()
	{
		$acp = CP_DIRECTORY;
		$groupID = intval($this->request['group_id']);
        $groupKey = trim($this->request['group_key']);

		//$this->registry->output->html .= $this->registry->getClass('output')->showInsideIframe($this->settings['board_url']."/index.php?app=promenu&amp;module=preview&amp;section=preview");

        $this->registry->output->html .= $this->html->menus($groupKey);
        //$this->prev = $this->registry->output->loadTemplate( 'cp_skin_preview_menus' );
        $this->registry->output->html .= "
        <script type='text/javascript' src='{$this->settings['board_url']}/{$acp}/applications_addon/other/promenu/js/acp.promenu.js'></script>
        <script type='text/javascript'> 
        	var jQ =   jQuery.noConflict();
        	     
			jQ(document).ready(function() {
				jQ('#menu_container').CloseThem();
		
				jQ('#menu_container').each(function () {
					jQ(this).find('#submenu_container').PreviewSort('main', { 
						url: '{$this->settings['base_url']}&{$this->form_code_js}module=menus&amp;section=menus&amp;&do=doreorder&md5check={$this->registry->adminFunctions->getSecurityKey()}'.replace( /&amp;/g, '&' ),
						serializeOptions: { key: 'menus[]' },
						postUpdateProcess: function() {
            			jQ('#menu_preview').attr('src', jQ('#menu_preview').attr('src'));
					}
				}); 
			});        
			jQ('#menu_container').PreviewSort('main', { 
				url: '{$this->settings['base_url']}&{$this->form_code_js}module=menus&amp;section=menus&amp;&do=doreorder&md5check={$this->registry->adminFunctions->getSecurityKey()}'.replace( /&amp;/g, '&' ),
				serializeOptions: { key: 'menus[]' },
				postUpdateProcess: function() {
            	jQ('#menu_preview').attr('src', jQ('#menu_preview').attr('src'));
				}
			} );
 

			});
		</script>";

	}
	
	private function _getMaxDisplayOrder($parent_id = 0)
	{
		/* Grab the parent menu ID */
		$parent_id = intval( $parent_id );
		/* If the parent ID value is greater than zero we select our order from our parent */
		if ( $parent_id > 0 )
		{
			$r = $this->DB->buildAndFetch( array( 'select' => 'max(promenu_displayorder) as maxdisp', 'from' => 'promenu', 'where' => 'promenu_parent_id='.$parent_id ) );
		}
		/* If the parent ID value is zero we assume we are a root parent and build the order accordingly */
		else
		{
			$r = $this->DB->buildAndFetch( array( 'select' => 'max(promenu_displayorder) as maxdisp', 'from' => 'promenu', 'where' => 'promenu_parent_id is NULL or promenu_parent_id=0' ) );
		}
		/* Return the new display order */
		return intval( $r['maxdisp'] );
	}
	
	private function _doAdd()
	{		
		/* Lets check our security */
		$this->registry->adminFunctions->checkSecurityKey();

		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a title, if one isn't present we show an error */
		if ( !strlen( trim($this->request['title']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_title']}", 'PM0001');
		}
		
		/* Check for either an application or url, if one isn't present we show an error */
		elseif ( intval($this->request['link_to_app']) == 0  && !strlen( $this->request['url'] ) && intval($this->request['is_cat']) == 0 && intval($this->request['as_cat']) == 0 ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_url']}", 'PM0002');
		}


		$groupKey = trim($this->request['group_key']);
		
		/* Init some vars */
		$addItem = array();

		/* Lets build an array to feed to the database */
		$addItem['promenu_title'] = trim($this->request['title']);
		$addItem['promenu_description'] = trim($this->request['description']);
		$addItem['promenu_url'] = trim($this->request['url']);
		$addItem['promenu_parent_id'] = intval($this->request['parent']);
		$addItem['promenu_displayorder'] = intval($this->_getMaxDisplayOrder($addItem['parent']) + 1);
		$addItem['promenu_open_new_window'] = intval($this->request['opennew']);
		$addItem['promenu_icon'] = trim($this->request['icon']);
		$addItem['promenu_app_page'] = intval($this->request['app_page']);
		$addItem['promenu_left_open'] = intval($this->request['left_open']);
		$addItem['promenu_disable_active'] = intval($this->request['is_active']);
 		$addItem['promenu_as_cat'] = intval($this->request['as_cat']);
		$addItem['link_to_app']  = intval($this->request['link_to_app']);	
		$addItem['promenu_disable_desc_hover'] = intval($this->request['disable_desc']);
		$addItem['promenu_data_tooltip']  = intval($this->request['use_data_tooltip']);
		$addItem['promenu_use_app'] = trim($this->request['use_app']);
		$addItem['promenu_group_id'] = intval($this->request['group_id']);	
		$addItem['promenu_group_key'] = $groupKey;
		$addItem['promenu_group_mega'] = intval($this->request['group_mega']);
		$addItem['promenu_title_image'] = intval($this->request['title_image']);

		if ( $addItem['promenu_group_mega'] == 1 OR $groupKey == "footer_menus")
		{

			$content = $this->registry->getClass('class_functions')->parseIt($_POST['block_content'] ,"db");
			$addItem['promenu_is_cat'] = intval($this->request['is_cat']);
			$addItem['promenu_new_row'] = intval($this->request['new_row']);
			$addItem['promenu_use_block'] = intval($this->request['use_block']);
			$addItem['promenu_block_content'] = $text;
		}

		if ( $this->settings['promenu_group_perm_view'] == 1 )
		{
			$addItem['promenu_view_override']  = intval($this->request['view_override']);
			
			$viewItem = $this->request['view_menu'];
					
			if ($viewItem)
			{	
				foreach ( $viewItem as $view_id => $view)
				{
				$viewItems .= ",".$view;
				}
				$addItem['promenu_view_menu']  = $viewItems;
			}
			else 
			{
				$addItem['promenu_view_menu'] = "";
			}
		}
		
		/* Lets insert the array and build a new menu */
		$this->DB->insert(
			"promenu",
			$addItem
		);
		
		/* Grab the new menu ID */
		$id = $this->DB->getInsertId();

		if ( $this->settings['promenu_group_perm_view'] != 1 )
		{
			/* Time to save the menu permissions */
			$this->registry->getClass('class_perms')->savePermissionsMatrix( intval( $id ) );
		}

		$groupkey = $addItem['promenu_group_key'];
				
		$this->registry->getClass('class_functions')->recacheMenus($rebuild='yes', $group=$groupkey, $updateCaches=true);

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($addItem['promenu_group_id']);
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "ProMenu: a new menu titled '{$addItem['promenu_title']}' has been added to the group {$groupTitle}", $id ));
		
		if($this->request['return'])
		{
			$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_added'] );
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . 'module=menus&section=menus&do=edit&menu_id=' . $id .'&group_id=' . $addItem['promenu_group_id'] . '&parent='. $addItem['promenu_parent_id'] );
		}		
	}

	private function _doEdit()
	{
		/* Lets check our security */
		$this->registry->adminFunctions->checkSecurityKey();

			/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		/* Check for a title, if one isn't present we show an error */
		if ( !strlen( $this->request['title'] ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_title']}", 'PM0001');
		}
		
		/* Check for either an application or url, if one isn't present we show an error */
		elseif ( intval($this->request['link_to_app']) == 0  && !strlen( $this->request['url'] ) && intval($this->request['is_cat']) == 0 && intval($this->request['as_cat']) == 0 ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_url']}", 'PM0002');
		}
		
		if ( intval($this->request['menu_id']) == intval($this->request['parent']) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_parent_error']}", 'PM0003');
		}
		
		/* Init some vars */
		$editItem = array();

		/* Lets build an array to feed to the database */
		$id = intval($this->request['menu_id']);
		$groupID = intval($this->request['group_id']);
		$groupKey = trim($this->request['group_key']);
		$newKey = trim($_POST['group_key']);
		$editItem['promenu_title'] = trim($this->request['title']);
		$editItem['promenu_description'] = trim($this->request['description']);
		$editItem['promenu_url'] = trim($this->request['url']);
		$editItem['promenu_parent_id'] = intval($this->request['parent']);
		$editItem['promenu_open_new_window'] = intval($this->request['opennew']);
		$editItem['promenu_icon'] = trim($this->request['icon']);
		$editItem['promenu_app_page'] = trim($this->request['app_page']);
		$editItem['promenu_left_open'] = intval($this->request['left_open']);
		$editItem['promenu_disable_active'] = intval($this->request['is_active']);
		$editItem['promenu_as_cat'] = intval($this->request['as_cat']);
		$editItem['link_to_app']  = intval($this->request['link_to_app']);	
		$editItem['promenu_disable_desc_hover'] = intval($this->request['disable_desc']);
		$editItem['promenu_data_tooltip']  = intval($this->request['use_data_tooltip']);
		$editItem['promenu_use_app'] = trim($this->request['use_app']);
		$editItem['promenu_group_id'] = $groupID;
		$editItem['promenu_group_mega'] = intval($this->request['group_mega']);		
		$editItem['promenu_title_image'] = intval($this->request['title_image']);		
		if ( $this->settings['promenu_group_perm_view'] == 1 )
		{
			$editItem['promenu_view_override']  = intval($this->request['view_override']);
			$viewItem = $this->request['view_menu'];	
			if ($viewItem)
			{	
				foreach ( $viewItem as $view_id => $view)
				{
				$viewItems .= ",".$view;
				}
				$editItem['promenu_view_menu']  = $viewItems;
			}
			else 
			{
				$editItem['promenu_view_menu'] = "";
			}	
		}
		
		if ( $editItem['promenu_group_mega'] == 1 OR $groupKey == "footer_menus")
		{
			$content = $this->registry->getClass('class_functions')->parseIt($_POST['block_content'] ,"db");

			$editItem['promenu_is_cat'] = intval($this->request['is_cat']);
			$editItem['promenu_new_row'] = intval($this->request['new_row']);
			$editItem['promenu_use_block'] = intval($this->request['use_block']);
			$editItem['promenu_block_content'] = $content;
		}
		
//		if ($groupKey != "primary_menus" | $groupKey != "header_menus" | $groupKey != "footer_menus" )
//		{		
//			$menudata = $this->registry->getClass('class_menus')->get_menu_query($groupID);
//			
//			$newGroupID = $this->registry->getClass('class_groups')->get_group_id($newKey);
//			
//			$newMega = $this->registry->getClass('class_groups')->get_group_mega($newGroupID);
//			
//			$menus = $this->GetTheKidID($menudata, $id);
//			
//			if ($menus)
//			{	
//				foreach ( $menus as $menu_id => $menu)
//				{
//				$this->DB->update( "promenu",
//					array( "promenu_group_mega"	=>	$newMega ),
//					"promenu_id=" . $menu );
//				$this->DB->update( "promenu",
//					array( "promenu_group_id"	=>	$newGroupID ),
//					"promenu_id=" . $menu );
//				$this->DB->update( "promenu",
//					array( "promenu_group_key"	=>	$newKey ),
//					"promenu_id=" . $menu );
//				}
//			}
//			
//			$this->DB->update( "promenu",
//				array( "promenu_group_mega"	=>	$newMega ),
//				"promenu_id=" . $id );
//			$this->DB->update( "promenu",
//				array( "promenu_group_id"	=>	$newGroupID ),
//				"promenu_id=" . $id );			
//			$this->DB->update( "promenu",
//				array( "promenu_group_key"	=>	$newKey ),
//				"promenu_id=" . $id );
//
//		}
		/* Lets update the database with the new data */
		$this->DB->update( 'promenu', $editItem, 'promenu_id=' . $id );
	
		if ( $this->settings['promenu_group_perm_view'] != 1 )
		{
			/* Time to save the menu permissions */
			$this->registry->getClass('class_perms')->savePermissionsMatrix( $id );
		} 		
				
		$this->registry->getClass('class_functions')->recacheMenus($rebuild='yes', $group=$groupKey, $updateCaches=true);

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($editItem['promenu_group_id']);
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_1']} '{$editItem['promenu_title']}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_3']}", $id ));
		
		if($this->request['return'])
		{
			$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_edited'] );
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . "module=menus&section=menus&do=edit&menu_id={$id}&group_id={$groupID}&group_key={$groupKey}&parent={$editItem['promenu_parent_id']}" );
		}			
	}

	private function _doPermEdit()
	{
		/* Lets check our security */
		$this->registry->adminFunctions->checkSecurityKey();

		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		if ( intval($this->request['menu_id']) == intval($this->request['parent'] ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_parent_error']}", 'PM0003');
		}
		
		$id = intval($this->request['menu_id']);
		$groupID = intval($this->request['group_id']);
		
		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$id}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_5']}has had the permissions edited", $id ));	
		
		/* Time to save the menu permissions */
		$this->registry->getClass('class_perms')->savePermissionsMatrix( intval( $this->request['menu_id'] ) );	

	}

	private function _dovEdit()
	{
		/* Lets check our security */
		$this->registry->adminFunctions->checkSecurityKey();

		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		if ( intval($this->request['menu_id']) == intval($this->request['parent']) )
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_parent_error']}", 'PM0003');
		}
		
		/* Init some vars */
		$editVisibility = array();
		$id = intval($this->request['menu_id']);
		$groupID = intval($this->request['group_id']);
		$groupKey = trim($this->request['group_key']);
		$parent = intval($this->request['parent_id']);
		$editVisibility['promenu_view_override']  = intval($this->request['view_override']);
		$viewItem = $this->request['view_menu'];	
			
		foreach ( $viewItem as $view_id => $view)
		{
		$viewItems .= ",".$view;
		}
		$editVisibility['promenu_view_menu']  = $viewItems;					
		/* Lets update the database with the new data */
		$this->DB->update( 'promenu', $editVisibility, 'promenu_id=' . $id );
				
		$this->registry->getClass('class_functions')->recacheMenus();

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$id}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_6']}", $id ));				
		
		if($this->request['return'])
		{
			$this->registry->output->global_message = sprintf( $this->lang->words['promenu_menu_visibile_edited'] );
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . 'module=menus&section=menus&do=edit&menu_id={$id}&group_id={$groupID}&group_key={$groupKey}&parent={$parent]}');
		}	
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
		if( is_array($this->request['menus']) AND count($this->request['menus']) )
		{
			/* Time to update the database with the new position */
			foreach( $this->request['menus'] as $this_id )
			{
				$this->DB->update( 'promenu', array( 'promenu_displayorder' => $position ), 'promenu_id=' . $this_id );
				
				$position++;
			}
		}
		$this->registry->getClass('class_functions')->recacheMenus();

		/* output and exit */
		$ajax->returnString( 'OK' );
		exit();
	}
	
	private function _doDelete()
	{
		$id = intval( $this->request['menu_id'] );
		$groupID = intval($this->request['group_id']);

		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		/* Lets delete this menu from the permission index */		
		$this->DB->delete( "permission_index", "app='promenu' AND perm_type='menu' AND perm_type_id=" . intval( $this->request['menu_id'] ) );

		/* Lets delete this menu from the database */		
		$this->DB->delete( "promenu", "promenu_id=" . $id );

		$this->registry->getClass('class_functions')->recacheMenus();

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$id}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_7']}", $id ));	
	}
	
	private function _doDeleteWOKids()
	{	
		$id = intval( $this->request['menu_id'] );
		$groupID = intval($this->request['group_id']);

		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		/* Lets turn any children this menu might have into parents */
		$this->DB->update( "promenu",
			array( "promenu_parent_id"	=>	0 ),
			"promenu_parent_id=" . $id
		);

		/* Lets delete this menu from the permission index */		
		$this->DB->delete( "permission_index", "app='promenu' AND perm_type='menu' AND perm_type_id=" . $id );

		/* Lets delete this menu from the database */		
		$this->DB->delete( "promenu", "promenu_id=" . $id );

		$this->registry->getClass('class_functions')->recacheMenus();

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$id}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_7']}", $id ));	
	}
	
	private function _doDeleteWKids()
	{
		/* Check for a group ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['group_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_id']}", 'PG0003');	
		}
		
		/* Check for a group key, if one isn't present we show an error */
		if ( !strlen( trim($this->request['group_key']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_key']}", 'PG0004');	
		}

		/* Check for a menu ID, if one isn't present we show an error */
		if ( !strlen( intval($this->request['menu_id']) ) ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_menu_id']}", 'PM0004');
		}
		
		$id = intval($this->request['menu_id']);
		
		$groupID = intval($this->request['group_id']);
		
		$groupKey = trim($this->request['group_key']);
		
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$menudata = $this->registry->getClass('class_menus')->get_menu_query($groupKey);
		
	    $menus = $this->GetTheKidID($menudata, $id);
	 		
		if ($menus)
		{	
			foreach ( $menus as $menu_id => $menu)
			{
				if ( $this->settings['promenu_group_perm_view'] != 1 )
				{
					$this->DB->delete( "permission_index", "app='promenu' AND perm_type_id='{$menu}'" );
				}
				$this->DB->delete( "promenu", "promenu_id='{$menu}'");
				
				//-----------------------------------------
				// Log this action to the Admin Log  
				//-----------------------------------------
				$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$menu}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_7']}", $menu ));	
			}
		}

		if ( $this->settings['promenu_group_perm_view'] != 1 )
		{
			$this->DB->delete( "permission_index", "app='promenu' AND perm_type_id='{$id}'" );
		}
		$this->DB->delete( "promenu", "promenu_id='{$id}'");			    

		$this->registry->getClass('class_functions')->recacheMenus();

		//-----------------------------------------
		// Log this action to the Admin Log  
		//-----------------------------------------
		$groupTitle = $this->registry->getClass('class_groups')->get_group_title($groupID);
		
		$this->registry->getClass('adminFunctions')->saveAdminLog(sprintf( "{$this->lang->words['promenu_edit_menu_log_4']} '{$id}' {$this->lang->words['promenu_edit_menu_log_2']} {$groupTitle} {$this->lang->words['promenu_edit_menu_log_7']}", $id ));	
	}

	private function GetTheKidID($menudata,$parent)
	{
		foreach($menudata as $k => $p)
		{
			if($p['promenu_parent_id'] == $parent)
			{
				$subs = $this->registry->getClass('class_functions')->CheckChildrenTree($menudata, $parent);
				$ids[] = $p['promenu_id'];
				if($subs == 1)
				{
					$kids = $this->GetTheKidID($menudata, $p['promenu_id']);
					if(count($kids))
					{
						$ids = array_merge($ids,$kids);
					}
				}
			}
			
		}
		return $ids;
	}
}