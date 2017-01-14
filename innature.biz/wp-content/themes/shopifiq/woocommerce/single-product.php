<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header('shop'); ?>

<?php
	global $is_sidebar;
	$is_sidebar = false;

	if( get_option('single_product_left', '') && get_option('single_product_left', '') != "" ) {
		$left_sidebar = get_option('single_product_left', '');
		$is_sidebar = true;	
	}elseif( get_option('single_product_right', '') ) {
		$right_sidebar = get_option('single_product_right', '');
		$is_sidebar = true;		
	}
    
	if ( get_option('single_product_left', '') && get_option('single_product_left', '') != "" ): ?>
    	
    	<aside class="sidebar sidebar-left clearfix"><?php get_sidebar( dynamic_sidebar($left_sidebar) ); ?></aside>   
    
    <?php
    endif;

    if($is_sidebar): ?>
    	<div class="clearfix blog-one-sidebar">
    <?php endif; ?>


	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

    <?php if($is_sidebar): ?>
    	</div>
    <?php endif; ?>

	<?php if ( get_option('single_product_right', '') && get_option('single_product_right', '') != "" ): ?>
    	
    	<aside class="sidebar sidebar-right clearfix"><?php get_sidebar( dynamic_sidebar($right_sidebar) ); ?></aside>   
    
    <?php
    endif; ?>

<?php get_footer('shop'); ?>