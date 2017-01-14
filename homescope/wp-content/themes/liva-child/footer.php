<?php
/**
 * The template for displaying the footer.
 *
 * @package liva
 * @since liva 1.0
 */
?>

		<!-- Footer
		======================================= -->
		
		<?php 
		if (ot_get_option('show_footer') != 'no'):
			get_sidebar('footer'); 
		endif; ?>
		<div class="copyright_info <?php echo ot_get_option('footer_text_centered') == 'yes' ? 'centered' : '' ?>">

			<div class="container">				
				<div class="one_half">					
					<?php dynamic_sidebar( 'coyright-area-1' ); ?>				
				</div>									
				<div class="one_half last">					
					<?php dynamic_sidebar( 'coyright-area-2' ); ?>				
				</div>								
			</div>

		</div><!-- end copyright info -->

		<a href="#" class="scrollup"><?php _e('Scroll', 'liva'); ?></a>
		<?php echo ot_get_option('scripts_footer'); ?>
	</div>
	<div class="media_for_js"></div>
	<?php wp_footer(); ?>
</body>
</html>