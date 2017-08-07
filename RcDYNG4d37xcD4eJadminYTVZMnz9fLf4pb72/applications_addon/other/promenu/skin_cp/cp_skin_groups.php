<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_groups.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_groups extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	/* Main display for menu groups */
	public function groups()
	{
	$IPBHTML = "";
			//--starthtml--//
		
	$IPBHTML .= <<<HTML

	<div class='section_title'>
		<h2>{$this->lang->words['promenu_menus']}: {$this->lang->words['promenu_menu_groups']}</h2>
	</div> 

	<ul class='context_menu'>
		<li>
			<a href='{$this->settings['base_url']}{$this->form_code_groups}&amp;do=add'>
				<img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' />
				{$this->lang->words['promenu_new_group']}
			</a>
		</li>
	</ul>
HTML;
	$IPBHTML .= <<<HTML
	<div class="acp-box">
		<h3>{$this->lang->words['promenu_custom_menu_group']}</h3>
HTML;
	/* Lets grab our menu data */
	$groupdata = $this->registry->getClass('class_groups')->get_groups();

		if( is_array( $groupdata ) && count( $groupdata ) )
		{
	$IPBHTML .= <<<HTML
		<div id='group_container' class='ipsExpandable'>
HTML;
			foreach ( $groupdata as $group ) 
			{

					$IPBHTML .= <<<HTML
			<div class='isDraggable' id='group_{$group['promenu_group_id']}'>
				<div class='item category clearfix ipsControlRow'>
					<div class='col_buttons right' >
						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code_groups}&amp;do=edit&amp;group_id={$group['promenu_group_id']}&amp;group_key={$group['promenu_group_key']}">{$this->lang->words['promenu_modify']}</a></li>
						<li class='ipsControlStrip_more ipbmenu' id="{$group['promenu_group_id']}">
							<a href='#'>{$this->lang->words['promenu_options']}</a>
						</li>
					</ul>
					<ul class='acp-menu' id='{$group['promenu_group_id']}_menucontent' style='display: none'>
						<li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code_groups}&amp;do=edit&amp;group_id={$group['promenu_group_id']}&amp;group_key={$group['promenu_group_key']}'>Edit Group</a></li>
HTML;
					if ( $group['promenu_group_key'] == 'header_menus' || $group['promenu_group_key'] == 'primary_menus' || $group['promenu_group_key'] == 'ipsbar_menus' || $group['promenu_group_key'] == 'sidebar_menus' || $group['promenu_group_key'] == 'footer_menus' )
					{
					$IPBHTML .= <<<HTML
						<li class='icon delete'>{$this->lang->words['promenu_no_group_delete']}</li>
HTML;
					}
					else 
					{
					$alert = $this->lang->words['promenu_delete_group_alert'];
					$IPBHTML .= <<<HTML
						<li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code_groups}&amp;do=delete&amp;group_key={$group['promenu_group_key']}' onclick="return confirm('{$alert}');">{$this->lang->words['promenu_delete_group']}</a></li>
HTML;
					}
					$IPBHTML .= <<<HTML
					</ul>
					</div>
					<div class='draghandle'>&nbsp;</div>
					<div class='item_info' >
						<img src='{$this->settings['skin_acp_url']}/images/menu.png' />
				&nbsp;&nbsp;<strong class='larger_text'><a href='{$this->settings['base_url']}{$this->form_code_menu}&amp;group_id={$group['promenu_group_id']}&amp;group_key={$group['promenu_group_key']}'>{$group['promenu_group_title']}</a></strong><br />
HTML;
					$IPBHTML .= <<<HTML
					</div>
				</div>
			</div>
					<script type="text/javascript">
			dropItLikeItsHot{$group['promenu_group_id']} = function( draggableObject, mouseObject )
			{
				var options = {
								method : 'post',
								parameters : Sortable.serialize( 'group_container', { tag: 'div', name: 'groups' } )
							};
	 
				new Ajax.Request( "{$this->settings['base_url']}&module=menus&section=groups&amp;do=doreorder&md5check={$this->registry->adminFunctions->getSecurityKey()}".replace( /&amp;/g, '&' ), options );

				return false;
			};

			Sortable.create( 'group_container', { tag: 'div', only: 'isDraggable', revert: true, format: 'group_([0-9]+)', onUpdate: dropItLikeItsHot{$group['promenu_group_id']}, handle: 'draghandle' } );
		</script>
HTML;

			}
			$IPBHTML .= <<<HTML
		</div>

HTML;
		} 
		else 
		{
		/* So we have no menus yet, lets display a message */
		$IPBHTML .= <<<HTML
		<div class='item_info' >
			<br /><span class='no_messages'>No Groups To Display <a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=groups&amp;do=add' class='mini_button'>{$this->lang->words['promenu_new_group']}</a><br /><br /></span>
		</div>
HTML;
		}
	$IPBHTML .= <<<HTML
	</div>
HTML;
	//--endhtml--//
	return $IPBHTML;
	}
}
