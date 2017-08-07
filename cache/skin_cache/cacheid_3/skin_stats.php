<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_stats_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['group_strip'] = array('forums','forums','moreThanOne','noVisibleForums','specificForums','isonline','isFriend','isFriendable','canPm','members','hasPaginationTop','hasLeaders','hasPaginationBottom');
$this->_funcHooks['top_posters'] = array('tpIsFriend','tpIsFrindable','tpPm','tpBlog','tpGallery','topposters','hasTopPosters');
$this->_funcHooks['whoPosted'] = array('whoposted','hasPosters');


}

/* -- group_strip --*/
function group_strip($group="", $members=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_stats', $this->_funcHooks['group_strip'] ) )
{
$count_c4aae1eaa7cbae4fadd1eea82874ea43 = is_array($this->functionData['group_strip']) ? count($this->functionData['group_strip']) : 0;
$this->functionData['group_strip'][$count_c4aae1eaa7cbae4fadd1eea82874ea43]['group'] = $group;
$this->functionData['group_strip'][$count_c4aae1eaa7cbae4fadd1eea82874ea43]['members'] = $members;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- top_posters --*/
function top_posters($rows) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_stats', $this->_funcHooks['top_posters'] ) )
{
$count_03314c12a956e7ac0f643050f7ffbd39 = is_array($this->functionData['top_posters']) ? count($this->functionData['top_posters']) : 0;
$this->functionData['top_posters'][$count_03314c12a956e7ac0f643050f7ffbd39]['rows'] = $rows;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- whoPosted --*/
function whoPosted($tid=0, $title="", $rows=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_stats', $this->_funcHooks['whoPosted'] ) )
{
$count_928d965bf00639d1fa94b3da4227977d = is_array($this->functionData['whoPosted']) ? count($this->functionData['whoPosted']) : 0;
$this->functionData['whoPosted'][$count_928d965bf00639d1fa94b3da4227977d]['tid'] = $tid;
$this->functionData['whoPosted'][$count_928d965bf00639d1fa94b3da4227977d]['title'] = $title;
$this->functionData['whoPosted'][$count_928d965bf00639d1fa94b3da4227977d]['rows'] = $rows;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>