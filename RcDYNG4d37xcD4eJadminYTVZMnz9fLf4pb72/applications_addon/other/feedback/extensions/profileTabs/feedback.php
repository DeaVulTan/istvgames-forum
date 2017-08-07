<?php

/**
 * Profile Plugin
*/

class profile_feedback extends profile_plugin_parent
{
	public function return_html_block( $member=array() )
	{
		$first			= 0;
		$maxResults		= 20;
		$filter 		= 'all';

		$first		= isset($this->request['st']) ? intval($this->request['st']) : 0;
		$filter		= !empty($this->request['filter']) ? $this->request['filter']	: 'all';

		$theFilterKey	= array(
								'all'	=> 'f.receiver='.$member['member_id'],
								'buyer'	=> 'f.receiver='.$member['member_id'].' AND f.type=1',
								'seller'=> 'f.receiver='.$member['member_id'].' AND f.type=0',
								'swap'	=> 'f.receiver='.$member['member_id'].' AND f.type=2',
								'others'=> 'f.sender='.$member['member_id']
								);

		$filterKey = $filter;
		$filter	= isset($theFilterKey[ $filter ]) ? $theFilterKey[ $filter ] : 'f.receiver='.$member['member_id'];

		/* Get App Class */
		IPSRegistry::getAppClass('feedback');

		if ( $this->registry->permissions->check( 'view', $this->registry->feedback->getPermissions() ) )
		{
			$qry = array(	'select'	=> 'f.*',
							'from'		=> array('feedback' => 'f'),
							'add_join'	=> array(
												array(
													'select'	=> 't.title_seo',
													'from'		=> array( 'topics' => 't' ),
													'type'		=> 'left',
													'where'     => 'f.link=t.tid'
													)
												),
							'where'		=> $filter,
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

			$filLink = ($filterKey == 'all') ? '' : '&amp;filter='.$filterKey;
			$pages = $this->registry->output->generatePagination(  array( 'totalItems'			=> $_max['cnt'],
																		  'itemsPerPage'		=> $maxResults,
																		  'currentStartValue'	=> $first,
																		  'seoTitle'			=> $member['members_seo_name'],
																		  'seoTemplate'			=> 'showuser',
																		  'baseUrl'				=> 'showuser='.$member['member_id'].'&amp;tab=feedback'.$filLink ));

			$this->DB->build( $qry );

			$this->DB->execute();
			$feedback = array();
			$users = array();

			$type = array(	0 => $this->lang->words['buyer'],
							1 => $this->lang->words['seller'],
							2 => $this->lang->words['trader']);

			while($r = $this->DB->fetch())
			{
				if($filterKey == 'others')
				{
					$r['sender'] = $r['receiver'];
					$r['type'] = intval($r['type']);

					if($r['type'] == 0)
					{
						$r['type'] = 1;
					}
					elseif($r['type'] == 1)
					{
						$r['type'] = 0;
					}
				}
				$r['badge'] = $this->registry->feedback->badges[$r['score']];
				$feedback[$r['id']] = $r;
				$feedback[$r['id']]['type'] = $type[$r['type']];
				$users[$r['sender']] = $r['sender'];
			}

			$loadedUsers = IPSMember::load($users);

			foreach($loadedUsers as $k => $v)
			{
				$loadedUsers[$k]['members_display_name'] = IPSMember::makeNameFormatted($v['members_display_name'], $v['member_group_id']);
			}

			/* Is viewer a moderator */
			$moderate = $this->registry->permissions->check( 'moderate', $this->registry->feedback->getPermissions() ) ? TRUE : FALSE;

			$content = $this->registry->output->getTemplate('feedback')->profilePage($member, $feedback, $loadedUsers, $pages, $moderate);
		}

		/* THIS CANNOT BE REMOVED */
		$content .= $this->registry->output->getTemplate('feedback')->footer();
		/* THIS CANNOT BE REMOVED */

		return $content;
	}
}