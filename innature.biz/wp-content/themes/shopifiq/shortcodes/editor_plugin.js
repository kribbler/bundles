(function() { 
    var url = document.getElementById('hidden_url').value;

    // Creates a new plugin class and a custom listbox
    tinymce.PluginManager.add( 'onehalf' , function( editor ){
        editor.addButton('onehalf', {
            type: 'listbox',
            text: 'Shortcodes',
            tooltip: 'Shortcodes builder',
            fixedWidth: true,
            onselect: function(e) {
                switch(this.value()) {
                    case 'gmaps':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_google_maps.php?TB_iframe=true')
                    break;
                    case 'youtube':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_youtube_vimeo.php?TB_iframe=true');
                    break;
                    case 'recent_projects':
                        var recent = prompt('Recent projects', 'Enter number of projects displayed');
                        window.parent.send_to_editor("[recent_projects]" + recent + "[/recent_projects]<br/>"); 
                    break;
                    case 'soundcloud':
                        var soundcloud = prompt('SoundCloud', 'Enter SoundCloud URL');
                        window.parent.send_to_editor('[soundcloud url="' + soundcloud + '" params="" width=" 100%" height="166" iframe="true" /]'); 
                    break;
                    case 'featured_products':
                        window.parent.send_to_editor('[featured_products_slider num="6"]'); 
                    break;
                    case 'button':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_button.php?TB_iframe=true');
                    break;
                    case 'contact_success':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_contact_success.php?TB_iframe=true');
                    break;
                    case 'quote_blog':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_quote_blog.php?TB_iframe=true');
                    break;
                    case 'icon':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_icon.php?TB_iframe=true'); 
                    break;
                    case 'columns':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_columns.php?TB_iframe=true'); 
                    break;
                    
                    case 'progress':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_progress.php?TB_iframe=true'); 
                    break;
                    
                    case 'person':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_person.php?TB_iframe=true'); 
                    break;
                    
                    case 'statement':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_statement.php?TB_iframe=true'); 
                    break;
                    
                    case 'alert':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_alert.php?TB_iframe=true'); 
                    break;
                    
                    case 'alert':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_alert.php?TB_iframe=true'); 
                    break;
                    
                    case 'custom_buttom':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_custom_button.php?TB_iframe=true'); 
                    break;
                    
                    case 'list':
                        var tb = tb_show('', url + '/shortcodes/shortcodes_list.php?TB_iframe=true'); 
                    break;
                    
                    case 'error_404_title':
                        window.parent.send_to_editor("[error_title]Title[/error_title]<br/>"); 
                    break;
                }
            },
            values: [
                {text: 'Google maps', value: 'gmaps'},  
                {text: 'Video', value: 'youtube'},     
                {text: 'Recent projects', value: 'recent_projects'},
                {text: 'SoundCloud', value: 'soundcloud'},
                {text: 'Featured Product Slider', value: 'featured_products'},
                {text: 'Button', value: 'button'},
                {text: 'Contact form', value: 'contact_success'},
                {text: 'Quote', value: 'quote_blog'},
                {text: 'Icon', value: 'icon'},
                {text: 'Column layout', value: 'columns'},
                {text: 'Progress bar', value: 'progress'},
                {text: 'Person', value: 'person'},
                {text: 'Statement box', value: 'statement'},
                {text: 'Alert box', value: 'alert'},
                {text: 'Custom button', value: 'custom_buttom'},
                {text: 'List', value: 'list'},
                {text: 'Error 404 Title', value: 'error_404_title'},
            ]
        });
    });
    
    tinymce.init({
        plugins: 'onehalf',
        toolbar: 'styleselect '
    });
})();