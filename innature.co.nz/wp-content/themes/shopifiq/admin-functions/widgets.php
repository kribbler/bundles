<?php
class EnvooMostPopular extends WP_Widget
{
  function EnvooMostPopular()
  {
    $widget_ops = array('classname' => 'EnvooMostPopular', 'description' => 'Shows a box with most popular posts, most recent posts and comments.' );
    $this->WP_Widget('EnvooMostPopular', 'Shopifiq Recent/Popular/Comments box', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'envoo_number_fields' => '', 'envoo_recent_title' => '' ) );
    $title = $instance['title'];
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_recent_title = $instance['envoo_recent_title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title for popular posts: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('envoo_recent_title'); ?>">Title for recent posts: </label>
  <input class="widefat" id="<?php echo $this->get_field_id('envoo_recent_title'); ?>" name="<?php echo $this->get_field_name('envoo_recent_title'); ?>" type="text" value="<?php echo esc_attr($envoo_recent_title); ?>" /></p>

  <p><label for="<?php echo $this->get_field_id('envoo_number_fields'); ?>">Number of posts/comments to show:</label>
  <input id="<?php echo $this->get_field_id('envoo_number_fields'); ?>" name="<?php echo $this->get_field_name('envoo_number_fields'); ?>" value="<?php echo esc_attr($envoo_number_fields); ?>" type="text" value="5" size="3"></p>
  
  </p>
   <?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['envoo_number_fields'] = $new_instance['envoo_number_fields'];
    $instance['envoo_recent_title'] = $new_instance['envoo_recent_title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    global $wpdb;
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_recent_title = $instance['envoo_recent_title'];
    
    echo $before_widget;
    
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    
    ?>
<div class="tabs clearfix">
  <ul class="tabs-menu clearfix">
      <li class="selected-tab-menu popular-tab"><?php echo $title; ?><div class="tab-over"><?php echo $title; ?></div></li>
      <li><?php echo $envoo_recent_title; ?><div class="tab-over"><?php echo $envoo_recent_title; ?></div></li>
      <li><div class="popular-comments-tab"></div><div class="tab-over"><div class="popular-comments-tab-hover"></div></div></li>
  </ul>  
<div class="tabs-wrapper">
<div class="tab popular">
    <?php 
    $paged = '';
    $new_query = new WP_Query();
    $new_query->query( 'paged='.$paged . '&posts_per_page=' . $envoo_number_fields . '&numberposts=' .  $envoo_number_fields .'&orderby=comment_count&order="DESC"' );

    //The Loop
    while ($new_query->have_posts()) : $new_query->the_post();
    ?>
                        <a class="post" href="<?php echo get_permalink(get_the_ID()) . '" title="'.get_the_title().'"'; ?>">
                            <div class="image"><?php echo get_the_post_thumbnail(get_the_ID(), "small-thumbnail") ?></div>
                            <p><?php echo get_the_title(); ?></p>
                            <div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
                        </a>
               
  <?php endwhile; ?>
</div>
 
<div class="tab recent">
    <?php 
    $paged = '';
    $new_query = new WP_Query();
    $new_query->query( 'paged='.$paged . '&posts_per_page=' . $envoo_number_fields . '&numberposts=' .  $envoo_number_fields .'&orderby=id&order="DESC"' );

    //The Loop
    while ($new_query->have_posts()) : $new_query->the_post();
    ?>
                        <a class="post" href="<?php echo get_permalink(get_the_ID()) . '" title="'.get_the_title().'"'; ?>">
                            <div class="image"><?php echo get_the_post_thumbnail(get_the_ID(), "small-thumbnail") ?></div>
                            <p><?php echo get_the_title(); ?></p>
                            <div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
                        </a>
               
  <?php endwhile; ?>
</div> 
  
  
<div class="tab comments-widget">
    <?php
      global $wpdb;
      $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,30) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT " . $envoo_number_fields;

      $comments = $wpdb->get_results($sql);
      ?>
            <?php
            foreach ($comments as $comment) {
              $comment2 = $comment;
              $comment = get_comment($comment->comment_ID);

              echo '<a class="post" href="' . get_permalink($comment2->ID). '#comment-' . $comment->comment_ID . '" >
              			<div class="image clearfix">' . get_avatar( $comment ) . '</div>
              			<p>' . strip_tags($comment->comment_author) ." says:</p>" . 
              			'<div class="comment-content">' . $comment->comment_content . '</div>' .
              		'</a>';
            }
        ?>
</div></div></div>
    <?php
 
    echo $after_widget;

  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooMostPopular");') );

 /*
class EvooRecentPosts extends WP_Widget
{
  function EvooRecentPosts()
  {
    $widget_ops = array('classname' => 'EvooRecentPosts', 'description' => 'The most recent posts on your site, but you can also set the category' );
    $this->WP_Widget('EvooRecentPosts', 'CoolBlue - Recent posts', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'envoo_number_fields' => '', 'envoo_category_id' => '' ) );
    $title = $instance['title'];
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_category_id = $instance['envoo_category_id'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('envoo_number_fields'); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id('envoo_number_fields'); ?>" name="<?php echo $this->get_field_name('envoo_number_fields'); ?>" value="<?php echo esc_attr($envoo_number_fields); ?>" type="text" value="5" size="3"></p>
  
  
  
  <p><label for="<?php echo $this->get_field_id('envoo_category_id'); ?>">Category name:</label>
<?php
    wp_dropdown_categories('hide_empty=0&id='. $this->get_field_id('envoo_category_id') . '&name=' . $this->get_field_name('envoo_category_id') . '&selected=' . esc_attr($envoo_category_id));
    ?>
  </p>
   <?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['envoo_number_fields'] = $new_instance['envoo_number_fields'];
    $instance['envoo_category_id'] = $new_instance['envoo_category_id'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    global $wpdb;
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_category_id = $instance['envoo_category_id'];
    
    #$data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "envoo_recent_posts");
    
    
    
    
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    
    ?>
  
  
<div class="posts">
    <?php 
    $new_query = new WP_Query();
    $paged = '';
    $new_query->query( 'cat=' . $envoo_category_id . '&paged='.$paged . '&posts_per_page=9999999&numberposts=' .  $envoo_number_fields .'&orderby="post_date"&order="DESC"' );

    //The Loop
    while ($new_query->have_posts()) : $new_query->the_post();
    ?>
                        <div class="post">
                            <div class="image"><?php echo get_avatar(  get_the_author_meta('email')); ?></div>
                            <p><a href="<?php echo get_permalink($recent["ID"]) . '" title="'.get_the_title().'"'; ?>"><?php echo get_the_title(); ?></a></p>
                            <div class="day"><?php echo get_the_date('d'); ?></div>
                            <div class="month"><?php echo strtolower(get_the_date('M')); ?></div>
                        </div>
               
  <?php endwhile; ?>
  
        </div>
    <?php
 
    echo $after_widget;

  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EvooRecentPosts");') );
*/
  








 
class EnvooTwitter extends WP_Widget
{
  function EnvooTwitter()
  {
    $widget_ops = array('classname' => 'EnvooTwitter', 'description' => 'Displays your Twitter feed' );
    $this->WP_Widget('EnvooTwitter', 'Shopifiq -  Twitter', $widget_ops);
  }
  
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        
        $title = $instance['title'];
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

  <?php
        global $wpdb;
        $data = $wpdb->get_results("SELECT id, facebook, twitter, linkedin, vimeo, youtube, flickr FROM " . $wpdb->prefix . "envoo_account");
    
?>
  Your Twitter account: <strong> <?php echo str_replace("http://twitter.com/","",str_replace("https://twitter.com/","",$data[0]->twitter)); ?> </strong>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    $title = $instance['title'];
    echo $before_widget;

    global $wpdb;
    $data = $wpdb->get_results("SELECT id, facebook, twitter, linkedin, vimeo, youtube, flickr FROM " . $wpdb->prefix . "envoo_account");
     if (!empty($title))
      echo $before_title . $title . $after_title;
    ?>
    
        <script type='text/javascript'>
            jQuery(function($){
                $(".tweet").tweet({
                    username: "<?php echo str_replace("http://twitter.com/","",str_replace("https://twitter.com/","",$data[0]->twitter)); ?>",
                    template: "{user}{join} {text}{time}", 
                    join_text: "auto",
                    avatar_size: 0,
                    count: 2,
                    auto_join_text_default: " ", 
                    auto_join_text_ed: " ",
                    auto_join_text_ing: " ",
                    auto_join_text_reply: " ",
                    auto_join_text_url: "",
                    loading_text: "loading tweets..."
                });

            });
        </script>        

        <div class="tweet"></div>
  
    <?php

        echo $after_widget;
    }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooTwitter");') );
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 
class EnvooQuotes extends WP_Widget
{
  function EnvooQuotes()
  {
    $widget_ops = array('classname' => 'EnvooQuotes', 'description' => 'Display a number of quotes from posts' );
    $this->WP_Widget('EnvooQuotes', 'Coolbue Quotes', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'envoo_number_fields' => '', 'envoo_category_id' => '' ) );
    $title = $instance['title'];
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_category_id = $instance['envoo_category_id'];
?>
  
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('envoo_number_fields'); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id('envoo_number_fields'); ?>" name="<?php echo $this->get_field_name('envoo_number_fields'); ?>" value="<?php echo esc_attr($envoo_number_fields); ?>" type="text" value="5" size="3"></p>
  
  
  
  <p><label for="<?php echo $this->get_field_id('envoo_category_id'); ?>">Category name:</label>
<?php
    $cats = get_terms('testimonial_category', 'orderby=none&hide_empty');
    echo '<select name="' . $this->get_field_name('envoo_category_id') . '" id="'. $this->get_field_id('envoo_category_id') . '">';
    foreach ($cats as $cat) { ?>
        <option <?php if ( $envoo_category_id == $cat->term_id ){ echo 'selected="selected"'; } ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
    <?php }
    echo "</select>";
    ?>
  </p>
   <?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['envoo_number_fields'] = $new_instance['envoo_number_fields'];
    $instance['envoo_category_id'] = $new_instance['envoo_category_id'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    global $wpdb;
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_category_id = $instance['envoo_category_id'];
    
    
    #$data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "envoo_recent_posts");
    
    $new_query = new WP_Query();
    $paged = '';
    $new_query->query( 'cat=' . $envoo_category_id . '&paged='.$paged . '&posts_per_page=' .  1 .'&order="DESC"' );
    
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    ?>

  <div class="quotes">
  <?php
  $i = 0;
  $count = $envoo_number_fields;
  $new_query->query( 'post_type=testimonials&paged='.$paged . '&posts_per_page=' . $count .'&order="DESC"' );
  while ($new_query->have_posts()) : $new_query->the_post(); ?>
  <article <?php if ( $i++ == 0 ){ echo 'class="quote-selected"'; } ?> >
      <p><?php the_content(); ?></p>
      <span><?php the_title(); ?></span>
  </article>         
  <?php endwhile; 
  ?>
  </div>
    <?php
 
    echo $after_widget;

  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooQuotes");') );












/*

class EnvooArchives extends WP_Widget
{
  function EnvooArchives()
  {
    $widget_ops = array('classname' => 'EnvooArchives', 'description' => 'Shows archive only for blog posts' );
    $this->WP_Widget('EnvooArchives', 'CoolBlue - Archives', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'envoo_number_fields' => '', 'envoo_category_id' => '' ) );
    $title = $instance['title'];
    $envoo_number_fields = $instance['envoo_number_fields'];
    $envoo_category_id = $instance['envoo_category_id'];
?>
  
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  
  
  
   <?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    global $wpdb;
  
    #$data = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "envoo_recent_posts");
    
    
    
    
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    
      $new_query = new WP_Query();
      $new_query->query( 'category_name=blog&posts_per_page=9999' );
      
      $array_of_months = array();
      $i = 0;
      
      
      while ($new_query->have_posts()) : $new_query->the_post();
        $array_of_months[$i++] = get_the_date('m') . '|' . get_the_date('F') . '|' . get_the_date('Y');
      endwhile;
            
      $array_of_months = array_unique($array_of_months);
      
      echo "<ul>";
      
      foreach( $array_of_months as $month ): 
          
           $month = explode('|',$month); 
          
           ?>
        
           <li><a href="<?php echo site_url() . '/' . $month[2] . '/' . $month[0]; ?>"><?php echo $month[1] . ' ' . $month[2]; ?></a></li>
  
      <?php endforeach;
      
      wp_reset_query();
    
    ?>
    <?php
 
    echo $after_widget;

  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooArchives");') );

*/


















 
class EnvooFlickr extends WP_Widget
{
  function EnvooFlickr()
  {
    $widget_ops = array('classname' => 'EnvooFlickr', 'description' => 'Shows a number of images from Flickr' );
    $this->WP_Widget('EnvooFlickr', 'CoolBlue -  Flickr', $widget_ops);
  }
  
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        
        $title = $instance['title'];
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

  <?php
        global $wpdb;
        $data = $wpdb->get_results("SELECT id, facebook, twitter, linkedin, vimeo, youtube, flickr FROM " . $wpdb->prefix . "envoo_account");
    
?>
  Your Flickr account: <strong> <?php echo $data[0]->flickr; ?> </strong>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    $title = $instance['title'];
    echo $before_widget;

    global $wpdb;
    $data = $wpdb->get_results("SELECT id, facebook, twitter, linkedin, vimeo, youtube, flickr FROM " . $wpdb->prefix . "envoo_account");
     if (!empty($title))
      echo $before_title . $title . $after_title;
     
    ?>
<?php 

$path = get_stylesheet_directory_uri() . '/admin-functions/flickr/';

require_once( $path . 'index.php');
?>

  <?php
    
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooFlickr");') );
  
  







class EnvooImage extends WP_Widget
{
  function EnvooImage()
  {
    $widget_ops = array('classname' => 'EnvooImages', 'description' => 'Choose a image to show on page' );
    $this->WP_Widget('EnvooImages', 'Shopifiq -  Images', $widget_ops);
  }
  
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        
        $title = $instance['title'];
    ?>
<?php $images =& get_children( 'post_type=attachment&post_mime_type=image' ); ?>
<select id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>">
<option value="">Select an image</option>
<?php foreach($images as $item) : ?>
    <option <?php if( $item->guid == $title ){echo 'selected="selected"';} ?> value="<?php echo $item->guid; ?>"><?php echo $item->post_title; ?></option>
<?php endforeach; ?>
</select>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    $title = $instance['title'];
    echo $before_widget;

    ?>

  <img alt="<?php echo $title; ?>" src="<?php echo $title; ?>" />

  <?php
    
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("EnvooImage");') );

















class BraPhotostreamWidget extends WP_Widget
{
	function BraPhotostreamWidget() {
		$widget_options = array(
		'classname'		=>		'bra-photostream-widget',
		'description' 	=>		'Showing photostream from Dribbble, Flickr, Pinterest or Instagram in your sidebar'
		);
		
		parent::WP_Widget('bra_photostream_widget', 'Photostream Widget', $widget_options);
	}

	
	function widget( $args, $instance ) {
		extract ( $args, EXTR_SKIP );
        if (!isset($instance['title'])) $instance['title'] = ""; 
        if (!isset($instance['social_network'])) $instance['social_network'] = "";  
        if (!isset($instance['user'])) $instance['user'] = "";  
        if (!isset($instance['limit'])) $instance['limit'] = ""; 
        if (!isset($instance['hover_color'])) $instance['hover_color'] = "#ffffff";   

        $root = get_template_directory_uri() . "/admin-functions/photostream/";

        wp_register_script( 'bra_photostream', $root."bra_photostream_widget.js", array('jquery'), '1.3', true );
        wp_enqueue_script( 'bra_photostream' );
        
        wp_register_style( 'bra_photostream', $root."bra_photostream_widget.css");
        wp_enqueue_style( 'bra_photostream' );

        
		$title = ( $instance['title'] ) ? $instance['title'] : '';
		$user = ( $instance['user'] ) ? $instance['user'] : 'envato';
        $social_network = ( $instance['social_network'] ) ? $instance['social_network'] : 'instagram'; 
        $limit = ( $instance['limit'] ) ? $instance['limit'] : '9';
        $hover_color = ( $instance['hover_color'] ) ? $instance['hover_color'] : '#ffffff';
		echo $before_widget;
		echo $before_title . $title . $after_title;
        
    $unique_id =  $user . $social_network . $limit ;
    $unique_id = preg_replace("/[^A-Za-z0-9]/", '', $unique_id);
    $html = '<div class="photostream clearfix" id="' . $unique_id  .'"></div>';
    $html .= '<script type="text/javascript"> jQuery(document).ready(function($){ ';
    $html .= '$("#' . $unique_id .'").bra_photostream({user: "' . $user . '", limit:' . $limit . ', social_network: "' . $social_network . '"});';
    $html .= '});</script>';

    //$html .= '<style type="text/css">';
    //$html .= '<!--';
    //$html .= ' .photostream li a:hover{background-color: ' . $hover_color . '!important; border: 1px solid ' . $hover_color . '!important; }';
    //$html .= '-->';
    //$html .= '</style>';
    echo $html;
?>

<?php

		echo $after_widget;
	}
          
        	
	function form( $instance ) {
        
        $root = get_stylesheet_directory_uri() . "/admin-functions/photostream/";
        wp_enqueue_script("miniColors", $root."jquery.miniColors.min.js", array('jquery'));
        wp_enqueue_style("miniColors", $root."jquery.miniColors.css");
        
        if (!isset($instance['title'])) $instance['title'] = "Your Photostream";  
        if (!isset($instance['user'])) $instance['user'] = "envato";  
        if (!isset($instance['limit'])) $instance['limit'] = "8";  
        if (!isset($instance['social_network'])) $instance['social_network'] = "instagram"; 
        if (!isset($instance['hover_color'])) $instance['hover_color'] = "#000000";   		
         
        ?>

        <p>
		<label for="<?php echo $this->get_field_id('title'); ?>">
		Title: 
		<input id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>" 
                class="widefat" type="text"/>
		</label>
        </p>

        <p>
		<label for="<?php echo $this->get_field_id('user'); ?>">
		Photostream user: 
		<input id="<?php echo $this->get_field_id('user'); ?>"
				name="<?php echo $this->get_field_name('user'); ?>"
				value="<?php echo esc_attr( $instance['user'] ); ?>" 
                class="widefat" type="text"/>
		</label>
		</p>
    
        <p>
		<label for="<?php echo $this->get_field_id('limit'); ?>">
		No of pics displayed: 
		<input id="<?php echo $this->get_field_id('limit'); ?>"
				name="<?php echo $this->get_field_name('limit'); ?>"
				value="<?php echo esc_attr( $instance['limit'] ); ?>" 
                class="" size="1"/>
		</label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('social_network'); ?>">
        Social Network
        
        <select name="<?php echo $this->get_field_name('social_network'); ?>" 
                  id="<?php echo $this->get_field_id('social_network'); ?>"
                  class="">
            <option value="dribbble" <?php if ($instance['social_network'] == "dribbble") echo 'selected="selected"' ?>>Dribbble</option>
            <option value="pinterest" <?php if ($instance['social_network'] == "pinterest") echo 'selected="selected"' ?>>Pinterest</option>
            <option value="flickr" <?php if ($instance['social_network'] == "flickr") echo 'selected="selected"' ?>>Flickr</option>
            <option value="instagram" <?php if ($instance['social_network'] == "instagram") echo 'selected="selected"' ?>>Instagram</option>
        </select>
        </label>
        </p>
        
        <p style="display: none">
        <label for="<?php echo $this->get_field_id('hover_color'); ?>">
        Hover color (with #): 
        <input id="<?php echo $this->get_field_id('hover_color'); ?>"
                name="<?php echo $this->get_field_name('hover_color'); ?>"
                value="<?php echo esc_attr( $instance['hover_color'] ); ?>" 
                class="color-picker" size="10"/>
        </label>
        </p>
    
        
        

		<?php 
	}
	
}
	
function bra_photostream_widget_init() {
	register_widget("BraPhotostreamWidget");
}
add_action('widgets_init','bra_photostream_widget_init');