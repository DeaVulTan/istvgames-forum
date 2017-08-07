<?php

/**
 * User Notifications
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

/**
 * Notification types
 */
class feedback_notifications
{
	public function getConfiguration()
	{
		ipsRegistry::instance()->class_localization->loadLanguageFile( array( 'public_notifications' ), 'feedback' );
		
		$_NOTIFY	= array(
							array( 'key' => 'notify_new_feedback', 'default' => array( 'inline' ), 'disabled' => array(), 'icon' => 'notify_feedback' )
							);
		return $_NOTIFY;
	}
}