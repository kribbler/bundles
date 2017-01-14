<?php
/**
 * Shortcode Title: Social Links
 * Shortcode: social_links
 * Usage: [social_links animation="bounceInUp"][social_link icon="icon-facebook" title="Facebook" url="http://facebook.com" target="_blank"][/social_links]
 */
add_shortcode('social_links', 'ts_social_links_func');

function ts_social_links_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	global $shortcode_links;
    $shortcode_links = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$items = '';
	$i = 1;
	foreach ($shortcode_links as $link) {

		$items .= '<li><a href="'.$link['url'].'" target="'.$link['target'].'"><i class="'.$link['icon'].'"></i> '.$link['title'].'</a></li>';
		$i++;
	}
    $shortcode_links = array();

	$html = '
		<ul class="sc_social_links '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			'.$items.'
		</ul>
		<div class="clear"></div>';
	return $html;
}

/**
 * Shortcode Title: Social link - can be used only with social_links shortcode
 * Shortcode: social_link
 * Usage: [social_links][social_link icon="icon-facebook" title="Facebook" url="http://facebook.com" target="_blank"][/social_links]
 */
add_shortcode('social_link', 'ts_social_link_func');
function ts_social_link_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon' => 'no',
	    'title' => '',
	    'url' => '',
	    'target' => ''
    ), $atts));
    global $shortcode_links;
    $shortcode_links[] = array(
		'icon' => $icon,
		'title' => $title,
		'url' => $url,
		'target' => $target);
}