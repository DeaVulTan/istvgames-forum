<?php

class fc_RepBarUserinfopane
{
  protected $registry;
  protected $settings;
	
	public function __construct()
	{
		/* Make registry objects */
		$this->registry = ipsRegistry::instance();
		$this->settings =& $this->registry->fetchSettings();
	}
	
	public function getOutput()
	{
		/* Return */
		return;
	}
	
	public function replaceOutput( $output, $key )
	{ 
	  if ( $this->settings['fcRepBar'] )
	    {
		/* Got some data? */
		if ( is_array( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] ) && count( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] ) )
		{
			/* Init some vars */
			$tag  = '<!--hook.' . $key . '-->';
			$last = 0;
			
			/* Loop through each template call */
			foreach ( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $k => $v )
			{
				/* See if we can find this hook point */
				$pos = strpos( $output, $tag, $last );
				
				/* Found? */
				if ( $pos !== FALSE )
				{

					$string = $this->registry->output->getTemplate('global')->fcRepBar( $v['author'] );
					$output = substr_replace( $output, $string . $tag, $pos, strlen( $tag ) ); 
					$last   = $pos + strlen( $tag . $string );
				}
			}
		}
	    }
		
		/* Return */
		return $output;
	}
}
