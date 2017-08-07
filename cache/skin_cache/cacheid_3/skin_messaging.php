<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_messaging_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['messengerDisabled'] = array('notByAdmin');
$this->_funcHooks['messengerTemplate'] = array('isMemberPartOpen','isMemberPartFloat','isMemberPartClose','userIsStarter','lastReadTime','messageIsDeleted','notification','blockUserLink','unbanUserLink','systemMessage','topicUnavailable','userIsBanned','userIsActive','participants','protectedFolder','allFolder','unprotectedFolder','dirs','PMDisabled','changeNotifications','unlimitedInvites','inviteMoreParticipants','hasParticipants','myDirectories','almostFull','storageBar','inlineError');
$this->_funcHooks['sendNewPersonalTopicForm'] = array('newtopicerrors','newTopicPreview','newTopicError','formReloadInvite','formReloadCopy','newTopicInvite','newTopicUploads');
$this->_funcHooks['sendReplyForm'] = array('replyerrors','replyForm','previewPm','formHeaderText','formErrors','attachmentForm','replyOptions','replyForm');
$this->_funcHooks['showConversation'] = array('hasAuthorId','authorOnline','accessModCP','authorPrivateIp','authorIpAddress','viewSigs','quickReply','reportPm','canEdit','canDelete','replies','disablelightbox','canReplyEditor','allAlone','reportPm','canEdit','canDelete','quickReply','replies','canReplyEditor');
$this->_funcHooks['showConversationForArchive'] = array('replies');
$this->_funcHooks['showFolder'] = array('folderLastPage','messagePages','hasStarterPhoto','folderNotifications','folderDrafts','folderNotificationsIgnore','folderStarter','folderToMember','folderFixPlural','folderMultipleUsers','folderNew','folderPages','folderBannedIndicator','hasPosterPhoto','folderToMember','folderBannedUser','folderMessages','folderNotDrafts','folderMessages','folderMultiOptions','folderJumpHtml','messages');
$this->_funcHooks['showSearchResults'] = array('folderNotifications','folderStarter','folderToMember','folderFixPlural','folderMultipleUsers','folderNew','folderBannedIndicator','folderBannedUser','messages','searchError','hasPagination','searchMessages');


}

/* -- messengerDisabled --*/
function messengerDisabled() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['messengerDisabled'] ) )
{
$count_8d386deb9bc065e36773a3596f277015 = is_array($this->functionData['messengerDisabled']) ? count($this->functionData['messengerDisabled']) : 0;
}
$IPBHTML .= "<error>Messanger Disabled</error>";
return $IPBHTML;
}

/* -- messengerTemplate --*/
function messengerTemplate($html, $jumpmenu, $dirData, $totalData=array(), $topicParticipants=array(), $inlineError='', $deletedTopic=0) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['messengerTemplate'] ) )
{
$count_21a3754b3b283f92907811d7b37aea6a = is_array($this->functionData['messengerTemplate']) ? count($this->functionData['messengerTemplate']) : 0;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['html'] = $html;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['jumpmenu'] = $jumpmenu;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['dirData'] = $dirData;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['totalData'] = $totalData;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['topicParticipants'] = $topicParticipants;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['inlineError'] = $inlineError;
$this->functionData['messengerTemplate'][$count_21a3754b3b283f92907811d7b37aea6a]['deletedTopic'] = $deletedTopic;
}
$IPBHTML .= "{$html}";
return $IPBHTML;
}

