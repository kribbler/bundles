<?php
function accordion_item($atts, $content = null) {
   extract(shortcode_atts(array('accordion_id' => '','heading' => ''), $atts));
   return
		'<div class="accordion-group">
		  <div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse-'.$accordion_id.'">
			  '.$heading.'
			</a>
		  </div>
		  <div id="collapse-'.$accordion_id.'" class="accordion-body collapse">
			<div class="accordion-inner">
			  '. do_shortcode($content) .'
			</div>
		  </div>
		</div>';
}
add_shortcode('accordion_item', 'accordion_item');
?>