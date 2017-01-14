<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>
	<p class="product_price">Pris: <span class="price"><?php echo $price_html; ?></span></p>
<?php endif; ?>