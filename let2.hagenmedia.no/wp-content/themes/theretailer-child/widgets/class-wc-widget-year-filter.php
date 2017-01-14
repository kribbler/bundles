<?php
/**
 * Year Filter Widget and related functions
 *
 * Generates a range slider to filter products by year.
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Widget_Year_Filter extends WP_Widget {

	/**
	 * Constructor
	 */
	public function WC_Widget_Year_Filter() {
		$this->widget_cssclass    = 'woocommerce widget_year_filter';
		$this->widget_description = __( 'Shows a year filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_year_filter';
		$this->widget_name        = __( 'WooCommerce Year Filter', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Filter by year', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' )
			)
		);
		//parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
			return;

		if ( sizeof( WC()->query->unfiltered_product_ids ) == 0 )
			return; // None shown - return

		$min_year = isset( $_GET['min_year'] ) ? esc_attr( $_GET['min_year'] ) : '';
		$max_year = isset( $_GET['max_year'] ) ? esc_attr( $_GET['max_year'] ) : '';

		wp_enqueue_script( 'wc-year-slider' );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		// Remember current filters/search
		$fields = '';

		if ( get_search_query() )
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';

		if ( ! empty( $_GET['post_type'] ) )
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr( $_GET['post_type'] ) . '" />';

		if ( ! empty ( $_GET['product_cat'] ) )
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr( $_GET['product_cat'] ) . '" />';

		if ( ! empty( $_GET['product_tag'] ) )
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr( $_GET['product_tag'] ) . '" />';

		if ( ! empty( $_GET['orderby'] ) )
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';

		if ( $_chosen_attributes ) foreach ( $_chosen_attributes as $attribute => $data ) {

			$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

			$fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

			if ( $data['query_type'] == 'or' )
				$fields .= '<input type="hidden" name="' . esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ) . '" value="or" />';
		}

		$min = $max = 0;
		$post_min = $post_max = '';

		if ( sizeof( WC()->query->layered_nav_product_ids ) === 0 ) {
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE ( meta_key = \'%3$s\' OR meta_key = \'%4$s\' ) 
					AND meta_value != ""
				', $wpdb->posts, $wpdb->postmeta, '_year', '_min_variation_year' )
			) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
				', $wpdb->posts, $wpdb->postmeta, '_year' )
			) );
		} else {
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE ( meta_key =\'%3$s\' OR meta_key =\'%4$s\' ) 
					AND meta_value != ""
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, '_year', '_min_variation_year'
			) ) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key =\'%3$s\'
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, '_year'
			) ) );
		}

		if ( $min == $max )
			return;

		echo $before_widget . $before_title . $title . $after_title;

		if ( get_option( 'permalink_structure' ) == '' )
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );

		echo '<form method="get" action="' . esc_attr( $form_action ) . '">
			<div class="year_slider_wrapper">
				<div class="year_slider" style="display:none;"></div>
				<div class="year_slider_amount">
					<input type="text" id="min_year" name="min_year" value="' . esc_attr( $min_year ) . '" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min year', 'woocommerce' ).'" />
					<input type="text" id="max_year" name="max_year" value="' . esc_attr( $max_year ) . '" data-max="'.esc_attr( $max ).'" placeholder="'.__( 'Max year', 'woocommerce' ).'" />
					<button type="submit" class="button">'.__( 'Filter', 'woocommerce' ).'</button>
					<div class="year_label" style="display:none;">
						'.__( 'Year:', 'woocommerce' ).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>';

		echo $after_widget;
	}
}

register_widget( 'WC_Widget_Year_Filter' );