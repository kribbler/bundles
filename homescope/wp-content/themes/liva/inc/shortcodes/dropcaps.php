<?php
/**
 * Shortcode Title: Dropcaps
 * Shortcode: dropcaps
 * Usage: [dropcaps animation="bounceInUp" type="circle" color="#C4C4C4"]Your text here...[/dropcaps]
 */
add_shortcode('dropcaps', 'ts_dropcaps_func');

function ts_dropcaps_func( $atts, $content = null )
{
	if (empty($content))
	{
		return '';
	}

	extract(shortcode_atts(array(
		'animation' => '',
		'type' => '',
		'color' => '',
		'background' => '',
		),
	$atts));

	switch ($type) {
		case 'box':
			$class = 'dropcap2';
			break;

		case 'circle':
			$class = 'dropcap1';
			break;

		default:
			$class = 'dropcap3';
			break;
	}

	$styles = array();
	if ($color)
	{
		$styles[] = 'color: '.$color;
	}

	if ($background && in_array($type,array('circle','box')))
	{
		$styles[] = 'background-color: '.$background;
	}
	$style = '';
	if (count($styles) > 0)
	{
		$style = 'style="'.implode(';', $styles).'"';
	}

	$letter = substr($content,0,1);
	$content = substr($content,1);

	return '<p '.ts_get_animation_class($animation, true).' data-animation="'.$animation.'"><span class="'.$class.'" '.$style.'>'.$letter.'</span> '.$content.'</p>';
}