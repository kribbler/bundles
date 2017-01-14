<?php
/**
 * Shortcode Title: Framed Box
 * Shortcode: framed_box
 * Usage: [framed_box animation="bounceInUp" title="Your title" icon="icon-search" color="#FFFFFF" background_color="#FF0000" button_text="Click me!" url="http://..." target="_self" list_icon="icon-search"][framed_box_item]Your content here...[/framed_box_item][/framed_box]

 */
add_shortcode('framed_box', 'ts_framed_box_func');

function ts_framed_box_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'title' => '',
		'icon' => '',
		'color' => '',
		'background_color' => '',
		'button_text' => '',
		'url' => '',
		'target' => '_self',
		'list_icon' => '',
		'effect' => 'no'
	),
	$atts));

	global $shortcode_items;
    $shortcode_items = array(); // clear the array
    do_shortcode($content); // execute the '[framed_box_item]' shortcode first to get the items

	$items_content = '';
	foreach ($shortcode_items as $item) {

		$items_content .= '<li>';
		if (!empty($list_icon) && $list_icon != 'no')
		{
			$items_content.= '<i class="'.$list_icon.'"></i>';
		}
		$items_content .= ''.$item['content'].'</li>';
	}
    $shortcode_items = array();

	if (!empty($icon) && $icon != 'no') {
		$icon_html = '<i class="'.$icon.' icon-large"></i>';
	}

	$content = '
		<div class="framed-box '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<div class="framed-box-wrap">
				<div class="pricing-title">
					<h3>'.$title.'</h3>
				</div>
				<div class="pricing-text-list">
					<ul class="list1">
						'.$items_content.'
					</ul>
					<br />
					<p><a href="'.$url.'" target="'.$target.'" class="but" style="'.(!empty($color) ? 'color:'.$color.';': '').''.(!empty($background_color) ? 'background-color:'.$background_color.';': '').'">'.$icon_html.' '.$button_text.'</a></p>
				</div>
			</div>
		</div>';
	return $content;
}

/**
 * Shortcode Title: Framed box item - can be used only with box shortcode
 * Shortcode: framed_box_item
 * Usage: [framed_box_item]Your content here[/framed_box_item]
 */
add_shortcode('framed_box_item', 'ts_framed_box_item_func');
function ts_framed_box_item_func( $atts, $content = null ) {

    global $shortcode_items;
    $shortcode_items[] = array(
		'content' => trim(do_shortcode($content)));
}