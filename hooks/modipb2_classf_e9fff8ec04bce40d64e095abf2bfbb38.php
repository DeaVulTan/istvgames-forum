<?php

 	/**
	 * Show Forums Moderators 3.1.2
	 */	

class modipb2_classf extends class_forums
{
	/**
	 * Grab all mods innit
	 *
	 * @return	void
	 */
	public function forumsGetModeratorCache()
	{		
		$this->can_see_queued = array();
		
		if ( ! is_array( $this->caches['moderators'] ) )
		{
			$this->cache->rebuildCache( 'moderators', 'forums' );
		}
		
		/* Set Up */
		if ( count( $this->caches['moderators'] ) )
		{
			foreach( $this->caches['moderators'] as $r )
			{
				$forumIds = explode( ',', IPSText::cleanPermString( $r['forum_id'] ) );
				
				foreach( $forumIds as $forumId )
				{
					$this->mod_cache[ $forumId ][ $r['mid'] ] = array( 
																		'name'    => $r['members_display_name'],
																		'seoname' => $r['members_seo_name'],
																		'memid'   => $r['member_id'],
																		'id'      => $r['mid'],
																		'isg'     => $r['is_group'],
																		'gname'   => $r['group_name'],
																		'gid'     => $r['group_id'],
																		'mgroup'  => $r['member_group_id'],
																	);	
				}
			}
		}
		
		$this->mod_cache_got = 1;
	}
	
	/**
	 * Get Moderators
	 *
	 * @param	integer	$forum_id
	 * @return	string
	 */
	public function forumsGetModerators( $forum_id="" )
	{
		if ( ! $this->mod_cache_got )
		{
			$this->forumsGetModeratorCache();
		}
		
		$mod_string = array();
		
		if ( $forum_id == "" )
		{
			return $mod_string;
		}
		
		if (isset($this->mod_cache[ $forum_id ] ) )
		{
			if (is_array($this->mod_cache[ $forum_id ]) )
			{
				foreach ($this->mod_cache[ $forum_id ] as $moderator)
				{
					if ($moderator['isg'] == 1)
					{
						if ( !$this->settings['moderatorsindex_format'] )
						{
							$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "app=members&amp;module=list&amp;max_results=30&amp;filter={$moderator['gid']}&amp;sort_order=asc&amp;sort_key=members_display_name&amp;st=0&amp;b=1", "public", "false" ), $moderator['gname'], 0 );
						}
						else
						{
							$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "app=members&amp;module=list&amp;max_results=30&amp;filter={$moderator['gid']}&amp;sort_order=asc&amp;sort_key=members_display_name&amp;st=0&amp;b=1", "public", "false" ), $this->caches['group_cache'][ $moderator['gid'] ]['prefix'].$moderator['gname'].$this->caches['group_cache'][ $moderator['gid'] ]['suffix'], 0 );
						}
					}
					else if( $moderator['memid'] )
					{
						if ( ! $moderator['name'] )
						{
							continue;
						}
						
						if ( !$this->settings['moderatorsindex_format'] )
						{
							$name = IPSMember::makeProfileLink( $moderator['name'], $moderator['memid'], $moderator['seoname'] );
							$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "showuser={$moderator['memid']}", "public", $moderator['seoname'], 'showuser' ), $name, $moderator['memid'] );
						}
						else
						{
							$moderator['name'] = IPSMember::makeProfileLink(IPSMember::makeNameFormatted( $moderator['name'], $moderator['mgroup']), $moderator['memid'], $moderator['seoname']);
							$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "showuser={$moderator['memid']}", "public", $moderator['seoname'], 'showuser' ), $moderator['name'], $moderator['memid'] );
						}
					}
				}
			}
			else
			{
				if ($this->mods[$forum_id]['isg'] == 1)
				{
					if ( !$this->settings['moderatorsindex_format'] )
					{
						$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "app=members&amp;max_results=30&amp;filter={$this->mods[$forum_id]['gid']}&amp;sort_order=asc&amp;sort_key=name&amp;st=0&amp;b=1", "public", "false" ), $this->mods[$forum_id]['gname'], 0 );
					}
					else
					{
						$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "app=members&amp;max_results=30&amp;filter={$this->mods[$forum_id]['gid']}&amp;sort_order=asc&amp;sort_key=name&amp;st=0&amp;b=1", "public", "false" ), $this->caches['group_cache'][ $moderator['gid'] ]['prefix'].$this->mods[$forum_id]['gname'].$this->caches['group_cache'][ $moderator['gid'] ]['suffix'], 0 );
					}
				}
				else if( $this->mods[$forum_id]['memid'] )
				{
					if ( !$this->settings['moderatorsindex_format'] )
					{
						$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "showuser={$this->mods[$forum_id]['memid']}", "public", $this->mods[$forum_id]['seoname'], 'showuser' ), $this->mods[$forum_id]['name_seo'], $this->mods[$forum_id]['memid'] );
					}
					else
					{
						$moderator['name'] = IPSMember::makeProfileLink(IPSMember::makeNameFormatted( $moderator['name'], $moderator['mgroup']), $moderator['memid'], $moderator['seo_name']);
												
						$mod_string[] = array( $this->registry->getClass("output")->buildSEOUrl( "showuser={$this->mods[$forum_id]['memid']}", "public", $this->mods[$forum_id]['seoname'], 'showuser' ), $this->mods[$forum_id]['name_seo'], $this->mods[$forum_id]['memid'] );
					}
				}
			}
		}
		
		return $mod_string;
		
	}
}