<?php
class jappn
{
	public $registry;
	public $settings;

	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		require_once( IPSLib::getAppDir('jawards') ."/app_class_jawards.php" );
		if( ! $this->registry->isClassLoaded( 'jawards_core' ) )
		{
			$this->awards = new app_class_jawards( ipsRegistry::instance() );
		}
	}

	public function getOutput()
	{
		return "";
	}

    public function replaceOutput( $output, $key )
	{
		IPSDebug::fireBug( 'info', array( "jappn()", "Loaded Hook" ) ) ;
		return( $this->registry->getClass('jawards_core')->hook_jappn( $output, $key ) );
	}
}
 