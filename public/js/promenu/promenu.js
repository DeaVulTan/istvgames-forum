( function($) {
	$.fn.hoverIntent = function(f, g) {
		// default configuration options
		var cfg = {
			sensitivity : 7,
			interval : 100,
			timeout : 0
		};
		// override configuration options with user supplied object
		cfg = $.extend(cfg, g ? {
			over : f,
			out : g
		} : f);

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function(ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};
		// A private function for comparing current and previous mouse position
		var compare = function(ev, ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if((Math.abs(pX - cX) + Math.abs(pY - cY) ) < cfg.sensitivity) {
				$(ob).unbind("mousemove", track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob, [ev]);
			} else {
				// set previous coordinates for next time
				pX = cX;
				pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout(function() {
					compare(ev, ob);
				}, cfg.interval);
			}
		};
		// A private function for delaying the mouseOut function
		var delay = function(ev, ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob, [ev]);
		};
		// A private function for handling mouse 'hovering'
		var handleHover = function(e) {
			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = $.extend({}, e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if(ob.hoverIntent_t) {
				ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			}

			// if e.type == "mouseenter"
			if(e.type == "mouseenter") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX;
				pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).bind("mousemove", track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if(ob.hoverIntent_s != 1) {
					ob.hoverIntent_t = setTimeout(function() {
						compare(ev, ob);
					}, cfg.interval);
				}

				// else e.type == "mouseleave"
			} else {
				// unbind expensive mousemove event
				$(ob).unbind("mousemove", track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if(ob.hoverIntent_s == 1) {
					ob.hoverIntent_t = setTimeout(function() {
						delay(ev, ob);
					}, cfg.timeout);
				}
			}
		};
		// bind the function to the two event listeners
		return this.bind('mouseenter', handleHover).bind('mouseleave', handleHover);
	};

	$.fn.ProMenu = function() {/* this is where the magic happens, all settings for what is to come is gathered here*/
		var MenuOut = function() {
			$(this).addClass("menu_active");
			if(click == 2 || click == 1) {
				$(this).parent().parent().find("ul").not($(this).parent().find("ul:first")).each(function() {
					if($(this).data("isOpen") == 1) {
						if(typeHide == "hide") {
							$(this).hide(du);
						} else if(typeHide == "slide") {
							$(this).slideUp(du);
						} else if(typeHide == "fade") {
							$(this).fadeOut(du);
						}
						$(this).data("isOpen", 0);
						$(this).prev().removeClass("menu_active");
					}
				});
			}
			
			if($(this).parent().find("ul:first").data("isOpen") != 1) {
				var w = ($(this).parent().parent().find('li').outerWidth() - 5), children = $(this).parent().find('ul:first'), docSize = $(window).width();
				if($(this).parent().find("ul:first").hasClass('right_open')) {
					if(!$(this).parents("ul:first").hasClass('root')) {
						children.css('left', w).css('top', topOffset);
						// jQuery can't get offset from hidden elements, so show, measure, then hide.
						children.show();
						var childW = children.outerWidth();
						var realLeft = children.offset().left + childW + 5;
						children.hide();
						if(realLeft >= docSize) {
							children.css('left', 5 - childW).css('top', topOffset + 6);
						}
					}
				} else {
	
					if(!$(this).parents("ul:first").hasClass('root')) {
						children.css('left', -w).css('top', topOffset);
						// jQuery can't get offset from hidden elements, so show, measure, then hide.
						children.show();
						var childW = children.outerWidth();
						var realLeft = children.offset().left - childW - 5;
						children.hide();
		
					var realLeft = $(this).parent().offset().left - childW + 5;
					if(0 >= realLeft) {
							children.css('left',w).css('top', topOffset + 6);
						}
					}
				}

				$(this).parent().find("ul:first").data("isOpen", 1);
				$(this).parent().find("ul:first").css('z-index',99999);

				if(typeShow == "show") {
					$(this).parent().find("ul:first").show(dd);
				} else if(typeShow == "slide") {
					$(this).parent().find("ul:first").slideDown(dd);
				} else if(typeShow == "fade") {
					$(this).parent().find("ul:first").fadeIn(dd);
				}
			} else {
				if(click == 2 || click == 1) {
					$(this).removeClass("menu_active");

					if(typeHide == "hide") {
						$(this).parent().find("ul:first").hide(du);
					} else if(typeHide == "slide") {
						$(this).parent().find("ul:first").slideUp(du);
					} else if(typeHide == "fade") {
						$(this).parent().find("ul:first").fadeOut(du);
					}
					$(this).parent().find("ul").data("isOpen", 0);
				}
			}
		}, MenuIn = function() {
			$(this).find("a").removeClass("menu_active");
			/*var self = $(this);
			 var index = 0;
			 var menuClose = setTimeout(function() {
			 self.children("ul").eq(index).data("isOpen", 0).slideUp(du);
			 index++;
			 }, 10);*/
			$(this).children("ul").each(function() {
				if($(this).data("isOpen") == 1) {
					$(this).data("isOpen", 0);
					if(typeHide == "hide") {
						$(this).hide(du);
					} else if(typeHide == "slide") {
						$(this).slideUp(du);
					} else if(typeHide == "fade") {
						$(this).fadeOut(du);
					}
				}
			});
		}, Nothing = function() {
		};
		if(click == 2) {
			$("body").click(function() {

			$(this).find("ul").each(function() {
				if($(this).data("isOpen") == 1) {
					$(this).prev().removeClass("menu_active");

					if(typeHide == "hide") {
						$(this).hide(du);
						$(this).data("isOpen", 0);
 

					} else if(typeHide == "slide") {
						$(this).data("isOpen", 0);
						$(this).slideUp(du);
					} else if(typeHide == "fade") {
						$(this).data("isOpen", 0);
						$(this).fadeOut(du);
					}
				}
			});

			});
			$(this).click(function(e) {
				
				$("body").find("ul").not($(this).andSelf().find('ul')).each(function() {
				if($(this).data("isOpen") == 1) {
					$(this).prev().removeClass("menu_active");

					if(typeHide == "hide") {
						$(this).hide(du);
						$(this).data("isOpen", 0);
					} else if(typeHide == "slide") {
						$(this).slideUp(du);
						$(this).data("isOpen", 0);						
					} else if(typeHide == "fade") {
						$(this).fadeOut(du);
						$(this).data("isOpen", 0);
					}
				}
			});
			e.stopPropagation();
			});
		}
		return this.each(function(e) {
			$(this).addClass('root');
			if(click == 0) {
//				$(".menucat", this).attr('href', 'javascript:void(0)');
				$("li:has(ul)", this).children("a").hoverIntent({
					over : MenuOut,
					timeout : 500,
					out : Nothing
				});
				$("li:has(ul)", this).hoverIntent({
					over : Nothing,
					timeout : 500,
					out : MenuIn
				});
			} else if(click == 1) {
				$("li:has(ul)", this).hover(function(e) {
					$("a:first", this).removeClass('menucat');
//					$("a:first", this).attr('href', 'javascript:void(0)');
				}, null);
				$("li.main:has(ul)", this).children("a").click(MenuOut);
				$("li:has(ul)", this).not(".main").children("a").hoverIntent({
					over : MenuOut,
					timeout : 500,
					out : Nothing
				});
				$("li:has(ul)", this).hoverIntent({
					over : Nothing,
					timeout : 500,
					out : MenuIn
				});
			} else if(click == 2) {
				$("li:has(ul)", this).hover(function(e) {
					$("a:first", this).removeClass('menucat');
//					$("a:first", this).attr('href', 'javascript:void(0)');
				}, null);
				//$("li.main:has(ul)", this).hoverIntent({over:Nothing,timeout:500,out:MenuIn});
				$("li:has(ul)", this).children("a").click(MenuOut);
			}
		});
	};


}(jQuery));
