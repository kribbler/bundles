<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

global $post, $woocommerce;

?>
<div class="clearfix hentry" style="margin-bottom: 30px">
<div class="images">

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="product-image-holder big-image">
                        <?php 
                        if(videoFeatured()) :
                            echo do_shortcode(videoFeatured()); 
                        else : ?>
			<a data-rel="prettyPhoto[product]" class="zoom" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?>

				<div class="product-image-holder-after"></div>

				<div class="product-image-hover">
					<div class="enlarge"></div>
				</div>

			</a>
                    <?php endif; ?>
		</div>

	<?php else : ?>
		<div class="product-image-holder big-image">
                        <?php 
                        if(videoFeatured()) :
                            echo do_shortcode(videoFeatured()); 
                        else : ?>
			<a data-rel="prettyPhoto[product]" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?>

				<div class="product-image-holder-after"></div>

				<div class="product-image-hover">
					<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-rel="prettyPhoto[product]" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>" class="enlarge"></a>
				</div>

			</a>
                    <?php endif; ?>
		</div>

	<?php endif; ?>

	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>