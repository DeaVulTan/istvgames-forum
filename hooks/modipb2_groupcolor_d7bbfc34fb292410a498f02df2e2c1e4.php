<?php

 	/**
	 * Show Forums Moderators 3.1.2
	 */	

class modipb2_groupcolor extends admin_forums_forums_moderator
{
	/**
	 * Rebuild moderator cache
	 *
	 * @return	void		[Outputs to screen]
	 */
	public function rebuildModeratorCache()
	{
		$new_cache = array();
		
		//-----------------------------------------
		// Get dem moderators
		//-----------------------------------------
		
		$this->DB->build( array( 'select'   => 'moderator.*',
					 'from'     => array( 'moderators' => 'moderator' ),
					 'order' => 'member_name ASC, group_name ASC',
					 'add_join' => array( 0 => array( 'select' => 'm.members_display_name, m.members_seo_name, m.member_group_id',
									  'from'   => array( 'members' => 'm' ),
									  'where'  => "m.member_id=moderator.member_id",
									  'type'   => 'left' ) ) ) );
		
		$this->DB->execute();
		
		while ( $i = $this->DB->fetch() )
		{
			$forums	= explode( ',', IPSText::cleanPermString( $i['forum_id'] ) );
			
			/* Unpack bitwise fields */
			$_tmp = IPSBWOptions::thaw( $i['mod_bitoptions'], 'moderators', 'forums' );

			if ( count( $_tmp ) )
			{
				foreach( $_tmp as $k => $v )
				{ 
					$i[ $k ] = $v;
				}
			}
			
			foreach( $forums as $forum_id )
			{
				$i['forum_id']	= $forum_id;
				$new_cache[]	= $i;
			}
		}
		
		$this->cache->setCache( 'moderators', $new_cache, array( 'array' => 1, 'donow' => 0 ) );
	}
}