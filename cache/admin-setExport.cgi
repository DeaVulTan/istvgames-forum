
--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> Template Export: members
<?xml version="1.0" encoding="utf-8"?>
<templates application="members" templategroups="a:5:{s:14:&quot;skin_messaging&quot;;s:5:&quot;exact&quot;;s:10:&quot;skin_mlist&quot;;s:5:&quot;exact&quot;;s:11:&quot;skin_online&quot;;s:5:&quot;exact&quot;;s:12:&quot;skin_profile&quot;;s:5:&quot;exact&quot;;s:8:&quot;skin_ucp&quot;;s:5:&quot;exact&quot;;}">
  <templategroup group="skin_online">
    <template>
      <template_group>skin_online</template_group>
      <template_content><![CDATA[<div class='topic_controls'>
	{$links}
</div>
{parse replacement="header_start"}<h2 class='maintitle'>{$this->lang->words['online_page_title']}</h2>{parse replacement="header_end"}
<div class='ipsBox removeDefault'>
	<div class='ipsBox_container'>
		<table class='ipb_table ipsMemberList' summary="{$this->lang->words['users_online']}">
			<tr class='header'>
				<th scope='col' width='55'>&nbsp;</th>
				<th scope='col'>{$this->lang->words['member_name']}</th>
				<th scope='col'>{$this->lang->words['where']}</th>
				<th scope='col'>{$this->lang->words['time']}</th>
				<th scope='col'>&nbsp;</th>
			</tr>
			<if test="onlineusers:|:count($rows)">
				{parse striping="online" classes="row1,row2"}
				<foreach loop="online:$rows as $session">
					<tr class='{parse striping="online"}'>
						<td>{parse template="userSmallPhoto" group="global" params="array_merge( $session['_memberData'], array( 'alt' => sprintf($this->lang->words['users_photo'], $session['_memberData']['members_display_name'] ? $session['_memberData']['members_display_name'] : $this->lang->words['global_guestname']) ) )"}</td>
						<td>
							<if test="userid:|:$session['_memberData']['member_id']">
								{parse template="userHoverCard" group="global" params="array_merge( $session['_memberData'], array( 'members_display_name' => IPSMember::makeNameFormatted( $session['_memberData']['members_display_name'], $session['_memberData']['member_group_id'] ) ) )"}
							<else />
								<if test="username:|:$session['member_name']">
									{IPSMember::makeNameFormatted( $session['member_name'], $session['member_group'] )}
								<else />
									{$this->lang->words['global_guestname']}
								</if>
							</if>
							<if test="anonymous:|:$session['login_type'] == 1">
								<if test="viewanon:|:$this->memberData['g_access_cp'] || $session['_memberData']['member_id'] == $this->memberData['member_id']">*</if>
							</if>
							<if test="showip:|:$this->memberData['g_is_supmod']">
								<br />
								<span class='ip desc lighter ipsText_smaller'>({$session['ip_address']})</span>
							</if>
						</td>
						<td>
							<if test="nowhere:|:!$session['where_line'] || $session['in_error']">
								{$this->lang->words['board_index']}
							<else />
								<if test="wheretext:|:$session['where_link'] AND !$session['where_line_more']">
									<if test="wheretextseo:|:$session['_whereLinkSeo']">
										<a href='{$session['_whereLinkSeo']}'>
									<else />
										<a href='{parse url="{$session['where_link']}" base="public"}'>
									</if>
								</if>
								{$session['where_line']} 
								<if test="moredetails:|:$session['where_line_more']">
									&nbsp;
									<if test="wheretextseo:|:$session['_whereLinkSeo']">
										<a href='{$session['_whereLinkSeo']}'>
									<else />
										<if test="detailslink:|:$session['where_link']"><a href='{parse url="{$session['where_link']}" base="public"}'></if>
									</if>
									{$session['where_line_more']}
									<if test="enddetailslink:|:$session['where_link']"></a></if>
								<else />
									<if test="nomoreenddetailslink:|:$session['where_link']"></a></if>
								</if>
							</if>
						</td>
						<td>
							{parse date="$session['running_time']" format="long" relative="false"}
						</td>
						<td>
							<if test="options:|:$session['member_id'] AND $session['member_name']">
								<ul class='ipsList_inline ipsList_nowrap right'>
									<if test="notus:|:$this->memberData['member_id'] AND $this->memberData['member_id'] != $session['member_id'] && $this->settings['friends_enabled'] AND $this->memberData['g_can_add_friends']">
										<if test="addfriend:|:IPSMember::checkFriendStatus( $session['member_id'] )">
											<li class='mini_friend_toggle is_friend' id='friend_online_{$session['member_id']}'><a href='{parse url="app=members&amp;module=profile&amp;section=friends&amp;do=remove&amp;member_id={$session['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['remove_friend']}' class='ipsButton_secondary'>{parse replacement="remove_friend"}</a></li>
										<else />
											<li class='mini_friend_toggle is_not_friend' id='friend_online_{$session['member_id']}'><a href='{parse url="app=members&amp;module=profile&amp;section=friends&amp;do=add&amp;member_id={$session['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['add_friend']}' class='ipsButton_secondary'>{parse replacement="add_friend"}</a></li>								
										</if>
									</if>
									<if test="sendpm:|:$this->memberData['member_id'] AND $this->memberData['member_id'] != $session['member_id'] AND $this->memberData['g_use_pm'] AND $this->memberData['members_disable_pm'] == 0 AND IPSLib::moduleIsEnabled( 'messaging', 'members' )">
										<li class='pm_button' id='pm_online_{$session['member_id']}'><a href='{parse url="app=members&amp;module=messaging&amp;section=send&amp;do=form&amp;fromMemberID={$session['member_id']}" base="public"}' title='{$this->lang->words['pm_member']}' class='ipsButton_secondary'>{parse replacement="send_msg"}</a></li>
									</if>
									<if test="blog:|:$session['memberData']['has_blog'] AND IPSLib::appIsInstalled( 'blog' )">
										<li><a href='{parse url="app=blog&amp;module=display&amp;section=blog&amp;show_members_blogs={$session['member_id']}" base="public"}' title='{$this->lang->words['view_blog']}' class='ipsButton_secondary'>{parse replacement="blog_link"}</a></li>
									</if>
									<if test="gallery:|:$session['memberData']['has_gallery'] AND IPSLib::appIsInstalled( 'gallery' )">
										<li><a href='{parse url="app=gallery&amp;user={$session['member_id']}" template="useralbum" seotitle="{$session['memberData']['members_seo_name']}" base="public"}' title='{$this->lang->words['view_gallery']}' class='ipsButton_secondary'>{parse replacement="gallery_link"}</a></li>
									</if>
								</ul>
							<else />
								<span class='desc'>{$this->lang->words['no_options_available']}</span>
							</if>
						</td>
					</tr>
				</foreach>
			</if>
		</table>
	</div>
</div>{parse replacement="box_end"}
<div id='forum_filter' class='ipsForm_center ipsPad'>
	<form method="post" action="{parse url="app=members&amp;section=online&amp;module=online" base="public"}">
		<label for='sort_key'>{$this->lang->words['s_by']}</label>
		<select name="sort_key" id='sort_key' class='input_select'>
			<foreach loop="sort_key:array( 'click', 'name' ) as $sort">
				<option value='{$sort}'<if test="defaultsort:|:$defaults['sort_key'] == $sort"> selected='selected'</if>>{$this->lang->words['s_sort_key_' . $sort ]}</option>
			</foreach>
		</select>
		<select name="show_mem" class='input_select'>
			<foreach loop="show_mem:array( 'reg', 'guest', 'all' ) as $filter">
				<option value='{$filter}'<if test="defaultfilter:|:$defaults['show_mem'] == $filter"> selected='selected'</if>>{$this->lang->words['s_show_mem_' . $filter ]}</option>
			</foreach>
		</select>
		<select name="sort_order" class='input_select'>
			<foreach loop="sort_order:array( 'desc', 'asc' ) as $order">
				<option value='{$order}'<if test="defaultorder:|:$defaults['sort_order'] == $order"> selected='selected'</if>>{$this->lang->words['s_sort_order_' . $order ]}</option>
			</foreach>
		</select>
		<input type="submit" value="{$this->lang->words['s_go']}" class="input_submit alt" />
	</form>
</div>
<br />
<div class='topic_controls'>
	{$links}
</div>]]></template_content>
      <template_name>showOnlineList</template_name>
      <template_data><![CDATA[$rows, $links="", $defaults=array()]]></template_data>
      <template_removable>1</template_removable>
      <template_user_added>0</template_user_added>
      <template_user_edited>1</template_user_edited>
      <template_master_key/>
    </template>
  </templategroup>
  <templategroup group="skin_profile">
    <template>
      <template_group>skin_profile</template_group>
      <template_content><![CDATA[<div class='vcard userpopup'>

	<h3 class="wa_showcard"  style='

<if test="hasBackgroundColor:|:$member['customization']['bg_color']">
		background-color: #{$member['customization']['bg_color']} !important;
	</if>
	<if test="hasBackgroundImage:|:$member['customization']['_bgUrl']">
		background-image: url("{$member['customization']['_bgUrl']}?nc={$member['pp_profile_update']}") !important;
height: 100px !important;
line-height: 190px;
background-repeat: no-repeat;
-webkit-background-size: 100% 100% !important;
-moz-background-size: 100% 100% !important;
background-size: 100% 100% !important;
background-position: 50% 50%;
	</if>
</if>


background-image: url({$member['customization']['_bgUrl']}) !important;'>
<a href="{parse url="showuser={$member['member_id']}" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}" class="fn nickname url">{$member['members_display_name']}</a></h3>

	<div class='side left ipsPad'>
		<a href="{parse url="showuser={$member['member_id']}" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}" class="ipsUserPhotoLink">
			<img src="{$member['pp_thumb_photo']}" alt="{$this->lang->words['get_photo']}" class='ipsUserPhoto ipsUserPhoto_large' />
		</a>
		<br />
		<if test="cardRep:|:$this->settings['reputation_enabled'] && $this->settings['reputation_show_profile']">
			<if test="cardRepPos:|:$member['pp_reputation_points'] > 0">
				<div class='reputation positive'>
			</if>
			<if test="cardRepNeg:|:$member['pp_reputation_points'] < 0">
				<div class='reputation negative'>
			</if>
			<if test="cardRepZero:|:$member['pp_reputation_points'] == 0">
				<div class='reputation zero'>
			</if>
					<span class='number'>{$member['pp_reputation_points']}</span>
				</div>
		</if>
		<a href='{parse url="app=core&amp;module=search&amp;do=user_activity&amp;mid={$member['member_id']}" base="public"}' title='{$this->lang->words['gbl_find_my_content']}' class='ipsButton_secondary ipsType_smaller'>{$this->lang->words['gbl_find_my_content']}</a>
		<if test="cardSendPm:|:$this->memberData['member_id'] AND $this->memberData['member_id'] != $member['member_id'] AND $this->memberData['g_use_pm'] AND $this->memberData['members_disable_pm'] == 0 AND IPSLib::moduleIsEnabled( 'messaging', 'members' ) AND $member['members_disable_pm'] == 0">
			<a href='{parse url="app=members&amp;module=messaging&amp;section=send&amp;do=form&amp;fromMemberID={$member['member_id']}" base="public"}' title='{$this->lang->words['pm_this_member']}' id='pm_xxx_{$member['member_id']}' class='pm_button ipsButton_secondary ipsType_smaller'>{$this->lang->words['pm_this_member']}</a>
		</if>
	</div>
	<div class='ipsPad'>
		<if test="cardStatus:|:$member['_status']['status_content']">
			<p class='message user_status'>{$member['_status']['status_content']}</p>
		</if>
		<div class='info'>
			<dl>
				<dt>{$this->lang->words['m_group']}</dt>
				<dd>{$member['_group_formatted']}</dd>
				<dt>{$this->lang->words['m_posts']}</dt>
				<dd>{parse format_number="$member['posts']"}</dd>
				<dt>{$this->lang->words['m_member_since']}</dt>
				<dd>{parse date="$member['joined']" format="joined"}</dd>
				<dt>{$this->lang->words['m_last_active']}</dt>
				<dd><if test="cardOnline:|:$member['_online']"><span class='ipsBadge ipsBadge_green'>{$this->lang->words['online_online']}</span><else /><span class='ipsBadge ipsBadge_grey'>{$this->lang->words['online_offline']}</span></if> {$member['_last_active']}</dd>
				<if test="cardWhere:|:$member['_online'] && ($member['online_extra'] != $this->lang->words['not_online'])">
					<dt>{$this->lang->words['m_currently']}</dt>
					<dd>
						{$member['online_extra']}
					</dd>
				</if>
				<if test="isadmin:|:$this->memberData['g_access_cp'] == 1">
					<dt>{$this->lang->words['m_email']}</dt>
					<dd><a href='mailto:{$member['email']}'>{$member['email']}</a></dd>
				</if>
			</dl>
		</div>
		<ul class='user_controls clear'>
			<if test="authorspammer:|:$member['spamStatus'] !== NULL && $member['member_id'] != $this->memberData['member_id']">
				<if test="authorspammerinner:|:$member['spamStatus'] === TRUE">
					<li><a href='#' title='{$this->lang->words['spm_on']}' onclick="return ipb.global.toggleFlagSpammer({$member['member_id']}, false)">{parse replacement="spammer_on"}</a></li>
				<else />
					<li><a title='{$this->lang->words['spm_off']}' href='{$this->settings['base_url']}app=core&amp;module=modcp&amp;do=setAsSpammer&amp;member_id={$member['member_id']}&amp;auth_key={$this->member->form_hash}' onclick="return ipb.global.toggleFlagSpammer({$member['member_id']}, true)">{parse replacement="spammer_off"}</a></li>
				</if>
			</if>
			<if test="cardFriend:|:$this->memberData['member_id'] AND $this->memberData['member_id'] != $member['member_id'] && $this->settings['friends_enabled'] AND $this->memberData['g_can_add_friends']">
				<if test="cardIsFriend:|:IPSMember::checkFriendStatus( $member['member_id'] )">
					<li><a href='{parse url="app=members&amp;module=profile&amp;section=friends&amp;do=remove&amp;member_id={$member['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['remove_friend']}'>{parse replacement="remove_friend"}</a></li>
				<else />
					<li><a href='{parse url="app=members&amp;module=profile&amp;section=friends&amp;do=add&amp;member_id={$member['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['add_friend']}'>{parse replacement="add_friend"}</a></li>
				</if>
			</if>
			<if test="cardBlog:|:$member['has_blog'] AND IPSLib::appIsInstalled( 'blog' )">
				<li><a href='{parse url="app=blog&amp;module=display&amp;section=blog&amp;show_members_blogs={$member['member_id']}" base="public"}' title='{$this->lang->words['view_blog']}'>{parse replacement="blog_link"}</a></li>
			</if>
			<if test="cardGallery:|:$member['has_gallery'] AND IPSLib::appIsInstalled( 'gallery' )">
				<li><a href='{parse url="app=gallery&amp;user={$member['member_id']}" seotitle="{$member['members_seo_name']}" template="useralbum" base="public"}' title='{$this->lang->words['view_gallery']}'>{parse replacement="gallery_link"}</a></li>
			</if>
		</ul>
	</div>
</div>]]></template_content>
      <template_name>showCard</template_name>
      <template_data>$member, $download=0</template_data>
      <template_removable>1</template_removable>
      <template_user_added>0</template_user_added>
      <template_user_edited>1</template_user_edited>
      <template_master_key/>
    </template>
    <template>
      <template_group>skin_profile</template_group>
      <template_content><![CDATA[<style type="text/css">
<if test="hasBodyCustomization:|:$member['customization']['bg_color'] OR $member['customization']['_bgUrl']">

#customBackground{
<if test="hasBackgroundColor:|:$member['customization']['bg_color']">
		background-color: #{$member['customization']['bg_color']} !important;
	</if>
	<if test="hasBackgroundImage:|:$member['customization']['_bgUrl']">
		background-image: url("{$member['customization']['_bgUrl']}?nc={$member['pp_profile_update']}") !important;
		<if test="backgroundIsFixed:|:! $member['customization']['bg_tile']">
			background-position: 50% 50%;
			background-repeat: no-repeat;
			-webkit-background-size: 100% 100%;
			-moz-background-size: 100% 100%;
			background-size: cover;
		<else />
			background-position: 50% 50%;
			background-repeat: repeat;
		</if>
	</if>
	height: 500px;
	margin: -9px -9px 0 -9px;
}

#profile_background > .ipsLayout{ position: relative; margin-top: -129px; }
.ipsLayout.ipsLayout_withleft{padding-left: 150px;background: none !important;}
#user_utility_links{ margin-top: 0; }

#user_utility_links a{
	background: url("{style_images_url}/trans50.png") repeat;
	background: rgba(0,0,0,0.5);
	-webkit-box-shadow: inset rgba(0,0,0,0.4) 0px 1px 3px, rgba(255,255,255,0.1) 0px 1px 0px;
	-moz-box-shadow: inset rgba(0,0,0,0.4) 0px 1px 3px, rgba(255,255,255,0.1) 0px 1px 0px;
	box-shadow: inset rgba(0,0,0,0.4) 0px 1px 3px, rgba(255,255,255,0.1) 0px 1px 0px;
	color: #fff;
	display: inline-block;
	padding: 0 10px;
	border-radius: 3px;
	line-height: 30px;
	height: 30px;
	text-shadow: rgba(0,0,0,0.4) 0px 1px 0px;
	border: 0;
}

#user_utility_links a:hover{
	background: url("{style_images_url}/trans70.png") repeat;
	background: rgba(0,0,0,0.7);
}

#user_utility_links img{ margin-right: 4px; }

</if>
</style>
<script type="text/javascript">
	ipb.profile.customization = 1;
