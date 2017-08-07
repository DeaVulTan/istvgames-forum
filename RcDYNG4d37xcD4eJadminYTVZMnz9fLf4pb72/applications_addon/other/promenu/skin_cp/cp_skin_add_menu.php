<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_add_menu.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_add_menu extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	public function add_menu()
	{
		/* Lets grab a menu count and our IP.Content check */
		$count = $this->registry->getClass('class_menus')->count_menus();
		$groupID = intval($this->request['group_id']);
		$groupKey = trim($this->request['group_key']);
		$isMega = $this->registry->getClass('class_groups')->get_group_mega($groupID);
		$IPBHTML = "";
		//--starthtml--//
		$IPBHTML .= <<<HTML
<form id='adminform' method='post' action='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;do=doadd'>
<input type='hidden' name='_admin_auth_key' value='{$this->registry->adminFunctions->getSecurityKey()}' />
<input type='hidden' name='menu_id' value='{$menu['promenu_id']}' />
<input type='hidden' name='group_mega' value='{$isMega}' />
<div class="acp-box">
	<h3>{$this->lang->words['promenu_add_menu']}</h3>
	<div class='ipsTabBar with_left with_right' id='tabstrip_ProMenu'>
		<span class='tab_left'>&laquo;</span>
		<span class='tab_right'>&raquo;</span>
		<ul>
			<li id='tab_1'>{$this->lang->words['promenu_menu_settings']}</li>
HTML;
		if ( $this->settings['promenu_group_perm_view'] == 1 )
		{
		$IPBHTML .= <<<HTML
			<li id='tab_2'>{$this->lang->words['promenu_menu_visible']}</li>
HTML;
		}
		else
		{
		$IPBHTML .= <<<HTML
			<li id='tab_2'>{$this->lang->words['promenu_menu_perms']}</li>
HTML;
		}
		$IPBHTML .= <<<HTML
			<li id='tab_3'>Advanced Settings</li>
HTML;
		if ( $isMega == 1 OR trim($this->request['group_key']) == "footer_menus" )
		{
		$IPBHTML .= <<<HTML
			<li id='tab_4'>Mega Settings</li>
HTML;
		}
		$IPBHTML .= <<<HTML
		</ul>
	</div>
	<div class='ipsTabBar_content' id='tabstrip_ProMenu_content'>
		<!-- Navigation Item Settings -->
		<div id='tab_1_content'>
			<table id='menuItem_table' class='ipsTable'>
				<tr id='menuTitle' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_title']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('title', $menu['promenu_title'], '', '', '', '', '', 75)}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_title_desc']}</span></td>
				</tr>
				<tr id='menuDescription' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_desc']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('description', $menu['promenu_description'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_desc_desc']}</span></td>
				</tr>

				<tr id='item-link' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_link']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('url', $menu['promenu_url'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_link_desc']}</span></td>
				</tr>
				<tr id='menuLinkToApp' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_link_app']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('link_to_app', $menu['link_to_app'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_link_app_desc']}</span></td>
				</tr>
				<tr id='app-link' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_app']}</strong></td>
					<td class='field_field'>{$this->registry->output->formDropdown('use_app', $this->registry->getClass('class_menus')->getAppList(), $menu['promenu_use_app'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_app_desc']}</span></td>
				</tr>
HTML;
		/* Again, we must check for an IP.Content installation so we know if we have pages to select from */

				if(IPSLib::appIsInstalled('ccs'))
				{
				$IPBHTML .= <<<HTML
				<tr id='page-link' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_page']}</strong></td>
					<td class='field_field'>{$this->registry->output->formDropdown('app_page', $this->registry->getClass('class_menus')->getPages(), $menu['promenu_app_page'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_page_desc']}</span></td>
				</tr>
HTML;
				}	
		/* If we have less than 2 menus, we dont offer a parent option */
		if( $count >= 1)
				{
				$IPBHTML .= <<<HTML
				<tr id='menuParentMenu' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_parent']}</strong></td>
					<td class='field_field'>
					{$this->registry->getClass('class_menus')->getParent( $groupKey, '0', intval($this->request['parent']) )}
					
					<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_parent_desc']}</span></td>
				</tr>
HTML;
				}
				$IPBHTML .= <<<HTML
<!--				<tr id='menuGroup' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_groups']}</strong></td>
					<td class='field_field'>{$this->registry->output->formDropdown('group_key', $this->registry->getClass('class_groups')->getGroupList(), $groupKey)}<br />
					<span class='desctext'>Menu Group Description</span></td>
				</tr> -->
			</table>
		</div>
		<!-- Navigation Item Permissions -->
		<div id='tab_2_content'>
HTML;

		if ( $this->settings['promenu_group_perm_view'] == 1 )
		{
		$IPBHTML .=<<<HTML
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
HTML;
		}
		else
		{	
		/* Grab the general permissions matrix */
		$IPBHTML .= $this->registry->getClass("class_perms")->getPermissionsMatrix($this->registry->getClass("class_perms")->getDefaultPermissions());
		}		
		$IPBHTML .= <<<HTML
		</div>
		<!-- Advanced Settings -->
		<div id='tab_3_content'>
			<table id='menuItem_table' class='ipsTable'>
				<tr id='menuDisableDesc' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_disable_desc_hover']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('disable_desc', $menu['promenu_disable_desc_hover'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_disable_desc_hover_desc']}</span></td>
				</tr>
				<tr id='menuUseDataToolTip' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_data_tooltip']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('use_data_tooltip', $menu['promenu_data_tooltip'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_data_tooltip_desc']}</span></td>
				</tr>
				<tr id='menuAsCat' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_view_as_cat']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('as_cat', $menu['promenu_as_cat'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_view_as_desc']}</span></td>
				</tr>
				<tr id='imageTitle' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_icon_as_title']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('title_image', $menu['promenu_title_image'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_icon_as_title_desc']}</span></td>
				</tr>
				<tr id='menuIconUrl' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_icon']}</strong></td>
					<td class='field_field'>{$this->registry->output->formInput('icon', $menu['promenu_icon'], '', '', '', '', '', 255)}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_icon_desc']}</span></td>
				</tr>
				<tr id='menuOpenWindow' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_open']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('opennew', $menu['promenu_open_new_window'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_open_desc']}</span></td>
				</tr>
				<tr id='menuActive' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_disable_active']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('is_active', $menu['promenu_disable_active'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_disable_active_desc']}</span></td>
				</tr>
				<tr id='menuLeftOpen' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_menu_left']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('left_open', $menu['promenu_left_open'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_menu_left_desc']}</span></td>
				</tr>
			</table>
		</div>	
		<!-- Mega Settings -->
		<div id='tab_4_content'>
			<table id='menuItem_table' class='ipsTable'>
