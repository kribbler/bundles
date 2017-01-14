<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

global $shopifiq_number_of_items;

$shopifiq_number_of_items = 4;

if ( is_product() && ((get_option('single_product_left', '') && get_option('single_product_left', '') != "") || (get_option('single_product_right', ''))) ) {
	$shopifiq_number_of_items = 3;
}

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> $shopifiq_number_of_items,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<div class="upsells products">

		<h2><?php _e('You may also like&hellip;', 'woocommerce') ?></h2>

		<ul class="products">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul>

	</div>

<?php endif;

wp_reset_postdata();