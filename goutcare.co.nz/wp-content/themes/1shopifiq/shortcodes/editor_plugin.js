(function() { 

    // Creates a new plugin class and a custom listbox

    tinymce.create('tinymce.plugins.onehalf', {

        createControl: function(n, cm) {

            switch (n) {

                case 'onehalf':

                    var mlb = cm.createListBox('onehalf', {

                        title : 'Shortcodes',

                        onselect : function(v) { 

                            var url = document.getElementById('hidden_url').value;


                            if(v=='gmaps') {
                                    
                                var tb = tb_show('', url + '/shortcodes/shortcodes_google_maps.php?TB_iframe=true')

                            }

                           /* if(v=='vimeo') {

                                var vimeo = prompt('Video', 'Enter video ID (eg. 46106724)');

                                window.parent.send_to_editor("[vimeo]" + vimeo + "[/vimeo]<br/>");   

                            }*/

                            if(v=='youtube') {

                                /*var vimeo = prompt('Video', 'Enter video ID (eg. IG0wyXUcqZI)');

                                window.parent.send_to_editor("[youtube]" + vimeo + "[/youtube]<br/>");  */
                                
                                var tb = tb_show('', url + '/shortcodes/shortcodes_youtube_vimeo.php?TB_iframe=true');

                            }

                            if(v=='recent_projects') {

                                var recent = prompt('Recent projects', 'Enter number of projects displayed');

                                window.parent.send_to_editor("[recent_projects]" + recent + "[/recent_projects]<br/>"); 

                            }

                            if(v=='button') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_button.php?TB_iframe=true');

                            }

                            if(v=='contact_success') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_contact_success.php?TB_iframe=true');

                            }

                            if(v=='quote_blog') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_quote_blog.php?TB_iframe=true');

                            }

                            if(v=='icon') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_icon.php?TB_iframe=true'); 

                            }

                            if(v=='columns') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_columns.php?TB_iframe=true'); 

                            }
                            
                            if(v=='progress') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_progress.php?TB_iframe=true'); 

                            }
                            
                            if(v=='person') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_person.php?TB_iframe=true'); 

                            }
                            
                            if(v=='statement') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_statement.php?TB_iframe=true'); 

                            }
                            
                            if(v=='alert') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_alert.php?TB_iframe=true'); 

                            }
                            
                            if(v=='alert') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_alert.php?TB_iframe=true'); 

                            }
                            
                            if(v=='custom_buttom') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_custom_button.php?TB_iframe=true'); 

                            }
                            
                            if(v=='list') {

                                var tb = tb_show('', url + '/shortcodes/shortcodes_list.php?TB_iframe=true'); 

                            }
                            
                            if(v=='error_404_title') {

                                window.parent.send_to_editor("[error_title]Title[/error_title]<br/>"); 

                            }
                            
                        }

                    });



                    // Add some values to the list box

                    mlb.add('Google maps', 'gmaps');  
                    
                    mlb.add('Video', 'youtube');   
                    
                    //mlb.add('Vimeo video', 'vimeo');   

                    mlb.add('Recent projects', 'recent_projects');

                    mlb.add('Button', 'button');

                    mlb.add('Contact form', 'contact_success');

                    mlb.add('Quote', 'quote_blog');

                    mlb.add('Icon', 'icon');

                    mlb.add('Column layout', 'columns');
                    
                    mlb.add('Progress bar', 'progress');
                    
                    mlb.add('Person', 'person');
                    
                    mlb.add('Statement box', 'statement');
                    
                    mlb.add('Alert box', 'alert');
                    
                    mlb.add('Custom button', 'custom_buttom');
					
					mlb.add('List', 'list');

					mlb.add('Error 404 Title', 'error_404_title');


                // Return the new listbox instance

                return mlb;



            }

            return null;

        }

    });

    tinymce.PluginManager.add('onehalf', tinymce.plugins.onehalf);

})();

