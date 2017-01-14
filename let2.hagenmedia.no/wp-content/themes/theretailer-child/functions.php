<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action( 'widgets_init', 'child_theretailer_widgets_init' );

function child_theretailer_widgets_init(){
    if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
            'name' => __( 'Top Banner', 'theretailer' ),
            'id' => 'top_banner',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
        register_sidebar(array(
            'name' => __( 'Right Banner', 'theretailer' ),
            'id' => 'right_banner',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
		
		register_sidebar(array(
            'name' => __( 'NAF widget', 'theretailer' ),
            'id' => 'naf_widget',
            'before_widget' => '<div id="%1$s" class="naf_widget widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
		
		register_sidebar(array(
            'name' => __( 'Footer Copyright', 'theretailer' ),
            'id' => 'footer_copyright',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }
	
	//include_once( 'widgets/class-wc-widget-year-filter.php' );
	
	
}

function get_my_product_attribute($product, $attribute_name){
	$attribute = wc_get_product_terms($product->id, $attribute_name);
	return $attribute[0]->name;
}

function show_my_product_attribute($product, $attribute_name, $taxonomy){
	$attribute = woocommerce_get_product_terms($product->id, $taxonomy);
	//pr($attribute);
	$string = NULL;
	if ($attribute){
		$attribute = array_values($attribute);
		$string .= "<dl class='dl_product'>";
		$string .= "<dt>" . $attribute_name . "</dt>";
		$string .= "<dd>" . $attribute[0]->name . "</dd>";
		$string .= "</dl>";
	}
	//pr($string);
	return $string;
}

function show_my_product_attributes($product, $attribute_name, $taxonomy){
	$attributes = wc_get_product_terms($product->id, $taxonomy);
	
	$string = NULL;
	if ($attributes){
		foreach ($attributes as $attribute){
			$string .= "<p style='float: left; width: 50%'>" . $attribute->name . "</p>";
		}
	}
	return $string;
}

add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}

include_once( 'widgets/oku-widget-layered_nav.php' );
	register_widget('OKU_WC_Widget_Layered_Nav_Filters');

function pr($str){
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
} 