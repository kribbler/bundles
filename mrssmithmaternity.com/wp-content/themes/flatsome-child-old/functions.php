<?php


/**
 * Register widgetized area and update sidebar with default widgets
 */
register_sidebar( array(
		'name'          => __( 'Sidebar', 'flatsome' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );


	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'flatsome' ),
		'id'            => 'shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title shop-sidebar">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'flatsome' ),
		'id'            => 'product-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title shop-sidebar">',
		'after_title'   => '</h3>',
	) );


	 register_sidebar( array(
		'name'          => __( 'Footer 1 (4 column)', 'flatsome' ),
		'id'            => 'sidebar-footer-1',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );


	 register_sidebar( array(
		'name'          => __( 'Footer 2 (4 column)', 'flatsome' ),
		'id'            => 'sidebar-footer-2',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	 register_sidebar( array(
		'name'          => __( 'Newzeland Design', 'flatsome' ),
		'id'            => 'newsle_blk',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Static Content', 'flatsome' ),
		'id'            => 'staticon1',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Best Seller', 'flatsome' ),
		'id'            => 'bst_seller',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Latest Product', 'flatsome' ),
		'id'            => 'late_pro',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'On Sale', 'flatsome' ),
		'id'            => 'on_sale',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Most Reviewed', 'flatsome' ),
		'id'            => 'most_review',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Contactus Footer', 'flatsome' ),
		'id'            => 'contft_blk',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Follow Us for Footer', 'flatsome' ),
		'id'            => 'socicon_foot',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Testimonial', 'flatsome' ),
		'id'            => 'testimo_widget',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );
