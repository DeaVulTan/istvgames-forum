<?php

/**
 * Content Spy Plugin
 */

class spyPluginFeedback implements spyPlugin
{
	public $preParseData	=	array();

	private $_access		=	FALSE;

	function __construct($registry)
	{
		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->lang		= $this->registry->getClass('class_localization');
		$this->settings =& $this->registry->fetchSettings();

		/* Load Feedback Class */
		IPSRegistry::getAppClass('feedback');

        if ( $this->registry->permissions->check( 'view', $this->registry->feedback->getPermissions() ) )
        {
			$this->_access = TRUE;
		}
	}

	/**
	 * Check user can access this data
	 *
	 * @param	array		spy data
	 * @return	boolean
	 */
	public function checkPermissions($data)
	{
		return $this->_access;
	}

	/**
	 * Pre-parse data, add topic id to variable
	 * so we can grab the data efficiently in one query later
	 *
	 * @param	array		spy data
	 */
	public function preParseData($data)
	{
		$this->preParsedData[] = $data;
		$this->userIds[$data['type_2_id']] = $data['type_2_id'];
	}

	/**
	 * Parse data for output
	 *
	 * @param	array		spy data
	 * @return	array		parse data
	 */
	public function parseData($data)
	{
		$user = $this->getUser($data['type_2_id']);

		$data['where'] = IPSLib::getAppTitle('feedback');
		$data['where_link'] = ipsRegistry::getClass('output')->buildSEOUrl( 'app=feedback', 'public', 'none', 'feedback' );

		$data['prefix'] .= "<p class='ipsBadge feedbackBadge_{$this->registry->feedback->badges[$data['type_id']]['colour']}'>{$this->registry->feedback->badges[$data['type_id']]['symbol']}</p>";

		$data['what'] = sprintf(
								$this->lang->words['feedback_spy_row'],
								$user['members_display_name']
								);
		$data['replies'] = '&nbsp;';

		$data['what_link'] = ipsRegistry::getClass('output')->buildSEOUrl('showuser='.$data['type_2_id'].'&amp;tab=feedback', 'public', $user['members_seo_name'], 'showuser');

		$data['data_type_clean'] = $this->dataTypes($data['data_type']);

		return $data;
	}

	/**
	 * Grab a location from a local cache
	 *
	 * @param	integer		topic id
	 * @return	array		topic row
	 */
	public function getUser($id)
	{
		if(isset($this->userCache[$id]))
		{
			return $this->userCache[$id];
		}

		$this->getUsers($this->userIds);

		return $this->userCache[$id];
	}

	/**
	 * Get all location IDs from database
	 *
	 * @param	array		topic ids
	 */
	public function getUsers($ids)
	{
		$this->userCache = IPSMember::load($ids);
	}

	/**
	 * Define language strings for data types
	 *
	 * @param	string		data type
	 * @return	string		data type language
	 */
	private function dataTypes($type)
	{
		$types = array(	'new_feedback'	=>	$this->lang->words['feedback_spy_add']);

		return $types[$type];
	}
}
?>