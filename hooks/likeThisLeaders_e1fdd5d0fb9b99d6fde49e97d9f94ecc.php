<?php   

/**
 * @author -RAW-
 * @copyright 2012
 * @link http://rawcodes.net
 * @filesource Likes Leaders
 * @version 1.2.0
 */
 
class likeThisLeaders
{
	public $registry;
	public $settings;		
	public $DB;
	public $memberData;	
			
			
	public function __construct()
	{
	    $this->registry     =  ipsRegistry::instance();
	    $this->settings     =& $this->registry->fetchSettings();		
	    $this->DB           =  $this->registry->DB();			
	    $this->memberData   =& $this->registry->member()->fetchMemberData();	
	    $this->lang			=  $this->registry->getClass('class_localization');
	}
	
	
	public function getOutput()
	{

	/* Not Enable? */	
	if(!$this->settings['ltL_enable'])
	{
	    return false;
	}
		

    /* No Groups Selected */
	if (!in_array( $this->memberData['member_group_id'], explode(',', $this->settings['ltL_g']) ) )
	{
        return false;
	}


    /* Get Them */
	$this->DB->build( array( 'select'   => 'p.*',
                             'from'     => array( 'profile_portal' => 'p' ),
                             'add_join' => array( array( 'select'  => 'm.member_id, m.members_display_name, m.members_seo_name, m.member_group_id',
                                                         'from'    => array( 'members' => 'm' ),
                                                         'where'   => 'm.member_id=p.pp_member_id',
                                                         'type'    => 'left')),                                                         
								                         'order'   => 'pp_reputation_points DESC',
														 'limit'		=> array( 0, $this->settings['ltL_total'] ),) );
	
    $this->DB->execute();
		
	$ltl = array();
			
	while ( $r = $this->DB->fetch() )
	{
	    if( $r['pp_reputation_points'] >= 1 )
	    {
	        $r = IPSMember::buildDisplayData( $r );
	        $ltl[] = $r;
		}
    }				
	return $this->registry->output->getTemplate('boards')->hookLikesThisLeaders($ltl);	
	}
}