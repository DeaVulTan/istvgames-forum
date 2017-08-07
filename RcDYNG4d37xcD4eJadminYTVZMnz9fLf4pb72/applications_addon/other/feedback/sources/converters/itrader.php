<?php

/**
 * Converter
*/

class feedbackConverter_itrader extends feedbackConverter
{
	/**
	 * Array of type conversions
	 */
	private $_type = array(	'1' => '1',
							'2' => '0',
							'3' => '2');

	/**
	 * Array of score conversions
	 */
	private $_score = array('-1'=> '0',
							'0'	=> '1',
							'1'	=> '2');

	public function checkRequirements()
	{
		return TRUE;
	}

	public function convertRow($row)
	{
		$score	= $this->_score[$row['rating']];
		$link	= $this->_parseTopicUrl($row['dealurl']);
		$type	= $this->_type[$row['buyselltrade']];

		$return = array('date'		=> $row['dateline'],
						'sender'	=> $row['userid'],
						'receiver'	=> $row['rateduserid'],
						'ip'		=> $row['ipaddress'],
						'note'		=> $row['subject'],
						'score'		=> $score,
						'link'		=> $link,
						'type'		=> $type);
		return $return;
	}

	public function getConverterInfo()
	{
		return array(	'key'			=>	'itrader',
						'name'			=>	'iTrader (vBulletin)',
						'conv_app_key'	=>	array('vbulletin', 'vbulletin_legacy'));
	}

	private function _parseTopicUrl($url)
	{
		$y = array();
		$x = parse_url($url, PHP_URL_QUERY);
		parse_str($x, $y);
		return intval($y['t']);
	}
}
?>