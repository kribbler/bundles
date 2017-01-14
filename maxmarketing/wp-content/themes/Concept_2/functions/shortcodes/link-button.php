<?php

function link_button($atts, $content = null) {
	global $concept7_data;
   extract(shortcode_atts(array('link' => '#', 'target' => '_self', 'align' => 'left', 'margin_t' => '', 'margin_b' => '', 'size' => '', 'icon' => '', 'bg_class' => '', 'text_class' => ''), $atts));
   $output = "";
   if($icon) $icon='<i class="'.$icon.'" style="color:inherit;"></i>';
   $output .= '<p style="line-height:inherit; text-align:'.$align.'; margin: '.$margin_t.'px auto '.$margin_b.'px;">
   					<a class="btn '.$bg_class.' '.$size.' '.$text_class.'" href="'.$link.'" target="'.$target.'">'.$icon.'' . do_shortcode($content) . '</a>
			   </p>';
   return $output;
}
add_shortcode('link_button', 'link_button');


function link_button_2($atts, $content = null) {
   global $concept7_data;
   extract(shortcode_atts(array('link' => '#', 'target' => '_self', 'align' => 'left', 'margin_t' => '', 'margin_b' => '', 'size' => '', 'icon' => '', 'bg_class' => '', 'text_class' => '', 'text_color' => '', 'bg_color' => ''), $atts));
 	$output = "";
   if(!function_exists('hex2rgb')){
	   $rgb = hex2rgb($text_color);
	   $text_color_hex = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',.8)';
	   if(preg_match('/^#[a-f0-9]{6}$/i', $text_color) || preg_match('/^#[a-f0-9]{3}$/i', $text_color)) {
		   $text_color_style="text_color_style".trim($text_color, "#");
		   echo'<style>
				.btn.no_colored_bg.'.$text_color_style.'{
					color: '.$text_color_hex.';	
				}
				.btn.no_colored_bg.'.$text_color_style.':hover{
					color: '.$text_color.';	
				}
		   </style>';
	   };
   };
   if(preg_match('/^#[a-f0-9]{6}$/i', $bg_color) || preg_match('/^#[a-f0-9]{3}$/i', $bg_color)) {
	   $bg_color_style="bg_color_style".trim($bg_color, "#");
	   echo'<style>
	   		.btn.no_colored_bg.'.$bg_color_style.'{
				background-color: '.$bg_color.';	
			}
	   </style>';
   };
   
   if($icon) $icon='<i class="'.$icon.'" style="color:inherit;"></i>';
   $output .= '<p style="line-height:inherit; text-align:'.$align.'; margin: '.$margin_t.'px auto '.$margin_b.'px;">
   					<a class="btn '.$bg_class.' '.$size.' '.$text_class.' '.$bg_color_style.' '.$text_color_style.'" href="'.$link.'" target="'.$target.'" >'.$icon.'' . do_shortcode($content) . '</a>
			   </p>';
   return $output;
   
}
add_shortcode('link_button_2', 'link_button_2');

function button_download($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#', 'target' => '_self', 'align' => 'center', 'color' => '#fbfbfb', 'bg_color' => ''), $atts));
   $output = "";
   global $concept7_data;
   if($bg_color == "") $bgcolor = $concept7_data['color_scheme'];
   
   else $bgcolor = $bg_color; 
   $output .= '<p style="line-height:inherit; text-align:'.$align.'"><a class="button" href="'.$link.'" target="'.$target.'" style="color:'.$color.';background:'.$bgcolor.';border:1px solid '.$bg_color.';"><span class="icon-font" style="font-size:30px;line-height:12px;padding-right:6px;font-weight:normal;color:'.$color.'">D</span>' . do_shortcode($content) . '</a></p>';
   return $output;
}
add_shortcode('button_download', 'button_download');

?>