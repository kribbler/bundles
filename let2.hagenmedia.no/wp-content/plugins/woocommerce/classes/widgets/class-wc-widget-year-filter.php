<?php
/**
 * Year Filter Widget and related functions
 *
 * Generates a range slider to filter products by year.
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.6.4
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Widget_Year_Filter extends WP_Widget {

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
	function WC_Widget_Year_Filter() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce widget_year_filter';
		$this->woo_widget_description = __( 'Shows a year filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.', 'woocommerce' );
		$this->woo_widget_idbase = 'woocommerce_year_filter';
		$this->woo_widget_name = __( 'WooCommerce Year Filter', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('year_filter', $this->woo_widget_name, $widget_ops);
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
	function widget_original( $args, $instance ) {
		extract( $args );

		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;

		if ( ! is_post_type_archive('product') && ! is_tax( get_object_taxonomies( 'product' ) ) ) return; // Not on product page - return

		if ( sizeof( $woocommerce->query->unfiltered_product_ids ) == 0 ) return; // None shown - return

		$min_year = isset( $_GET['min_year'] ) ? esc_attr( $_GET['min_year'] ) : '';
		$max_year = isset( $_GET['max_year'] ) ? esc_attr( $_GET['max_year'] ) : '';

		wp_enqueue_script( 'wc-year-slider' );

		wp_localize_script( 'wc-year-slider', 'woocommerce_year_slider_params', array(
			'currency_symbol' 	=> get_woocommerce_currency_symbol(),
			'currency_pos'      => get_option( 'woocommerce_currency_pos' ),
			'min_year'			=> $min_year,
			'max_year'			=> $max_year
		) );

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		// Remember current filters/search
		$fields = '';

		if (get_search_query()) $fields = '<input type="hidden" name="s" value="'.get_search_query().'" />';
		if (isset($_GET['post_type'])) $fields .= '<input type="hidden" name="post_type" value="'.esc_attr( $_GET['post_type'] ).'" />';
		if (isset($_GET['product_cat'])) $fields .= '<input type="hidden" name="product_cat" value="'.esc_attr( $_GET['product_cat'] ).'" />';
		if (isset($_GET['product_tag'])) $fields .= '<input type="hidden" name="product_tag" value="'.esc_attr( $_GET['product_tag'] ).'" />';
		if (isset($_GET['orderby'])) $fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';

		if ($_chosen_attributes) foreach ($_chosen_attributes as $attribute => $data) :

			$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

			$fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

			if ($data['query_type']=='or') $fields .= '<input type="hidden" name="'.esc_attr( str_replace('pa_', 'query_type_', $attribute) ).'" value="or" />';

		endforeach;

		$min = $max = 0;
		$post_min = $post_max = '';

		if ( sizeof( $woocommerce->query->layered_nav_product_ids ) === 0 ) {
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
				', $wpdb->posts, $wpdb->postmeta, 'year' )
			) );
		} else {
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key =\'%3$s\'
					AND (
						%1$s.ID IN (%4$s)
						OR (
							%1$s.post_parent IN (%4$s)
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, 'year', implode( ',', $woocommerce->query->layered_nav_product_ids )
			) ) );
		}

		if ( $min == $max ) return;

		echo $before_widget . $before_title . $title . $after_title;

		if ( get_option( 'permalink_structure' ) == '' )
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );

		echo '<form method="get" action="' . $form_action . '">
			<div class="year_slider_wrapper">
				<div class="year_slider" style="display:none;"></div>
				<div class="year_slider_amount">
					<input type="text" id="min_year" name="min_year" value="'.esc_attr( $min_year ).'" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min year', 'woocommerce' ).'" />
					<input type="text" id="max_year" name="max_year" value="'.esc_attr( $max_year ).'" data-max="'.esc_attr( $max ).'" placeholder="'.__( 'Max year', 'woocommerce' ).'" />
					<button type="submit" class="button">'.__( 'Filter', 'woocommerce' ).'</button>
					<div class="year_label" style="display:none;">
						'.__( 'Year:', 'woocommerce' ).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					'.$fields.'
					<div class="clear"></div>
				</div>
			</div>
		</form>';

		echo $after_widget;
	}

public function widget( $args, $instance ) {
		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
			return;

		if ( sizeof( $woocommerce->query->unfiltered_product_ids ) == 0 )
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

		if ( sizeof( $woocommerce->query->layered_nav_product_ids ) === 0 ) {
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE ( meta_key = \'%3$s\' OR meta_key = \'%4$s\' ) 
					AND meta_value != ""
				', $wpdb->posts, $wpdb->postmeta, 'year', '_min_variation_year' )
			) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
				', $wpdb->posts, $wpdb->postmeta, 'year' )
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
						%1$s.ID IN (' . implode( ',', array_map( 'absint', $woocommerce->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', $woocommerce->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, 'year', '_min_variation_year'
			) ) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key =\'%3$s\'
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', $woocommerce->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', $woocommerce->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, 'year'
			) ) );
		}

		$most_valuable = ($instance['my_yr_a6_2']) ? $instance['my_yr_a6_2']: $max;
		
		if ( $min == $max )
			return;

		echo $before_widget . $before_title . $title . $after_title;

		if ( get_option( 'permalink_structure' ) == '' )
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
			
		$year_range_01 = $instance['my_yr_a1_1'] . ' - ' . $instance['my_yr_a1_2'];
		$year_range_02 = $instance['my_yr_a2_1'] . ' - ' . $instance['my_yr_a2_2'];
		$year_range_03 = $instance['my_yr_a3_1'] . ' - ' . $instance['my_yr_a3_2'];
		$year_range_04 = $instance['my_yr_a4_1'] . ' - ' . $instance['my_yr_a4_2'];
		$year_range_05 = $instance['my_yr_a5_1'] . ' - ' . $instance['my_yr_a5_2'];
		$year_range_06 = $instance['my_yr_a6_1'] . ' - ' . $most_valuable;
		
		$total_year_range_00 = $this->get_total_items();
		$total_year_range_01 = $this->get_total_items($instance['my_yr_a1_1'], $instance['my_yr_a1_2']);
		$total_year_range_02 = $this->get_total_items($instance['my_yr_a2_1'], $instance['my_yr_a2_2']);
		$total_year_range_03 = $this->get_total_items($instance['my_yr_a3_1'], $instance['my_yr_a3_2']);
		$total_year_range_04 = $this->get_total_items($instance['my_yr_a4_1'], $instance['my_yr_a4_2']);
		$total_year_range_05 = $this->get_total_items($instance['my_yr_a5_1'], $instance['my_yr_a5_2']);
		$total_year_range_06 = $this->get_total_items($instance['my_yr_a6_1'], $most_valuable);
		
		?>
		
		
		<ul class="year_range_amount">
			<?php if ($total_year_range_00){?>
				<li>
					<a href="<?php echo $form_action?>"><?php _e('Alle', 'woocommmerce')?></a>
					<small class="count"><?php echo $total_year_range_00?></small>
				</li>
			<?php }?>
			
			<?php if ($total_year_range_01){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_01){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_01?></a>
					<small class="count"><?php echo $total_year_range_01?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a1_1']?>&max_year=<?php echo $instance['my_yr_a1_2']?>"><?php echo $year_range_01?></a>
					<small class="count"><?php echo $total_year_range_01?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_year_range_02){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_02){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_02?></a>
					<small class="count"><?php echo $total_year_range_02?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a2_1']?>&max_year=<?php echo $instance['my_yr_a2_2']?>"><?php echo $year_range_02?></a>
					<small class="count"><?php echo $total_year_range_02?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_year_range_03){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_03){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_03?></a>
					<small class="count"><?php echo $total_year_range_03?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a3_1']?>&max_year=<?php echo $instance['my_yr_a3_2']?>"><?php echo $year_range_03?></a>
					<small class="count"><?php echo $total_year_range_03?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_year_range_04){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_04){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_04?></a>
					<small class="count"><?php echo $total_year_range_04?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a4_1']?>&max_year=<?php echo $instance['my_yr_a4_2']?>"><?php echo $year_range_04?></a>
					<small class="count"><?php echo $total_year_range_04?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_year_range_05){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_05){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_05?></a>
					<small class="count"><?php echo $total_year_range_05?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a5_1']?>&max_year=<?php echo $instance['my_yr_a5_2']?>"><?php echo $year_range_05?></a>
					<small class="count"><?php echo $total_year_range_05?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_year_range_06){?>
				<?php if ($_GET['min_year'] . ' - ' . $_GET['max_year'] == $year_range_06){?>
				<li class="chosen_year">
					<a href="<?php echo $form_action?>"><?php echo $year_range_06?></a>
					<small class="count"><?php echo $total_year_range_06?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_year=<?php echo $instance['my_yr_a6_1']?>&max_year=<?php echo $instance['my_yr_a6_2']?>"><?php echo $year_range_06?></a>
					<small class="count"><?php echo $total_year_range_06?></small>
				</li>
				<?php }?>
			<?php }?>
		</ul>
		<?php 
		echo '<form method="get" action="' . esc_attr( $form_action ) . '">
			<div class="year_slider_wrapper" style="display: none">
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
		</form>
		
		<script type="text/javascript">
		jQuery(document).ready(function($){
		console.log("active toooooo");
				$("input[name=year_range]").change(function(){
					var year_range = $(this).val();
					year_range = year_range.split(" - ");
					$("#min_year").val(year_range[0]);
					$("#max_year").val(year_range[1]);
				});

				$("#year_range_form").submit(function(){
					var max_year = $("#max_year").val();
					if (!max_year){
						$("#max_year").remove();
					}
				});

				
			});
		</script>
		';

		echo $after_widget;
	}
	
	function get_total_items($min = NULL, $max = NULL){
		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp, $_attributes_array;
		$category_slug = $wp_query->query_vars['product_cat'];
		
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
				)
			)
		);
		
		$query = new WP_Query( $args );
		if( $query->have_posts() ) {
			$k = 0;
			while ($query->have_posts()) :
				$k++;
			endwhile;
			echo $k;
		}
		
		$year_range_query = NULL;
		if (isset($min) && isset($max)){
			$year_range_query = 'AND meta_value >= '.$min.' AND meta_value <= '.$max;
		}
		
		/*$total = $wpdb->prepare('
			SELECT *
			FROM %1$s
			LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
			WHERE post_status = "publish" AND meta_key = \'%3$s\'
			' . $year_range_query . '			
		', $wpdb->posts, $wpdb->postmeta, 'year' );*/
		
		$total = $wpdb->prepare('
			SELECT *
			FROM %1$s
			LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
			LEFT JOIN wp_terms ON wp_terms.slug = "'.$category_slug.'"
			LEFT JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
			LEFT JOIN wp_term_relationships ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
			
			WHERE post_status = "publish" AND meta_key = \'%3$s\'
			' . $year_range_query . '
			AND wp_term_relationships.object_id = %2$s.post_id
		', $wpdb->posts, $wpdb->postmeta, 'year' );
		$resulst = $wpdb->get_results( $total , ARRAY_A );

		$resulst = $wpdb->get_results( $total , ARRAY_A );
		foreach ($resulst as $key=>$value){
			$resulst[$key] = $value['ID'];
		}
//echo 'here on KM !!! This need to be fixed!';
//echo "<pre>";var_dump($_chosen_attributes);
		if ($_chosen_attributes)
		foreach ($_chosen_attributes as $key=>$value){
			$taxonomy = $key;
			$_products_in_term = get_objects_in_term( $value['terms'][0], $taxonomy );
			$resulst = array_intersect($resulst, $_products_in_term);
		}
		return count($resulst);
	}


	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update_original( $new_instance, $old_instance ) {
		if (!isset($new_instance['title']) || empty($new_instance['title'])) $new_instance['title'] = __( 'Filter by year', 'woocommerce' );
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		
		$instance['my_yr_a1_1'] = $new_instance['my_yr_a1_1'];
		$instance['my_yr_a1_2'] = $new_instance['my_yr_a1_2'];
		
		$instance['my_yr_a2_1'] = $new_instance['my_yr_a2_1'];
		$instance['my_yr_a2_2'] = $new_instance['my_yr_a2_2'];
		
		$instance['my_yr_a3_1'] = $new_instance['my_yr_a3_1'];
		$instance['my_yr_a3_2'] = $new_instance['my_yr_a3_2'];
		
		$instance['my_yr_a4_1'] = $new_instance['my_yr_a4_1'];
		$instance['my_yr_a4_2'] = $new_instance['my_yr_a4_2'];
		
		$instance['my_yr_a5_1'] = $new_instance['my_yr_a5_1'];
		$instance['my_yr_a5_2'] = $new_instance['my_yr_a5_2'];
		
		$instance['my_yr_a6_1'] = $new_instance['my_yr_a6_1'];
		$instance['my_yr_a6_2'] = $new_instance['my_yr_a6_2'];
		
		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form_original( $instance ) {
		global $wpdb;
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
		<?php
	}
	
	function form($instance){
		$instance = wp_parse_args(
			(array) $instance, 
			array( 
				'title' 			=> '',
				'my_yr_a1_1' 	=> '',
				'my_yr_a1_2' 	=> '',
				'my_yr_a2_1' 	=> '',
				'my_yr_a2_2' 	=> '',
				'my_yr_a3_1' 	=> '',
				'my_yr_a3_2' 	=> '',
				'my_yr_a4_1' 	=> '',
				'my_yr_a4_2' 	=> '',
				'my_yr_a5_1' 	=> '',
				'my_yr_a5_2' 	=> '',
				'my_yr_a6_1' 	=> '',
				'my_yr_a6_2' 	=> '',
			)
		);

		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<label>Ranges:</label>
		<p>
			1. <input id="<?php echo $this->get_field_id('my_yr_a1_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a1_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a1_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a1_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a1_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a1_2']?>" /><br />
			2. <input id="<?php echo $this->get_field_id('my_yr_a2_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a2_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a2_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a2_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a2_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a2_2']?>" /><br />
			3. <input id="<?php echo $this->get_field_id('my_yr_a3_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a3_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a3_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a3_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a3_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a3_2']?>" /><br />
			4. <input id="<?php echo $this->get_field_id('my_yr_a4_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a4_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a4_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a4_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a4_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a4_2']?>" /><br />
			5. <input id="<?php echo $this->get_field_id('my_yr_a5_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a5_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a5_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a5_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a5_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a5_2']?>" /><br />
			6. <input id="<?php echo $this->get_field_id('my_yr_a6_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a6_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a6_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a6_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a6_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a6_2']?>" /><br />
		</p>
		<?php 
	}
}