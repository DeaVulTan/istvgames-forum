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
 
class postNotesNotifyRecache
{
	public $registry;
	public $cache;
	
	public function __construct()
	{
		/* Make registry objects */
		$this->registry		=  ipsRegistry::instance();
		$this->cache		= $this->registry->cache();
	}
	
	public function install()
	{
		$cache					= $this->cache->getCache('notifications');
		$cache['post_notes']	= array( 'selected' => array( 'inline' ), 'disabled' => array(), 'disable_override' => 0, 'app' => 'forums' );
		$this->cache->setCache( 'notifications', $cache, array( 'array' => 1, 'donow' => 1 ) );
	}
}
