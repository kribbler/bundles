<?php
/**
 * Shortcode Title: List modern
 * Shortcode: list_modern
 * Usage: [list_modern animation="bounceInUp" style="1"][list_modern_item title="Test title" icon="icon-glass"]Your text here...[/list_modern_item][/list_modern]
 */
add_shortcode('list_modern', 'ts_list_modern_func');

function ts_list_modern_func( $atts, $content = null ) {

	global $shortcode_items;

	extract(shortcode_atts(array(
		'animation' => '',
		'style' => 1,
		),
	$atts));

    $shortcode_items = array();
    do_shortcode($content);

	$li = '';
	foreach ($shortcode_items as $item) {

		$icon = '';

		if (!empty($item['icon']) && $item['icon'] != 'no') {
			$icon = '<i class="'.$item['icon'].' '.($style == 2 ? 'icon-3x' : '').'"></i>';
		}

		$li .= '<li><h5>'.$icon.' '.$item['title'].'</h5>'.$item['content'].'</li>';

	}
    $shortcode_items = array();

	switch ($style) {
		case 2:
			$content = '
				<ul class="arrow_sign_list '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					'.$li.'
				</ul>
				<div class="clear"></div>';
			break;

		case 1:
		default:
			$content = '
				<ul class="list_doted02 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
					'.$li.'
				</ul>
				<div class="clear"></div>';
			break;
	}



	return $content;
}

/**
 * Shortcode Title: list_modern_item - can be used only with tabs shortcode
 * Shortcode: list_modern_item
 * Usage:
 */
add_shortcode('list_modern_item', 'ts_list_modern_item_func');
function ts_list_modern_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'icon' => 'no'
    ), $atts));
    global $shortcode_items;
    $shortcode_items[] = array(
		'title' => $title,
		'icon' => $icon,
		'content' => trim(do_shortcode($content)));
}