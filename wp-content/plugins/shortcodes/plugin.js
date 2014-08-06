//Check TinyMCE version
var tmce_ver=window.tinyMCE.majorVersion;

(function() {
    if (tmce_ver>="4") {
	    tinymce.PluginManager.add('tk_button', function(editor, url){
	        editor.addButton('tk_button', {
	            tooltip: 'Insert shortcode',
	            icon: ('icon tkingdom-own-icon'),
	            type: 'menubutton',
	            menu: [
		            	{
		            		text: 'Row',
		            		classes: 'row',
		            		value: 'Put your Columns here.',
		            		onclick: row_showPopUp
		           		},
		           		{
		            		text: 'Columns',
		            		classes: 'columns',
		            		onclick: function() {
		            			showPopUp('columns');
		            		}
		           		},
		           		{
		            		text: 'Buttons',
		            		classes: 'buttons',
		            		onclick: function() {
		            			showPopUp('button');
		            		}
		           		},
		           		{
		            		text: 'Toggle Content',
		            		classes: 'toggle',
		            		onclick: function() {
		            			showPopUp('toggle');
		            		}
		           		},
		           		{
		            		text: 'Tabbed Content',
		            		classes: 'tabbed',
		            		onclick: function() {
		            			showPopUp('tabbed');
		            		}
		           		},
		           		{
		            		text: 'Accordion Content',
		            		classes: 'accordion',
		            		onclick: function() {
		            			showPopUp('accordion');
		            		}
		           		},
		           		{
		            		text: 'Dropcap',
		            		classes: 'dropcap',
		            		onclick: function() {
		            			showPopUp('dropcap');
		            		}
		           		},
		           		{
		            		text: 'Infobox',
		            		classes: 'infobox',
		            		onclick: function() {
		            			showPopUp('infobox');
		            		}
		           		},
		           		{
		            		text: 'Progress Bar',
		            		classes: 'progress',
		            		onclick: function() {
		            			showPopUp('progressbar');
		            		}
		           		},
		           		{
		            		text: 'Pricing Tables',
		            		classes: 'pricing',
		            		onclick: function() {
		            			showPopUp('pricing');
		            		}
		           		},
		           		{
		            		text: 'Icons',
		            		classes: 'icons',
		            		onclick: function() {
		            			showPopUp('icons');
		            		}
		           		},
		           		{
		            		text: 'Fullwidth Section',
		            		classes: 'fullwidth',
		            		onclick: function() {
		            			showPopUp('fullwidth');
		            		}
		           		}
		           ]
	        });

	        //Insert row shortcode
		    function row_showPopUp(){
				editor.insertContent('[row]' + this.value() + '[/row]');
		    }

		    //Show popup
		    function showPopUp(popup){
		    	tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
		    }
	    });
 	} //End if TinyMCE 4 or higher
 	else{
 		tinymce.create("tinymce.plugins.shortcodes",{
			init: function ( ed, url )
			{
	            ed.addCommand("popup", function ( a, params )
				{
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
				});
			},
			createControl: function ( btn, e )
			{
				if ( btn == "tk_button" )
				{	
					var a = this;

					btn = e.createMenuButton("tk_button",
					{
						title: "Insert Shortcode",
	                    // change theme name, for default theme it's foundation
						image: "../wp-content/plugins/shortcodes/css/img/shortcodes-icon.png",
						icons: false
					});
					
					btn.onRenderMenu.add(function (c, b)
					{
	                    a.addImmediate( b, "Row", "[row]Put your Columns here.[/row]" );
						a.addWithPopup( b, "Columns", "columns" );
						a.addWithPopup( b, "Buttons", "button" );
	                    a.addWithPopup( b, "Toggle Content", "toggle" );
	                    a.addWithPopup( b, "Tabbed Content", "tabbed" );
	                    a.addWithPopup( b, "Accordion Content", "accordion" );
	                    a.addWithPopup( b, "Dropcap", "dropcap" );
	                    a.addWithPopup( b, "Infobox", "infobox" );
	                    a.addWithPopup( b, "Progress Bar", "progressbar" );
	                    a.addWithPopup( b, "Pricing Table", "pricing" );
	                    a.addWithPopup( b, "Icons", "icons" );
	                    a.addWithPopup( b, "Fullwidth Section", "fullwidth" );
					});
					
					return btn;
				}
				
				return null;
			},
			addWithPopup: function ( ed, title, id ) {
				ed.add({
					title: title,
					onclick: function () {
						tinyMCE.activeEditor.execCommand("popup", false, {
							title: title,
							identifier: id
						})
					}
				})
			},
			addImmediate: function ( ed, title, sc) {
				ed.add({
					title: title,
					onclick: function () {
						tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
					}
				})
			}
		});
		
		tinymce.PluginManager.add("shortcodes", tinymce.plugins.shortcodes);
 	} //End if TinyMCE less than 4
})();
