<div class="wpmessenger_topmenu"><a class="wpmessenger_send">Send</a><a class="wpmessenger_back">Discard</a><a  class="wpmessenger_draft">Save As Draft</a></div>
<div class="wpmessenger_editpane">
    <form id="wpmessenger_compose" action="" method="post">
        <table>
            <tr>
                <th>To</th>
                <td><input  type="text" size="77" value="" id="wpmessenger_recipients" name="recipients"/></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>
                <input  type="hidden" size="77" value="<?php echo $context['ref']; ?>" id="context_ref" name="context[ref]"/>
                <input  type="hidden" size="77" value="<?php echo $context['stat']; ?>" id="context_stat" name="context[stat]"/>
                <input  type="hidden" size="77" value="<?php echo $context['realm']; ?>" id="context_realm" name="context[realm]"/>                
                <input  type="hidden" size="77" value="<?php echo $context['reply_to']; ?>" id="context_reply_to" name="context[reply_to]"/>                
                <input  type="hidden" size="77" value="<?php echo $action;?>" id="wpmessenger_action" name="wpmessenger_action"/>
                <input  type="text" size="77" value="<?php echo $subject;?>" id="wpmessenger_subject" name="subject"/>
                </td>
            </tr>        
            <tr>
                <td colspan="2"><div class="wpmessenger_compose_body"><?php 
                $args = array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'editor_class' => 'frontend',
                    'textarea_rows' => 5,
                    'tabindex' => 1,
                    'width'=>'600'
                );
                 
                 wpmessenger_editor($msgbody,'body', $args); ?></div></td>            
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){	        
        $('.wpmessenger_send').click(function(){  
            var rec = $('#wpmessenger_recipients').val();
            if(rec == "") {
                alert("Please Select At Least One Recipient.");
                return false;
            }        
            return $('#wpmessenger_compose').submit();
        });
        $('.wpmessenger_draft').click(function(e){
            $('#wpmessenger_action').val('draft');    
            return $('#wpmessenger_compose').submit();            
        });
        var recipients = <?php echo $this->echoJSON($recipients);?>;                    
        $('#wpmessenger_recipients').tokenInput('<?php echo admin_url( "admin-ajax.php" ); ?>'+'/?action=wpmessenger_autosearch',
        {theme: "facebook",preventDuplicates:true,'prePopulate':recipients});
        $('#wpmessenger_compose').submit(function(){
            return true;
        });        
        setInterval(function(){
            $('#body').val(tinymce.activeEditor.getContent());
            $.post('<?php echo admin_url( "admin-ajax.php" ); ?>', 
            'action=wpmessenger_save_draft&'+$('#wpmessenger_compose').serialize(),
            function(data){
                $('#context_ref').val(data.ref);
                $('#context_stat').val(data.stat);      
                $('#context_realm').val(data.realm);
                $('#context_reply_to').val(data.reply_to);                      
            },'json');
        },20000);
    });
</script>
