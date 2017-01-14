<div class="wpmessenger_editpane">
    <form id="wpmessenger_compose" action="" method="post">
        <table>
            <tr>                
                <td colspan="2"><input type="submit" value="Send" name="submit" /></td>           
            </tr>                
            <tr>
                <th>To</th>
                <td><input  type="text" size="77" value="" id="wpmessenger_recipients" name="wpmessenger_recipients"/></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td><input  type="text" size="77" value="" id="wpmessenger_subject" name="wpmessenger_subject"/></td>
            </tr>        
            <tr>
                <td colspan="2"><div><?php 
                $args = array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'editor_class' => 'frontend',
                    'textarea_rows' => 5,
                    'tabindex' => 1
                );                                                
                 wpmessenger_editor("Your text here",'body', $args); ?></div></td>            
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){	
        $('#wpmessenger_recipients').tokenInput('<?php echo admin_url( "admin-ajax.php" ); ?>'+'/?action=wpmessenger_autosearch',
        {theme: "facebook",preventDuplicates:true});
        $('#wpmessenger_compose').submit(function(){
            var rec = $('#wpmessenger_recipients').val();
            if(rec == "") return false;
            return true;
        });
    });
</script>
