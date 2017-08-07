<?php

	/**
	 * -RAW33- Shoutbox Bot!
	 * http://invisionlegacy.com
	 * -RAW-
	 * 2012
	 */
	 
class hook_shoutboxBot extends public_shoutbox_ajax_coreAjax
{
	/**
	 * Shortcut for our library
	 * 
	 * @var		object
	 * @access	public
	 */
	public $library;
	public $registry;
	public $settings;		
	public $DB;
	public $memberData;	
	
	public function doExecute( ipsRegistry $registry )
	{
		/* Let's setup our shortcut =D */
		$this->library = $this->registry->getClass('shoutboxLibrary');
		
		/* Startup */
		$this->library->_startup();
		
		if ( !$this->settings['shoutbox_online'] )
		{
			$this->returnError('shoutbox_offline');
		}

		if ( !$this->memberData['g_shoutbox_view'] )
		{
			if ( !$this->memberData['g_shoutbox_use'] )
			{
				$this->returnError('no_use_perm');
			}

			$this->returnError('no_view_perm');
		}
		
		# Banned?
		if ( $this->memberData['_cache']['shoutbox_banned'] )
		{
			$this->returnError('banned');
		}
		
		# Trim type
		$this->request['type'] = trim($this->request['type']);
		
		/* If we don't have enough posts to use it reset some things */
		$this->memberData['g_shoutbox_posts_req'] = intval($this->memberData['g_shoutbox_posts_req']);
		
		if ( $this->memberData['g_shoutbox_use'] && $this->memberData['g_shoutbox_posts_req'] > 0 )
		{
			if ( $this->memberData['posts'] < $this->memberData['g_shoutbox_posts_req'] )
			{
				if ( in_array($this->request['type'], array( 'getShouts', 'getMembers' )) )
				{
					$this->memberData['g_shoutbox_use'] = 0;
					$this->library->moderator = 0;
				}
				else
				{
					if ( $this->memberData['g_shoutbox_posts_req_display'] == 1 )
					{
						$this->returnError( sprintf( $this->lang->words['error_no_use_posts_display'], $this->lang->formatNumber($this->memberData['g_shoutbox_posts_req']) ) );
					}
					
					$this->returnError('no_use_posts');
				}
			}
		}
		
		/* Check auth key */
		// Don't check authKey for refresh, causes troubles with sessions
		
		# Commented out since from IPB 3.0.2 and above each ajax call automatically checks the secure_key
		/*if ( !in_array($this->request['type'], array( 'getShouts', 'getMembers' )) && trim($this->request['secure_key']) != $this->member->form_hash )
		{
			$this->returnError('auth_key_expired');
		}*/
		
        if($this->settings['sbBot_enable'])
        {
		    switch ($this->request['type'])
		    {
			    case 'submit':
				$this->submit_shout();
				break;
		    }		  	  
        }
		return parent::doExecute( $registry ); 
    }     

		
		
	
        
