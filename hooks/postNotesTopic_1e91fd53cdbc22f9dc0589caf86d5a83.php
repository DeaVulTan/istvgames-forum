/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.1
 * Last Updated: August 30, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.0.7 (Revision 10007)
 */

class postNotesTopic extends skin_topic(~id~)
{
	public function topicViewTemplate($forum, $topic, $post_data, $displayData)
	{
		if ( !$this->settings['pn_enabled'] )
		{
			/* System Offline */
			return parent::topicViewTemplate($forum, $topic, $post_data, $displayData);
		}

		if ( !in_array($this->memberData['member_group_id'], explode(',', $this->settings['pn_view_groups'] ) ) )
		{
			/* No access to view */
			return parent::topicViewTemplate($forum, $topic, $post_data, $displayData);
		}

		$notes = array();
		$members = array();

		/* Select notes and their autors */
		$this->DB->build( array( 
								'select'   => 'pn.*',
								'from'	   => array( 'post_notes' => 'pn' ),
								'where'	   => "pn.pn_pid IN(" . implode( ',', array_keys($post_data) ) . ")",
								'order'	   => "pn.pn_date ASC",
								'add_join' => array( array( 'select' => 'm.member_id, m.member_group_id, m.members_display_name, m.members_seo_name',
															'from'   => array( 'members' => 'm' ),
															'where'  => 'm.member_id=pn.pn_mid',
															'type'   => 'left' ) ) ) );

		$db = $this->DB->execute();
		while ( $row = $this->DB->fetch( $db ) )
		{
			$notes[$row['pn_pid']][] = $row;
		}

		/* "X" image */
		$cross = $this->registry->getClass('output')->getReplacement( "remove_poll_question" );
		
		foreach( $post_data as $pid => $data )
		{
			if ( !isset( $notes[$pid] ) || !is_array( $notes[$pid] ) || !count( $notes[$pid] ) )
			{
				continue;
			}
			
			$toAdd = "";
			
			foreach( $notes[$pid] as $pn )
			{
				/* 3 types of note */
				switch( $pn['pn_type'] )
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
				
				if ( !$members[$pn['member_id']] )
				{
					/* Build member link only once per member */
					$members[$pn['member_id']] = "<a href='" . $this->registry->output->buildSEOUrl( 'showuser=' . $pn['member_id'], 'public', $pn['members_seo_name'], 'showuser' ) . "' class='url fn ___hover___member _hoversetup' hovercard-id='{$pn['member_id']}' hovercard-ref='member' style='text-decoration:none;' title='{$this->lang->words['bbc_member_bbcode']}'>" . IPSMember::makeNameFormatted( $pn['members_display_name'], $pn['member_group_id'] ) . "</a>";
				}

				$time = $this->registry->class_localization->formatTime( $pn['pn_date'], 'LONG' );

				/* Access only for moderators so check moderator privileges */
				$ssn = ipsRegistry::member()->sessionClass()->session_data;
				$mbr = IPSMember::setUpModerator( ipsRegistry::member()->fetchMemberData() );

				$remove = "";
				if ( in_array($this->memberData['member_group_id'], explode(',', $this->settings['pn_add_groups'] ) ) )
				{
					/* Show "remove note" link only for moderators */
					$remove = "<a id='pnc-{$pn['pn_id']}' href='" . $this->registry->output->buildSEOUrl( "app=forums&module=extras&section=postNotes&do=remove&pid={$pid}&pnid={$pn['pn_id']}", 'public' ) . "' class='pn-cross' style='float:right;' title='{$this->lang->words['pn_remove']}'>" . $cross . "</a>";
				}

				/* BBCode,emots On; HTML Off */
				IPSText::getTextClass('bbcode')->parse_bbcode		= 1;
				IPSText::getTextClass('bbcode')->parse_html			= 0;
				IPSText::getTextClass('bbcode')->parse_nl2br		= 1;
				IPSText::getTextClass('bbcode')->parse_emoticons	= 1;
				IPSText::getTextClass('bbcode')->parsing_section	= 'post';
				IPSText::getTextClass('bbcode')->bypass_badwords	= true;

				/* Parse BBCode and replace strings like <#EMO_DIR#> */
				$pn['pn_note']	= IPSText::getTextClass('bbcode')->preDisplayParse( $pn['pn_note'] );
				$pn['pn_note'] = $this->registry->output->replaceMacros( $pn['pn_note'] );

				/* Note body */
				$toAdd .= <<< HTML
<div id='pnn-{$pn['pn_id']}' $style><b>{$members[$pn['member_id']]} ($time): </b>$remove<br>
	{$pn['pn_note']}
</div>
HTML;
			}

			/* Append notes to the end of post data */
			$post_data[$pid]["post"]["post"] = $data["post"]["post"] . "<br/></div>$toAdd<div>";
		}

		$output = parent::pnCSS();
		$output .= parent::topicViewTemplate($forum, $topic, $post_data, $displayData);

		return $output;
	}
}
