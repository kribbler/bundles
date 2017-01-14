<?php
global $concept7_data;
function hr($atts, $content = null) {
	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<hr style="margin: '.$margin_t.'px auto '.$margin_b.'px" />';
}
add_shortcode('hr', 'hr');

function hr_bottom($atts, $content = null) {
   return '<hr style="margin:5px auto 1px auto; width:80%;" /><hr style="margin:1px auto;width:75%;" /><hr style="margin:1px auto;width:70%;" />';
}
add_shortcode('hr_bottom', 'hr_bottom');

function br($atts, $content = null) {
   return '<br />';
}
add_shortcode('br', 'br');


function container($atts, $content = null) {
	extract(shortcode_atts(array('padding' => '15'), $atts));
   	return '<div class="pw-container" style="padding:'.$padding.'px;">'. do_shortcode($content) .'</div>';
}
add_shortcode('container', 'container');

function intro($atts, $content = null) {
   extract(shortcode_atts(array('title' => '', 'show_button' => 'true', 'link_to' => '#', 'link_text' => '', 'align' => 'left', 'font_size' => ''), $atts));
   $output = "";
   $output .= '<div class="intro-wrapper" style="text-align:'.$align.'"><div class="intro-bg"><div class="intro-bg-line"></div></div><div class="row"><div class="intro-content"><h2 style="font-size:'.$font_size.'px;" class="intro">'.$title.'</h2>'. do_shortcode($content).'</div>';
   if($show_button == 'true' || $show_button == '1') $output .= '<div class="intro-button"><a href="'.$link_to.'" class="btn">'.$link_text.'&nbsp;&nbsp;<i class="icon-chevron-right"></i></a></div>';
   $output .= '</div></div>';
   return $output;
}
add_shortcode('intro', 'intro');

function intro_small($atts, $content = null) {
   extract(shortcode_atts(array('subtitle' => ''), $atts));
   $output = "";
   $output .= '<span class="block-subtitle small">'.$subtitle.'</span><h2 class="intro small">'. do_shortcode($content) .'</h2>';
   return $output;
}
add_shortcode('intro_small', 'intro_small');

function intro_bold($atts, $content = null) {
   $output = "";
   $output .= '<span class="intro-bold">'. do_shortcode($content) .'</span>';
   return $output;
}
add_shortcode('intro_bold', 'intro_bold');


function intro_2($atts, $content = null) {
   $output = "";
   $output .= '<div class="intro-2"><h2>'. do_shortcode($content) .'</h2><img class="single-header-shadow" src="' .get_bloginfo('template_directory'). '/images/single-header-shadow.png"/></div><div class="clear"></div>';
   return $output;
}
add_shortcode('intro_2', 'intro_2');

function frame($atts, $content = null) {
	extract(shortcode_atts(array('link' => '', 'align' => 'alignleft', 'src' => '', 'width' => '400', 'height' => '', 'css' => ''), $atts));
	$output = '<div style="width:'.$width.'px;'.$css.'" class="sc-img-wrapper ' .$align. '">';
	if(trim($link) == ""){ $output .= '<img src="'.$src.'" />'; }
	else{ $output .= '<a rel="prettyPhoto" href="'.$link.'"><img style="'.$css.'" src="'.$src.'" /></a>'; }
	$output .= '</div>';
   	return $output;
}
add_shortcode('frame', 'frame');

function list_wrap($atts, $content = null) {
   return '<ul class="list_wrap">'. do_shortcode($content) .'</ul>';
}
add_shortcode('list_wrap', 'list_wrap');

function list_item($atts, $content = null) {
	extract(shortcode_atts(array('icon' => 'icon-ok', 'font_size' => '15'), $atts));
   return '<li style="font-size:'.$font_size.'px;"><i class="'.$icon.'"></i>'. do_shortcode($content) .'</li>';
}
add_shortcode('list_item', 'list_item');

function clear($atts, $content = null) {
	extract(shortcode_atts(array('size' => '0'), $atts));
   return '<div class="clear" style="height:'.$size.'px;"></div>';
}
add_shortcode('clear', 'clear');

