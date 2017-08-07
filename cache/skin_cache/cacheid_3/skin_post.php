<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_post_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['pollBox'] = array('hasPollQuestions','hasPollChoices','hasPollVotes','hasPollMulti','viewPollVoters','allowPublicPoll','pollOnlyChecked','makePollOnly');
$this->_funcHooks['postFormTemplate'] = array('calendarlocale','open_close_perm','pollboxHtml','htmlstatus','tracking','enablesig','mod_options_check','open_time_check','close_time_check','showModOptions','checkShowEdit','showappendedit','showeditreason','edit_options_check','guestCaptcha','logged_in_check','edit_title_check','hazTag','edit_tags_check','statusMsgs','upload_form_check','shareEnabled','cancelposting','hazTag','edit_tags_check');
$this->_funcHooks['preview'] = array('disablelightbox','postpreview');
$this->_funcHooks['topicSummary'] = array('isGuest','ignoringpost','posts','topicsummaryposts');
$this->_funcHooks['uploadForm'] = array('unlimitedSpace','attachNotAllowed','canUseFlash','flashuploadhelp','helpMessage');


}

/* -- attachiFrame --*/
function attachiFrame($JSON, $id) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- errors --*/
function errors($data="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- pollBox --*/
function pollBox($data) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_post', $this->_funcHooks['pollBox'] ) )
{
$count_4e335cea09c754e791c4804511e402e3 = is_array($this->functionData['pollBox']) ? count($this->functionData['pollBox']) : 0;
$this->functionData['pollBox'][$count_4e335cea09c754e791c4804511e402e3]['data'] = $data;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- postFormTemplate --*/
function postFormTemplate($formData=array(), $form = array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_post', $this->_funcHooks['postFormTemplate'] ) )
{
$count_221223454abe7d78e832559a7f2ea98f = is_array($this->functionData['postFormTemplate']) ? count($this->functionData['postFormTemplate']) : 0;
$this->functionData['postFormTemplate'][$count_221223454abe7d78e832559a7f2ea98f]['formData'] = $formData;
$this->functionData['postFormTemplate'][$count_221223454abe7d78e832559a7f2ea98f]['form'] = $form;
}
$IPBHTML .= "<postingForm>
				" . (($formData['formType'] == 'new' OR ( $formData['formType'] == 'edit')) ? ("" . (($formData['tagBox']) ? ("
{$formData['tagBox']}
					") : ("")) . "") : ("")) . "
	<submitURL><![CDATA[{$this->settings['base_url']}]]></submitURL>
	<st>{$this->request['st']}</st>
	<app>forums</app>
	<module>post</module>
	<section>post</section>
	<do>{$form['doCode']}</do>
	<s>{$this->member->session_id}</s>
	<p>{$form['p']}</p>
	<t>{$form['t']}</t>
	<f>{$form['f']}</f>
	<parent_id>{$form['parent']}</parent_id>
	<attach_post_key>{$form['attach_post_key']}</attach_post_key>
	<auth_key>{$this->member->form_hash}</auth_key>
	<removeattachid>0</removeattachid>
	<return>{$this->request['return']}</return>
	<_from>{$this->request['_from']}</_from>
	{$formData['editor']}
</postingForm>";
return $IPBHTML;
}

/* -- preview --*/
function preview($data="") {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_post', $this->_funcHooks['preview'] ) )
{
$count_b0194ec0936b2934fc89a19c729a9c1d = is_array($this->functionData['preview']) ? count($this->functionData['preview']) : 0;
$this->functionData['preview'][$count_b0194ec0936b2934fc89a19c729a9c1d]['data'] = $data;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- topicSummary --*/
function topicSummary($posts=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_post', $this->_funcHooks['topicSummary'] ) )
{
$count_0a8737b1345387939d397e493401df7a = is_array($this->functionData['topicSummary']) ? count($this->functionData['topicSummary']) : 0;
$this->functionData['topicSummary'][$count_0a8737b1345387939d397e493401df7a]['posts'] = $posts;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- uploadForm --*/
function uploadForm($post_key="",$type="",$stats=array(),$id="",$forum_id=0) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_post', $this->_funcHooks['uploadForm'] ) )
{
$count_7329eb35204bd0ca95d72406eae96066 = is_array($this->functionData['uploadForm']) ? count($this->functionData['uploadForm']) : 0;
$this->functionData['uploadForm'][$count_7329eb35204bd0ca95d72406eae96066]['post_key'] = $post_key;
$this->functionData['uploadForm'][$count_7329eb35204bd0ca95d72406eae96066]['type'] = $type;
$this->functionData['uploadForm'][$count_7329eb35204bd0ca95d72406eae96066]['stats'] = $stats;
$this->functionData['uploadForm'][$count_7329eb35204bd0ca95d72406eae96066]['id'] = $id;
$this->functionData['uploadForm'][$count_7329eb35204bd0ca95d72406eae96066]['forum_id'] = $forum_id;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>