</script>]]></template_content>
      <template_name>customizeProfile</template_name>
      <template_data>$member</template_data>
      <template_removable>1</template_removable>
      <template_user_added>0</template_user_added>
      <template_user_edited>1</template_user_edited>
      <template_master_key/>
    </template>
    <template>
      <template_group>skin_profile</template_group>
      <template_content><![CDATA[{parse js_module="status"}
{parse js_module="rating"}
{parse js_module="profile"}
<script type='text/javascript'>
//<!#^#|CDATA|
	ipb.profile.viewingProfile = parseInt( {$member['member_id']} );
	<if test="$this->memberData['member_id']">
		ipb.templates['remove_friend'] = "<a href='{parse url="app=members&amp;section=friends&amp;module=profile&amp;do=remove&amp;member_id={$member['member_id']}" base="public"}' title='{$this->lang->words['remove_as_friend']}'><img src='{$this->settings['img_url']}/user_delete.png' alt='{$this->lang->words['remove_as_friend']}' />&nbsp;&nbsp; {$this->lang->words['remove_as_friend']}</a>";
		ipb.templates['add_friend'] = "<a href='{parse url="app=members&amp;section=friends&amp;module=profile&amp;do=add&amp;member_id={$member['member_id']}" base="public"}' title='{$this->lang->words['add_me_friend']}'><img src='{$this->settings['img_url']}/user_add.png' alt='{$this->lang->words['add_me_friend']}' />&nbsp;&nbsp; {$this->lang->words['add_me_friend']}</a>";
	</if>
	ipb.templates['edit_status'] = "<span id='edit_status'><input type='text' class='input_text' style='width: 60%' id='updated_status' maxlength='150' /> <input type='submit' value='{$this->lang->words['save']}' class='input_submit' id='save_status' /> &nbsp;<a href='#' id='cancel_status' class='cancel' title='{$this->lang->words['cancel']}'>{$this->lang->words['cancel']}</a></span>";
	<if test="friendsEnabled:|:$this->settings['friends_enabled'] AND $this->memberData['g_can_add_friends']">
		<if test="jsIsFriend:|:IPSMember::checkFriendStatus( $member['member_id'] )">
			ipb.profile.isFriend = true;
		<else />
			ipb.profile.isFriend = false;
		</if>
	</if>
//|#^#]>
</script>
<if test="hasCustomization:|:is_array($member['customization']) AND $member['customization']['type']">
	{parse template="customizeProfile" group="profile" params="$member"}
</if>
<if test="canEditUser:|:($this->memberData['member_id'] && $member['member_id'] == $this->memberData['member_id']) || $this->memberData['g_is_supmod'] == 1 || ($this->memberData['member_id'] && $member['member_id'] != $this->memberData['member_id'])">
	<ul class='topic_buttons'>
		<if test="weAreSupmod:|:$this->memberData['g_is_supmod'] == 1 && $member['member_id'] != $this->memberData['member_id']">
			<li><a href='{parse url="app=core&amp;module=modcp&amp;do=editmember&amp;auth_key={$this->member->form_hash}&amp;mid={$member['member_id']}&amp;pf={$member['member_id']}" base="public"}'>{$this->lang->words['supmod_edit_member']}</a></li>
		</if>
		<if test="weAreOwner:|:$this->memberData['member_id'] && $member['member_id'] == $this->memberData['member_id']">
			<li><a href='{parse url="app=core&amp;module=usercp&amp;tab=core" base="public"}'>{$this->lang->words['edit_profile']}</a></li>
		</if>
		<if test="supModCustomization:|:($member['member_id'] == $this->memberData['member_id'] ) AND $member['customization']['type']">
			<li class='non_button'><a href='{parse url="showuser={$member['member_id']}&amp;secure_key={$this->member->form_hash}&amp;removeCustomization=1" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}'>{$this->lang->words['cust_remove']}</a></li>
		</if>
	</ul>
</if>
<div class='ipsBox vcard' id='profile_background'>
<div id="customBackground"></div>
	<div class='ipsVerticalTabbed ipsLayout ipsLayout_withleft ipsLayout_smallleft clearfix'>
		<div class='ipsVerticalTabbed_tabs ipsLayout_left' id='profile_tabs'>
			<p class='short photo_holder'>
				<if test="canEditPic:|:($this->memberData['member_id'] && $member['member_id'] == $this->memberData['member_id']) AND (IPSMember::canUploadPhoto($member, TRUE))">
					<a data-clicklaunch="launchPhotoEditor" href="{parse url="app=members&amp;module=profile&amp;section=photo" base="public"}" id='change_photo' class='ipsType_smaller ipsPad' title='{$this->lang->words['change_photo_desc']}'>{$this->lang->words['change_photo_link']}</a>
				</if>
				<img class="ipsUserPhoto" id='profile_photo' src='{$member['pp_main_photo']}' alt="{parse expression="sprintf($this->lang->words['users_photo'],$member['members_display_name'])"}"  />
			</p>
			<if test="haswarn:|:$member['show_warn']">
				<div class='warn_panel clear ipsType_small'>
					<strong><a href='{parse url="app=members&amp;module=profile&amp;section=warnings&amp;member={$member['member_id']}&amp;from_app=members" base="public"}' id='warn_link_xxx_{$member['member_id']}' title='{$this->lang->words['warn_view_history']}'>{parse expression="sprintf( $this->lang->words['warn_status'], $member['warn_level'] )"}</a></strong>
				</div>
			</if>
			<ul class='clear'>
				<li id='tab_link_core:info' class='tab_toggle <if test="$default_tab == 'core:info'">active</if>' data-tabid='user_info'><a href='#'>{$this->lang->words['pp_tab_info']}</a></li>
				<foreach loop="tabs:$tabs as $tab">
					<li id='tab_link_{$tab['app']}:{$tab['plugin_key']}' class='<if test="tabactive:|:$tab['app'].':'.$tab['plugin_key'] == $default_tab || $this->request['tab'] == $tab['plugin_key']">active</if> tab_toggle' data-tabid='{$tab['plugin_key']}'><a href='{parse url="showuser={$member['member_id']}&amp;tab={$tab['plugin_key']}" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}' title='{$this->lang->words['view']} {$tab['_lang']}'>{$tab['_lang']}</a></li>
				</foreach>
			</ul>
		</div>
		<div class='ipsVerticalTabbed_content ipsLayout_content ipsBox_container' id='profile_content'>
			<div class='ipsPad'>
				<div id='profile_content_main'>
					<div id='user_info_cell'>
						<h1 class='ipsType_pagetitle'>
							<span class='fn nickname'>{$member['members_display_name']}</span>
						</h1>
						{$this->lang->words['m_member_since']} {parse date="$member['joined']" format="DATE"}<br />
						<if test="hasWarns:|:!empty( $warns )">
							<foreach loop="warnsLoop:array( 'ban', 'suspend', 'rpa', 'mq' ) as $k">
								<if test="warnIsSet:|:isset( $warns[ $k ] )">
									<span class='ipsBadge ipsBadge_red<if test="warnClickable:|:$warns[ $k ]"> clickable</if>' <if test="warnPopup:|:$warns[ $k ]">onclick='warningPopup( this, {$warns[ $k ]} )'</if>>{$this->lang->words[ 'warnings_profile_badge_' . $k ]}</span>
								</if>
							</foreach>
						</if>
						<if test="onlineDetails:|:$member['_online'] && ($member['online_extra'] != $this->lang->words['not_online'])">
							<span class='ipsBadge ipsBadge_green reset_cursor' data-tooltip="{parse expression="strip_tags($member['online_extra'])"}">{$this->lang->words['online_online']}</span>
						<else />
							<span class='ipsBadge ipsBadge_lightgrey reset_cursor'>{$this->lang->words['online_offline']}</span>
						</if>
						<span class='desc lighter'>{$this->lang->words['m_last_active']} {$member['_last_active']}</span>
					</div>
					<if test="userStatus:|:$status['status_id'] && $this->settings['su_enabled']">
					<div id='user_status_cell'>
						<div id='user_latest_status'>
							<div>
								{parse expression="IPSText::truncate( strip_tags( $status['status_content'] ), 180 )"}
								<span class='ipsType_smaller desc lighter blend_links'><a href='{parse url="app=members&amp;module=profile&amp;section=status&amp;type=single&amp;status_id={$status['status_id']}" seotitle="array($status['member_id'], $status['members_seo_name'])" template="members_status_single" base="public"}'>{$this->lang->words['ps_updated']} {parse date="$status['status_date']" format="manual{%d %b}" relative="true"} &middot; {parse expression="intval($status['status_replies'])"} {$this->lang->words['ps_comments']}</a></span>
							</div>
						</div>
					</div>
					</if>
					<if test="allowRate:|:$this->settings['pp_allow_member_rate']">
						<span class='rating left clear' style='margin-bottom: 10px'>
							<if test="noRateYourself:|:$this->memberData['member_id'] == $member['member_id'] || !$this->memberData['member_id']">
									<if test="rate1:|:$member['pp_rating_real'] >= 1">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if><if test="rate2:|:$member['pp_rating_real'] >= 2">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if><if test="rate3:|:$member['pp_rating_real'] >= 3">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if><if test="rate4:|:$member['pp_rating_real'] >= 4">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if><if test="rate5:|:$member['pp_rating_real'] >= 5">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if><span id='rating_text' class='desc'></span>
							<else />
									<a href='#' id='user_rate_1' title='{$this->lang->words['m_rate_1']}'><if test="rated1:|:$member['pp_rating_real'] >= 1">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if></a><a href='#' id='user_rate_2' title='{$this->lang->words['m_rate_2']}'><if test="rated2:|:$member['pp_rating_real'] >= 2">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if></a><a href='#' id='user_rate_3' title='{$this->lang->words['m_rate_3']}'><if test="rated3:|:$member['pp_rating_real'] >= 3">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if></a><a href='#' id='user_rate_4' title='{$this->lang->words['m_rate_4']}'><if test="rated4:|:$member['pp_rating_real'] >= 4">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if></a><a href='#' id='user_rate_5' title='{$this->lang->words['m_rate_5']}'><if test="rated5:|:$member['pp_rating_real'] >= 5">{parse replacement="rate_on"}<else />{parse replacement="rate_off"}</if></a> <span id='rating_text' class='desc'></span>
								<script type='text/javascript'>
									rating = new ipb.rating( 'user_rate_', {
														url: ipb.vars['base_url'] + 'app=members&module=ajax&section=rate&member_id={$member['member_id']}&md5check=' + ipb.vars['secure_hash'],
														cur_rating: <if test="hasrating:|:isset($member['pp_rating_real'])">{$member['pp_rating_real']}<else />0</if>,
														rated: null,
														allow_rate: ( {$this->memberData['member_id']} != 0 ) ? 1 : 0,
														show_rate_text: false
													  } );
								</script>
							</if>
						</span>
					</if>
					<ul class='ipsList_inline' id='user_utility_links'>
						<if test="noFriendYourself:|:$this->memberData['member_id'] AND $this->memberData['member_id'] != $member['member_id'] && $this->settings['friends_enabled'] AND $this->memberData['g_can_add_friends']">
							<li id='friend_toggle' class='ipsButton_secondary'>
								<if test="isFriend:|:IPSMember::checkFriendStatus( $member['member_id'] )">
									<a href='{parse url="app=members&amp;section=friends&amp;module=profile&amp;do=remove&amp;member_id={$member['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['remove_friend']}'><img src='{$this->settings['img_url']}/user_delete.png' alt='{$this->lang->words['remove_friend']}' />&nbsp;&nbsp; {$this->lang->words['remove_as_friend']}</a>
								<else />
									<a href='{parse url="app=members&amp;section=friends&amp;module=profile&amp;do=add&amp;member_id={$member['member_id']}&amp;secure_key={$this->member->form_hash}" base="public"}' title='{$this->lang->words['add_friend']}'><img src='{$this->settings['img_url']}/user_add.png' alt='{$this->lang->words['add_friend']}' />&nbsp;&nbsp; {$this->lang->words['add_me_friend']}</a>
								</if>
							</li>
						</if>
						<if test="pmlink:|:($member['member_id'] != $this->memberData['member_id']) AND $this->memberData['g_use_pm'] AND $this->memberData['members_disable_pm'] == 0 AND IPSLib::moduleIsEnabled( 'messaging', 'members' ) AND $member['members_disable_pm'] == 0">
							<li class='pm_button' id='pm_xxx_{$member['member_id']}'><a href='{parse url="app=members&amp;module=messaging&amp;section=send&amp;do=form&amp;fromMemberID={$member['member_id']}" base="public"}' title='{$this->lang->words['pm_this_member']}' class='ipsButton_secondary'>{parse replacement="send_msg"}&nbsp;&nbsp; {$this->lang->words['send_message']}</a></li>
						</if>
						<li>
							<a href='{parse url="app=core&amp;module=search&amp;do=user_activity&amp;mid={$member['member_id']}" base="public"}' class='ipsButton_secondary'>{parse replacement="find_topics_link"}&nbsp;&nbsp;  {$this->lang->words['gbl_find_my_content']}</a>
						</li>
					</ul>
				</div>
				<div id='profile_panes_wrap' class='clearfix'>
					
					<div id='pane_core:info' class='ipsLayout ipsLayout_withright ipsLayout_largeright clearfix' <if test="$default_tab != 'core:info'">style='display: none'</if>>
						<div class='ipsLayout_content'>
							<if test="$member['pp_about_me']">
								<div class='general_box clearfix' id='about_me'>
									<h3>{$this->lang->words['pp_tab_aboutme']}</h3>
									<div class='ipsPad as_content'>
										
											{$member['pp_about_me']}
										
									</div>
								</div>
								<hr/>
							</if>
							<div class='general_box clearfix'>
								<h3>{$this->lang->words['community_stats']}</h3>
								<br />
								<ul class='ipsList_data clearfix'>
									<li class='clear clearfix'>
										<span class='row_title'>{$this->lang->words['m_group']}</span>
										<span class='row_data'>{$member['g_title']}</span>
									</li>
									<li class='clear clearfix'>
										<span class='row_title'>{$this->lang->words['m_posts']}</span>
										<span class='row_data'>{parse format_number="$member['posts']"}</span>
									</li>
									<li class='clear clearfix'>
										<span class='row_title'>{$this->lang->words['m_profile_views']}</span>
										<span class='row_data'>{parse format_number="$member['members_profile_views']"}</span>
									</li>
									<if test="member_title:|:$member['title'] != ''">
										<li class='clear clearfix'>
											<span class='row_title'>{$this->lang->words['m_member_title']}</span>
											<span class='row_data'>{$member['title']}</span>
										</li>
									</if>
									<li class='clear clearfix'>
										<span class='row_title'>{$this->lang->words['m_age_prefix']}</span>
										<if test="member_age:|:$member['_age'] > 0">
											<span class='row_data'>{$member['_age']} {$this->lang->words['m_years_old']}</span>
										<else />
											<span class='row_data desc lighter'>{$this->lang->words['m_age_unknown']}</span>
										</if>
									</li>
									<li class='clear clearfix'>
										<span class='row_title'>{$this->lang->words['m_birthday_prefix']}</span>
										<if test="member_birthday:|:$member['bday_day']">
											<span class='row_data'>{$member['_bday_month']} {$member['bday_day']}<if test="member_bday_year:|:$member['bday_year']">, {$member['bday_year']}</if></span>
										<else />
											<span class='row_data desc lighter'>{$this->lang->words['m_bday_unknown']}</span>
										</if>
									</li>
									<if test="pcfields:|:$member['custom_fields']['profile_info'] != """>
										<foreach loop="pcfieldsLoop:$member['custom_fields']['profile_info'] as $key => $value">
											<if test="!empty($value)">
												<li class='clear clearfix'>
													{$value}
												</li>
											</if>
										</foreach>
									</if>
								</ul>
								<br />
							</div>
							
							<if test="pcfieldsOther:|:$member['custom_fields']">
								<foreach loop="pcfieldsOtherLoop:$member['custom_fields'] as $group => $mdata">
									<if test="pcfieldsOtherLoopCheck:|:$group != 'profile_info' AND $group != 'contact'">
										<if test="pcfieldsOtherLoopCheck2:|:is_array( $member['custom_fields'][ $group ] ) AND count( $member['custom_fields'][ $group ] )">
											<div class='general_box clearfix' id='custom_fields_{$group}'>
												<h3 class='bar'>{$member['custom_field_groups'][ $group ]}</h3>
												<br />
												<ul class='ipsList_data clearfix'>
													<foreach loop="pcfieldsOtherLoopCheckInner:$member['custom_fields'][ $group ] as $key => $value">
														<if test="pcfieldsEmptyValue:|:! empty( $value )">
															<li class='clear clearfix'>
																{$value}
															</li>
														</if>
													</foreach>
												</ul>
												<br />
											</div>
										</if>
									</if>
								</foreach>
							</if>
							
							<if test="hasContactFields:|:$this->memberData['g_access_cp'] == 1 || is_array( $member['custom_fields']['contact'] )">
								<div class='general_box clearfix'>
								<if test="showContactHead:|:$this->memberData['g_access_cp'] == 1 || $show_contact">
									<h3>{$this->lang->words['contact_info']}</h3>
									<br />
								</if>
									<ul class='ipsList_data clearfix'>
										<if test="isadmin:|:$this->memberData['g_access_cp'] == 1">
											<li class='clear clearfix'>
												<span class='row_title'>{$this->lang->words['m_email']}</span>
												<span class='row_data'>
													<a href='mailto:{$member['email']}'>{$member['email']}</a>
												</span>
											</li>
										</if>
										<if test="member_contact_fields:|:is_array( $member['custom_fields']['contact'])">
											<foreach loop="cfields:$member['custom_fields']['contact'] as $field">
												{$field}
											</foreach>
										</if>
									</ul>
								</div>
							</if>
						</div>
						
						<div class='ipsLayout_right'>
							<if test="ourReputation:|:$this->settings['reputation_enabled'] && $this->settings['reputation_show_profile']">
								<if test="RepPositive:|:$member['pp_reputation_points'] > 0">
									<div class='reputation positive' data-tooltip="{parse expression="sprintf( $this->lang->words['rep_description'], $member['members_display_name'], $member['pp_reputation_points'])"}">
								</if>
								<if test="RepNegative:|:$member['pp_reputation_points'] < 0">
									<div class='reputation negative' data-tooltip="{parse expression="sprintf( $this->lang->words['rep_description'], $member['members_display_name'], $member['pp_reputation_points'])"}">
								</if>
								<if test="RepZero:|:$member['pp_reputation_points'] == 0">
									<div class='reputation zero' data-tooltip="{parse expression="sprintf( $this->lang->words['rep_description'], $member['members_display_name'], $member['pp_reputation_points'])"}">
								</if>
										<span class='number'>{$member['pp_reputation_points']}</span>
										<if test="RepText:|:$member['author_reputation'] && $member['author_reputation']['text']">
											<span class='title'>{$member['author_reputation']['text']}</span>
										</if>
										<if test="RepImage:|:$member['author_reputation'] && $member['author_reputation']['image']">
											<span class='image'><img src='{$member['author_reputation']['image']}' alt='{$this->lang->words['m_reputation']}' /></span>
										</if>
									</div>
								
								<br />
							</if>
							
							<if test="checkModTools:|:($member['spamStatus'] !== NULL && $member['member_id'] != $this->memberData['member_id']) || ($this->memberData['g_mem_info'] && $this->settings['auth_allow_dnames']) || (($member['member_id'] != $this->memberData['member_id'] AND $this->memberData['g_is_supmod'] ) AND $member['customization']['type'])">
								<div class='general_box clearfix'>
									<h3>{$this->lang->words['user_tools']}</h3>
									<ul class='ipsPad'>
										<if test="authorspammer:|:$member['spamStatus'] !== NULL && $member['member_id'] != $this->memberData['member_id']">
											<if test="authorspammerinner:|:$member['spamStatus'] === TRUE">
												<li><a href='#' onclick="return ipb.global.toggleFlagSpammer({$member['member_id']}, false)">{parse replacement="spammer_on"} {$this->lang->words['spm_on']}</a></li>
											<else />
												<li><a href='{$this->settings['base_url']}app=core&amp;module=modcp&amp;do=setAsSpammer&amp;member_id={$member['member_id']}&amp;auth_key={$this->member->form_hash}' onclick="return ipb.global.toggleFlagSpammer({$member['member_id']}, true)">{parse replacement="spammer_off"} {$this->lang->words['spm_off']}</a></li>
											</if>
										</if>
										<if test="dnameHistory:|:$this->memberData['member_id'] && $this->memberData['g_mem_info'] && $this->settings['auth_allow_dnames']">
											<li id='dname_history'><a href='{parse url="app=members&amp;module=profile&amp;section=dname&amp;id={$member['member_id']}" base="public"}' title='{$this->lang->words['view_dname_history']}'>{parse replacement="display_name"} {$this->lang->words['display_name_history']}</a></li>
										</if>
								
										<if test="supModCustomizationDisable:|:($member['member_id'] != $this->memberData['member_id'] AND $this->memberData['g_is_supmod'] ) AND $member['customization']['type']">
											<li><strong><a href='{parse url="showuser={$member['member_id']}&amp;secure_key={$this->member->form_hash}&amp;removeCustomization=1" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}'><img src='{$this->settings['img_url']}/delete.png' alt='-' /> {$this->lang->words['cust_remove']}</a></strong></li>
											<li><strong><a href='{parse url="showuser={$member['member_id']}&amp;secure_key={$this->member->form_hash}&amp;removeCustomization=1&amp;disableCustomization=1" seotitle="{$member['members_seo_name']}" template="showuser" base="public"}'><img src='{$this->settings['img_url']}/delete.png' alt='-' /> {$this->lang->words['cust_disable']}</a></strong></li>
										</if>
									</ul>
								</div>
							</if>
							
							<if test="$member['pp_setting_count_friends'] and $this->settings['friends_enabled']">
								<div class='general_box clearfix' id='friends_overview'>
									<h3>{$this->lang->words['m_title_friends']}</h3>
									<div class='ipsPad'>
										<if test="hasFriends:|:count($friends) AND is_array($friends)">
											<foreach loop="friendsLoop:$friends as $friend">
												<a href='{parse url="showuser={$friend['member_id']}" base="public" template="showuser" seotitle="{$friend['members_seo_name']}"}' class='ipsUserPhotoLink'>
													<img src='{$friend['pp_mini_photo']}' class='ipsUserPhoto ipsUserPhoto_mini' data-tooltip='{$friend['members_display_name']}' />
												</a>
											</foreach>
										<else />
											<p class='desc'>
												{$member['members_display_name']} {$this->lang->words['no_friends_yet']}
											</p>
										</if>
									</div>
								</div>
							</if>
							
							<if test="latest_visitors:|:$member['pp_setting_count_visitors']">
								<div class='general_box clearfix'>
									<h3>{$this->lang->words['latest_visitors']}</h3>
									<if test="has_visitors:|:is_array( $visitors ) && count( $visitors )">
										<ul class='ipsList_withminiphoto ipsPad'>
											<foreach loop="latest_visitors_loop:$visitors as $visitor">
											<li class='clearfix'>
												<if test="visitorismember:|:$visitor['member_id']">
													<a href='{parse url="showuser={$visitor['member_id']}" seotitle="{$visitor['members_seo_name']}" template="showuser" base="public"}' title='{$this->lang->words['view_profile']}' class='ipsUserPhotoLink left'><img src='{$visitor['pp_mini_photo']}' alt='{$this->lang->words['photo']}' class='ipsUserPhoto ipsUserPhoto_mini' /></a>
												<else />
													<img src='{$visitor['pp_mini_photo']}' alt='{$this->lang->words['photo']}' class='ipsUserPhoto ipsUserPhoto_mini left' />
												</if>
												<div class='list_content'>
													{parse template="userHoverCard" group="global" params="$visitor"}
													<br />
													<span class='desc lighter'>{$visitor['_visited_date']}</span>
												</div>
											</li>
											</foreach>
										</ul>
									<else />
										<p class='ipsPad desc'>{$this->lang->words['no_latest_visitors']}</p>
									</if>
								</div>
							</if>
						</div>
					</div>
					
					<if test="$default_tab != 'core:info'">
					<div id='pane_{$default_tab}'>
						{$default_tab_content}
					</div>
					</if>
				</div>
				
			</div>
		</div>
		
	</div>
</div>
<if test="thisIsNotUs:|:($this->memberData['member_id'] && $member['member_id'] != $this->memberData['member_id'])">
	<br />
	<ul class='topic_buttons'>
		<li class='non_button clearfix'><a href='{parse url="app=core&amp;module=reports&amp;section=reports&amp;rcom=profiles&amp;member_id={$member['member_id']}" base="public"}'>{$this->lang->words['report_member']}</a></li>
	</ul>
</if>
<script type='text/javascript'>
	$("profile_content").setStyle( { minHeight: $('profile_tabs').measure('margin-box-height') + 138 + "px" } );
</script>

<!-- ******************************************************************************************* -->
{parse template="include_highlighter" group="global" params=""}]]></template_content>
      <template_name>profileModern</template_name>
      <template_data><![CDATA[$tabs=array(), $member=array(), $visitors=array(), $default_tab='status', $default_tab_content='', $friends=array(), $status=array(), $warns=array(), $show_contact='']]></template_data>
      <template_removable>1</template_removable>
      <template_user_added>0</template_user_added>
      <template_user_edited>1</template_user_edited>
      <template_master_key/>
    </template>
  </templategroup>
</templates>

