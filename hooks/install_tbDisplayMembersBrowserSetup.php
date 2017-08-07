<?php
/**
 * (TB) Display Members Browser
 * @file		install_tbDisplayMembersBrowserSetup.php 	Hook installation script
 *
 * @copyright	(c) 2006 - 2012 Invision Byte
 * @link		http://www.invisionbyte.net/
 * @author		Terabyte
 * @since		12/05/2012
 * @version		3.0.0 (30000)
 */
class tbDisplayMembersBrowserSetup
{
	protected $registry;
	protected $DB;
	protected $cache;
	
	public function __construct( ipsRegistry $registry )
	{
		/* Make object */
		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->cache    = $this->registry->cache();
	}
	
	public function install()
	{
		/* Remove old settings & recache */
		$this->DB->delete( 'core_sys_conf_settings', "conf_key IN ('tb_dmb_enable','tb_dmb_index','tb_dmb_online','tb_dmb_forum','tb_dmb_topic')" );
		
		$this->cache->rebuildCache( 'settings', 'global' );
	}
	
	public function uninstall()
	{
		// Nothing to do here
	}
}