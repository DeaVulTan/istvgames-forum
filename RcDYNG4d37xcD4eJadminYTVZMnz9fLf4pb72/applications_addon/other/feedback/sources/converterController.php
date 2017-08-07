<?php

/**
 * Converter Controller
*/

abstract class feedbackConverter
{
	public $linkCache = array();

	public function __construct()
	{
		$this->registry =	ipsRegistry::instance();
		$this->request  =&	$this->registry->fetchRequest();
		$this->settings  =&	$this->registry->fetchSettings();
		$this->DB		=	$this->registry->DB();

		/* Compatibility for users with an older Converters App */
		$this->_convLinkTopic = $this->DB->checkForTable('conv_link_topics') ? 'conv_link_topics' : 'conv_link';
	}

	abstract public function checkRequirements();

	abstract public function convertRow($row);

	abstract public function getConverterInfo();

	public function getLink($fId, $type)
	{
		if (!$fId or !$type)
		{
			return 0;
		}
		if ( isset($this->linkCache[$type][$fId]) )
		{
			return $this->linkCache[$type][$fId];
		}
		else
		{
			switch( $type )
			{
				case 'topics':
					$table = $this->_convLinkTopic;
				break;
				default:
					$table = 'conv_link';
				break;
			}

			$appid = $_SESSION['feedbackConvertUseApp'];
			$where = "cla.app_key = '{$appid}'";
			if(is_array($appid))
			{
				$where = '(';
				foreach($appid as $a)
				{
					$where .= $where != '(' ? ' OR ': '';
					$where .= "cla.app_key='{$a}'";
				}
				$where .= ')';
			}

			$row = $this->DB->buildAndFetch( array( 'select'	=> 'cl.ipb_id',
													'from'		=> array($table => 'cl'),
													'add_join'	=> array(
																		array(
																			'from'		=> array( 'conv_apps' => 'cla' ),
																			'type'		=> 'left',
																			'where'     => 'cl.app=cla.app_id'
																			)
																		),
													'where'		=> "cl.foreign_id='{$fId}' AND cl.type='{$type}' AND {$where}" ) );

			if(!$row)
			{
				return 0;
			}

			$this->linkCache[$type][$fId] = $row['ipb_id'];
			return $row['ipb_id'];
		}
	}
}
?>