--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: core
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>style</css_group>
    <css_content><![CDATA[div.bookmarks
{
margin-top:-20px;
    clear: both !important;
}
div.bookmarks-expand
{
    height: 32px;
    overflow: hidden;
}

div.bookmarks ul.socials
{
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent none !important;
    border: 0 none !important;
    outline: 0 none !important;
}
div.bookmarks ul.socials li
{
    background-image: url({style_images_url}/sprite.png ) !important;
    background-repeat: no-repeat !important;
    display: inline !important;
    float: left !important;
    list-style-type: none !important;
    padding: 0 !important;
    height: 29px !important;
    width: 60px !important;
    cursor: pointer !important;
    margin: 3px 0 0 !important;
    background-color: transparent !important;
    border: 0 none !important;
    outline: 0 none !important;
    clear: none !important;
}
div.bookmarks ul.socials li:before, div.bookmarks ul.socials li:after, div.bookmarks ul.socials li a:before, div.bookmarks ul.socials li a:after
{
    content: '' !important;
}
div.bookmarks ul.socials a, div.bookmarks ul.socials a:hover
{
    display: block !important;
    width: 60px !important;
    height: 29px !important;
    text-indent: -9999px !important;
    background-color: transparent !important;
    text-decoration: none !important;
    border: 0 none !important;
    margin: 0 !important;
    padding: 0 !important;
}
div.bookmarks ul.socials a:hover, div.bookmarks ul.socials li:hover
{
    background-color: transparent !important;
    border: 0 none !important;
    outline: 0 none !important;
}
li.newsvine
{
    background-position: left bottom !important;
}
li.newsvine:hover
{
    background-position: left top !important;
}
li.linkedin
{
    background-position: -70px bottom !important;
}
li.linkedin:hover
{
    background-position: -70px top !important;
}
li.googlebookmarks
{
    background-position: -140px bottom !important;
}
li.googlebookmarks:hover
{
    background-position: -140px top !important;
}
li.googlereader
{
    background-position: -210px bottom !important;
}
li.googlereader:hover
{
    background-position: -210px top !important;
}
li.scriptstyle
{
    background-position: -280px bottom !important;
}
li.scriptstyle:hover
{
    background-position: -280px top !important;
}
li.mail
{
    background-position: -350px bottom !important;
}
li.mail:hover
{
    background-position: -350px top !important;
}
li.comfeed
{
    background-position: -420px bottom !important;
}
li.comfeed:hover
{
    background-position: -420px top !important;
}
li.twitter
{
    background-position: -490px bottom !important;
}
li.twitter:hover
{
    background-position: -490px top !important;
}
li.technorati
{
    background-position: -560px bottom !important;
}
li.technorati:hover
{
    background-position: -560px top !important;
}
li.stumbleupon
{
    background-position: -630px bottom !important;
}
li.stumbleupon:hover
{
    background-position: -630px top !important;
}
li.reddit
{
    background-position: -700px bottom !important;
}
li.reddit:hover
{
    background-position: -700px top !important;
}
li.myspace
{
    background-position: -770px bottom !important;
}
li.myspace:hover
{
    background-position: -770px top !important;
}
li.mixx
{
    background-position: -840px bottom !important;
}
li.mixx:hover
{
    background-position: -840px top !important;
}
li.diigo
{
    background-position: -910px bottom !important;
}
li.diigo:hover
{
    background-position: -910px top !important;
}
li.digg
{
    background-position: -980px bottom !important;
}
li.digg:hover
{
    background-position: -980px top !important;
}
li.designfloat
{
    background-position: -1050px bottom !important;
}
li.designfloat:hover
{
    background-position: -1050px top !important;
}
li.yahoobuzz
{
    background-position: -1120px bottom !important;
}
li.yahoobuzz:hover
{
    background-position: -1120px top !important;
}
li.delicious
{
    background-position: -1190px bottom !important;
}
li.delicious:hover
{
    background-position: -1190px top !important;
}
li.blinklist
{
    background-position: -1260px bottom !important;
}
li.blinklist:hover
{
    background-position: -1260px top !important;
}
li.facebook
{
    background-position: -1330px bottom !important;
}
li.facebook:hover
{
    background-position: -1330px top !important;
}
li.misterwong
{
    background-position: -1400px bottom !important;
}
li.misterwong:hover
{
    background-position: -1400px top !important;
}
li.izeby
{
    background-position: -1470px bottom !important;
}
li.izeby:hover
{
    background-position: -1470px top !important;
}
li.twittley
{
    background-position: -1540px bottom !important;
}
li.twittley:hover
{
    background-position: -1540px top !important;
}
li.tipd
{
    background-position: -1610px bottom !important;
}
li.tipd:hover
{
    background-position: -1610px top !important;
}
li.pfbuzz
{
    background-position: -1680px bottom !important;
}
li.pfbuzz:hover
{
    background-position: -1680px top !important;
}
li.friendfeed
{
    background-position: -1750px bottom !important;
}
li.friendfeed:hover
{
    background-position: -1750px top !important;
}
li.blogmarks
{
    background-position: -1820px bottom !important;
}
li.blogmarks:hover
{
    background-position: -1820px top !important;
}
li.fwisp
{
    background-position: -1890px bottom !important;
}
li.fwisp:hover
{
    background-position: -1890px top !important;
}
li.yahoomail
{
    background-position: -1960px bottom !important;
}
li.yahoomail:hover
{
    background-position: -1960px top !important;
}
li.bobrdobr
{
    background-position: -2030px bottom !important;
}
li.bobrdobr:hover
{
    background-position: -2030px top !important;
}
li.memoryru
{
    background-position: -2100px bottom !important;
}
li.memoryru:hover
{
    background-position: -2100px top !important;
}
li.bookmark_100zakladok
{
    background-position: -2170px bottom !important;
}
li.bookmark_100zakladok:hover
{
    background-position: -2170px top !important;
}
li.yandex
{
    background-position: -2240px bottom !important;
}
li.yandex:hover
{
    background-position: -2240px top !important;
}
li.moemesto
{
    background-position: -2310px bottom !important;
}
li.moemesto:hover
{
    background-position: -2310px top !important;
}
li.marrows
{
    background-position: -2380px bottom !important;
}
li.marrows:hover
{
    background-position: -2380px top !important;
}
li.identica
{
    background-position: -2450px bottom !important;
}
li.identica:hover
{
    background-position: -2450px top !important;
}
li.hackernews
{
    background-position: -2520px bottom !important;
}
li.hackernews:hover
{
    background-position: -2520px top !important;
}
li.ning
{
    background-position: -2590px bottom !important;
}
li.ning:hover
{
    background-position: -2590px top !important;
}
li.designbump
{
    background-position: -2660px bottom !important;
}
li.designbump:hover
{
    background-position: -2660px top !important;
}
li.printfriendly
{
    background-position: -2730px bottom !important;
}
li.printfriendly:hover
{
    background-position: -2730px top !important;
}
li.fleck
{
    background-position: -2800px bottom !important;
}
li.fleck:hover
{
    background-position: -2800px top !important;
}
li.netvibes
{
    background-position: -2870px bottom !important;
}
li.netvibes:hover
{
    background-position: -2870px top !important;
}
li.netvouz
{
    background-position: -2940px bottom !important;
}
li.netvouz:hover
{
    background-position: -2940px top !important;
}
li.nujij
{
    background-position: -3010px bottom !important;
}
li.nujij:hover
{
    background-position: -3010px top !important;
}
li.globalgrind
{
    background-position: -3080px bottom !important;
}
li.globalgrind:hover
{
    background-position: -3080px top !important;
}
li.wikio
{
    background-position: -3150px bottom !important;
}
li.wikio:hover
{
    background-position: -3150px top !important;
}
li.xerpi
{
    background-position: -3220px bottom !important;
}
li.xerpi:hover
{
    background-position: -3220px top !important;
}
li.sphinn
{
    background-position: -3290px bottom !important;
}
li.sphinn:hover
{
    background-position: -3290px top !important;
}
li.hotmail
{
    background-position: -3360px bottom !important;
}
li.hotmail:hover
{
    background-position: -3360px top !important;
}
li.posterous
{
    background-position: -3430px bottom !important;
}
li.posterous:hover
{
    background-position: -3430px top !important;
}
li.techmeme
{
    background-position: -3500px bottom !important;
}
li.techmeme:hover
{
    background-position: -3500px top !important;
}
li.ekudos
{
    background-position: -3570px bottom !important;
}
li.ekudos:hover
{
    background-position: -3570px top !important;
}
li.pingfm
{
    background-position: -3640px bottom !important;
}
li.pingfm:hover
{
    background-position: -3640px top !important;
}
li.tomuse
{
    background-position: -3710px bottom !important;
}
li.tomuse:hover
{
    background-position: -3710px top !important;
}
li.webblend
{
    background-position: -3780px bottom !important;
}
li.webblend:hover
{
    background-position: -3780px top !important;
}
li.wykop
{
    background-position: -3850px bottom !important;
}
li.wykop:hover
{
    background-position: -3850px top !important;
}
li.blogengage
{
    background-position: -3920px bottom !important;
}
li.blogengage:hover
{
    background-position: -3920px top !important;
}
li.hyves
{
    background-position: -3990px bottom !important;
}
li.hyves:hover
{
    background-position: -3990px top !important;
}
li.pusha
{
    background-position: -4060px bottom !important;
}
li.pusha:hover
{
    background-position: -4060px top !important;
}
li.hatena
{
    background-position: -4130px bottom !important;
}
li.hatena:hover
{
    background-position: -4130px top !important;
}
li.mylinkvault
{
    background-position: -4200px bottom !important;
}
li.mylinkvault:hover
{
    background-position: -4200px top !important;
}
li.slashdot
{
    background-position: -4270px bottom !important;
}
li.slashdot:hover
{
    background-position: -4270px top !important;
}
li.squidoo
{
    background-position: -4340px bottom !important;
}
li.squidoo:hover
{
    background-position: -4340px top !important;
}
li.propeller
{
    background-position: -4410px bottom !important;
}
li.propeller:hover
{
    background-position: -4410px top !important;
}
li.faqpal
{
    background-position: -4480px bottom !important;
}
li.faqpal:hover
{
    background-position: -4480px top !important;
}
li.evernote
{
    background-position: -4550px bottom !important;
}
li.evernote:hover
{
    background-position: -4550px top !important;
}
li.meneame
{
    background-position: -4620px bottom !important;
}
li.meneame:hover
{
    background-position: -4620px top !important;
}
li.bitacoras
{
    background-position: -4690px bottom !important;
}
li.bitacoras:hover
{
    background-position: -4690px top !important;
}
li.jumptags
{
    background-position: -4760px bottom !important;
}
li.jumptags:hover
{
    background-position: -4760px top !important;
}
li.bebo
{
    background-position: -4830px bottom !important;
}
li.bebo:hover
{
    background-position: -4830px top !important;
}
li.n4g
{
    background-position: -4900px bottom !important;
}
li.n4g:hover
{
    background-position: -4900px top !important;
}
li.strands
{
    background-position: -4970px bottom !important;
}
li.strands:hover
{
    background-position: -4970px top !important;
}
li.orkut
{
    background-position: -5040px bottom !important;
}
li.orkut:hover
{
    background-position: -5040px top !important;
}
li.tumblr
{
    background-position: -5110px bottom !important;
}
li.tumblr:hover
{
    background-position: -5110px top !important;
}
li.stumpedia
{
    background-position: -5180px bottom !important;
}
li.stumpedia:hover
{
    background-position: -5180px top !important;
}
li.current
{
    background-position: -5250px bottom !important;
}
li.current:hover
{
    background-position: -5250px top !important;
}
li.blogger
{
    background-position: -5320px bottom !important;
}
li.blogger:hover
{
    background-position: -5320px top !important;
}
li.plurk
{
    background-position: -5390px bottom !important;
}
li.plurk:hover
{
    background-position: -5390px top !important;
}
li.virb
{
    background-position: -5460px bottom !important;
}
li.virb:hover
{
    background-position: -5460px top !important;
}
li.dzone
{
    background-position: -5530px bottom !important;
}
li.dzone:hover
{
    background-position: -5530px top !important;
}
li.kaevur
{
    background-position: -5600px bottom !important;
}
li.kaevur:hover
{
    background-position: -5600px top !important;
}
li.box
{
    background-position: -5670px bottom !important;
}
li.box:hover
{
    background-position: -5670px top !important;
}
li.oknotizie
{
    background-position: -5740px bottom !important;
}
li.oknotizie:hover
{
    background-position: -5740px top !important;
}
li.bonzobox
{
    background-position: -5810px bottom !important;
}
li.bonzobox:hover
{
    background-position: -5810px top !important;
}
li.plaxo
{
    background-position: -5880px bottom !important;
}
li.plaxo:hover
{
    background-position: -5880px top !important;
}
li.springpad
{
    background-position: -5950px bottom !important;
}
li.springpad:hover
{
    background-position: -5950px top !important;
}
li.zabox
{
    background-position: -6020px bottom !important;
}
li.zabox:hover
{
    background-position: -6020px top !important;
}
li.viadeo
{
    background-position: -6090px bottom !important;
}
li.viadeo:hover
{
    background-position: -6090px top !important;
}
li.googlebuzz
{
    background-position: -6160px bottom !important;
}
li.googlebuzz:hover
{
    background-position: -6160px top !important;
}
li.gmail
{
    background-position: -6230px bottom !important;
}
li.gmail:hover
{
    background-position: -6230px top !important;
}
li.bzzster
{
    background-position: -6300px bottom !important;
}
li.bzzster:hover
{
    background-position: -6300px top !important;
}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>grid</css_group>
    <css_content><![CDATA[.grid {
overflow: hidden;
margin: 0;
width: 100%;
max-width: 1920px;
list-style: none;
text-align: center;
}
figure.effect-sadie {
-webkit-transition: background 0.35s, -webkit-transform 0.35s;
transition: background 0.35s, transform 0.35s;
}
.grid figure {
position: relative;
z-index: 1;
display: inline-block;
overflow: hidden;
margin: 0 -0.135em 0.600em -0.135em;
background: #3047A3;
text-align: center;
cursor: pointer;
}
figure.effect-sadie img {
-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
transition: opacity 0.35s, transform 0.35s;
}
.grid figure img {
position: relative;
display: block;
min-height: 100%;
opacity: 0.8;
}
.grid figure figcaption, .grid figure a {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
.grid figure figcaption {
color: #fff;
text-transform: uppercase;
font-size: 1.25em;
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
}
.grid figure a {
z-index: 1000;
text-indent: 200%;
white-space: nowrap;
font-size: 0;
opacity: 0;
}
figure a {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
figure.effect-sadie:hover figcaption::before, figure.effect-sadie:hover p {
opacity: 1;
-webkit-transform: translate3d(0,0,0);
transform: translate3d(0,0,0);
}
figure.effect-sadie p {
position: absolute;
bottom: 0;
left: 0;
padding: 0 0 6px 0;
width: 100%;
opacity: 0;
-webkit-transform: translate3d(0,10px,0);
transform: translate3d(0,10px,0);
}
figure.effect-sadie figcaption::before, figure.effect-sadie p {
-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
transition: opacity 0.35s, transform 0.35s;
}
figure.effect-sadie:hover h2 {
color: #fff;
-webkit-transform: translate3d(0,-70%,0) translate3d(0,-70px,0);
transform: translate3d(0,-70%,0) translate3d(0,-70px,0);
}
figure.effect-sadie h2 {
position: absolute;
top: 82%;
left: 0;
width: 100%;
color: #fff;
-webkit-transition: -webkit-transform 0.35s, color 0.35s;
transition: transform 0.35s, color 0.35s;
-webkit-transform: translate3d(0,-50%,0);
transform: translate3d(0,-50%,0);
text-shadow: 1px 1px 0px rgba(0,0,0,.2);
}
.grid figure h2, .grid figure p {
margin: 0;
}
.grid figure h2 {
font-weight: 300;
}
h1, h2, h3, h4, h5, h6 {
font-size: 100%;
font-weight: normal;
}
figure.effect-sadie figcaption::before, figure.effect-sadie p {
-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
transition: opacity 0.35s, transform 0.35s;
}
figure.effect-sadie:hover figcaption::before, figure.effect-sadie:hover p {
opacity: 1;
-webkit-transform: translate3d(0,0,0);
transform: translate3d(0,0,0);
}
figure.effect-sadie figcaption::before {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: -webkit-linear-gradient(top, rgba(72,76,97,0) 0%, rgba(72,76,97,0.8) 75%);
background: linear-gradient(to bottom, rgba(72,76,97,0) 0%, rgba(72,76,97,0.8) 75%);
content: '';
opacity: 0;
-webkit-transform: translate3d(0,50%,0);
transform: translate3d(0,50%,0);
}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>xyz-container</css_group>
    <css_content><![CDATA[.xyz-container {
position: absolute;
top: 60px;
left: 40px;
margin: auto;
width: 50px;
height: 50px;
-webkit-perspective-origin: 150px -50px;
-webkit-perspective: 200px;
}
.plane {
  position: absolute;
  top: 0;
  left: 0;
  height: 50px;
  width: 50px;
  -webkit-transition: 1s;
}
.plane:before {
  content: '';
  position: absolute;
  width: 1px;
  height: 50px;
  top: 0;
  left: 25px;
  background-color: rgba(255,255,255,0.5);
}
.x {
  background-color: rgba(0,0,255,0.5);
}
.xyz-container:hover .x {
  -webkit-transform: rotateX(90deg);
}
.y {
  background-color: rgba(255,0,0,0.5);
}
.xyz-container:hover .y {
  -webkit-transform: rotateY(90deg);
}
.z {
  background-color: rgba(0,255,0,0.5);
}
.xyz-container:hover .z {
  -webkit-transform: rotateZ(90deg);
}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>social_media</css_group>
    <css_content/>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>case</css_group>
    <css_content><![CDATA[.case {
  margin:0px;
  width: 100%;
  position: absolute;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
}
@media screen and (max-width: 35em) {
  .case {
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column;
  }
}
.case .img-wrap, .case figcaption {
  width: 100%;
}

@media screen and (max-width: 35em) {
  .case .img-wrap, .case figcaption {
    width: 100%;
  }
}
@media screen and (max-width: 35em) {
  .case figcaption {
    padding-top: 1rem;
    padding-left: 0;
  }
}

.case figcaption .title:after {
  content: '';
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 1px;
  background-color: #2e2e31;
  background-image: -webkit-linear-gradient(0deg, #2e2e31, #d5d5d7), -webkit-linear-gradient(0deg, #d5d5d7, #2e2e31);
  background-image: linear-gradient(90deg, #2e2e31, #d5d5d7), linear-gradient(90deg, #d5d5d7, #2e2e31);
  background-size: 15% 100%;
  background-position: -30% 0, 130% 0;
  background-repeat: no-repeat;
  box-shadow: 1px 1px 1px #4f5055;
  -webkit-animation: scan 4s infinite;
          animation: scan 4s infinite;
}

@-webkit-keyframes scan {
  0% {
    background-position: -20% 0, 120% 0;
  }
  50% {
    background-position: 120% 0, 120% 0;
  }
  100% {
    background-position: 120% 0, -20% 0;
  }
}
@keyframes scan {
  0% {
    background-position: -20% 0, 120% 0;
  }
  50% {
    background-position: 120% 0, 120% 0;
  }
  100% {
    background-position: 120% 0, -20% 0;
  }
}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>wa_userinfo_bg</css_group>
    <css_content><![CDATA[.wa_userinfo_bg{
height: 50px;
background: #fff !important;
background-size: 100% 100% !important;
border-radius: 2px 2px 0 0;
}

.pm_button img{
width: 20px;
}
.wa_userinfo {
	background: #Fff;
	margin:3px 0 0 3px;
	border-radius: 2px;
	box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.2)
 }

.wa_userinfo_b1 {text-align: center;margin-top:-40px}

	.wa_userinfo_b1 img {
		height: 80px;
		border-radius: 800px;
		box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.2);
		border: 2px
		solid #fff
	 }

.wa_userinfo_b2 {padding-top: 10px}

	.wa_userinfo_b2
span {color: #3e3e3e;font-size:18px}

.wa_userinfo_b3 {padding-top: 5px}

	.wa_userinfo_b3
span {color: #b0b4b7;font-size:11px}

.wa_userinfo_b4 {
	background: #E8ECEE url("{style_images_url}/triangles.png");
	overflow: hidden;
	padding: 7px;
	margin-top: 5px
 }

.wa_userinfo_b4_1 {width: 50%}

.wa_userinfo_b4_m {color: #000}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1449427621</css_updated>
    <css_group>ipb_styles</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services 	*/
/************************************************************************/
/* ipb_styles.css														*/
/************************************************************************/

/************************************************************************/
/* RESET (Thanks to YUI) */

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { margin:0; padding:0; } 
table {	border-collapse:collapse; border-spacing:0; }
fieldset,img { border:0; }
address,caption,cite,code,dfn,th,var { font-style:normal; font-weight:normal; }
ol,ul { list-style:none; }
caption,th { text-align:left; }
h1,h2,h3,h4,h5,h6 { font-size:100%;	font-weight:normal; }
q:before,q:after { content:''; }
abbr,acronym { border:0; }
hr { display: none; }
address{ display: inline; }

/************************************************************************/
/* CORE ELEMENT STYLES */

html, body { /* Safari has trouble with bgcolor on body. Apply to html tag too. */
	background: #fff url({style_images_url}/bag.png) repeat;
	color: #5a5a5a;
}

body {
	font: normal 13px helvetica, arial, sans-serif;
	position: relative;
}

input, select {
	font: normal 13px helvetica, arial, sans-serif;
}

h3, strong { font-weight: bold; }
em { font-style: italic; }
img, .input_check, .input_radio { vertical-align: middle; }
legend { display: none; }
table { width: 100%; }
td { padding: 3px; }


a {
	color: #404F68;
	text-decoration: none;
}

	a:hover { color: #5D6C85; }

	
/************************************************************************/
/* LISTS */

.ipsList_inline > li {
	display: inline-block;
	margin: 0 3px;
}
	.ipsList_inline > li:first-child { margin-left: 0; }
	.ipsList_inline > li:last-child { margin-right: 0; }
	.ipsList_inline.ipsList_reset > li:first-child { margin-left: 3px; }
	.ipsList_inline.ipsList_reset > li:last-child { margin-right: 3px; }
	.ipsList_inline.ipsList_nowrap { white-space: nowrap; }
	
.ipsList_withminiphoto > li { margin-bottom: 8px; }
.ipsList_withmediumphoto > li .list_content { margin-left: 60px; }
.ipsList_withminiphoto > li .list_content { margin-left: 40px; }
.ipsList_withtinyphoto > li .list_content { margin-left: 30px; }
.list_content { word-wrap: break-word; }

.ipsList_data li { margin-bottom: 6px; line-height: 1.3; }
.ipsList_data .row_data { display: inline-block; word-wrap: break-word; max-width: 100%; }
.ipsList_data .row_title, .ipsList_data .ft {
	display: inline-block;
	float: left;
	width: 120px;
	font-weight: bold;
	text-align: right;
	padding-right: 10px;
}

.ipsList_data.ipsList_data_thin .row_title, .ipsList_data.ipsList_data_thin .ft {
	width: 80px;
}

/************************************************************************/
/* TYPOGRAPHY */

.ipsType_pagetitle, .ipsType_subtitle {
	font: 300 26px/1.3 Helvetica, Arial, sans-serif;
	color: #323232;
}
.ipsType_subtitle { font-size: 18px; }
.ipsType_sectiontitle { 
	font-size: 16px;
	font-weight: normal;
	color: #595959;
	padding: 5px 0;
	border-bottom: 1px solid #ececec;
}

.ipsType_pagedesc {
	color: #7f7f7f;
	line-height: 1.5;
}

.ipsType_pagedesc a { text-decoration: underline; }

.ipsType_textblock { line-height: 1.5; color: #282828; }

.ipsType_small { font-size: 12px; }
.ipsType_smaller, .ipsType_smaller a { font-size: 11px !important; }
.ipsType_smallest, .ipsType_smallest a { font-size: 10px !important; }

.ipsReset { margin: 0px !important; padding: 0px !important; }

/************************************************************************/
/* LAYOUT */
#content, .main_width {
	margin: 0 auto;
   	max-width: 1000px;
   	min-width: 980px;
}

#branding, #header_bar { min-width: 1000px; }


#content {
	background: #fff;
	padding: 10px 10px;
	line-height: 120%;
	-webkit-box-shadow: 0 5px 9px rgba(0,0,0,0.1);
	-moz-box-shadow: 0 5px 9px rgba(0,0,0,0.1);
	box-shadow: 0 5px 9px rgba(0,0,0,0.1);
}

/************************************************************************/
/* COLORS */


.row1, .post_block.row1 {	background-color: #fff;  }


.row2, .post_block.row2 { 	background-color: #f1f6f9; }



.unread 				{	background-color: #f7fbfc; }


.unread .altrow, .unread.altrow { background-color: #E2E9F0; }

/* primarily used for topic preview header */
.highlighted, .highlighted .altrow { background-color: #d6e4f0; }


.ipsBox { background: #EBEDEF; }
	
	.ipsBox_notice, .ipsBox_highlight {
		background: #f4fcff;
		border-bottom: 1px solid #cae9f5;
	}

/* mini badges */
a.ipsBadge:hover { color: #fff; }

.ipsBadge_green { background: #9ACD32; }
.ipsBadge_purple { background: #af286d; }
.ipsBadge_grey { background: #5b5b5b; }
.ipsBadge_lightgrey { background: #b3b3b3; }
.ipsBadge_orange { background: #ED7710; }
.ipsBadge_red {	background: #bf1d00; }


.bar {
	background: #D1D6D9;
	padding: 8px 10px;
}
	
	.bar.altbar {
		background: #C6CBCE;
		color: #494F59;
	}


.header {
	background: #C6CBCE;
	color: #494F59;
}

	
	body .ipb_table .header a,
	body .topic_options a {
		color: #494F59;
	}

.topicinfopanel, .bestanswertopic {
    background:#EFF1F3;
    border: 1px solid #DFE1E3;
    border-radius: 5px;
    padding: 7px;
}

.bestanswertopic {
    background:#EAF8E2;
    border: 1px solid #D6E4B7;
}

.post_body .post { color: #282828; }

.bbc_url, .bbc_email {
  text-decoration: underline;
}




/* Dates */
.date, .poll_question .votes {
	color: #747474;
	font-size: 11px;
}


.no_messages {
	background-color: #f6f8fa;
	color: #1c2837;
	padding: 15px 10px;
}

/* Tab bars */
.tab_bar {
	background-color: #C1CED9;
	color: #4a6784;
}

	.tab_bar li.active {
		background-color: #243f5c;
		color: #fff;
	}
	
	.tab_bar.no_title.mini {
		border-bottom: 8px solid #243f5c;
	}

/* Menu popups */
.ipbmenu_content, .ipb_autocomplete {
	background-color: #f7f9fb;
	border: 1px solid #d5dde5;
	-webkit-box-shadow: rgba(0, 0, 0, 0.3) 0px 6px 6px;
	box-shadow: rgba(0, 0, 0, 0.3) 0px 6px 6px;
}

	.ipbmenu_content li, .ipb_autocomplete li {
		border-bottom: 1px solid #d5dde5;
	}
	
		.ipb_autocomplete li.active {
			background: #d5dde5;
		}
		
	.ipbmenu_content a:hover { background: #d5dde5; }
		
/* Forms */

.input_submit {
	background: #3A4752;
	color: #fff;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	border-color: #3A4752;
}
.input_submit_for_shout {
	background: url(http://img.istvgames.uz/img/2015-12/06/n7fpgzuavk47u57uwblpnstin.png);
	color: #fff;
width:28px;
height:28px;
	
}

	.input_submit:hover { color: #fff; }
	
	
	.input_submit.alt {
		background: #EFF1F3;
		border-color: #DEE0E2;
		color: #464646;
		-moz-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
		-webkit-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
		box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
	}
	
		.input_submit.alt:hover { color: #464646; }

	.input_submit.delete {
		background: #ad2930;
		border-color: #C8A5A4 #962D29 #962D29 #C8A5A4;
		color: #fff;
		-moz-box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
		-webkit-box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
		box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
	}
	
		.input_submit.delete:hover { color: #fff; }

	
body#ipboard_body fieldset.submit,
body#ipboard_body p.submit {
	background-color: #D1D6D9;
}

/* Moderated styles */
.moderated, body .moderated td, .moderated td.altrow, .post_block.moderated .post_body,
body td.moderated, body td.moderated {
	background-color: #f8f1f3;
}
	
	.post_block.moderated .post_body { border-color: #e9d2d7; }	
	.moderated .row2 { background-color: #f0e0e3; }
	.moderated .post_controls { padding:6px 0; }
	.moderated, .moderated a { color: #6f3642; }
	
body#ipboard_body.redirector {
	background: #fff !important;
}

/************************************************************************/
/* HEADER */

#header_bar {
	background: #242C34;
	text-align: right;
	border-bottom:1px solid #131B23;
}
	
#admin_bar { font-size: 11px; line-height: 36px; }
#admin_bar li.active a { color: #fc6d35; }
#admin_bar a { color: #8a8a8a; }
	#admin_bar a:hover { color: #fff; }

#user_navigation { color: #9f9f9f; font-size: 11px; }
#user_navigation > ul { border-right: 1px solid #414E5A; border-left: 1px solid #131B23; }

#user_navigation li {
    float: left;
    margin: 0;
	border-left: 1px solid #414E5A;
    border-right: 1px solid #131B23;
    float: left;
    margin: 0;
}



#user_navigation a {
	color: #222222;
	float: left;
	height: 36px;
	line-height: 36px;
	outline: medium none;
	padding: 0 12px;
	font-size: 12px;
	color:#c7c7c7;
	border-right: 1px solid transparent;
	border-left: 1px solid transparent;
	position: relative;
}

#user_navigation a:hover { background-color: #576b7e; }

#user_navigation.logged_in li:last-child a:hover { background-color: rgba(200, 0, 0, 0.4); }

	#user_link_dd, .dropdownIndicator {
		display: inline-block;
		width: 9px; height: 5px;
		background: url({style_images_url}/header_dropdown.png ) no-repeat left;
	}

#user_link_menucontent #links li { 
	width: 50%;
	float: left;
	margin: 3px 0;
	text-shadow: 0px 1px 0 rgba(255,255,255,1);
	white-space: nowrap;
}


#user_link.menu_active {
	background: #fff;
	color: #323232;
}
	
	#user_link.menu_active #user_link_dd, .menu_active .dropdownIndicator, li.active .dropdownIndicator { background-position: right; }
		#community_app_menu .menu_active .dropdownIndicator { background-position: left; }
			#community_app_menu li.active .menu_active .dropdownIndicator { background-position: right; }
	#user_link_menucontent #statusForm { margin-bottom: 15px; }
	#user_link_menucontent #statusUpdate {	margin-bottom: 5px; }
	
#user_link_menucontent > div {
	margin-left: 15px;
	width: 265px;
	text-align: left;
}


#statusSubmitGlobal { margin-top: 3px; }

#user_link.menu_active, #notify_link.menu_active, #inbox_link.menu_active {
	background-position: bottom;
	background-color: #fff !important;
	border-right: 1px solid #C5C5C5;
	border-left: 1px solid #C5C5C5;
	position: relative;
    z-index: 10000;
	border-radius: 3px 3px 0 0;
}

#notify_link, #inbox_link {
    padding: 0 20px !important;
}

#usepic  a{
	padding: 0 3px;
}

#usepic  img{
	width:25px;
	height:25px;
	border: none;
}
	
#notify_link { background: url({style_images_url}/icon_notify.png ) no-repeat top; }
#inbox_link { background: url({style_images_url}/icon_inbox.png ) no-repeat top; }

#user_navigation.not_logged_in #register_link:hover { background-color: rgba(123,166,13,.7); color: #fff; }


#branding {
background: #242e37 url("{style_images_url}/triangles.png") repeat-x center top;
border-top: 1px solid #414e5a;
border-bottom: 2px solid #ff7518;
min-height: 90px;
}
	
	#logo { display: inline; }
	#logo img { margin: 5px 0 5px -10px; }


#primary_nav {
background: #3a4752 url(http://krsk-cs.ru/public/style_images/krskcsru/primary_nav_bg.png) repeat-x;
border-top: 1px solid #566674;
-webkit-border-radius: 4px 4px 0 0;
border-radius: 4px 4px 0 0;
font-size: 13px;
padding: 0 10px;
}

	#community_app_menu > li { margin: 0; position: relative; }

	#community_app_menu > li:first-child {
		margin-left: -10px;
	}
	
	#community_app_menu > li > a {
		color: #9baac3;
		display: block;
		padding: 9px 12px;
		text-shadow: 0px 1px 1px rgba(0,0,0,0.5);
		outline:none;
	}

		
		#community_app_menu > li > a:hover, #community_app_menu > li > a.menu_active { color: #D3E3F1; background: rgba(0, 0, 0, 0.1); }
	
	
	#community_app_menu > li.active > a {
		color: #B6C6D4;
		background: rgba(0, 0, 0, 0.15);
	}

#quickNavLaunch span, #nav_explore span, #nav_sodfontchooser span { 
	background: url({style_images_url}/icon_quicknav.png ) no-repeat center top;
	width: 13px;
	height: 13px;
	display: inline-block;
}

#nav_sodfontchooser span { 
	background-image: url({style_images_url}/icon_fontchooser.png );
}

#nav_explore span { 
	background-image: url({style_images_url}/icon_newcontent.png );
}

#quickNavLaunch:hover span, #nav_explore:hover span, #nav_sodfontchooser:hover span  { background-position: center bottom; }

#primary_nav #nav_explore a, #primary_nav #quickNavLaunch, #primary_nav #nav_sodfontchooser {
	padding: 10px 6px 8px;
}

#primary_nav #quickNavLaunch  { 
	border-radius: 0 5px 0 0;
}

#more_apps_menucontent, .submenu_container {
	background: #3d4855;
	font-size: 12px;
	border: 0;
	min-width: 140px;
}
	#more_apps_menucontent li, .submenu_container li { padding: 0; border: 0; float: none !important; min-width: 150px; }
	#more_apps_menucontent a, .submenu_container a { 
		display: block;
		padding: 8px 10px;
		color: #fff;
		text-shadow: 0px 1px 1px rgba(0,0,0,0.5);
	}

	#more_apps_menucontent li:hover, .submenu_container li:hover { background: rgba(0, 0, 0, 0.1) !important; }
	
	#more_apps_menucontent li:hover a, .submenu_container li:hover a { color: #D3E3F1; text-shadow: none; }

#community_app_menu .submenu_container,
#more_apps_menucontent.submenu_container {
	width: 260px;
}

	#community_app_menu .submenu_container li,
	#more_apps_menucontent.submenu_container li {
		width: 260px;
	}

.breadcrumb {
	font-size: 11px;
	background: #EFF1F3;
	border: 1px solid #D9DBDD;
	border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; -khtml-border-radius: 5px;
	overflow: hidden;
	zoom: 1;
	box-shadow: 0 0 3px rgba(109, 119, 237, 0.2);
	clear:  both;
}

	.breadcrumb ol li  {
		display: block;
		float: left;
		position: relative;
	}

	.breadcrumb ol li .arrow {
		border: 15px inset transparent;
		border-right: 1px none black;
		border-left-width: 8px;
		border-left-color: #D9DBDD;
		border-left-style: solid;
		display: block;
		position: absolute;
		right: -8px;
		top: 0px;
		z-index: 50;
		width: 0px;
		height: 0px;
	}

	.breadcrumb ol li .arrow span {
		border: 15px inset transparent;
		border-right: 1px none black;
		border-left-width: 8px;
		border-left-color: #F1F3F5;
		border-left-style: solid;
		display: block;
		position: absolute;
		left: -9px;
		top: -15px;
		z-index: 51;
		white-space: nowrap;
		overflow: hidden;
		text-indent: 9999px;
		width: 0px;
		height: 0px;
	}

	.breadcrumb ol li .navstep {
		text-decoration: none;
		background-color: #F1F3F5;
		padding: 0 10px 0 18px;
		margin-bottom: -2px;
		border-bottom: 1px solid #dfdfdf;
		outline: 0 none;
		-moz-outline-style: 0 none;
		display: block;
		line-height: 30px;
		color: #555;
	}
	
	.breadcrumb ol li:hover .navstep {
		background-color: #E8EAEC;
	}
	
	.breadcrumb ol li:hover .arrow span {
		border-left-color: #E8EAEC;
	}
	
	.breadcrumb ol li:first-child .navstep {
		padding-left: 10px;
		border-top-left-radius: 4px; -webkit-border-top-left-radius: 4px; -moz-border-radius-topleft: 4px; -khtml-border-top-left-radius: 4px;
		border-bottom-left-radius: 4px; -webkit-border-bottom-left-radius: 4px; -moz-border-radius-bottomleft: 4px; -khtml-border-bottom-left-radius: 4px;
	}

	.breadcrumb ol li:last-child .navstep {
		font-weight:bold;
	}
	
	.breadcrumb .rightlink {
		float: right;
		position: relative;
		right: 6px;
		top: 8px;
	}

	
.breadcrumb .sosialicons {
	top: 7px;
}
.sosialicons li {
    margin: 0 .1em;
}

.sosialicons a, .sosialicons a span {
	width:16px;
	height:16px;
	display:block;
	background: url({style_images_url}/sosials.png) no-repeat 0 bottom;
}

.sosialicons a span {
	background-position: 0 0;
	opacity: 0;
	-webkit-transition: 150ms ease-in;
	-moz-transition: 150ms ease-in;
	-ms-transition: 150ms ease-in;
	-o-transition: 150ms ease-in;
	transition: 150ms ease-in;
}

.sosialicons a:hover span {
	opacity: 1;
}

.sosialicons a.youtube {
	background-position: -32px bottom;
}

.sosialicons a.youtube span {
	background-position: -32px 0;
}

.sosialicons a.twitter {
	background-position: -16px bottom;
}

.sosialicons a.twitter span {
	background-position: -16px 0;
}

.sosialicons a.email {
	background-position: -48px bottom;
}

.sosialicons a.email span {
	background-position: -48px 0;
}


.ipsHeaderMenu {
	background: #ffffff; /* Old browsers */
	background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 70%, #ededed 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(70%,#f6f6f6), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
	padding: 10px;
	-moz-border-radius: 0 6px 6px 6px;
	-webkit-border-bottom-right-radius: 6px;
	-webkit-border-bottom-left-radius: 6px;
	-webkit-border-top-right-radius: 6px;
	border-radius: 0 6px 6px 6px;
	overflow: hidden;
	width: 340px;
	border: 1px solid #c5c5c5;
}

.ipsHeaderMenu.leftopen {
	-moz-border-radius: 6px 0 6px 6px;
	-webkit-border-top-right-radius: 0;
	-webkit-border-top-left-radius: 6px;
	border-radius: 6px 0 6px 6px;
}

	.ipsHeaderMenu .ipsType_sectiontitle { margin-bottom: 8px; }
	
	#user_notifications_link_menucontent.ipsHeaderMenu,
	#user_inbox_link_menucontent.ipsHeaderMenu {
		width: 300px;
	}
	
/************************************************************************/
/* SEARCH */	

#search {
	margin-top: 24px;
}

#main_search {
	font-size: 12px;
	border: 0;
	padding: 0;
	background: transparent;
	width: 160px;
	outline: 0;
	color: #979DA7;
}
	
#search_wrap {
position: relative;
background: #3a4752 url({style_images_url}/primary_nav_bg.png) repeat-x;
display: block;
border: 1px solid #4A5763;
padding: 0 26px 0 4px;
height: 26px;
line-height: 25px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-webkit-box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
-moz-box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
min-width: 210px;
}

#adv_search {
width: 16px;
height: 16px;
background: url({style_images_url}/advanced_search.png) no-repeat right 50%;
text-indent: -3000em;
display: inline-block;
margin: 6px 0 4px 4px;
}


#search .submit_input {
	background: url({style_images_url}/search_icon.png) no-repeat 50%;
	text-indent: -3000em;
	padding: 0; border: 0;
	display: block;
	width: 26px;
	height: 26px;
	position: absolute;
	right: 0; top: 0; bottom: 0;
}

#search_options {
	font-size: 10px;
	height: 14px;
	width:auto;
	line-height: 15px;
	margin:2px 2px 0 -1px;
	padding: 3px 4px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	background-color: #3a4752;
	border:1px solid #A4B1BD;
	float: left;
	border: 1px solid #4A5763;
	-webkit-box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
	-moz-box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
	box-shadow: 0px 2px 4px rgba(0,0,0,0.2) inset;
}

#search_options_menucontent { min-width: 100px; white-space: nowrap; }
	#search_options_menucontent input { margin-right: 10px; }
	#search_options_menucontent li { border-bottom: 0; position: relative; }
	#search_options_menucontent label { cursor: pointer; }
	
#search_options_menucontent input[type='radio'] {visibility: hidden;}
	
#search_wrap .searchicon {
    background: url("{style_images_url}/appicon/iconsprits.png") no-repeat -14px 0;
    height: 14px;
    position: absolute;
    top: 6px;
    width: 14px;
}
#search_wrap .s_forum {background-position: 0 0;}
#search_wrap .s_forums {background-position: -28px 0;}
#search_wrap .s_gallery {background-position: 0 -14px;}
#search_wrap .s_calendar {background-position: -14px -14px;}
#search_wrap .s_downloads {background-position: -28px -14px;}
#search_wrap .s_core {background-position: 0 -28px;}
#search_wrap .s_nexus {background-position: -14px -28px;}
#search_wrap .s_members {background-position: -28px -28px;}
#search_wrap .s_blog {background-position: 0 -42px;}
#search_wrap .s_topic {background-position: -14px -42px;}
#search_wrap .s_pages {background-position: -28px -42px;}

/************************************************************************/
/* FOOTER */	

#totop {
    margin-right:4px;
    outline:none;
}

#footer_utilities { 
	padding: 10px; 
	font-size: 11px;
	position: relative;
}
	
	#footer_utilities .ipsList_inline > li > a {  margin-right: 0px; padding: 4px 10px; display: inline-block; }
	#footer_utilities a.menu_active { 
		background: #F7F9FB;
		margin-top: -5px;
		padding: 3px 9px 4px !important;
		z-index: 20000;
		position: relative;
		display: inline-block;
		border: 1px solid #D5DDE5;
		border-bottom: 0;
	}
	
	#copyright {
		color: #848484;
		text-align: right;
		text-shadow: 0px 1px 0px #fff;
	}
	
		#copyright a { color: #848484; }

