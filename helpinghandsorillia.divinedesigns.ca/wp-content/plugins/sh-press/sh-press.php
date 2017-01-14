<?php
/*
Plugin Name: Press
Plugin URI: http://www.seoheap.com/
Description: Press
Author: James Cantrell
Version: 1.0.0
Author URI: http://www.seoheap.com/
*/

add_action( 'init', 'press' );
function press() {
	register_post_type( 'press',array(
		'labels' => array(
			'name' => __( 'Press' ),
			'singular_name' => __( 'press' )
		),
		'public' => true,
		'has_archive' => true,
		'supports'=>array('title','editor','thumbnail')
	));
	register_taxonomy(
		'presstype',
		'press',
		array(
			'hierarchical'=>true,
			'label'=>'Press Type',
			'query_var'=>true,
			'rewrite'=>true
		)
	);
}


function add_press_meta_boxes() {  
    add_meta_box(  
        'wp_press_meta',  
        'Press',  
        'wp_press_meta',  
        'press',  
        'advanced'  
    );  
}
add_action('add_meta_boxes', 'add_press_meta_boxes');

function wp_press_meta($post) {  
  
    wp_nonce_field(plugin_basename(__FILE__), 'wp_press_meta_nonce');  
	
	include dirname(__FILE__).'/meta.php';
}
function save_press_meta_meta_data($id) {  
    if(empty($_POST['wp_press_meta_nonce']) || !wp_verify_nonce($_POST['wp_press_meta_nonce'], plugin_basename(__FILE__))) {  
      return $id;  
    }
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {  
      return $id;  
    }   
    if('locations' == $_POST['post_type']) {  
      if(!current_user_can('edit_page', $id)) {  
        return $id;  
      }
    } else {  
        if(!current_user_can('edit_page', $id)) {  
            return $id;  
        }
	}
    $plug='';
	if (!empty($_POST['wp_press_youtube'])) {
		$plug=trim(post('wp_press_youtube'));
		$p=youtubeid($plug);
		if ($p)
			$plug=$p;
	}
	delete_post_meta($id, 'wp_press_youtube');  
	if ($plug) {
    	add_post_meta($id, 'wp_press_youtube', $plug);  
    	update_post_meta($id, 'wp_press_youtube', $plug); 
	}

    $plug='';
	if (!empty($_POST['wp_press_link'])) {
		$plug=trim(post('wp_press_link'));
	}
	delete_post_meta($id, 'wp_press_link');  
	if ($plug) {
    	add_post_meta($id, 'wp_press_link', $plug);  
    	update_post_meta($id, 'wp_press_link', $plug); 
	}
}
add_action('save_post', 'save_press_meta_meta_data');  

function press_func($instance) {
	ob_start();
	if (is_array($instance) && $instance)
		extract($instance);
	include dirname(__FILE__).'/view.php';
	$cont=ob_get_contents();
	ob_end_clean();
	return $cont;
}
add_shortcode('press','press_func' );

function youtubeid($text) {
	if (!preg_match('#(https?://)?(www\.)?(youtu\.be|youtube\.com)([^\s"\'<>]+)#i',$text,$r))
		return false;
	if (preg_match('#([\w\-]{10,12})#',$r[4],$rr))
		return $rr[1];
	return false;	
}