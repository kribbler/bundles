<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package liva
 * @since liva 1.0
 */
?>

<div class="footer <?php echo ot_get_option('footer_background_pattern'); ?>">
	
	<?php if (ot_get_option('show_footer_arrow') != 'no'): ?>
		<div class="arrow_02"></div>
	<?php endif; ?>

	<div class="clearfix mar_top5"></div>

	<div class="container">

		<div class="one_third">			<?php dynamic_sidebar( 'footer-area-1' ); ?>		</div><!-- end address section -->
		<div class="one_third">			<?php dynamic_sidebar( 'footer-area-2' ); ?>		</div><!-- end useful links -->
		<div class="one_third last">			<?php dynamic_sidebar( 'footer-area-3' ); ?>		</div><!-- end tweets -->
	</div>

	<div class="clearfix mar_top6"></div>

</div>
