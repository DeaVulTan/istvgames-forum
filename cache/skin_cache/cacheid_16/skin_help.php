<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 16               */
/* CACHE FILE: Generated: Tue, 29 Dec 2015 18:49:00 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_help_16 extends skinMaster{

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
$count_11fc764ce7ec0851693bacbb21457f95 = is_array($this->functionData['helpShowSection']) ? count($this->functionData['helpShowSection']) : 0;
$this->functionData['helpShowSection'][$count_11fc764ce7ec0851693bacbb21457f95]['one_text'] = $one_text;
$this->functionData['helpShowSection'][$count_11fc764ce7ec0851693bacbb21457f95]['two_text'] = $two_text;
$this->functionData['helpShowSection'][$count_11fc764ce7ec0851693bacbb21457f95]['three_text'] = $three_text;
$this->functionData['helpShowSection'][$count_11fc764ce7ec0851693bacbb21457f95]['text'] = $text;
}
$IPBHTML .= "" . ((!$this->request['xml']) ? ("
<div class='topic_controls'>
	<ul class='topic_buttons'>
		<li><a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=help", "public",'' ), "", "" ) . "\" title=\"{$this->lang->words['help_back_list_title']}\">{$this->lang->words['help_return_list']}</a></li>
	</ul>
</div>
") : ("")) . "
" . (($this->request['xml']) ? ("
<br />
") : ("")) . "
" . ((!$this->request['xml']) ? ("
	<h1 class='ipsType_pagetitle'>{$one_text}: {$three_text}</h1>
") : ("
	<h1 class='ipsType_subtitle'>{$one_text}: {$three_text}</h1>
")) . "
<br />
<div class='row2 help_doc ipsPad bullets'>
	{$text}
</div>
<br />";
return $IPBHTML;
}

/* -- helpShowTopics --*/
function helpShowTopics($one_text="",$two_text="",$three_text="",$rows) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_help', $this->_funcHooks['helpShowTopics'] ) )
{
$count_d5fe4d18dc2a22d6784104bd713c42fb = is_array($this->functionData['helpShowTopics']) ? count($this->functionData['helpShowTopics']) : 0;
$this->functionData['helpShowTopics'][$count_d5fe4d18dc2a22d6784104bd713c42fb]['one_text'] = $one_text;
$this->functionData['helpShowTopics'][$count_d5fe4d18dc2a22d6784104bd713c42fb]['two_text'] = $two_text;
$this->functionData['helpShowTopics'][$count_d5fe4d18dc2a22d6784104bd713c42fb]['three_text'] = $three_text;
$this->functionData['helpShowTopics'][$count_d5fe4d18dc2a22d6784104bd713c42fb]['rows'] = $rows;
}

if ( ! isset( $this->registry->templateStriping['help'] ) ) {
$this->registry->templateStriping['help'] = array( FALSE, "row1","row2");
}
$IPBHTML .= "" . $this->registry->getClass('output')->addJSModule("help", "0" ) . "
<p class='message unspecific'>{$two_text}</p>
" . $this->registry->getClass('output')->getReplacement("header_start") . "<h3 class='maintitle'>{$this->lang->words['help_topics']}</h3>" . $this->registry->getClass('output')->getReplacement("header_end") . "
<div class='generic_bar'></div>
<ol id='help_topics'>
		" . ((count($rows)) ? ("".$this->__f__db70bcfc92627df57ee87dec25027401($one_text,$two_text,$three_text,$rows)."	") : ("
		<li class='no_messages'>{$this->lang->words['no_help_topics']}</li>
	")) . "
</ol>" . $this->registry->getClass('output')->getReplacement("box_end") . "";
return $IPBHTML;
}


function __f__db70bcfc92627df57ee87dec25027401($one_text="",$two_text="",$three_text="",$rows)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $rows as $entry )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<li class='" .  IPSLib::next( $this->registry->templateStriping["help"] ) . " helpRow'>
			<h3><a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=help&amp;do=01&amp;HID={$entry['id']}", "public",'' ), "", "" ) . "\" title=\"{$this->lang->words['help_read_document']}\">{$entry['title']}</a></h3>
			<p>
				{$entry['description']}
			</p>
		</li>
		
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>