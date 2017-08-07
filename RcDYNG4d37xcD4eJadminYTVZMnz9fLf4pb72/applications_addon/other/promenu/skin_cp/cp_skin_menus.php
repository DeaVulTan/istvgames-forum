<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_menus.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_menus extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	/* Main display for menus */
	public function menus()
	{
	$IPBHTML = "";
			//--starthtml--//
	$id = intval($this->request['menu_id']);
	$parent = intval($this->request['parent']);
	$groupID = intval($this->request['group_id']);	
	$groupKey = trim($this->request['group_key']);

	$menudata = $this->registry->getClass('class_menus')->get_menu_query($groupKey);
	
		if ( !$groupID ) 
		{
			$this->registry->output->showError( "{$this->lang->words['promenu_no_group_selected']}", 'PG0008');
		}	
	$IPBHTML .= <<<HTML
<style type='text/css'>
li.openit{
width: 28px;
height: 20px;
display: inline-block;
background: url({$this->settings['skin_acp_url']}/images/icon_expand_close.png)no-repeat;
background-position:center  3px; 
}
li.closeit{
width: 28px;
height: 20px;
display: inline-block;
background: url({$this->settings['skin_acp_url']}/images/icon_expand_close.png)no-repeat;
background-position:center -16px; }
</style>
	<div class='section_title'>
		<h2>{$this->lang->words['promenu_menus']}: {$this->registry->getClass('class_groups')->get_group_title($groupID)}</h2>
	</div> 
HTML;
		if( is_array( $menudata ) && count( $menudata ) )
		{	
    	$IPBHTML .=<<<HTML
<script type="text/javascript">
<!--//
function sizeFrame(frameId){
	var F = document.getElementById(frameId); 
	var inner = (F.contentDocument) ? F.contentDocument : F.contentWindow.document;
	F.style.height = inner.body.offsetHeight +'px';
}

function addListener(elem)
{
	var sibs = $(elem).siblings();
	var F = $(elem); 
	var inner = (F.contentDocument) ? F.contentDocument : F.contentWindow.document;
	jQuery.extend({}, inner);	
	
	var s = $(inner);
	
	
	/*
	.addEventListener("click",function(e) { 
	  alert('fuck!');
	});
	*/

}
//-->
</script>
		<iframe id='menu_preview' src='{$this->settings['board_url']}/index.php?app=promenu&amp;module=preview&amp;section=preview&amp;group_id=$groupID&amp;group_key=$groupKey' scrolling='no' style='border:1px solid #000;height: 289px;' border='0' frameborder='0' width='100%'onload="sizeFrame('menu_preview');addListener(this);"></iframe><br /><br /><br />	
HTML;
		}
    	$IPBHTML .=<<<HTML
	<ul class='context_menu'>
		<li>
			<a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;parent=0'>
				<img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' />
				{$this->lang->words['promenu_add_menu']}
			</a>
		</li>
	</ul>
HTML;
	$IPBHTML .= <<<HTML
	<div class="acp-box">
		<h3>{$this->lang->words['custom_menus']}</h3>
HTML;

		if( is_array( $menudata ) && count( $menudata ) )
		{
		$IPBHTML .= <<<HTML

		<div id='menu_container' class='ipsExpandable'>
HTML;
			foreach ( $menudata as $menus => $menu ) 
			{
					/* Determine if we re a root menu and if we are lets display */
					if( $menu['promenu_parent_id'] == 0 && $menu['promenu_group_id'] == $groupID )
					{
					$check_child = $this->registry->getClass('class_functions')->CheckChildrenTree($menudata,$menu['promenu_id']);
					$IPBHTML .= <<<HTML
			<div class='isDraggable' id='menu_{$menu['promenu_id']}'>
				
				<div class='root_item item category clearfix ipsControlRow'>
					<div class='col_buttons right' >
						
						<ul class='ipsControlStrip' sytle='display:inline-block'>
HTML;
					if($check_child == "1"){
						$IPBHTML .=<<<HTML
					<li class="openit" id="closeDiv" >
						<span></span>
					</li>
HTML;
					}
					$IPBHTML .=<<<HTML
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}">{$this->lang->words['promenu_modify']}</a></li>
							<li class='i_add'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;do=add&amp;parent={$menu['promenu_id']}">{$this->lang->words['promenu_modify']}</a></li>
						<li class='ipsControlStrip_more ipbmenu' id="{$menu['promenu_id']}">
							<a href='#'>{$this->lang->words['promenu_options']}</a>
						</li>
					</ul>
					<ul class='acp-menu' id='{$menu['promenu_id']}_menucontent' style='display: none'>
HTML;
					if( $this->settings['promenu_group_perm_view'] == 1 )
					{
					$IPBHTML .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=vedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_menu_visible']}</a></li>						
HTML;
					}
					else 
					{
					$IPBHTML .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=permedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_permissions']}</a></li>						
HTML;
					}
					$IPBHTML .= <<<HTML
						<li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>{$this->lang->words['promenu_edit_menu']}</a></li>
						<li class='icon add'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;do=add&amp;parent={$menu['promenu_id']}'>{$this->lang->words['promenu_add_menu']}</a></li>
						<li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=dodelete&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_delete_menu']}</a></li>
HTML;
						if($check_child == "1")
						{
						$IPBHTML .= <<<HTML
						<li class='icon view'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=viewsub&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>View With Subs</a></li>
HTML;
						}
					$IPBHTML .= <<<HTML
				</ul>
					</div>
					<div class='draghandle'>&nbsp;</div>
					<div class='item_info' style='width:70%;'>
						<img src='{$this->settings['skin_acp_url']}/images/menu.png' />
				&nbsp;&nbsp;<strong class='larger_text'>{$menu['promenu_title']}</strong><br />
HTML;
			
			/* If we are using an application for a link lets show it! */
			if( $menu['promenu_use_app'] != null && !$menu['promenu_is_cat'] )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_application']}</strong>{$menu['promenu_use_app']}&nbsp;&nbsp;</span>
HTML;
			/* If we are using an application, are we using a IP.Content page as well and if we are lets show it! */
			}
			if ( $menu['promenu_use_app'] == 'ccs' && $menu['promenu_app_page'] != null && !$menu['promenu_is_cat'] )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_app_page']}</strong>
HTML;
			if ( $menu['page_folder'])
			{
				$IPBHTML .= <<<HTML
				{$menu['page_folder']}
HTML;
			}
				$IPBHTML .= <<<HTML
			/{$menu['page_seo_name']}&nbsp;&nbsp;</span>
HTML;
			}
			/* So we are using a URL to link the menu, lets show that URL!!! */
		 if ( $menu['promenu_url'] != null && !$menu['promenu_is_cat'])
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_url']}</strong>{$menu['promenu_url']}&nbsp;&nbsp;</span>
HTML;
			}
			/* If we have a description lets show it while we are here!!! */
			if ( !empty($menu['promenu_description']) )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_description']}</strong>{$menu['promenu_description']}&nbsp;&nbsp;</span>
