<div class="wpmessenger_topmenu"><a href="" class="wpmessenger_reload">reload</a></div>
<div class="wpmessenger_detailpane">
    <form id="wpmessenger_sent" method="POST">
        <input type="hidden" name="page" value="" />
        <?php $sent_list->display() ?>
    </form>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.sent tr').click(function(e){
        if(e.target.nodeName == 'INPUT') return;
        var id = $(this).find('input').val();
        e.preventDefault();   
        if(id==undefined) return;                
        var url = '?wpmessenger_op=read&id='+id+"&realm=sent";
        parent.overlay.context['parent']  = parent.overlay.context['current'];     
        parent.overlay.context['current'] = {'level':'read','url':url};
        parent.overlay.preloaderframe.css('display','block');    
        parent.overlay.iframe.css('visibility', 'hidden');    
        parent.overlay.iframe.attr('src',url);        
    });
});
</script>
