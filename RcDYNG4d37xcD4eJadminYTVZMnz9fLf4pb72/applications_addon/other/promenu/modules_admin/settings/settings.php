<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			settings.php
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
 
class admin_promenu_settings_settings extends ipsCommand
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

		$settings->html         = $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
		$this->form_code    = 'module=settings&amp;section=settings';
		$this->form_code_js = 'module=settings&section=settings';	

		/* ok..the breadcrumb needs to be removed and rebuild .. so let's remove it now !!! */
		$this->registry->output->ignoreCoreNav = TRUE;
		
		switch( $this->request['do'] )
		{
			case "display":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_alter_display' );
					
				// Lets build the new breadcrumb
				$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
				$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code, $this->lang->words['promenu_settings'] );
				$this->registry->output->extra_nav[] = array( "", "Enable/Disable" );				
			
				// Lets do the help quide
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_display_setting_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				
				/* Show our settings */
				$this->request['conf_title_keyword'] = 'promenu_group_display';
				$settings->return_after_save         = $this->settings['base_url'] . $this->form_code . '&amp;do=' . $this->request['do'];
				$settings->_viewSettings();
				break;
			case "effects":
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_menu_effects' );
				
				// Lets build the new breadcrumb
				$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
				$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code, $this->lang->words['promenu_settings'] );
				$this->registry->output->extra_nav[] = array( "", "Menu Effects" );
				
				// Lets do the help guide
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_effect_setting_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				
				/* Show our settings */
				$this->request['conf_title_keyword'] = 'promenu_effects_settings';
				$settings->return_after_save         = $this->settings['base_url'] . $this->form_code . '&amp;do=' . $this->request['do'];
				$settings->_viewSettings();
				break;
			default:
				/* Check to make sure the member has perms!!! */
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'app_promenu_alter_group' );
				
				// Lets build the new breadcrumb
				$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
				$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form_code, "Settings" );				
				$this->registry->output->extra_nav[] = array( "", "Global Settings" );	
				
				// Lets do the help guide
				if ( $this->settings['promenu_view_help'] == 1 )
				{
				$this->registry->output->sidebar_extra .= "<ul><li class='active has_sub'>";
				$this->registry->output->sidebar_extra .= "{$this->lang->words['promenu_help_guides']}";
				$this->registry->output->sidebar_extra .= "<ul><li>{$this->lang->words['promenu_general_setting_desc']}</li></ul>";
				$this->registry->output->sidebar_extra .= "</li></ul>";	
				}
				
				/* Show our settings */
				$this->request['conf_title_keyword'] = 'promenu_settings';
				$settings->return_after_save         = $this->settings['base_url'] . $this->form_code;
				$settings->_viewSettings();
				break;			
		}
		// Send It Out!!!
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		 
		$this->registry->getClass('output')->sendOutput();	
	}
}