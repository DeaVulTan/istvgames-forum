<?php

/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.1
 * Last Updated: August 30, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.0.6 (Revision 10006)
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class task_item
{
	protected $class;
	protected $task			= array();
	protected $restrict_log	= false;

	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $cache;

	public function __construct( ipsRegistry $registry, $class, $task )
	{
		$this->registry	= $registry;
		$this->DB		= $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->lang		= $this->registry->getClass('class_localization');
		$this->member	= $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache	= $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();

		$this->class	= $class;
		$this->task		= $task;
	}

	public function runTask()
	{
		ipsRegistry::getClass( 'class_localization')->loadLanguageFile( array( 'public_forums' ) );

		/* Select notes where there is no corresponding post */
		$this->DB->build( array( 'select'	=> 'pn.pn_id, pn.pn_pid',
								 'from'		=> array( 'post_notes' => 'pn' ),
								 'add_join' => array( array( 'select' => 'pid',
															 'from'   => array( 'posts' => 'p' ),
															 'where'  => 'pn.pn_pid = p.pid',
															 'type'   => 'left' ) ),
								 'where'	=> 'p.pid IS NULL' ) );

		$this->DB->execute();

		$pnid = array();
		while ( $row = $this->DB->fetch() )
		{
			$pnid[] = $row['pn_id'];
		}
		
		/* implode array of id(s) to use in query */
		$pnids = implode(",", $pnid);

		if( count($pnid) )
		{
			$this->DB->delete( 'post_notes', "pn_id IN ( {$pnids} )" );

			/* Log only if there are ids to remove */
			$this->class->appendTaskLog( $this->task, $this->lang->words['pn_removed_task'] . $pnids );
		}

		/* And finaly unlock task */		
		$this->class->unlockTask( $this->task );
	}

}
