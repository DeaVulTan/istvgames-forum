<?php

/**
 * Permissions and Sessions
 *
 * @copyright   Copyright (C) 2013, Stuart Silvester
 * @author      Stuart Silvester
 * @package     Trader Feedback
 * @version     1.4.1
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class public_feedback_view_view extends ipsCommand
{
	public function doExecute( ipsRegistry $registry )
	{
        if ( ! $this->registry->permissions->check( 'view', $this->registry->feedback->getPermissions() ) )
        {
			$this->registry->getClass('output')->showError( 'noPermissionApplication', 1901, FALSE, 403 );
		}

		/* Backwards compatibility redirect to new feedback page */
		if(isset($this->request['u']) && intval($this->request['u']))
		{
			$mem = IPSMember::load(intval($this->request['u']));
			$this->registry->output->silentRedirect($this->settings['base_url'] . "showuser={$mem['member_id']}&amp;tab=feedback", $mem['members_display_name'], TRUE, 'showuser');
		}

        $this->registry->output->setTitle( IPSLib::getAppTitle('feedback') );

		if(isset($this->request['action']) && $this->request['action'] != 'overview')
		{
			$this->registry->output->addNavigation( IPSLib::getAppTitle('feedback'), 'app=feedback', 'feedback', 'app=feedback' );
		}

        switch($this->request['action'])
        {
            case 'leave':
                $this->addFeedback($this->request['do']);
            break;
            case 'delete':
                $this->deleteFeedback($this->request['do']);
            break;
            case 'find-member':
                $this->findUser($this->request['username']);
            break;
			default:
            case 'overview':
                $this->feedbackOverview();
            break;
        }

		/* THIS CANNOT BE REMOVED */
		$this->template .= $this->registry->output->getTemplate('feedback')->footer();
		/* THIS CANNOT BE REMOVED */

		$this->registry->output->addContent( $this->template );
        $this->registry->output->sendOutput();
	}

	public function feedbackOverview()
	{
		$first			= isset($this->request['st']) ? intval($this->request['st']) : 0;
		$maxResults		= 20;
		$this->registry->output->setTitle( IPSLib::getAppTitle('feedback') );

		$qry = array(	'select'	=> 'f.*',
						'from'		=> array('feedback' => 'f'),
						'add_join'	=> array(
											array(
												'select'	=> 't.title_seo',
												'from'		=> array( 'topics' => 't' ),
												'type'		=> 'left',
												'where'     => "f.link_type = 't' AND f.link=t.tid"
												)
											),
						'limit'		=> array( $first, $maxResults ),
						'order'		=> 'f.date DESC');

		if(IPSLib::appIsInstalled('classifieds') && $this->settings['fb_linkType'] == 'c')
		{
			$qry['add_join'][0] = array(
										'select'	=> 'c.seo_title as c_title_seo',
										'from'		=> array( 'classifieds_items' => 'c' ),
										'type'		=> 'left',
										'where'     => "f.link_type = 'c' AND f.link=c.item_id"
										);
		}

		$mx = $qry;
		$mx['select'] = 'count(id) as cnt';
		unset($mx['limit'], $mx['order'], $mx['add_join']);

		$_max = $this->DB->buildAndFetch( $mx );

		$pages = $this->registry->output->generatePagination(  array( 'totalItems'			=> $_max['cnt'],
																	  'itemsPerPage'		=> $maxResults,
																	  'currentStartValue'	=> $first,
																	  'seoTitle'			=> 'a',
																	  'seoTemplate'			=> 'feedback',
																	  'baseUrl'				=> 'app=feedback' ));

		$this->DB->build( $qry );
		$this->DB->execute();

		/* Is viewer a moderator */
		$moderate = $this->registry->permissions->check( 'moderate', $this->registry->feedback->getPermissions() ) ? TRUE : FALSE;

		$feedback = array();
		$users = array();

		$type = array(	0 => $this->lang->words['buyer'],
						1 => $this->lang->words['seller'],
						2 => $this->lang->words['trader']);

		while($r = $this->DB->fetch())
		{
			$r['badge'] = $this->registry->feedback->badges[$r['score']];
			$feedback[$r['id']] = $r;
			$feedback[$r['id']]['type'] = $type[$r['type']];
			$users[$r['receiver']] = $r['receiver'];
			$users[$r['sender']] = $r['sender'];
		}

		$loadedUsers = IPSMember::load($users);

		foreach($loadedUsers as $k => $v)
		{
			$loadedUsers[$k]['members_display_name'] = IPSMember::makeNameFormatted($v['members_display_name'], $v['member_group_id']);
		}

		/* Get cached stats */
		$stats					=	array();
		$stats['global']		=	$this->caches['feedbackIndexStatistics'];
		$stats['top_members']	=	$this->caches['feedbackTopMembers'];

		$this->template .=	$this->registry->output->getTemplate('feedback')->feedbackIndex($feedback, $loadedUsers, $icons, $stats, $pages, $moderate);
	}

	public function findUser($user)
	{
		$user = $this->DB->addSlashes($user);

		if( ! $user )
		{
			$this->registry->getClass('output')->showError( 'no_username', 1905, FALSE, 404 );
			return;
		}

		$this->DB->build(array(	'select'=> 'member_id, members_display_name',
								'from'	=> array('members' => 'm'),
								'where' => "members_display_name LIKE '{$user}%'"));
		$x = $this->DB->execute();

		if(!$this->DB->getTotalRows($x))
		{
			/* No user found */
			$this->registry->output->redirectScreen( $this->lang->words['fb_nouser'], $this->settings['base_url'] . 'app=feedback', 'a', 'app=feedback' );
			return;
		}
		elseif($this->DB->getTotalRows($x) == 1)
		{
			$mem = $this->DB->fetch($x);
			/* Redirect, one user found */
			$this->registry->output->silentRedirect($this->settings['base_url'] . "showuser={$mem['member_id']}&amp;tab=feedback", $mem['members_display_name'], TRUE, 'showuser');
		}
		else
		{
			$this->registry->class_localization->loadLanguageFile( array( 'public_list' ), 'members' );
			$this->registry->output->addNavigation( $this->lang->words['find_member'] );
			$users = array();
			while($usrs = $this->DB->fetch($x))
			{
				$users[$usrs['member_id']] = $usrs['member_id'];
			}

			$users = IPSMember::load($users);

			if( ! ipsRegistry::isClassLoaded( 'repCache' ) )
			{
				$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/class_reputation_cache.php', 'classReputationCache' );
				ipsRegistry::setClass( 'repCache', new $classToLoad() );
			}

			foreach($users as $k => $v)
			{
				$member							= $v;
				$member							= IPSMember::buildProfilePhoto( $member );
				$member['pp_reputation_points'] = $member['pp_reputation_points'] ? $member['pp_reputation_points'] : 0;
				$member['author_reputation']	= ipsRegistry::getClass( 'repCache' )->getReputation( $member['pp_reputation_points'] );
				$users[$k]						= $member;
			}
			$this->template .= $this->registry->output->getTemplate('feedback')->userList($users, $user);
		}
	}

	public function addFeedback($userid)
	{
		$this->registry->output->setTitle( $this->lang->words['leave_title'] );

        if ( ! $this->registry->permissions->check( 'add', $this->registry->feedback->getPermissions() ) )
        {
			$this->registry->getClass('output')->showError( 'noPermissionApplication', 1901, FALSE, 403 );
		}

		if( $userid == $this->memberData['member_id'] )
		{
			$this->registry->getClass('output')->showError($this->lang->words['silly_you'], 1944, FALSE, 401 );
		}

		/* Flood control check */
		$this->_floodControl();

		$user = IPSMember::load($userid);

		if( ! count($user) )
		{
			$this->registry->getClass('output')->showError($this->lang->words['notuser'], 1924, FALSE, 404 );
		}

		$captchaHTML = '';
		if( $this->settings['fb_enableCaptcha'] )
		{
			$captchaHTML = $this->registry->getClass('class_captcha')->getTemplate();
		}

		/* More breadcrumbs - Messy eater */
		$this->registry->output->addNavigation( $user['members_display_name'], "showuser={$userid}&amp;tab=feedback", $user['members_seo_name'], 'showuser' );
		$this->registry->output->addNavigation( $this->lang->words['leave_title'] );

		if(isset($this->request['leaving']) && $this->request['leaving'] >= 0 && $this->request['leaving'] <= 2)
		{
			if( $this->settings['fb_enableCaptcha'] )
			{
				if(!$this->registry->getClass('class_captcha')->validate())
				{
					$optional = !$this->settings['fbrequiretopic'] ? TRUE : FALSE;
					$error = $this->lang->words['fb_captcha_error'];
					$this->template .= $this->registry->output->getTemplate('feedback')->leave($user, $optional, $captchaHTML, $error);
					return;
				}
			}

			/* A user is attempting to leave feedback*/
			$this->link = $this->_getIdFromUrl();

			/* Error out if link required, and it's invalid */
			if($this->settings['fbrequiretopic'] && strlen($this->link['id']) == 0)
			{
				/* Ouch, you missed a field that's needed */
				$optional = !$this->settings['fbrequiretopic'] ? TRUE : FALSE;
				$error = $this->lang->words['fb_invalid_link'];
				$this->template .= $this->registry->output->getTemplate('feedback')->leave($user, $optional, $captchaHTML, $error);
				return;
			}

			if($this->_checkFeedbackFields())
			{
				$this->DB->insert( 'feedback',
									array(	'date'		=> time(),
											'sender'	=> $this->memberData['member_id'],
											'receiver'	=> $userid,
											'note'      => $this->request['comment'],
											'ip'		=> $_SERVER['REMOTE_ADDR'],
											'score'     => $this->request['leaving'],
											'link_type' => $this->link['type'],
											'link'      => $this->link['id'],
											'type'      => $this->request['role']
										)
								);

				/* Support for the content spy application */
				if(IPSLib::appIsInstalled( 'spy' ))
				{
					$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'spy' ) . "/sources/spyLibrary.php", 'spyLibrary' );
					$this->spyLibrary = new $classToLoad( ipsRegistry::instance() );
					$data = array(	'app'		=>	'feedback',
									'data_type' =>	'new_feedback',
									'type'		=>	'score',
									'type_id'	=>	$this->request['leaving'],
									'type_2'	=>	'member',
									'type_2_id'	=>	$userid,
									'member_id'	=>	$this->memberData['member_id'],
									'approved'	=>	1);
					$this->spyLibrary->insertStreamData($data);
				}

				/* 1, 2, 3 count score */
				$this->registry->feedback->recountMembersScore($userid);

				/* Rebuild the stats cache */
				ips_cacheRegistry::rebuildCache('feedbackIndexStatistics', 'feedback');
				ips_cacheRegistry::rebuildCache('feedbackTopMembers', 'feedback');

				$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
				$notifyLibrary = new $classToLoad( ipsRegistry::instance() );

				$user['language'] = $user['language'] == "" ? IPSLib::getDefaultLanguage() : $user['language'];

				$ndata = array('NAME'		=> $user['members_display_name'],
							   'OWNER'		=> $this->memberData['members_display_name'],
							   'URL'		=> $this->settings['base_url'] . 'app=core&amp;module=usercp&amp;tab=core&amp;area=notifications' );

				IPSText::getTextClass('email')->getTemplate( 'notify_new_feedback', $user['language'], 'public_notifications', 'feedback' );
				IPSText::getTextClass('email')->buildMessage( $ndata );
				IPSText::getTextClass('email')->subject	= sprintf(
																	IPSText::getTextClass('email')->subject,
																	$this->registry->output->buildSEOUrl( 'showuser=' . $this->memberData['member_id'], 'public', $this->memberData['members_seo_name'], 'showuser' ),
																	$this->memberData['members_display_name'],
																	$this->registry->output->buildSEOUrl( 'showuser='.$user['member_id'].'&amp;tab=feedback', 'public', $user['members_seo_name'], 'showuser' )
																);
				$notifyLibrary->setMember( $user );
				$notifyLibrary->setFrom( $this->memberData );
				$notifyLibrary->setNotificationKey( 'notify_new_feedback' );
				$notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
				$notifyLibrary->setNotificationTitle( IPSText::getTextClass('email')->subject );
				try
				{
					$notifyLibrary->sendNotification();
				}
				catch( Exception $e ){}

				$this->registry->output->redirectScreen( $this->lang->words['feedback_left'], $this->settings['base_url'] . 'showuser='.$user['member_id'].'&amp;tab=feedback', $user['members_seo_name'], 'showuser' );
			}
			else
			{
				/* Ouch, you missed a field that's needed */
				$optional = !$this->settings['fbrequiretopic'] ? TRUE : FALSE;
				$error = $this->lang->words['feedback_empty_field'];
				$this->template .= $this->registry->output->getTemplate('feedback')->leave($user, $optional, $captchaHTML, $error);
			}
		}
		else
		{
			/* Optional ? */
			$optional = !$this->settings['fbrequiretopic'] ? TRUE : FALSE;
			$this->template .= $this->registry->output->getTemplate('feedback')->leave($user, $optional, $captchaHTML);
		}
	}

	public function deleteFeedback($id)
	{
		if ( ! $this->registry->permissions->check( 'moderate', $this->registry->feedback->getPermissions() ) )
        {
			$this->registry->getClass('output')->showError( 'noperms', 1951, FALSE, 403 );
		}

		/* Find the feedback */
		$fb = $this->DB->buildAndFetch(array(	'select'	=> 'f.id, f.receiver, f.sender, f.score',
												'from'		=> array('feedback' => 'f'),
												'where'		=> 'f.id='.$id));

		if(!count($fb))
		{
			$this->registry->output->showError($this->lang->words['deletebad'], 1961, FALSE, 403);
		}

		$user = IPSMember::load($fb['receiver']);

		if(isset($this->request['confirm']))
		{
			/* Actually get rid of it */
			$this->DB->delete('feedback', 'id='.$id);

			/* That pointless (currently) score */
			$this->registry->feedback->recountMembersScore($fb['receiver']);

			/* Rebuild the stats cache */
			ips_cacheRegistry::rebuildCache('feedbackIndexStatistics', 'feedback');
			ips_cacheRegistry::rebuildCache('feedbackTopMembers', 'feedback');

			/* Back to the profile */
			$this->registry->output->redirectScreen($this->lang->words['deleteok'], $this->settings['base_url'] . 'showuser='.$user['member_id'].'&amp;tab=feedback', $user['members_seo_name'], 'showuser');
		}
		else
		{
			$this->template .= $this->registry->output->getTemplate('feedback')->deleteFeedback($fb, $user);
		}
	}

	/**
	 * Takes an input url and extracts the id
	 */
	protected function _getIdFromUrl()
	{
		if($this->settings['fb_linkType'] == 'c')
		{
		    $tmp = strtr($this->registry->feedback->getClassifiedsIdFromUrl(), array(
	            'http://' => '', 'https://' => '', 'www.' => ''
	        ));
            $type = 'c';
	        if (strpos($tmp, str_replace('www.', '', $_SERVER['SERVER_NAME'])) === 0) {
	            $type = 'v';
	        }
		
		
			return array(	'type'	=> $type,
							'id'	=>	$this->registry->feedback->getClassifiedsIdFromUrl());
		}
		else
		{
			return array(	'type'	=> 't',
							'id'	=>	$this->registry->feedback->getTopicIdFromUrl());
		}
	}

	private function _checkFeedbackFields()
	{
		if(	isset($this->request['role']) &&
			isset($this->request['leaving']) &&
			isset($this->request['comment']) && !empty($this->request['comment']))
		{
			return TRUE;
		}

		return FALSE;
	}

	private function _floodControl()
	{
		/* No time set ? OR We can bypass ? */
		if(	!$this->settings['fb_floodControl'] ||
			IPSMember::isInGroup( $this->memberData, explode( ',', $this->settings['fb_floodControlBypass'] )))
		{
			return;
		}

		$check = time() - $this->settings['fb_floodControl'];

		$this->DB->buildAndFetch(array(	'select'	=> 'id',
										'from'		=> array('feedback' => 'f'),
										'where'		=> 'f.date >'.$check.' AND f.sender='.$this->memberData['member_id']));

		/* Trying too much */
		if($this->DB->getTotalRows() > 0)
		{
			$this->registry->getClass('output')->showError( sprintf( $this->lang->words['fb_flood_control'], $this->settings['fb_floodControl']), 1902, FALSE, 401 );
		}
	}
}
