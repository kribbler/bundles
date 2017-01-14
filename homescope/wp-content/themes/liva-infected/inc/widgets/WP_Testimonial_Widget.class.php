<?php
/**
 * Testimonial widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Testimonial_Widget' );

function init_WP_Testimonial_Widget() {
	register_widget('WP_Testimonial_Widget');
}
 
class WP_Testimonial_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'clientsays_widget', 'description' => __( "Displays testimonial", "framework" ) );
		parent::__construct('testimonial', __( 'Single testimonial', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_testimonial';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_testimonial', 'widget');
		
		if ( !is_array($cache) )
		{
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) )
		{
			$args['widget_id'] = $this->id;
		}
		
		if ( isset( $cache[ $args['widget_id'] ] ) )
		{
			echo $cache[ $args['widget_id'] ];
			return;
		}
	
		ob_start();
		extract($args);
		echo $before_widget;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Testimonial', "liva" ) : $instance['title'], $instance, $this->id_base);
		
		$id = isset($instance['id']) ? esc_attr($instance['id']) : null;
		
		echo $before_title.$title.$after_title; 
		
		$post = get_post($id);

		if ( $post ) {
			$content = apply_filters('the_content', $post -> post_content);

			$widget_title = get_post_meta($post->ID, 'testimonials-widget-title', true);
			$email = get_post_meta($post->ID, 'testimonials-widget-email', true);
			$company = get_post_meta($post->ID, 'testimonials-widget-company', true);
			$url = get_post_meta($post->ID, 'testimonials-widget-url', true);
			$author = apply_filters( 'the_title', $post -> post_title, $post -> ID);

			if (!empty($url)) {
				$a1 = '<a href="'.$url.'" target="_blank">';
				$a2 = '</a>';

				if (empty($company)) {
					$company = $a1.$url.$a2;
				} else {
					$company = $a1.$company.$a2;
				}
			} ?>
			<?php ts_the_resized_post_thumbnail('testimonial-widget', $author); ?>
			<strong>- <?php echo $author; ?></strong>
			<?php echo $content; ?>
		<?php
		}
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_testimonial', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_testimonial', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'Testimonial ID:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" /></p>
		<?php
	}
}