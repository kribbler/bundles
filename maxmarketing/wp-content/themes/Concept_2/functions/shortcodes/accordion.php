<?php
function accordion($atts, $content = null) {
   return '
   	<div class="accordion" id="accordion3">
		'. do_shortcode($content) .'
	</div>
   ';
}
add_shortcode('accordion', 'accordion');
?>