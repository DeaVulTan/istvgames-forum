<?php

/**
 * Product Title:		(SOS34) Friends Online
 * Product Version:		1.3.1
 * Author:				Adriano Faria
 * Website:				SOS Invision
 * Website URL:			http://forum.sosinvision.com.br/
 * Email:				administracao@sosinvision.com.br
 */

class friendsOnline_usermenu
{
	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		$this->DB         = $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
	}
	
	public function getOutput()
	{
		if ( IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) AND !$this->memberData['friendsonline_onoff'] )
		{
			return $this->registry->getClass( 'output' )->getTemplate( 'global' )->friendsOnline_usermenu();
		}
		
		return false;
	}
}