<?php

function column_bg( $atts, $content = null ) {
   extract( shortcode_atts( array('image' => '', 'color' => '#fafafa', 'position' => 'top left', 'repeat' => '', 'text_color' => '', 'height' => '100%', 'gradient' => ''), $atts ) );
   $style = '';
   if($text_color == 'white') $text_class = ' column-bg-white'; else  $text_class = '';
   if($gradient == 'true' || $gradient == 1){
   		if($image){
			$style = 'background-image: url('.$image.'), -moz-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), -o-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), -webkit-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);';
		}else{
			$style = 'background-image: -moz-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:-o-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:-webkit-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);';
		}
   }
   if($repeat == 1 || $repeat == 'true') $bg_repeat = 'repeat'; else $bg_repeat = 'no-repeat';
   return '<div class="column-bg'.$text_class.'" style="background-image:url('.$image.'); background-color:'.$color.'; background-position:'.$position.'; background-repeat:'.$bg_repeat.'; height:'.$height.';'.$style.'"></div>';
}

add_shortcode( 'column_bg', 'column_bg' );

function column_bg_concept( $atts, $content = null ) {
	extract( shortcode_atts( array('image' => '', 'color' => '#fafafa', 'position' => 'top left', 'repeat' => '', 'text_color' => '', 'height' => '100%', 'gradient' => ''), $atts ) );
	$style = '';
	if($text_color == 'white') $text_class = ' column-bg-white'; else  $text_class = '';
	if($gradient == 'true' || $gradient == 1){
		if($image){
			$style = 'background-image: url('.$image.'), -moz-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), -o-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), -webkit-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image: url('.$image.'), linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);';
		}else{
			$style = 'background-image: -moz-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:-o-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:-webkit-linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);background-image:linear-gradient(bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,.13) 100%);';
		}
	}
	if($repeat == 1 || $repeat == 'true') $bg_repeat = 'repeat'; else $bg_repeat = 'no-repeat';
	if(!$height) $height = '100%';
   	return '<div class="aq-block aq-block-aq_column_block span12">
				<div class="row">
					' . do_shortcode( $content ) . '
					<div class="aq-block aq-block-aq_background_block span12">
						<div class="column-bg'.$text_class.'" style="background-image:url('.$image.'); background-color:'.$color.'; background-position:'.$position.'; background-repeat:'.$bg_repeat.'; height:'.$height.';'.$style.'"></div>
					</div>
				</div>
			</div>';
   
}
add_shortcode( 'column_bg_concept', 'column_bg_concept' );

function one_third_fw( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => ''), $atts));
   	return '<div class="one-third column '.$type.'">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_third_fw', 'one_third_fw' );


function two_third_fw( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => ''), $atts));
   	return '<div class="two-thirds column '.$type.'">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'two_third_fw', 'two_third_fw' );


function one_half_fw( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => ''), $atts));
   	return '<div class="eight columns '.$type.'">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_half_fw', 'one_half_fw' );


function one_fourth_fw( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => ''), $atts));
   	return '<div class="four columns '.$type.'">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_fourth_fw', 'one_fourth_fw' );


function three_fourth_fw( $atts, $content = null ) {
	extract(shortcode_atts(array('type' => ''), $atts));
   	return '<div class="twelve columns '.$type.'">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'three_fourth_fw', 'three_fourth_fw' );

?>
