<?php
/**
 * Layered Navigation Fitlers Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.0.0
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class OKU_WC_Widget_Layered_Nav_Filters extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function OKU_WC_Widget_Layered_Nav_Filters() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass 		= 'woocommerce widget_layered_nav_filters';
		$this->woo_widget_description	= __( 'xxShows active layered nav filters so users can see and deactivate them.', 'woocommerce' );
		$this->woo_widget_idbase 		= 'woocommerce_layered_nav_filters';
		$this->woo_widget_name 			= __( 'WOOCommerce Layered Nav Filters', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget( 'woocommerce_layered_nav_filters', $this->woo_widget_name, $widget_ops );
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
	function widget( $args, $instance ) {
		global $_chosen_attributes, $woocommerce, $_attributes_array;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && is_array( $_attributes_array ) && ! is_tax( array_merge( $_attributes_array, array( 'product_cat', 'product_tag' ) ) ) )
			return;

		$current_term 	= $_attributes_array && is_tax( $_attributes_array ) ? get_queried_object()->term_id : '';
		$current_tax 	= $_attributes_array && is_tax( $_attributes_array ) ? get_queried_object()->taxonomy : '';

		$title = ( ! isset( $instance['title'] ) ) ? __( 'Active filters', 'woocommerce' ) : $instance['title'];
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base);

		// Price
		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;

		$min_year = isset( $_GET['min_year'] ) ? esc_attr( $_GET['min_year'] ) : 0;
		$max_year = isset( $_GET['max_year'] ) ? esc_attr( $_GET['max_year'] ) : 0;
		
		$min_kilometerr = isset( $_GET['min_kilometer'] ) ? esc_attr( $_GET['min_kilometer'] ) : 0;
		$max_kilometer = isset( $_GET['max_kilometer'] ) ? esc_attr( $_GET['max_kilometer'] ) : 0;
		
		if ( count( $_chosen_attributes ) > 0 || $min_price > 0 || $max_price > 0 || 
			$min_carat > 0 || $max_carat > 0 ) {

			echo $before_widget;
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			//sort the currently chosen terms to get termid -> slug pairs
	        $chosen_terms = array();
	        foreach( $_chosen_attributes as $att_name => $att_details ){
	            foreach( $att_details['terms'] as $k => $v ){
	                //var_dump(get_term_by('id', $v, $att_name));
	                $term_info = get_term_by( 'id', $v, $att_name );
	                $chosen_terms[$att_name][$term_info->term_id] = $term_info->slug;
	            }
	        }

	        // Base Link decided by current page
        if (defined('SHOP_IS_ON_FRONT')) :
                $base_link = home_url();
        elseif (is_post_type_archive('product') || is_page( woocommerce_get_page_id('shop') )) :
                $base_link = get_post_type_archive_link('product');
        else :
                $base_link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        endif;
        
        //remove homepage url from base link
        $base_link = str_replace( home_url(), "", $base_link );
			
	        echo "<ul>";
	        foreach ($chosen_terms as $key=>$value){
	        	$taxonomy = $key;
	        	$terms = get_terms( $taxonomy, $args );
	        	
	        	$chosen_terms = array();
		        foreach( $_chosen_attributes as $att_name => $att_details ){
		            foreach( $att_details['terms'] as $k => $v ){
		                //var_dump(get_term_by('id', $v, $att_name));
		                $term_info = get_term_by( 'id', $v, $att_name );
		                $chosen_terms[$att_name][$term_info->term_id] = $term_info->slug;
		            }
		        }
		        

            foreach ($terms as $term) {

                // Get count based on current view - uses transients
                $transient_name = 'wc_ln_count_' . md5( sanitize_key($taxonomy) . sanitize_key( $term->term_id ) );
                if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {
                    $_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );
                    set_transient( $transient_name, $_products_in_term );
                }

                $option_is_set = (isset($_chosen_attributes[$taxonomy]) && in_array($term->term_id, $_chosen_attributes[$taxonomy]['terms'])) ;

                $class = '';

                $arg = 'filter_'.strtolower(sanitize_title($instance['attribute']));

                if (isset($_GET[ $arg ])) $current_filter = explode(',', $_GET[ $arg ]); else $current_filter = array();

                if (!is_array($current_filter)) $current_filter = array();

                if (!in_array($term->term_id, $current_filter)) $current_filter[] = $term->term_id;

                //get the current terms selected ($chosen_terms)
                $link_terms = $chosen_terms;
                //if the current term is selcted
                if( $option_is_set ){
                    //remove it from terms that will make the link
                    unset( $link_terms[$taxonomy][$term->term_id] );
                    $class = 'class="chosen"';
                } else {
                    //term isnt currently selected, theoretically add it as a selected term to link_terms
                    $link_terms[$taxonomy][$term->term_id] = $term->slug;
                }

                //add the rules to our rules array
                $link = woocommerce_seo_add_rewrite_rules($link_terms, $base_link);


                // Min/Max
                if (isset($_GET['min_price'])) :
                    $link = add_query_arg( 'min_price', $_GET['min_price'], $link );
                endif;
                if (isset($_GET['max_price'])) :
                    $link = add_query_arg( 'max_price', $_GET['max_price'], $link );
                endif;



                // Search Arg
                if (get_search_query()) :
                    $link = add_query_arg( 's', get_search_query(), $link );
                endif;

                // Post Type Arg
                if (isset($_GET['post_type'])) :
                    $link = add_query_arg( 'post_type', $_GET['post_type'], $link );
                endif;

                // Query type Arg
                if ($query_type=='or' && !( sizeof($current_filter) == 1 && isset( $_chosen_attributes[$taxonomy]['terms'] ) && is_array($_chosen_attributes[$taxonomy]['terms']) && in_array($term->term_id, $_chosen_attributes[$taxonomy]['terms']) )) :
                    $link = add_query_arg( 'query_type_'.strtolower(sanitize_title($instance['attribute'])), 'or', $link );
                endif;

                
            	if ($option_is_set){
            		echo '<li '.$class.'>';
                	echo '<a href="'.site_url().$link.'">';
                	echo $term->name;
                	echo '</a>';
                	echo '</li>';
                }
            }
            
	        }
	        
			if ( $min_price ) {
				$link = remove_query_arg( 'min_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . $link . '">' . __( 'Min', 'woocommerce' ) . ' ' . $this->wooku_convert_price( $min_price ) . '</a></li>';
			}

			if ( $max_price ) {
				$link = remove_query_arg( 'max_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'woocommerce' ) . '" href="' . $link . '">' . __( 'Max', 'woocommerce' ) . ' ' . $this->wooku_convert_price( $max_price ) . '</a></li>';
			}
			
	        echo "</ul>";
	        
            
	        echo $after_widget;
		}
	}
	
	function wooku_convert_price($price){
		$currency = get_woocommerce_currency_symbol();
		$price = $currency . " " . number_format($price, 0, '.', ' ');
		return $price;
	}
}