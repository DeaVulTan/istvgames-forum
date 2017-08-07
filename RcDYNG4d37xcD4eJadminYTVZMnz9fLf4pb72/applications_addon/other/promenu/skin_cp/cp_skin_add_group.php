<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_add_group.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_add_group extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	public function add_group()
	{
		/* Lets grab a menu count */
		$count = $this->registry->getClass('class_menus')->count_menus();
		
		$IPBHTML = "";
		//--starthtml--//
		$IPBHTML .= <<<HTML
<form id='adminform' method='post' action='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=groups&amp;do=doadd'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />
HTML;



		$IPBHTML .= <<<HTML
<div class="acp-box">
	<h3>{$this->lang->words['promenu_new_group']}</h3>
	<div class='ipsTabBar_content' id='tabstrip_ProMenu_content'>
		<!-- Navigation Item Settings -->
		<div id='tab_1_content'>
			<table id='menuItem_table' class='ipsTable'>
				<tr id='menuTitle' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_title']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('group_title', $group['promenu_group_title'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_title_desc']}</span></td>
				</tr>
				<tr id='menuDescription' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_desc']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('group_description', $group['promenu_group_description'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_desc_desc']}</span></td>
				</tr>
				<tr id='menuKey' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_key']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('group_key', $group['promenu_group_key'], '', '', '', '', '', 50)}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_key_desc']}</span></td>
				</tr>
				<tr id='menuMega' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_mega']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('group_mega', $group['promenu_group_mega'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_mega_desc']}</span></td>
				</tr> 
			</table>
		</div>
	</div>
</div>
HTML;

	$IPBHTML .= <<<HTML
	<div class='acp-actionbar'>
		<div class='center'>
			<input type='submit' class='button primary' value='{$this->lang->words['promenu_menu_save']}' />
		</div>
	</div>
</form>
<script type='text/javascript'>
	jQ("#tabstrip_ProMenu").ipsTabBar({ tabWrap: "#tabstrip_ProMenu_content" });
</script>
<br />
HTML;
		//--endhtml--//
		return $IPBHTML;
	}
}
