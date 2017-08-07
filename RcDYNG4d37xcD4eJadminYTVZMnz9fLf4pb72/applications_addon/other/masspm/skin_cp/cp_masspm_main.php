<?php
//-----------------------------------------------
// (DP34) Mass PM
//-----------------------------------------------
//-----------------------------------------------
// ACP Skin Content
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 23 / 07 / 2009
// Updated on: 09 / 01 / 2013
//-----------------------------------------------
// Copyright (C) 2009-2013 DawPi
// All Rights Reserved
//-----------------------------------------------  

class cp_masspm_main extends output
{

/**
 * Prevent our main destructor being called by this class
 *
 * @access	public
 * @return	void
 */
public function __destruct()
{
}


public function listView( $rows, $pagination ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['overview']}</h2>
	<ul class='context_menu'>
		<li class='ipsActionButton'><a href='{$this->settings['base_url']}{$this->form_code}&amp;do=addMassPm' title='{$this->lang->words['addNew']}'><img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' /> {$this->lang->words['addNew']}</a></li>
HTML;

    if( count( $rows ) AND is_array( $rows ) )
    {

$IPBHTML .= <<<HTML
		<li class='closed'><a href='{$this->settings['base_url']}{$this->form_code}&amp;do=removeAll' onclick='return confirm("{$this->lang->words['remove_all_sure']}");' title='{$this->lang->words['removeall']}'><img src='{$this->settings['skin_acp_url']}/images/icons/delete.png'alt='' /> {$this->lang->words['removeAll']}</a></li>
HTML;
    } 
       
$IPBHTML .= <<<HTML
	</ul>
</div>

<div class="acp-box">
	<h3>{$this->lang->words['overview']}</h3>
	<table class='ipsTable'>
HTML;

if( count( $rows ) AND is_array( $rows ) )
{

$IPBHTML .= <<<HTML
		<tr>
		    <th style='width: 5%; text-align:center;'>{$this->lang->words['id']}</th>		
            <th style='width: 40%; text-align:left;'>{$this->lang->words['pageName']}</th>			
			<th style='width: 20%; text-align:center;'>{$this->lang->words['dateAdded']}</th>
			<th style='width: 20%; text-align:center;'>{$this->lang->words['dateUpdated']}</th>			
			<th style='width: 5%; text-align:center;'>{$this->lang->words['isSent']}</th>
			<th style='width: 10%; text-align:center;'>{$this->lang->words['options']}</th>			
		</tr>
HTML;
		
	foreach( $rows as $row )
	{
       $img = ( $row['p_send'] ) ? "accept.png" : 'cross.png';
       
		$IPBHTML .= <<<HTML
		<tr class='ipsControlRow'>
		    <td style='width: 5%; text-align:center;'>{$row['p_id']}</td>
			<td style='width: 45%; text-align:left;'><strong><a href='{$this->settings['base_url']}{$this->form_code}&amp;do=editMassPm&amp;messageId={$row['p_id']}&amp;st={$this->request['st']}'>{$row['p_title']}</a></strong></td>
			<td style='width: 20%; text-align:center;'>{$this->registry->getClass( 'class_localization' )->getDate( $row['p_dateadded'], 'LONG', 1 )}</td>
			<td style='width: 20%; text-align:center;'>{$this->registry->getClass( 'class_localization' )->getDate( $row['p_dateupdated'], 'LONG', 1 )}</td>
			<td style='width: 5%; text-align:center;'><strong><img src='{$this->settings['skin_acp_url']}/images/icons/{$img}' border='0' class='ipbmenu' /></strong></td>
		  	<td class='col_buttons'>
				<ul class='ipsControlStrip'>
					<li class='i_refresh'>
						<a href='{$this->settings['base_url']}{$this->form_code}&amp;do=followMe&amp;msgId={$row['p_id']}&amp;resend=1' title='{$this->lang->words['sendAgain']}'>{$this->lang->words['sendAgain']}</a>
					</li>
					<li class='i_edit'>
						<a href='{$this->settings['base_url']}{$this->form_code}&amp;do=editMassPm&amp;messageId={$row['p_id']}&amp;st={$this->request['st']}' title='{$this->lang->words['edit']}'>{$this->lang->words['edit']}</a>
					</li>
					<li class='i_delete'>
						<a href='#' onclick='return acp.confirmDelete("{$this->settings['base_url']}&amp;{$this->form_code}&amp;do=removeMassPm&amp;messageId={$row['p_id']}&amp;st={$this->request['st']}");' title='{$this->lang->words['remove']}'>{$this->lang->words['remove']}</a>
					</li>
				</ul>
			</td>			
		</tr>
HTML;
	}
}
else
{
	$IPBHTML .= <<<HTML
		<tr>
			<td colspan='6' class='no_messages'>
				{$this->lang->words['noItems1']} 
            </td>			
		</tr>
HTML;
}

$IPBHTML .= <<<HTML
	</table>
</div>
HTML;

if( count( $rows ) AND is_array( $rows ) )
{
	$IPBHTML .= <<<HTML
{$pagination}
HTML;
}


//--endhtml--//
return $IPBHTML;
}

/**
 * View the form to add/edit a mass pm
 *
 *
**/
  
public function formView( $form ) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$form['formDo']}</h2>
</div>
HTML;


