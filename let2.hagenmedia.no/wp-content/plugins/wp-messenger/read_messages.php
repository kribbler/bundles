<div class="wpmessenger_topmenu"><a class="wpmessenger_back">back</a>  <a id="<?php echo $result->id;?>" class="wpmessenger_reply">Reply</a></div>
<?php if (empty($result)):?>
<div class="wpmessenger_detailpane">
<div class="wpmessenger_subject">    
<h1>No content in this message </h1>
</div></div>
<?php else:?>
<div class="wpmessenger_detailpane">
    <div class="wpmessenger_subject">    
    <h1><?php echo $result->subject;?></h1>
    <h3> <span><?php echo $sender->display_name;?></span> sent on: <?php echo $result->created;?></h3>
    <p><?php echo $result->body;?></p>
</div>
<?php endif;?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.wpmessenger_reply').click(function(e){
        e.preventDefault();
        parent.overlay.preloaderframe.css('display','block');    
        parent.overlay.iframe.css('visibility', 'hidden');
        var url = '?wpmessenger_op=compose&id='+$(this).attr('id') +'&realm=<?php echo $realm;?>';    
        parent.overlay.iframe.attr('src',url);                        
        parent.overlay.context.parent  = parent.overlay.context.current;
        parent.overlay.context['current'] = {'level':'compose','url': url};        
    });
});
</script>
