<?php
//-----------------------------------------------
// (DP34) Mass PM
//-----------------------------------------------
//-----------------------------------------------
// Library
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 26 / 05 / 2011
//-----------------------------------------------
// Copyright (C) 2009-2012 DawPi
// All Rights Reserved
//-----------------------------------------------   

if ( !defined('IN_IPB') )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class masspmLibrary
{
	/**
	 * Registry objects
	 *
	 * @access	public
	 * @var		object
	 */
	public $registry;

	/**
    * Constructor
    *
    * @access	public
    * @param	object		ipsRegistry reference
    * @return	void
    */
	public function __construct( $registry )
	{
		/* Make registry objects */
		$this->registry   = ipsRegistry::instance();
		$this->DB	    = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->cache	= $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();		
	}
			
	/**
	 * Add Copyright Statement
	 *
	 * @access	public
	 * @author	DawPi
	 * @return	string	Processed HTML
	 */
	 
	public function c_acp()
	{
		return "<div id='footer' style='margin: 0px; text-align: center;-moz-border-radius:5px;'>Перевод <strong>" . IPSLib::getAppTitle( 'masspm' ) . " " . $this->caches['app_cache']['masspm']['app_version'] . "</strong> &copy; 2009" . ( '2009' != date( 'Y' ) ?  '-' . date( 'Y' ) : '' ) . " &nbsp;<a target='_blank' href='http://www.ipbzona.ru/' title='Русские хуки, моды и стили.'>IpbZona.ru</a></div>";
	}
	
	public function small_c_acp()
	{
		return "<div id='board_footer' style='-moz-border-radius:5px;'><p id='copyright' class='right'>Перевод " . IPSLib::getAppTitle( 'masspm' ) . " " . $this->caches['app_cache']['masspm']['app_version'] . " &copy; <a target='_blank' href='http://www.ipbzona.ru/' title='Русские хуки, моды и стили.'>IpbZona.ru</a></p></div>";
	}		
} // End of class	