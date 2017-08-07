<?php

class shoutboxGlobalShoutbox
{
	protected $registry;
	protected $settings;
	protected $request;
	protected $member;
	protected $memberData;
	protected $cache;

	public function __construct()
	{
        /* Make registry objects */
		$this->registry   =  ipsRegistry::instance();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->member     =  $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache      =  $this->registry->cache();
	}

	public function getOutput()
	{
		/* Check temporary ban status */
		if( $this->memberData['temp_ban'] )
		{
			# Let's just return, it is useless to process it since it is already done in ipsRegistry
			return;
		}

		/* Check the new way to ban */
		if ( $this->memberData['member_banned'] == 1 )
		{
			return;
		}

		/* No permission to view the board */
		if ( $this->memberData['g_view_board'] != 1 )
		{
			return;
		}

		/* Offline or can't view? */
		if ( !$this->settings['shoutbox_online'] || !$this->memberData['g_shoutbox_view'] || (!$this->memberData['g_shoutbox_view'] && !$this->memberData['g_shoutbox_use']) || ( $this->settings['board_offline'] && !$this->memberData['g_access_offline'] ) )
		{
			return;
		}

		/** Shoutbox app? - Are we shoutbox banned? **/
		if ( ipsRegistry::$current_application == 'shoutbox' || $this->memberData['_cache']['shoutbox_banned'] )
		{
			return;
		}

		/* Login enforced? */
		if ( !$this->memberData['member_id'] && $this->settings['force_login'] == 1 )
		{
			return;
		}

		/* Printing the page? */
		if ( !empty( $_GET['forcePrint'] ) && ( $_GET['_k'] == $this->member->form_hash ) )
		{
			return;
		}

		/* Display only on index page? */
		if ( $this->settings['shoutbox_global_display_loc'] == 'idx' )
		{
			// idx shortcut not used?
			if ( $this->request['act'] == 'idx' || (IPS_APP_COMPONENT == 'forums' && ipsRegistry::$current_module == 'forums' && ipsRegistry::$current_section == 'boards') )
			{
				// Go on!
			}
			else
			{
				return;
			}
		}
		else
		{
			// Check pages?
			if ( !in_array( $this->settings['shoutbox_global_hook'], array( 's', 'ct', 'cb' ) ) && $this->pagesCheckList() )
			{
				return;
			}
		}
//ipchat gonna be broken? don't REALLY care but... w/e

if(ipsRegistry::$current_application == 'ipchat')
{
return;
}

		/* Our library is loaded? */
		if( !class_exists('app_class_shoutbox') OR !$this->registry->isClassLoaded('shoutboxLibrary') )
		{
			require_once( IPSLib::getAppDir('shoutbox').'/app_class_shoutbox.php' );
			$app_class_shoutbox = new app_class_shoutbox( ipsRegistry::instance() );
		}

		$this->registry->getClass('shoutboxLibrary')->global_on = true;
		$this->registry->getClass('shoutboxLibrary')->_startup();

		// Check prefs
		if ( !$this->registry->getClass('shoutboxLibrary')->prefs['global_display'] )
		{
			return;
		}

		// We have the right amount of posts
		// to use it if we can use it?
		if ( $this->memberData['g_shoutbox_use'] && $this->memberData['g_shoutbox_posts_req'] )
		{
			$this->memberData['g_shoutbox_posts_req'] = intval($this->memberData['g_shoutbox_posts_req']);
			if ($this->memberData['g_shoutbox_posts_req'] && $this->memberData['posts'] < $this->memberData['g_shoutbox_posts_req'])
			{
				$this->memberData['g_shoutbox_use'] = 0;
				$this->registry->getClass('shoutboxLibrary')->moderator = 0;
			}
		}
		
		// We have the right amount of posts
		// to use it if we can use it?
		if ( $this->memberData['g_shoutbox_use'] && $this->memberData['g_shoutbox_old_req'] )
		{
			$this->memberData['g_shoutbox_old_req'] = intval($this->memberData['g_shoutbox_old_req']);
			$joined = time() - intval($this->memberData['joined']);
			$joined = floor($joined / 86400);
			if ($this->memberData['g_shoutbox_old_req'] && $joined < $this->memberData['g_shoutbox_old_req'])
			{
				$this->memberData['g_shoutbox_use'] = 0;
				$this->registry->getClass('shoutboxLibrary')->moderator = 0;
			}
		}

		$d = array( 'shout_height' => $this->registry->getClass('shoutboxLibrary')->prefs['shoutbox_gheight'],
					'announcement' => $this->registry->getClass('shoutboxLibrary')->_get_announcement(),
					'noshouts'     => $this->registry->getClass('shoutboxLibrary')->_noShoutsMessage(),
					'shouts'       => $this->registry->getClass('shoutboxLibrary')->return_shouts(true),
					);

		/* Setup JS things */
		$d['js']  = $this->registry->getClass('output')->getTemplate('shoutbox')->javascript( $d );
		$d['js'] .= $this->registry->getClass('shoutboxLibrary')->show_lang_for_js_use();

		/* Which hook? - Added in 1.1.1 */
		if ( $this->settings['shoutbox_global_hook'] == 's' )
		{
			$hook = 'hookGlobalShoutboxSidebar';
		}
		else
		{
			# Not sidebar? Use the normal one then
			$hook = 'hookGlobalShoutbox';
		}

		return '<!--- ShoutBoxJsLoader --->'.$this->registry->getClass('output')->getTemplate('shoutbox_hooks')->$hook( $d );
	}

