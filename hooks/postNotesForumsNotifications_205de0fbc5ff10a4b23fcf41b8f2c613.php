<?php
/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.3
 * Last Updated: October 24, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.1.0 (Revision 10100)
 */
 
class postNotesForumsNotifications extends forums_notifications
{
	public function getConfiguration()
	{
		$_NOTIFY = parent::getConfiguration();

		$_NOTIFY[] = array( 'key' => 'post_notes', 'default' => array( 'inline' ), 'disabled' => array( '' ), 'icon' => 'notify_newreply' );

		return $_NOTIFY;
	}
}
