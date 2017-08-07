<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_edit_visibility.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_edit_visibility extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	public function edit_menu_visibility()
	{
		/* Lets grab a menu count and our menu data */
		$count = $this->registry->getClass('class_menus')->count_menus();
        $menu_item = $this->registry->getClass('class_menus')->edit_menu();
		$groupID = intval($this->request['group_id']);

		if ( !$groupID ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_selected']}", 'PG0008');
		}
		
		$IPBHTML = "";
		//--starthtml--//
		if( is_array( $menu_item ) && count( $menu_item ) )
		{
			foreach( $menu_item as $menu )
			{
		$IPBHTML .= <<<HTML
<form id='adminform' method='post' action='{$this->settings['base_url']}module=menus&amp;section=menus&amp;do=dovedit&amp;group_id={$groupID}'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />
<input type='hidden' name='menu_id' value='{$menu['promenu_id']}' />
<input type='hidden' name='group_key' value='{$menu['promenu_group_key']}' />
<input type='hidden' name='group_mega' value='{$menu['promenu_group_mega']}' />
	<div class="acp-box">
		<h3>{$this->lang->words['promenu_edit_visible']}: <b>{$menu['promenu_title']}</b></h3>
			<table id='menuItem_table' class='ipsTable'>
				<tr id='group-show-all' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_hide_all_groups']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('view_override', $menu['promenu_view_override'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_hide_all_groups_desc']}</span></td>
				</tr>
				<tr id='group-show' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_hide_group']}</strong></td>
					
					<td class='field_field'>{$this->registry->output->generateGroupDropdown('view_menu[]', isset($groups) ? $groups :explode (',',$menu['promenu_view_menu']), $multiselect=TRUE, $gid)}<br />
					<span class='desctext'>{$this->lang->words['promenu_hide_group_desc']}</span></td>
				</tr>
			</table>	
	</div>
	<div class='acp-actionbar'>
		<div class='center'>
			<input type='submit' class='button primary' value="{$this->lang->words['promenu_menu_save']}" />
			<input type='submit' class='button primary' value="{$this->lang->words['promenu_menu_save']} {$this->lang->words['promenu_and_reload']}" name='return' />
			<input type='button' class='button redbutton' onclick="history.go(-1);" value="{$this->lang->words['promenu_cancel']}" />
			</div>
	</div>
</form>
HTML;
			}
		}		
		//--endhtml--//
		return $IPBHTML;
	}
}
