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

			<div class="container">				<div class="one_half">					<?php dynamic_sidebar( 'coyright-area-1' ); ?>				</div>									<div class="one_half last">					<?php dynamic_sidebar( 'coyright-area-2' ); ?>				</div>								</div>

		</div><!-- end copyright info -->

		<a href="#" class="scrollup"><?php _e('Scroll', 'liva'); ?></a>
		<?php echo ot_get_option('scripts_footer'); ?>
	</div>
	<div class="media_for_js"></div>
	<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68697516-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>