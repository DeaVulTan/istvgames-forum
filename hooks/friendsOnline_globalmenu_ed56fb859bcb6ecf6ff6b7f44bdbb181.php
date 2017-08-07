<?php

/**
 * Product Title:		(SOS34) Friends Online
 * Product Version:		1.3.1
 * Author:				Adriano Faria
 * Website:				SOS Invision
 * Website URL:			http://forum.sosinvision.com.br/
 * Email:				administracao@sosinvision.com.br
 */
 
class friendsOnline_globalmenu
{
	public $registry;
	public $memberData;
	public $caches;

	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		$this->DB         = $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
	}

	public function getOutput()
	{
		if ( !IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) )
		{
			return;
		}

		if ( IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) AND !$this->memberData['friendsonline_onoff'] )
		{
			return;
		}

		$this->registry->getClass( 'class_localization')->loadLanguageFile( array( 'public_online' ), 'members' );


		if ( ! $this->settings['au_cutoff'] )
		{
			$this->settings['au_cutoff'] = 15;
		}

		//-----------------------------------------
		// Get the users from the DB
		//-----------------------------------------
			
		$cut_off = $this->settings['au_cutoff'] * 60;
		$time    = time() - $cut_off;
		$rows    = array();
		$ar_time = time();

		if ( $this->memberData['member_id'] )
		{
			$rows = array( $ar_time.'.'.md5( microtime() ) => array('id'           => 0,
																	'login_type'   => IPSMember::isLoggedInAnon($this->memberData),
																	'running_time' => $ar_time,
																	'seo_name'     => $this->memberData['members_seo_name'],
																	'member_id'    => $this->memberData['member_id'],
																	'member_name'  => $this->memberData['members_display_name'],
																	'member_group' => $this->memberData['member_group_id'] ) );
		}
			
		$this->DB->build( array( 'select' => 's.*',
								'from'   => array( 'sessions' => 's' ),
			                    'add_join' => array(
									0 => array( 'select' => 'pp.*',
					  	  						'from'   => array( 'profile_portal' => 'pp' ),
 							  					'where'  => 'pp.pp_member_id=s.member_id',
						  						'type'   => 'left' )
                               		),
									'where'  => "s.running_time > {$time}" )	);
		$this->DB->execute();

		//-----------------------------------------
		// FETCH...
		//-----------------------------------------
			
		while ( $r = $this->DB->fetch() )
		{
			$rows[ $r['running_time'].'.'.$r['id'] ] = $r;
		}

		krsort( $rows );

		//-----------------------------------------
		// cache all printed members so we
		// don't double print them
		//-----------------------------------------
			
		$cached  = array();
		$m_id	 = array();
		$members = array();
		$active  = array();
		$total	 = 0;

		$bypass_anon = $this->memberData['g_access_cp'] ? 1 : 0;

		foreach ( $rows as $result )
		{
			if ( empty( $cached[ $result['member_id'] ] ) )
			{
				if ( $this->settings['friendsOnline_staff_on'] )
				{
					if ( !in_array( $result['member_group'], explode( ',', $this->settings['friendsOnline_staff_groups'] ) ) )
					{
						if ( IPSMember::checkFriendStatus( $result['member_id'] ) )
						{
							if ( $result['login_type'] )
							{
								if ( $bypass_anon )
								{
									$cached[ $result['member_id'] ] = 1;
									$m_id[] = $result['member_id'];
								}
							}
							else
							{
								$cached[ $result['member_id'] ] = 1;
								$m_id[] = $result['member_id'];
							}
						}
					}
					else
					{
						if ( $result['login_type'] )
						{
							if ( $bypass_anon )
							{
								$cached[ $result['member_id'] ] = 1;
								$staff[] = $result['member_id'];
							}
						}
						else
						{
							$cached[ $result['member_id'] ] = 1;
							$staff[] = $result['member_id'];
						}
					}
				}
				else
				{
					if ( IPSMember::checkFriendStatus( $result['member_id'] ) )
					{
						if ( $result['login_type'] )
						{
							if ( $bypass_anon )
							{
								$cached[ $result['member_id'] ] = 1;
								$m_id[] = $result['member_id'];
							}
						}
						else
						{
							$cached[ $result['member_id'] ] = 1;
							$m_id[] = $result['member_id'];
						}
					}
				}
			}
		}

        if ( count( $m_id ) )
        {
			$total = count( $m_id );
        }

		if ( !$total )
		{
			if ( !$this->settings['friendsOnline_show'] AND !$this->settings['friendsOnline_staff_on'] )
			{
				return;
			}
			else
			{
				$total = 0;
			}
		}

		return $this->registry->getClass('output')->getTemplate( 'global' )->friendsOnline_globalmenu( $total );
	}
}