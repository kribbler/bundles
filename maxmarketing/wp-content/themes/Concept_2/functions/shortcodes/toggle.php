<?php
function toggle($atts, $content = null) {
   return '
   	<div class="accordion" id="accordion2">
		'. do_shortcode($content) .'
	</div>
   ';
}
add_shortcode('toggle', 'toggle');
?>