<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$text = __( 'Sale!', 'woocommerce' );
$sale = get_post_meta( get_the_ID(), '_sale_price', true);
$regular = get_post_meta( get_the_ID(), '_regular_price', true);

?>
<?php if ($product->is_on_sale()) : ?>

	<?php if( get_option('sale_type', "") == "on"):
		$text = round((($sale / $regular)-1)*100, 0) . " %";
	endif; ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'. $text .'</span>', $post, $product); ?>

<?php endif; ?>