<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			overview.php
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
 
class admin_promenu_overview_overview extends ipsCommand
{
	public $html;
	
	public function doExecute( ipsRegistry $registry )
	{
		/* Load Languages */
		$this->registry->class_localization->loadLanguageFile( array( 'admin_tools' ), 'core' );
		$this->registry->class_localization->loadLanguageFile( array( 'admin_lang' ), 'promenu' );
		
		if ( ipsRegistry::$vn_full >= 32000 ) {
			$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'core' ) . '/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
			$this->settingsClass		= new $classToLoad();
			$this->settingsClass->makeRegistryShortcuts( $this->registry );
			$this->settingsClass->html				= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
			$this->settingsClass->form_code			= $this->settingsClass->html->form_code		=  'module=overview&amp;section=overview';
			$this->settingsClass->form_code_js		= $this->settingsClass->html->form_code_js	= 'module=overview&section=overview';
			$this->settingsClass->return_after_save	= $this->settings['base_url'] . $this->settingsClass->form_code;
		}

		/* Grab, init and load settings */
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir('core').'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings    = new $classToLoad();
		$settings->makeRegistryShortcuts( $this->registry );
		
		/* Load Templates*/	
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_overview' );		
		$this->form_code    = 'module=overview&amp;section=overview';
		$this->form_code_js = 'module=overview&section=overview';

		$this->registry->output->ignoreCoreNav = TRUE;
		
		// Lets build the new breadcrumb
		$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );	
				
		/* Which do .. do we do? :O */
		switch( $this->request['do'] )
		{
			case "view":
				$this->_View();
				break;
			case "file":
				$this->_file();
				break;
			case "delete":
				$this->_delete();
				break;				
			default:
				$this->_View("0");
				break;
		}
		
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();			
	}
	private function _View($do)
	{
		if($this->request['do'] == 'bug')
		{
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . $this->form->code, $this->lang->words['promenu_overview'] );		
		}
		else 
		{
		$this->registry->output->extra_nav[] = array( '', $this->lang->words['promenu_overview'] );
		}
		// Display a function from the skin file
		$this->registry->output->html .= $this->html->overview($do);
	}	
	private function _file()
	{
		/* Lets check the email */
		if ( !IPSText::checkEmailAddress( $this->request['contact'] ) ) {
			ipsRegistry::getClass("output")->showError( "{$this->lang->words['promenu_email']}", "{$this->lang->words['promenu_invalid_email']}", false, "", 500 );
		}
		/* Did we have content to send? */
		if(!$this->request['report'])
		{
			ipsRegistry::getClass("output")->showError( "{$this->lang->words['promenu_bug_desc']}", "{$this->lang->words['promenu_no_bug']}", false, "", 500 );
		}
				IPSText::getTextClass('bbcode')->parse_html				= 1;
				IPSText::getTextClass('bbcode')->parse_nl2br			= 1;
				IPSText::getTextClass('bbcode')->parse_smilies			= 1;
				IPSText::getTextClass('bbcode')->parse_bbcode			= 1;
				IPSText::getTextClass('bbcode')->parsing_mgroup			= $this->memberData['member_group_id'];
				IPSText::getTextClass('bbcode')->parsing_mgroup_others	= $this->memberData['mgroup_others'];
				/* Lets build the email and send it */	
				$body = IPSText::getTextClass('bbcode')->preDisplayParse($_POST['report']);
				$body = IPSText::getTextClass('bbcode')->preDisplayParse($body);	
				$message = $this->lang->words['promenu_contact'].$this->memberData['name']."<br>".$this->lang->words['promenu_contact_email'].$this->request['contact']."<br>".$this->lang->words['promenu_site'].$this->settings['board_url']."<br>".$this->lang->words['promenu_version'].$this->caches['app_cache']['promenu']['app_version']."<br>".$this->lang->words['promenu_version_ipb'].IPB_VERSION."<br>".$this->lang->words['promenu_bug_message']."<br>".$_POST['report'];
				//$message = stripslashes( IPSText::getTextClass('email')->cleanMessage( $message ) );
				$message = IPSText::getTextClass('bbcode')->preDisplayParse($message);
				$body = IPSText::getTextClass('bbcode')->preDisplayParse($message);	
				IPSText::getTextClass('email')->setHtmlEmail(TRUE);
				IPSText::getTextClass('email')->message = $body;										
				IPSText::getTextClass('email')->subject = "{$this->lang->words['promenu_contact']}".$this->settings['board_url'];
				IPSText::getTextClass('email')->from    = ""; 			
				IPSText::getTextClass('email')->to      = "";
				IPSText::getTextClass('email')->sendMail();
				
				/* Init some vars */
				$addbug = array();

			
				/* Lets build an array to feed to the database */
				$addbug['promenu_bugs_submitter']  	= addslashes($this->memberData['member_id']);
				$addbug['promenu_bugs_contact']		= addslashes($this->request['contact']);
				$addbug['promenu_bugs_report']		= IPSText::getTextClass('bbcode')->preDbParse($_POST['report']);
				$addbug['promenu_bugs_date']		= time();
				$addbug['promenu_bugs_sent']		= "0";

				/* Lets insert the array and build a bug report */
				$this->DB->insert(
				"promenu_bugs",
				$addbug
				);
				
		$this->_View("return");				
	}
	
	public function _delete()
	{
		/* Lets check our security */
		//$this->registry->adminFunctions->checkSecurityKey();
		
		/* We can now delete this bug report */
		$this->DB->delete( "promenu_bugs", "promenu_bugs_id=" . intval( $this->request['id'] ) );
		$this->_View("1");
	}
	
}