HTML;
			$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
			$this->editor = new $classToLoad();
			$block = IPSText::getTextClass('bbcode')->preDisplayParse( $menu['promenu_block_content'] );
		$IPBHTML .=<<<HTML
				<tr id='menuIsCat' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_treat_cat']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('is_cat', $menu['promenu_is_cat'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_treat_desc']}</span></td>
				</tr>
				<tr id='imageTitle' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_start_new_row']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('new_row', $menu['promenu_new_row'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_start_new_row_desc']}</span></td>
				</tr>
				<tr id='menuIsBlock' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_use_block']}</strong></td>
					<td class='field_field'>{$this->registry->output->formYesNo('use_block', $menu['promenu_use_block'])}<br />
					<span class='desctext'>{$this->lang->words['promenu_use_block_desc']}</span></td>
				</tr>

				<tr id='menuBlock' class='ipsControlRow'>
					<td class='field_title'><strong class='title'>{$this->lang->words['promenu_block_content']}</strong></td>
					<td class='field_field'>{$this->editor->show('block_content',array('isHtml'=>TRUE), $block)}<br />
					<span class='desctext'>{$this->lang->words['promenu_block_content_desc']}</span></td>
				</tr>
HTML;
		$IPBHTML .=<<<HTML

			</table>
		</div>
	</div>
</div>
HTML;
$parent = intval($this->request['parent']);
	$IPBHTML .= <<<HTML
	<div class='acp-actionbar'>
	
		
			<input type='submit' class='button primary' value="{$this->lang->words['promenu_menu_save']}" />
			<input type='submit' class='button primary' value="{$this->lang->words['promenu_menu_save']} {$this->lang->words['promenu_and_reload']}" name='return' />
			<input type='button' class='button redbutton' onclick="history.go(-1);" value="{$this->lang->words['promenu_cancel']}" />
		
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
