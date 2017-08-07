<?php
/**
 * (TB) Display Members Browser
 * @file		tbDmbBoardIndex.php 	Action overloader (public_forums_forums_boards)
 *
 * @copyright	(c) 2006 - 2012 Invision Byte
 * @link		http://www.invisionbyte.net/
 * @author		Terabyte
 * @since		12/05/2012
 * @version		3.0.0 (30000)
 */
class tbDmbBoardIndex extends public_forums_forums_boards
{
	/**
	 * I know it's not a good idea to override without a
	 * parent call but that's the only way right now...
	 * Maybe for IPB 3.4 it will change.. :O
	 */
	public function getActiveUserDetails()
	{
		$active = array( 'TOTAL'   => 0 ,
						 'NAMES'   => array(),
						 'GUESTS'  => 0 ,
						 'MEMBERS' => 0 ,
						 'ANON'    => 0 ,
					   );
		
		if ( $this->settings['show_active'] && $this->memberData['gbw_view_online_lists'] )
		{
			/* (TB) Display Members Browser */
			require_once( IPS_ROOT_PATH . 'sources/classes/useragents/tbDisplayMembersBrowser.php' );
			tbDisplayMembersBrowser::init();
			
			/* Cannot see the image? Return the original function then */
			if ( ! tbDisplayMembersBrowser::canSeeImage() )
			{
				return parent::getActiveUserDetails();
			}
			
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
			
			$this->DB->build( array('select' => 'id, member_id, member_name, seo_name, login_type, running_time, member_group, uagent_type, uagent_key',
									'from'   => 'sessions',
									'where'  => "running_time > {$time}" )	);
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
			
			$cached = array();
			
			foreach ( $rows as $result )
			{
				$last_date = $this->registry->getClass('class_localization')->getDate( $result['running_time'], 'TINY' );
				
				//-----------------------------------------
				// Bot?
				//-----------------------------------------
				
				if ( isset( $result['uagent_type'] ) && $result['uagent_type'] == 'search' )
				{
					/* Skipping bot? */
					if ( ! $this->settings['spider_active'] )
					{
						continue;
					}
					
					//-----------------------------------------
					// Seen bot of this type yet?
					//-----------------------------------------
					
					if ( ! $cached[ $result['member_name'] ] )
					{
						$active['NAMES'][] = IPSMember::makeNameFormatted( $result['member_name'], $result['member_group'] );
						$cached[ $result['member_name'] ] = 1;
					}
					else
					{
						//-----------------------------------------
						// Yup, count others as guest
						//-----------------------------------------
						
						$active['GUESTS']++;
					}
				}
				
				//-----------------------------------------
				// Guest?
				//-----------------------------------------
				
				else if ( ! $result['member_id'] OR ! $result['member_name'] )
				{
					$active['GUESTS']++;
				}
				
				//-----------------------------------------
				// Member?
				//-----------------------------------------
				
				else
				{
					if ( empty( $cached[ $result['member_id'] ] ) )
					{
						$cached[ $result['member_id'] ] = 1;

						$result['member_name'] = IPSMember::makeNameFormatted( $result['member_name'], $result['member_group'] );
						
						/* Reset login type in case the board/group setting got changed */
						$result['login_type']  = IPSMember::isLoggedInAnon( array( 'login_anonymous' => $result['login_type'] ), $result['member_group'] );
						
						if ( $result['login_type'] )
						{
							if ( $this->memberData['g_access_cp'] )
							{
								$active['NAMES'][] = tbDisplayMembersBrowser::getImage( $result, IPSMember::makeProfileLink( $result['member_name'], $result['member_id'], $result['seo_name'], '', $last_date ) . "*" );
								$active['ANON']++;
							}
							else
							{
								$active['ANON']++;
							}
						}
						else
						{
							$active['MEMBERS']++;
							$active['NAMES'][] = tbDisplayMembersBrowser::getImage( $result, IPSMember::makeProfileLink( $result['member_name'], $result['member_id'], $result['seo_name'], '', $last_date ) );
						}
					}
				}
			}

			$active['TOTAL'] = $active['MEMBERS'] + $active['GUESTS'] + $active['ANON'];
			
			$this->users_online = $active['TOTAL'];
		}
		
		$this->lang->words['active_users'] = sprintf( $this->lang->words['active_users'], $this->settings['au_cutoff'] );

		return $active;
	}
}