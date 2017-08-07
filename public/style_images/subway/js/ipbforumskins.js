// Created by ipbforumskins.com
// You do not have permission to copy code or use this file without permission from IPBForumSkins.com

jQuery.noConflict();

jQuery(document).ready(function($){

	$('a[href=#top], a[href=#ipboard_body]').click(function(){
		$('html, body').animate({scrollTop:0}, 400);
        return false;
	});
	
	$(".forum_name").hover(function() {
		$(this).next(".forum_desc_pos").children(".forum_desc_con").stop()
		.animate({left: "0", opacity:1}, "fast")
		.css("display","block")
	}, function() {
		$(this).next(".forum_desc_pos").children(".forum_desc_con").stop()
		.animate({left: "10", opacity: 0}, "fast", function(){
			$(this).hide();
		})
	});
	
	$('#topicViewBasic').click(function(){
		$(this).addClass("active");
		$('#topicViewRegular').removeClass("active");
		$("#customize_topic").addClass("basicTopicView");
		$.cookie('ctv','basic',{ expires: 365, path: '/'});
		return false;
	});
	
	$('#topicViewRegular').click(function(){
		$(this).addClass("active");
		$('#topicViewBasic').removeClass("active");
		$("#customize_topic").removeClass("basicTopicView");
		$.cookie('ctv',null,{ expires: -1, path: '/'});
		return false;
	});
	
	if ( ($.cookie('ctv') != null))	{
		$("#customize_topic").addClass("basicTopicView");
		$("#topicViewBasic").addClass("active");
	}
	else{
		$("#topicViewRegular").addClass("active");
	}
	
	var customElements = ".cpe #primary_nav, .cpe .maintitle, .cpe #community_app_menu > li.active > a, .cpe .col_c_icon img[src*='f_'], .cpe .f_icon, .cpe .topic_buttons li a, .cpe .pagination .pages li.active, .cpe #primary_extra_menucontent, .cpe #more_apps_menucontent, .cpe .post_block h3, .cpe .mini_pagination a, .cpe .user_controls li a, .cpe #vnc_filter_popup_close, .cpe #search .submit_input, .cpe .col_f_icon img, .cpe .ipsBadge_green, body.cpe #logo, .cpe #themeToggle, .cpe #primary_extra_menucontent, .cpe #more_apps_menucontent, .cpe .submenu_container";

	var customText = ".cpe .forum_name a, .cpe .subforums a";
	
	var customBackground = 'body.cpe, #themeEditor #editPattern span, .cpe #socialLinks li, .cpe #secondary_navigation, .cpe ul.post_controls a:hover, .cpe .answerBadgeInPost, .cpe .ipsLikeButton.ipsLikeButton_enabled, .input_submit, .cpe .ipsTag';
	var customTextAlt = '.cpe ul.post_controls a';
	
	$("#themeEditor #editPrimary span").click(function(){
		var primaryColour = $(this).attr("data-primary");
		$("style#stylePrimary").html(customElements + '{ background-color: #' + primaryColour + '}' + customText + '{ color: #' + primaryColour + '}');
		$.cookie('customPrimary',primaryColour,{ expires: 365, path: '/'});
	});
	
	$("#themeEditor #editSecondary span").click(function(){
		var secondaryColour = $(this).attr("data-secondary");
		$("style#styleSecondary").html(customBackground + '{ background-color: #' + secondaryColour + '}' + customTextAlt + '{ color: #' + secondaryColour + '}');
		$.cookie('customSecondary',secondaryColour,{ expires: 365, path: '/'});
	});

	if ( ($.cookie('customPrimary') != null))	{
		$("style#stylePrimary").html(customElements + '{ background-color: #' + $.cookie('customPrimary') + '}' + customText + '{ color: #' + $.cookie('customPrimary') + '}');
	}
	else{
		$("style#stylePrimary").html(customElements + '{ background-color: #e04547 }' + customText + '{ color: #e04547 }');
	}
	
	if ( ($.cookie('customSecondary') != null))	{
		$("style#styleSecondary").html(customBackground + '{ background-color: #' + $.cookie('customSecondary') + '}' + customTextAlt + '{ color: #' + $.cookie('customSecondary') + '}');
	}
	else{
		$("style#styleSecondary").html(customBackground + '{ background-color: #55728b; }' + customTextAlt + '{ color: #55728b; }');
	}
	
	$("#themeToggle").click(function(){
		$("#themeEditorWrap").slideToggle();
	})

});