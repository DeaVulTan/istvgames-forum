/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.1
 * Last Updated: August 30, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.0.6 (Revision 10006)
 */

var _notes = window.IPBoard;

_notes.prototype.notes = {
	toRemove: null,
	popup: null,
	
	init: function ()
	{
		Debug.write("Initializing postnotes.js");
		
		document.observe("dom:loaded", ipb.notes.startObserve);
	},
	
	startObserve: function (e)
	{
		$$('.pn-note').each(function (e) {
			Event.stopObserving(e);
			e.observe('click', ipb.notes.showForm);
		});
		
		$$('.pnmessage').each(function (e) {
			if (e.id.match(/pnn-(\d+)/))
			{
				var pnn = RegExp.$1;
				$('pnc-' + pnn).hide();

				/* Show "x" button only when mouse is over the note */
				Event.stopObserving(e);
				e.observe('mouseover', function (f)
				{
					$('pnc-' + pnn).show();
				});
				e.observe('mouseout', function (f)
				{
					$('pnc-' + pnn).hide();
				});
			}
		});
		
		$$('.pn-cross').each(function (e)
		{
			Event.stopObserving(e);
			e.observe('click', ipb.notes.removeNote);
		});
	},
	
	showForm: function (e) {
		if (e) Event.stop(e);
		
		var tgt = ((e.target) ? e.target : e.srcElement);
		tgt = (tgt.tagName.toUpperCase() != 'A') ? tgt.parentNode : tgt;

		var pid = tgt.id.replace('pn_', '');
		var url = tgt.href + "&style=ajax&secure_key=" + ipb.vars['secure_hash'];

		/* Show Popup with form to create a new note */
		ipb.notes.popup = new ipb.Popup('postForm', {
			type: 'baloon',
			modal: false,
			stem: true,
			w: '535px',
			h: '200px',
			ajaxURL: url,
			hideAtStart: false,
			close: 'a[rel="close"]'
		}, {
			'afterHide': ipb.notes.removePopup
		});
		return false;
	},
	
	formSubmit: function (e) {
		if (e) Event.stop(e);

		/* Serialize form data to send it as POST */
		var tgt = $('pn-form');
		var serial = tgt.serialize(true);

		var url = tgt.action + "&secure_key=" + ipb.vars['secure_hash'] + '&style=ajax';

		new Ajax.Request(url, {
			method: 'post',
			evalJSON: 'force',
			parameters: serial,
			onSuccess: function (t)
			{
				/*
				 * Get an error?
				 */
				if (t.responseJSON['error'])
				{
					alert(t.responseJSON['error']);
				} else {
					/* Remove Popup with form */
					if (ipb.notes.popup !== undefined)
					{
						ipb.notes.popup.hide();
						ipb.notes.removePopup();
					}

					/* Create a new element and insert a new note inside of it */
					var elem = document.createElement('DIV');
					elem.innerHTML = t.responseJSON['html'];

					/* Get list of div elements inside of current post */
					var child = $('post_id_' + t.responseJSON['pid']).getElementsByClassName('post_body');
					var divs = child[0].getElementsByTagName('div');
					var note = elem.lastChild;

					/* And select div which is a post entry or another message */
					var after = null;
					for (i = 0; i < divs.length; i++) {
						if (divs[i].hasClassName('pnmessage') || divs[i].hasClassName('entry-content'))
						{
							after = divs[i];
						} else if (after)
						{
							break;
						}
					}

					/* Insert prepared note after the last note or post entry */
					child[0].insertBefore(note, after.nextSibling);
					delete elem;

					/* Make it visible and set up observers */
					new Effect.Appear(note, { duration: 0.8	});
					setTimeout("ipb.notes.startObserve()", 1000);
				}
			}
		});
	},
	
	removeNote: function (e) {
		if (e) Event.stop(e);
		
		var tgt = ((e.target) ? e.target : e.srcElement);
		tgt = (tgt.tagName.toUpperCase() != 'A') ? tgt.parentNode : tgt;

		/* One question before removing a note */	
		if (tgt && tgt.href && confirm(ipb.lang['pn_do_you'] ? ipb.lang['pn_do_you'] : 'Do you really want to remove this note ?'))
		{
			var url = tgt.href;
			new Ajax.Request(url, {
				method: 'post',
				evalJSON: 'force',
				parameters: {
					'secure_key': ipb.vars['secure_hash'],
					'style': 'ajax'
				},
				onSuccess: function (t) {
					if (t.responseJSON['error'])
					{
						alert(t.responseJSON['error']);
					} else
					{
						/* Remember the note to use it in after 0.5second */
						if (t.responseJSON['msg'] != "") {
							ipb.notes.toRemove = $('pnn-' + t.responseJSON['pnid']);
							if (ipb.notes.toRemove)
							{
								/* Hide note and set timer */
								new Effect.Fade(ipb.notes.toRemove, {duration: 0.3});
								setTimeout('ipb.notes.toRemove.remove(ipb.notes.toRemove)', 500);
							}
						}
					}
				}
			});
		}
		return false;
	},
	
	removePopup: function () {
		if (ipb.notes.popup === undefined) return false;
		
		var el = ipb.notes.popup.getObj();

		/* If Popup exists remove it */
		if (el) el.parentNode.removeChild(el)
		
		delete ipb.notes.popup;
	}
};

ipb.notes.init();
