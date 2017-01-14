<?php

function recent_posts($atts, $content = null) {
   extract(shortcode_atts(array('quantity' => '5', 'cat' => '', 'show_image' => 'true', 'background' => 'true'), $atts));
   $output = "";
   $output .= '<div id="recent-box">';
		  global $post;
		  $posts = new WP_Query(array(
			  'post_type' =>'post',
			  'posts_per_page' => $quantity,
			  'cat' => $cat,
			  'orderby' => 'ASC'
		  ));
		  while($posts->have_posts()) : $posts->the_post();
		  if(trim($background) == 'true') $bg = 'raised'; else $bg = '';
		  $output .= '<div class="sidebar-item-box recent-post-item '.$bg.'">';
		  	if(trim($show_image) == 'true'){
		  	if ( has_post_thumbnail() ) {
			  
					  $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
					  $image_src = aq_resize( $thumbnail_src, 51, 51, true );
					  $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
					  $output .= '<a href="' .$thumbnail. '" class="post-image" title="' .get_the_title(). '" rel="prettyPhoto"><img src="'. $image_src .'" alt="' .get_the_title(). '" class="image-deco"/></a>';
				  
			  }else {
			  $format = get_post_format();
				  if($format == 'quote'){
				  $output .= '<span class="quote left image-deco"></span>';
				  }elseif($format == 'status'){
				  $output .= '<span class="status left image-deco"></span>';
				  }elseif($format == 'gallery'){
				  $output .= '<span class="gallery left image-deco"></span>';
				  }elseif($format == 'link'){
				  $output .= '<span class="link left image-deco"></span>';
				  }elseif($format == 'video'){
				  $output .= '<span class="video left image-deco"></span>';
				  }else{
				  $output .= '<span class="normal left image-deco"></span>';
				  }}}
				  $output .= '<h5><a href="' .get_permalink(). '" class="sidebar-item-title">' .get_the_title(). '</a></h5>';
				  $output .= '<p class="sidebar-item-date">Posted: '.human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago.</p>';
				  $output .= '</div>';
		  endwhile;wp_reset_query();
	  $output .='</div>
	  <div class="clear"></div>';
   return $output;
}
add_shortcode('recent_posts', 'recent_posts');


function recent_tweets($atts, $content = null) {
   extract(shortcode_atts(array('quantity' => '5', 'height' => '280', 'text_color' => '#666', 'link_color' => '#666', 'username' => ''), $atts));
   $output = "";
   $output .= '<script type="text/javascript" src="'.get_bloginfo( 'template_url' ).'/js/tweets.js"></script>
			<script>
			new TWTR.Widget({
				version: 2,
				type: "profile",
				width: 280,
				height: '.$height.',
				rpp: '.$quantity.',
				theme: {
					shell: {
						background: "transparent",
						color: "transparent"
					},
					tweets: {
						background: "transparent",
						color: "'.$text_color.'",
						links: "'.$link_color.'"
					}
				},
				features: {
					scrollbar: false,
					loop: false,
					live: true,
					hashtags: true,
					timestamp: true,
					avatars: true,
					behavior: "all"
  				}
			}).render().setUser("'.$username.'").start();
			</script>';
   return $output;
}
add_shortcode('recent_tweets', 'recent_tweets');


