<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;
?>
<div class="product_meta">
<?php if (get_option("rtl") && get_option("rtl") == "on" ): ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'woocommerce'); ?> <?php echo $product->get_sku(); ?>.</span>
	<?php endif; ?>

	<?php echo $product->get_categories( ' ,', ' <span class="posted_in">', '</span>'); ?>

	<span style="margin-right: 8px"><?php _e('Category', 'woocommerce'); ?></span>

	<?php echo $product->get_tags( ' ,', ' <span class="tagged_as">', '</span>'); ?>

	<span><?php _e('Tags', 'woocommerce'); ?></span>

<?php else: ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'woocommerce'); ?> <?php echo $product->get_sku(); ?>.</span>
	<?php endif; ?>

	<?php echo $product->get_categories( ', ', ' <span class="posted_in">'.__('Category:', 'woocommerce').' ', '.</span>'); ?>

	<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('Tags:', 'woocommerce').' ', '.</span>'); ?>

<?php endif; ?>

</div>