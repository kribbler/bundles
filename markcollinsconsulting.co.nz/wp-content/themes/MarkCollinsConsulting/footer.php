	 
</div> <!-- end #page-wrap -->
</div> <!-- end .wrapper -->
<div class="lowerbarb"></div>

<div id="footer" >
	<div id="footer-content">

			<?php if ( dynamic_sidebar('Footer Icons') ) ?>
		
			<?php global $is_footer;
			$is_footer = true; ?>
			
			<?php $menuClass = 'bottom-menu';
			$footerNav = '';
			
			if (function_exists('wp_nav_menu')) $footerNav = wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false, 'depth' => '1', 'after' => '<span>|</span>' ) );
			if ($footerNav == '') show_page_menu($menuClass);
			else echo($footerNav); ?>
		

		<p id="copyright">
			Website by  <a href="http://www.studioeleven.co.nz/"><img src="<?php echo get_bloginfo('template_directory')?>/images/studioeleven.png" alt="Studio Eleven" style="margin-left: 5px;"></a>
		</p>

	</div> <!-- end #footer-content -->
</div> <!-- end #footer -->

	 
				
	<?php include(TEMPLATEPATH . '/includes/scripts.php'); ?>

	<?php wp_footer(); ?>	
</body>
</html>