HTML;
			}
					$IPBHTML .= <<<HTML
					</div>
				</div>
			{$this->get_the_children_now($menudata, $menu['promenu_id'])}
			</div>
HTML;
					}
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
			<br /><span class='no_messages'>{$this->lang->words['promenu_no_display']} <a href='{$this->settings['base_url']}module=menus&amp;section=menus&amp;do=add&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;parent=0' class='mini_button'>{$this->lang->words['promenu_add_menu']}</a><br /><br /></span>
		</div>
HTML;
		}
		$IPBHTML .= <<<HTML
	</div>
HTML;
	//--endhtml--//
	return $IPBHTML;
	}

/********************* Main display for submenu as parent ************************/
	public function submenus()
	{
	$id = intval($this->request['menu_id']);
	$parent = intval($this->request['parent']);
	$groupID = intval($this->request['group_id']);
	$groupKey = trim($this->request['group_key']);	
		// Lets build the new breadcrumb
		$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . 'module=menus&amp;section=menus&amp;group_id=' . $groupID . '&amp;group_key=' . $groupKey, $this->registry->getClass('class_groups')->get_group_title($groupID) );
		$this->registry->output->extra_nav[] = array( $this->settings['base_url'] . "module=menus&amp;section=menus&amp;do=viewsub&amp;menu_id={$id}&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;parent={$parent}", $this->lang->words['promenu_viewing'] . ": " . $this->lang->words['custom_submenus'] );
			
	$IPBHTML = "";
			//--starthtml--//
		
	$IPBHTML .= <<<HTML
	<div class='section_title'>
		<h2>{$this->lang->words['promenu_menus']}: {$this->registry->getClass('class_groups')->get_group_title($groupID)}</h2>
	</div> 
	<ul class='context_menu'>
		<li>
			<a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;do=add&amp;parent={$id}'>
				<img src='{$this->settings['skin_acp_url']}/images/icons/add.png' alt='' />
				{$this->lang->words['promenu_add_menu']}
			</a>
		</li>
	</ul>
