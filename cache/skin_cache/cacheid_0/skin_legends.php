<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 0               */
/* CACHE FILE: Generated: Fri, 02 Oct 2015 10:56:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_legends_0 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['bbcodePopUpList'] = array('bbcode');
$this->_funcHooks['emoticonPopUpList'] = array('emoticons');


}

/* -- bbcodePopUpList --*/
function bbcodePopUpList($rows) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_legends', $this->_funcHooks['bbcodePopUpList'] ) )
{
$count_02a0d7de249b8f76cf5f21e5057426b6 = is_array($this->functionData['bbcodePopUpList']) ? count($this->functionData['bbcodePopUpList']) : 0;
$this->functionData['bbcodePopUpList'][$count_02a0d7de249b8f76cf5f21e5057426b6]['rows'] = $rows;
}
$IPBHTML .= "<h2>{$this->lang->words['bbc_title']}</h2>
<span class='desc'>{$this->lang->words['bbc_intro']}</span>
<br /><br />
<table class='ipb_table'>
	<tr class='header'>
		<th style='width: 50%'>{$this->lang->words['bbc_before']}</th>
		<th style='width: 50%'>{$this->lang->words['bbc_after']}</th>
	</tr>
	".$this->__f__0ac3bb3f4f35f21112bcc3bac97737d4($rows)."</table>
" . ( method_exists( $this->registry->getClass('output')->getTemplate('global'), 'include_highlighter' ) ? $this->registry->getClass('output')->getTemplate('global')->include_highlighter(1) : '' ) . "
<script type='text/javascript'>
	try {
		ipb.delegate.register('.bbc_spoiler_show', ipb.global.toggleSpoiler);
	} catch(err) { }
</script>";
return $IPBHTML;
}


function __f__0ac3bb3f4f35f21112bcc3bac97737d4($rows)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $rows as $row )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<tr class='subhead bar altbar'>
			<th colspan='2'>{$row['title']}</th>
		</tr>
		<tr class='row1'>
			<td class='altrow'>
				{$row['before']}
			</td>
			<td>
				{$row['after']}
			</td>
		</tr>
	
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- emoticonPopUpList --*/
function emoticonPopUpList($editor_id, $rows, $legacy_editor=false) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_legends', $this->_funcHooks['emoticonPopUpList'] ) )
{
$count_836f2e8755b224092bbd8df73d52cf1c = is_array($this->functionData['emoticonPopUpList']) ? count($this->functionData['emoticonPopUpList']) : 0;
$this->functionData['emoticonPopUpList'][$count_836f2e8755b224092bbd8df73d52cf1c]['editor_id'] = $editor_id;
$this->functionData['emoticonPopUpList'][$count_836f2e8755b224092bbd8df73d52cf1c]['rows'] = $rows;
$this->functionData['emoticonPopUpList'][$count_836f2e8755b224092bbd8df73d52cf1c]['legacy_editor'] = $legacy_editor;
}

if ( ! isset( $this->registry->templateStriping['emoticons'] ) ) {
$this->registry->templateStriping['emoticons'] = array( FALSE, "row1","row2");
}
$IPBHTML .= "" . ((!$legacy_editor) ? ("
	<script type=\"text/javascript\">
	addEmoImage = function(elem){
		var isRte = opener.ipb.textEditor.getEditor().isRte();
		var toAdd = '';
	
		if ( isRte ){
			toAdd = elem.up('tr').down('img').readAttribute('src');
			toAdd = '<img src=\"' + toAdd + '\" />&nbsp;';
		} else {
			toAdd = elem.up('tr').down('a').innerHTML + ' ';
		}
	
		opener.ipb.textEditor.getEditor().insert( toAdd );
	}
	</script>
") : ("
	<script type='text/javascript'>
		function addEmoImage(elem){
			var code = elem.up('tr').down('a').innerHTML;
			var title = elem.up('tr').down('img').readAttribute('title');
			ipb.editors[ '{$editor_id}' ].insert_emoticon('', title, code,'');
		}
	</script>
")) . "<div class='full_emoticon'>
	<table class='ipb_table'>
		".$this->__f__033479da6988eb0281284fd2ac10c830($editor_id,$rows,$legacy_editor)."	</table>
</div>";
return $IPBHTML;
}


function __f__033479da6988eb0281284fd2ac10c830($editor_id, $rows, $legacy_editor=false)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $rows as $row )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<tr class='" .  IPSLib::next( $this->registry->templateStriping["emoticons"] ) . "'>
			<td style='text-align: center; width: 40%;'>
				<a href=\"#\" onclick=\"addEmoImage(this); return false;\" title=\"{$row['image']}\">{$row['code']}</a>
			</td>
			<td style='text-align: center; width: 60%;'>
				<img class='clickable' src=\"{$this->settings['emoticons_url']}/{$row['image']}\" onclick=\"addEmoImage(this); return false;\" id='smid_{$row['smilie_id']}' alt=\"{$row['image']}\" />
			</td>
		</tr>
		
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- wrap_tag --*/
function wrap_tag($tag="") {
$IPBHTML = "";
$IPBHTML .= "<div><b>{$tag}</b></div>";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>