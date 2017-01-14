<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
echo '</div>';
if ( ! empty( $tabs ) ) : ?>

	<div class="tabs clearfix">
		<ul class="tabs-menu clearfix">
			<?php $i = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php if ( $i++ == 0 ) { echo "selected-tab-menu "; } ?><?php echo $key ?>_tab">
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
					<div class="tab-over"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></div>
				</li>

			<?php endforeach; ?>
		</ul>
		<div class="tabs-wrapper">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<div class="tab attributes panel entry-content" id="tab-<?php echo $key ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>