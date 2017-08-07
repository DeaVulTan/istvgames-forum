<?php

class shoutboxActiveUsers
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
		if ( $this->settings['shoutbox_active_groups'] == "" )
		{
			return;
		}

		if ( $this->settings['shoutbox_online'] && in_array( $this->memberData['member_group_id'], explode( ",", $this->settings['shoutbox_active_groups'] ) ) )
		{
			/* Our library is loaded? */
			if( !class_exists('app_class_shoutbox') OR !$this->registry->isClassLoaded('shoutboxLibrary') )
			{
				require_once( IPSLib::getAppDir('shoutbox').'/app_class_shoutbox.php' );
				$app_class_shoutbox = new app_class_shoutbox( ipsRegistry::instance() );
			}

			$this->registry->getClass('shoutboxLibrary')->global_on = true;
			$this->registry->getClass('shoutboxLibrary')->_startup();

			/* Which hook? - Added in 1.1.1 */
			if ( $this->settings['shoutbox_active_hook'] == 's' )
			{
				$hook = 'hookActiveUsersSidebar';
			}
			else
			{
				$hook = 'hookActiveUsers';
			}

			return $this->registry->output->getTemplate('shoutbox_hooks')->$hook( $this->registry->getClass('shoutboxLibrary')->getMembersViewing(false) );
		}

		return '';
	}
}