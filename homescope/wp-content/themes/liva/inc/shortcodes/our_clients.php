<?php
/**
 * Shortcode Title: Images slider
 * Shortcode: our_clients
 * Usage: [our_clients animation="bounceInUp"][our_clients_item url="http://..." target="_blank"]image.png[/our_clients_item][/our_clients]
 */
add_shortcode('our_clients', 'ts_our_clients_func');

function ts_our_clients_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'animation' => '',
	    'header' => ''
    ), $atts));
	$rand = rand(15000,50000);

	return '
		<div class="clients '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<div class="container">
				<ul id="mycarouselthree" class="jcarousel-skin-tango">
					'.do_shortcode(shortcode_unautop($content)).'
				</ul>
			</div>
		</div><!-- end clients -->
		<script type="text/javascript">// <![CDATA[
			jQuery(document).ready(function() {
				jQuery("#mycarouselthree").jcarousel();
			});
			// ]]>
		</script>';
}

/**
 * Shortcode Title: Image item - can be used only with our_clients shortcode
 * Shortcode: our_clients_item
 */
add_shortcode('our_clients_item', 'ts_our_clients_item_func');
function ts_our_clients_item_func( $atts, $content = null )
{
	 extract(shortcode_atts(array(
	    'url' => '',
	    'target' => '',
    ), $atts));

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);

	$item = '<li>';
	$image = '<img src="'.$content.'">';
	if (!empty($url))
	{
		$item .= '<a href="'.$url.'" '.(!empty($target) ? 'target="'.$target.'"':'').'>'.$image.'</a>';
	}
	else
	{
		$item .= $image;
	}

	$item .= '</li>';

	return $item;
}