function recent_posts_big($atts, $content = null) {
	extract(shortcode_atts(array('quantity' => '4', 'cat' => '', 'column' => '4', 'carousel' => 'false', 'link_to' => '#', 'link_text' => '', 'margin_t' => '', 'margin_b' => '', 'effect' => ''), $atts));
	global $concept7_data;
	global $post;
	$columns= "";
	$padding="";
	if($column==1) $columns=''; elseif($column==2){ $columns= 'span6'; $padding="padding-recent-post-wrapper";}elseif($column==3) {$columns= 'span4'; $padding="padding-recent-post-wrapper";} else $columns= 'span3';
	
	$output = "";
	if($carousel == 'true' || $carousel == '1') {
		$output .= '<div class="recent-1-wrapper-carousel">';
	}else{
		$output .= '<div class="recent-1-wrapper">';
	}
	
	$portfolio_posts = new WP_Query(array(
					'post_type' =>'post',
					'posts_per_page' => $quantity,
					'orderby' => 'ASC'
				));
				$i = 0; 
	if($carousel == 'true' || $carousel == '1') {
		$output .= '<ul class="row recent-1-container effect-wrapper recent-1-carousel"  data-effect="'.$effect.'" style="margin-top:'.$margin_t.'px; margin-bottom:'.$margin_b.'px;">';
	}else{
		$output .= '<ul class="row effect-wrapper recent-1-container" data-effect="'.$effect.'" style="margin-top:'.$margin_t.'px; margin-bottom:'.$margin_b.'px;">';
	}
				
				
				while($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
				//if(($i % 3) == 0 && $carousel != '1') $columns .= ' last'; else $columns .= '';
				if($carousel == 'false' || $carousel == '0'){
					if($column == 1  && $i > 0) $output .= '<div class="clear"></div>';
					elseif($column == 2  && $i % 2 == 0 && $i > 0) $output .= '<div class="clear"></div>';
					elseif($column == 3  && $i % 3 == 0 && $i > 0) $output .= '<div class="clear"></div>';
					elseif($column >= 4 && $i % 4 == 0 && $i > 0) $output .= '<div class="clear"></div>';
				}
				$format = get_post_format();
				$not_status = '';
				if($format != 'video' && $format != 'status' && $format != 'gallery'){
					$not_status = 'not-status';
				}
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
				
            $output .= '<li class="effect-content portfolio-item '.$columns.' isotope-item post-sc '.$not_status.'"><div class="recent-post-wrapper '.$padding.'">';
			if($format == 'video'){
				$output .= stripslashes(htmlspecialchars_decode(get_post_meta( $post->ID, 'post-video-embed', true )));
			}elseif($format == 'gallery'){
				$output .='<div class="flexslider flexslider_m"><ul class="slides">';
					if(trim(get_post_meta($post->ID, 'post-image-1', true)) != ""){
					$output .='<li><img class="radius" src="'.aq_resize( get_post_meta( $post->ID, 'post-image-1', true ), 720, 540, true ).'"/></li>';
					}
					if(trim(get_post_meta($post->ID, 'post-image-2', true)) != ""){
					$output .='<li><img class="radius" src="'.aq_resize( get_post_meta( $post->ID, 'post-image-2', true ), 720, 540, true ).'"/></li>';
					}
					if(trim(get_post_meta($post->ID, 'post-image-3', true)) != ""){
					$output .='<li><img class="radius" src="'.aq_resize( get_post_meta( $post->ID, 'post-image-3', true ), 720, 540, true ).'"/></li>';
					}
					if(trim(get_post_meta($post->ID, 'post-image-4', true)) != ""){
					$output .='<li><img class="radius" src="'.aq_resize( get_post_meta( $post->ID, 'post-image-4', true ), 720, 540, true ).'"/></li>';
					}
					if(trim(get_post_meta($post->ID, 'post-image-5', true)) != ""){
					$output .='<li><img class="radius" src="'.aq_resize( get_post_meta( $post->ID, 'post-image-5', true ), 720, 540, true ).'"/></li>';
					}
						
				$output .='</ul></div>';
			}else{
			$output .= '<span class="da-t">';
				if ( has_post_thumbnail()) :
					$output .= '<img class="radius" src="'. aq_resize($thumbnail, 720, 540, true) .'"/>';
				endif;
				$output .= '<div class="hover-dir">
						<p class="portfolio-preview-time">'.get_the_time('F j, Y').'</p>
                        <p class="portfolio-preview-content">'.excerpt('10').'</p>
				</div></span>';
			}
			$categories = get_the_category();
			$cat_output = '';
			foreach($categories as $category) {
				$cat_output .= ', <a class="cat-link" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", "concept7" ), $category->name ) ) . '">'.$category->cat_name.'</a>';
			}
			$cat_output = trim(substr($cat_output, 1));
			if($format == 'status'){
				$content = apply_filters('the_content', get_the_content());
				$output .= $content;
			}elseif($format == 'quote'){
				$output .= '<h4><blockquote><a href="' .get_permalink(). '" class="title">' .get_the_title(). '</a></blockquote></h4>';
				$output .= '<div class="recent-post-meta"><div class="meta-category">'.$cat_output.'</div><div class="meta-cmt"><a href="'.get_comments_link().'">&nbsp;'.get_comments_number().'</a><i class="icon-comments"></i></div></div>';
			}elseif($format == 'gallery'){
				$output .= '<h4 class="h4 h4-gallery"><a href="' .get_permalink(). '" class="radius title">' .get_the_title(). '</a></h4>';
				$output .= '<div class="recent-post-meta"><div class="meta-category">'.$cat_output.'</div><div class="meta-cmt"><a href="'.get_comments_link().'">&nbsp;'.get_comments_number().'</a><i class="icon-comments"></i></div></div>';
			}else{
				$output .= '<h4><a href="' .get_permalink(). '" class="radius title">' .get_the_title(). '</a></h4>';
				$output .= '<div class="recent-post-meta"><div class="meta-category">'.$cat_output.'</div><div class="meta-cmt"><a href="'.get_comments_link().'">&nbsp;'.get_comments_number().'</a><i class="icon-comments"></i></div></div>';
			}
			
			$output.= '</div></li>';
			$i++;
           endwhile;wp_reset_query();
		   //$output .= '<div class="clear"></div>';
			if($link_text) $output .= '<div style="text-align:right; margin-top:0px;"><a class="portfolio-button btn btn-primary btn-style btn-arrow btn-arrow-style icon-angle-right" href="'.$link_to.'">'.$link_text.'</a></div><div class="clear"></div>';
		   $output .= '</ul>';
		   if($carousel == 'true' || $carousel == '1') $output .= '<div class="recent-1-arrow"><div class="recent-1-arrow-left"><i class="icon-angle-left"></i></div><div class="recent-1-arrow-right"><i class="icon-angle-right"></i></div></div>';
		   $output .= '</div><div class="clear"></div>';
   return $output;
}
add_shortcode('recent_posts_big', 'recent_posts_big');


?>