#ipsDebug_footer {
	width: 900px;
	margin: 8px auto 0px auto;
	text-align: center;
	color: #404040;
	text-shadow: 0px 1px 0px #fff;
	font-size: 11px;
}
	#ipsDebug_footer strong { margin-left: 20px; }
	#ipsDebug_footer a { color: #404040; }
	
#rss_menu {
	background-color: #fef3d7;
	border: 1px solid #ed7710;
}
	
	#rss_menu li { border-bottom: 1px solid #fce19b; }
	#rss_menu a {
		color: #ed7710;
		padding: 5px 8px;
	}

		#rss_menu a:hover {
			background-color: #ed7710;
			color: #fff;
		}

/************************************************************************/
/* GENERAL CONTENT */

.ipsUserPhoto {
	padding: 1px;
	border: 1px solid #d5d5d5;
	background: #fff;
	-webkit-box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
	-moz-box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
	box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
}
	
	.ipsUserPhotoLink:hover .ipsUserPhoto {
		border-color: #7d7d7d;
	}
  .ipsUserPhoto_variable { max-width: 155px; }
	.ipsUserPhoto_large { max-width: 90px; max-height: 90px; }
	.ipsUserPhoto_medium { width: 50px; height: 50px; }
	.ipsUserPhoto_mini { width: 30px; height: 30px; }
	.ipsUserPhoto_tiny { width: 20px; height: 20px;	}
	.ipsUserPhoto_icon { width: 16px; height: 16px;	}
	

.general_box {
	background: #fcfcfc;
	margin-bottom: 10px;
}

	
	.general_box h3 {
		font: normal 14px helvetica, arial, sans-serif;
		padding: 8px 10px;
		background: #DCE1E4;
		color: #494F59;
	}

.general_box .none {
	color: #bcbcbc;
}

.ipsBox, .ipsPad { padding: 9px; }
	.ipsPad_double { padding: 9px 19px; } /* 19px because it's still only 1px border to account for */
	.ipsBox_withphoto { margin-left: 65px; }

.ipsBox_container {
    background:#F6F8FA;
    border: 1px solid #DCE2EC;
}

	.ipsBox_container.moderated { 
		background: #f8f1f3;
		border: 1px solid #d6b0bb;
	}
	.ipsBox_notice {
		padding: 10px;
		line-height: 1.6;
		margin-bottom: 10px;
	}
	.ipsBox_container .ipsBox_notice {	margin: -10px -10px 10px -10px;	}
.ipsPad_half { padding: 4px !important; }
.ipsPad_left { padding-left: 9px; }
.ipsPad_top { padding-top: 9px; }
.ipsPad_top_slimmer { padding-top: 7px; }
.ipsPad_top_half { padding-top: 4px; }
.ipsPad_top_bottom { padding-top: 9px; padding-bottom: 9px; }
.ipsPad_top_bottom_half { padding-top: 4px; padding-bottom: 4px; }
.ipsMargin_top { margin-top: 9px; }

.ipsBlendLinks_target .ipsBlendLinks_here {
		opacity: 0.5;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
	}
	.ipsBlendLinks_target:hover .ipsBlendLinks_here { opacity: 1; }
	
.block_list > li {
	padding: 5px 10px;
	border-bottom: 1px solid #f2f2f2;
}

.ipsModMenu {
	width: 15px;
	height: 15px;
	display: inline-block;
	text-indent: -2000em;
	background: url({style_images_url}/moderation_cog.png ) no-repeat;
	margin-right: 5px;
	vertical-align: middle;
}

.ipsBadge {
max-height: 15px;
display: inline-block;
line-height: 15px;
padding: 2px 6px;
color: #fff;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
vertical-align: middle;
color: #fff;
font-family: "Lato",Helvetica,Arial,sans-serif;
font-size: 11px;
letter-spacing: .5px;
-webkit-box-shadow: inset rgba(0,0,0,0.2) 0px 1px 3px, rgba(255,255,255,0.7) 0px 1px 0px;
-moz-box-shadow: inset rgba(0,0,0,0.2) 0px 1px 3px, rgba(255,255,255,0.7) 0px 1px 0px;
box-shadow: inset rgba(0,0,0,0.2) 0px 1px 3px, rgba(255,255,255,0.7) 0px 1px 0px;
text-shadow: rgba(255,255,255,0.3) 0px 1px 0px;
color: #fff !important;
text-shadow: rgba(0,0,0,0.2) 0px -1px 0px;
padding: 3px 9px;
font-size: 10px;
}

	.ipsBadge.has_icon img {
		max-height: 7px;
		vertical-align: baseline;
	}
	
	#nav_app_ipchat .ipsBadge {	position: absolute;	}
	
#ajax_loading {
	background: rgba(0,0,0,.8);
	color: #fff;
	text-align: center;
	padding: 5px 0 8px;
	width: 8%;
	top: 0px;
	left: 46%;
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	border-radius: 0 0 5px 5px;
	z-index: 10000;
	position: fixed;
	-moz-box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
	-webkit-box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
	box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
}

#ipboard_body.redirector {
	width: 500px;
	margin: 150px auto 0 auto;
}

#ipboard_body.minimal { margin-top: 40px; }
	#ipboard_body.minimal #content {
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		padding: 20px 30px;
	}
	#ipboard_body.minimal h1 { font-size: 32px; }
	#ipboard_body.minimal .ipsType_pagedesc { font-size: 16px; }

.progress_bar {
	background-color: #fff;
	border: 1px solid #d5dde5;
}

	.progress_bar span {
		background: #243f5c url({style_images_url}/gradient_bg.png) repeat-x left 50%;
		color: #fff;
		font-size: 0em;
		font-weight: bold;
		text-align: center;
		text-indent: -2000em; /* Safari fix */
		height: 10px;
		display: block;
		overflow: hidden;
	}

	.progress_bar.limit span {
		background: #b82929 url({style_images_url}/progressbar_warning.png) repeat-x center;
	}

	.progress_bar span span {
		display: none;
	}

.progress_bar.user_warn {	
	margin: 0 auto;
	width: 80%;
}

	.progress_bar.user_warn span {
		height: 6px;
	}

.progress_bar.topic_poll {
	border: 1px solid #d5dde5;
	margin-top: 2px;
	width: 40%;
}

li.rating a {
	outline: 0;
}

.antispam_img { margin: 0 3px 5px 0; }
	
span.error {
	color: #ad2930;
	font-weight: bold;
	clear: both;
}

#recaptcha_widget_div { max-width: 350px; }
#recaptcha_table { border: 0 !important; }

.mediatag_wrapper {
	position: relative;
	padding-bottom: 56.25%;
	padding-top: 30px;
	height: 0;
	overflow: hidden;
}

