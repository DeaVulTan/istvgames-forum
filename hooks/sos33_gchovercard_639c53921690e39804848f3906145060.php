class sos33_gchovercard extends shoutboxGlobalJs
{
	function userHoverCard($member=array())
	{
		$formatted = IPSMember::makeNameFormatted( $member['members_display_name'], $member['member_group_id'] );
		
		
		if($member['members_display_name'] != $formatted)
		{
			$member['members_display_name'] = $formatted;
		}

		return parent::userHoverCard($member);
	}
}