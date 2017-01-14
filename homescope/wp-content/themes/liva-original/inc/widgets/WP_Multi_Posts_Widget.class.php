<?php
/**
 * Popular posts widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Multi_Posts_Widget' );

function init_WP_Multi_Posts_Widget() {
	register_widget('WP_Multi_Posts_Widget');
}

class WP_Multi_Posts_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_multi_posts_entries', 'description' => __( "Displays tabs with most popular posts, recent posts and comments","framework" ) );
		parent::__construct('multi-posts', __( 'Multi Posts', "framework" ), $widget_ops);

		$this-> alt_option_name = 'widget_multi_posts_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $comment;

		$cache = wp_cache_get('widget_multi_posts_entries', 'widget');

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
		$rand = rand(15000,50000);
		?>

		<div id='tabs'>
			<ul class="tabs">  
				<li class="active"><a href="#tab1"><?php _e('Popular','framework'); ?></a></li>
				<li class=""><a href="#tab2"><?php _e('Recent','framework'); ?></a></li>
				<li class="last"><a href="#tab3"><?php _e('Tags','framework'); ?></a></li>
			</ul><!-- /# end tab links --> 
			<div class="tab_container">	
				<div id="tab1" class="tab_content">
					<?php
					$number = 3;
					$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'comment_count DESC', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
					if ($r->have_posts()) : ?>
						<?php $posts_sz = count($r->posts);?>
						<?php $i = 0;?>
							<ul class="recent_posts_list">
								<?php  while ($r->have_posts()) : $r->the_post(); ?>		
									<li <?php echo $i == 2 ? 'class="last"' : '' ?>>
										<span><a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php ts_the_resized_post_thumbnail('multi-posts-widget',get_the_title()); ?></a></span>
										<a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php if ( get_the_title() ) echo ts_get_shortened_string(get_the_title(),5); else the_ID(); ?></a>
										 <i><?php the_time(get_option('date_format')); ?></i> 
									</li>
									<?php $i++; ?>
								<?php endwhile; ?>
							</ul>
						<?php
						// Reset the global $the_post as this query will have stomped on it
						wp_reset_postdata();
					endif; //have_posts()
					?>
				</div>

				<div id="tab2" class="tab_content">
					<?php
					$number = 3;
					$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true  ) ) );
					if ($r->have_posts()) : ?>
						<?php $posts_sz = count($r->posts);?>
						<?php $i = 0;?>
						<ul class="recent_posts_list">
							<?php  while ($r->have_posts()) : $r->the_post(); ?>		
								<li <?php echo $i == 2 ? 'class="last"' : '' ?>>
									<span><a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php ts_the_resized_post_thumbnail('multi-posts-widget',get_the_title()); ?></a></span>
									<a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php if ( get_the_title() ) echo ts_get_shortened_string(get_the_title(),5); else the_ID(); ?></a>
									 <i><?php the_time(get_option('date_format')); ?></i> 
								</li>
								<?php $i++; ?>
							<?php endwhile; ?>
						</ul>
						<?php
						// Reset the global $the_post as this query will have stomped on it
						wp_reset_postdata();
					endif; //have_posts()
					?>
				</div>
				
				<div id="tab3" class="tab_content">	 
					<ul class="tags">
						<li>
						<?php 
							$cloud_args = array(
								'taxonomy' => 'post_tag',
								'smallest' => 12, 
								'largest' => 12, 
								'unit' => 'px', 
								'number' => 45,
								'separator' => "</li><li>",
							);
							wp_tag_cloud( $cloud_args ); ?>
						</li>
					</ul>	 
				</div>
			</div>
		</div>
		<script>
			
		</script>
		<?php

		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_multi_posts_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
		{
			delete_option('widget_recent_entries');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_multi_posts_entries', 'widget');
	}

	function form( $instance )
	{
		$number = isset($instance['number']) ? absint($instance['number']) : 3;
		?>
		<p><?php _e('No options here','framework');?></p>
		<?php
	}
}