$IPBHTML .= <<<HTML
<form action='{$this->settings['base_url']}{$this->form_code}&amp;do=checkMsg&amp;type={$form['typeAfter']}&amp;messageId={$form['p_id']}' method='post' name='theAdminForm'  id='theAdminForm'>
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />
	
<div class='acp-box'>
		<h3>{$form['formDoDesc']}</h3>
		
		<table class='ipsTable double_pad'>
			<tr>
				<th colspan='2'>{$this->lang->words['settings']}</th>
			</tr>		
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['msgTitle']}</strong></td>
				<td class='field_field'>
					{$form['p_title']}<br />
					<span class='desctext'>{$this->lang->words['msgTitleDesc']}</span>
				</td>	
			</tr>
 			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['msgSender']}</strong></td>
				<td class='field_field'>
					{$form['p_sender']}<br />
					<span class='desctext'>{$this->lang->words['msgSenderDesc']}</span>
				</td>	
			</tr>
			<tr>
				<th colspan='2'>{$this->lang->words['moreSettings']}</th>
			</tr>			
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['groups']}</strong></td>
				<td class='field_field'>
					{$form['p_groups']}<br />
					<span class='desctext'>{$this->lang->words['groupsDesc']}</span>
				</td>	
			</tr>
			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['groupsSecondary']}</strong></td>
				<td class='field_field'>
					{$form['p_groups_secondary']}<br />
					<span class='desctext'>{$this->lang->words['groupsSecondaryDesc']}</span>
				</td>	
			</tr>
 			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['allowReply']}</strong></td>
				<td class='field_field'>
					{$form['p_force']}<br />
					<span class='desctext'>{$this->lang->words['allowReplyDesc']}</span>
				</td>	
			</tr>
			<tr>
				<th colspan='2'>{$this->lang->words['filters']}</th>
			</tr>			
 			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['posts']}</strong></td>
				<td class='field_field'>
					{$this->lang->words['wrote']} {$form['p_sort_type_posts']} {$form['p_sort_posts']} {$this->lang->words['wrotePosts']}<br />
					<span class='desctext'>{$this->lang->words['postsDesc']}}<br /><em>{$this->lang->words['leave']}</em></span>
				</td>	
			</tr>
 			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['rejestration']}</strong></td>
				<td class='field_field'>
					{$this->lang->words['joined']} {$form['p_sort_type_rejestrated']} {$form['p_sort_rejestrated']} {$form['p_sort_type_rejestrated_type']} {$this->lang->words['ago']}<br />
					<span class='desctext'>{$this->lang->words['rejestrationDesc']}<br /><em>{$this->lang->words['leave']}</em></span>
				</td>	
			</tr>
 			<tr>
				<td class='field_title'><strong class='title'>{$this->lang->words['lastVisit']}</strong></td>
				<td class='field_field'>
					{$this->lang->words['lastLogin1']} {$form['p_sort_type_visited']} {$form['p_sort_visited']} {$form['p_sort_type_visited_type']} {$this->lang->words['lastLogin2']}<br />
					<span class='desctext'>{$this->lang->words['lastVisitDesc']}<br /><em>{$this->lang->words['leave']}</em></span>
				</td>	
			</tr>
			<tr>
				<th colspan='2'>{$this->lang->words['bodySettings']}</th>
			</tr>				
 			<tr>
				<td class='field_field' colspan='2'>
					{$form['p_text']}
				</td>	
			</tr>						
		</table>
						
		<div class='acp-actionbar'>
			<input type='submit' value='{$form['button']}' class='button primary' accesskey='s'>
		</div>
</div>
</form>

<script type="text/javascript">
	document.observe("dom:loaded", function(){
		this.autoComplete = new ipb.Autocomplete( $('p_sender'), { multibox: false, url: acp.autocompleteUrl, templates: { wrap: acp.autocompleteWrap, item: acp.autocompleteItem } } );
	});
</script>

HTML;

//--endhtml--//
return $IPBHTML;
}

/**
 * Check message
 *
 *
**/
  
public function confirm( $howMany, $messageId, $reSend ) {

$IPBHTML = "";
//--starthtml--//

$this->lang->words['checkingDesc'] = str_replace('%s', $howMany, $this->lang->words['checkingDesc'] );

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['sendingConfirmation']}</h2>
</div>

<form action='{$this->settings['base_url']}{$this->form_code}&amp;do=send&amp;messageId={$messageId}&amp;resend={$reSend}' method='post' name='theAdminForm'  id='theAdminForm'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />

	<div class='acp-box'>
		<h3>{$this->lang->words['checkingMsg']}</h3>
		<table class='ipsTable double_pad'>
				<tr>
					<th>{$this->lang->words['info']}</th>
				</tr>
		</table>
				
		<div class='acp-actionbar' style='text-align:left;'>
			{$this->lang->words['checkingDesc']}
		</div>
			
		<div class='acp-actionbar'>
			{$this->lang->words['perSession']} <input id="perSession" class="input_text" type="text" value="" size="20" name="perSession" autocomplete="off"/>			
			<input type='submit' value='{$this->lang->words['startSending']}' class='button primary' accesskey='s'>
		</div>		
	</div>			
</form>		
HTML;

//--endhtml--//
return $IPBHTML;
}

}//End of class