.mediatag_wrapper iframe,  
.mediatag_wrapper object,  
.mediatag_wrapper embed {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

/************************************************************************/
/* GENERIC REPEATED STYLES */
/* Inline lists */
.tab_filters ul, .tab_filters li, fieldset.with_subhead span.desc, fieldset.with_subhead label,.user_controls li {
	display: inline;
}

/* Utility styles */
.right { float: right; }
.left { float: left; }
.hide { display: none; }
.short { text-align: center; }
.clear { clear: both; }
.clearfix:after { content: ".";display: block;height: 0;clear: both;visibility: hidden;}
.faded { opacity: 0.5 }
.clickable { cursor: pointer; }
.reset_cursor { cursor: default; }

/* Bullets */
.bullets ul, .bullets ol,
ul.bullets, ol.bullets {
	list-style: disc;
	margin-left: 30px;
	line-height: 150%;
	list-style-image: none;
}


.maintitle {
	background: #3a4752 url("{style_images_url}/triangles.png") repeat-x;
	border: 1px solid #414a53;
color: #AFB5BF;
padding: 9px 10px 8px;
font-size: 15px;
font-weight: 300;
-moz-border-radius: 2px;
-webkit-border-radius: 2px;
border-radius: 2px;
margin-bottom: 3px;
box-shadow: 0 1px 2px 0 #4D5760 inset;
text-shadow: 1px 1px 1px #333;
border-bottom: 2px solid #ff7518;
}

	.maintitle a {	color: #AFB5BF; }

		.collapsed .maintitle { opacity: 0.9; }
	
	.maintitle .toggle { 
		visibility: hidden;
		background: url({style_images_url}/cat_minimize.png) no-repeat;
		text-indent: -3000em;
		width: 20px; height: 20px;
		margin-top:-1px;
		display: block;
		outline: 0;
	}
		.maintitle:hover .toggle { visibility: visible; }
	
	.collapsed .toggle {
		background-image: url({style_images_url}/cat_maximize.png);
	}	
	
/* Rounded corners */
#user_navigation #new_msg_count, .poll_question h4,
.rounded {
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}


.desc, .desc.blend_links a, p.posted_info {
	font-size: 12px;
	color: #777777;
}


.desc.lighter, .desc.lighter.blend_links a {
	color: #a4a4a4;
}

/* Cancel */
.cancel {
	color: #ad2930;
	font-size: 0.9em;
	font-weight: bold;
}

/* Moderation */
em.moderated {
	font-size: 11px;
	font-style: normal;
	font-weight: bold;
}

/* Positive/Negative */
.positive {	color: #0F9447; }
.negative {	color: #c7172b; }

/* Search highlighting */
.searchlite
{
	background-color: yellow;
	color: red;
	font-size:14px;
}

/* Users posting */
.activeuserposting {
	font-style: italic;
}
	
/************************************************************************/
/* COLUMN WIDTHS FOR TABLES */
/* col_f = forums; col_c = categories; col_m = messenger; col_n = notifications */

.col_f_post { width: 250px !important; }
	.is_mod .col_f_post { width: 210px !important; }

	td.col_c_post { 
		padding-top: 10px !important;
		width: 250px;
	}

.col_f_icon {
	padding: 10px 0 0 0 !important;
	width: 24px !important;
	text-align: center;
	vertical-align: top;
}

.col_n_icon { 
	vertical-align: middle;
	width: 24px;
	padding: 0 !important;
}
	
.col_f_views, .col_m_replies {
	width: 100px !important;
	text-align: right;
	white-space: nowrap;
}

.col_f_mod, .col_m_mod, .col_n_mod { width: 40px; text-align: right; }
.col_f_preview { 
	width: 20px !important; 
	text-align: right;
}

.col_c_icon { padding: 10px 5px 10px 5px !important; width: 30px; vertical-align: middle; text-align: middle; }
.col_c_post .ipsUserPhoto { margin-top: 3px; }

.col_n_date { width: 250px; }
.col_m_photo, .col_n_photo { width: 30px; }
.col_m_mod { text-align: right; }
.col_r_icon { width: 3%; }
.col_f_topic, .col_m_subject { width: 49%; }
.col_f_starter, .col_r_total, .col_r_comments {	width: 10%; }
.col_m_date, .col_r_updated, .col_r_section { width: 18%; }
.col_c_stats { width: 15%; text-align: right; }
.col_c_forum { width: auto; }
.col_mod, .col_r_mod { width: 3%; }
.col_r_title { width: 26%; }

/*.col_c_forum, .col_c_stats, .col_c_icon, .col_c_post { vertical-align: top; }*/

/************************************************************************/
/* TABLE STYLES */

table.ipb_table {
	width: 100%;
	line-height: 1.3;
	border-collapse: collapse;
}
	
	
	table.ipb_table td {
		padding: 10px;
		border-bottom: 1px solid #DCE2EC;
		background:#F6F8FA;
	}
	
	table.ipb_table tr:last-child td {
		border-bottom: none;
	}
		
		table.ipb_table tr.unread h4 { font-weight: bold; }
		table.ipb_table tr.highlighted td { border-bottom: 0; }
	
	table.ipb_table th {
		font-size: 11px;
color: #fff;
font-weight: bold;
padding: 8px 6px;
background: #414a53;
	}
	
.last_post { margin-left: 45px; }

table.ipb_table h4,
table.ipb_table .topic_title {
	font-size: 14px;
	display: inline-block;
}

table.ipb_table  .unread .topic_title { font-weight: bold; }
table.ipb_table .ipsModMenu { visibility: hidden; }
table.ipb_table tr:hover .ipsModMenu, table.ipb_table tr .ipsModMenu.menu_active { visibility: visible; }

#announcements h4 { display: inline; }
#announcements td { border-bottom: 1px solid #fff; }

.forum_data {
	font-size: 11px;
	color: #5c5c5c;
	display: inline-block;
	white-space: nowrap;
	margin: 0px 0 0 8px;
}

.desc_more {
	background: url({style_images_url}/desc_more.png ) no-repeat top;
	display: inline-block;
	width: 13px; height: 13px;
	text-indent: -2000em;
}
	.desc_more:hover { background-position: bottom; }

.category_block .ipb_table h4 { font-size: 15px; word-wrap: break-word; }

.subfcontrl {
  font-size: 11px;
}
.subfcontrl .dropdownIndicator {
  background-position: right center;
}
.subfmenu {
  min-width: 110px !important;
  padding: 0;
}

table.ipb_table .subforums {
	margin: 2px 0 3px;
}

.subforums .subcircle {
  background: url({style_images_url}/submenu.png) no-repeat;
  width:10px;
  height:10px;
  display: inline-block;
  vertical-align: middle;
  margin-right: 2px;
}
.subforums .unread .subcircle {
    background-position: right;
}

	table.ipb_table .subforums li.unread { font-weight: bold; }

table.ipb_table .expander { 
	visibility: hidden;
	width: 16px;
	height: 16px;
	display: inline-block;
}
table.ipb_table tr:hover .expander { visibility: visible; opacity: 0.2; }
table.ipb_table td.col_f_preview { cursor: pointer; }
table.ipb_table tr td:hover .expander, .expander.open, .expander.loading { visibility: visible !important; opacity: 1; }
table.ipb_table .expander.closed { background: url({style_images_url}/icon_expand_close.png ) no-repeat top; }
table.ipb_table .expander.open { background: url({style_images_url}/icon_expand_close.png ) no-repeat bottom; }
table.ipb_table .expander.loading { background: url({style_images_url}/loading.gif ) no-repeat; }
table.ipb_table .preview td {
	padding: 20px 10px 20px 29px;
	z-index: 20000;
	border-top: 0;
}

	table.ipb_table .preview td > div {
		line-height: 1.4;
		position: relative;		
	}
	
	table.ipb_table .preview td {
		-webkit-box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		-moz-box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		border: 1px solid #D6E4F0;
	}

.preview_col {
	margin-left: 80px;
}

.preview_info {
	border-bottom: 1px solid #eaeaea;
	padding-bottom: 3px;
	margin: -3px 0 3px;
}

table.ipb_table .mini_pagination { opacity: 0.5; }
table.ipb_table tr:hover .mini_pagination { opacity: 1; }

/************************************************************************/
/* LAYOUT SYSTEM */

.ipsLayout.ipsLayout_withleft { padding-left: 210px; }
	.ipsBox.ipsLayout.ipsLayout_withleft { padding-left: 220px; }
.ipsLayout.ipsLayout_withright { padding-right: 210px; clear: left; }
	.ipsBox.ipsLayout.ipsLayout_withright { padding-right: 220px; }
	
/* Panes */
.ipsLayout_content, .ipsLayout .ipsLayout_left, .ipsLayout_right { position: relative; }
.ipsLayout_content { width: 100%; float: left; }
.ipsLayout .ipsLayout_left { width: 200px; margin-left: -210px; float: left; }
.ipsLayout .ipsLayout_right { width: 200px; margin-right: -210px; float: right; }

/* Wider sidebars */
.ipsLayout_largeleft.ipsLayout_withleft { padding-left: 280px; }
	.ipsBox.ipsLayout_largeleft.ipsLayout_withleft { padding-left: 290px; }
.ipsLayout_largeleft.ipsLayout .ipsLayout_left { width: 270px; margin-left: -280px; }
.ipsLayout_largeright.ipsLayout_withright { padding-right: 280px; }
	.ipsBox.ipsLayout_largeright.ipsLayout_withright { padding-right: 290px; }
.ipsLayout_largeright.ipsLayout .ipsLayout_right { width: 270px; margin-right: -280px; }

/* Narrow sidebars */
.ipsLayout_smallleft.ipsLayout_withleft { padding-left: 150px; }
	.ipsBox.ipsLayout_smallleft.ipsLayout_withleft { padding-left: 160px; }
.ipsLayout_smallleft.ipsLayout .ipsLayout_left { width: 140px; margin-left: -150px; }
.ipsLayout_smallright.ipsLayout_withright { padding-right: 150px; }
	.ipsBox.ipsLayout_smallright.ipsLayout_withright { padding-right: 160px; }
.ipsLayout_smallright.ipsLayout .ipsLayout_right { width: 140px; margin-right: -150px; }

/* Tiny sidebar */
.ipsLayout_tinyleft.ipsLayout_withleft { padding-left: 50px; }
	.ipsBox.ipsLayout_tinyleft.ipsLayout_withleft { padding-left: 60px; }
.ipsLayout_tinyleft.ipsLayout .ipsLayout_left { width: 40px; margin-left: -40px; }
.ipsLayout_tinyright.ipsLayout_withright { padding-right: 50px; }
	.ipsBox.ipsLayout_tinyright.ipsLayout_withright { padding-right: 60px; }
.ipsLayout_tinyright.ipsLayout .ipsLayout_right { width: 40px; margin-right: -40px; }

/* Big sidebar */
.ipsLayout_bigleft.ipsLayout_withleft { padding-left: 330px; }
	.ipsBox.ipsLayout_bigleft.ipsLayout_withleft { padding-left: 340px; }
.ipsLayout_bigleft.ipsLayout .ipsLayout_left { width: 320px; margin-left: -330px; }
.ipsLayout_bigright.ipsLayout_withright { padding-right: 330px; }
	.ipsBox.ipsLayout_bigright.ipsLayout_withright { padding-right: 340px; }
.ipsLayout_bigright.ipsLayout .ipsLayout_right { width: 320px; margin-right: -330px; }

/* Even Wider sidebars */
.ipsLayout_hugeleft.ipsLayout_withleft { padding-left: 380px; }
	.ipsBox.ipsLayout_hugeleft.ipsLayout_withleft { padding-left: 390px; }
.ipsLayout_hugeleft.ipsLayout .ipsLayout_left { width: 370px; margin-left: -380px; }
.ipsLayout_hugeright.ipsLayout_withright { padding-right: 380px; }
	.ipsBox.ipsLayout_hugeright.ipsLayout_withright { padding-right: 390px; }
.ipsLayout_hugeright.ipsLayout .ipsLayout_right { width: 370px; margin-right: -380px; }

/************************************************************************/
/* NEW FORMS */

.ipsField .ipsField_title { 
	font-weight: bold;
	font-size: 15px;
}

.ipsForm_required {
	color: #ab1f39;
	font-weight: bold;
}

.ipsForm_horizontal .ipsField_title {
	float: left;
	width: 185px;
	padding-right: 15px;
	text-align: right;
	line-height: 1.8;
}

.ipsForm_horizontal .ipsField { margin-bottom: 15px; }
.ipsForm_horizontal .ipsField_content, .ipsForm_horizontal .ipsField_submit { margin-left: 200px; }
.ipsForm_horizontal .ipsField_checkbox { margin: 0 0 5px 200px; }
.ipsForm_horizontal .ipsField_select .ipsField_title { line-height: 1.6; }

.ipsForm_vertical .ipsField { margin-bottom: 10px; }
.ipsForm_vertical .ipsField_content { margin-top: 3px; }

.ipsForm .ipsField_checkbox .ipsField_content { margin-left: 25px; }
.ipsForm .ipsField_checkbox input { float: left; margin-top: 3px; }

.ipsField_primary input { font-size: 18px; }

.ipsForm_submit {
	background: #e4e4e4;
	background: -moz-linear-gradient(top, #e4e4e4 0%, #cccccc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4e4e4), color-stop(100%,#cccccc));
	padding: 5px 10px;
	text-align: right;
	border-top: 1px solid #cccccc;
	margin-top: 25px;
}

.ipsForm_right { text-align: right; }
.ipsForm_left { text-align: left; }
.ipsForm_center { text-align: center; }

/************************************************************************/
/* SETTINGS SCREENS */
.ipsSettings_pagetitle { font-size: 20px; margin-bottom: 5px; }
.ipsSettings { padding: 0 0px; }
.ipsSettings_section {
	margin: 0 0 15px 0;
	border-top: 1px solid #eaeaea;
	padding: 15px 0 0 0;
}
	
	.ipsSettings_section > div { margin-left: 175px; }
	.ipsSettings_section > div ul li { margin-bottom: 10px; }
	.ipsSettings_section .desc { margin-top: 3px; }
	
.ipsSettings_sectiontitle {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #151515;
	width: 165px;
	padding-left: 10px;
	float: left;
}

.ipsSettings_fieldtitle { 
	min-width: 100px;
	margin-right: 10px;
	font-size: 14px;
	display: inline-block;
	vertical-align: top;
	padding-top: 3px;
}

/************************************************************************/
/* TOOLTIPS */

.ipsTooltip { padding: 5px; z-index: 25000;}
.ipsTooltip_inner {
	padding: 8px;
	background: #333333;
	border: 1px solid #333333;
	color: #fff;
	-webkit-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-size: 12px;
	text-align: center;
	max-width: 250px;
}
	.ipsTooltip_inner a { color: #fff; }
	.ipsTooltip_inner span { font-size: 11px; color: #d2d2d2 }
	.ipsTooltip.top 	{ background: url({style_images_url}/stems/tooltip_top.png) no-repeat bottom center; }
		.ipsTooltip.top_left 	{ background-position: bottom left; }
	.ipsTooltip.bottom	{ background: url({style_images_url}/stems/tooltip_bottom.png) no-repeat top center; }
	.ipsTooltip.left 	{ background: url({style_images_url}/stems/tooltip_left.png) no-repeat center right; }
	.ipsTooltip.right	{ background: url({style_images_url}/stems/tooltip_right.png) no-repeat center left; }
	
/************************************************************************/
/* AlertFlag */

.ipsHasNotifications {
padding: 0px 5px;
height: 15px;
line-height: 15px;
background: #C0392B;
color: #fff !important;
font-size: 8px;
text-align: center;
position: absolute;
top: 2px;
left: 20px;
border: 1px solid #E74C3C;
border-radius: 30px 30px 30px 0;
width: 6px;
opacity: 0;
-webkit-animation: pulsate 1s ease-out;
animation: pulsate 1s ease-out;
-webkit-animation-iteration-count: infinite;
animation-iteration-count: infinite;
}


@-webkit-keyframes pulsate {
    0% {
      -webkit-transform:scale(.1);
      transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
      -webkit-transform:scale(1.2);
      transform:scale(1.2);
      opacity:0;
    }
}

@keyframes pulsate {
    0% {
      -webkit-transform:scale(.1);
      transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
      -webkit-transform:scale(1.2);
      transform:scale(1.2);
      opacity:0;
    }
}

.ipsHasNotifications_blank { display: none; }
#chat-tab-count.ipsHasNotifications { left: auto; top: 0px; right: -1px; text-shadow: none !important; }

/************************************************************************/
/* SIDEBAR STYLE */

.ipsSideMenu { padding: 10px 0; }
.ipsSideMenu h4 { 
	margin: 0 10px 5px 25px;
	font-weight: bold;
	color: #383838;
}

.ipsSideMenu ul {
	border-top: 1px solid #EDF1F5;
	margin-bottom: 20px;
}

.ipsSideMenu ul li {
	font-size: 11px;
	border-bottom: 1px solid #EDF1F5;
}

.ipsSideMenu ul li a {
	padding: 5px 10px 5px 25px;
	display: block;
}


.ipsSideMenu ul li.active a {
	background: #af286d url({style_images_url}/icon_check_white.png ) no-repeat 6px 8px;
	color: #fff;
	font-weight: bold;
}

/***************************************************************************/
/* WIZARDS */
.ipsSteps {
	border-bottom: 1px solid #fff;
	background: #D1D6D9;
	overflow: hidden;
}	
	.ipsSteps ul li {
		float: left;
		padding: 11px 33px 11px 18px;
		color: #323232;
		background-image: url({style_images_url}/wizard_step_large.png );
		background-repeat: no-repeat;
		background-position: bottom right;
		position: relative;
		max-height: 53px;
	}
	
	.ipsSteps .ipsSteps_active {
		background-position: top right;
		color: #fff;
		text-shadow: 0px -1px 0 rgba(0,0,0,0.7);
	}
	
	.ipsSteps .ipsSteps_done { color: #aeaeae; }
	.ipsSteps_desc { font-size: 11px; }	
	.ipsSteps_arrow { display: none; }
	
	.ipsSteps_title {
		display: block;
		font-size: 14px;
	}
	
	.ipsSteps_active .ipsSteps_arrow {
		display: block;
		position: absolute;
		left: -23px;
		top: 0;
		width: 23px;
		height: 54px;
		background: url({style_images_url}/wizard_step_extra.png ) no-repeat;
	}
	
	.ipsSteps ul li:first-child .ipsSteps_arrow { display: none !important;	}

/************************************************************************/
/* VERTICAL TABS (profile etc.) */

.ipsVerticalTabbed { }

	.ipsVerticalTabbed_content {
		min-height: 400px;
	}
	
	.ipsVerticalTabbed_tabs > ul {
		width: 149px !important;
		margin-top: 10px;
		border-top: 1px solid #D5D7D9;
		border-left: 1px solid #D5D7D9;
	}
		
		.ipsVerticalTabbed_minitabs.ipsVerticalTabbed_tabs > ul { width: 40px !important; }
		
		
		.ipsVerticalTabbed_tabs li {
			background: #F1F3F5;
			color: #808080;
			border-bottom: 1px solid #D5D7D9;
			font-size: 13px;
		}
		
			
			.ipsVerticalTabbed_tabs li a {
				display: block;
				padding: 10px 8px;
				outline: 0;
				color: #8d8d8d;
				-webkit-transition: background-color 0.1s ease-in-out;
				-moz-transition: background-color 0.3s ease-in-out;
			}
			
				
				.ipsVerticalTabbed_tabs li a:hover {
					background: #F4F6F8;
					color: #808080;
				}
			
				
				.ipsVerticalTabbed_tabs li.active a {
					width: 135px;
					position: relative;
					z-index: 8000;
					border-right: 1px solid #F6F8FA;
					background: #F6F8FA;
					color: #353535;
					font-weight: bold;
				}
				
					.ipsVerticalTabbed_minitabs.ipsVerticalTabbed_tabs li.active a {
						width: 24px;
					}

/************************************************************************/
/* 'LIKE' FUNCTIONS */

.ipsLikeBar { font-size: 11px; clear: both; }
	
	.ipsLikeBar_info {
		line-height: 19px;
		background: #f4f4f4;
		padding: 0 10px;
		display: inline-block;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
	}
	
.ipsLikeButton {
	line-height: 17px;
	padding: 0 6px 0 24px;
	font-size: 11px;
	display: inline-block;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	color: #fff !important;
}
	.ipsLikeButton:hover { color: #fff !important; }
	
	.ipsLikeButton.ipsLikeButton_enabled {
		background: #9ca6b4 url({style_images_url}/like_button.png ) no-repeat top left;
		border: 1px solid #9ca6b4;
	}
	
	.ipsLikeButton.ipsLikeButton_disabled {
		background: #acacac url({style_images_url}/like_button.png ) no-repeat bottom left;
		border: 1px solid #acacac;
	}

/************************************************************************/
/* TAG LIST */

.ipsTag {
	display: inline-block;
	background: url({style_images_url}/tag_bg.png );
	height: 20px;
	line-height: 20px;
	padding: 0 7px 0 15px;
	margin: 5px 5px 0 0;
	font-size: 11px;
	color: #656565;
	text-shadow: 0 1px 0 rgba(255,255,255,1);
	-moz-border-radius: 0 3px 3px 0;
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
	border-radius: 0 3px 3px 0;
}

/************************************************************************/
/* TAG EDITOR STYLES */

.ipsTagBox_wrapper {
	min-height: 18px;
	width: 350px;
	line-height: 1.3;
	display: inline-block;
}
	
	.ipsTagBox_hiddeninput { background: #fff; }
	.ipsTagBox_hiddeninput.inactive {
		font-size: 11px;
		min-width: 200px;
	}
	
	.ipsTagBox_wrapper input { border: 0px;	outline: 0; }
	.ipsTagBox_wrapper li {	display: inline-block; }
	
	.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child {
		background: #dbf3ff;
		border-color: #a8e3ff;
		color: #136db5;
	}
	
	.ipsTagBox_tag {
		padding: 2px 1px 2px 4px;
		background: #f4f4f4;
		border: 1px solid #dddddd;
		margin: 0 3px 2px 0;
		font-size: 11px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
		cursor: pointer;
	}
	
		.ipsTagBox_tag:hover {
			border-color: #bdbdbd;
		}
		
		.ipsTagBox_tag.selected {
			background: #e2e2e2 !important;
			border-color: #c0c0c0 !important;
			color: #424242 !important;
		}
		
	.ipsTagBox_closetag {
		margin-left: 2px;
		display: inline-block;
		padding: 0 3px;
		color: #c7c7c7;
		font-weight: bold;
	}
		.ipsTagBox_closetag:hover { color: #454545;	}
		.ipsTagBox_tag.selected .ipsTagBox_closetag { color: #424242; }
		.ipsTagBox_tag.selected .ipsTagBox_closetag:hover { color: #2f2f2f;	}
		.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child .ipsTagBox_closetag { color: #4f87bb; }
		.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child .ipsTagBox_closetag:hover { color: #003b71; }
		
	.ipsTagBox_addlink {
		font-size: 10px;
		margin-left: 3px;
		outline: 0;
	}
	
	.ipsTagBox_dropdown {
		height: 100px;
		overflow: scroll;
		background: #fff;
		border: 1px solid #dddddd;
		-webkit-box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		z-index: 16000;
	}
	
		.ipsTagBox_dropdown li {
			padding: 4px;
			font-size: 12px;
			cursor: pointer;
		}
		.ipsTagBox_dropdown li:hover {
			background: #dbf3ff;
			color: #003b71;
		}

/************************************************************************/
/* TAG CLOUD */
.ipsTagWeight_1 { opacity: 1.0; }
.ipsTagWeight_2 { opacity: 0.9; }
.ipsTagWeight_3 { opacity: 0.8; }
.ipsTagWeight_4 { opacity: 0.7; }
.ipsTagWeight_5 { opacity: 0.6; }
.ipsTagWeight_6 { opacity: 0.5; }
.ipsTagWeight_7 { opacity: 0.4; }
.ipsTagWeight_8 { opacity: 0.3; }
		
/************************************************************************/
/* NEW FILTER BAR */

.ipsFilterbar li {
	margin: 0px 15px 0px 0;
	font-size: 11px;
}
	
	.ipsFilterbar li a {
		color: #fff;
		opacity: 0.5;
		text-shadow: 0px 1px 0px #0d273e;
		-webkit-transition: all 0.3s ease-in-out;
		-moz-transition: all 0.3s ease-in-out;
	}
		.ipsFilterbar.bar.altbar li a { color: #244156; text-shadow: none; opacity: .8; }
	
		.ipsFilterbar:hover li a { opacity: 0.8; }

		.ipsFilterbar li a:hover {
			color: #fff;
			opacity: 1;
		}


.ipsFilterbar li.active { opacity: 1; }

	
	.ipsFilterbar li.active a, .ipsFilterbar.bar.altbar li.active a {
		background: #303941;
		opacity: 1;
		color: #fff;
		padding: 4px 10px;
		font-weight: bold;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px !important;
		border-radius: 10px;
		-webkit-box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
		-moz-box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
		box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
	}
		
/************************************************************************/
/* POSTING FORM STYLES */
/* Additional form styles for posting forms */

.ipsPostForm { }
	
	.ipsPostForm.ipsLayout_withright {
		padding-right: 260px !important;
	}
		
	.ipsPostForm .ipsLayout_content {
		z-index: 900;
		-webkit-box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		-moz-box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		float: none;
	}
	
	.ipsPostForm .ipsLayout_right {
		width: 250px;
		margin-right: -251px;
		border-left: 0;
		z-index: 800;
	}
	
	.ipsPostForm_sidebar .ipsPostForm_sidebar_block.closed h3 {
		background-image: url({style_images_url}/folder_closed.png );
		background-repeat: no-repeat;
		background-position: 10px 9px;
		padding-left: 26px;
		margin-bottom: 2px;
	}

/************************************************************************/
/* MEMBER LIST STYLES */
.ipsMemberList .ipsButton_secondary { opacity: 0.3; }
.ipsMemberList li:hover .ipsButton_secondary, .ipsMemberList tr:hover .ipsButton_secondary { opacity: 1; }
.ipsMemberList li .reputation { margin: 5px 10px 0 0; }
.ipsMemberList > li .ipsButton_secondary { margin-top: 15px; }
.ipsMemberList li .rating {	display: inline; }

/************************************************************************/
/* COMMENT STYLES */
.ipsComment_wrap { margin-top: 10px; }
	.ipsComment_wrap .ipsLikeBar { margin: 0; }
	.ipsComment_wrap input[type='checkbox'] { vertical-align: middle; }
	
.ipsComment {
	border-bottom: 1px solid #e9e9e9;
	margin-bottom: 5px;
	padding: 10px 0;
}
	
.ipsComment_author, .ipsComment_reply_user {
	width: 160px;
	text-align: right;
	padding: 0 10px;
	float: left;
	line-height: 1.3;
}

	.ipsComment_author .ipsUserPhoto { margin-bottom: 5px; }
	
.ipsComment_comment {
	margin-left: 190px;
	line-height: 1.5;
}

	.ipsComment_comment > div { min-height: 33px; }
	
.ipsComment_controls { margin-top: 10px; }
.ipsComment_controls > li { opacity: 0.2; }
	.ipsComment:hover .ipsComment_controls > li, .ipsComment .ipsComment_controls > li.right { opacity: 1; }

.ipsComment_reply_user_photo {
	margin-left: 115px;
}

/************************************************************************/
/* FLOATING ACTION STYLES (comment moderation, multiquote etc.) */
.ipsFloatingAction {
	position: fixed;
	right: 10px;
	bottom: 10px;
	background: #fff;
	padding: 10px;
	z-index: 15000;
	border: 4px solid #464646;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
	-webkit-box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
	box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
}

	.ipsFloatingAction.left {
		right: auto;
		left: 10px;
	}
	
	.ipsFloatingAction .fixed_inner {
		overflow-y: auto;
		overflow-x: hidden;
	}
	
/* specifics for seo meta tags editor */
#seoMetaTagEditor { width: 480px; }

	#seoMetaTagEditor table { width: 450px; }
	#seoMetaTagEditor table td { width: 50%; padding-right: 0px }

/************************************************************************/
/* FORM STYLES */

body#ipboard_body fieldset.submit,
body#ipboard_body p.submit {
	padding: 15px 6px 15px 6px;
	text-align: center;
}

.input_text, .ipsTagBox_wrapper {
	padding: 4px;
	border-width: 1px;
	border-style: solid;
	border-color: #848484 #c1c1c1 #e1e1e1 #c1c1c1;
	background: #fff;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
}

	.input_text:focus {
		border-color: #4e4e4e #7c7c7c #a3a3a3 #7c7c7c;
		-webkit-box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
		-moz-box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
		box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
	}
	
	input.inactive, select.inactive, textarea.inactive { color: #c4c4c4; }

	.input_text.error {
		background-color: #f3dddd;
	}
	.input_text.accept {
		background-color: #f1f6ec;
	}

.input_submit {
	text-decoration: none;
	border-width: 1px;
	border-style: solid;
	padding: 4px 10px;
	cursor: pointer;
}

#webaskauthor {
min-width: 180px;
float: left;
padding-right: 20px;
}
	
	.input_submit.alt {
		text-decoration: none;
	}		

p.field {
	padding: 15px;
}

li.field {
	padding: 5px;
	margin-left: 5px;
}

	li.field label,
	li.field span.desc {
		display: block;
	}
	
li.field.error {
	color: #ad2930;
}

	li.field.error label {
		font-weight: bold;
	}

li.field.checkbox, li.field.cbox {
	margin-left: 0;
}

li.field.checkbox .input_check,
li.field.checkbox .input_radio,
li.field.cbox .input_check,
li.field.cbox .input_radio {
	margin-right: 10px;
	vertical-align: middle;
}

	li.field.checkbox label,
	li.field.cbox label {
		width: auto;
		float: none;
		display: inline;
	}
	
	li.field.checkbox p,
	li.field.cbox p {
		position: relative;
		left: 245px;
		display: block;
	}

	li.field.checkbox span.desc,
	li.field.cbox span.desc {
		padding-left: 27px;
		margin-left: auto;
		display: block;
	}
	
/************************************************************************/
/* MESSAGE STYLES */

.message {
	background: #ebfcdf;
	padding: 10px;
	border: 1px solid #a4cfa4;
	color: #0e440e;
	line-height: 1.6;
	font-size: 12px;
}

	.message h3 {
		padding: 0;
		color: #323232;
	}
	
	.message.error {
		background-color: #f3e3e6;
		border-color: #e599aa;
		color: #80001c;
	}
	
	.message.error.usercp {
		background-image: none;
		padding: 4px;
		float: right;
	}
	
	.message.unspecific {
		background-color: #f3f3f3;
		border-color: #d4d4d4;
		color: #515151;
		margin: 0 0 10px 0;
		clear: both;
	}
	
/************************************************************************/
/* MENU & POPUP STYLES */

.ipbmenu_content, .ipb_autocomplete {
	font-size: 12px;
	min-width: 85px;
	z-index: 2000;
}
	
	.ipbmenu_content li:last-child {
		border-bottom: 0;
		padding-bottom: 0px;
	}
	
	.ipbmenu_content li:first-child { padding-top: 0px;	}
	.ipbmenu_content.with_checks a { padding-left: 26px; } /* save room for a checkmark */
	.ipbmenu_content a .icon { margin-right: 10px; }
	.ipbmenu_content a { 
		text-decoration: none;
		text-align: left;
		display: block;
		padding: 6px 10px;
	}
	.ipbmenu_content.with_checks li.selected a {
		background-image: url({style_images_url}/icon_check.png );
		background-repeat: no-repeat;
		background-position: 7px 10px;
	}

.popupWrapper {
	background-color: #464646;
	background-color: rgba(70,70,70,0.6);
	padding: 4px;
	-webkit-box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7);
	-moz-box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7);
	box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7 );
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

	.popupInner {
		background: #fff;
		width: 500px;
		overflow: auto;
		-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		overflow-x: hidden;
	}
	
		.popupInner.black_mode {
			background: #000;
			border: 3px solid #b3bbc3; 
			color: #eee;
			border: 3px solid #555;
		}
		
		.popupInner.warning_mode {
			border: 3px solid #7D1B1B; 
		}
	
		.popupInner h3 {
			background: #2c5687 url({style_images_url}/maintitle.png) repeat-x top;
			color: #fff;
			padding: 8px 10px 9px;
			font-size: 16px;
			font-weight: 300;
			text-shadow: 0 1px 2px rgba(0,0,0,0.3);
		}
		
			.popupInner h3 a { color: #fff; }
		
			.popupInner.black_mode h3 {
				background-color: #545C66;
				color: #ddd;
			}
			
			.popupInner.warning_mode h3 {
				background-color: #7D1B1B;
				padding-top: 6px;
				padding-bottom: 6px;
				color: #fff;
			}
			
			.popupInner.warning_mode input.input_submit {
				background-color: #7D1B1B;
			}

.popupClose {
	position: absolute;
	right: 13px;
	top: 14px;
}

.popupClose.light_close_button {
	background: transparent url({style_images_url}/close_popup_light.png) no-repeat top left;
	opacity: 0.8;
	width: 13px;
	height: 13px;
	top: 17px;
}

.popupClose.light_close_button img {
	display: none;
}

.popup_footer {
	padding: 15px;
	position: absolute;
	bottom: 0px;
	right: 0px;
}

.popup_body {
	padding: 10px;
}

.stem {
	width: 31px;
	height: 16px;
	position: absolute;
}

	.stem.topleft { background-image: url({style_images_url}/stems/topleft.png);	}
	.stem.topright { background-image: url({style_images_url}/stems/topright.png); }
	.stem.bottomleft { background-image: url({style_images_url}/stems/bottomleft.png); }
	.stem.bottomright { background-image: url({style_images_url}/stems/bottomright.png);	}
	
.modal {
	background-color: #3e3e3e;
}

.userpopup h3 { font-size: 17px; }
.userpopup h3, .userpopup .side + div { padding-left: 110px; }
.userpopup .side { position: absolute; margin-top: -40px; }
	.userpopup .side .ipsButton_secondary { 
		display: block;
		text-align: center;
		margin-top: 5px;
		/* 	#32468: hacky workaround to ensure these buttons work when translated */
		max-width: 75px;
		height: auto;
		line-height: 1;
		padding: 5px 10px;
		white-space: normal;
	}
.userpopup .user_controls { text-align: left; }
.userpopup .user_status { padding: 5px; margin-bottom: 5px; }
.userpopup .reputation {
	display: block; 
	text-align: center;
	margin-top: 5px;
}

.userpopup {
	overflow: hidden;
	position: relative;
	font-size: 0.9em;
}

	.userpopup dl {
		border-bottom: 1px solid #d4d4d4;
		padding-bottom: 10px;
		margin-bottom: 4px;
	}

.info dt {
	float: left;
	font-weight: bold;
	padding: 3px 6px;
	clear: both;
	width: 30%;
}

.info dd {
	padding: 3px 6px;
	width: 60%;
	margin-left: 35%;
}

/************************************************************************/
/* BUTTONS STYLES */

.topic_buttons li {
	float: right;
	margin: 0 0 10px 10px;
}


.topic_buttons li.important a, .topic_buttons li.important span, .ipsButton .important,
.topic_buttons li a, .topic_buttons li span, .ipsButton {
	background: #3A4752 url({style_images_url}/primary_nav_bg.png ) repeat-x top;
	border: 1px solid #3A4752;
	border-width: 1px 1px 0 1px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	color: #fff;
	text-shadow: 0 -1px 0 #191919;
	font: 300 12px/1.3 Helvetica, Arial, sans-serif;
	line-height: 30px;
	height: 30px;
	padding: 0 10px;
	text-align: center;
	min-width: 125px;
	display: inline-block;
	cursor: pointer;
}

.topic_buttons li a, .input_submit {
  position: relative;
}

.topic_buttons li a:active, .input_submit:active {
  top:1px;
}

.topic_buttons li.important a, .topic_buttons li.important span, .ipsButton .important, .ipsButton.important {
	background: #812200 url({style_images_url}/topic_button_closed.png ) repeat-x top;
	border-color: #812200;
	-moz-box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
}
	
	.topic_buttons li a:hover, .ipsButton:hover { color: #fff; }
	.topic_buttons li.non_button a {
		background: transparent !important;
		background-color: transparent !important;
		border: 0;
		box-shadow: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
		text-shadow: none;
		min-width: 0px;
		color: #777777;
		font-weight: normal;
	}
	
	.topic_buttons li.disabled a, .topic_buttons li.disabled span {
		background: #ebebeb;
		box-shadow: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
		text-shadow: none;
		border: 0;
		color: #7f7f7f;
	}
	
	.topic_buttons li span { cursor: default !important; }


.ipsButton_secondary {
	height: 22px;
	line-height: 22px;
	font-size: 12px;
	padding: 0 10px;
background: #f6f8fa;
background: -moz-linear-gradient(top,  #f6f8fa 0%, #edeeef 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f8fa), color-stop(100%,#edeeef));
background: -webkit-linear-gradient(top,  #f6f8fa 0%,#edeeef 100%);
background: -o-linear-gradient(top,  #f6f8fa 0%,#edeeef 100%);
background: -ms-linear-gradient(top,  #f6f8fa 0%,#edeeef 100%);
background: linear-gradient(to bottom,  #f6f8fa 0%,#edeeef 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8fa', endColorstr='#edeeef',GradientType=0 );
	border: 1px solid #D9DBDD;
	-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #616161;
	display: inline-block;
	white-space: nowrap;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
}
	.ipsButton_secondary a { color: #616161; }
	.ipsButton_secondary:hover {
		color: #4c4c4c;
		border-color: #CED0D2;
	}
	
	
	.ipsButton_secondary.important {
		background: #9f2a00;
		background: -moz-linear-gradient(top, #9f2a00 0%, #812200 100%); /* firefox */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9f2a00), color-stop(100%,#812200)); /* webkit */
		border: 1px solid #812200;
		color: #fbf4f4;
		-moz-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
		box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
	}
		.ipsButton_secondary .icon {
			margin-right: 4px;
			margin-top: -3px;
		}
		
		.ipsButton_secondary img.small {
			max-height: 12px;
			margin-left: 3px;
			margin-top: -2px;
			opacity: 0.5;
		}
		
		.ipsButton_secondary.important a { color: #fbf4f4; }
		.ipsButton_secondary.important a:hover { 
			color: #fff !important;
			border-color: #571700;
		}
		
		/* Used in post forms */
		.ipsField.ipsField_checkbox.ipsButton_secondary
		{
			line-height: 18px;
		}
		
		.ipsField.ipsField_checkbox.ipsButton_secondary input
		{
			margin-top: 6px
		}
		
		.ipsField.ipsField_checkbox.ipsButton_secondary .ipsField_content
		{
			margin-left: 18px;
		}
		
.ipsButton_extra {
	line-height: 22px;
	height: 22px;
	font-size: 11px;
	margin-left: 5px;
	color: #5c5c5c;
}

.ipsButton_secondary.fixed_width{ min-width: 170px; }

.ipsButton.no_width { min-width: 0; }
.topic_controls { min-height: 30px; overflow: hidden; }
ul.post_controls {
	padding: 6px 0 16px;
	clear: both;
}

		ul.post_controls li {
			font-size: 12px;
			float: right;
		}

		ul.post_controls a {	
			background: #384A61;
border: 1px solid #142638;
border-radius: 2px 2px 2px 2px;
box-shadow: 0 1px 0 #3B6481 inset;
color: #FFF;
display: block;
height: 20px;
line-height: 20px;
margin-left: 4px;
padding: 0 9px;
text-decoration: none;
		}

		ul.post_controls a:hover { background: #384A61; color: #fff; }
		
		ul.post_controls a.ipsButton_secondary {
			height: 20px;
			line-height: 20px;
		}
		
		ul.post_controls a.ipsButton_secondary.important:hover {
			color: #fff !important;
		}
		
		ul.post_controls li.multiquote.selected a { 
			background: #a1dc00; /* Old browsers */
			background: -moz-linear-gradient(top, #a1dc00 0%, #7ba60d 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a1dc00), color-stop(100%,#7ba60d)); /* Chrome,Safari4+ */
			border-color: #7ba60d;
			-moz-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			color: #fff;
		}

.post_block .post_controls li a { 
	opacity: 0.2;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
}

.post_block .post_controls li a.ipsButton_secondary {
	opacity: 1;
}
.post_block:hover .post_controls li a { border-bottom: 2px solid orangered; opacity: 1; }

.hide_signature, .sigIconStay { float: right; }
.post_block:hover .signature a.hide_signature, .sigIconStay {
	background: transparent url({style_images_url}/cross_sml.png) no-repeat top right;
	width: 13px;
	height: 13px;
	opacity: 0.6;
	position: absolute;
	right: 0px;
}

/************************************************************************/
/* PAGINATION STYLES */

.pagination { padding: 5px 0; line-height: 20px; }
.pagination.no_numbers .page { display: none; }
.pagination .pages { text-align: center; }
.pagination .back { margin-right: 6px; }
	.pagination .back li { margin: 0 2px 0 0; }
.pagination .forward { margin-left: 6px; }
	.pagination .forward li { margin: 0 0 0 2px; }


.pagination .back a,
.pagination .forward a {
	display: inline-block;
	padding: 0px 6px;
	height: 20px;
	background: #eaeaea;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	text-transform: uppercase;
	color: #5a5a5a;
	font-size: 11px;
	font-weight: bold;
}
	
	
	.pagination .back a:hover,
	.pagination .forward a:hover {
		background: #af286d;
		color: #fff;
	}

	.pagination .disabled a {
		opacity: 0.4;
		display: none;
	}
	
.pagination .pages {
	font-size: 11px;
	font-weight: bold;
}

	.pagination .pages a, .pagejump {
		display: inline-block;
		padding: 1px 4px;
		color: #999;
	}
	
	.pagination .pages .pagejump { padding: 0px; }
	
	.pagination .pages a:hover {
		background: #ececec;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
	}
	
	.pagination .pages li { margin: 0 1px; }
	
		
		.pagination .pages li.active {
			background: #7BA60D;
			color: #fff;
			font-weight: bold;
			-moz-border-radius: 2px;
			-webkit-border-radius: 2px;
			border-radius: 2px;
			padding: 1px 5px;
		}
		
.pagination.no_pages span {
	color: #acacac;
	display: inline-block;
	line-height: 20px;
	height: 20px;
}

ul.mini_pagination {
	font-size: 10px;
	display: inline;
	margin-left: 7px;
}

	ul.mini_pagination li a {
		background: #fff;
		border: 1px solid #d3d3d3;
		padding: 1px 3px;
	}

	ul.mini_pagination li {
		display: inline;
		margin: 0px 2px;
	}

/************************************************************************/
/* MODERATION & FILTER STYLES */

.moderation_bar {
	text-align: right;
	padding: 8px 10px;
	/*background: #f7f7f7;*/
}

	.moderation_bar.with_action {
		background-image: url({style_images_url}/topic_mod_arrow.png);
		background-repeat: no-repeat;
		background-position: right center;
		padding-right: 35px;
	}

/************************************************************************/
/* AUTHOR INFO (& RELATED) STYLES */

.author_info {
width: 200px;
float: left;
font-size: 12px;
text-align: center;
color: #000;
margin: 10px 5px;
}

.author_info, .post_body{
	background: #E8ECEE url("{style_images_url}/triangles.png");
        padding: 8px;
        border: 2px dashed #ECF2F7;
        border-radius: 3px;
}
	
	.author_info .group_title {
		color: #5a5a5a;
		margin-top: 5px;
	}
	
	.author_info .member_title { margin-bottom: 5px; word-wrap: break-word; }
	.author_info .group_icon { margin-bottom: 3px; }
	
.custom_fields {
	color: #818181;
	margin-top: 8px;
}

.custom_fields .ft { 
	color: #505050;
	margin-right: 3px;
}

.custom_fields .fc {
	word-wrap: break-word;
}


.user_controls {
	text-align: center;
	margin: 6px 0;
}

	.user_controls li a {
		display: inline-block;
		background: #f6f6f6;
		background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%); /* firefox */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)); /* webkit */
		border: 1px solid #dbdbdb;
		-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		padding: 5px;
		color: #616161;
	}

/************************************************************************/
/* BOARD INDEX STYLES */





#categories .category_block.block_wrap {
	margin-bottom: 4px;
}

#board_index { position: relative; }
	#board_index.no_sidebar { padding-right: 0px; }
		#board_index.force_sidebar { padding-right: 280px; }
	
#toggle_sidebar {
	position: absolute;
	right: -5px;
	top: -13px;
	z-index: 8000;
	background: #333333;
	padding: 3px 7px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	color: #fff;
	opacity: 0;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
}
	#index_stats:hover + #toggle_sidebar, #board_index.no_sidebar #toggle_sidebar { opacity: 0.1; }
	#toggle_sidebar:hover { opacity: 1 !important; }

	
.ipsSideBlock {
	padding: 10px;
}
		
	.ipsSideBlock h3 {
font: 11px arial, sans-serif;
color: #757575;
padding: 9px 10px;
background: #ececec url("{style_images_url}/triangles.png") repeat-x 0 0;
text-shadow: #fff 0px 1px 0px;
box-shadow: inset 0px 1px 0px #f9f9f9;
margin: -10px -10px 10px;
border-bottom: 2px solid orangered;
}
	
	.ipsSideBlock h3 .mod_links { opacity: 0.0; }
	.ipsSideBlock h3:hover .mod_links { opacity: 1; }

.status_list .status_list { margin: 10px 0 0 50px; }
.status_list p.index_status_update { line-height: 120%; margin:4px 0px; }
.status_list li { position: relative; }
.status_reply {
	margin-top: 8px;
}

.status_list li .mod_links { 
	opacity: 0.1;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
}
.status_list li:hover .mod_links { opacity: 1; }

/* board stats */
#board_stats ul { 
         width: 98%;
         margin: 0 auto; 
}
	
#board_stats li {
    margin-right: 20px;
    padding: 3px;
    border: 1px solid rgb(230, 230, 230);
    border-collapse: collapse;
    margin: 2px;
    width: 100%;
    border-radius: 3px;
    line-height: 20px;
    color: #fff;
    background: #3a4752 url("{style_images_url}/triangles.png") repeat-x;
}

#board_stats li:hover {
    background: #F0865D;
}

#board_stats .value {
    display: inline-block;
    background: rgb(233, 233, 233);
    color: #0E0D0D;
    padding: 0px 8px;
    font-weight: bold;  
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    margin-right: 3px;
    float: right;
}

#board_stats .value {
         color: #000;
         font-weight: bold;
}

.statistics {
	margin: 20px 0 0 0;
	padding: 10px;
	line-height: 1.3;
	overflow: hidden;
}

	
.statistics_head{
		/* border-bottom: 1px solid #d8d8d8; */
		text-shadow: rgba(0,0,0,0.4) 0px -1px 0px;
		/* background: url("{style_images_url}/background_blur.jpg") repeat-x 50% 0 fixed; */
		background-position: 50% 0;
		background-repeat: no-repeat;
		background-attachment: fixed;
		-webkit-box-shadow: inset rgba(0,0,0,0.15) 0px -1px 0px, inset rgba(255,255,255,0.4) 0px 1px 0px, inset rgba(255,255,255,0.2) 0px 0px 0px 1px;
		-moz-box-shadow: inset rgba(0,0,0,0.15) 0px -1px 0px, inset rgba(255,255,255,0.4) 0px 1px 0px, inset rgba(255,255,255,0.2) 0px 0px 0px 1px;
		box-shadow: inset rgba(0,0,0,0.15) 0px -1px 0px, inset rgba(255,255,255,0.4) 0px 1px 0px, inset rgba(255,255,255,0.2) 0px 0px 0px 1px;
		color: #222;
		text-shadow: rgba(255,255,255,1) 0px 0px 3px;
		padding: 12px;
		font-size: 12px;
		font-weight: bold;
	}

	
	
	
	.statistics {
		border-top: 0;
	}
	
#webaskfooter {

}

#webaskgroups {
         width: 20%;
         float: right;
         padding: 2%;
}


#stats .extra {
         color: #a2a2a2;
         font-size: 0.9em;
}

#webaskonline, #webaskonlinetoday {
         width: 34%;
         float: left;
         padding: 2%;
}

.webask_box {
         background: #fff;
         margin-bottom: 10px;
}
statistics {
         line-height: 1.3;
}
	
	
#stat_links{ font-weight: normal; }
#stat_links a{ margin: 0 5px; }

	#stat_links {
		margin: 8px 5px 0 0;
	}

.friend_list ul li,
#top_posters li {
	text-align: center;
	padding: 8px 0 0 0;
	margin: 5px 0 0 0;
	min-width: 80px;
	height: 70px;
	float: left;
}

	.friend_list ul li span.name,
	#top_posters li span.name {
		font-size: 0.8em;
	}
	
#hook_watched_items ul li {
	padding: 8px;
}

	body#ipboard_body #hook_watched_items fieldset.submit {
		padding: 8px;
	}
	
#hook_birthdays .list_content {
	padding-top: 8px;
}

#hook_calendar .ipsBox_container { padding: 10px; }
#hook_calendar td, #hook_calendar th { text-align: center; }
#hook_calendar th { font-weight: bold; padding: 5px 0;}

/************************************************************************/
/* FORUM VIEW (& RELATED) STYLES */

#more_topics {
	text-align: center;
	font-weight: bold;
}
	#more_topics a { display: block; padding: 10px 0;}

	/* Result of the 'load more topics' link */
	.dynamic_update { border-top: 2px solid #b3b3b3; }

.topic_preview,
ul.topic_moderation {
	margin-top: -2px;
	z-index: 300;
}
	ul.topic_moderation li {
		float: left;
	}
	
	.topic_preview a,
	ul.topic_moderation li a {
		padding: 0 3px;
		display: block;
		float: left;
	}

span.mini_rate {
	margin-right: 12px;
	display: inline-block;
}

img.mini_rate {
	margin-right: -5px;
}

/************************************************************************/
/* TOPIC VIEW (& RELATED) STYLES */

/* Post share pop-up */
#postShareUrl { width: 95%; font-size: 18px; color: #999; }
#postShareStrip { height: 50px; padding-top: 10px; text-align: center; }
	#postShareStrip .fbLike { text-align: left; position: absolute; margin-top: 25px; margin-left: 60px; }

body .ip { color: #475769; }
span.post_id { margin-left: 5px; }
input.post_mod { margin:12px 5px 0px 10px; }

.post_id a img.small {
	max-height: 12px;
	margin-left: 3px;
	margin-top: -2px;
	opacity: 0.5;
}

.signature {
	clear: right;
	color: #a4a4a4;
	font-size: 0.9em;
	border-top: 1px solid #d5d5d5;
	padding: 10px 0;
	margin: 6px 0 4px;
	position: relative;
}

	.signature a { text-decoration: underline; }

.post_block {
	position: relative;
}
	.post_block.moderated {
		background: none;
	}

	.post_block.no_sidebar {
		background-image: none;
	}
	
	.post_block.solved .post_body {
		background-color: #eaf8e2;
	}
	
	.post_block.feature_box .post_body {
		background-color: #eaf8e2;
		border:1px dotted #333;
		padding: 6px;
		min-height: 60px;
	}
	
	.post_block.feature_box .ipsType_sectiontitle {
		border-color: #ddd;
		font-size: 12px;
	}
        
	
	.post_block h3 {
		background: #D1D6D9;
		padding: 0 10px;
		height: 36px;
		line-height: 36px;
		font-weight: normal;
		font-size: 16px;
	}
.post_username {
float: left;
min-width: 220px;
font-weight: bold;
text-align: center;
margin-left: -2px;
border-right: 1px solid #dcdcdc;
margin-right: 10px;
}

.tatofft {
background: rgb(56, 100, 139);
display: inline-table;
padding: 0 8px 0 8px;
border-radius: 2px;
height: 26px;
line-height: 26px;
text-shadow: none;
color: rgb(255,255,255);
margin-left: -5px;
}
.tatoffn {
background: rgb(76, 179, 88);
display: inline-table;
padding: 0 8px 0 8px;
border-radius: 2px;
height: 26px;
line-height: 26px;
text-shadow: none;
color: rgb(255,255,255);
margin-left: -5px;
}
	
	.post_wrap { top: 0px; }	

.post_body {
    margin: 10px 10px 10px 185px;
    margin-left: 233px !important;
    padding-left: 10px;
    padding-top: 10px;
}
	
	.post_body .post {
		line-height: 1.6;
		font-size: 14px;
		word-wrap: break-word;
	}
	
	.post_block.no_sidebar .post_body { margin-left: 10px !important; }

	.posted_info strong.event {
		color: #1c2837;
		font-size: 1.2em;
	}
.posted_info {
    background: #D6D6D6;
    border: 1px solid #C2C2C2;
    display: inline-table;
    border-radius: 2px;
    line-height: 16px;
    text-shadow: none;
    color: #616161;
}
.posted_info {
    padding: 1px 3px;
}

.post_ignore {	
	background: #fafbfc;
	color: #777;
	font-size: 0.9em;
	padding: 15px;	
}

	.post_ignore .reputation {
		text-align: center;
		padding: 2px 6px;
		float: none;
		display: inline;
	}

.rep_bar {
	white-space: nowrap;
	margin: 6px 4px;
}

	.rep_bar .reputation {
		font-size: 10px;
		padding: 2px 10px !important;
	}
		
p.rep_highlight {
	float: right;
	display: inline-block;
	margin: 5px 10px 10px 10px;
	background: #D5DEE5;
	color: #494F59;
	padding: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	font-size: 0.8em;
	font-weight: bold;
	text-align: center;
}

	p.rep_highlight img {
		margin-bottom: 4px;
	}

.edit {
	padding: 5px 5px 5px 32px;
background: url('http://cs-grand.ru/public/style_images/csgrand/info-bg.png') repeat-x;
color: #52626C;
font-size: 11px;
margin-top: 15px;
line-height: 18px;
min-height: 30px;
position: relative;
}

.poll fieldset {
	padding: 9px;
}

.poll_question {
	padding: 10px;
	margin: 10px 10px 10px 20px;
}

	.poll_question h4 {
		background-color: #C1CED9;
		margin: 0 -7px;
		padding: 5px;
	}

	.poll_question ol {
		padding: 8px;
		background-color: #fafbfc;
	}
	
	.poll_question li {
		font-size: 0.9em;
		margin: 6px 0;
	}
	
	.poll_question .votes {
		margin-left: 5px;
	}
	
.snapback { 
	margin-right: 5px;
	padding: 1px 0 1px 1px;
}

.rating { display: block; margin-bottom: 4px; line-height: 16px; } 
	.rating img { vertical-align: top; }
#rating_text { margin-left: 4px; }
	
/************************************************************************/
/* POSTING FORM (& RELATED) STYLES */

div.post_form label {
	text-align: right;
	padding-right: 15px;
	width: 275px;
	float: left;
	clear: both;
}

	div.post_form span.desc,
	fieldset#poll_wrap span.desc {
		margin-left: 290px;
		display: block;
		clear: both;
	}

	div.post_form .checkbox input.input_check,
	#mod_form .checkbox input.input_check {
		margin-left: 295px;
	}
	
	div.post_form .antispam_img {
		margin-left: 290px;
	}
	
	div.post_form .captcha .input_text {
		float: left;
	}
	
	div.post_form fieldset {
		padding-bottom: 15px;
	}

	div.post_form h3 {
		margin-bottom: 10px;
	}
	
fieldset.with_subhead {
	margin-bottom: 0;
	padding-bottom: 0;
}

	fieldset.with_subhead h4 {
		text-align: right;	
		margin-top: 6px;
		width: 300px;
		float: left;
	}

	fieldset.with_subhead ul {
		border-bottom: 1px solid #d5dde5;
		padding-bottom: 6px;
		margin: 0 15px 6px 320px;
	}

	fieldset.with_subhead span.desc,
	fieldset.with_subhead label {
		margin: 0;
		width: auto;
	}

	fieldset.with_subhead .checkbox input.input_check {
		margin-left: 0px;
	}

#toggle_post_options {
	background: transparent url({style_images_url}/add.png) no-repeat;
	font-size: 0.9em;
	padding: 2px 0 2px 22px;
	margin: 15px;
	display: block;
}

#poll_wrap .question {
	margin-bottom: 10px;
}

		#poll_wrap .question .wrap ol {
			margin-left: 25px; 
			list-style: decimal;
		}
			#poll_wrap .question .wrap ol li {
				margin: 5px;
			}
	