HTML;
	$IPBHTML .= <<<HTML
	<div class="acp-box">
		<h3>{$this->lang->words['custom_submenus']}</h3>

HTML;
	/* Grab the menu data */
	$menudata = $this->registry->getClass('class_menus')->get_menu_query($groupKey);
	
		if( is_array( $menudata ) && count( $menudata ) )
		{
	$IPBHTML .= <<<HTML
		<div id='menu_container{$menudata['promenu_id']}' class='ipsExpandable'>
HTML;
			foreach ( $menudata as $menus => $menu ) 
			{
				/* Lets display the child as a parent */
				if( $menu['promenu_id'] == $id )
				{
					$IPBHTML .= <<<HTML
			<div class='isDraggable' id='menu_{$menu['promenu_id']}'>
				<div class='root_item item category clearfix ipsControlRow'>
					<div class='col_buttons right' >
						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}">{$this->lang->words['promenu_modify']}</a></li>
							<li class='i_add'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;do=add&amp;parent={$menu['promenu_id']}">{$this->lang->words['promenu_modify']}</a></li>
						<li class='ipsControlStrip_more ipbmenu' id="{$menu['promenu_id']}">
							<a href='#'>{$this->lang->words['promenu_options']}</a>
						</li>
					</ul>
					<ul class='acp-menu' id='{$menu['promenu_id']}_menucontent' style='display: none'>
HTML;
					if( $this->settings['promenu_group_perm_view'] == 1 )
					{
					$IPBHTML .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=vedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}'>{$this->lang->words['promenu_menu_visible']}</a></li>						
HTML;
					}
					else 
					{
					$IPBHTML .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=permedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}'>{$this->lang->words['promenu_permissions']}</a></li>						
HTML;
					}
					$IPBHTML .= <<<HTML
						<li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>{$this->lang->words['promenu_edit_menu']}</a></li>
						<li class='icon add'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;do=add&amp;parent={$menu['promenu_id']}'>{$this->lang->words['promenu_add_menu']}</a></li>
						<li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=dodelete&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_delete_menu']}</a></li>
				</ul>
					</div>
					<div class='draghandle'>&nbsp;</div>
					<div class='item_info' style='width:70%;'>
						<img src='{$this->settings['skin_acp_url']}/images/menu.png' />
				&nbsp;&nbsp;<strong class='larger_text'>{$menu['promenu_title']}</strong><br />
HTML;
			/* If we are using an application for a link lets show it! */
			if( $menu['promenu_use_app'] != null && !$menu['promenu_is_cat'] )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_application']}</strong>{$menu['promenu_use_app']}&nbsp;&nbsp;</span>
HTML;
			/* If we are using an application, are we using a IP.Content page as well and if we are lets show it! */
			}
			if ( $menu['promenu_use_app'] == 'ccs' && $menu['promenu_app_page'] != null && !$menu['promenu_is_cat'] )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_app_page']}</strong>
HTML;
			if ( $menu['page_folder'])
			{
				$IPBHTML .= <<<HTML
				{$menu['page_folder']}
HTML;
			}
				$IPBHTML .= <<<HTML
			/{$menu['page_seo_name']}&nbsp;&nbsp;</span>
HTML;
			}
			/* So we are using a URL to link the menu, lets show that URL!!! */
		 if ( $menu['promenu_url'] != null && !$menu['promenu_is_cat'])
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_url']}</strong>{$menu['promenu_url']}&nbsp;&nbsp;</span>
HTML;
			}
			/* If we have a description lets show it while we are here!!! */
			if ( !empty($menu['promenu_description']) )
			{
					$IPBHTML .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_description']}</strong>{$menu['promenu_description']}&nbsp;&nbsp;</span>
HTML;
			}
					$IPBHTML .= <<<HTML
					</div>
				</div>
			{$this->get_the_children_now($menudata, $menu['promenu_id'])}
			</div>
HTML;
				}
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
			<br /><span class='no_messages'>{$this->lang->words['promenu_no_display']} <a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$groupID}&amp;group_key={$groupKey}&amp;parent=0' class='mini_button'>{$this->lang->words['promenu_add_menu']}</a><br /><br /></span>
		</div>
HTML;
		}
	$IPBHTML .= <<<HTML
	</div>
