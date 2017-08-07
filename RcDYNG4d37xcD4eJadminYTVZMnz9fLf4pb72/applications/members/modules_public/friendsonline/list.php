<?php

/**
 * Product Title:		(SOS34) Friends Online
 * Product Version:		1.3.1
 * Author:				Adriano Faria
 * Website:				SOS Invision
 * Website URL:			http://forum.sosinvision.com.br/
 * Email:				administracao@sosinvision.com.br
 */
 
if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
} 

class public_members_friendsonline_list extends ipsCommand
{
	/**
	 * Page title
	 *
	 * @var		string
	 */
	protected $_title;
	
	/**
	 * Navigation
	 *
	 * @var		array[ 0 => [ title, url ] ]
	 */
	protected $_navigation;
	
	/**
	 * Error string
	 *
	 * @var		string
	 */
	public $_errorString = '';
	
	/**
	 * Class entry point
	 *
	 * @param	object		Registry reference
	 * @return	@e void		[Outputs to screen/redirects]
	 */
	public function doExecute( ipsRegistry $registry )
	{
		if ( !IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) )
		{
			$this->registry->output->showError( 'no_permission' );
		}

		$this->registry->getClass( 'class_localization')->loadLanguageFile( array( 'public_list' ), 'members' );

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
		$staff	 = array();
		$members = array();
		$active  = array();
		$actives = array();

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
			$active = IPSMember::load( $m_id, 'members,sessions,profile_portal' );
			$active = array_map( array( 'IPSMember', 'buildDisplayData' ), $active );
			$active = array_map( array( 'IPSMember', 'getLocation' ), $active );
        }

		if ( $this->settings['friendsOnline_staff_on'] )
		{
	        if ( count( $staff ) )
	        {
				$actives  = IPSMember::load( $staff, 'members,sessions,profile_portal' );
				$actives  = array_map( array( 'IPSMember', 'buildDisplayData' ), $actives );
				$actives  = array_map( array( 'IPSMember', 'getLocation' ), $actives );
			}
		}

		$this->output .= $this->registry->getClass('output')->getTemplate('mlist')->friendsOnline( $active, $actives );

		//-----------------------------------------
		// Push to print handler
		//-----------------------------------------
		
		$this->registry->output->addContent( $this->output );
		$this->registry->output->setTitle( $this->lang->words['friendsOnline'] . ' - ' . ipsRegistry::$settings['board_name'] );
		$this->registry->output->addNavigation( $this->lang->words['friendsOnline'], 'app=members&module=friendsonline', "false", 'members_list' );
		$this->registry->output->sendOutput();
 	}
}