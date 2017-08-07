<?php

class shoutboxOnlineTab
{
	protected $registry;
	protected $settings;
	protected $memberData;

	public function __construct()
	{
		/* Make registry objects */
		$this->registry   =  ipsRegistry::instance();
		$this->settings   =& $this->registry->fetchSettings();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}

	public function getOutput()
	{
		/* All the ways we can return nothing */
		if ( !$this->settings['shoutbox_online'] || !$this->memberData['g_shoutbox_view'] || !$this->memberData['g_shoutbox_use'] || $this->memberData['_cache']['shoutbox_banned'] )
		{
			return '';
		}

		/* Our library is loaded? */
		if ( !class_exists('app_class_shoutbox') || !$this->registry->isClassLoaded('shoutboxLibrary') )
		{
			ipsRegistry::getAppClass( 'shoutbox' );
		}

		/* Start me up */
		$this->registry->shoutboxLibrary->_startup();

		/* Run our common 'active users' function */
		$active = $this->registry->shoutboxLibrary->getMembersViewing( false );

		if ( $active['TOTAL'] )
		{
			return $this->registry->output->getTemplate('shoutbox_hooks')->hookOnlineTab( $active['TOTAL'] );
		}
	}
}