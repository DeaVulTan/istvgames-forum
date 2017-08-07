<?php
      
//-----------------------------------------------
// (DP32) Forum Icons
//-----------------------------------------------
//-----------------------------------------------
// Action Overloader
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 03 / 08 / 2011
//-----------------------------------------------
// Copyright (C) 2011 DawPi
// All Rights Reserved
//-----------------------------------------------    

class dp3_fi_forumsClassActionOverloader extends public_forums_forums_forums
{	
	/**
	 * Builds output array for sub forums
	 *
	 * @return	array
	 */
	public function showSubForums()
	{		
		/* Run parent */
		
		$dataToReturn = parent::showSubForums();
	
		/* Load library */
		
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forumicons' ) . '/sources/classes/library.php', 'fiLibrary', 'forumicons' );
		$this->registry->setClass( 'fiLibrary', new $classToLoad( $this->registry ) );	
		
		/* System is enabled? */
		
		if( $this->settings['dp3_fi_enable'] )
		{
			if( count( $dataToReturn ) )
			{

				foreach( $dataToReturn as $_id => $_data )
				{					
					foreach( $_data['forum_data'] as $forum_id => $forum_data )
					{
						/* Do we have icon? */

						if( $this->caches['fi_icons'][ $forum_data['id'] ]['i_location'] && $this->caches['fi_icons'][ $forum_data['id'] ]['i_enabled'] )
						{
							if( $this->settings['dp3_fi_mode'] == 'nextto' )
							{
								$dataToReturn[ $_id ]['forum_data'][ $forum_id ]['name'] = $this->registry->fiLibrary->makeForumIcon( $this->caches['fi_icons'][ $forum_data['id'] ]['i_location'] ) . ' ' . $forum_data['name'];
							}
							else
							{
								$dataToReturn[ $_id ]['forum_data'][ $forum_id ]['icon'] 		= $this->registry->fiLibrary->makeForumIcon( $this->caches['fi_icons'][ $forum_data['id'] ]['i_location'], !$forum_data['_has_unread'], true );
								$dataToReturn[ $_id ]['forum_data'][ $forum_id ]['icon_read'] 	= $this->registry->fiLibrary->makeForumIcon( $this->caches['fi_icons'][ $forum_data['id'] ]['i_location'], true, true );	
							}
								
						}
					}				
				}
			}
		}

		/* Return */
		
		return $dataToReturn;
	}	
} // End of class