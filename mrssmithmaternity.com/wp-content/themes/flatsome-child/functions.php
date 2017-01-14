<?php
$_SERVER['HTTPS'] = false;
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


//return apply_filters('woocommerce_get_price_html', $price, $this);


add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
	//var_dump($product->get_variation_price( 'max', true ));
	if (!$price) {
		$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
		return wc_price( $prices[0] );
	}
    return $price;
}


add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

function wc_wc20_variation_price_format( $price, $product ) {
	// Main Price
	$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
	
	// Sale Price
	$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	sort( $prices );
	$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
	if ( $price !== $saleprice ) {
		$price = '<del>' . $saleprice . '</del><br /><ins>' . $price . '</ins>';
	}
	return $price;
}