<?php

/**
 * Convert to Trader Feedback System

 */

if ( ! defined( 'IN_ACP' ) )
{
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
    exit();
}

class admin_feedback_tools_convert extends ipsCommand
{
	private	static $_converters = array();
	public $perCycle = 40;

    /**
     * Class entry point
     *
     * @access	public
     * @param	object		Registry reference
     * @return	void		[Outputs to screen/redirects]
     */
    public function doExecute( ipsRegistry $registry )
    {
		@session_start();
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_converters' );

		/* Check for the IPS Converters */
		$this->_checkForConverters();

		switch($this->request['action'])
		{
			default:
				$this->getConverterChoice();
			break;
			case 'converter_information':
				$this->getConverterInfo();
			break;
			case 'convert':
				$this->doConversion();
			break;
		}

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }

	public function doConversion()
	{
		/* Connect to the SQL server */
		$this->_connectToConvertSql();

		/* Get the Datbase Object */
		$remote = IPSRegistry::DB('fbConv');

		/* Get our converter of choice */
		$conv = $this->_getConverter($_SESSION['feedbackConvertConverter']);

		$done = isset($this->request['done']) ? intval($this->request['done']) : 0;
		$skip = isset($this->request['skip']) ? intval($this->request['skip']) : 0;

		$c = $remote->buildAndFetch(array(	'select' => 'count(i.rateid) as cnt',
											'from'   => array( 'itrader' => 'i' )));

		$remote->build(array(	'select' => 'i.*',
								'from'   => array( 'itrader' => 'i' ),
								'order'	 => 'rateid ASC',
								'limit'	 => array($done, $this->perCycle)));
		$q = $remote->execute();

		if(!$remote->getTotalRows($q))
		{
			/* Lets Start */
			$txt = 'Finished Analysing '.$c['cnt'].' rows.';
			$txt .= $skip ? ' '.$skip.' rows skipped (user cannot be found).' : '';
			$txt .= ' The Profile Data rebuild process will now begin..';
			$this->_redirect( $this->settings['base_url']."module=feedback&amp;module=tools&amp;&amp;section=rebuild&amp;action=feedback", $txt, 5 );
		}

		while($m = $remote->fetch($q))
		{
			/* Convert */
			$data = $conv->convertRow($m);

			/* Global Conversion */
			$data['sender']		= $conv->getLink($data['sender'], 'members');
			$data['receiver']	= $conv->getLink($data['receiver'], 'members');
			$data['link']		= $conv->getLink($data['link'], 'topics');

			if(!$data || !$data['sender'] || !$data['receiver'])
			{
				$skip++;
				$done++;
				continue;
			}

			/* Mark is as a converted row */
			$data['conv'] = 1;

			/* Insert Data */
			$this->DB->insert('feedback', $data);

			/* 1, 2, 3... */
			$done++;
		}

		/* Next load */
		$txt = 'Analysing '.$done.' rows of '.$c['cnt'];
		$txt .= $skip ? ', '.$skip.' rows skipped (user cannot be found)' : '.';
		$this->_redirect( $this->settings['base_url']."module=feedback&amp;module=tools&amp;section=convert&amp;action=convert&amp;done={$done}&amp;skip={$skip}", $txt );
	}

	public function getConverterChoice()
	{
		$list = $this->_getConverterList();
		$this->registry->output->html = $this->html->converterChoice($list);
	}

	public function getConverterInfo()
	{
		$converter = $this->_getConverter($this->request['converter'])->getConverterInfo();

		/* Which Converter are we using? */
		$_SESSION['feedbackConvertConverter'] = $this->DB->addSlashes($this->request['converter']);

		/* Get the Conversion App List */
		$app = $this->_getIpsConvInfo($converter['conv_app_key']);

		/* No Apps.. Can't convert deal topics */
		if(!count($app))
		{
			$this->registry->output->html		= $this->html->converterInfoError('app');
			$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
			$this->registry->output->sendOutput();
			exit;
		}

		/* Set the conversion key */
		$_SESSION['feedbackConvertUseApp'] = $converter['conv_app_key'];

		$this->processInformation();
		return;
	}

