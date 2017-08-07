<?php

//-----------------------------------------------
// (DP32) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Application
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 23 / 07 / 2009
// Updated on: 27 / 01 / 2012
//-----------------------------------------------
// Copyright (C) 2010-2012 DawPi
// All Rights Reserved
//-----------------------------------------------   

class admin_masspm_settings_settings extends ipsCommand
{
	public $html;
	
	public function doExecute( ipsRegistry $registry )
	{
		$this->form_code    = '&amp;module=settings&amp;section=settings';
		$this->form_code_js = '&module=settings&section=settings';

        /* Check access */
       
        $this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'view_settings' );
       	
		/* Do the job */
        
        self::settings();

		$this->registry->output->html .= $this->registry->masspmLibrary->c_acp();
		$this->registry->output->sendOutput();
	}
	
	public function settings()
	{			
		//-----------------------------------------
		// Set up stuff
		//-----------------------------------------
		
		$this->form_code	= 'module=settings&amp;section=settings';
		$this->form_code_js	= 'module=settings&section=settings';
		
		//-------------------------------
		// Grab, init and load settings
		//-------------------------------
		
		$classToLoad	= IPSLib::loadLibrary( IPSLib::getAppDir( 'core' ).'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings		= new $classToLoad( $this->registry );
		$settings->makeRegistryShortcuts( $this->registry );
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_tools' ), 'core' );
		
		$settings->html			= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );		
		$settings->form_code	= $settings->html->form_code    = 'module=settings&amp;section=settings';
		$settings->form_code_js	= $settings->html->form_code_js = 'module=settings&section=settings';

		$this->request['conf_title_keyword'] = 'masspm';
		$settings->return_after_save         = $this->settings['base_url'] . $this->form_code . '&amp;do=settings';
		$settings->_viewSettings();
		
		//-----------------------------------------
		// Pass to CP output hander
		//-----------------------------------------
		
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();		
	}
}// End of class