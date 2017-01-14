<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->
</div><!-- #wrapper -->
<style>
#footwidth {
	position:relative;	
}
#facebook {
	position:absolute;
	right:15px;
	top:70px;	
}
</style>
	<div id="footer" role="contentinfo">
		<div id="colophon"><div id="footwidth">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
	<a href="https://www.facebook.com/pages/Daves-Homemade-Beef-Jerky/426705417417912" target="_blank"><img id="facebook" src="/images/facebook.png" alt="Beef Jerky on Facebook"/></a>
</div>

<!-- #site-generator -->

		</div><!-- #colophon -->
			<div id="site-info">
				<span>Copyright Hewitt Country Meats and Snowblowing <?php echo date('Y'); ?>. All Rights Reserved</span>
				<span class="right"><a href="http://divinedesigns.ca" target="_blank">Website Design: <span>divinedesigns.ca</span> - Divinely Inspired Web Design</a></span>
			</div>
	</div><!-- #footer -->



<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>