	public function processInformation()
	{
		/* Get our converter of choice */
		$c = $this->_getConverter($_SESSION['feedbackConvertConverter']);
		$x = $c->getConverterInfo();

		$ips = $this->_getIpsConvInfo($x['conv_app_key']);
		$_SESSION['feedbackConvDb']['user']		= $ips['db_user'];
		$_SESSION['feedbackConvDb']['host']		= $ips['db_host'];
		$_SESSION['feedbackConvDb']['pass']		= $ips['db_pass'];
		$_SESSION['feedbackConvDb']['db']		= $ips['db_db'];
		$_SESSION['feedbackConvDb']['prefix']	= $ips['db_prefix'];
		$_SESSION['feedbackConvDb']['char']		= $ips['db_charset'];

//		try
//		{
			/* Make sure we can connect */
			$this->_connectToConvertSql();
//		}
//		catch(Exception $e)
//		{
//			/* It doesn't work */
//			echo 'nope.';
//			exit;
//		}

		/* Any checks the converter may need to do.. */
		$c->checkRequirements();

		/* Clear any previous conversion data */
		$this->_clearPreviousConversion();

		/* Lets Start */
		$this->_redirect( $this->settings['base_url']."module=feedback&amp;module=tools&amp;&amp;section=convert&amp;action=convert", 'Configuration OK!, Starting Conversion...' );
	}

	private function _clearPreviousConversion()
	{
		$this->DB->delete('feedback', 'conv=1');
	}

	private function _checkForConverters()
	{
		if(!IPSLib::appIsInstalled('convert', FALSE))
		{
			$this->registry->output->html		= $this->html->converterInfoError('missing');
			$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
			$this->registry->output->sendOutput();
			exit;
		}
	}

	private function _connectToConvertSql()
	{
		$settings = array(	'sql_database'		=>	$_SESSION['feedbackConvDb']['db'],
							'sql_user'			=>	$_SESSION['feedbackConvDb']['user'],
							'sql_pass'			=>	$_SESSION['feedbackConvDb']['pass'],
							'sql_host'			=>	$_SESSION['feedbackConvDb']['host'],
							'sql_socket'		=>	NULL,
							'sql_charset'		=>	$_SESSION['feedbackConvDb']['char'],
							'sql_tbl_prefix'	=>	$_SESSION['feedbackConvDb']['prefix']);

		ips_DBRegistry::setDB(	'mysql',
								'fbConv',
								$settings);
	}

	private function _filenameToKey($filename)
	{
		$n = explode('.', $filename);
		return $n[0];
	}

	private function _getConverter($key)
	{
		$key = strtolower($key);

		if ( ! isset( self::$_converters[ $key ] ) || ! is_object( self::$_converters[ $key ] ) )
		{
			$path = IPSLib::getAppDir( 'feedback' ).'/sources/converters/'.$key.'.php';

			if(file_exists($path))
			{
				require_once(IPSLib::getAppDir( 'feedback' ).'/sources/converterController.php');
				$className = 'feedbackConverter_'.$key;
				$classToLoad = IPSLib::loadLibrary( $path, $className, 'feedback' );

				if( ! class_exists($className) )
				{
					throw new exception('Feedback Converter does not exist: '.$className);
				}

				self::$_converters[$key] = new $classToLoad( ipsRegistry::instance() );
				return self::$_converters[$key];
			}
			else
			{
				throw new exception('Feedback Converter does not exist: '.$className);
			}
		}
		else
		{
			return self::$_converters[$key];
		}
	}

	private function _getConverterList()
	{
		$c = array();
		foreach(new DirectoryIterator(IPSLib::getAppDir( 'feedback' ).'/sources/converters') as $fileInfo)
		{
			if($fileInfo->isDot())
			{
				continue;
			}
			$key	= $this->_filenameToKey($fileInfo->getFilename());
			$info	= $this->_getConverter($key)->getConverterInfo();
			$c[] = array($info['key'], $info['name']);
		}
		return $c;
	}

	private function _getIpsConvInfo($key)
	{
		$key = is_array($key) ? implode("' OR ca.app_key='", $key) : $key;
		return $this->DB->buildAndFetch(array(	'select'	=>	'ca.*',
												'from'		=>	array('conv_apps' => 'ca'),
												'where'		=>	"ca.app_key='{$key}'"));
	}

	private function _redirect($url, $text, $time=2)
	{
		$this->registry->output->html		 = $this->registry->output->global_template->temporaryRedirect( $url, $text, $time );
		$this->registry->output->html_main	.= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
		return;
	}
}