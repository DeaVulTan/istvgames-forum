<?php
class jaabb
{
	public $registry;
	public $settings;

	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		require_once(IPSLib::getAppDir('jawards') ."/app_class_jawards.php");
		if( ! $this->registry->isClassLoaded( 'jawards_core' ) )
		{
			$this->awards = new app_class_jawards( ipsRegistry::instance() );
		}
	}

	public function handleData($data)
	{
		IPSDebug::fireBug( 'info', array( "jaabb()", "Loaded Hook" ) ) ;
		IPSDebug::fireBug( 'info', array( $data, "Data" ) ) ;
		$this->registry->getClass('class_jawards')->autoAward( 'byBlogs', $data['entry_author_id'], $data );
	}
}
