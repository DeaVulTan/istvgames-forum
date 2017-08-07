var _skinod = window.IPBoard;
_skinod.prototype.skinod = {
	init: function() {
		var newmenu = Class.create(_menu.prototype.Menu, {
			doOpen: function($super,elem)
			{
				$super();
				var _source = ( this.options.positionSource ) ? this.options.positionSource : this.source;
			
				if ( ! Object.isUndefined( elem ) )
				{
					var _source = elem;
				}
				var _sourcePos		= $( _source ).cumulativeOffset();
				var _offset			= $( _source ).cumulativeScrollOffset();
				var realSourcePos	= { top: _sourcePos.top - _offset.top, left: _sourcePos.left - _offset.left };
				var menuDim			= { width: $( this.target ).measure('border-box-width'), height: $(this.target).measure('border-box-height') };
				var screenDim		= document.viewport.getDimensions();
				if( ( realSourcePos.left + menuDim.width ) > screenDim.width ){
					this.target.addClassName('leftopen');
				}
			},
			doClose: function()
			{
				new Effect.Fade( $( this.target ), { duration: 0.3, afterFinish: function(e){
						if( Object.isFunction( this.callbacks['afterClose'] ) )
						{
							this.callbacks['afterClose']( this );
						}
						if($( this.target ).hasClassName('leftopen')) {
							$( this.target ).removeClassName('leftopen');
						}
				 }.bind( this ) } );
				this.source.removeClassName('menu_active');
			},
		});
		_menu.prototype.Menu = newmenu;
		if(ipb.vars['sodshownewsearch']) ipb.global.contextualSearch = ipb.skinod.contextualSearch;
		document.observe('dom:loaded',function(){
			$('totop').observe('click',function(e){
				Event.stop(e);
				new Effect.ScrollTo( document.body, { duration: .3, transition: Effect.Transitions.sinoidal, offset: -50 } );
			});
		});
		
	},
	contextualSearch: function()
	{
		if( !$('search_options') && !$('search_options_menucontent') ){ return; }
		
		if ( ! $('main_search') )
		{
			return;
		}
		
		$('main_search').defaultize( ipb.lang['search_default_value'] );
		
		// This removes the text for IE7
		$('search').select('.submit_input').find( function(elem){ $(elem).value = ''; } );
		
		var update = function( noSelect )
		{
			var checked = $('search_options_menucontent').select('input').find( function(elem){
				return $(elem).checked; 
			});
			$('search_options_menucontent').select('input').each(function(elem) {
				$('search_options_ico').removeClassName($( elem ).up('label').readAttribute('for'));
			});
			if( Object.isUndefined( checked ) ){ 
				checked = $('search_options_menucontent').select('input:first')[0];
				if( !checked ){ return; }
				checked.checked = true;
			}
			$('search_options').show();
			$('search_options_ico').show().addClassName( $( checked ).up('label').readAttribute('for') || '' );
			
			if( ipb.global._supportsPlaceholder ){
				$('main_search').placeholder = ipb.lang['search_default_value'] + ' ' + $( checked ).up('label').readAttribute('title');
			}
			
			// Put cursor in search box
			if( noSelect != true ){
				$('main_search').focus();
			}
			
			return true;
		};
		update(true);
		
		$('search_options_menucontent').select('input').invoke('observe', 'click', update);
	},
}
ipb.skinod.init();