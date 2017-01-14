<?php
/**
 * Popular posts widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Portfolio_Widget' );

function init_WP_Portfolio_Widget() {
	register_widget('WP_Portfolio_Widget');
}
 
class WP_Portfolio_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_portfolio_entries', 'description' => __( "Displays the portfolio slider", "framework" ) );
		parent::__construct('portfolio', __( 'Portfolio', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_portfolio_entries';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_portfolio_entries', 'widget');
		
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
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
		{
			$number = 10;
		}
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'post_type'			=> 'portfolio',
			'orderby'			=> 'date', 
			'order'				=> 'DESC',
			'meta_query'		=> array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
			'posts_per_page'	=> $number, 
			'no_found_rows'		=> true, 
			'post_status'		=> 'publish') ) );
		
		$rand = rand(1,10000);
		
		if ($r->have_posts()) : ?>
			<?php echo $before_title.$title.$after_title;  ?>
			<?php $posts_sz = count($r->posts); ?>
			<?php $i = 1; ?>
			<ul id="mycarousel-<?php echo $rand; ?>" class="jcarousel-skin-tango">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
					<li>
						<div class="item">                        
						<div class="fresh_projects_list">
							<section class="cheapest">
								<div class="display">                  
									<div class="small-group">        
										<div class="small money">  
											<a href="<?php the_permalink() ?>">
												<?php ts_the_resized_post_thumbnail('portfolio-widget',get_the_title()); ?>
												<div class="info">
													<h1><?php the_title(); ?></h1>
													<h2><?php $terms = wp_get_post_terms( $post -> ID, 'portfolio-categories', $args );
													$term_slugs = array();
													$term_names = array();
													if (count($terms) > 0):
														foreach ($terms as $term):
															$term_slugs[] = $term -> slug;
															$term_names[] = $term -> name;
														endforeach;
													endif;
													echo implode(', ',$term_names);
													?></h2>
													<div class="additionnal">
														 <b><?php _e('View Project','liva');?></b>
													</div>
												</div>
												<div class="hover"></div>
											</a>   
										</div>        
									</div>     
								</div>
							</section>
						</div>
						</div>
					</li><!-- end item -->
				<?php $i++;?>
				<?php endwhile; ?>
			</ul>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#mycarousel-<?php echo $rand; ?>').jcarousel();
				});
			</script>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_portfolio_entries', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_portfolio_entries']) )
		{
			delete_option('widget_portfolio_entries');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_portfolio_entries', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of items to show:', "framework" ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}