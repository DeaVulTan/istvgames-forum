<?php
/**
 * (TB) Display Members Browser
 * @file		tbDisplayMembersBrowser.php 	Provides methods for the 'Display Members Browser' modification
 *
 * @copyright	(c) 2006 - 2012 Invision Byte
 * @link		http://www.invisionbyte.net/
 * @author		Terabyte
 * @since		07/06/2009
 * @updated		13/05/2012
 * @version		3.0.0 (30000)
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

/**
 * @class		tbDisplayMembersBrowser
 * @brief		Provides methods for the 'Display Members Browser' modification
 */
class tbDisplayMembersBrowser
{
	/**
	 * Flag to check for initialization
	 *
	 * @var		$initialized
	 */
	private static $initialized = FALSE;
	
	/**
	 * User-agents cache array
	 *
	 * @var		$userAgents
	 */
	private static $userAgents = array();
	
	/**
	 * Flag to keep track if the member can see the image
	 *
	 * @var		$canSeeImage
	 */
	private static $canSeeImage = FALSE;
	
	/**
	 * Check is the variables are already initialized
	 *
	 * @return	@e bool
	 */
	static public function isInitialized()
	{
		return ( self::$initialized === TRUE ) ? TRUE : FALSE;
	}
	
	/**
	 * Initializes the class: groups that can see & user-agents
	 *
	 * @return	@e void
	 */
	static public function init()
	{
		if ( ! self::isInitialized() )
		{
			if ( ipsRegistry::$settings['tb_dmb_groups'] )
			{
				$memberData = &ipsRegistry::member()->fetchMemberData();
				
				if ( IPSMember::isInGroup( $memberData, explode(',', ipsRegistry::$settings['tb_dmb_groups']) ) )
				{
					self::$canSeeImage = TRUE;
					
					/* If the member can see get the user-agents too then.. */
					self::$userAgents = ipsRegistry::cache()->getCache('useragents');
				}
			}
			
			/* Yeah, initialized now! */
			self::$initialized = TRUE;
		}
	}
	
	/**
	 * Check is the logged in user can see the image
	 *
	 * @return	@e bool
	 */
	static public function canSeeImage()
	{
		return self::$canSeeImage;
	}
	
	/**
	 * Get's the proper image tag for display
	 *
	 * @param	array		$session			Data of the session to parse
	 * @param	string		$overrideName		Override the session name
	 * @param	boolean		$stripName			If TRUE strips the name from the returned string
	 * @param	boolean		$checkPerms			Check if the user can actually view the image
	 * @return	@e string	Session name with image added
	 */
	static public function getImage( $session, $overrideName='', $stripName=false, $checkPerms=false )
	{
		/* Override? */
		if ( $overrideName )
		{
			$session['member_name'] = $overrideName;
		}
		
		/* No data or name? */
		if ( ! is_array($session) || empty($session['member_name']) )
		{
			return '';
		}
		
		/* Cannot view? */
		if ( $checkPerms && ! self::$canSeeImage )
		{
			return $session['member_name'];
		}
		
		/* Setup our uagent_key if missing - saves 4 file edits, yay! */
		if ( ! IN_ACP && empty($session['uagent_key']) && $session['member_id'] > 0 && $session['member_id'] == ipsRegistry::member()->getProperty('member_id') )
		{
			$session['uagent_key'] = ipsRegistry::member()->sessionClass()->session_data['uagent_key'];
		}
		
		/* Check existence */
		if ( $session['uagent_key'] == '__NONE__' || ! isset(self::$userAgents[ $session['uagent_key'] ]) )
		{
			$browser = 'question';
			$text    = ipsRegistry::getClass('class_localization')->words['tb_dmb_unknown'];
		}
		else
		{
			/* The image exists? */
			$browser = $session['uagent_key'];
			$text    = self::$userAgents[ $session['uagent_key'] ]['uagent_name'];
		}
		
		$image = "<img src='" . ipsRegistry::$settings['public_cdn_url'] . "style_extra/downloads_traffic_images/browser_{$browser}.png' alt='{$text}' title='{$text}' width='14' height='14' border='0' />";
		
		/* Strip name? */
		$session['member_name'] = $stripName ? '' : $session['member_name'];
		
		/* Sort image position */
		if ( ipsRegistry::$settings['tb_dmb_position'] != 'after' )
		{
			return $image . '&nbsp;' . $session['member_name'];
		}
		else
		{
			return $session['member_name'] . '&nbsp;' . $image;
		}
	}
}