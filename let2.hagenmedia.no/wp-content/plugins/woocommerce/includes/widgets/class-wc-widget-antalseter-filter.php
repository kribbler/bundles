<?php
/**
 * Antalseter Filter Widget and related functions
 *
 * Generates a range slider to filter products by antalseter.
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Widget_Antalseter_Filter extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_antalseter_filter';
		$this->widget_description = __( 'Shows a antalseter filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_antalseter_filter';
		$this->widget_name        = __( 'WooCommerce Antalseter Filter', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Filter by antalseter', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' )
			)
		);
		parent::__construct();
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
			4. <input id="<?php echo $this->get_field_id('my_yr_a5_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a5_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a5_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a5_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a5_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a5_2']?>" /><br />
			4. <input id="<?php echo $this->get_field_id('my_yr_a6_1'); ?>" name="<?php echo $this->get_field_name('my_yr_a6_1'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a6_1']?>" /> - <input id="<?php echo $this->get_field_id('my_yr_a6_2'); ?>" name="<?php echo $this->get_field_name('my_yr_a6_2'); ?>" type="text" style="width:90px" value="<?php echo $instance['my_yr_a6_2']?>" /><br />
		</p>
		<?php 
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

		$min_antalseter = isset( $_GET['min_antalseter'] ) ? esc_attr( $_GET['min_antalseter'] ) : '';
		$max_antalseter = isset( $_GET['max_antalseter'] ) ? esc_attr( $_GET['max_antalseter'] ) : '';

		wp_enqueue_script( 'wc-antalseter-slider' );

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
				', $wpdb->posts, $wpdb->postmeta, 'antalseter', '_min_variation_antalseter' )
			) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
				', $wpdb->posts, $wpdb->postmeta, 'antalseter' )
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
				', $wpdb->posts, $wpdb->postmeta, 'antalseter', '_min_variation_antalseter'
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
				', $wpdb->posts, $wpdb->postmeta, 'antalseter'
			) ) );
		}

		$most_valuable = ($instance['my_yr_a4_2']) ? $instance['my_yr_a4_2']: $max;
		
		if ( $min == $max )
			return;

		echo $before_widget . $before_title . $title . $after_title;

		if ( get_option( 'permalink_structure' ) == '' )
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
			
		$antalseter_range_01 = $instance['my_yr_a1_1'] . ' - ' . $instance['my_yr_a1_2'];
		$antalseter_range_02 = $instance['my_yr_a2_1'] . ' - ' . $instance['my_yr_a2_2'];
		$antalseter_range_03 = $instance['my_yr_a3_1'] . ' - ' . $instance['my_yr_a3_2'];
		$antalseter_range_04 = $instance['my_yr_a4_1'] . ' - ' . $instance['my_yr_a4_2'];
		$antalseter_range_05 = $instance['my_yr_a5_1'] . ' - ' . $instance['my_yr_a5_2'];
		$antalseter_range_06 = $instance['my_yr_a6_1'] . ' - ' . $most_valuable;
		
		$total_antalseter_range_00 = $this->get_total_items();
		$total_antalseter_range_01 = $this->get_total_items($instance['my_yr_a1_1'], $instance['my_yr_a1_2']);
		$total_antalseter_range_02 = $this->get_total_items($instance['my_yr_a2_1'], $instance['my_yr_a2_2']);
		$total_antalseter_range_03 = $this->get_total_items($instance['my_yr_a3_1'], $instance['my_yr_a3_2']);
		$total_antalseter_range_04 = $this->get_total_items($instance['my_yr_a4_1'], $instance['my_yr_a4_2']);
		$total_antalseter_range_05 = $this->get_total_items($instance['my_yr_a5_1'], $instance['my_yr_a5_2']);
		$total_antalseter_range_06 = $this->get_total_items($instance['my_yr_a6_1'], $most_valuable);
		
		?>
		
		
		<ul class="antalseter_range_amount">
			<?php if ($total_antalseter_range_00){?>
				<li>
					<a href="<?php echo $form_action?>"><?php _e('Alle', 'woocommmerce')?></a>
					<small class="count"><?php echo $total_antalseter_range_00?></small>
				</li>
			<?php }?>
			
			<?php if ($total_antalseter_range_01){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_01){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_01?></a>
					<small class="count"><?php echo $total_antalseter_range_01?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a1_1']?>&max_antalseter=<?php echo $instance['my_yr_a1_2']?>"><?php echo $antalseter_range_01?></a>
					<small class="count"><?php echo $total_antalseter_range_01?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_antalseter_range_02){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_02){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_02?></a>
					<small class="count"><?php echo $total_antalseter_range_02?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a2_1']?>&max_antalseter=<?php echo $instance['my_yr_a2_2']?>"><?php echo $antalseter_range_02?></a>
					<small class="count"><?php echo $total_antalseter_range_02?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_antalseter_range_03){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_03){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_03?></a>
					<small class="count"><?php echo $total_antalseter_range_03?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a3_1']?>&max_antalseter=<?php echo $instance['my_yr_a3_2']?>"><?php echo $antalseter_range_03?></a>
					<small class="count"><?php echo $total_antalseter_range_03?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_antalseter_range_04){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_04){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_04?></a>
					<small class="count"><?php echo $total_antalseter_range_04?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a4_1']?>&max_antalseter=<?php echo $instance['my_yr_a4_2']?>"><?php echo $antalseter_range_04?></a>
					<small class="count"><?php echo $total_antalseter_range_04?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_antalseter_range_05){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_05){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_05?></a>
					<small class="count"><?php echo $total_antalseter_range_05?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a5_1']?>&max_antalseter=<?php echo $instance['my_yr_a5_2']?>"><?php echo $antalseter_range_05?></a>
					<small class="count"><?php echo $total_antalseter_range_05?></small>
				</li>
				<?php }?>
			<?php }?>
			
			<?php if ($total_antalseter_range_06){?>
				<?php if ($_GET['min_antalseter'] . ' - ' . $_GET['max_antalseter'] == $antalseter_range_06){?>
				<li class="chosen_antalseter">
					<a href="<?php echo $form_action?>"><?php echo $antalseter_range_06?></a>
					<small class="count"><?php echo $total_antalseter_range_06?></small>
				</li>
				<?php } else {?>
				<li>
					<a href="?min_antalseter=<?php echo $instance['my_yr_a6_1']?>&max_antalseter=<?php echo $instance['my_yr_a6_2']?>"><?php echo $antalseter_range_06?></a>
					<small class="count"><?php echo $total_antalseter_range_06?></small>
				</li>
				<?php }?>
			<?php }?>
		</ul>
		<?php 
		echo '<form method="get" action="' . esc_attr( $form_action ) . '">
			<div class="antalseter_slider_wrapper" style="display: none">
				<div class="antalseter_slider" style="display:none;"></div>
				<div class="antalseter_slider_amount">
					<input type="text" id="min_antalseter" name="min_antalseter" value="' . esc_attr( $min_antalseter ) . '" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min antalseter', 'woocommerce' ).'" />
					<input type="text" id="max_antalseter" name="max_antalseter" value="' . esc_attr( $max_antalseter ) . '" data-max="'.esc_attr( $max ).'" placeholder="'.__( 'Max antalseter', 'woocommerce' ).'" />
					<button type="submit" class="button">'.__( 'Filter', 'woocommerce' ).'</button>
					<div class="antalseter_label" style="display:none;">
						'.__( 'Antalseter:', 'woocommerce' ).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>
		
		<script type="text/javascript">
		jQuery(document).ready(function($){
		console.log("active toooooo");
				$("input[name=antalseter_range]").change(function(){
					var antalseter_range = $(this).val();
					antalseter_range = antalseter_range.split(" - ");
					$("#min_antalseter").val(antalseter_range[0]);
					$("#max_antalseter").val(antalseter_range[1]);
				});

				$("#antalseter_range_form").submit(function(){
					var max_antalseter = $("#max_antalseter").val();
					if (!max_antalseter){
						$("#max_antalseter").remove();
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
		
		$antalseter_range_query = NULL;
		if (isset($min) && isset($max)){
			$antalseter_range_query = 'AND meta_value >= '.$min.' AND meta_value <= '.$max;
		}
		
		/*$total = $wpdb->prepare('
			SELECT *
			FROM %1$s
			LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
			WHERE post_status = "publish" AND meta_key = \'%3$s\'
			' . $antalseter_range_query . '			
		', $wpdb->posts, $wpdb->postmeta, 'antalseter' );*/
		
		$total = $wpdb->prepare('
			SELECT *
			FROM %1$s
			LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
			LEFT JOIN wp_terms ON wp_terms.slug = "'.$category_slug.'"
			LEFT JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
			LEFT JOIN wp_term_relationships ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
			
			WHERE post_status = "publish" AND meta_key = \'%3$s\'
			' . $antalseter_range_query . '
			AND wp_term_relationships.object_id = %2$s.post_id
		', $wpdb->posts, $wpdb->postmeta, 'antalseter' );
		$resulst = $wpdb->get_results( $total , ARRAY_A );

		$resulst = $wpdb->get_results( $total , ARRAY_A );
		foreach ($resulst as $key=>$value){
			$resulst[$key] = $value['ID'];
		}

		if ($_chosen_attributes)
		foreach ($_chosen_attributes as $key=>$value){
			$taxonomy = $key;
			$_products_in_term = get_objects_in_term( $value['terms'][0], $taxonomy );
			$resulst = array_intersect($resulst, $_products_in_term);
		}
		return count($resulst);
	}
}

register_widget( 'WC_Widget_Antalseter_Filter' );