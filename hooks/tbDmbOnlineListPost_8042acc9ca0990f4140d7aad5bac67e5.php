<?php
/**
 * (TB) Display Members Browser
 * @file		tbDmbOnlineListPost.php 	Template hook (skin_online > showOnlineList)
 *
 * @copyright	(c) 2006 - 2012 Invision Byte
 * @link		http://www.invisionbyte.net/
 * @author		Terabyte
 * @since		31/05/2010
 * @updated		12/05/2012
 * @version		3.0.0 (30000)
 */
class tbDmbOnlineListPost
{
	public $registry;
	public $settings;
	
	public function __construct()
	{
		/* Make registry objects */
		$this->registry   =  ipsRegistry::instance();
		$this->settings   =& $this->registry->fetchSettings();
	}
	
	public function getOutput()
	{
		return '';
	}
	
	public function replaceOutput( $output, $key )
	{
		if ( $this->settings['tb_dmb_position'] == 'after' )
		{
			// Include our api and check perms
			require_once( IPS_ROOT_PATH . 'sources/classes/useragents/tbDisplayMembersBrowser.php' );
			tbDisplayMembersBrowser::init();
			
			/* Can we see it? =O */
			if ( tbDisplayMembersBrowser::canSeeImage() && ! empty($this->registry->output->getTemplate('online')->functionData['showOnlineList'][0]['rows']) )
			{
				/* Init some vars */
				$tag	= '<!--hook.' . $key . '-->';
				$tagLen = strlen( $tag );
				$last	= 0;
				
				/* Loop our results */
				foreach( $this->registry->output->getTemplate('online')->functionData['showOnlineList'][0]['rows'] as $_id => $_data )
				{
					$pos = strpos( $output, $tag, $last );
					
					if( $pos !== FALSE )
					{
						if ( ! empty($_data['_memberData']['member_id']) )
						{
							$string	= tbDisplayMembersBrowser::getImage( $_data, '', true );
							$output	= substr_replace( $output, $string . $tag, $pos, $tagLen ); 
							$last	= $pos + $tagLen + strlen( $string );
						}
						else
						{
							$last	= $pos + $tagLen;
						}
					}
					else
					{
						/* Not found, useless to go on... */
						break;
					}
				}
			}
		}
		
		return $output;
	}
}