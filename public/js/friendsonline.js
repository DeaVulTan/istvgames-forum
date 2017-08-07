var _friendsonline = window.IPBoard;

_friendsonline.prototype.friendsonline = {

	menu:		null,
	popup:		null,
	
	/* Constructor */
    init: function()
    {
        Debug.write( "Initializing ips.friendsonline.js" );

        document.observe("dom:loaded", function()
        {
        });
    },

    grabFriendsOnline: function(element, e)
    {
        if ( Object.isUndefined( ipb.global.popups[ 'online' ] ) )
        {
            ipb.global.popups[ 'online' ] = true;
            ipb.menus.closeAll(e);
            
            $(element).identify();
            
            $(element).addClassName( 'ipbmenu' );
            
            $( 'ipboard_body' ).insert( ipb.templates[ 'header_menu' ].evaluate( { id: 'friendsonline_menucontent' } ) );
            
            $( 'friendsonline_menucontent' ).setStyle( 'width: 300px' ).update( "<div class='ipsPad ipsForm_center'><img src='" + ipb.vars['loading_img'] + "' /></div>" );
            
            var _newMenu = new ipb.Menu( $(element), $( "friendsonline_menucontent" ) );
            _newMenu.doOpen();          
            
            var url = ipb.vars['base_url'] + 'app=members&module=ajax&section=friendsonline';
            Debug.write( url );
            new Ajax.Request(   url,
                                {
                                    method:   'post',
                                    evalJSON: 'force',
                                    hideLoader: true,
                                    parameters: {
                                        secure_key: ipb.vars['secure_hash']
                                    },
                                    onSuccess: function(t)
                                    {
                                        if( t.responseJSON['error'] )
                                        {
                                            if ( t.responseJSON['__board_offline__'] )
                                            {
                                                ipb.global.errorDialogue( ipb.lang['board_offline'] );
                                                ipb.menus.closeAll(e);
                                            }
                                        }
                                        else
                                        {
                                            $( 'friendsonline_menucontent' ).update( t.responseJSON['html'] );
                                        }
                                    }
                                }
                            );
        }
        
        Event.stop(e);
        return false;
    }

};

ipb.friendsonline.init();