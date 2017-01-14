/**
 * Columns selector - WP 3.9 and higher
 *
 */
( function() {
    tinymce.PluginManager.add( 'ColumnsSelector', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'ColumnsSelector', {

            text: 'Columns',
            icon: false,
			type: 'menubutton',
			menu: [
            	{
            		text: '1/2',
            		value: 'one_half',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/2 last',
            		value: 'one_half_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/3',
            		value: 'one_third',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/3 last',
            		value: 'one_third_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2/3',
            		value: 'two_third',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2/3 last',
            		value: 'two_third_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/4',
            		value: 'one_fourth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/4 last',
            		value: 'one_fourth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '3/4',
            		value: 'three_fourth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '3/4 last',
            		value: 'three_fourth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/5',
            		value: 'one_fifth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/5 last',
            		value: 'one_fifth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2/5',
            		value: 'two_fifth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2/5 last',
            		value: 'two_fifth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + '][/' + this.value() + ']');
            		}
           		},
				{
            		text: '3/5',
            		value: 'three_fifth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '3/5 last',
            		value: 'three_fifth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '4/5',
            		value: 'four_fifth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '4/5 last',
            		value: 'four_fifth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/6',
            		value: 'one_sixth',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '1/6 last',
            		value: 'one_sixth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '5/6',
            		value: '5/6 last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '5/6 last',
            		value: 'five_sixth_last',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[' + this.value() + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + this.value() + ']');
            		}
           		},
				{
            		text: '2 columns',
            		value: '2_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_half]' + tinyMCE.activeEditor.selection.getContent() + '[/one_half][one_half_last][/one_half_last]');
            		}
           		},
				{
            		text: '3 columns',
            		value: '3_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_third]' + tinyMCE.activeEditor.selection.getContent() + '[/one_third][one_third][/one_third][one_third_last][/one_third_last]');
            		}
           		},
				{
            		text: '4 columns',
            		value: '4_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_fourth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fourth][one_fourth][/one_fourth][one_fourth][/one_fourth][one_fourth_last][/one_fourth_last]');
            		}
           		},
				{
            		text: '5 columns',
            		value: '5_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_fifth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fifth][one_fifth][/one_fifth][one_fifth][/one_fifth][one_fifth][/one_fifth][one_fifth_last][/one_fifth_last]');
            		}
           		},
				{
            		text: '6 columns',
            		value: '6_columns',
            		onclick: function() {
            			tinymce.execCommand('mceInsertContent', false, '[one_sixth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth_last][/one_sixth_last]');
            		}
           		}
           ]

        } );

    } );

} )();