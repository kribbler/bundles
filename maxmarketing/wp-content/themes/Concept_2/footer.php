<?php global $concept7_data; global $post; ?>

<div id="footer-wrapper" class="wrapper" style="background-color: #00274C;">
	<div class="footer-bg" style="background-color: #00274C;"></div>
	<div class="container">
    	<div class="row">
        	<div class="span3">
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
            </div>
            <div class="span3">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
            </div>
            <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third Footer Area') ) : ?><?php endif; ?>
            </div>
            <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Fourth Footer Area') ) : ?><?php endif; ?>
            </div>
            <div class="clear" style="height:30px;"></div>
        </div>
    </div>
</div>
<div class="footer-bottom wrapper">

	<div class="container">
       
    </div>
</div>
<div class="scrollup"><i class="icon-double-angle-up"></i></div>
<?php wp_footer(); ?>
<div style="background-color: #00274C; width: 100%; min-height: 200px;"><div style="width: 95%; max-width: 940px; color: #fff; margin-left: auto; margin-right: auto;padding: 25px 0;">content will be going here - there can be 3 or 4 columns
 <div class="row">
            <div class="expand-footer"><i class="icon-double-angle-up"></i></div>  
            <div class="span7">
        		<?php
					wp_nav_menu(array( 
						'container' => false,
						'container_class' => 'footer-menu',
						'menu_class' => 'footer-nav',
						'theme_location' => 'footer nav',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'fallback_cb' => false
					));
					
				?>
            </div>
            <div class="span5">
                <p class="copyright-text"><?php echo $concept7_data['copyright_text']; ?></p>
            </div>
        </div>
</div></div>
</body>
</html>