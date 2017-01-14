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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'new' ); ?>

<?php
	$sidebarname = 'single';
?>
<div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
	<div class="container transparentish">
		<div class="row-fluid">
			<div class="span12 a-center">
				<?php woocommerce_template_single_title(); ?>
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action('woocommerce_before_main_content');
				?>
			</div>
		</div>
	</div>
</div>

<div id="inner_page">
	<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class('container'); ?>>
		<div class="page-content inner_white">
			<div class="row">

				<div class="content span12">

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
				</div>
			</div>

		</div>
	</div>
</div>

<?php get_footer('new'); ?>