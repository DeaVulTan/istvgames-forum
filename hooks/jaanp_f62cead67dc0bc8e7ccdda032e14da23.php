<?php
class jaanp extends (~extends~)
{
	public function onPaid( $member, $item, $invoice, $runModule = TRUE )
	{
		IPSDebug::fireBug( 'info', array( "jaanp()", "Loaded Hook" ) );
		IPSDebug::fireBug( 'info', array( $member, "Member" ) );
		IPSDebug::fireBug( 'info', array( $item, "Item" ) );
		ipsRegistry::instance()->getAppClass( 'jawards' ) ;
		ipsRegistry::instance()->getClass('class_jawards')->autoAward( 'NexusPayment', $member['member_id'], $item );
		parent::onPaid( $member, $item, $invoice, $runModule );
	}
}