	private function submit_shout()
	{
	if($this->settings['sbBot_enable'])
    {
		if ( !$this->memberData['g_shoutbox_use'] )
		{
			$this->returnError('no_use_perm');
		}
		
		/**
		 * 1.1.2
		 * Our posts are restricted?
		 */
        if ( $this->memberData['restrict_post'] )
        {
        	$this->lang->loadLanguageFile( array('public_error'), 'core' );
        	
        	if ( $this->memberData['restrict_post'] == 1 )
        	{
        		$this->returnError( $this->lang->words['posting_restricted'], false );
        	}
        	
        	$post_arr = IPSMember::processBanEntry( $this->memberData['restrict_post'] );
        	
        	/* Restriction is already ended? */
        	if ( time() >= $post_arr['date_end'] )
        	{
        		IPSMember::save( $this->memberData['member_id'], array( 'core' => array( 'restrict_post' => 0 ) ) );
        	}
        	/* Still restricted, oh well... */
        	else
        	{
				$this->returnError( sprintf( $this->lang->words['posting_off_susp'], $this->registry->getClass( 'class_localization')->getDate( $post_arr['date_end'], 'LONG', 1 ) ), false );
        	}
        }
		
		// Check flooding
		if ( $this->settings['shoutbox_flood_limit'] > 0 && $this->memberData['g_shoutbox_bypass_flood'] != 1 )
		{
			// Load our latest shout from DB
			$shout = $this->DB->buildAndFetch( array( 'select'   => 's_date',
													  'from'     => 'shoutbox_shouts',
													  'where'    => 's_mid='.$this->memberData['member_id'],
													  'order'    => 's_date DESC',
													  'limit'    => array(0, 1)
											  )		 );
			
			if ( intval($shout['s_date']) > 0 )
			{
				$time_check = time() - intval($shout['s_date']);
	
				if ( $time_check < $this->settings['shoutbox_flood_limit'] )
				{
					$this->returnError( str_replace('{#EXTRA#}', ($this->settings['shoutbox_flood_limit']-$time_check), $this->lang->words['error_flooding']) );
				}
			}
		}
		
		/* Parse the shout!! */
		$shout = $_POST['shout'];
		
		if( $this->settings['shoutbox_stop_shouting'] )
		{
			if( function_exists('mb_convert_case') )
			{
				if( in_array( strtolower( $this->settings['gb_char_set'] ), array_map( 'strtolower', mb_list_encodings() ) ) )
				{
					$shout = mb_convert_case( $shout, MB_CASE_TITLE, $this->settings['gb_char_set'] );
				}
				else
				{
					$shout = ucwords( $shout );
				}
			}
			else
			{
				$shout = ucwords( $shout );
			}
		}
		
		/* If in the global shoutbox, we don't need to have the editor process this */
		if ( !$this->request['global'] )
		{
			$shout = $this->library->editor->process( $shout );
		}
		else
		{
			$shout = nl2br( IPSText::htmlspecialchars( $shout ) );
		}
		
		$shout = $this->library->parser->preDbParse( $shout );
		
		// Check for errors
		if ( $this->library->parser->error != "" )
		{
			$this->returnError( $this->library->parser->error );
		}
		
		/* Check for other errors :O */
		if ( strlen( trim( IPSText::removeControlCharacters( IPSText::br2nl( $shout ) ) ) ) < 1 )
		{
			$this->returnError('blank_shout', false);
		}
		
		if ( $this->library->shout_max_length && IPSText::mbstrlen( $shout ) > $this->library->shout_max_length )
		{
			$this->returnError('shout_too_big', false);
		}

        /* -RAW33- Shoutbox Bot! Starts*/
        if($this->settings['sbBot_enable'])
        {
            /* Lets Get The Bot */
            if ( $this->settings['sbBot_bot_id'] !== 0 AND $this->settings['sbBot_bot_id'] !== '')
            {
                $from = IPSMember::Load($this->settings['sbBot_bot_id']);
            } 

            if (!$from['member_id'])
            {
                /* There Was An Error No Bot Id To Load Return Empty */
                return;
            } 

            /* Message To Shout */
            $msg = $this->settings['sbBot_msg'];

            /* The Time To Shout*/
            $shoutmsg['shout'] = $this->settings['sbBot_time'];
            $shoutmsg['row'] = $this->DB->buildAndFetch(array( 'select' => 's_id',
                                                               'where' => '1',
                                                               'from' => 'shoutbox_shouts',
                                                               'order' => 's_id DESC',
                                                               'limit' => '0,1'
                                                              ) );

            if (is_array($shoutmsg['row']) && isset($shoutmsg['row'][s_id]))
            {
                if($shoutmsg['row'][s_id] % $shoutmsg['shout'] == 0)
                { 
                    /* Insert The Shout */
                    $insert = array( 's_mid' => $from['member_id'],
                                     's_message' => $msg, 
                                     's_ip' => "127.0.0.1",
                                     's_date' => time()
                                    );

                    $this->DB->insert( 'shoutbox_shouts', $insert );
                } 
            }
        } 
        /* -RAW33- Shoutbox Bot! Ends*/
		
		// Finally save shout
		$this->DB->force_data_type = array( 's_mid' => 'int', 's_message' => 'string' );
		
		$this->DB->insert( 'shoutbox_shouts',
						   array( 's_mid'     => $this->memberData['member_id'],
								  's_message' => $shout,
								  's_date'    => time(),
								  's_ip'      => $this->member->ip_address
								 )
						  );
		
		/**
		 * Update our session when submitting shouts!
		 * By default ajax module doesn't update session
		 */
		$this->member->updateMySession( array( 'current_appcomponent' => 'shoutbox', 'current_module' => 'ajax', 'current_section' => 'submit' ) );
		
		/* Recache & return */
		$this->library->recacheShouts('add');
		$this->library->return_shouts();
	    }
	}


}