	private function pagesGetList()
	{
		$pages = array();

		foreach ( explode("\n", $this->settings['shoutbox_global_pages_list']) as $row )
		{
			// We have a row?
			$row = trim($row);
			if ($row == '')
			{
				continue;
			}

			// We have segments?
			$segments = explode(",", $row);
			if ( count($segments) <= 0 )
			{
				continue;
			}

			// Parse segments
			$list = array();
			foreach ( $segments as $v )
			{
				if ( preg_match("#(.+?)=(.+?)#i", $v) )
				{
					list($key, $value) = explode('=', $v);
					$list[ $key ] = $value;
				}
			}

			if ( count($list) )
			{
				$pages[] = $list;
			}
		}

		return $pages;
	}

	private function pagesCheckList()
	{
		if ( $this->settings['shoutbox_global_pages_type'] == 'd' || $this->settings['shoutbox_global_pages_list'] == '' )
		{
			return false;
		}

		// Get pages from cache
		$pages = $this->pagesGetList();

		// Go through pages if we have some
		if ( count($pages) )
		{
			foreach ( $pages as $page )
			{
				/* Reset some vars */
				$totalParts = count($page);
				$foundParts = 0;

				foreach ( $page as $key => $value )
				{
					/* If we have a main key let's reset with the ipsRegistry values */
					if ( $key == 'app' )
					{
						$this->request[ $key ] = ipsRegistry::$current_application;
					}
					elseif ( $key == 'module' )
					{
						$this->request[ $key ] = ipsRegistry::$current_module;
					}
					elseif ( $key == 'section' )
					{
						$this->request[ $key ] = ipsRegistry::$current_section;
					}

					if ( $value == '*' && isset($this->request[ $key ]) )
					{
						$foundParts++;
					}
					elseif ( strtolower($this->request[ $key ]) == strtolower($value) )
					{
						$foundParts++;
					}
					else
					{
						break;
					}
				}

				if ( $foundParts == $totalParts )
				{
					return $this->settings['shoutbox_global_pages_type'] == 'e' ? TRUE : FALSE;
				}
			}
		}

		return $this->settings['shoutbox_global_pages_type'] == 'e' ? FALSE: TRUE;
	}
}
