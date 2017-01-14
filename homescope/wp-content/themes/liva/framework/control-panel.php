<?php
/**
 * Control panel
 *
 * Shows the Control Panel on your homepage if enabled.
 *
 * @package framework
 * @since framework 1.0
 */

if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_body_class']))
{
	$body_class = $_COOKIE['theme_body_class'];
}
elseif (isset($_GET['switch_layout']) && !empty($_GET['switch_layout']))
{
	$body_class = $_GET['switch_layout'];
}
else
{
	$body_class = ot_get_option('body_class');
}
$main_menu_style = ts_get_main_menu_style();
$background_patterns = ts_get_background_patterns(true);

?>
<div id="style-selector">
    <div class="style-selector-wrapper">
	<span class="title"><?php _e('Choose Theme Options','framework');?></span>
	<div>        
<span class="title-sub"></span>

<span class="title-sub2"><?php _e('4 Different Layouts','framework '); ?></span>

<?php
if (function_exists('ts_get_control_panel_layouts')):
	$layouts = ts_get_control_panel_layouts();
	
	foreach ($layouts as $layout): ?>
		<ul class="styles-noborder">     
		<li class="left"><?php echo $layout['name']; ?></li>
		<li><a href="<?php echo $layout['url']; ?>"><img src="<?php echo $layout['thumb']; ?>" alt="" /></a></li>
	</ul>
	<?php endforeach;
endif;

?>

<span class="title-sub2"><?php _e('Predefined Color Skins', 'framework'); ?></span>

<ul class="styles" style="border-bottom: none;">     
    <li><a href="#"><span class="pre-color-skin1"></span></a></li>
    <li><a href="#"><span class="pre-color-skin2"></span></a></li>
    <li><a href="#"><span class="pre-color-skin3"></span></a></li>
    <li><a href="#"><span class="pre-color-skin4"></span></a></li>
    <li><a href="#"><span class="pre-color-skin5"></span></a></li>
    <li><a href="#"><span class="pre-color-skin6"></span></a></li>
    <li><a href="#"><span class="pre-color-skin7"></span></a></li>
    <li><a href="#"><span class="pre-color-skin8"></span></a></li>
    <li><a href="#"><span class="pre-color-skin9"></span></a></li>
    <li><a href="#"><span class="pre-color-skin10"></span></a></li>
</ul>

<a href="#" class="close icon-chevron-right"></a>  
    
</div>
</div>
</div><!-- end style switcher -->

<script>
	jQuery(document).ready(function($) {

		$('ul.styles li a span').click(function() {
			
			var current_color_container = this;
			$(current_color_container).html('<i class="icon-spinner icon-spin"></i>');

			jQuery.ajax({
				type: 'GET',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					action: 'the_theme_dynamic_styles',
					main_color: rgb2hex($(this).css('background-color'))
				},
				success: function(data, textStatus, XMLHttpRequest){
					$(current_color_container).html('');
					jQuery("#dynamic-styles").html('');
					jQuery("#dynamic-styles").html(data);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					//alert(errorThrown);
				}
			});
		});
	});

	var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

	//Function to convert hex format to a rgb color
	function rgb2hex(rgb) {
		rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}

	function hex(x) {
		return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
	}

 </script>