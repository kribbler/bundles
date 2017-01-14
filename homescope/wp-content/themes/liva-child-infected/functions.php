<?php

wp_register_style( 'custom_css', get_stylesheet_directory_uri() . '/style.css', array(), null, 'all' );
wp_enqueue_style( 'custom_css' );

register_nav_menus( array(
	'header-menu'=> __( 'Header Menu', 'liva' ),
	'primary' => __( 'Primary Menu', 'liva' ),
	'copyright-bar' => __( 'Copyright bar menu', 'liva' ),
) ); 

function child_ts_theme_widgets_init(){
	register_sidebar( array(
        'name' => __( 'Header Booking', 'liva' ),
        'id' => 'header_booking',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Homescope 09', 'liva' ),
        'id' => 'homescope_09',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 1', 'liva' ),
        'id' => 'coyright-area-1',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 2', 'liva' ),
        'id' => 'coyright-area-2',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
}

add_action( 'widgets_init', 'child_ts_theme_widgets_init' );