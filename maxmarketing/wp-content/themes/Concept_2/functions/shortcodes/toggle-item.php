<?php
function toggle_item($atts, $content = null) {
   extract(shortcode_atts(array('toggle_id' => '','heading' => ''), $atts));
   return
		'<div class="accordion-group">
		  <div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$toggle_id.'">
			  '.$heading.'
			</a>
		  </div>
		  <div id="collapse'.$toggle_id.'" class="accordion-body collapse2 collapse">
			<div class="accordion-inner">
			  '. do_shortcode($content) .'
			</div>
		  </div>
		</div>';
}
add_shortcode('toggle_item', 'toggle_item');
?>