function clear_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('size' => '0'), $atts));
   return '<div class="clear clear-shortcode" style="height:'.$size.'px;"></div>';
}
add_shortcode('clear_shortcode', 'clear_shortcode');


function paper($atts, $content = null) {
   return '<div class="paper">
		<div class="tape"></div>
		<div class="red-line first"></div>
		<div class="red-line"></div>
		<ul id="lines">
			'. do_shortcode($content) .'
		</ul>
		<div class="left-shadow"></div>
		<div class="right-shadow"></div>
	</div>';
}
add_shortcode('paper', 'paper');

function paper_line($atts, $content = null) {
   return '<li>'. do_shortcode($content) .'</li>';
}
add_shortcode('paper_line', 'paper_line');


function table($atts, $content = null) {
   extract(shortcode_atts(array('type' => ''), $atts)); 
   return '<table class="table '.$type.' ">'. do_shortcode($content) .'</table>';
}
add_shortcode('table', 'table');

function thead($atts, $content = null) {
   return '<thead>'. do_shortcode($content) .'</thead>';
}
add_shortcode('thead', 'thead');

function th($atts, $content = null) {
   return '<th>'. do_shortcode($content) .'</th>';
}
add_shortcode('th', 'th');

function tbody($atts, $content = null) {
   return '<tbody>'. do_shortcode($content) .'</tbody>';
}
add_shortcode('tbody', 'tbody');

function tr($atts, $content = null) {
   extract(shortcode_atts(array('type' => ''), $atts));
   return '<tr class="'.$type.'">'. do_shortcode($content) .'</tr>';
}
add_shortcode('tr', 'tr');

function td($atts, $content = null) {
   return '<td>'. do_shortcode($content) .'</td>';
}
add_shortcode('td', 'td');


function blockquote($atts, $content = null) {
   	return '<blockquote><p>'. do_shortcode($content) .'</p></blockquote>';
}
add_shortcode('blockquote', 'blockquote');


function dropcaps($atts, $content = null) {
   	return '<span class="dropcaps">'. do_shortcode($content) .'</span>';
}
add_shortcode('dropcaps', 'dropcaps');

function highlight($atts, $content = null) {
	extract(shortcode_atts(array('color' => '#fefefe', 'bg_color' => ''), $atts));
	if($bg_color != ""){$bgcolor = $bg_color;}else{$bgcolor="";}
   	return '<span class="highlight" style="color:'.$color.'; background:'.$bgcolor.';">'. do_shortcode($content) .'</span>';
}
add_shortcode('highlight', 'highlight');


function team($atts, $content = null) {
	extract(shortcode_atts(array('image' => '','name' => '', 'position' => '', 'mail' => '#','facebook_url' => '', 'twitter_url' => '', 'google_url' => '', 'dribbble_url' => ''), $atts));
	$output = "";
	$output .= '<div id="team">
					<div class="team-content">
						<p>'. do_shortcode($content) .'</p>
						<div class="social-icons">';
					if($facebook_url) $output .= '<a href="'.$facebook_url.'"><img src="'.get_template_directory_uri().'/images/social/facebook.png" alt="facebook" /></a>';
					if($twitter_url) $output .= '<a href="'.$twitter_url.'"><img src="'.get_template_directory_uri().'/images/social/twitter.png" alt="twitter" /></a>';
					if($google_url) $output .= '<a href="'.$google_url.'"><img src="'.get_template_directory_uri().'/images/social/google.png" alt="google" /></a>';
					if($dribbble_url) $output .= '<a href="'.$dribbble_url.'"><img src="'.get_template_directory_uri().'/images/social/dribbble.png" alt="dribbble" /></a>';
		 $output .=	'</div>
					</div>
					<div class="team-info">
						<div class="team-img-wrapper">
							<div class="team-img"><img src="'.$image.'"></div>
						</div>
						<h2 class="team-name">'.$name.'</h2>
						<h3 class="team-position">'.$position.'</h3>
						<span><a class="team-mail" href="mailto:' .$mail. '">'.$mail.'</a></span>
					</div>
				</div>';
   	return $output;
}
add_shortcode('team', 'team');

