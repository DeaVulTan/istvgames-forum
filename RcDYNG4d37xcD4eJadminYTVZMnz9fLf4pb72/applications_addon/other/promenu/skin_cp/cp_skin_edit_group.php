<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_edit_group.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_edit_group extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	public function edit_group($group_id, $group_key)
	{

		/* Lets grab a menu count, the current menu data, and our IP.Content check */
		$count = $this->registry->getClass('class_menus')->count_menus();
        $group_item = $this->registry->getClass('class_groups')->edit_group($group_key);
		
		$IPBHTML = "";
		//--starthtml--//
		if( is_array( $group_item ) && count( $group_item ) )
		{
			foreach( $group_item as $group )
			{
		$IPBHTML .= <<<HTML
<form id='adminform' method='post' action='{$this->settings['base_url']}module=menus&amp;section=groups&amp;do=doedit'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />
<input type='hidden' name='group_id' value='{$group['promenu_group_id']}' />
<input type='hidden' name='old_group_key' value='{$group['promenu_group_key']}' />
HTML;


		$IPBHTML .= <<<HTML
<div class="acp-box">
	<h3>{$this->lang->words['promenu_edit_group']}: {$this->registry->getClass('class_groups')->get_group_title($group_id)}</h3>
	<div class='ipsTabBar_content' id='tabstrip_ProMenu_content'>
		<!-- Navigation Item Settings -->
		<div id='tab_1_content'>
			<table id='menuItem_table' class='ipsTable'>
				<tr id='menuTitle' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_title']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('group_title', $group['promenu_group_title'], '', '', '', '', '', 25)}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_title_desc']}</span></td>
				</tr>
				<tr id='menuDescription' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_desc']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('group_description', $group['promenu_group_description'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_group_desc_desc']}</span></td>
				</tr>
				<tr id='menuKey' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_key']}</strong></td>
HTML;
					if ( trim($group['promenu_group_key']) == 'header_menus' || trim($group['promenu_group_key']) == 'primary_menus' || trim($group['promenu_group_key']) == 'sidebar_menus' || trim($group['promenu_group_key']) == 'footer_menus' )
					{
					$IPBHTML .= <<<HTML
					<td class='field_field'>{$this->lang->words['promenu_no_group_edit_key']}<input type='hidden' name='group_key' value='{$group['promenu_group_key']}' /><br />
HTML;
					}
					else 
					{
					$IPBHTML .= <<<HTML
					<td class='field_field'>{$this->registry->output->formInput('group_key', $group['promenu_group_key'], '', '', '', '', '', 50)}<br />
HTML;
					}
					$IPBHTML .= <<<HTML
					<span class='desctext'>{$this->lang->words['promenu_group_key_desc']}</span></td>
				</tr>
				<tr id='menuMega' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_group_mega']}</strong></td>
HTML;
					if ( trim($group['promenu_group_key']) == 'sidebar_menus' || trim($group['promenu_group_key']) == 'footer_menus' )
					{
					$IPBHTML .= <<<HTML
					<td class='field_field'>{$this->lang->words['promenu_not_group_available']}<input type='hidden' name='group_mega' value='{$group['promenu_group_mega']}' /><br />
HTML;
					}
					else 
					{
					$IPBHTML .= <<<HTML
					<td class='field_field'>{$this->registry->output->formYesNo('group_mega', $group['promenu_group_mega'])}<br />
HTML;
					}
					$IPBHTML .= <<<HTML
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
<br />
HTML;
			}
		}
		//--endhtml--//
		return $IPBHTML;
	}
}
