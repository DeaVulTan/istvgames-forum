<?php
/**
 * (TB) Display Members Browser
 * @file		tbDmbBoardIndex.php 	Library hook (session_api)
 *
 * @copyright	(c) 2006 - 2012 Invision Byte
 * @link		http://www.invisionbyte.net/
 * @author		Terabyte
 * @since		12/05/2012
 * @version		3.0.0 (30000)
 */
class tbDmbSessionApi extends session_api
{
	public function getUsersIn( $app, $options=array() )
	{
		$users = parent::getUsersIn( $app, $options );
		
		/* Got results? */ 
		if ( is_array($users['names']) && count($users['names']) )
		{
			/* Include our api and parse themzz */
			require_once( IPS_ROOT_PATH . 'sources/classes/useragents/tbDisplayMembersBrowser.php' );
			tbDisplayMembersBrowser::init();
			
			if ( tbDisplayMembersBrowser::canSeeImage() )
			{
				foreach( $users['names'] as $sid => $name )
				{
					if ( isset($users['rows']['members'][ $sid ]) )
					{
						$users['names'][ $sid ] = tbDisplayMembersBrowser::getImage( $users['rows']['members'][ $sid ], $name );
					}
					elseif ( isset($users['rows']['anon'][ $sid ]) )
					{
						$users['names'][ $sid ] = tbDisplayMembersBrowser::getImage( $users['rows']['anon'][ $sid ], $name );
					}
				}
			}
		}
		
		return $users;
	}
}