.question_title { margin-left: 30px; padding-bottom: 0; }
	.question_title .input_text { font-weight: bold }

#poll_wrap { position: relative; }
#poll_footer { }
#poll_container_wrap { overflow: auto; }
#poll_popup_inner { overflow: hidden; }

.poll_control { margin-left: 20px; }
.post_form .tag_field ul { margin-left: 290px; }

/************************************************************************/
/* ATTACHMENT MANAGER (& RELATED) STYLES */

.swfupload {
	position: absolute;
	z-index: 1;
}
	
#attachments { }

	#attachments li {
		background-color: #C1CED9;
		border: 1px solid #d5dde5;
		padding: 6px 20px 6px 42px;
		margin-bottom: 10px;
		position: relative;
	}
	
		#attachments li p.info {
			color: #69727b;
			font-size: 0.8em;
			width: 300px;
		}
	
		#attachments li .links, #attachments li.error .links, #attachments.traditional .progress_bar {
			display: none;
		}
			
			#attachments li.complete .links {
				font-size: 0.9em;
				margin-right: 15px;
				right: 0px;
				top: 12px;
				display: block;
				position: absolute;
			}
			
		#attachments li .progress_bar {
			margin-right: 15px;
			width: 200px;
			right: 0px;
			top: 15px;
			position: absolute;
		}
	
		#attachments li.complete, #attachments li.in_progress, #attachments li.error {
			background-repeat: no-repeat;
			background-position: 12px 12px;
		}
	
		#attachments li.in_progress {
			background-image: url({style_images_url}/loading.gif);
		}
	
		#attachments li.error {
			background-image: url({style_images_url}/exclamation.png);
			background-color: #e8caca;
			border: 1px solid #ddafaf;
		}
		
			#attachments li.error .info {
				color: #8f2d2d;
			}
	
		#attachments li.complete {
			background-image: url({style_images_url}/accept.png);
		}
		
		#attachments li .thumb_img {
			left: 6px;
			top: 6px;
			width: 30px;
			height: 30px;
			overflow: hidden;
			position: absolute;
		}
		
.attach_controls {
	background: url({style_images_url}/icon_attach.png ) no-repeat 3px top;
	padding-left: 30px;
	min-height: 82px;
}

	.attach_controls .ipsType_subtitle { margin-bottom: 5px; }
	.attach_controls iframe { display: block; margin-bottom: 5px; }
	
.attach_button { font-weight: bold;  }
#help_msg {	margin-top: 8px; }

#attach_wrap {
	/*background: #eef3f8;
	padding: 6px;*/
	margin-top: 10px;
	overflow: hidden;
}

	#attach_wrap h4 {
		font-size: 16px;
		padding-left: 0px;
	}
	
	#attach_wrap ul { list-style-type: none; margin-left: 0px; }
	
	#attach_wrap li {
		margin: 5px 0;
		float: left;
	}
		#attach_wrap .attachment {
			float: none;
		}
		
		#attach_wrap .desc.info {
			margin-left: 24px;
		}

#attach_error_box {	margin-bottom: 10px; }

.resized_img {
	margin: 0 5px 5px 0;
	display: inline-block;
}

/************************************************************************/
/* REPUTATION STYLES */

.reputation {
	font-weight: bold;
	padding: 3px 8px;
	display: inline-block;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
}
	
	.reputation.positive, .members li.positive {
		background: #0F9447;
	}
	
	.reputation.negative, .members li.negative {
		background: #b82929;
	}
	
	.reputation.positive, .reputation.negative {
		color: #fff;
	}
	
	.reputation.zero {
		background: #dedede;
		color: #6e6e6e;
	}


.status_main_content { white-space: break-word; }

.status_main_content h4 {
	font-weight:normal;
	font-size:1.2em;
}

.status_main_content h4 .su_links a { font-weight: normal; }

.status_main_content p {
	padding: 6px 0px 6px 0px;
}

.status_main_content h4 a {
	font-weight:bold;
	text-decoration: none;
}

.status_mini_wrap {
	padding: 7px;
	font-size: 0.95em;
	margin-top: 2px;
}
.status_mini_photo {
	float: left;
}


.status_textarea {
	width: 99%;
}

.status_replies_many {
	height: 300px;
	overflow: auto;
}

	
.status_update {
	background: #71a5c9;
	color: #fff;
	padding: 15px 12px;
}

	.status_update .input_text { width: 70%; padding: 6px 4px; }
	.status_update .status_inactive { color: #bbbbbb; }	
	#status_wrapper h4 { font-weight: bold; font-size: 14px; }
	.status_content { line-height: 1.4; }
	.status_content .mod_links { opacity: 0.2; }
	.status_content:hover .mod_links { opacity: 1; }
	.status_content .h4, .status_content .status_status { font-size: 14px; word-wrap: break-word; }
	.status_feedback { margin: 10px 0 0 -10px; }
        .status_feedback .row2 { margin-bottom: 1px; }

/* Favorites */
.ips_like {
	background-color: #f1f4f7;
	padding: 8px 4px 4px 4px;
	color: #878787;
	font-size: 1em;
	min-height: 18px;
	font-size: 0.9em;
	line-height: 130%;
	clear: both;
}
.ips_like a {
	color: #878787;
}

.ips_like a.ftoggle {
	float: right;
	/*background: #e4ebf2 url({style_images_url}/icons/thumb_up.png) no-repeat left 2px;*/
	border:1px solid #CBCBCB;
	padding: 3px 4px 2px 4px;
	color: #656565;
	font-size:0.8em;
	text-decoration: none;
	-webkit-border-top-left-radius: 4px;
	-webkit-border-top-right-radius: 4px;
	-webkit-border-bottom-left-radius: 4px;
	-webkit-border-bottom-right-radius: 4px;
	margin-top: -4px;
}

.ips_like a.ftoggle.on {
	/*background: #e4ebf2 url({style_images_url}/icons/fave_on_small.png) no-repeat left 2px;*/
	margin-left: 3px;
}

.ips_like a.ftoggle._newline,
.ips_like a.ftoggle.on._newline {
	float:none;
	margin-top: 5px;
	margin-left: auto;
	margin-right: 0;
	display: block;
	width: 70px;
	text-align: center;
}

.ips_like a:hover.ftoggle.on,
.ips_like a:hover.ftoggle {
	background-color: #d5dde5;
}

.facebook-like { margin-top: 5px; }

.boxShadow {
	-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
	-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}

/* New notification panel */
#ipsGlobalNotification {
	position: fixed;
	left: 50%;
	margin-left: -250px;
	top: 20px;
	text-align: center;
	font-weight: bold;
}

