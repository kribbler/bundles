<?php
/**
 * Sorting
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

?>
<div class="woocommerce_ordering">
	<form method="POST">
		<select name="sort" class="orderby">
			<?php
				$catalog_orderby = apply_filters('woocommerce_catalog_orderby', array(
					'menu_order' 	=> __('Default sorting', 'woocommerce'),
					'title' 		=> __('Sort alphabetically', 'woocommerce'),
					'date' 			=> __('Sort by most recent', 'woocommerce'),
					'price' 		=> __('Sort by price', 'woocommerce')
				));

				foreach ( $catalog_orderby as $id => $name )
					echo '<option value="' . $id . '" ' . selected( $_SESSION['orderby'], $id, false ) . '>' . $name . '</option>';
			?>
		</select>
	</form>
	
	<?php
		echo '<div class="widget-container widget_price_filter price-filter-outside">'; 
		if ( is_active_sidebar( 'filter-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'filter-widget-area' ); ?>
							</ul>
		<?php endif;
		echo '</div>';
	?>
</div>