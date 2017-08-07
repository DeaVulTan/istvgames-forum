<?php

//-----------------------------------------------
// (DP34) Mass PM
//-----------------------------------------------
//-----------------------------------------------
// Application
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 23 / 07 / 2009
// Updated on: 10 / 01 / 2013
//-----------------------------------------------
// Copyright (C) 2009-2013 DawPi
// All Rights Reserved
//-----------------------------------------------  
 

class admin_masspm_core_main extends ipsCommand
{
	public $html;
	
	public $saveArray = array();
	
	public function doExecute( ipsRegistry $registry )
	{
		/* Load skin */
		
		$this->html               = $this->registry->output->loadTemplate( 'cp_masspm_main' );		
		$this->html->form_code    = 'module=core&amp;section=main';
		$this->html->form_code_js = 'module=core&section=main';	
        
        /* Check permissions */
        
        $this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'manage' );		
		
        /* Load the editor */
        
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$this->editor = new $classToLoad();
		
		/* Turn off legacy mode */
        
		$this->editor->setLegacyMode( false );
        
		/* What we should to do */
		
		switch ( $this->request['do'] )
		{			
			case 'addMassPm':
				$this->form( 'add' );
			break;
			
			case 'editMassPm':
				$this->form( 'edit' );
			break;
			
			case 'checkMsg':
				$this->_checkMsgDo();
			break;
			
			case 'followMe':
				$this->followMeDo();
			break;
			
			case 'send':
				$this->send( '25' );
			break;
												
			case 'removeMassPm':
				$this->_removeDo();
			break;	
					
			case 'removeAll':
				$this->_removeAllDo();
			break;
			
			case 'viewAllPms':									
			default:
			     $this->viewMain();
			break;
		}
				
		/* Show our page */

		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		
		/* Add copyright :) */

		$this->registry->output->html .= $this->registry->masspmLibrary->c_acp();
		
		/* Send to browser */

