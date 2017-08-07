<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_mod_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['mergePostForm'] = array('selectedpids','selectedpidsjs','dates','authors','uploads','hasSelectedPidsJs','mergepostsdates','mergepostsauthors','mergepostsattachments');
$this->_funcHooks['movePostForm'] = array('isGuest','posts','movepostserror','movepostsloop');
$this->_funcHooks['moveTopicsForm'] = array('topics','movetopicsloop');
$this->_funcHooks['pruneSplash'] = array('defaultselectedoption','types','prunecompletehtml','confirmprune');
$this->_funcHooks['splitPostForm'] = array('split_posts','splitpostsloop');
$this->_funcHooks['topicHistory'] = array('mod_logs','topicmodlogs');


}

/* -- deleteTopicForm --*/
function deleteTopicForm($forum, $topic) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- editTopicTitle --*/
function editTopicTitle($forum, $topic) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- mergeMultiplePolls --*/
function mergeMultiplePolls($polls, $tids) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- mergePostForm --*/
function mergePostForm($editor, $dates, $authors, $uploads, $seoTitle) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['mergePostForm'] ) )
{
$count_d098a7a5edb9600625fce849c8470a5c = is_array($this->functionData['mergePostForm']) ? count($this->functionData['mergePostForm']) : 0;
$this->functionData['mergePostForm'][$count_d098a7a5edb9600625fce849c8470a5c]['editor'] = $editor;
$this->functionData['mergePostForm'][$count_d098a7a5edb9600625fce849c8470a5c]['dates'] = $dates;
$this->functionData['mergePostForm'][$count_d098a7a5edb9600625fce849c8470a5c]['authors'] = $authors;
$this->functionData['mergePostForm'][$count_d098a7a5edb9600625fce849c8470a5c]['uploads'] = $uploads;
$this->functionData['mergePostForm'][$count_d098a7a5edb9600625fce849c8470a5c]['seoTitle'] = $seoTitle;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- mergeTopicsForm --*/
function mergeTopicsForm($forum, $topic) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- movePostForm --*/
function movePostForm($forum, $topic, $posts, $error='') {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['movePostForm'] ) )
{
$count_44424ad5149c76409ef865e25ed646c1 = is_array($this->functionData['movePostForm']) ? count($this->functionData['movePostForm']) : 0;
$this->functionData['movePostForm'][$count_44424ad5149c76409ef865e25ed646c1]['forum'] = $forum;
$this->functionData['movePostForm'][$count_44424ad5149c76409ef865e25ed646c1]['topic'] = $topic;
$this->functionData['movePostForm'][$count_44424ad5149c76409ef865e25ed646c1]['posts'] = $posts;
$this->functionData['movePostForm'][$count_44424ad5149c76409ef865e25ed646c1]['error'] = $error;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- moveTopicForm --*/
function moveTopicForm($forum, $topic, $forum_jump) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- moveTopicsForm --*/
function moveTopicsForm($forum, $jump_html, $topics) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['moveTopicsForm'] ) )
{
$count_ddd3689ff53205093d688f4b221e3102 = is_array($this->functionData['moveTopicsForm']) ? count($this->functionData['moveTopicsForm']) : 0;
$this->functionData['moveTopicsForm'][$count_ddd3689ff53205093d688f4b221e3102]['forum'] = $forum;
$this->functionData['moveTopicsForm'][$count_ddd3689ff53205093d688f4b221e3102]['jump_html'] = $jump_html;
$this->functionData['moveTopicsForm'][$count_ddd3689ff53205093d688f4b221e3102]['topics'] = $topics;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- pruneSplash --*/
function pruneSplash($forum="", $forums_html="", $confirm_data="", $complete_html="") {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['pruneSplash'] ) )
{
$count_e1ddddc72786459fe812af70105ff8a6 = is_array($this->functionData['pruneSplash']) ? count($this->functionData['pruneSplash']) : 0;
$this->functionData['pruneSplash'][$count_e1ddddc72786459fe812af70105ff8a6]['forum'] = $forum;
$this->functionData['pruneSplash'][$count_e1ddddc72786459fe812af70105ff8a6]['forums_html'] = $forums_html;
$this->functionData['pruneSplash'][$count_e1ddddc72786459fe812af70105ff8a6]['confirm_data'] = $confirm_data;
$this->functionData['pruneSplash'][$count_e1ddddc72786459fe812af70105ff8a6]['complete_html'] = $complete_html;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- simplePage --*/
function simplePage($title="", $msg="") {
$IPBHTML = "";
$IPBHTML .= "<strong>{$title}</strong><br /> {$msg}";
return $IPBHTML;
}

/* -- softDeleteSplash --*/
function softDeleteSplash($forum, $tids=array(), $canHardDelete=false) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- softDeleteSplashPosts --*/
function softDeleteSplashPosts($forum, $topic, $pids=array(), $canHardDelete=false) {
$IPBHTML = "";
$IPBHTML .= "<!--no data in this master skin-->";
return $IPBHTML;
}

/* -- splitPostForm --*/
function splitPostForm($forum, $topic, $posts, $jump) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['splitPostForm'] ) )
{
$count_809a6c9a9e96d1e2b833f921800c5ae8 = is_array($this->functionData['splitPostForm']) ? count($this->functionData['splitPostForm']) : 0;
$this->functionData['splitPostForm'][$count_809a6c9a9e96d1e2b833f921800c5ae8]['forum'] = $forum;
$this->functionData['splitPostForm'][$count_809a6c9a9e96d1e2b833f921800c5ae8]['topic'] = $topic;
$this->functionData['splitPostForm'][$count_809a6c9a9e96d1e2b833f921800c5ae8]['posts'] = $posts;
$this->functionData['splitPostForm'][$count_809a6c9a9e96d1e2b833f921800c5ae8]['jump'] = $jump;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- topicHistory --*/
function topicHistory($topic, $avg_post, $mod_logs=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mod', $this->_funcHooks['topicHistory'] ) )
{
$count_bf976f22f46a361b9e93d0e652caae8b = is_array($this->functionData['topicHistory']) ? count($this->functionData['topicHistory']) : 0;
$this->functionData['topicHistory'][$count_bf976f22f46a361b9e93d0e652caae8b]['topic'] = $topic;
$this->functionData['topicHistory'][$count_bf976f22f46a361b9e93d0e652caae8b]['avg_post'] = $avg_post;
$this->functionData['topicHistory'][$count_bf976f22f46a361b9e93d0e652caae8b]['mod_logs'] = $mod_logs;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- unsubscribeForm --*/
function unsubscribeForm($forum, $topic, $text) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>