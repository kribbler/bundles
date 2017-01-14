<?php

function latest_portfolio($atts, $content = null) {
	extract(shortcode_atts(array('quantity' => '4', 'cat' => '', 'column' => '4', 'carousel' => 'false', 'link_to' => '#', 'link_text' => '', 'style' => '', 'effect' => 'none','margin_top' => '', 'margin_bottom' => ''), $atts));
	global $concept7_data;
	global $post;
	$columns= "";
	$last= "";
	$wrapper_style = "";
	if($column==1) $columns='span4'; elseif($column==2) $columns= 'span6'; elseif($column==3) $columns= 'span4'; 
	else {
		$columns= 'span3';
	}
	
	if($column==1) $style='style="width:100%; margin:0; margin-bottom:20px;"';
	$output = "";
	$output .= '<div class="portfolio-1-wrapper" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
				$portfolio_posts = new WP_Query(array(
					'post_type' =>'portfolio',
					'posts_per_page' => $quantity,
					'portfolio_cats' => $cat,
					'orderby' => 'ASC'
				));
				$i = 1;
			if($carousel == 'true' || $carousel == '1'){
				$output .= '<ul class="portfolio-1-container effect-wrapper" data-effect="'.$effect.'">';
			}else{
				$output .= '<ul class="row effect-wrapper" data-effect="'.$effect.'">';
			}
				while($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
				if($columns == 3){
					if(($i % 3) == 0 && $carousel != '1') $last = ' last'; else $last = '';
				}elseif($columns == 4){
					if(($i % 4) == 0 && $carousel != '1') $last = ' last'; else $last = '';
				}
            $output .= '<li class="effect-content portfolio-item '.$columns.$last.' not-status" '.$style.'>';
			$output .= '<div class="portfolio-item-wrapper"><span class="da-t">';
                    	if ( has_post_thumbnail()) :
							if($concept7_data['port_resize']){
								$wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
							}else{
								$wr = 460; $hr = 340;
							} 
                            $output .= '<img class="radius" src="'. aq_resize($thumbnail, $wr, $hr, true) .'" alt="'.get_the_title().'"/>';
                       	endif;
						$output .= '<div class="hover-dir">
							<p class="portfolio-preview-time">'.get_the_time('F j, Y').'</p>
                        <p class="portfolio-preview-content">'.excerpt('15').'</p>
                        <a href="'.$thumbnail.'" rel="prettyPhoto"><h2><i class="icon-eye-open"></i></h2></a>
						</div>';
						$output .= '</span>
						<div class="portfolio-item-title">
                        	<h4><a href="' .get_permalink(). '">' .get_the_title(). '</a></h4>';
							$terms = get_the_terms($post->ID, 'portfolio_cats');
							$output .= '<p class="terms">';
							foreach ( $terms as $term ){
								$output .= '<a href="' .get_term_link($term->slug, 'portfolio_cats') .'">'.$term->name.'</a>&nbsp;';
							}
						$output .= '</p></div></div></li>';
			$i++;
           endwhile;wp_reset_query();
		   $output .= '</ul>';
		   if($carousel == 'true' || $carousel == '1') $output .= '<div class="portfolio-1-arrow"><div class="portfolio-1-arrow-left"><i class="icon-angle-left"></i></div><div class="portfolio-1-arrow-right"><i class="icon-angle-right"></i></div></div>';
		   $output .= '</div>';
    if($link_text) $output .= '<div style="text-align:center;"><a class="portfolio-button btn btn-primary btn-style btn-arrow btn-arrow-style icon-angle-right" href="'.$link_to.'">'.$link_text.'</a></div><div class="clear"></div>';

   return $output;
}
add_shortcode('latest_portfolio', 'latest_portfolio');



function latest_portfolio_small($atts, $content = null) {
	extract(shortcode_atts(array('quantity' => '4', 'cat' => '', 'column' => '4', 'carousel' => 'false','margin_top' => '', 'margin_bottom' => ''), $atts));
	global $concept7_data;
	global $post;
	$columns= "";
	$output = "";
	if($carousel != 'false') $carousel = 'pw-carousel';
	$output .= '<div class="portfolio-container" style="position:relative; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">
    	<section><ul class="da-thumbs '.$carousel.'" style="text-align:center;">';
				$portfolio_posts = new WP_Query(array(
					'post_type' =>'portfolio',
					'posts_per_page' => $quantity,
					'portfolio_cats' => $cat,
					'orderby' => 'ASC'
				));
				while($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
				
            $output .= '<li class="portfolio-item one-third column isotope-item not-status" style="margin:0 0 -2px; padding:0px; border:none; float:none; display:inline-block;">';
			$output .= '<span class="da-t no-margin">';
                    	if ( has_post_thumbnail()) :
							if($concept7_data['port_resize']){
								$wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
							}else{
								$wr = 460; $hr = 340;
							}
                            
                            $output .= '<img src="'. aq_resize($thumbnail, $wr, $hr, true) .'" alt="'.get_the_title().'"/>';
                       	endif;
						$output .= '<div class="hover-dir"><span class="terms">';
						$terms = get_the_terms($post->ID, 'portfolio_cats');
						foreach ( $terms as $term ){
						$output .= '<a href="' .get_term_link($term->slug, 'portfolio_cats') .'">'.$term->name.'</a>&nbsp;';
						}
						$output .= '</span><h4><a href="'.get_permalink().'" class="title">'. get_the_title(). '</a></h4><a class="portfolio-preview" href="'.$thumbnail.'" rel="prettyPhoto">'.__('preview', 'concept7').'</a></div></span>';
						
						$output.= '</li>';
           endwhile;wp_reset_query();
        $output .= '</ul></section></div><div class="clear"></div>';

   return $output;
}
add_shortcode('latest_portfolio_small', 'latest_portfolio_small');


function latest_portfolio_2($atts, $content = null) {
	extract(shortcode_atts(array('quantity' => '12', 'style' => '', 'effect' => '','margin_top' => '', 'margin_bottom' => ''), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .= '<div class="portfolio-2-wrapper" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
		$portfolio_posts = new WP_Query(array(
			'post_type' =>'portfolio',
			'posts_per_page' => $quantity,
			'orderby' => 'ASC'
		));
		$i = 1;
 	$output .= '<div class="row">
			  <div class="portfolio-2-container span10 offset1">
				  <div class="portfolio-2-content portfolio-2-content-first"><div class="row-fluid effect-wrapper" data-effect="'.$effect.'">';
  	while($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
  	$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
		  $output .= '<div class="portfolio-item effect-content not-status span4" '.$style.'>';
 	$output .= '<div class="portfolio-item-wrapper"><span class="da-t">';
    
	 if ( has_post_thumbnail()) :
	 	 if($concept7_data['port_resize']){
	    	$wr = $concept7_data['resize_option_1']; $hr = $concept7_data['resize_option_2'];
		}else{
			$wr = 460; $hr = 340;
		}
			$output .= '<img class="radius" src="'. aq_resize($thumbnail, 249, 180, true) .'" alt="'.get_the_title().'"/>';
	endif;
   
	$output .= '<div class="hover-dir">
						<p class="portfolio-preview-time">'.get_the_time('F j, Y').'</p>
                        <p class="portfolio-preview-content">'.excerpt('10').'</p>';
						$port = get_post_meta( $post->ID, 'port', true );
						if(!empty($port)){
							$port_type = $port['only'][0];
						}else{
							$port_type = 'slider';
						}
						$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
						if($port_type == 'vimeo' || $port_type == 'youtube'){
							$output .= '<a href="'.$video_embed_code.'" rel="prettyPhoto"><i class="icon-play"></i></a>';
						}else{
							$output .= '<a href="'.$thumbnail.'" rel="prettyPhoto"><i class="icon-eye-open"></i></a>';
						}
	$output .= '</div></span>
	<div class="portfolio-item-title">
					   <h4><a href="' .get_permalink(). '">' .get_the_title(). '</a></h4>';
					   $terms = get_the_terms($post->ID, 'portfolio_cats');
					   $output .= '<p class="terms">';
						foreach ( $terms as $term ){
						$output .= '<a href="' .get_term_link($term->slug, 'portfolio_cats') .'">'.$term->name.'</a>&nbsp;';
						}
						$output .= '</p>';
					  $output.= '</div></div></div>';
	if($i%3 == 0 && $i%6 != 0) $output .= '</div><div class="row-fluid effect-wrapper" data-effect="'.$effect.'">'; else $output .= '';
	if($i%6 == 0 && $i%12 != 0) $output .= '</div></div><div class="portfolio-2-content"><div class="row-fluid effect-wrapper" data-effect="'.$effect.'">'; else $output .= '';
 	$i++;
		 endwhile;wp_reset_query();
   $output .= '</div></div></div></div>';				   
   $output .= '<div class="clearfix"></div><div class="portfolio-2-dir left-dir"><i class="icon-angle-left"></i></div><div class="portfolio-2-dir right-dir"><i class="icon-angle-right"></i></div></div>';
 return $output;
}
add_shortcode('latest_portfolio_2', 'latest_portfolio_2');

function latest_portfolio_masonry($atts, $content = null) {
	extract(shortcode_atts(array('quantity' => '12', 'style' => '', 'effect' => '', 'categories' => '', 'hide_filter' => '', 'margin_top' => '', 'margin_bottom' => ''), $atts));
	global $concept7_data;
	global $post;
	$output = '';
	if($categories){
		$cat_arr = explode(',', $categories);
		$wp_query = new WP_Query(array(
			'post_type' =>'portfolio',
			'posts_per_page' => $quantity,
			'orderby' => 'ASC',
			'tax_query' => array(
									array('taxonomy'=>'portfolio_cats',
										  'field'=>'id',
										  'terms'=> $cat_arr,
										  'operator' => 'IN'
									  )
								  )
		));
	}else{
		$wp_query = new WP_Query(array(
			'post_type' =>'portfolio',
			'posts_per_page' => $quantity,
			'orderby' => 'ASC'
		));
	}
    if($wp_query->have_posts()) {
		if($hide_filter != 'true' && $hide_filter != 1){
		$output .= '<div id="portfolio-filter">
		
			<ul class="filter-option">
				<li class="filterable current">
					<a href="#" data-filter="*">'. __( 'All', 'concept7') .'</a>
				</li>';
				$cats = get_terms('portfolio_cats',array(
										'include' => $categories
									 ));
				foreach ($cats as $cat ) :
				$output .= '<li class="filterable">
					/&nbsp;&nbsp;&nbsp;<a href="#" data-filter=".'.$cat->slug.'">'.$cat->name.'</a>
				</li>';
				endforeach;
			$output .= '</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>';
		}
		$output .= '<section style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">
			<ul class="row portfolio-masonry effect-wrapper" data-effect="'.$effect.'">';
			
		$i = 0;
		$j = 1;
		$span = '';
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			if($i==0 || $i%6 == 0 || $j%6 == 0) $span = 'span6'; else $span = 'span3';
           $output .= '<li class="portfolio-item effect-content '.$span.' isotope-item';
		    $terms = get_the_terms($post->ID, 'portfolio_cats');
			if($terms){
				foreach ( $terms as $term ){
					$output .= ' '.$term->slug.' ';
				}
			}
			$output .= '">
				<div class="portfolio-item-wrapper">';
				$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
					$output .= '<span class="da-t">';
						if ( has_post_thumbnail()) :
								if($i==0 || $i%6 == 0 || $j%6 == 0){
									$wr = 460; $hr = 310;
								}else{
									$wr = 220; $hr = 310;
								}
							$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
							
							$output .= '<img src="'.aq_resize($thumbnail, $wr, $hr, true).'" alt="'.get_the_title().'"/>';
						endif;
						  
						$port = get_post_meta( $post->ID, 'port', true );
						if(!empty($port)){
							$port_type = $port['only'][0];
						}else{
							$port_type = 'slider';
						}
						$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
						
						$output .= '<div class="media-icon">';
							if($port_type == 'vimeo'){
							$output .= '<a class="portfolio-preview" href="'.$video_embed_code.'" rel="prettyPhoto">
								<i class="icon-play"></i>
							</a>';
							}elseif($port_type == 'youtube'){
							$output .= '<a class="portfolio-preview" href="'.$video_embed_code.'" rel="prettyPhoto">
								<i class="icon-play"></i>
							</a>';
							}else{
							$output .= '<a class="portfolio-preview" href="'.$thumbnail.'" rel="prettyPhoto">
								<i class="icon-eye-open"></i>
							</a>';
							}
						$output .= '</div>
						<div class="portfolio-item-title">
							<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
							$i_terms = get_the_terms($post->ID, 'portfolio_cats');
							if($terms){
								$output .= '<p class="terms">';
								foreach ( $i_terms as $i_term ){
									$output .= '<a href="' .get_term_link($i_term->slug, 'portfolio_cats') .'">'.$i_term->name.'</a>&nbsp;';
								}
								$output .= '</p>';
							}
						$output .= '</div>
					</span>
				</div>
				
			</li>';
			$i++; $j++;
			endwhile; wp_reset_query();
           $output .= '</ul>
        </section>';
        }
	return $output;
}
add_shortcode('latest_portfolio_masonry', 'latest_portfolio_masonry');

?>