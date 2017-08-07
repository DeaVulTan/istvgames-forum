class pipsAndTeamIcons extends skin_global(~id~)
{
	public function userInfoPane( $author, $contentid, $options )
	{
		/* Only do something if they have a Team Icon */
		if ( $this->caches['group_cache'][ $author['member_group_id'] ]['g_icon'] )
		{
			/* INIT */
			$_pips = "";
			
			/* Set our type to something other than 'img' */
			$author['member_rank_img_i'] = 'foo';
			
			/* Loop through the ranks to find the pip level */
			if ( is_array( $this->caches['ranks'] ) && count( $this->caches['ranks'] ) )
			{
				foreach ( $this->caches['ranks'] as $k => $v )
				{
					if ( $author['posts'] >= $v['POSTS'] )
					{
						$pips = $v['PIPS'];
						break;
					}
				}
			}
			
			/* Show a series of pip images? */
			if ( is_numeric( $pips ) )
			{
				for ( $i = 1; $i <= $pips; ++$i )
				{
					$_pips .= $this->registry->output->getReplacement('pip_pip');
				}
			}
			
			/* Or show a specific pip image? */
			else
			{
				$_pips = "<img src='" . $this->settings['public_dir'] . "style_extra/team_icons/" . $pips . " 'alt='' />";
			}
			
			/* Set the new Rank Image html */
			$author['member_rank_img'] = "<img src='{$author['member_rank_img']}' alt='' /><br />" . $_pips;
		}
		
		/* Return */
		return parent::userInfoPane( $author, $contentid, $options );
	}
}