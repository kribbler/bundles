<?php 
    if ( is_plugin_active('woocommerce/woocommerce.php') && is_shop() ): ?>
        </section>
    <?php endif; ?>

    </div>
    	<div class="prefooter main-wrapper clearfix">
    	</div>
        <footer id="site-footer">
            
            <div class="footer main-wrapper clearfix">
                <?php get_sidebar( 'footer' ); ?>
            </div>
            
            <!-- START Copyright footer -->
            <?php
                global $wpdb;
                $data = $wpdb->get_results("SELECT copyright_on FROM " . $wpdb->prefix . "envoo_account");
    			
    			$copyright_on = "";
    			
    			if ( isset($data[0]) ) {
    				$copyright_on = $data[0]->copyright_on; 			  
    			}
    			
            ?>
            
            <?php if ( $copyright_on != "off" ): ?>
                <?php get_template_part("includes/copyright_footer"); ?>
            <?php endif; ?>
            <!-- END Copyright footer -->
            
        </footer>

    </div>   


    <?php wp_enqueue_script( "google_maps_api", "http://maps.google.com/maps/api/js?sensor=false"); ?>
    <?php wp_enqueue_script( "lightbox", get_template_directory_uri() . "/js/lightbox.js" ); ?>
    <?php wp_enqueue_script( "gmap3", get_template_directory_uri() . "/js/gmap3.min.js" ); ?>
    <?php wp_enqueue_script( "easing", get_template_directory_uri()  . "/js/jquery.easing.1.3.js" ); ?>
    <?php global $is_portfolio_page; if ( $is_portfolio_page || get_option("faq_page") ): ?>
        <?php wp_enqueue_script( "isotope_theme_files", get_template_directory_uri()  . "/js/isotope_theme_files.js" ); ?>
        <?php wp_enqueue_script( "isotope", get_template_directory_uri()  . "/js/jquery.isotope.js" ); ?>
    <?php endif; ?>
    <?php wp_enqueue_script( "functions", get_template_directory_uri()  . "/js/functions.js", '', '', true ); ?>
    <?php wp_enqueue_script( "tweet", get_template_directory_uri()  . "/js/jquery.tweet.js" ); ?>
    <?php wp_enqueue_script( "easing2", get_template_directory_uri()  . "/js/easing.js" ); ?>
    <?php wp_enqueue_script( "totop", get_template_directory_uri()  . "/js/jquery.ui.totop.js" ); ?>
    <?php wp_enqueue_script( "cookie", get_template_directory_uri()  . "/js/jquery.cookie.js", '', '', true ); ?>

    <?php echo '<input id="twitter_site_url" type="text" class="none" value="' . get_template_directory_uri() . '">'; ?>
    
    <?php if(!$_COOKIE["shopifiq-notification-closed"] || get_option("notification_changes") != $_COOKIE["shopifiq-notification-closed"]): ?>

        <?php if( get_option("notice-active", "") == "on" ): ?>

            <?php if( get_option("notice-type", "") == "on" ): ?>

                <div id="notice-lightbox" class="site-notice">

                    <?php echo do_shortcode(get_option("notice", "")); ?>

                </div>

            <?php endif; ?>

        <?php endif; ?>
    
    <?php endif; ?>

    <input id="notification_changes" type="hidden" value="<?php echo get_option("notification_changes", ""); ?>" />

<?php wp_footer(); ?>
</body>

</html>
