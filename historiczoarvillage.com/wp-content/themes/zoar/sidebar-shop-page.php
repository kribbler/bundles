<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>



   <div id="sidebar">
     <a href="http://historiczoarvillage.com/joindonate/donate/" title="DONATE">
       <img src="<?php bloginfo('template_url') ?>/images/donate_btn.jpg" alt="DONATE" style="margin-bottom:20px;" />
     </a>   
    
     <ul>
       <?php
	     if ( ! dynamic_sidebar( 'sidebar-shop-pages' ) ) : ?>
       <?php endif; // end sidebar shop pages ?>
     </ul>  
   </div><!-- #sidebar .widget-area -->