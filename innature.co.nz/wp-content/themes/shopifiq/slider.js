jQuery(document).ready(function() {  
    if ( jQuery('input[name=taxonomy]').val() != "product_cat" && jQuery(".envoo-admin-menu").length == 1 ) {
        var formfield; 
        jQuery('.upload_image_button').click(function() {
            jQuery('html').addClass('Image');
            formfield = jQuery(this).prev().attr('name'); 
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            return false;
        }); 
        window.original_send_to_editor = window.send_to_editor;
        window.send_to_editor = function(html){ 
            if (formfield) { 
                fileurl = jQuery('img',html).attr('src'); 
                jQuery('#'+formfield).val(fileurl);
                tb_remove();
                jQuery('html').removeClass('Image');
                formfield = '';
            } else { 
                window.original_send_to_editor(html);
            }
        }; 
    }
 
});