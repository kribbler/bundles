<?php 
    if ( is_plugin_active('woocommerce/woocommerce.php') && is_shop() ): ?>
        </section>
    <?php endif; ?>
</div>
    </div>
    <?php
    if ( is_front_page() ) {
        // This is a homepage
        echo "<div class=\"bluethreecolumns\"> <div class=\"main-wrapper\"> "; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Three Home Icons') ) : ?>  
            <?php endif; ?> 
        <? echo "</div></div>";
        echo "<div class=\"treatment\"> <div class=\"main-wrapper\"> "; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Treatment Texts') ) : ?>  
            <?php endif; ?> 
        <? echo "</div></div>";
        echo "<div class=\"causesofgout\"> <div class=\"main-wrapper\"> "; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Causes of Gout Texts') ) : ?>  
            <?php endif; ?> 
        <? echo "</div></div>";
        echo "<div class=\"goutdiet\"> <div class=\"main-wrapper\"> "; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('The Gout Diet') ) : ?>  
            <?php endif; ?> 
        <? echo "</div></div>";
        echo "<div class=\"otherbenefits\"> <div class=\"main-wrapper\"> "; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Other Benefits') ) : ?>  
            <?php endif; ?> 
        <? echo "</div></div>";
    } else { 
    	
        echo "<div class=\"grasswrapper\"></div>";
    }?>
        <footer id="site-footer">
            
            <div class="footer main-wrapper clearfix">
                <?php get_sidebar( 'footer' ); ?>
            </div>
            
            <!-- START Copyright footer -->
           <div class="social">
                <div class="main-wrapper">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
                    <div class="studioeleven"> Website by <a href="www.studioeleven.co.nz">StudioEleven.</a> </div>
                </div>
            </div>
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

<?php wp_footer(); ?>
</body>

</html>