/* -- PMQuickForm --*/
function PMQuickForm($toMemberData) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- sendNewPersonalTopicForm --*/
function sendNewPersonalTopicForm($displayData) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['sendNewPersonalTopicForm'] ) )
{
$count_295e5db52e626ae9f88e86854568ca13 = is_array($this->functionData['sendNewPersonalTopicForm']) ? count($this->functionData['sendNewPersonalTopicForm']) : 0;
$this->functionData['sendNewPersonalTopicForm'][$count_295e5db52e626ae9f88e86854568ca13]['displayData'] = $displayData;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- sendReplyForm --*/
function sendReplyForm($displayData) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['sendReplyForm'] ) )
{
$count_1e5785abc41d891f40f2c8f5598acd16 = is_array($this->functionData['sendReplyForm']) ? count($this->functionData['sendReplyForm']) : 0;
$this->functionData['sendReplyForm'][$count_1e5785abc41d891f40f2c8f5598acd16]['displayData'] = $displayData;
}
$IPBHTML .= "<postingForm>
	<msgID>{$displayData['msgID']}</msgID>
	<topicID>{$displayData['topicID']}</topicID>
	<postKey>{$displayData['postKey']}</postKey>
	{$displayData['editor']}
	<authKey>{$this->member->form_hash}</authKey>
	
	" . (($displayData['type'] == 'reply') ? ("
			<submitURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=messaging&amp;section=send&amp;do=sendReply", "publicWithApp",'' ), "", "" ) . "]]></submitURL>
	") : ("
			<submitURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=messaging&amp;section=send&amp;do=sendEdit", "publicWithApp",'' ), "", "" ) . "]]></submitURL>
	")) . "
	
</postingForm>";
return $IPBHTML;
}

/* -- showConversation --*/
function showConversation($topic, $replies, $members, $jump="") {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['showConversation'] ) )
{
$count_7adb7d5355674e2c3b7a1ddaf9ed6a82 = is_array($this->functionData['showConversation']) ? count($this->functionData['showConversation']) : 0;
$this->functionData['showConversation'][$count_7adb7d5355674e2c3b7a1ddaf9ed6a82]['topic'] = $topic;
$this->functionData['showConversation'][$count_7adb7d5355674e2c3b7a1ddaf9ed6a82]['replies'] = $replies;
$this->functionData['showConversation'][$count_7adb7d5355674e2c3b7a1ddaf9ed6a82]['members'] = $members;
$this->functionData['showConversation'][$count_7adb7d5355674e2c3b7a1ddaf9ed6a82]['jump'] = $jump;
}
$IPBHTML .= "<template>messageView</template>
<pagination>{$topic['_pages']}</pagination>
" . (($topic['_canReply']) ? ("
<AssessoryButtonURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=members&amp;module=messaging&amp;section=send&amp;do=sendReply&amp;topicID={$topic['mt_id']}", "public",'' ), "", "" ) . "]]></AssessoryButtonURL>
") : ("")) . "
<message>
	<title><![CDATA[{$topic['mt_title']}]]></title>
	".$this->__f__ab64ce09a837ef3d5c9f98bea856b11c($topic,$replies,$members,$jump)."</message>";
return $IPBHTML;
}


