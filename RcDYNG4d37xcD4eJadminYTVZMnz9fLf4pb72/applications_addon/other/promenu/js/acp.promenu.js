(function( $ ){

    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }
        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };

	$.fn.CloseThem = function(){
		return this.each(function(){
			
			$('.isDraggable',this).each(function() {
				
				if($.cookie($(this).attr('id')) == 0 && $(this).find('#submenu_container').length != 0)
					{
						$(this).children().find("#closeDiv").removeClass('openit').addClass('closeit');
						$(this).find('#submenu_container').show();
					}
			
			});
			$("#closeDiv",this).click(function(){
				var men = $(this).parents('div.isDraggable').attr('id');

				if($.cookie(men) == 1 || !$.cookie(men))
				{
						$.cookie(men,'0',{expires:365,path: '/'});
						$(this).removeClass('openit').addClass('closeit');
						$(this).parents('div.isDraggable').find('#submenu_container').show();
					}
					else{

						$.cookie(men,'1',{expires:365,path: '/'});
						$(this).removeClass('closeit').addClass('openit');
						$(this).parents('div.isDraggable').find('#submenu_container').hide();
				}
			});
		});
	};
	$.fn.PreviewSort = function PreviewSort(type, options) {
		var defaults = {
			'main': {
				handle: '.draghandle',
				items: 'div.isDraggable',
				opacity: 0.6,
				revert: false,

				tolerance:'pointer',
				sendType: 'get',
				distance:10,	
				axis:'y',
				scrollSensitivity:20,
				scrollSpeed:2
			}
		};
			
		return this.each(function(){
			var x = ( $.undefined( defaults[type] ) ) ? defaults['custom'] : defaults[type];
			var o = $.extend( x, options );
			
			// If there's no function defined already, and a URL is specified, set up
			// an ajax call
			if( $.undefined( o['update'] ) && !$.undefined( o['url'] ) )
			{ 
				o['update'] = function( e, ui )
				{
					if ( ! Object.isUndefined( o['callBackUrlProcess'] ) )
					{
						o['url'] = o['callBackUrlProcess']( o['url'] );
					}
				
					var serial = $(this).sortable("serialize", ( o['serializeOptions'] || {} ) );
					
					$.ajax( {
						url: o['url'].replace( /&amp;/g, '&' ),
						type: o['sendType'],
						data: serial,
						processData: false,
						beforeSend: function(data){
							if($('#ajax_loading').length == 0)
							{
								$('#ipboard_body').prepend( ipb.templates['ajax_loading'] );
							}
							$('#ajax_loading').fadeIn(100);		
						},
						success: function(data){
							
							if( data['error'] )
							{
								alert( data['error'] );
								if( data["__session__expired__log__out__"] ){
									window.location.reload();
								}
							}
							else
							{
								Debug.write("Sortable update successfully posted");
							}

							if ( ! Object.isUndefined( o['postUpdateProcess'] ) )
							{
								o['postUpdateProcess']( data );
								
							}
						},
						complete:function(){

							$('#ajax_loading').fadeOut(100);
						},
						error: function(){
							alert( ipb.lang['session_timed_out'] );
							window.location.reload();
						}
					});
				}
			}
			
			     $(this ).sortable( o );

		});
		
	};
 }(jQuery));