#ips_NotificationCloseButton {
	background: transparent url({style_images_url}/close_popup.png) no-repeat top left;
	opacity: 0.8;
	width: 13px;
	height: 13px;
	top: 5px;
	left: 5px;
	position: absolute;
	cursor: pointer;
}

.googlePlusOne {
	display: inline-block;
	vertical-align:middle;
	margin-top: 1px;
}
.fbLike {
	float: right !important;
	padding-left: 2px;
}
/************************************************************************/
/* SHARED MEDIA STYLES */

#mymedia_inserted {
	position: absolute;
	top: 100px; left: 50%;
	margin-left: -200px;
	width: 400px;
	padding: 20px 0;
	background: black;
	font-size: 15px;
	font-weight: bold;
	color: #fff;
	z-index: 20000;
	text-align: center;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

.wa-unread-posts {
color: rgba(255, 255, 255, 0.71);
background: rgba(250, 119, 68, 0.78);
padding: 0 5px 1px 5px;
font-weight: normal;
border-radius: 2px;
}

#mymedia_toolbar { 
	position: absolute;
	bottom: 0; left: 0;	right: 0;
	height: 42px;
	line-height: 42px;
	padding: 0 5px;
	background: #D5D7D9;
	background: -moz-linear-gradient(top, #D5D7D9 0%, #c7d4e4 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#D5D7D9), color-stop(100%,#c7d4e4)); /* webkit */
	-webkit-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	-moz-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	border-top: 1px solid #D5D7D9;
}

#mymedia_finish { position: absolute; right: 5px; top: 5px; }
#mymedia_content { height: 339px; overflow: auto; }

.media_results li.result {
	width: 20%;
	height: 100px;
	padding: 15px 0;
	float: left;
	text-align: center;
	cursor: pointer;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

	.media_results li:hover { 
		background: #F9F9F9;
		background: -moz-linear-gradient(top, #F9F9F9 0%, #EDEDED 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#F9F9F9), color-stop(100%,#EDEDED));
	}
	.media_results li:active { 
		background: #EDEDED;
		background: -moz-linear-gradient(top, #EDEDED 0%, #F9F9F9 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#EDEDED), color-stop(100%,#F9F9F9));
	}
	
	.media_image {
		padding: 1px;
		border: 1px solid #d5d5d5;
		margin-bottom: 5px;
	}

/********************************************************/
/* Template Error										*/	

.templateError {
	background: #ffffff !important;
	color: #000000 !important;
	padding: 10px !important;
	border: 1px dotted black !important;
	margin: 0px !important;
}
	
/********************************************************/
/* ModCP styles											*/

.modcp_post_controls { padding-bottom: 15px; }
.modcp_post_controls .ipsButton_secondary { opacity: 0.5; }
.post_body:hover .modcp_post_controls .ipsButton_secondary { opacity: 1; }

#modcp_content .ipsFilterbar li.active a {
	margin-bottom: 1px;
	display: inline-block;
}

/********************************************************/
/* Advertisements from Nexus							*/

.nexusad { padding: 10px; clear: both; }

#bbcode-description {
	color: #666 !important;
	white-space: normal !important;
	word-wrap: break-word;
}

.rep_bar {
white-space: nowrap;
margin: 6px 4px;
}
.rep_bar
.reputation {
    font-size: 10px;
    padding: 2px
10px !important;
}
.rep_up {
    position: absolute;
    top: 0;
    right: 0;
    padding: 2px
3px;
    border-bottom: 1px solid #18A275;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    -ms-transition: all 0.1s linear;
    -o-transition: all 0.1s linear;
    transition: all 0.1s linear;
    border-radius: 0 6px 0 0;
}

.rep_up:hover {
    background: #2ECC71;
    border-radius: 0 6px 0 0;
}

.rep_down:hover {
    background: #E74C3C;
    border-radius: 0 0 6px 0;
}

.rep_down {
    border-radius: 0 0 6px 0;
    position: absolute;
    bottom: 1px;
    background: #D35400;
    right: 0px;
    padding: 0px
6px;
    padding-bottom: 6px;
    margin-bottom: -1px;
    border-radius: 0 0 6px 0;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    -ms-transition: all 0.1s linear;
    -o-transition: all 0.1s linear;
    transition: all 0.1s linear;
}

.orate-btns {
    position: relative;
    height: 40px;
    float: right;
    background-color: #1abc9c;
    width: 22px;
    border-color: #1abc9c;
    text-align: center;
    border-radius: 0 6px 6px 0;
}
.reputation.negative, .members
li.negative {
    background: #E74C3C;
    border: 1px
solid #C0392B;
}

.reputation.negative:hover, .members li.negative:hover {
    background: #C0392B;
}

.reputation.positive,.reputation.negative {
    color: #fff;
}

.reputation.zero {
    background: #95A5A6;
    color: #fff;
    border: 1px
solid #929292;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    -ms-transition: all 0.1s linear;
    -o-transition: all 0.1s linear;
    transition: all 0.1s linear;
}

.reputation.zero:hover {
    background: #929292;
}
.reputation2.positive2 {
    border-radius: 6px;
    background-color: #34495e;
    color: #1abc9c;
    border-left: 1px solid transparent;
}

.reputation2.negative2 {
    border-radius: 6px;
    background-color: #34495e;
    color: #FF7B47;
    border-left: 1px solid transparent;
}

.reputation2 {
    width: 60px;
    text-align: center;
    height: 32px;
    border-radius: 2px;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -o-transition: all 0.2s ease;
    font-size: 18px;
    font-family: "Trebuchet MS",tahoma;
    color: white;
    font-weight: normal;
    display: block;
    text-shadow: 0px -1px 0px rgba(0,0,0,0.4);
    cursor: pointer;
    height: 40px;
    line-height: 40px;
}

.reputation2:hover {
    background-color: #53718F !important;
}

.reputation2.zero2 {
    border-radius: 6px;
    background-color: #34495e;
    color: #fff;
    border-left: 1px solid transparent;
}


/********************************************************/
/* iPad Specific									*/
@media only screen and (device-width: 768px) {
	table.ipb_table .expander,
	table.ipb_table .ipsModMenu { visibility: visible; opacity: 0.2; }
	.post_block .post_controls { opacity: 1 !important;	}
}
.icons a.facebook {
background: url({style_images_url}/facebook.png) left top no-repeat;
}

.icons a.twitter {
background: url({style_images_url}/twitter.png) left top no-repeat;
}

.icons a.googleplus {
background: url({style_images_url}/googleplus.png) left top no-repeat;
}

.icons a.bg {
background:url({style_images_url}/bg7.png) left top no-repeat;
}

.icons a.youtube {
background: url({style_images_url}/youtube.png) left top no-repeat;
}

.icons a.google {
background: url({style_images_url}/google.png) left top no-repeat;
}

.icons a.yahoo {
background: url({style_images_url}yahoo.png) left top no-repeat;
}

.icons a.windows {
background: url({style_images_url}/windows.png) left top no-repeat;
}

.icons a.deviantart {
background: url({style_images_url}/deviantart.png) left top no-repeat;
}

.icons a.skype {
background: url({style_images_url}/skype.png) left top no-repeat;
}

.icons a:hover {
background-position: left -34px;
}


.icons a {
display: inline-block;
width: 24px;
height: 24px;
margin: 10px;
vertical-align: middle;
-o-transition: all .3s;
-moz-transition: all .3s;
-webkit-transition: all .3s;
-ms-transition: all .3s;
}
.footer #button{
width: 15px;
font-size: 26px;
border-radius: 35px;
margin-left: 12px;
position: relative;
transition: all 1s ease;
-webkit-animation: pulsate 1s ease-out;
animation: pulsate 1s ease-out;
-webkit-animation-iteration-count: infinite;
animation-iteration-count: infinite;
}

.footer {
text-align:center;
	bottom:0;
	left:0;
	position:fixed;
    width: 100%;
    height: 2em;
    overflow:hidden;
    margin:0 auto;
	-webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    -ms-transition: all 1s ease;
    transition: all 1s ease;
	z-index:999;
}
.footer:hover {
	-webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    -ms-transition: all 1s ease;
    transition: all 1s ease;
	height: 14em;
}
.footer #containerbg{
margin-top: 40px;
width: 100%;
height: 100%;
color: #fafafa;
position: relative;
top: 0;
left: 0;
background: #283A4A;
border-top: solid 1px #fafafa;
}
.footer #contbg{
  position:relative;
  top:-45px;
  right:190px;
	width:150px;
	height:auto;
	margin:0 auto;
}

.footer h3{
margin-top: 70px;
border-bottom: solid 1px #fafafa;
text-shadow: rgba(0,0,0,0.85) 0px 1px 4px;
font-weight: 300;
font-size: 20px;
line-height: 30px;
font-family: 'Helveticaneue','Open Sans','Yanone Kaffeesatz',"Trebuchet MS",Arial,Helvetica,sans-serif;
}

.design{
font-size: 16px;
line-height: 30px;
}
.design:hover{
background: #cd3816;
}
.ipsUserPhoto_large {
  border-radius: 50%;
}
 
.ipsUserPhoto_medium {
  border-radius: 50%;
}
 
.ipsUserPhoto_mini {
  border-radius: 50%;
}
.guestMessage{
	background: #FFFBF7;
border: 1px solid #eac794;
color: #b85f1d;
line-height: 140%;
margin-bottom: 15px;
padding: 10px;
text-shadow: rgba(255,255,255,0.55) 0px 1px 0px;
}

.guestMessage strong{ display: inline-block; margin-bottom: 2px; }

.guestMessage a{
	color: #b85f1d;
	text-decoration: none;
	border-bottom: 1px solid #d48041;
}

.scrollTop {
display: none;
position: fixed;
width: 3%;
top: 0;
left: 0;
height: 100%;
z-index: 9000;
cursor: pointer;
}
.scrollTop__side {
position: fixed;
width: 3%;
height: 100%;
top: 0;
left: 0;
background: black;
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
filter: alpha(opacity=0.2);
-moz-opacity: 0.1;
-khtml-opacity: 0.1;
opacity: 0.1;
}
.scrollTop__arrow {
position: fixed;
width: 3%;
height: 100%;
top: 50px;
left: 0;
background: url(http://ipbmafia.ru/public/style_images/mafiaboard/totop.png) top no-repeat;
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0.4)";
filter: alpha(opacity=0.4);
-moz-opacity: 0.4;
-khtml-opacity: 0.4;
opacity: 0.4;
}

