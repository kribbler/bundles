<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>

<p><?php _e('Your cart is currently empty.', 'woocommerce') ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p><a class="button medium button-style1" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">&larr; <?php _e('Return To Shop', 'woocommerce') ?></a></p>