HTML;
	//--endhtml--//
	return $IPBHTML;
	}
	
	public function get_the_children_now ( $menudata, $id )
	{

		$has_subcats = FALSE;
		if($this->request['do'] == 'viewsub')
		{
			$d = "block";
		}
		else {
			$d ="none";
		}
					$out .= <<<HTML
		<div id='submenu_container' class='item_wrap' style='display:{$d};'>
HTML;
		foreach ( $menudata as $menus => $menu )
		{
			$check_child = $this->registry->getClass('class_functions')->CheckChildrenTree($menudata,$menu['promenu_id']);
	
			if ( $menu [ 'promenu_parent_id' ] == $id ) 
			{
				$has_subcats = TRUE;

					$out .= <<<HTML
			<div class='isDraggable' id='menu_{$menu['promenu_id']}'>
				<div class='item wrap clearfix ipsControlRow'>
					<div class='col_buttons right' >
						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}">{$this->lang->words['promenu_modify']}</a></li>
							<li class='i_add'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_id']}">{$this->lang->words['promenu_modify']}</a></li>
						<li class='ipsControlStrip_more ipbmenu' id="{$menu['promenu_id']}">
							<a href='#'>{$this->lang->words['promenu_options']}</a>
						</li>
					</ul>
					<ul class='acp-menu' id='{$menu['promenu_id']}_menucontent' style='display: none'>

HTML;
					if( $this->settings['promenu_group_perm_view'] == 1 )
					{
					$out .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=vedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_menu_visible']}</a></li>						
HTML;
					}
					else 
					{
					$out .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=permedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_permissions']}</a></li>						
HTML;
					}
					$out .= <<<HTML
						<li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>{$this->lang->words['promenu_edit_menu']}</a></li>
						<li class='icon add'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_id']}'>{$this->lang->words['promenu_add_menu']}</a></li>
						<li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=dodelete&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_delete_menu']}</a></li>
HTML;
						if($check_child == 1)
						{
						$out .= <<<HTML
						<li class='icon view'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=viewsub&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>View With Subs</a></li>
HTML;
						}
					$out .= <<<HTML
				</ul>
					</div>
					<div class='draghandle'>&nbsp;</div>
					<div class='item_info' >
						<strong class='larger_text'>{$menu['promenu_title']}</strong><br />
HTML;
			if( $menu['promenu_use_app'] != null && !$menu['promenu_is_cat'])
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_application']}</strong>{$menu['promenu_use_app']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( $menu['promenu_use_app'] == 'ccs' && $menu['promenu_app_page'] != null && !$menu['promenu_is_cat'] )
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_app_page']}</strong>
HTML;
			if ( $menu['page_folder'])
			{
				$out .= <<<HTML
				{$menu['page_folder']}
HTML;
			}
				$out .= <<<HTML
			/{$menu['page_seo_name']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( $menu['promenu_url'] != null && !$menu['promenu_is_cat'])
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_url']}</strong>{$menu['promenu_url']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( !empty($menu['promenu_description']) )
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_description']}</strong>{$menu['promenu_description']}&nbsp;&nbsp;</span>
HTML;
			}
					$out .= <<<HTML
					<br />
					{$this->get_the_sub_children_now($menudata, $menu['promenu_id'],"0")}
					</div>
				</div>
			</div>
HTML;
			}
		}
					$out .= <<<HTML
		</div>
HTML;

		return ( $has_subcats ) ? $out : FALSE;
	}