/******************************************************
Reputation Bar
******************************************************/
.reputation-bg{
background:#e4e4e4;
background:-moz-linear-gradient(top, #e4e4e4 0%, #f7f7f7 100%);
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4e4e4), color-stop(100%,#f7f7f7));
background:-webkit-linear-gradient(top, #e4e4e4 0%,#f7f7f7 100%);
background:-o-linear-gradient(top, #e4e4e4 0%,#f7f7f7 100%);
background:-ms-linear-gradient(top, #e4e4e4 0%,#f7f7f7 100%);
background:linear-gradient(to bottom, #e4e4e4 0%,#f7f7f7 100%);
filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#e4e4e4', endColorstr='#f7f7f7',GradientType=0);
border:1px solid #e4e4e4;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px
}
.reputation-bar{
background:url('reputation_bar.png') repeat-x 0 0;
border:1px solid;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
box-shadow:inset 0 1px 0 rgba(255,255,255,0.3);
-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.3);
-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.3);
font:12px/23px Calibri,Arial,Tahoma,sans-serif;
height:21px;
margin:1px;
text-align:center;
text-shadow:0 1px 0 rgba(255,255,255,0.3)
}
.reputation-bar.gray{background-color:#a2a2a2;border-color:#6a6a6a;color:#6b6b6b}
.reputation-bar.red{background-color:#b00000;border-color:#910000;color:#6b0000}
.reputation-bar.blue{background-color:#008cd5;border-color:#006aa1;color:#00537f}
.reputation-bar.green{background-color:#20a601;border-color:#188000;color:#177a00}
.reputation-bar.gold{background-color:#ccb200;border-color:#b49d00;color:#958200}
.reputation-bar.width20{width:20%}
.reputation-bar.width40{width:40%}
.reputation-bar.width60{width:60%}
.reputation-bar.width80{width:80%}
div.messagebg {
  position: relative;
  padding: 10px;
  padding-left: 35px;
  margin: 30px 10px;
  box-shadow:0 2px 5px rgba(0,0,0,.3);
  background: #BBB;
  color: #FFF;
  
  -webkit-transition: all .5s ease;
     -moz-transition: all .5s ease;
      -ms-transition: all .5s ease;
       -o-transition: all .5s ease;
          transition: all .5s ease;
}
div.messagebg:hover{
  box-shadow: 0 15px 20px rgba(10,0,10,.3);
  -webkit-filter: brightness(110%);
}

div.messagebg:before{
  content: '';
  font-family: FontAwesome;
  position: absolute;
  display: block;
  top: -21px;
  left: 50%;
  margin:0 -21px;
  font-size: 20px;
  line-height: 24px;
  text-align: center;
  width: 24px;
  padding:10px;
  background: inherit;
  box-shadow:0 5px 10px rgba(0,0,0,.25);
  color: rgba(255,255,255,.75);
  border-radius:50%;
  border: 2px solid transparent;
  z-index: 2;
}

div.messagebg.information:before{content:'\f129';}
div.messagebg.announcement:before{content:'\f0f3';}
div.messagebg.success:before{content:'\f00c';}
div.messagebg.warning:before{content:'\f12a';}
div.messagebg.error:before{content:'\f00d';}

div.messagebg.information{background: #39B;}
div.messagebg.warning{background: #E74;}
div.messagebg.success{background: #5A6;}
div.messagebg.announcement{background: #EA0;}
div.messagebg.error{background: #C43;}
.member_title {
    background: #e9e9e9;
    height: 17px;
    display: inline-block;
    font-size: 14px;
    padding: 1px;
    width: 152px;
    text-align: center;
    font-size: 0.8em;
    color: #606060;
}

.user_block {
       color:#474747;
}

.wa-block {
       border-radius: 3px;
       -moz-border-radius: 3px;
       -webkit-border-radius: 3px;
       height: 21px;
    padding: 0 3px;
       width: 137px;
       text-align: left;
       background: #e9e9e9;
       margin: 4px auto;
}

.u-mini {
       float: right;
}

.psevdo {
       height: 3px;
}
.forumotv {
background: url(http://img.istvgames.uz/img/2015-11/23/h5h7n8hnjfao7m7to1gm7mzas.png) no-repeat;
width: 44px;
height: 44px;
float: right;
color: #d2d2d2;
text-align: center;
line-height: 44px;
cursor: pointer;
margin: 0 0px 0 0px;
}
.forumotv:hover {
background: url(http://img.istvgames.uz/img/2015-11/23/ag2hs6xn5ak4pr48ou3en146e.png) no-repeat;
color: #1ca800;
}
.forumtem {
background: url(http://img.istvgames.uz/img/2015-11/23/vjuzutxt85k8zjk27dxmgt1r4.png) no-repeat;
width: 44px;
height: 44px;
float: right;
text-align: center;
color: #d2d2d2;
line-height: 40px;
cursor: pointer;
}
.forumtem:hover {
background: url(http://img.istvgames.uz/img/2015-11/23/oxq0xygxqh6qz9arzpt4jcstw.png) no-repeat;
color: #1ca800;
}
#imgLeft{
margin:10px;
margin-left:10px;

}
#imgRight{
margin:10px;
margin-left:10px;

}]]></css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>ipb_common</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services 	*/
/************************************************************************/
/* ipb_common.css														*/
/************************************************************************/

	
/************************************************************************/
/* LIGHTBOX STYLES */

#lightbox{	position: absolute;	left: 0; width: 100%; z-index: 16000 !important; text-align: center; line-height: 0;}
#lightbox img{ width: auto; height: auto;}
#lightbox a img{ border: none; }
#outerImageContainer{ position: relative; background-color: #fff; width: 250px; height: 250px; margin: 0 auto; }
#imageContainer{ padding: 10px; }
#loading{ position: absolute; top: 40%; left: 0%; height: 25%; width: 100%; text-align: center; line-height: 0; }
#hoverNav{ position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 10; }
#imageContainer>#hoverNav{ left: 0;}
#hoverNav a{ outline: none;}
#prevLink, #nextLink{ width: 49%; height: 100%; background-image: url({style_images_url}/spacer.gif); /* Trick IE into showing hover */ display: block; }
#prevLink { left: 0; float: left;}
#nextLink { right: 0; float: right;}
#prevLink:hover, #prevLink:visited:hover { background: url({style_images_url}/lightbox/prevlabel.gif) left 15% no-repeat; }
#nextLink:hover, #nextLink:visited:hover { background: url({style_images_url}/lightbox/nextlabel.gif) right 15% no-repeat; }
#imageDataContainer{ font: 10px Verdana, Helvetica, sans-serif; background-color: #fff; margin: 0 auto; line-height: 1.4em; overflow: auto; width: 100%	; }
#imageData{	padding:0 10px; color: #666; }
#imageData #imageDetails{ width: 70%; float: left; text-align: left; }	
#imageData #caption{ font-weight: bold;	}
#imageData #numberDisplay{ display: block; clear: left; padding-bottom: 1.0em;	}			
#imageData #bottomNavClose{ width: 66px; float: right;  padding-bottom: 0.7em; outline: none;}
#overlay{ position: fixed; top: 0; left: 0; z-index: 15000 !important; width: 100%; height: 500px; background-color: #000; }

/************************************************************************/
/*  BBCODE STYLES */
/* 	NOTE: These selectors style bbcodes throughout IPB. It is recommended that you DO NOT change these 
	styles if you are creating a skin since it may interfere with user expectation
	of what certain BBCodes look like (quote boxes are an exception to this). */

strong.bbc				{	font-weight: bold !important; }
em.bbc 					{	font-style: italic !important; }
span.bbc_underline 		{ 	text-decoration: underline !important; }
acronym.bbc 			{ 	border-bottom: 1px dotted #000; }
span.bbc_center, div.bbc_center, p.bbc_center	{	text-align: center; display: block; }
span.bbc_left, div.bbc_left, p.bbc_left	{	text-align: left; display: block; }
span.bbc_right, div.bbc_right, p.bbc_right	{	text-align: right; display: block; }
div.bbc_indent 			{	margin-left: 50px; }
del.bbc 				{	text-decoration: line-through !important; }
.post.entry-content ul, ul.bbc, .as_content ul, .comment_content ul	{	list-style: disc outside; margin: 12px 0 12px 40px; }
	ul.bbc ul.bbc 			{	list-style-type: circle; }
		ul.bbc ul.bbc ul.bbc {	list-style-type: square; }
.post.entry-content ul.decimal,ul.bbcol.decimal, .post.entry-content ol, .post_body ol, .as_content ol		{ margin: 12px 0 12px 40px !important; list-style-type: decimal !important; }
	.post.entry-content ul.lower-alpha,ul.bbcol.lower-alpha		{ margin-left: 40px; list-style-type: lower-alpha; }
	.post.entry-content ul.upper-alpha,ul.bbcol.upper-alpha		{ margin-left: 40px; list-style-type: upper-alpha; }
	.post.entry-content ul.lower-roman	,ul.bbcol.lower-roman		{ margin-left: 40px; list-style-type: lower-roman; }
	.post.entry-content ul.upper-roman,ul.bbcol.upper-roman		{ margin-left: 40px; list-style-type: upper-roman; }

span.bbc_hr 			{ 	width:100%; display: block; border-top: 2px solid #777; height: 4px; }
div.bbc_spoiler 		{	 }
div.bbc_spoiler span.spoiler_title	{ 	font-weight: bold; }
div.bbc_spoiler_wrapper	{ }
div.bbc_spoiler_content	{ 	border: 1px inset #777; padding: 4px; }
input.bbc_spoiler_show	{ 	width: 70px; font-size: .9em; margin: 0px; padding: 0px; }

img.bbc_img { cursor: pointer; }
.signature img.bbc_img { cursor: default; }
	.signature a img.bbc_img { cursor: pointer; }

cite.ipb { display: none }

pre.prettyprint, code.prettyprint {
        background-color: #fafafa !important;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        -ms-border-radius: 4px;
        -khtml-border-radius: 4px;
        border-radius: 4px;
        color: #000000;
        padding: 5px;
        border: 1px solid #c9c9c9;
        overflow: auto;
        margin-left: 10px;
        font-size: 13px;
        line-height: 140%;
        font-family: monospace !important;
}

pre.prettyprint {
        width: 95%;
        margin: 1em auto;
        padding: 1em;
        /* white-space: pre-wrap; */
}

/* LEGACY @todo remove in IPS4 */
div.blockquote {
	font-size: 12px;
	padding: 10px;
	border-left: 2px solid #989898;
	border-right: 2px solid #e5e5e5;
	border-bottom: 2px solid #e5e5e5;
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
	background: #f7f7f7;
}

div.blockquote div.blockquote {
	margin: 0 10px 0 0;
}

div.blockquote p.citation {
	margin: 6px 10px 0 0;
}


/* Quote boxes */
p.citation {
    font-size: 12px;
    padding: 8px 10px;
    border: 3px solid #c0392b;
    border-bottom: 0;
    background: #e74c3c;
    color: #ecf0f1;
    font-weight: bold;
    margin-top: 5px;
    overflow-x: auto;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s linear;
        -ms-transition: all 0.3s linear;
        -o-transition: all 0.3s linear;
        transition: all 0.3s linear;
}
p.citation:hover {
    background: #c0392b;
}
blockquote.ipsBlockquote {
    font-size: 12px;
    padding: 10px;
    border: 3px solid #e3e3e3;
    border-top: 1px solid #e8e8e8;
    background: #ECF0F1;
    color: #1B1B1B;
    margin-bottom: 5px;
    margin: 0;
    overflow-x: auto;
}
blockquote.ipsBlockquote blockquote.ipsBlockquote {
	margin: 0 10px 0 0;
}

blockquote.ipsBlockquote p.citation {
	margin: 6px 10px 0 0;
}

blockquote.ipsBlockquote.built {
	border-top: none;
	-moz-border-top-right-radius: 0px;
	-webkit-border-top-left-radius: 0px;
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;

}

._sharedMediaBbcode {
	width: 500px;
	background: #f6f6f6;
	background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)); /* webkit */
	border: 1px solid #dbdbdb;
	-moz-box-shadow: 0px 1px 3px rgba(255,255,255,1) inset, 0px 1px 1px rgba(0,0,0,0.2);
	-webkit-box-shadow: 0px 1px 3px rgba(255,255,255,1) inset, 0px 1px 1px rgba(0,0,0,0.2);
	box-shadow: 0px 1px 3px rgba(255,255,255,1) inset, 0px 1px 2px rgba(0,0,0,0.2);
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #616161;
	display: inline-block;
	margin-right: 15px;
	margin-bottom: 5px;
	padding: 15px;
}

.bbcode_mediaWrap .details {
	color: #616161;
	font-size: 12px;
	line-height: 1.5;
	margin-left: 95px;
}

.bbcode_mediaWrap .details a {
	color: #616161;
	text-decoration: none;
}

.bbcode_mediaWrap .details h5, .bbcode_mediaWrap .details h5 a {
	font: 400 20px/1.3 "Helvetica Neue", Helvetica, Arial, sans-serif;
	color: #2c2c2c;
	word-wrap: break-word;
	max-width: 420px;
}

.bbcode_mediaWrap img.sharedmedia_image {
	float: left;
	position: relative;
	/*top: 10px;
	left: 10px;*/
	max-width: 80px;
}

.bbcode_mediaWrap img.sharedmedia_screenshot {
	float: left;
	position: relative;
	/*top: 10px;
	left: 10px;*/
	max-width: 80px;
}

/* Show my media label */
.cke_button_ipsmedia span.cke_label {
	display: inline !important;
}]]></css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>ipb_ckeditor</css_group>
    <css_content><![CDATA[/***************************************************************/
/* IP.Board 3.2 Editor CSS                                       */
/* ___________________________________________________________ */
/* By Matt Mecham					                            */
/***************************************************************/
/* Styles for the editor (colors in main css) */
/***************************************************************/

.as_content {
	background: #fff;
	font-size: 1.0em;
	border: 1px solid black;
	padding: 6px;
	margin: 8px;
	overflow: auto;
	max-height: 400px;
}
.as_buttons {
	text-align: right;
	padding: 4px 0px;
}
.as_message {
	display: inline-block;
}

.ipsEditor_textarea {
	width: 99%;
	height: 200px;
	font-size: 14px;
}
.cke_browser_webkit {outline:none !important;}
	
/* Main tool bar BG */
.cke_top {
	background: #E4EBF2 url({style_images_url}/editor/toolbar_bg.png) repeat-x !important;
}

/* Normal STD */
.cke_skin_ips textarea.cke_source {
	/* removed as causes pasted text to appear on one line: white-space: pre-line !important;*/
}

/* Minimized RTE */
.cke_skin_ips .cke_wrapper.minimized { 
	opacity: 0.6 !important;
	background: none !important;
	border: none !important;
}

/* Minimized STD */
.cke_skin_ips .cke_wrapper.minimized.std { 
	border: 2px solid #D5DDE5 !important;
}

/* Main Editor wrapper */
.cke_skin_ips { margin-bottom: 0px !important; }

.cke_skin_ips .cke_wrapper
{
	padding: 0px 5px 0px 3px !important;
	border: 1px solid #E1E3E5 !important;
	background-color: #EFF1F3 !important;
	background-image: none !important;
	box-shadow: none !important;
}

/* OFF state for editor buttons */
.cke_skin_ips .cke_toolgroup
{
	background-color: transparent !important;
}

/* HOVER 'off' button */
.cke_skin_ips .cke_button a:hover,
.cke_skin_ips .cke_button a:focus,
.cke_skin_ips .cke_button a:active	/* IE */
{
	background-color: #d5dde5 !important;
}

/* HOVER 'on' button */
.cke_skin_ips .cke_button a:hover.cke_on,
.cke_skin_ips .cke_button a:focus.cke_on,
.cke_skin_ips .cke_button a:active.cke_on	/* IE */
{
	background-color: #86caff !important;
}

/* Button group */
.cke_skin_ips .cke_toolgroup
{
	margin-right: 0px !important;
}

/* Button separator */
.cke_skin_ips .cke_separator
{
	border-left:solid 1px #c4cbd3;
	display:inline-block !important;
	float:left;
	height:30px;
	margin:-2px 2px 0;
}

/* DIALOG: Modal blind */
.cke_dialog_background_cover
{
	background-color: #3e3e3e !important;
}

/* DIALOG: Title - based on .maintitle */
.cke_skin_ips .cke_dialog_title
{
	background: #2c5687 url({style_images_url}/maintitle.png) repeat-x top !important;
	color: #fff !important;
	padding: 10px 10px 11px !important;
	font-size: 16px !important;
	font-weight: 300 !important;
	text-shadow: 0 1px 2px rgba(0,0,0,0.3);
	font-weight: normal;
}

/* Dialog: Body */
.cke_skin_ips .cke_dialog_body {
	z-index: 20000 !important;
}

/* Dialog tab bg (will usually match dialog title) */
.cke_skin_ips .cke_dialog_tabs {
	background: #2C5687 !important;
}

/* Dialog Title close button */
.cke_skin_ips .cke_dialog_close_button
{
	background: transparent url({style_images_url}/close_popup.png) no-repeat top left !important;
	width: 15px !important;
	height: 15px !important;
	top: 15px !important;
	right: 10px !important;
}

/* Dialog OK / Cancel buttons - based on ipsButton_secondary*/
.cke_skin_ips span.cke_dialog_ui_button
{
	height: 22px !important;
	line-height: 22px !important;
	font-size: 12px !important;
	color: #7c7c7c !important;
	padding: 0 10px !important;
	background: #f6f6f6 !important;
	background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%) !important; /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)) !important; /* webkit */
	border: 1px solid #dbdbdb !important;
	-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	-moz-border-radius: 3px !important;
	-webkit-border-radius: 3px !important;
	border-radius: 3px !important;
	color: #616161 !important;
	display: inline-block !important;
	white-space: nowrap !important;
}


/* Turn off resizer */
.cke_skin_ips .cke_dialog_footer .cke_resizer { display: none; }

/* Emo slide out tray */
.ipsSmileyTray
{
	position: relative;
	
	text-align: center;
	overflow: auto;
	margin: 0px auto 0px auto;
	padding: 4px 24px 4px 24px;
	min-width: 600px;
	width: 75%;
	height: 32px;
	border: 1px solid #D5DDE5;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	
	-moz-border-radius-topleft: 0px;
	-webkit-border-radius-topleft: 0px;
	border-top-left-radius: 0px;
	
	-moz-border-radius-topright: 0px;
	-webkit-border-radius-topright: 0px;
	border-top-right-radius: 0px;
	
	border-top: 0px;
	-moz-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
	
	background: #E4EBF2;
	overflow-y: hidden;
}
	.ipsSmileyTray img.bbc_emoticon {
		opacity: 0.8;
		cursor: pointer;
		margin: 6px 3px 0px 3px;
		max-width: 30px;
		max-height: 30px;
	 }
	 	.ipsSmileyTray img.bbc_emoticon:hover {
			opacity: 1.0;
	 	}
	
	.ipsSmileyTray .ipsSmileyTray_next {
		background: transparent url({style_images_url}/editor/next.png) no-repeat;
		background-position: 0px 10px;
		display: inline-block;
		/*float: right;
		position: relative;
		right: -20px;*/
		position: absolute;
		right: 5px;
		top: 4px;
		width: 13px;
		height: 30px;
		cursor: pointer;
	}
	
	.ipsSmileyTray .ipsSmileyTray_prev {
		background: transparent url({style_images_url}/editor/prev.png) no-repeat;
		background-position: 0px 10px;
		display: inline-block;
		/*position: relative;
		left: -20px;
		float: left;*/
		position: absolute;
		left: 5px;
		top: 4px;
		width: 13px;
		height: 30px;
		cursor: pointer;
	}
	
	.ipsSmileyTray_all {
		display: block;
		width: auto;
		margin: 3px auto 0px auto;
		text-align: center;
		cursor: pointer;
		font-size: 10px !important;
	}

/* Dialogs */
.cke_dialog.cke_single_page td.cke_dialog_contents {
	height: auto !important;
}

.cke_dialog .cke_dialog_ui_textarea { height: 130% !important }
	
/* ACP Specific */
table.cke_editor td { padding: 0px !important; }]]></css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>extracss</css_group>
    <css_content><![CDATA[#attach_wrap li.attachment {
  display: block;
}

.attachment-box {
  margin: 0 auto;
  max-width: 300px;
  border: 4px solid #9acfea;
  background: #fff;
  text-align: center;
}

.attachment-button a {
  display: inline-block;
  margin: 5px 0;
  padding: 4px;
  border: 1px solid #9acfea;
  border-radius: 2px;
  background-color: #d9edf7;
  background-image: -webkit-linear-gradient(top,#d9edf7 0,#b9def0 100%);
  background-image: linear-gradient(to bottom,#d9edf7 0,#b9def0 100%);
  color: #31708f;
  text-transform: uppercase;
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9edf7', endColorstr='#ffb9def0', GradientType=0);
}

.attachment-button a:hover {
  background-color: #b9def0;
  background-image: -webkit-linear-gradient(top,#b9def0 0,#d9edf7 100%);
  background-image: linear-gradient(to bottom,#b9def0 0,#d9edf7 100%);
}

.attachment-url {
  padding: 5px 0;
  background: #d9edf7;
}

.attachment-meta {
  padding: 5px 0;
  background: #d9edf7;
  color: #3F4249;
  font-size: 11px;
}]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>contact</css_group>
    <css_content>.contact * { -webkit-backface-visibility: hidden; }

.paper:hover { color:#000; }


.contact .envelope {
		position: absolute;
		height: 93px;
		width: 165px;
		right: 32%;
		;
		top: 50%;
		margin-top: -50px;
		background: #F9F9F9;
		
		transition: margin-top 300ms;
		-ms-transition: margin-top 300ms;
		-moz-transition: margin-top 300ms;
		-o-transition: margin-top 300ms;
		-webkit-transition: margin-top 300ms;
}
.contact:hover .envelope {
		transition-delay: 150ms;
		-ms-transition-delay: 150ms;
		-moz-transition-delay: 150ms;
		-o-transition-delay: 150ms;
		margin-top: -20px;
}
.contact .envelope .top {
		position: absolute;
		top: -3px;
		left: 0px;
		width: 100%;
		height: 73px;
		z-index: 30;
		overflow: hidden;
						
		transform-origin: top;
		-ms-transform-origin: top;
		-moz-transform-origin: top;
		-o-transform-origin: top;
		-webkit-transform-origin: top;
					
		transition: transform 300ms 150ms, z-index 0ms 150ms, height 300ms 0ms, top 300ms 0ms;
		-ms-transition: -ms-transform 300ms 150ms, z-index 0ms 150ms, height 300ms 0ms, top 300ms 0ms;
		-moz-transition: -moz-transform 300ms 150ms, z-index 0ms 150ms, height 300ms 0ms, top 300ms 0ms;
		-o-transition: -o-transform 300ms 150ms, z-index 0ms 150ms, height 300ms 0ms, top 300ms 0ms;
		-webkit-transition: -webkit-transform 300ms 150ms, z-index 0ms 150ms, height 300ms 0ms, top 300ms 0ms;
}
.contact:hover .envelope .top {
		transition: transform 300ms 0ms, height 300ms 150ms, top 300ms 150ms;
		-ms-transition: -ms-transform 300ms 0ms, height 300ms 150ms, top 300ms 150ms;
		-moz-transition: -moz-transform 300ms 0ms, height 300ms 150ms, top 300ms 150ms;
		-o-transition: -o-transform 300ms 0ms, height 300ms 150ms, top 300ms 150ms;
		-webkit-transition: -webkit-transform 300ms 0ms, height 300ms 150ms, top 300ms 150ms;
		
		height: 10px;
		top: -60px;
  
		transform: rotateX(180deg);
		-ms-transform: rotateX(180deg);
		-moz-transform: rotateX(180deg);
		-o-transform: rotateX(180deg);
		-webkit-transform: rotateX(180deg);
}
.contact .envelope .outer {
		position: absolute;
		bottom: 0px;
		left: 0px;
		border-left: 83px solid transparent;
		border-right: 82px solid transparent;
		border-top: 70px solid #EEE;
}
.contact .envelope .outer .inner {
		position: absolute;
		left: -81px;
		top: -73px;
		border-left: 81px solid transparent;
		border-right: 80px solid transparent;
		border-top: 68px solid #333;
}
.contact .envelope .bottom {
		position: absolute;
		z-index: 20;
		bottom: 0px;
		left: 2px;
		border-left: 81px solid transparent;
		border-right: 80px solid transparent;
		border-bottom: 45px solid #333;
}
.contact .envelope .left {
		position: absolute;
		z-index: 20; top: 0px;
		left: 0px;
		border-left: 81px solid #333;
		border-top: 45px solid transparent;
		border-bottom: 45px solid transparent;
}
.contact .envelope .right {
		position: absolute;
		z-index: 20;
		top: 0px;
		right: 0px;
		border-right: 80px solid #333;
		border-top: 45px solid transparent;
		border-bottom: 45px solid transparent;
}
.contact .envelope .cover {
		position: absolute;
		z-index: 15;
		bottom: 0px;
		left: 0px;
		height: 45%;
		width: 100%;
		background: #EEE;
}
.contact .envelope .paper {
		position: absolute;
		height: 82px;
		padding-top: 10px;
		width: 98.5%;
		top: 0px;
                border-top: solid 1px #000;
                border-left: solid 1px #000;
                border-right: solid 1px #000;
		left: 0px;
		background: #F9F9F9;
		z-index: 10;
		transition: margin-top 300ms 0ms;
		-ms-transition: margin-top 300ms 0ms;
		-moz-transition: margin-top 300ms 0ms;
		-o-transition: margin-top 300ms 0ms;
		-webkit-transition: margin-top 300ms 0ms;
}
.contact:hover .envelope .paper {
		margin-top: -60px;
		transition: margin-top 300ms 150ms;
		-ms-transition: margin-top 300ms 150ms;
		-moz-transition: margin-top 300ms 150ms;
		-o-transition: margin-top 300ms 150ms;
		-webkit-transition: margin-top 300ms 150ms;
}
.contact .envelope .paper a {
		position: relative;
		display: block;
		font-size: 14px;
		margin: 5px;
		margin-bottom: 0px;
		text-align: center;
		color: #333;
		text-decoration: none;
                font-size: 12px;
}

.contact .envelope .paper a {
		color: #333;
  
		transition: color 200ms;
		-ms-transition: color 200ms;
		-moz-transition: color 200ms;
		-o-transition: color 200ms;
		-webkit-transition: color 200ms;
}
.contact .envelope .paper a:hover {
		color: gray;
}
.contact .envelope .paper a.call:hover .i {
		border-color: #DDD;
}
.contact .envelope .paper a.mail .i {
		position: absolute;
		top: 0px;
		left: 17px;
		display: inline-block;
		font-size: 13px;
		font-weight: bold;
}</css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448797958</css_updated>
    <css_group>ipb_search</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services	*/
/************************************************************************/
/* ipb_search.css - Search results styles								*/
/************************************************************************/

.ipsFilterbar #search_sort .submenu_indicator
{
    width: 9px; height: 5px;
    background: #244156 url({style_images_url}/header_dropdown.png ) no-repeat;
    display: inline-block;
    /* Prevent padding in sort buttons */
}

#main_search_form .ipsBox_container { margin-bottom: 10px; }
#main_search_form .ipsField { margin-bottom: 20px; }

.toggle_notify_on { display: none; }
.show_notify .toggle_notify_on { display: block; }
	.show_notify input.toggle_notify_on { display: inline; }
    .show_notify a.ipbmenu { display: none; }
.show_notify .toggle_notify_off { display: none; }	

.notify_info span {
	padding: 1px 8px;
	background: #ededed;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	font-size: 10px;
	font-weight: bold;
	display: inline-block;
}
	
	.notify_info img { vertical-align: bottom; }

#main_search_form .search_app {
	font-size: 12px;
	display: inline-block;
	padding: 8px 10px 8px 8px;
	margin-right: 8px;
	font-weight: bold;
	cursor: pointer;
}

#main_search_form .search_app label{ cursor: pointer; vertical-align: middle; }
#main_search_form .search_app input{ margin: 0; margin-right: 1px; vertical-align: middle; }

	#main_search_form .search_app.active {
		background: url('{style_images_url}/trans40.png') repeat;
		background: rgba(0,0,0,0.4);
		-webkit-box-shadow: inset rgba(0,0,0,0.5) 0px 1px 2px;
		-moz-box-shadow: inset rgba(0,0,0,0.5) 0px 1px 2px;
		box-shadow: inset rgba(0,0,0,0.5) 0px 1px 2px;
		text-shadow: rgba(0,0,0,0.3) 0px 1px 2px;
		color: #fff;
		border-radius: 3px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
	}

#main_search_form .search_msg {
	border-bottom: 1px solid #f0f0f0;
	display: block;
	font-size: 12px;
	padding: 0 0 5px 200px;
	margin-bottom: 15px;
	color: #5c5c5c;
}

div#search_results {
	
}	
	
	div#search_results span.icon {
		float: left;
		margin-right: 15px;
	}
	
	div#search_results div.result_info {
		float: left;
		width: 68%;
	}
	
		div#search_results div.result_info span.desc.breadcrumb a {
			color: #a9a9a9;
		}
	
	div#search_results h3 {
		background: none;
		font-weight: normal;
		font-size: 1.3em;
		border: 0;
		padding: 0;
	}

	div#search_results li.liwrap {
		padding: 10px 15px 15px 15px;
		border-top: 1px solid #fff;
	}

	div#search_results p {
		color: #606060;
		margin: 4px 0 2px 0;
	}
	
	/* Further details */
	div#search_results .result_details {
		width: 30%;
		float: right;
		border-left: 1px solid #B5C0CF;
		padding-left: 15px;
		line-height: 130%;
		font-size: 11px;
	}
	
		div#search_results .result_details li {
			border: 0;
			padding: 0;
		}

	div#search_results .gutter {
		background-color: #528f6c;
		color: #fff;
		font-size: 9px;
		font-weight: bold;
		text-transform: uppercase;
		padding: 3px 8px 2px 8px;
		margin-top: 0px;
		margin-right: 15px;
		display: none;
		float: left;
	}

		div#search_results .gutter img {
			padding-right: 4px;
		}

	div#search_results .sub div.result_info {
		padding-left: 3%;/*padding-left: 45px;*/
	}

		div#search_results .sub .gutter {
			background-color: #dedede;
			color: #1d3652;
			padding: 6px 8px 5px 8px;
			margin-left: 45px;
		}

	div#search_results ol ol {
		padding: 20px 0 0 15px;
		margin: 0 0 -15px 20px;
	}
	
	.tab_filters ul {
		padding-top: 5px;
	}
	
	.tab_filters ul.padded
	{
		padding-top: 10px;
	}
	
/* as forum stuffs */
.maintitle.links,
.maintitle a {
	text-decoration: none;
	font-size: 12px;
}
.entry-content.search {}

/* These styles are duplicated Rikki, putting a note as requested */

.search_filter_container {
	height: 440px;
	max-height: 440px;
}
.search_filter_container ul.block_list {
	height: 396px; overflow: auto;
}
.search_filter_container ul.block_list > li {
	padding: 0px;
}

.search_filter_container ul.block_list > li span {
	padding: 3px 10px 3px 25px;
	display: block;
}

	.search_filter_container ul.block_list li span.heading {
		font-weight: bold;
	}

.search_filter_container ul.block_list li.active span {
	background: #af286d url({style_images_url}/icon_check_white.png ) no-repeat 6px 8px;
	color: #fff;
	font-weight: bold;
}

#vnc_filter_popup_close { 
	text-align: center;
	position: absolute;
	bottom: 0; left: 0;	right: 0;
	height: 42px;
	line-height: 42px;
	padding: 0 5px;
}

#vnc_filter_popup_close .input_submit{ line-height: 18px; }

#main_search_form .input_text{
	margin: 0 3px 2px 0;
}]]></css_content>
    <css_position>2</css_position>
    <css_app>core</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules>search</css_modules>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: forums

--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: members
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>8</css_set_id>
    <css_updated>1448207125</css_updated>
    <css_group>ipb_profile</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services	*/
/************************************************************************/
/* ipb_profile.css - Profile specific styles							*/
/************************************************************************/

#profile_photo { max-width: 138px; max-height: 138px; }
#profile_content_main {
	min-height: 75px;
	line-height: 1.3;
	margin-bottom: 20px;
}
#pane_info .ipsLayout_right { width: 260px !important; margin-right: -290px; }
#friends_overview .ipsUserPhoto_link { margin: 0 2px 5px 2px; display: inline-block; }

#profile_panes_wrap .reputation {
	float: none;
	margin: 0 0 5px 0;
	padding: 10px;
	text-align: center;
	font-weight: normal;
	display: block;
}
	#profile_panes_wrap .reputation .number {
		font-size: 20px;
		font-weight: bold;
		display: block;
	}

#profile_panes_wrap .ipsList_data .row_data {
	display: block;
	margin-left: 130px;
}

.warn_panel { text-align: center; margin: 8px 0; }
.photo_holder { position: relative; }
#change_photo {
position: absolute;
top: 0;
width: 100%;
height: 100%;
padding: 0;
left: 0;
background: rgba(0, 0, 0, 0.04);
color: #fff;
opacity: 0.1;
line-height: 125px;
-webkit-border-radius: 80px;
-moz-border-radius: 80px;
border-radius: 80px;
-webkit-transition: all 0.4s ease-in-out;
-moz-transition: all 0.4s ease-in-out;
}
	.photo_holder:hover #change_photo {
		opacity: 2;
		background: ;
	}
	
#user_info_cell {
	display: table-cell;
	white-space: nowrap;
	padding-right: 15px;
}
#user_status_cell {
	display: table-cell;
	width: 100%;
	vertical-align: top;
}
#user_latest_status {
	background: url({style_images_url}/stems/profile_status_stem.png ) no-repeat 0px 50%;
	padding-left: 11px;
}

#user_latest_status > div {
	padding: 10px 15px;
	background-color: #ebece5;
	color: #343434;
	font-size: 14px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	min-height: 45px;
	word-wrap: break-word;
}

#user_latest_status > div > span { display: block; }
#user_utility_links { margin-top: 10px; text-align: right; }
.rating { margin-top: 10px; }

#status_wrapper .ipsBox_container {
	margin-bottom: 9px;
}]]></css_content>
    <css_position>1</css_position>
    <css_app>members</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> Replacements Export:
<?xml version="1.0" encoding="utf-8"?>
<replacements>
  <replacement>
    <replacement_key>signin_icon</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/key.png' alt='{lang:macro__signin}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>send_msg</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/email_open.png' alt='{lang:pm_this_member}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>report_red_alert</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/reports/post_alert_1.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rep_down</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/rep_down.png' alt='-' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>report_green_alert</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/reports/post_alert_3.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rep_up</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/rep_up.png' alt='+' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_poll_question</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/cross.png' alt='-' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_friend</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/user_delete.png' alt='{lang:remove_friend}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_poll_choice</replacement_key>
    <replacement_content><![CDATA[<span class='cancel' title='{lang:remove_choice}'>&times;</span>]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rate_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star_off.png' alt='-' class='rate_img' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rate_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star.png' alt='*' class='rate_img' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>post_attach_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/attachicon.gif'	alt='{lang:macro__attachment}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>popular_post</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star_big.png' alt='*' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>pip_pip</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_black.png' alt='{lang:macro__pip}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>mini_rate_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star.png' alt='*' class='mini_rate' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lock_icon</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/lock.png' alt='{lang:pm_locked}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>mini_rate_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star_off.png' alt='-' class='mini_rate' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>live_small</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/live.gif' alt='{lang:macro__liveicon}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>live_large</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/live.gif' alt='{lang:macro__liveicon}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_windows</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/windows.png' alt='{lang:lim_windows}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_vkontakte</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/vkontakte.png' alt='{lang:lim_vkontakte}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_twitter</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/twitter.png' alt='{lang:lim_twitter}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_facebook</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/facebook.png' alt='{lang:lim_facebook}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_slideshow</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/gallery/pictures.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>generic_cog</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/cog.png' alt='+' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_image</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/gallery/image_add.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/picture.png' alt='{lang:view_gallery}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_album_delete</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/delete.png' alt='-' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>galery_album_edit</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_edit.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_new</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_page.png' alt='{lang:macro__new}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_generic</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_myconvo</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/email_go.png' alt='{lang:macro__myconvo}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_finished</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_empty</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bin.png' alt='{lang:empty_folder_title}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_delete</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/delete.png' alt='{lang:delete_folder_title}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>find_topics_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/page_topic_magnify.png' alt='{lang:find_topics}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_drafts</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_redirect</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_redirect.png' alt='{lang:macro__redirect}' title='{lang:macro__redirect}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadf}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readf}' title='{lang:macro__readf}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_pass_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadpw}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_nav_sep</replacement_key>
    <replacement_content>{lang:_rarr}</replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_pass_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readpw}' title='{lang:macro__readpw}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_newpost</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/new_post.png' alt='' title='{lang:first_unread_post}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_cat_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadcat}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_cat_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readcat}' title='{lang:macro__readcat}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>edit_folder</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_edit.png' alt='{lang:edit_folders}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>display_name</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/display_name.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>close_poll_form</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/accept.png' alt='x' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>dropdown</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/dropdown.png' alt='+' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/book_open.png' alt='{lang:view_blog}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_rss_import</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/rss-import.png' alt='' title='{lang:entry_imported_from_rss}' data-tooltip='{lang:entry_imported_from_rss}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_comments_new</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/comments_new.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_category</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='-' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_locked</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/lock.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_comments</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/comments.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_banish</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/layout_delete.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_poll_choice</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/add.png' alt='+' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_blog</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/blog.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>logo_img</replacement_key>
    <replacement_content>http://img.istvgames.uz/img/2016-01/07/m9bkvx6ftfz63xzinq2o4cm6l.png</replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>search_text</replacement_key>
    <replacement_content>Search in</replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_folder</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_add.png' alt='{lang:add_folder}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_friend</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/user_add.png' alt='{lang:add_friend}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_poll_question</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/add.png' alt='+' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>snapback</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/snapback.png' alt='{lang:macro__view_post}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>sort_up</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_arrow_up.png' alt='^' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>sort_down</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_arrow_down.png' alt='V' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>spammer_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/spammer_on.png' alt='{lang:spm_on}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_announcement</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_announcement.png' alt='{lang:announce_row}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>spammer_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/spammer_off.png' alt='{lang:spm_off}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_moved</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_moved.png' alt='{lang:pm_moved}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_closed</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_locked.png' alt='{lang:pm_locked}' /><br />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_read_dot</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_read_dot.png' alt='{lang:you_posted_here}' title='{lang:you_posted_here}' /><br />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_unread.png' alt='{lang:pm_open_new}' /><br />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_unread_dot</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_unread_dot.png' alt='{lang:you_posted_here}' /><br />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>topic_popup</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/topicpreview.png' alt='' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>your_vote</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star_rated.png' alt='{lang:macro__voted}' />]]></replacement_content>
    <replacement_set_id>8</replacement_set_id>
    <replacement_master_key/>
  </replacement>
</replacements>

--------------------------------------------------------------------------------
> Time: 1460357800 / Mon, 11 Apr 2016 06:56:40 +0000
> URL: /RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/index.php?adsess=9157f37a1ab83e382fd720a23c06df16&app=core&&module=templates&section=importexport&do=exportSet
> Info Export:
<?xml version="1.0" encoding="utf-8"?>
<info>
  <data>
    <set_name><![CDATA[IstvGames.uz[2]]]></set_name>
    <set_key>_1421660958</set_key>
    <set_author_name>mr.wosi</set_author_name>
    <set_author_url>skinod.com</set_author_url>
    <set_output_format>html</set_output_format>
    <set_master_key>root</set_master_key>
    <ipb_human_version>3.4.6</ipb_human_version>
    <ipb_long_version>34012</ipb_long_version>
    <ipb_major_version>3</ipb_major_version>
  </data>
</info>
