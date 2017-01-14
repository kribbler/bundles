<?php
/**
 * Layered Navigation Fitlers Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.0.1
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Widget_Layered_Nav_Filters extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_layered_nav_filters';
		$this->widget_description = __( 'Shows active layered nav filters so users can see and deactivate them.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_layered_nav_filters';
		$this->widget_name        = __( 'WooCommerce Layered Nav Filters', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Active Filters', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' )
			)
		);
		parent::__construct();
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
		global $_chosen_attributes, $woocommerce;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
			return;

		$current_term 	= is_tax() ? get_queried_object()->term_id : '';
		$current_tax 	= is_tax() ? get_queried_object()->taxonomy : '';
		$title          = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		// Price
		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;
		
		$min_kilometer = isset( $_GET['min_kilometer'] ) ? esc_attr( $_GET['min_kilometer'] ) : 0;
		$max_kilometer = isset( $_GET['max_kilometer'] ) ? esc_attr( $_GET['max_kilometer'] ) : 0;
		
		$min_year = isset( $_GET['min_year'] ) ? esc_attr( $_GET['min_year'] ) : 0;
		$max_year = isset( $_GET['max_year'] ) ? esc_attr( $_GET['max_year'] ) : 0;
		
		$min_antalseter = isset( $_GET['min_antalseter'] ) ? esc_attr( $_GET['min_antalseter'] ) : 0;
		$max_antalseter = isset( $_GET['max_antalseter'] ) ? esc_attr( $_GET['max_antalseter'] ) : 0;
		
		$min_effekt = isset( $_GET['min_effekt'] ) ? esc_attr( $_GET['min_effekt'] ) : 0;
		$max_effekt = isset( $_GET['max_effekt'] ) ? esc_attr( $_GET['max_effekt'] ) : 0;

		if ( count( $_chosen_attributes ) > 0 || $min_price > 0 || $max_price > 0 || $min_kilometer > 0 || $max_kilometer > 0  || $min_year > 0 || $max_year > 0 || $min_antalseter > 0 || $max_antalseter > 0 || $min_effekt > 0 || $max_effekt > 0 ) {

			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			echo "<ul>";

			// Attributes
			if (!is_null($_chosen_attributes)){
				foreach ( $_chosen_attributes as $taxonomy => $data ) {

					foreach ( $data['terms'] as $term_id ) {
						$term 				= get_term( $term_id, $taxonomy );
						$taxonomy_filter 	= str_replace( 'pa_', '', $taxonomy );
						$current_filter 	= ! empty( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' . $taxonomy_filter ] : '';
						$new_filter			= array_map( 'absint', explode( ',', $current_filter ) );
						$new_filter			= array_diff( $new_filter, array( $term_id ) );

						$link = remove_query_arg( 'filter_' . $taxonomy_filter );

						if ( sizeof( $new_filter ) > 0 )
							$link = add_query_arg( 'filter_' . $taxonomy_filter, implode( ',', $new_filter ), $link );

						echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . $term->name . '</a></li>';
					}
				}
			}

			if ( $min_price ) {
				$link = remove_query_arg( 'min_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'woocommerce' ) . ' ' . wc_price( $min_price ) . '</a></li>';
			}

			if ( $max_price ) {
				$link = remove_query_arg( 'max_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'woocommerce' ) . ' ' . wc_price( $max_price ) . '</a></li>';
			}

			if ( $min_kilometer ) {
				$link = remove_query_arg( 'min_kilometer' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'woocommerce' ) . ' ' . wc_price( $min_kilometer ) . '</a></li>';
			}

			if ( $max_kilometer ) {
				$link = remove_query_arg( 'max_kilometer' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'woocommerce' ) . ' ' . wc_price( $max_kilometer ) . '</a></li>';
			}
			
			if ( $min_year ) {
				$link = remove_query_arg( 'min_year' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'woocommerce' ) . ' ' . wc_price( $min_year ) . '</a></li>';
			}

			if ( $max_year ) {
				$link = remove_query_arg( 'max_year' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'woocommerce' ) . ' ' . wc_price( $max_year ) . '</a></li>';
			}

			if ( $min_antalseter ) {
				$link = remove_query_arg( 'min_antalseter' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'woocommerce' ) . ' ' . wc_price( $min_antalseter ) . '</a></li>';
			}

			if ( $max_antalseter ) {
				$link = remove_query_arg( 'max_antalseter' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'woocommerce' ) . ' ' . wc_price( $max_antalseter ) . '</a></li>';
			}

			if ( $min_effekt ) {
				$link = remove_query_arg( 'min_effekt' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Min', 'woocommerce' ) . ' ' . wc_price( $min_effekt ) . '</a></li>';
			}

			if ( $max_effekt ) {
				$link = remove_query_arg( 'max_effekt' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . esc_url( $link ) . '">' . __( 'Max', 'woocommerce' ) . ' ' . wc_price( $max_effekt ) . '</a></li>';
			}

			echo "</ul>";

			echo $after_widget;
		}
	}
}

register_widget( 'WC_Widget_Layered_Nav_Filters' );