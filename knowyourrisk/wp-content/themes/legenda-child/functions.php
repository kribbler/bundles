<?php
function child_ts_theme_widgets_init(){
    register_sidebar( array(
        'name' => __( 'Header Top Right', 'legenda' ),
        'id' => 'header-top-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Copyright area 1', 'legenda' ),
        'id' => 'coyright-area-1',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Copyright area 2', 'legenda' ),
        'id' => 'coyright-area-2',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Left', 'legenda' ),
        'id' => 'footer-left',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Center', 'legenda' ),
        'id' => 'footer-center',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer Right', 'legenda' ),
        'id' => 'footer-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Bellow', 'legenda' ),
        'id' => 'footer-bellow',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
}

add_action( 'widgets_init', 'child_ts_theme_widgets_init' );