function __f__ab64ce09a837ef3d5c9f98bea856b11c($topic, $replies, $members, $jump="")
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $replies as $msg_id => $msg )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<messageReply>
			<user>
				<id>{$msg['msg_author_id']}</id>
				<name><![CDATA[{$members[ $msg['msg_author_id'] ]['members_display_name']}]]></name>
				<date>" . IPSText::htmlspecialchars($this->registry->getClass('class_localization')->getDate($msg['msg_date'],"DATE", 0)) . "</date>
				<avatar><![CDATA[{$members[ $msg['msg_author_id'] ]['pp_thumb_photo']}]]></avatar>
				<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$msg['msg_author_id']}", "public",'' ), "{$members[ $msg['msg_author_id'] ]['members_seo_name']}", "showuser" ) . "]]></url>
			</user>	
			<date>" . IPSText::htmlspecialchars($this->registry->getClass('class_localization')->getDate($msg['post']['post_date'],"DATE", 0)) . "</date>
			<text><![CDATA[{$msg['msg_post']}
			{$msg['attachmentHtml']}]]></text>
			<options>
			" . (($topic['_canReport'] and $this->memberData['member_id']) ? ("
				<reportURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=reports&amp;rcom=messages&amp;topicID={$this->request['topicID']}&amp;st={$this->request['st']}&amp;msg={$msg['msg_id']}", "public",'' ), "", "" ) . "]]></reportURL>
			") : ("")) . "
			
			" . (($msg['_canEdit'] === TRUE) ? ("
				<editURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=messaging&amp;section=send&amp;do=editMessage&amp;topicID={$topic['mt_id']}&amp;msgID={$msg['msg_id']}", "publicWithApp",'' ), "", "" ) . "]]></editURL>
			") : ("")) . "
			
			" . (($msg['_canDelete'] === TRUE && $msg['msg_is_first_post'] != 1) ? ("
				<deleteURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=messaging&amp;section=send&amp;do=deleteReply&amp;topicID={$topic['mt_id']}&amp;msgID={$msg['msg_id']}&amp;authKey={$this->member->form_hash}", "publicWithApp",'' ), "", "" ) . "]]></deleteURL>
			") : ("")) . "
			
			" . (($topic['_canReply'] AND empty( $topic['_everyoneElseHasLeft'] )) ? ("
				<replyURL><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "module=messaging&amp;section=send&amp;do=replyForm&amp;topicID={$topic['mt_id']}&amp;msgID={$msg['msg_id']}", "publicWithApp",'' ), "", "" ) . "]]></replyURL>
			") : ("")) . "
				</options>							
		</messageReply>
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- showConversationForArchive --*/
function showConversationForArchive($topic, $replies, $members) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['showConversationForArchive'] ) )
{
$count_5996ffd9a8bf90837b703f486bd8362e = is_array($this->functionData['showConversationForArchive']) ? count($this->functionData['showConversationForArchive']) : 0;
$this->functionData['showConversationForArchive'][$count_5996ffd9a8bf90837b703f486bd8362e]['topic'] = $topic;
$this->functionData['showConversationForArchive'][$count_5996ffd9a8bf90837b703f486bd8362e]['replies'] = $replies;
$this->functionData['showConversationForArchive'][$count_5996ffd9a8bf90837b703f486bd8362e]['members'] = $members;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showFolder --*/
function showFolder($messages, $dirname, $pages, $currentFolderID, $jumpFolderHTML) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['showFolder'] ) )
{
$count_ce327c041ef2e93a2baa263e3258a586 = is_array($this->functionData['showFolder']) ? count($this->functionData['showFolder']) : 0;
$this->functionData['showFolder'][$count_ce327c041ef2e93a2baa263e3258a586]['messages'] = $messages;
$this->functionData['showFolder'][$count_ce327c041ef2e93a2baa263e3258a586]['dirname'] = $dirname;
$this->functionData['showFolder'][$count_ce327c041ef2e93a2baa263e3258a586]['pages'] = $pages;
$this->functionData['showFolder'][$count_ce327c041ef2e93a2baa263e3258a586]['currentFolderID'] = $currentFolderID;
$this->functionData['showFolder'][$count_ce327c041ef2e93a2baa263e3258a586]['jumpFolderHTML'] = $jumpFolderHTML;
}
$IPBHTML .= "<template>popoverMessages</template>
<messages>
	".$this->__f__d98e40ece7856aea874ac9cbcb8711a7($messages,$dirname,$pages,$currentFolderID,$jumpFolderHTML)."</messages>";
return $IPBHTML;
}


function __f__d98e40ece7856aea874ac9cbcb8711a7($messages, $dirname, $pages, $currentFolderID, $jumpFolderHTML)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $messages as $message )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<message>
			<id>{$message['msg_topic_id']}</id>
			<title>{$message['mt_title']}</title>
			<url><![CDATA[" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=members&amp;module=messaging&amp;section=view&amp;do=showConversation&amp;topicID={$message['msg_topic_id']}", "public",'' ), "", "" ) . "]]></url>
			<SenderName><![CDATA[{$message['_starterMemberData']['members_display_name']}]]></SenderName>
			<icon><![CDATA[{$message['_starterMemberData']['pp_mini_photo']}]]></icon>
		</message>
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- showSearchResults --*/
function showSearchResults($messages, $pages, $error) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_messaging', $this->_funcHooks['showSearchResults'] ) )
{
$count_148f155a87c9a266129e11aa0748ca43 = is_array($this->functionData['showSearchResults']) ? count($this->functionData['showSearchResults']) : 0;
$this->functionData['showSearchResults'][$count_148f155a87c9a266129e11aa0748ca43]['messages'] = $messages;
$this->functionData['showSearchResults'][$count_148f155a87c9a266129e11aa0748ca43]['pages'] = $pages;
$this->functionData['showSearchResults'][$count_148f155a87c9a266129e11aa0748ca43]['error'] = $error;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>