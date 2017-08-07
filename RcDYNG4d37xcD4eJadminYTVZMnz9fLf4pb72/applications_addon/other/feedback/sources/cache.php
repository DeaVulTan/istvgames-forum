<?php

/**
 * Cache rebuild methods
*/

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class feedbackCache
{
	function __construct( ipsRegistry $registry)
	{
		/* shortcut setup */
		$this->registry = $registry;
		$this->cache	= $this->registry->cache();
		$this->DB		= $registry->DB();
	}

	/**
	 * Find the timestamp of the last content update
	 */
	public function indexStatistics()
	{
		$total			= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
															'from'	=> array('feedback' => 'f')));

		$data['pos']		= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
															'from'	=> array('feedback' => 'f'),
															'where'	=> 'score=2' ) );

		$data['neut']	= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
															'from'	=> array('feedback' => 'f'),
															'where' => 'score=1' ) );

		$data['neg']		= $this->DB->buildAndFetch( array(	'select'=> 'count(id) as cnt',
															'from'	=> array('feedback' => 'f'),
															'where' => 'score=0' ) );

		$ins = array(	'positive'	=> $data['pos']['cnt'],
						'neutral'	=> $data['neut']['cnt'],
						'negative'	=> $data['neg']['cnt'],
						'total'		=> $total['cnt']);

		if (!$data['pos']['cnt'] || !$total['cnt'])
		{
			$ins['percent'] = 'N/A ';
		}
		else
		{
			$ins['percent'] = round((100 / ($data['pos']['cnt'] + $data['neut']['cnt'] + $data['neg']['cnt']) * $data['pos']['cnt']), 1);
		}

		$this->cache->setCache( 'feedbackIndexStatistics', $ins, array( 'array' => 1, 'donow' => 1 ) );
	}

	public function topMembers()
	{
		$members	=	array();
		$t =	$this->DB->build( array('select'=> 'm.member_id, m.members_display_name, m.members_seo_name',
										'from'	=> array('members' => 'm'),
										'where'	=> 'feedb_pos > 0 OR feedb_neu > 0 AND feedb_neg = 0',
										'order' => 'm.feedb_percent DESC, m.feedb_pos DESC',
										'limit' => array(0, 5) ));
		$r = $this->DB->execute($t);

		if($this->DB->getTotalRows($r))
		{
			while($m = $this->DB->fetch($r))
			{
				$h = IPSMember::buildProfilePhoto($m['member_id']);
				$members[$m['member_id']]	=	array(		'member_id'				=>	$m['member_id'],
														'members_display_name'	=>	$h['members_display_name'],
														'members_seo_name'		=>	$h['members_seo_name'],
														'pp_small_photo'		=>	$h['pp_small_photo'],
														'feedb_pos'				=>	$h['feedb_pos'],
														'feedb_neu'				=>	$h['feedb_neu'],
														'feedb_percent'			=>	$h['feedb_percent']);
			}
		}

		$this->cache->setCache( 'feedbackTopMembers', $members, array( 'array' => 1, 'donow' => 1 ) );
	}
}
?>