		$this->registry->output->sendOutput();
	}
	
	
	public function viewMain()
	{
		/* Pagination */	

		$start = intval( $this->request['st'] ) >= 0 ? intval( $this->request['st'] ) : 0;   
				
		
		$count = $this->DB->buildAndFetch( array( 
								'select'   => "count(*) as cnt",
								'from'     => 'masspms',
						 )		);
						 				 
       $pagination = $this->registry->output->generatePagination( array( 
																		'totalItems'		=> $count['cnt'],
																		'itemsPerPage'		=> 10,
																		'currentStartValue'	=> $start,
																		'baseUrl'			=> $this->settings['base_url'] . "&{$this->form_code}",
																	)
															); 
															
																
		/* Get all PM's */
		
		$this->DB->build( array(
						'select'	=> '*',
						'from'		=> 'masspms',
						'order'     => 'p_dateadded DESC',
						'limit'     => array( $start, 10 ),	
		       )		);
		
		$this->DB->execute();
				
		/* Any PM? */
		
		if ( $this->DB->getTotalRows() )
		{
		   while ( $row = $this->DB->fetch() )
		   {
		   		 
				$tmp = unserialize( $row['p_settings'] );
				$tmp['p_active'] = $row['p_active'];
				   
				$allPms[] = $row;
		   }		
		}

		/* Show page */
				
		$this->registry->output->html .= $this->html->listView( $allPms, $pagination );		
	}
	
	
	private function _removeDo()
	{
		/* INIT */
				
		$id = intval( $this->request['messageId'] );
		
		if ( ! $id )
		{
			$this->registry->output->showError( $this->lang->words['errorNoId'], 'MP001' );		
		}
		
		/* Delete it :( */

		$this->DB->delete( 'masspms', 'p_id= ' . $id );	
		
		/* Set message */
			
		$this->registry->output->global_message = $this->lang->words['adminSuccessDelete'];	
								
		/* Redirect */
			
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->html->form_code );				
	}
	
	private function _removeAllDo()
	{
		/* Delete all pms */

		$this->DB->delete( 'masspms' );
		
		/* Save log */		

		$this->registry->getClass('adminFunctions')->saveAdminLog($this->lang->words['adminSuccessDeleteAll'] );
		
		/* Set message */
			
		$this->registry->output->global_message = $this->lang->words['adminSuccessDeleteAll'];	
								
		/* Redirect */
			
		$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->html->form_code );	
	}
	
	
	public function form( $type = 'add' )
	{
        /* INIT */
        
        $form = array();        

		/* Adding or editing page? */
			
		if ( $type == 'add' )
		{
		   $formContent['formDo']     = $this->lang->words['addingNewMass'];
		   $formContent['button']     = $this->lang->words['addNewAndRun'];
		   $formContent['formDoDesc'] = $this->lang->words['creatingNewMass'];
		   $formContent['typeAfter']  = "new_page";
			
		}
		else if ( $type == 'edit' )
		{
			$formContent['formDo']     = $this->lang->words['editingMass'];
			$formContent['button']     = $this->lang->words['editMassAndRun'];
			$formContent['formDoDesc'] = $this->lang->words['editingMass'];
			$formContent['typeAfter']  = "edit_page";
						
			/* Grab message ID */		
			
			$messageId = intval( $this->request['messageId'] );
			
			
			$data = $this->DB->buildAndFetch(array(
											'select'	=> '*',
											'from'		=> 'masspms',
											'where'		=> 'p_id = ' . $messageId 		   
												)		);

				
			/* Wrong ID? */
			
			if ( !$this->DB->getTotalRows() )
			{
			   $this->registry->output->showError( $this->lang->words['NoMasss'], 'MP002' );
			   			
			} 
							  								
			/* Play with serialize stuff */			
			
			$tmpCache = unserialize( $data['p_settings'] );

			$data['p_force'] 						= $tmpCache['p_force'];
			
			$sender = $this->DB->buildAndFetch(array( 'select' => 'members_display_name', 'from' => 'members', 'where' => 'member_id = ' . $tmpCache['p_sender']  ) );
						
			$data['p_sender'] 						= $sender['members_display_name'];
			$data['p_groups'] 						= $tmpCache['p_groups'];
			$data['p_groups_secondary'] 			= $tmpCache['p_groups_secondary'];
			$data['p_sort_type_posts'] 				= $tmpCache['p_sort_type_posts'];
			$data['p_sort_posts'] 					= $tmpCache['p_sort_posts'];
			$data['p_sort_type_rejestrated'] 		= $tmpCache['p_sort_type_rejestrated'];
			$data['p_sort_type_rejestrated_type'] 	= $tmpCache['p_sort_type_rejestrated_type'];
			$data['p_sort_rejestrated'] 			= $tmpCache['p_sort_rejestrated'];
			$data['p_sort_type_visited'] 			= $tmpCache['p_sort_type_visited'];
			$data['p_sort_type_visited_type'] 		= $tmpCache['p_sort_type_visited_type'];
			$data['p_sort_visited'] 				= $tmpCache['p_sort_visited'];			   	   		   		   
		}

		/* Get groups from cache */
				
		foreach( $this->cache->getCache('group_cache') as $g )
		{
			# We don't want some group here?!
			if ( in_array($g['g_id'], explode(',', $this->settings['masspmGroups'] ) ) ) continue;
			
			$allGroups[] = array( $g['g_id'], $g['g_title'] );
		}		
				
		/* Set mutual fields */
		
		$formContent['p_id']	 = intval( $data['p_id'] );
		$formContent['p_title']  = $this->registry->output->formInput( 'p_title', $data['p_title'] );
		$formContent['p_force']  = $this->registry->output->formYesNo( 'p_force', $data['p_force'] );
		$formContent['p_sender'] = $this->registry->output->formInput( 'p_sender', $data['p_sender'] );	
		$this->editor->setContent( $data['p_text'] );
        $formContent['p_text']   = $this->editor->show( 'p_text', array( 'delayInit' => 1 ) ); 
		$formContent['p_groups'] = $this->registry->output->formMultiDropdown( "p_groups[]", $allGroups, explode( ",", $data['p_groups'] ), count($allGroups) );
		$formContent['p_groups_secondary']  = $this->registry->output->formYesNo( 'p_groups_secondary', $data['p_groups_secondary'] );
		
		
         # BBCode and HTML Allowed
         $formContent['bbcode_allowed'] = "accept.png";
	     $formContent['html_allowed']   = "accept.png";

		/* Sort stuff */
		
		#Amount of posts
		$sort_type_posts			= array(
									array( 'more_than', $this->lang->words['moreThan'] ),
									array( 'less_than', $this->lang->words['lessThan'] ), 
									);
													
		$formContent['p_sort_type_posts'] = $this->registry->output->formDropdown( 'p_sort_type_posts', $sort_type_posts, $data['sort_type_posts'] );
		
		$formContent['p_sort_posts'] = $this->registry->output->formSimpleInput( 'p_sort_posts', $data['p_sort_posts'] );
				
		#Universal fields
		$sort_type          		= array(
									array( 'more_than', $this->lang->words['beforeThan'] ),
									array( 'less_than', $this->lang->words['afterThan'] ), 
									);
		$sort_type_type	= array(
									array( 'hours', $this->lang->words['hours'] ),
									array( 'days',  $this->lang->words['days'] ), 
									array( 'month', $this->lang->words['months'] ), 
									array( 'years', $this->lang->words['years'] ), 																		
									);											

		#Register date
		$formContent['p_sort_type_rejestrated'] = $this->registry->output->formDropdown( 'p_sort_type_rejestrated', $sort_type, $data['p_sort_type_rejestrated'] );
		
		$formContent['p_sort_type_rejestrated_type'] = $this->registry->output->formDropdown( 'p_sort_type_rejestrated_type', $sort_type_type, $data['p_sort_type_rejestrated_type'] );	
			
		$formContent['p_sort_rejestrated'] = $this->registry->output->formSimpleInput( 'p_sort_rejestrated', $data['p_sort_rejestrated'] );			
		
		#Date of last visit
		$formContent['p_sort_type_visited'] = $this->registry->output->formDropdown( 'p_sort_type_visited', $sort_type, $data['p_sort_type_visited'] );
		
		$formContent['p_sort_type_visited_type'] = $this->registry->output->formDropdown( 'p_sort_type_visited_type', $sort_type_type, $data['p_sort_type_visited_type'] );	
			
		$formContent['p_sort_visited'] = $this->registry->output->formSimpleInput( 'p_sort_visited', $data['p_sort_visited'] );	
						
		/* Show page */
				
		$this->registry->output->html .= $this->html->formView( $formContent );		
	}
	
	
	private function _checkMsgDo()
	{
		/* Check title */
		
		if ( !strlen( $this->request['p_title'] ) ) 
		{ 
			$this->registry->output->showError( 'errorNoTitle', 'MP003' );
		}		
		
		/* Check message author */
				
		if ( is_string( $this->request['p_sender'] ) )
		{
			if ( !strlen( $this->request['p_sender'] ) ) 
			{ 
				$this->registry->output->showError( 'errorNoSender', 'MP004' );
			}
						
			$checkSender = $this->DB->buildAndFetch(array( 'select' => 'member_id', 'from' => 'members', 'where' => 'members_display_name = "' . strtolower( $this->request['p_sender'] . '"' ) ) );			
			
			if ( !$checkSender['member_id']  ) 
			{ 
				$this->registry->output->showError( 'errorSenderNoExist', 'MP005' );
			}
		}
				
		/* Any groups? */

		if ( ! count( $this->request['p_groups'] ) || ! is_array( $this->request['p_groups'] ) )
		{
			$this->registry->output->showError( 'errorNoGroups', 'MP006' );		
		}
		
		/* No message */
		
		if ( !strlen( $this->request['p_text'] ) )
		{
		    $this->registry->output->showError( $this->lang->words['errorNoTxt'], 'MP007' );
		}
				
		/* STILL HERE? OK! MAKE SOME NOISE! o.O */
		
		$type = $this->request['type'];
		
		/* Parse post */

 		$text = $this->editor->process( $_POST['p_text'] );	
        
        /* Build save array */
         	
		$this->saveArray = array (
							'p_title'	 => $this->request['p_title'],
							'p_text'	 => $text,
							'p_settings' => serialize ( array(
							 			  'p_force' 						=> $this->request['p_force'],
							 			  'p_sender' 						=> $checkSender['member_id'],
							 			  'p_groups' 						=> implode( ',', $this->request['p_groups'] ),
							 			  'p_groups_secondary' 				=> $this->request['p_groups_secondary'],
							 			  'p_sort_type_posts' 				=> $this->request['p_sort_type_posts'],
							 			  'p_sort_posts' 					=> $this->request['p_sort_posts'],							 			  
							 			  'p_sort_type_rejestrated' 		=> $this->request['p_sort_type_rejestrated'],
							 			  'p_sort_type_rejestrated_type' 	=> $this->request['p_sort_type_rejestrated_type'],
							 			  'p_sort_rejestrated' 				=> $this->request['p_sort_rejestrated'],
							 			  'p_sort_type_visited' 			=> $this->request['p_sort_type_visited'],
							 			  'p_sort_type_visited_type' 		=> $this->request['p_sort_type_visited_type'],
							 			  'p_sort_visited' 					=> $this->request['p_sort_visited'],							
							) ),
							   				
		);		
		
		/* What we shall do? */
		
		if ( $type == 'new_page' )
		{
		   	 $this->saveArray['p_dateadded'] = time();
		   	 $this->saveArray['p_send']		 = 0;
		   	 $this->saveArray['p_tsend']     = 0;
		   	 
		   	 $reSend                         = 0;
		
			#Insert!
			$this->DB->insert( 'masspms', $this->saveArray );
			$messageId = $this->DB->getInsertId();    	     	   

			/* Set message */
				
			$this->registry->output->global_message = $this->lang->words['adminSuccessAdd'];	
									
			/* Redirect */
				
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->html->form_code . "&amp;do=followMe&amp;msgId=" . $messageId . "&amp;st=" . $this->request['st'] );			
		}
		else if ( $type == 'edit_page' )
		{
		 	 $this->saveArray['p_dateupdated'] = time();
		 	 
		 	 $reSend                           = 1;
		
		 	 $this->DB->update( 'masspms', $this->saveArray, 'p_id=' . $this->request['messageId'] );       

			/* Set message */
				
			$this->registry->output->global_message = $this->lang->words['adminSuccessEdit'];	
									
			/* Redirect */
				
			$this->registry->output->silentRedirectWithMessage( $this->settings['base_url'] . $this->html->form_code . "&amp;do=viewAllPms" );			
		}						
	}
	
	
	public function followMeDo()
	{	
 		/* Message ID */
 		
		$messageId = intval( $this->request['msgId'] );
			
		/* Get message from DB */
			
		$data = $this->DB->buildAndFetch(array(
										'select'	=> '*',
										'from'		=> 'masspms',
										'where'		=> 'p_id = ' . $messageId 		   
											)		);
			
		/* Wrong ID? */
		
		if ( !$this->DB->getTotalRows() )
		{
		   $this->registry->output->showError( $this->lang->words['errorNoId'], 'MP008' );
		   			
		} 			
		  								
		/* Play with serialize stuff */			
		
		$tmpCache = unserialize( $data['p_settings'] );
		
		$data['p_force'] 						= $tmpCache['p_force'];
		$data['p_sender'] 						= $tmpCache['p_sender'];
		$data['p_groups'] 						= $tmpCache['p_groups'];
		$data['p_groups_secondary'] 			= $tmpCache['p_groups_secondary'];			
		$data['p_sort_type_posts'] 				= $tmpCache['p_sort_type_posts'];
		$data['p_sort_posts'] 					= $tmpCache['p_sort_posts'];
		$data['p_sort_type_rejestrated'] 		= $tmpCache['p_sort_type_rejestrated'];
		$data['p_sort_type_rejestrated_type'] 	= $tmpCache['p_sort_type_rejestrated_type'];
		$data['p_sort_rejestrated'] 			= $tmpCache['p_sort_rejestrated'];
		$data['p_sort_type_visited'] 			= $tmpCache['p_sort_type_visited'];
		$data['p_sort_type_visited_type'] 		= $tmpCache['p_sort_type_visited_type'];
		$data['p_sort_visited'] 				= $tmpCache['p_sort_visited'];			
				
		/* Build query */
		
		$where = $this->buildQuery( $data );
		
		$count = $this->DB->buildAndFetch(array(
										'select'	=> 'count(*) as howMany',
										'from'		=> 'members',
										'where'		=> $where
										)		);
				
		/* Check members count */
		
		if ( ! $count['howMany'] )
		{
	       $this->registry->output->showError( $this->lang->words['errorNoUsers'], 'MP009' );			
		}
		
		/* Format number */
        		
		$howMany = $this->registry->getClass('class_localization')->formatNumber( intval( $count['howMany'] ) );
				
		/* Show confirmation window */
		
        $this->registry->output->html .= $this->html->confirm( $howMany, $messageId, $this->request['resend'] );								
	}
	
	
	public function send()
	{
		/* INIT */
	    $where            = '';	
		$messageId        = $this->request['messageId'];		
        $done             = 0;
		$start            = intval( $this->request['st'] ) >= 0 ? intval( $this->request['st'] ) : 0;
		$end              = ( intval( $this->request['perSession'] ) && ( $this->request['perSession'] <= 25 ) ) ? intval( $this->request['perSession'] ) : 25;
		$dis              = $end + $start;
        
        /* Load lib */
        		
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'members' ) . '/sources/classes/messaging/messengerFunctions.php', 'messengerFunctions', 'members' );	
	    
		/* Sending again? Check it! */
		
		if ( isset( $this->request['resend'] ) AND $this->request['resend'] )
		{
		    $arr = array('p_send' => 0, 'p_tsend' => 0 );
		    
			$this->DB->update('masspms', $arr , 'p_id = ' . $messageId );
		}  
	 	    
		/* Get message from DB */
			
		$data = $this->DB->buildAndFetch(array(
										'select'	=> '*',
										'from'		=> 'masspms',
										'where'		=> 'p_id = ' . $messageId 		   
											)		);

		/* Wrong ID? */
		
		if ( ! $this->DB->getTotalRows() )
		{
		   $this->registry->output->showError( $this->lang->words['errorNoId'], 'MP010' );		   			
		} 
					  								
		/* Play with serialize stuff */			
		
		$tmpCache                               = unserialize( $data['p_settings'] );
		
		$data['p_force'] 						= $tmpCache['p_force'];
		$data['p_sender'] 						= $tmpCache['p_sender'];
		$data['p_groups'] 						= $tmpCache['p_groups'];
		$data['p_groups_secondary'] 			= $tmpCache['p_groups_secondary'];			
		$data['p_sort_type_posts'] 				= $tmpCache['p_sort_type_posts'];
		$data['p_sort_posts'] 					= $tmpCache['p_sort_posts'];
		$data['p_sort_type_rejestrated'] 		= $tmpCache['p_sort_type_rejestrated'];
		$data['p_sort_type_rejestrated_type'] 	= $tmpCache['p_sort_type_rejestrated_type'];
		$data['p_sort_rejestrated'] 			= $tmpCache['p_sort_rejestrated'];
		$data['p_sort_type_visited'] 			= $tmpCache['p_sort_type_visited'];
		$data['p_sort_type_visited_type'] 		= $tmpCache['p_sort_type_visited_type'];
		$data['p_sort_visited'] 				= $tmpCache['p_sort_visited'];	
				
		/* Build where query */

		$where = $this->buildQuery( $data );

        /* Count them */
        
		$count = $this->DB->buildAndFetch(array(
										'select'	=> 'count(*) as howMany',
										'from'		=> 'members',
										'where'		=> $where
										)		);
				
		/* Check members count */
		
		if ( ! $count['howMany'] )
		{
	       $this->registry->output->showError( $this->lang->words['errorNoUsers'], 'MP011' );			
		}
				    
	    /* Set count */
	    
		$howMany = $count['howMany'];
	
		/* Get members */
		
		$this->DB->build(array(
                				'select' => 'member_id',
                				'from'	 => 'members',
                				'where'  => $where,
                				'limit'	 => array( $data['p_tsend'], $end ),
		) );
		
		$queryId = $this->DB->execute();

        /* Parse them */
          
		while ( $row = $this->DB->fetch( $queryId ) )
		{	           	   			 
             /* Internal loop init */
             
             $done++;
  			 $last = $row['member_id'];
         
			 try
			 {
			         $messengerFunctions = new $classToLoad( $this->registry );	
			         $messengerFunctions->sendNewPersonalTopic( $row['member_id'], 
			                                                                         $data['p_sender'], 
			                                                                         array(), 
			                                                                         $data['p_title'], 
			                                                                         $this->registry->output->outputFormatClass->parseIPSTags( '<p>' . $data['p_text'] . '</p>' ),  
			                                                                         array(
			                                                                                         'postKey'           => md5(microtime()),
			                                                                                         'addToSentFolder'   => 0,
			                                                                                         'forcePm'           => 1,
                                                                                                     'isDraft'           => 0,
			                                                                                         'isSystem'          => ( $data['p_force'] == 1 ) ? FALSE : TRUE
			                                                                                 )
			                                                                         );
	                                                                              
			 }
			 catch( Exception $error )
			 {
			         $msg            = $error->getMessage();
			         
			         if( $msg != 'CANT_SEND_TO_SELF' )
			         {
			                 $toMember       = IPSMember::load( $user['member_id'], 'core' );
			            
			                 if ( strstr( $msg, 'BBCODE_' ) )
			                 {
			                         $msg = str_replace( 'BBCODE_', $msg );
			
			                         $this->registry->output->showError( $msg, 'MP012' );
			                 }
			                 else if ( isset($this->lang->words[ 'err_' . $msg ]) )
			                 {
			                         $this->lang->words[ 'err_' . $msg ] = $this->lang->words[ 'err_' . $msg ];
			                         $this->lang->words[ 'err_' . $msg ] = str_replace( '#NAMES#'   , implode( ",", $this->messenger->exceptionData ), $this->lang->words[ 'err_' . $msg ] );
			                         $this->lang->words[ 'err_' . $msg ] = str_replace( '#TONAME#'  , $toMember['members_display_name']      , $this->lang->words[ 'err_' . $msg ] );
			                         $this->lang->words[ 'err_' . $msg ] = str_replace( '#FROMNAME#', $this->memberData['members_display_name'], $this->lang->words[ 'err_' . $msg ] );
			                         
			                         $this->registry->output->showError( 'err_' . $msg, 'MP013' );
			                 }
			                 else
			                 {
			                         $_msgString = $this->lang->words['err_UNKNOWN'] . ' ' . $msg;
			                         
			                         $this->registry->output->showError( 'err_UNKNOWN', 'MP014' );
			                 }
			         }
			 }

		 }		 
	
		/*Update total send */
        
		$data['p_tsend'] = $data['p_tsend'] + $done;
		$this->DB->update('masspms', array('p_tsend' => $data['p_tsend'] ), 'p_id = ' . $messageId );
				
		$search  = array( '<% FROM %>', '<% TOTAL %>');
		$replace = array( $data['p_tsend'], $howMany );
			       
		/* Finish - or more?... */
		
		if ( ! $done and ! $max )
		{
			$txt = $this->lang->words['successSent'];
			$url = "viewAllPms";
            
            $this->DB->update('masspms', array('p_send' => 1 ), 'p_id = ' . $messageId );
		}
		else
		{
			/* More.. */
	
			$txt = str_replace( $search, $replace, $this->lang->words['sendingProcess'] );
			$url  =  "send&amp;st=". $dis . "&amp;perSession=" . $end . "&amp;messageId=" . $messageId . "&amp;last=" . $last;	          	
		} 
        
        /* Build URL */
        
        $url = $this->settings['base_url'] . $this->html->form_code . "&amp;do=" . $url;                                    
	 
		/* Redirect */

        $this->_specialRedirect( $url, $txt );	 	 
	}


	protected function _specialRedirect( $url, $txt )
	{
	   $this->registry->output->html	.= $this->registry->output->global_template->temporaryRedirect( $url, $txt );
	}
    	
	private function buildQuery( $data )
	{
		/* Play with sorting and get all allowed members */
		
		$where = array();
		
		/* Disabled PM? Skip it */
		
		$where[] = "members_disable_pm = 0";
		
		/* The same sender as receiver? */
		
		$where[] = "member_id <> " . $data['p_sender'];
				
		/* Primary groups */
		
		$where[] =  ( count( explode(',', $data['p_groups'] ) ) ) ? "member_group_id IN ( " . $data['p_groups'] . " ) " : "";

		/* Secondary groups */
		
		if ( $data['p_groups_secondary'] )
		{			
			$temp = explode(',', $data['p_groups'] );
			
			if ( is_array( $temp ) && count( $temp ) )
			{
				$tmp = array();

				foreach( $temp as $id )
				{
					$tmp[] = "CONCAT(',',mgroup_others,',') LIKE '%,$id,%'";
				}
				
				$tmp_q .= "OR ( ".implode( ' OR ', $tmp ). " )";
			}
			
			$where[ count( $where ) - 1 ] .= $tmp_q;			
		}
				
		/* Posts */
		
		if ( $data['p_sort_posts'] AND is_numeric( $data['p_sort_posts'] ) )
		{
			$moreOrLess = ( $data['p_sort_type_posts'] == 'more_than' ) ? " > " : " < ";
			
			#Make query
			$where[]    = "posts " . $moreOrLess .  $data['p_sort_posts']; 
		}
				
		/* Register date */
		
		if ( $data['p_sort_rejestrated'] AND is_numeric( $data['p_sort_rejestrated'] ) )
		{
			$hour = 3600;
			
			#Type od time...
			switch ( $data['p_sort_type_rejestrated_type'] )
			{
				case 'hours':		
					$setTime =  1;
				break;
				
				case 'days':		
					$setTime = 24;
				break;
				
				case 'month':		
					$setTime = 31;
				break;
				
				case 'years':		
					$setTime = 365;
				break;
																			
				default:
				$setTime = 1;				
			}				
		
			$moreOrLessR = ( $data['p_sort_type_rejestrated'] == 'more_than' ) ? " > " : " < ";
			
			$time = $hour * $setTime * $data['p_sort_rejestrated'];
			
			#Make query	
			$where[] = "joined " . $moreOrLessR . $time;								
		}
				
		/* Last seen */
		
		if ( $data['p_sort_visited'] AND is_numeric( $data['p_sort_visited'] ) )
		{
			$hour = 3600;
			
			#Type od time...
			switch ( $data['p_sort_type_visited_type'] )
			{
				case 'hours':		
					$setTime =  1;
				break;
				
				case 'days':		
					$setTime = 24;
				break;
				
				case 'month':		
					$setTime = 31;
				break;
				
				case 'years':		
					$setTime = 365;
				break;
																			
				default:
				$setTime = 1;				
			}				
		
			$moreOrLessV = ( $data['p_sort_type_visited'] == 'more_than' ) ? " > " : " < ";
			
			$time = $hour*$setTime;
			
			#Make query	
			$where[] = 'last_visit ' . $moreOrLessV . $time;								
		}
				
		return implode ( ' AND ', $where );	
	}
}//End of class