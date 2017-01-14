<?php
/**
 * Header image/slider
 *
 * @package liva
 * @since liva 1.0
 */

$slider = null;
if (is_home() || is_page() || is_single())
{
	$slider = get_post_meta(get_the_ID(), 'post_slider',true);
	if ($slider)
	{
		$slider = ts_get_post_slider(get_the_ID());
	}
	else
	{
		$slider = null;
	}
}
if (!empty($slider)): ?>
	<div class="container_full">
		<div class="fullwidthbanner-container">
			<div class="fullwidthbanner">
				<?php echo $slider; ?>
			</div>
		</div>
	</div>
<?php endif;?>