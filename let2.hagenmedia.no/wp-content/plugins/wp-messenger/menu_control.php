<script type="text/javascript">
jQuery(document).ready(function($){
    var wpmessage_store = {'inbox':{'loaded':false,'showing':false},
                       'sent':{'loaded':false,'showing':false},
                       'draft':{'loaded':false,'showing':false},
                       'trashed':{'loaded':false,'showing':false},
                       'edit':{'loaded':false,'showing':false},
                       'read':{'loaded':false,'showing':false,'id':0}
                      };
    overlay = $('#wpmessenger_container').overlay({
        oneInstance: true,
        api:true,
        top:'8%',
        closeOnEsc:false,
        closeOnClick:false,
        onLoad:function(){            
            var context = this.context.current;
            this.iframe.attr('src', context.url);
        },
        onBeforeLoad:function(){
        $this = this;
        this.contentpane  = $('#wpmessenger_contentpane');
        this.contentpane.html(""); 
        $('<iframe />').attr({id: 'wpmsgnr-preloader',frameBorder:0,align:"top",
            hspace:"0",vspace:"0",allowTransparency:"true",
            marginwidth:"0",marginheight:"0",scrolling : "no"
        }).attr('width','100%').attr('height','100%')
        .appendTo(this.contentpane).stop();
        this.preloaderframe = this.getOverlay().find('iframe#wpmsgnr-preloader');
        var preloaderframe  = this.preloaderframe.get(0);
        var contentWindow = preloaderframe.contentWindow ? preloaderframe.contentWindow :
        preloaderframe[0] ? preloaderframe[0] : preloaderframe;
        var preload = '<?php echo WPMESSENGER_URL;?>/images/loading.gif';
        preload = '<tr><td align="center"><img src="'+preload+'" /></td></tr>';
        preload = '<table width="100%" height="100%" align="center">'+preload+'</table>';
        preload = '<body style="background-color: transparent;">'+preload+'<body>'
        contentWindow.document.open();
        contentWindow.document.write(preload);
        contentWindow.document.close();
        this.preloadercontent = contentWindow;
        $('<iframe  />').attr({
            style:"visibility:hidden;",id:"wpmsgnr-container","width":"100%","height": "100%",
            frameBorder:0,align:"top",hspace:"0",vspace:"0",allowTransparency:"true",
            marginwidth:"0",marginheight:"0",scrolling : "no"
        })
        .appendTo(this.contentpane);
        this.iframe = this.getOverlay().find('iframe#wpmsgnr-container');
        var iframe        = this.iframe.get(0);
        var contentWindow = iframe.contentWindow ? iframe.contentWindow :
                            iframe[0] ? iframe[0] : iframe;
        this.contentWindow = contentWindow;;
        this.iframe.load(function(){
           if(!$(this).attr('src')) return;
           if(typeof $this.contentWindow.wpmessengerresult != 'undefined'){
               r = $this.contentWindow.wpmessengerresult; 
               if(r.status ='success'){
                $('#wpmessenger_status').css('display','block').html(r.msg);
                    $this.context.current = $this.context.parent;
                    $this.preloaderframe.css('display','block');    
                    $this.iframe.css('visibility', 'hidden');                    
                    $this.iframe.attr('src',$this.context.current.url); 
               }
           }
           var event = jQuery.Event('update_button');
           var menuid = parent.overlay.context.current.level;
           $('#stage_'+menuid, parent.document).trigger(event);        
           try{                            
               var $close = $('<a class="close"></a>');
               $this.close_btn = $close;
               var $overlay = $this.getOverlay();
               var contentHeight = $($this.contentWindow.document).height();
               var contentWidth  = $($this.contentWindow.document).width();
               $(this).attr('width',$('#wpmessenger_contentpane').width());
               $(this).attr('height',$('#wpmessenger_contentpane').height());
           }catch(e){}
           $this.preloaderframe.css('display','none');
           $(this).css('visibility', 'visible');
           $($this.contentWindow).focus();          
       });        
        },
        onClose:function(){           
        }
    });
    /*$('.display_name').each(function(i){
        $(this).parents('tr:first').click(function(e){
            if(e.target.nodeName == 'INPUT') return;
            var id = $(this).find('input').val();
            e.preventDefault();   
            var url = '?wpmessenger_op=read&id='+id;
            parent.overlay.context['parent']  = parent.overlay.context['current'];     
            parent.overlay.context['current'] = {'level':'read','url':url};
            parent.overlay.preloaderframe.css('display','block');    
            parent.overlay.iframe.css('visibility', 'hidden');    
            parent.overlay.iframe.attr('src',url);        
        });
    });*/
    $('.wpmessengermenu').click(function(e){$(this)
        var menuid = $(this).attr('menuid');
        overlay.load();
        e.preventDefault();
        overlay.context = {};
        if(menuid == 'login'){
            var url = '<?php echo wp_login_url( home_url() . '?wpmessenger_op=inbox' ); ?>';
            overlay.context['parent']  = {'level': 'inbox','url':'?wpmessenger_op=inbox'};
            overlay.context['current'] = {'level': menuid,'url':url};                        
                
        }else{
            overlay.context['parent']  = {'level': 'inbox','url':'?wpmessenger_op=inbox'};
            overlay.context['current'] = {'level': menuid,'url':'?wpmessenger_op='+menuid};                        
        }
    });
    $('.wpmessenger_back').click(function(e){
        e.preventDefault();
        parent.overlay.preloaderframe.css('display','block');    
        parent.overlay.iframe.css('visibility', 'hidden');    
        var prev = parent.overlay.context.parent;
        if(prev == "")return;
        parent.overlay.context.current = prev;
        parent.overlay.iframe.attr('src',prev.url);                
    });
    $('.wpmessenger_reload').click(function(){
        window.location.reload();
    });
    $('.wpmessengerstagemenu').click(function(e){
        $('#wpmessenger_status').css('display','none');
        overlay.preloaderframe.css('display','block');    
        overlay.iframe.css('visibility', 'hidden');    
        e.preventDefault();
        var menuid = $(this).attr('menuid');
        var url = '?wpmessenger_op='+menuid;
        overlay.context['parent']  = overlay.context['current'];
        overlay.context['current'] = {'level':menuid,'url':url};
        overlay.iframe.attr('src',url);
    }).each(function(i){        
        $(this).bind('update_button',function(e){            
            $('.wpmessengerstagemenu').each(function(){
                $(this).css('color',"#1982D1");
            });
            $(e.target).css('color', 'red');
        });
    });
    function getMessages(op,pageId,limit){
        //$('.wpmessenger_contentpane').load('<?php echo admin_url( "admin-ajax.php" ); ?>'+'/?action=wpmessenger&op='+op);        
        
    }
});
</script>
