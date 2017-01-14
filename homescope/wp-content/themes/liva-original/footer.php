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

					<b><?php echo ot_get_option('footer_text'); ?></b>
					<?php
					$defaults = array(
						'container'			=> 'nav',
						'theme_location'	=> 'copyright-bar',
						'depth' 			=> 1
					);
					wp_nav_menu( $defaults ); ?>
					
					
				</div>

				<div class="one_half last">
					
					<?php
					$active_social_items = ot_get_option('active_social_items');
					if (!is_array($active_social_items)):
						$active_social_items = array();
					endif; ?>
					
					<ul class='footer_social_links'>
						<?php if (in_array('facebook',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('facebook_url'); ?>' title="Facebook" target="_blank"><i class="icon-facebook"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('twitter',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('twitter_url'); ?>' title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('google_plus',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('google_plus_url'); ?>' title="Google+" target="_blank"><i class="icon-google-plus"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('linkedin',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('linkedin_url'); ?>' title="LinkedIn" target="_blank"><i class="icon-linkedin"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('flickr',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('flickr_url'); ?>' title="Flickr" target="_blank"><i class="icon-flickr"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('youtube',$active_social_items)): ?>
							<li>
								<a href='<?php echo ot_get_option('youtube_url'); ?>' title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
							</li>
						<?php endif;?>
						<?php if (in_array('rss',$active_social_items)): ?>
							<li>
								<a href='<?php bloginfo('rss_url'); ?>' title="RSS" target="_blank"><i class="icon-rss"></i></a>
							</li>
						<?php endif;?>
					</ul>

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