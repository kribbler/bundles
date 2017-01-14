<?php
/**
 * Shortcode Title: Promo
 * Shortcode: promo
 * Usage: [promo animation="bounceInUp" title="Your title" subtitle="Your subtitle" image="image.png" icon1="icon-glass" icontitle1="Icon title" iconsubtitle="Icon subtitle" icon2="ico-glass" icontitle2="Icon title" iconsubtitle2="Icon subtitle" icon3="ico-search" icontitle3="Icon title" iconsubtitle3="Icon subtitle" icon4="" icontitle4="" iconsubtitle4="" icon5="" icontitle5="" iconsubtitle5="" icon6="" icontitle6="" iconsubtitle6=""]
 */
add_shortcode('promo', 'promo_func');

function promo_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
		'title' => '',
		'subtitle' => '',
		'image' => '',
		'icon1' => '',
		'icontitle1' => '',
		'iconsubtitle1' => '',
		'icon2' => '',
		'icontitle2' => '',
		'iconsubtitle2' => '',
		'icon3' => '',
		'icontitle3' => '',
		'iconsubtitle3' => '',
		'icon4' => '',
		'icontitle4' => '',
		'iconsubtitle4' => '',
		'icon5' => '',
		'icontitle5' => '',
		'iconsubtitle5' => '',
		'icon6' => '',
		'icontitle6' => '',
		'iconsubtitle6' => ''
		),
	$atts));

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
//	$content = str_replace('&#215;','x',$content);

	return '
		<div class="features_sec02 '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<h1>'.$title.'
				<br>
				<i>'.$subtitle.'</i>
			</h1>

			<div class="left">
				<div class="one"><i class="'.$icon1.' icon-2x"></i> <b>'.$icontitle1.'<br><em>'.$iconsubtitle1.'</em></b></div>
				<div class="two"><i class="'.$icon2.' icon-2x"></i> <b>'.$icontitle2.'<br><em>'.$iconsubtitle2.'</em></b></div>
				<div class="one"><i class="'.$icon3.' icon-2x"></i> <b>'.$icontitle3.'<br><em>'.$iconsubtitle3.'</em></b></div>
			</div><!-- end left-->

			<div class="center" style="background-image: url('.$image.');"></div><!-- end img-->

			<div class="right">
				<div class="one"><i class="'.$icon4.' icon-2x"></i> <b>'.$icontitle4.'<br><em>'.$iconsubtitle4.'</em></b></div>
				<div class="two"><i class="'.$icon5.' icon-2x"></i> <b>'.$icontitle5.'<br><em>'.$iconsubtitle5.'</em></b></div>
				<div class="one"><i class="'.$icon6.' icon-2x"></i> <b>'.$icontitle6.'<br><em>'.$iconsubtitle6.'</em></b></div>
			</div><!-- end right-->
		</div>
		<div class="clear"></div>';

}