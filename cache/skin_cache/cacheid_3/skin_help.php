<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_help_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['helpShowSection'] = array('notajax','isajax','notajax');
$this->_funcHooks['helpShowTopics'] = array('helpfiles');


}

/* -- helpShowSection --*/
function helpShowSection($one_text="",$two_text="",$three_text="", $text) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_help', $this->_funcHooks['helpShowSection'] ) )
{
$count_0825829b25dde1f5a3bc4c58cf8e2d17 = is_array($this->functionData['helpShowSection']) ? count($this->functionData['helpShowSection']) : 0;
$this->functionData['helpShowSection'][$count_0825829b25dde1f5a3bc4c58cf8e2d17]['one_text'] = $one_text;
$this->functionData['helpShowSection'][$count_0825829b25dde1f5a3bc4c58cf8e2d17]['two_text'] = $two_text;
$this->functionData['helpShowSection'][$count_0825829b25dde1f5a3bc4c58cf8e2d17]['three_text'] = $three_text;
$this->functionData['helpShowSection'][$count_0825829b25dde1f5a3bc4c58cf8e2d17]['text'] = $text;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- helpShowTopics --*/
function helpShowTopics($one_text="",$two_text="",$three_text="",$rows) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_help', $this->_funcHooks['helpShowTopics'] ) )
{
$count_2767879e210a3109345a261feb923bc6 = is_array($this->functionData['helpShowTopics']) ? count($this->functionData['helpShowTopics']) : 0;
$this->functionData['helpShowTopics'][$count_2767879e210a3109345a261feb923bc6]['one_text'] = $one_text;
$this->functionData['helpShowTopics'][$count_2767879e210a3109345a261feb923bc6]['two_text'] = $two_text;
$this->functionData['helpShowTopics'][$count_2767879e210a3109345a261feb923bc6]['three_text'] = $three_text;
$this->functionData['helpShowTopics'][$count_2767879e210a3109345a261feb923bc6]['rows'] = $rows;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>