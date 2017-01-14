<?php
global $theretailer_theme_options;
?>

	<div class="gbtr_footer_wrapper">
        
        <div class="container_12">
            <div class="grid_12 bottom_wrapper">
            		<ul>
                        <?php if ( has_nav_menu( 'secondary' ) ) : ?>
						<?php  
                        wp_nav_menu(array(
                            'theme_location' => 'secondary',
                            'container' =>false,
                            'menu_class' => '',
                            'echo' => true,
                            'items_wrap'      => '%3$s',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'depth' => 0,
                            'fallback_cb' => false,
                        ));
                        ?>
                        <?php else: ?>
                        	Define your secondary navigation.
                        <?php endif; ?>
                    </ul>
                <div class="gbtr_footer_widget_credit_cards">
                <?php dynamic_sidebar('footer_copyright'); ?>
                </div>
                <div class="gbtr_footer_widget_copyrights"><?php echo $theretailer_theme_options['copyright_text']; ?></div>
                <div class="clr"></div>
            </div>
        </div>
        
    </div>
    
    </div><!-- /global_wrapper -->

    <!-- ******************************************************************** -->
    <!-- *********************** Custom Javascript ************************** -->
    <!-- ******************************************************************** -->
    
    <?php echo $theretailer_theme_options['custom_js_footer']; ?>
    
    <!-- ******************************************************************** -->
    <!-- ************************ WP Footer() ******************************* -->
    <!-- ******************************************************************** -->
	
<?php wp_footer(); ?>
</body>
</html>