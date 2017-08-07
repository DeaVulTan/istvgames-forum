<?php

/**
 * Permissions and Sessions
*/

$_PERM_CONFIG = array( 'Feedback' );

class feedbackPermMappingFeedback
{
    /**
    * Mapping of keys to columns
    *
    * @access	private
    * @var		array
    */
    private $mapping = array(
                            'view'		=> 'perm_view',
                            'add'		=> 'perm_2',
                         //   'edit'		=> 'perm_3',
                            'moderate'	=> 'perm_4'
                            );

    /**
    * Mapping of keys to names
    *
    * @access	private
    * @var		array
    */
    private $perm_names = array(
                            'view'		=> 'Может просматривать раздел Отзывы',
                            'add'		=> 'Может добавлять отзывы',
                        //    'edit'		=> 'Edit Feedback',
                            'moderate'	=> 'Может удалять отзывы'
                            );

    /**
    * Mapping of keys to background colors for the form
    *
    * @access	private
    * @var		array
    */
    private $perm_colors = array(
                            'view'		=> '#fff0f2',
                            'add'		=> '#effff6',
                         //   'edit'		=> '#fff0f2',
                            'moderate'	=> '#edfaff'
                            );

    /**
    * Method to pull the key/column mapping
    *
    * @access	public
    * @return	array
    */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
    * Method to pull the key/name mapping
    *
    * @access	public
    * @return	array
    */
    public function getPermNames()
    {
        return $this->perm_names;
    }

    /**
    * Method to pull the key/color mapping
    *
    * @access	public
    * @return	array
    */
    public function getPermColors()
    {
        return $this->perm_colors;
    }

    /**
    * Method to set the permissions
    *
    * @access	public
    * @return	array
    */
    public function getPermItems()
    {
        ipsRegistry::DB()->build( array('select'	=> 'p.perm_view, p.perm_2, p.perm_3, p.perm_4',
                                        'from'		=> array( 'permission_index' => 'p' ),
                                        'where'		=> "app='feedback' AND perm_type='feedback'"));

        ipsRegistry::DB()->execute();

        $r = ipsRegistry::DB()->fetch();

        $return =  array(1 => array('title'		=> 'Trader Feedback',
									'perm_view'	=> $r['perm_view'],
									'perm_2'	=> $r['perm_2'],
									'perm_4'	=> $r['perm_4'],
									'perm_3'	=> $r['perm_3']));

        return $return;
    }
}

class publicSessions__feedback
{

	public function getSessionVariables()
	{
		return array();
	}
	
	public function parseOnlineEntries( $rows )
	{
		if( !is_array($rows) OR !count($rows) )
		{
			return $rows;
		}

		$final = array();
		
		foreach( $rows as $row )
		{
			if( $row['current_appcomponent'] == 'feedback' )
			{
				$row['where_line'] = ipsRegistry::getClass( 'class_localization' )->words['title'];
			}
			
			$final[ $row['id'] ] = $row;
		}

		return $final;
	}
}

class feedback_findIpAddress
{

	protected $registry;
	
	public function __construct( ipsRegistry $registry )
	{
		$this->registry	= $registry;
	}
	
	public function getTables()
	{
		return array( 'feedback'	=> array( 'sender', 'ip', 'date' ));
	}
}