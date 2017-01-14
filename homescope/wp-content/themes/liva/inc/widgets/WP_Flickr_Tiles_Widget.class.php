<?php
/**
 * Flickr widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Flickr_Tiles_Widget' );

function init_WP_Flickr_Tiles_Widget() {
	register_widget('WP_Flickr_Tiles_Widget');
}
 
class WP_Flickr_tiles_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_flickr_tiles', 'description' => __( "Displays Flickr images", "framework" ) );
		parent::__construct('flickr-tiles', __( 'Flickr Tiles', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_flickr_tiles';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		$cache = wp_cache_get('widget_flickr_tiles', 'widget');
		
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
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Flickr', "framework" ) : $instance['title'], $instance, $this->id_base);
		
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$limit = isset($instance['limit']) ? (int)$instance['limit'] : '';
		
		echo $before_title.$title.$after_title; ?>

		<div id="flickr_badge_wrapper">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $limit; ?>&amp;display=latest&amp;size=s&amp;layout=h&amp;source=user&amp;user=<?php echo $username?>"></script>     
		</div>
		<?php
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_flickr_tiles', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['limit'] = (int)$new_instance['limit'];
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_flickr_tiles', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$limit = isset($instance['limit']) ? (int)$instance['limit'] : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e("User ID:",'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e("Limit items",'framework'); ?> <select class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>"><?php for ( $i = 1; $i <= 10; ++$i ) echo "<option value=\"$i\" ".($limit==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
		<?php
	}
}