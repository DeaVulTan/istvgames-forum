$.noConflict();
jQuery( document ).ready(function( $ ) {
	
	"use strict";
	
	
	/* Global Variables */
	
	var window_w = $(window).width(); // Window Width
	var window_h = $(window).height(); // Window Height
	var window_s = $(window).scrollTop(); // Window Scroll Top
	
	var $html = $('html'); // HTML
	var $body = $('body'); // Body 
	var $header = $('#header');	// Header 
	var $footer = $('#footer');	// Footer
	
	
	// On Resize
	$(window).resize(function(){
		
		window_w = $(window).width();
		window_h = $(window).height();
		window_s = $(window).scrollTop();
		
	});
	
	// On Scroll
	$(window).scroll(function(){
	
		window_s = $(window).scrollTop();
		
	});
	
	
	/* Modernizr Fix */
	
	var supportPerspective = Modernizr.testAllProps('perspective');
	if(supportPerspective)
		$html.addClass('csstransforms3d');
	else
		$html.addClass('notcsstransforms3d');
	
	
	
	
	
	/* Main Functions */
	
	
	/* Layout Options */
	
	enableStickyHeader(); // Sticky Header 
	
	enableFullWidth(); // Full Width Section
	
	enableContentAnimation(); // Content Animation
	
	enableSpecialCssEffects(); // CSS Animations
	
	enableBackToTop(); // Back to top button
	
	enableMobileNav(); // Mobile Navigation
	

	
	
	/* Elements */
	
	enableSocialShare(); // Social Share Buttons
	
	/* ============================== */
	/* 			FUNCTIONS		      */
	/* ============================== */

	/* Sticky Header */
	function enableStickyHeader(){
		
		var resolution = 991;
		
		if($body.hasClass('tablet-sticky-header'))
			resolution = 767
		
		if(window_w > resolution && !$body.hasClass('boxed-layout')){
			$header.addClass('sticky-header');
			var header_height = $header.innerHeight();
			$body.css('padding-top', header_height+'px');
		}
		
		$(window).scroll(function(){
			animateHeader();
		});
		
		$(window).resize(function(){
		
			animateHeader();
			
			if(window_w < resolution || $body.hasClass('boxed-layout')){
			
				$header.removeClass('sticky-header').removeClass('animate-header');
				$body.css('padding-top', 0+'px');
				
			}else{
				
				$header.addClass('sticky-header');
				var header_height = $header.innerHeight();
				$body.css('padding-top', header_height+'px');
				
				
			}
			
		});
		
		function animateHeader(){
			
			if(window_s>100){
				
				$('#header.sticky-header').addClass('animate-header');
				
			}else{
				
				$('#header.sticky-header').removeClass('animate-header');
				
			}
			
		}
		
	}
	
	function enableFullWidth(){
		
		// Full Width Elements
		var $fullwidth_el = $('.full-width, .full-width-slider');
		
		
		// Set Full Width on resize
		$(window).resize(function(){
			
			setFullWidth();
			
		});
		
		// Fix Full Width at Window Load
		$(window).load(function(){
			
			setFullWidth();
			
		});
		
		// Set Full Width Function
		function setFullWidth(){
			
			$fullwidth_el.each(function(){
		
				var element = $(this);
				
				// Reset Styles
				element.css('margin-left', '');
				element.css('width', '');	
				
				
				if(!$body.hasClass('boxed-layout')){
					
					var element_x = element.offset().left;
					
					// Set New Styles
					element.css('margin-left', -element_x+'px');
					element.css('width', window_w+'px');	
				
				}
				
			});
			
		}
		
	}

	/* Flickr Feed */
	function enableFlickrFeed(){
		
		$('.flickr-feed').jflickrfeed({
			limit: 6,
			qstrings: {
				id: '76745153@N04'
			},
			itemTemplate: 
			'<li>' +
				'<a href="{{link}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" /></a>' +
			'</li>'
		});
		
	}

	/* Instagram Feed */
	function enableInstagramFeed(){
		
		if($('#instagram-feed').length){
			var instagram_feed = new Instafeed({
				get: 'popular',
				clientId: '0ce2a8c0d92248cab8d2a9d024f7f3ca',
				target: 'instagram-feed',
				template: '<li><a target="_blank" href="{{link}}"><img src="{{image}}" /></a></li>',
				resolution: 'standard_resolution',
				limit: 6
			});
			instagram_feed.run();
		}
		
	}

	/* Twitter Feed */
	function enableTwitterFeed(){
		
		/* Twitter WIdget */
		$('.twitter-widget').tweet({
			modpath: 'php/twitter/',
			count: 1,
			loading_text: 'Loading twitter feed...',
		})
		
		/* Twitter Share Button */
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
		
	}

	/* Content Animation */
	function enableContentAnimation(){
		
		if($html.hasClass('cssanimations')){
		
			$('.animate-onscroll').animate({opacity:0},0);
			
			
			$(window).load(function(){
				
				$('.animate-onscroll').filter(function(index){
					
					return this.offsetTop < (window_s + window_h);
					
				}).each(function(index, value){
					
					var el = $(this);
					var el_y = $(this).offset().top;
					
					if((window_s) > el_y){
						$(el).addClass('animated fadeInDown').removeClass('animate-onscroll').removeClass('animated fadeInDown');
					}
					
				});
				
				animateOnScroll();
				
			});
			
			$(window).resize(function(){
				animateOnScroll();
			});
			
			$(window).scroll(function(){
				animateOnScroll();
			});
		
		}
		
		// Start Animation When Element is scrolled
		function animateOnScroll(){
			
			$('.animate-onscroll').filter(function(index){
					
				return this.offsetTop < (window_s + window_h);
				
			}).each(function(index, value){
				
				var el = $(this);
				var el_y = $(this).offset().top;
				
				if((window_s + window_h) > el_y){
				
					setTimeout(function(){
					
						$(el).addClass('animated fadeInDown');
						
						setTimeout(function(){
							$(el).removeClass('animate-onscroll');
						}, 500);
						
						setTimeout(function(){
							$(el).css('opacity','1').removeClass('animated fadeInDown');
						},2000);
						
					},index*200);
					
				}
				
			});
			
		}
		
	}

	/* Special CSS Effects */
	function enableSpecialCssEffects(){
		
		/* Sidebar Banner Hover Effect */
		$('.banner').each(function(){
			
			var new_icon = $(this).find('.icons').clone().addClass('icons-fadeout');
			$(this).prepend($(new_icon));
			
		});
		
		
		/* Firefox Pricing Tables Height Fix */
		$(window).load(function(){
			fixPricingTables();
		});
		
		$(window).resize(function(){
			fixPricingTables();
		});
		
		/* Fix Pricing Tables */
		function fixPricingTables(){
			
			$('.pricing-tables').each(function(){
				
				$(this).find('.pricing-table').attr('style', '');
				
				if(window_w > 767){
					var pricing_tables_h = $(this).height();
					$(this).find('.pricing-table').innerHeight(pricing_tables_h);
				}
				
			});
			
		}
		
		/* Sorting Float Fix */
		
		$(window).load(function(){
			mediaSortFix();
		});
		
		$(window).resize(function(){
			mediaSortFix();
		});
		
		function mediaSortFix(){
			if(window_w > 767){
				var media_item_height = 0;
				$('.media-items .mix').css('height','');
				
				$('.media-items .mix').each(function(){
					if($(this).height() > media_item_height)
						media_item_height = $(this).height();
				});
				$('.media-items .mix').height(media_item_height);
			}else{
				$('.media-items .mix').css('height','');
			}
		}
		
	}

	
	/* Back To Top Button */
	function enableBackToTop(){
		
		$('#button-to-top').hide();
		
		/* Show/Hide button */
		$(window).scroll(function(){
			
			if(window_s > 100 && window_w > 991){
				$('#button-to-top').fadeIn(300);
			}else{
				$('#button-to-top').fadeOut(300);
			}
			
		});
		
		$('#button-to-top').click(function(e){
			
			e.preventDefault();
			$('body,html').animate({scrollTop:0}, 600);
			
		});
		
	}

	/* Mobile Navigation */
	function enableMobileNav(){
		
		/* Menu Button */
		$('#menu-button').click(function(){
			
			if(!$('#community_app_menu').hasClass('community_app_menu-opened')){
				
				$('#community_app_menu').slideDown(500).addClass('community_app_menu-opened');
				
			}else{
				
				$('#community_app_menu').slideUp(500).removeClass('community_app_menu-opened');
				
			}
			
		});
		
		
		/* On Resize */
		$(window).resize(function(){
			
			if(window_w > 991){
				
				$('#community_app_menu').show().attr('style','').removeClass('community_app_menu-opened');
				
			}
			
		});
		
		
		/* Dropdowns */
		$('#community_app_menu li').each(function(){
			
			if($(this).find('ul').length > 0){
				$(this).append('<div class="dropdown-button"></div>');
			}
			
		});
		
		$('#community_app_menu .dropdown-button').click(function(){
			
			$(this).parent().toggleClass('dropdown-opened').find('>ul').slideToggle(300);
			
		});
		
		
	}
	
	/* Social Share Buttons */
	function enableSocialShare(){
		
		$('.social-share').each(function(){
			
			var page_url = encodeURIComponent(document.URL);
			
			$(this).find('.facebook>a').attr('href', 'http://www.facebook.com/sharer/sharer.php?u='+page_url).attr('target','_blank');
			$(this).find('.twitter>a').attr('href', 'https://twitter.com/home?status='+page_url).attr('target','_blank');
			$(this).find('.google>a').attr('href', 'https://plus.google.com/share?url='+page_url).attr('target','_blank');
			$(this).find('.pinterest>a').attr('href', 'http://pinterest.com/pin/create/button/?url='+page_url).attr('target','_blank');
			
		});	
		
	}

});