function block_section_left($atts, $content = null) {
	extract(shortcode_atts(array('title' => '','image' => '', 'link_to' => '', 'link_text' => '', 'margin_top' => '', 'effect' => ''), $atts));
	if($margin_top) $margin_t = 'style="margin-top:'.$margin_top.'px;"';
	$output = "";
	$output .= '<div id="block-section-wrapper" class="effect-wrapper block-section-left row" data-effect="'.$effect.'">
					<div class="effect-content block-section-img-wrapper span6">
						<img src="'.$image.'" alt="'.$title.'" />
					</div>
					<div class="effect-content block-section-content-wrapper span6">
						<h3 '.$margin_t.'>'.$title.'</h3>
						<p>' .do_shortcode($content). '</p>';
	if($link_text) $output .= '<a href="'.$link_to.'" class="btn btn-primary">'.$link_text.'</a>';
	$output .= '</div></div>';
   	return $output;
}
add_shortcode('block_section_left', 'block_section_left');

function block_section_right($atts, $content = null) {
	extract(shortcode_atts(array('title' => '','image' => '', 'link_to' => '', 'link_text' => '', 'margin_top' => '', 'effect' => ''), $atts));
	if($margin_top) $margin_t = 'style="margin-top:'.$margin_top.'px;"';
	$output = "";
	$output .= '<div id="block-section-wrapper" class="effect-wrapper block-section-right row" data-effect="'.$effect.'">
					<div class="effect-content block-section-content-wrapper span6">
						<h3 '.$margin_t.'>'.$title.'</h3>
						<p>' .do_shortcode($content). '</p>';
	if($link_text) $output .= '<a href="'.$link_to.'" class="btn btn-primary">'.$link_text.'</a>';
	$output .=	'</div><div class="effect-content block-section-img-wrapper span6">
						<img src="'.$image.'" alt="'.$title.'" />
					</div></div>';
   	return $output;
}
add_shortcode('block_section_right', 'block_section_right');

function timeline_wrap($atts, $content = null) {
   	return '<div class="timeline-wrapper"><div class="timeline hidden-phone"></div>'.do_shortcode($content).'</div>';
}
add_shortcode('timeline_wrap', 'timeline_wrap');

function timeline($atts, $content = null) {
	extract(shortcode_atts(array('title' => '','date' => '', 'year' => '','class' => ''), $atts));
	$output = "";
	$output .= '<div id="history-wrapper" class="history'.$class.' row-fluid">
				<div class="history-content-wrapper span8">
					<h4 class="history-title">'.$title.'</h4>
					<p>' .do_shortcode($content). '</p>
				</div>
				<div class="time-wrapper span4"><h5>' .$date. '</h5>
				<div class="history-btn-rounded hidden-phone"><div class="history-btn-rounded-center"></div></div>
				<h4 class="btn btn-primary white-color">' .$year. '</h4></div>
				';
	$output .=	'</div>';
   	return $output;
}
add_shortcode('timeline', 'timeline');

function timeline_even($atts, $content = null) {
	extract(shortcode_atts(array('title' => '','date' => '', 'year' => '', 'class' => ''), $atts));
	$output = "";
	$output .= '<div id="history-wrapper" class="history history-even '.$class.' row-fluid">
				<div class="time-wrapper span4"><h5>' .$date. '</h5>
				<div class="history-btn-rounded hidden-phone"><div class="history-btn-rounded-center"></div></div>
				<h4 class="btn btn-primary white-color">' .$year. '</h4></div>
				<div class="history-content-wrapper span8">
					<h4 class="history-title">'.$title.'</h4>
					<p>' .do_shortcode($content). '</p>
				</div>
				';
	$output .=	'</div>';
   	return $output;
}
add_shortcode('timeline_even', 'timeline_even');

function message_box($atts, $content = null) {
 	extract(shortcode_atts(array('type' => '', 'title' => '','margin_top' => '', 'margin_bottom' => ''), $atts));
    return ' <div class="alert ' .$type. '" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><button type="button" class="bst_close" data-dismiss="alert"> &times; </button><strong>' .$title. '</strong> ' .do_shortcode($content). '
    </div>';
}
add_shortcode('message_box', 'message_box');

