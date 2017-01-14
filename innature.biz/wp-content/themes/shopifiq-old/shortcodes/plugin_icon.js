/* LOGO BOX */
(function() {  
    tinymce.create('tinymce.plugins.logo_box', {  
        init : function(ed, url) {  
            ed.addButton('logo_box', {  
                title : 'Add a logo box',  
                image : url+'/images/logo.png',  
                onclick : function() {  
                     ed.selection.setContent('[logo_box]<br>[logo link="URL" target="TARGET"]IMAGES URL[/logo]<br>[logo link="URL" target="TARGET"]IMAGES URL[/logo]<br>[/logo_box]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('logo_box', tinymce.plugins.logo_box);  
})();

/* ICON */
(function() {  
    tinymce.create('tinymce.plugins.icon', {  
        init : function(ed, url) {  
            ed.addButton('icon', {  
                title : 'Add an icon',  
                image : url+'/images/icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[icon title="TITLE"  icon_url="ICON URL" wrapper="default, circle, none" link="LINK" target="TARGET"]<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque porta sapien nec leo convallis.<br>[/icon]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('icon', tinymce.plugins.icon);  
})();

/* SLIDER */
(function() {  
    tinymce.create('tinymce.plugins.slider', {  
        init : function(ed, url) {  
            ed.addButton('slider', {  
                title : 'Add a slider',  
                image : url+'/images/slider.png',  
                onclick : function() {  
                     ed.selection.setContent('[slider]<br>[slide link"LINK" target="TARGET"]IMAGE LINK[/slide]<br>[/slider]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('slider', tinymce.plugins.slider);  
})();

/* ACCORDION */
(function() {  
    tinymce.create('tinymce.plugins.accordion', {  
        init : function(ed, url) {  
            ed.addButton('accordion', {  
                title : 'Add an accordion',  
                image : url+'/images/accordian.png',  
                onclick : function() {  
                     ed.selection.setContent('[accordion]<br>[accordion_item title="TITLE"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dolor nunc, consequat sit amet feugiat quis, lorem ipsum Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dolor nunc, consequat sit amet feugiat quis, lorem ipsum Lorem ipsum dolor sit amet.[/accordion_item]<br>[/accordion]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);  
})();

/* PRICING TABLE */
(function() {  
    tinymce.create('tinymce.plugins.pricing', {  
        init : function(ed, url) {  
            ed.addButton('pricing', {  
                title : 'Add a pricing table',  
                image : url+'/images/pricing_tables.png',  
                onclick : function() {  
                     ed.selection.setContent('[pricing_table]<br>[pricing_column title="TITLE"]<br>[pricing_price currency="€" decimal="99"]999[/pricing_price]<br>[pricing_row]PRICING ROW[/pricing_row]<br>[pricing_row]PRICING ROW[/pricing_row]<br>[pricing_footer link="LINK"]BUTTON TEXT[/pricing_footer]<br>[/pricing_column]<br>[/pricing_table]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('pricing', tinymce.plugins.pricing);  
})();

/* TABS */
(function() {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
            ed.addButton('tabs', {  
                title : 'Add a tabs',  
                image : url+'/images/tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs tab1="TAB 1 TITLE" tab2="TAB 2 TITLE" tab3="TAB 3 TITLE"]<br>[tab]Tab content 1[/tab]<br>[tab]Tab content 2[/tab]<br>[tab]Tab content 3[/tab]<br>[/tabs]<br>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();