/******************************** End View Sub As Parent *****************************************/
	
	public function get_the_sub_children_now ( $menudata, $id,$i )
	{
		$has_subcats = FALSE;

		foreach ( $menudata as $menus => $menu )
		{
			if ( $menu[ 'promenu_parent_id' ] == $id ) 
			{
				$has_subcats = TRUE;
				if($i == 0)
				{
					$out .= '&nbsp;';
					$i++;
				}
				else
				{
					$out .=",&nbsp;";
				}
				$out .= "<a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>";
				$out .= $menu[ 'promenu_title' ];
				$out .= '</a>';
				$out .= $this->get_the_sub_children_now ( $menudata, $menu[ 'promenu_id' ],$i);
			}	
		}
		return ( $has_subcats ) ? $out : FALSE;
	}
	/********************** Begin Back End Menu Functions ************************************/
	public function get_children ( $menudata, $id )
	{

					$out .= <<<HTML
		<div id='submenu_container{$id}' class='item_wrap'>
HTML;

		foreach ( $menudata[0] as $menus => $menu )
		{
			if ( $menu [ 'promenu_parent_id' ] == $id ) 
			{

					$out .= <<<HTML
			<div class='isDraggable' id='menu_{$menu['promenu_id']}'>
				<div class='item wrap clearfix ipsControlRow'>
					<div class='col_buttons right' >
						<ul class='ipsControlStrip'>
							<li class='i_edit'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}">{$this->lang->words['promenu_modify']}</a></li>
								<li class='i_add'><a href="{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_id']}">
								{$this->lang->words['promenu_modify']}</a></li>
						<li class='ipsControlStrip_more ipbmenu' id="{$menu['promenu_id']}">
							<a href='#'>{$this->lang->words['promenu_options']}</a>
						</li>
					</ul>
					<ul class='acp-menu' id='{$menu['promenu_id']}_menucontent' style='display: none'>
HTML;
					if( $this->settings['promenu_group_perm_view'] == 1 )
					{
					$out .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=vedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}'>{$this->lang->words['promenu_menu_visible']}</a></li>						
HTML;
					}
					else 
					{
					$out .= <<<HTML
						<li class='icon package'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=permedit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}'>{$this->lang->words['promenu_permissions']}</a></li>						
HTML;
					}
					$out .= <<<HTML
						<li class='icon edit'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>{$this->lang->words['promenu_edit_menu']}</a></li>
						<li class='icon add'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=add&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_id']}'>{$this->lang->words['promenu_add_menu']}</a></li>
						<li class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=dodelete&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}'>{$this->lang->words['promenu_delete_menu']}</a></li>
				</ul>
					</div>
					<div class='draghandle'>&nbsp;</div>
					<div class='item_info' >
						<strong class='larger_text'>{$menu['promenu_title']}</strong><br />
HTML;
			if( $menu['promenu_use_app'] != null && !$menu['promenu_is_cat'] )
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_application']}</strong>{$menu['promenu_use_app']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( $menu['promenu_use_app'] == 'ccs' && $menu['promenu_app_page'] != null && !$menu['promenu_is_cat'] )
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_app_page']}</strong>
HTML;
			if ( $menu['promenu_app_page_folder'])
			{
				$out .= <<<HTML
				{$menu['promenu_app_page_folder']}
HTML;
			}
				$out .= <<<HTML
			/{$menu['promenu_app_page_seo']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( $menu['promenu_url'] != null && $menu['promenu_use_app'] == null  && !$menu['promenu_is_cat'])
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_url']}</strong>{$menu['promenu_url']}&nbsp;&nbsp;</span>
HTML;
			}
			if ( !empty($menu['promenu_description']) )
			{
					$out .= <<<HTML
						<span class='desctext'><strong class='larger_text'>{$this->lang->words['promenu_description']}</strong>{$menu['promenu_description']}&nbsp;&nbsp;</span>
HTML;
			}
					$out .= <<<HTML
					<br />
HTML;

		
			if($menu[$menu['promenu_parent_id']])
			{
					$out .= <<<HTML
{$this->get_sub_children($menu, $menu['promenu_parent_id'],"0")}
HTML;
	}
							$out .= <<<HTML
							</div>
				</div>
			</div>
HTML;
			}
		}
					$out .= <<<HTML
		</div>
HTML;

		return  $out;
	}

	
	

	public function get_sub_children ( $menudata, $id,$i )
	{
		$has_subcats = FALSE;
if(count($menudata[$id]) && is_array($menudata[$id]))
{
		foreach ( $menudata[$id] as $menus => $menu )
		{
			
				$has_subcats = TRUE;
				if($i == 0)
				{
					$out .= '&nbsp;';
					$i++;
				}
				else
				{
					$out .=",&nbsp;";
				}
				$out .= "<a href='{$this->settings['base_url']}{$this->form_code}module=menus&amp;section=menus&amp;do=edit&amp;menu_id={$menu['promenu_id']}&amp;group_id={$menu['promenu_group_id']}&amp;group_key={$menu['promenu_group_key']}&amp;parent={$menu['promenu_parent_id']}'>";
				$out .= $menu[ 'promenu_title' ];
				$out .= '</a>';
				$out .= $this->get_sub_children ( $menu, $menu[ 'promenu_parent_id' ],$i);
				
		}
		}
		return ( $has_subcats ) ? $out : FALSE;
	}


/********************** End Back End Menu Functions ************************************/


	
}
