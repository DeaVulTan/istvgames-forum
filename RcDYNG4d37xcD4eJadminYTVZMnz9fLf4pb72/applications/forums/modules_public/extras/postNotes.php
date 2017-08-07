<?php

/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.3
 * Last Updated: October 24, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.1.0 (Revision 10100)
 */


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class public_forums_extras_postNotes extends ipsCommand
{
	public $pid;
	public $ajax;
	public $url;

	public function doExecute( ipsRegistry $registry )
	{
		if ( !$this->settings['pn_enabled'] )
		{
			/* System Offline */
			return;
		}
		
		/* Load proper language part first */
		ipsRegistry::getClass( 'class_localization')->loadLanguageFile( array( 'public_forums' ) );

		$this->pid = intval( $this->request['pid'] );
		$this->isajax = $this->request['style'] == 'ajax';
		
		if ( $this->isajax )
		{
			/* Load AJAX Class if is needed */
			$classToLoad = IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classAjax.php', 'classAjax' );
			$this->ajax  = new $classToLoad();
		}
		
		$this->url = $this->registry->output->buildSEOUrl( "app=forums&module=forums&section=findpost&pid={$this->pid}", 'public' );

		if ( !in_array($this->memberData['member_group_id'], explode(',', $this->settings['pn_add_groups'] ) ) )
		{
			/* No access? Show error */
			if ( $this->isajax )
			{
				return $this->ajax->returnJsonArray( array( 'error' => $this->lang->words['pn_mod_only'], 'pid' => $this->pid ) );
			}
			$this->registry->output->redirectScreen( $this->lang->words['pn_mod_only'] , $this->url );
		}

		switch( $this->request['do'] )
		{
			case 'remove':
				$this->doRemove();
			break;
			case 'insert':
				$this->doInsert();
			break;
			case 'form':
			default:
				$this->_showForm();
			break;
		}
 	}

 	public function _showForm()
 	{
		/* Form action */
		$action = $this->settings['base_url'] . "app=forums&module=extras&section=postNotes&do=insert";
		//$action = $this->registry->output->buildSEOUrl( "app=forums&module=extras&section=postNotes&do=insert", 'public' );

		/* Link to post */
		$post = "<a href='{$this->url}' title='{$this->pid}' targer='_blank'>{$this->pid}</a>";

		/* Load form template */
		$html = $this->registry->output->getTemplate('topic')->pnForm($this->pid, $action, $post, $this->isajax);

		if ( $this->isajax )
		{
			return $this->ajax->returnHtml( $html );
		}

		/* If no ajax add content and set page title */
		$this->registry->output->addContent( $html );
		$this->registry->output->setTitle( $this->lang->words['pn_title'] . ' - ' . ipsRegistry::$settings['board_name'] );
		$css = $this->registry->output->getTemplate('topic')->pnCSS( );
		$this->registry->getClass('output')->addToDocumentHead( 'raw', $css );
		$this->registry->output->sendOutput();
 	}

 	public function doInsert()
 	{
		if ( IPS_DOC_CHAR_SET != "UTF-8" )
		{
			/*Not UTF and AJAX == troubles*/
			$this->request['note'] = IPSText::convertCharsets( $this->request['note'], "UTF-8", IPS_DOC_CHAR_SET );
		}
		
		/* Check if there is everything we need to add note */
		$toInsert = array( 	'pn_pid'	=> $this->pid,
							'pn_note'	=> trim( $this->DB->addSlashes( $this->request['note'] ) ),
							'pn_mid' 	=> intval( $this->memberData['member_id'] ),
							'pn_type'	=> intval( $this->request['type'] ),
							'pn_date'	=> time() );
		$empty = false;
		foreach( $toInsert as $k => $v )
		{
			if ( !isset($v) || !$v )
			{
				$empty = true;
				break;
			}
		}

		if ( $empty )
		{
			/* Ups. Something gone wrong and there is not enought data */
			if ( $this->isajax )
			{
				return $this->ajax->returnJsonArray( array( 'error' => $this->lang->words['pn_no_data'], 'pid' => $this->pid ) );
			}
			$this->registry->output->redirectScreen( $this->lang->words['pn_no_data'] , $this->url );
		}

		$bbcode = intval( $this->request['bbcode'] );

		if ( $bbcode )
		{
			/* BBCode,emots On; HTML Off */
			IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
			IPSText::getTextClass('bbcode')->parse_html			= 0;
			IPSText::getTextClass('bbcode')->parse_nl2br		= 1;
			IPSText::getTextClass('bbcode')->parse_emoticons	= 1;
			IPSText::getTextClass('bbcode')->parsing_section	= 'post';
			IPSText::getTextClass('bbcode')->bypass_badwords	= true;

			/* Parse BBCode before inserting to DB */
			$toInsert['pn_note']	= IPSText::getTextClass('bbcode')->preDbParse( $toInsert['pn_note'] );
		}
		
		/* Insert note and check note id */
		$this->DB->insert( 'post_notes', $toInsert );
		$pnid = $this->DB->getInsertId();

		$this->DB->build( array( 
								'select'   => 'p.*',
								'from'	   => array( 'posts' => 'p' ),
								'where'    => "p.pid={$this->pid}",
								'add_join' => array( array( 'select' => 't.*',
															'from'   => array( 'topics' => 't' ),
															'where'  => 'p.topic_id=t.tid',
															'type'   => 'left' ) ) ) );

		$this->DB->execute();
		$row = $this->DB->fetch();
		
		$this->url = $this->registry->output->buildSEOUrl( "showtopic={$row['topic_id']}&findpost={$row['pid']}", 'public', $row['title_seo'], 'showtopic' );
		
		/* Now it's time to refresh topic */
		if ( $this->settings['pn_topic_refresh'] )
		{
			/* Update topic */
			$this->DB->update( 'topics', array( 'last_post' => time() ), 'tid='.$row['tid'] );
			
			$dbs = array( 'last_title'       => $row['title'],
						  'seo_last_title'   => $row['title_seo'],
						  'last_id'          => $row['tid'],
						  'last_post'        => time(),
						  'last_poster_name' => $row['last_poster_name'],
						  'seo_last_name'    => $row['seo_last_name'],
						  'last_poster_id'   => $row['last_poster_id'],
						  'last_x_topic_ids' => $this->registry->class_forums->lastXFreeze( $this->registry->class_forums->buildLastXTopicIds( $row['forum_id'], FALSE ) )
						 );
			/* And forum */
			$this->DB->update( 'forums', $dbs, "id=".intval($row['forum_id']) );

			/* Mark as read for note autor */
			$this->registry->getClass('classItemMarking')->markRead( array( 'forumID' => $row['forum_id'], 'itemID' => $row['tid'] ) );
		}
		/* Log moderator action */
		$this->DB->insert( 'moderator_logs', array( 'forum_id'    => $row['forum_id'],
													'topic_id'    => $row['topic_id'],
													'post_id'     => $this->pid,
													'member_id'   => $this->memberData['member_id'],
													'member_name' => $this->memberData['members_display_name'],
													'ip_address'  => $this->memberData['ip_address'],
													'http_referer'=> htmlspecialchars( my_getenv('HTTP_REFERER') ),
													'ctime'       => time(),
													'topic_title' => $row['title'],
													'action'      => $this->lang->words['pn_inserted'] . $pnid,
													'query_string'=> htmlspecialchars( my_getenv( 'QUERY_STRING' ) ) )	);

		if ( $this->settings['pn_notify'] && $row['author_id '] != $this->memberData['member_id'] )
		{
			$classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
			$notifyLibrary		= new $classToLoad( ipsRegistry::instance() );

			$author = IPSMember::load( $row['author_id'], 'core' );
	
			$member = $this->memberData;

			$author['language'] = $author['language'] == "" ? IPSLib::getDefaultLanguage() : $author['language'];

			/* 3 types of note */
			switch( $toInsert['pn_type'] )
			{
				/* Warn */
				case 1: 
					$type = $this->lang->words['pn_warn'];
				break;
				/* Info */
				case 2:
					$type = $this->lang->words['pn_info'];
				break;
				/* General */
				default:
					$type = $this->lang->words['pn_general'];
			}

			$ndata = array( 'AUTHOR'	=> $author['members_display_name'],
							'NAME'		=> $member['members_display_name'],
							'TYPE'		=> $type,
							'MEMBERURL'	=> ipsRegistry::getClass('output')->buildSEOUrl( "showuser={$member['member_id']}", 'public', $member['members_seo_name'], 'showuser' ),
							'URL'		=> $this->url );
										
			IPSText::getTextClass('email')->getTemplate( 'pn_notificontent', $author['language'], 'public_forums', 'forums' );

			IPSText::getTextClass('email')->buildMessage( $ndata );
			IPSText::getTextClass('email')->subject	= sprintf( 
																IPSText::getTextClass('email')->subject, 
																$this->url,
																$member['members_display_name'],
																$type
															);

			$notifyLibrary->setMember( $author );
			$notifyLibrary->setFrom( $member );
			$notifyLibrary->setNotificationKey( 'post_notes' );
			$notifyLibrary->setNotificationUrl( $this->url );
			$notifyLibrary->setNotificationText( IPSText::getTextClass('email')->message );
			$notifyLibrary->setNotificationTitle( IPSText::getTextClass('email')->subject );

			try
			{
				$notifyLibrary->sendNotification();
			}
			catch( Exception $e ){ }
		}
		/* If it is ajax return prepared note to display */
		if ( $this->isajax )
		{
			/* 3 types of note */
			switch( $toInsert['pn_type'] )
			{
				/* Warn */
				case 1: 
					$style = 'class="pnmessage error"';
				break;
				/* Info */
				case 2:
					$style = 'class="pnmessage"';
				break;
				/* General */
				default:
					$style = 'class="pnmessage unspecific"';
			}

			/* Build formated showuser link */
			$member = "<a href='" . $this->registry->output->buildSEOUrl( 'showuser=' . $this->memberData['member_id'], 'public', $this->memberData['members_seo_name'], 'showuser' ) . "' class='url fn ___hover___member _hoversetup' hovercard-id='{$this->memberData['member_id']}' hovercard-ref='member' style='text-decoration:none;' title='{$this->lang->words['bbc_member_bbcode']}'>" . IPSMember::makeNameFormatted( $this->memberData['members_display_name'], $this->memberData['member_group_id'] ) . "</a>";

			/* Format time */
			$time = $this->registry->class_localization->formatTime( time(), 'LONG' );

			/* And create link(image) to remove this note */
			$cross = str_replace( "{style_image_url}", $this->settings['img_url'], $this->registry->getClass('output')->getReplacement( "remove_poll_question" ) );
			$remove = "<a id='pnc-{$pnid}' href='" . $this->registry->output->buildSEOUrl( "app=forums&module=extras&section=postNotes&do=remove&pid={$this->pid}&pnid={$pnid}", 'public' ) . "' class='pn-cross' style='float:right;' title='{$this->lang->words['pn_remove']}'>" . $cross . "</a>";

			if ( $bbcode )
			{
				/* Parse BBCode */
				$toInsert['pn_note']	= IPSText::getTextClass('bbcode')->preDisplayParse( $toInsert['pn_note'] );
				$toInsert['pn_note']	= $this->registry->output->replaceMacros( $toInsert['pn_note'] );
			}
			
			/* Join everything together */
			$toAdd = <<< HTML
<div id='pnn-{$pnid}' $style><b>{$member} ($time): </b>$remove<br>
{$toInsert['pn_note']}
</div>
HTML;

			/* Return formated note and post id */
			return $this->ajax->returnJsonArray( array( 'error' => false, 'html' => $toAdd, 'pid' => $this->pid, 'pnid' => $pnid ) );
		}

		/* Or redirect to the post */
 		$this->registry->output->silentRedirect( $this->url, 'false' );
 	}
 	
 	public function doRemove()
 	{
		$pnid = intval( $this->request['pnid'] );

		/* Remove note */
		$this->DB->delete( 'post_notes', "pn_id={$pnid} AND pn_pid={$this->pid}" );

		/* Load post topic data... */
		$this->DB->build( array( 
								'select'   => 'p.*',
								'from'	   => array( 'posts' => 'p' ),
								'where'    => "p.pid={$this->pid}",
								'add_join' => array( array( 'select' => 't.*',
															'from'   => array( 'topics' => 't' ),
															'where'  => 'p.topic_id=t.tid',
															'type'   => 'left' ) ) ) );

		$this->DB->execute();
		$row = $this->DB->fetch();

		/* ...to use in moderator logs */
		$this->DB->insert( 'moderator_logs', array( 'forum_id'    => $row['forum_id'],
													'topic_id'    => $row['topic_id'],
													'post_id'     => $this->pid,
													'member_id'   => $this->memberData['member_id'],
													'member_name' => $this->memberData['members_display_name'],
													'ip_address'  => $this->memberData['ip_address'],
													'http_referer'=> htmlspecialchars( my_getenv('HTTP_REFERER') ),
													'ctime'       => time(),
													'topic_title' => $row['title'],
													'action'      => $this->lang->words['pn_removed'] . $pnid,
													'query_string'=> htmlspecialchars( my_getenv( 'QUERY_STRING' ) ) )	);

		if ( $this->isajax )
		{
			/* If ajax return note id to remove it from html */
			return $this->ajax->returnJsonArray( array( 'error' => false, 'pnid' => $pnid ) );
		}

		/* Or redirect to the post */
 		$this->registry->output->silentRedirect( $this->url, 'false' );
 	}
}