function divider_1($atts, $content = null) {
	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<div class="divider-1" style="margin: '.$margin_t.'px auto '.$margin_b.'px">
		<div class="line-1">
			<ul>
				<li><i class="icon-star-empty"></i></li>
				<li><i class="icon-star-empty"></i></li>
			</ul>
		</div>
	</div>';
}
add_shortcode('divider_1', 'divider_1');

function divider_2($atts, $content = null) {
	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<div class="divider-2" style="margin: '.$margin_t.'px auto '.$margin_b.'px"><img src="'.get_bloginfo('template_url').'/images/divider/divider-2.png" /></div>';
}
add_shortcode('divider_2', 'divider_2');

function divider_3($atts, $content = null) {
   	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<div class="divider-3" style="margin: '.$margin_t.'px auto '.$margin_b.'px"><hr /></div>';
}
add_shortcode('divider_3', 'divider_3');

function divider_4($atts, $content = null) {
   	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<div class="divider-4" style="margin: '.$margin_t.'px auto '.$margin_b.'px"><img src="'.get_bloginfo('template_url').'/images/divider/divider-4.png" /></div>';
}
add_shortcode('divider_4', 'divider_4');

function divider_5($atts, $content = null) {
   	extract(shortcode_atts(array('margin_t' => '10','margin_b' => '10'), $atts));
   	return '<div class="divider-5" style="margin: '.$margin_t.'px auto '.$margin_b.'px"><img src="'.get_bloginfo('template_url').'/images/divider/divider-5.png" /></div>';
}
add_shortcode('divider_5', 'divider_5');
function divider_6($atts, $content = null) {
   	extract(shortcode_atts(array('margin_t' => '20','margin_b' => '20'), $atts));
   	return '<div class="blog-break" style="margin: '.$margin_t.'px auto '.$margin_b.'px"><div class="to-top"></div><hr /><hr /><hr /></div>';
}
add_shortcode('divider_6', 'divider_6');

function carousel_wrapper( $atts, $content = null ) {
   extract( shortcode_atts( array('id' => ''), $atts ) );
   return ' <div id="myCarousel-'.$id.'" class="carousel slide">
				  <div class="carousel-inner">
					' . do_shortcode($content) . '
				  </div>
				  <a class="carousel-control left" href="#myCarousel-'.$id.'" data-slide="prev">&lsaquo;</a>
				  <a class="carousel-control right" href="#myCarousel-'.$id.'" data-slide="next">&rsaquo;</a>
			</div>';
}
add_shortcode( 'carousel_wrapper', 'carousel_wrapper' );

function carousel_item( $atts, $content = null ) {
   extract( shortcode_atts( array('src' => '', 'title' => ''), $atts ) );
   return ' <div class="item">
			  <img src="'.$src.'" alt="">
			  <div class="carousel-caption">
				<h4>'.$title.'</h4>
				<p>' . do_shortcode($content) . '</p>
			  </div>
			</div>';
}
add_shortcode( 'carousel_item', 'carousel_item' );

function gallery_images_wrapper($atts, $content = null) {
   return '
   <div class="gallery-wrapper row">
		<ul class="portfolio-items">
			' . do_shortcode($content) . '
		</ul>
   </div>';
}
add_shortcode('gallery_images_wrapper', 'gallery_images_wrapper');

function gallery_images($atts, $content = null) {
   extract( shortcode_atts( array('src' => '', 'date' => '', 'link_to' => '', 'link_text' => '', 'span' => '' ), $atts ) );
   return '
    <li class="item '.$span.'">
      <div class="item-info">
        <div class="view">
         <img src="'.$src.'" />
        </div>
        <div class="item-detail">
          <p><span><a href="'.$link_to.'">'.$link_text.'</a></span></p>
          <p><span>' . do_shortcode($content) . '</span></p>
        </div>
      </div>
      <div class="date">'.$date.'</div>
    </li>';
}
add_shortcode('gallery_images', 'gallery_images');
?>