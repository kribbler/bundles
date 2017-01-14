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
	<span class="price">
		<?php if ( $product->product_type != "" && $product->product_type == "variable" ) {
		} ?>
		<?php echo $price_html; ?>
	</span>
<?php endif; ?>