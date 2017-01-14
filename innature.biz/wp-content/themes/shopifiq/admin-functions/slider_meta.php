<?php 
add_action('add_meta_boxes', 'anps_slider_add_custom_box');
add_action('save_post', 'anps_slider_save_postdata');

function anps_slider_add_custom_box() { 
    $screens = array( 'page' );
    foreach($screens as $screen) {
        add_meta_box('anps_slider_meta', __('Input slider shortcode', ANPS_TEMPLATE_LANG), 'display_meta_box_slider', $screen, 'side', 'core');
    }
}

function display_meta_box_slider( $post ) { 
    $value2 = get_post_meta($post->ID, $key ='anps_slider', $single = true ); 
    $data = "<input type='text' value='".$value2."' name='anps_slider' id='anps_slider' style='width: 100%'/>";
    $data .= "<p class='description'>Shortcode example:<br/> [rev_slider first-page-slider]</p>";
    echo $data;
}

function anps_slider_save_postdata($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (empty($_POST) || !isset($_POST['post_ID'])) {
        return;
    }

    $post_ID = $_POST['post_ID'];

    if (!isset($_POST['anps_slider'])) {
        $_POST['anps_slider'] = '';
    }

    $mydata2 = $_POST['anps_slider']; 

    add_post_meta($post_ID, 'anps_slider', $mydata2, true) or update_post_meta($post_ID, 'anps_slider', $mydata2);
}
