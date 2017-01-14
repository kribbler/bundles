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

     <ul>
       <?php
	     if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
       <?php endif; // end primary widget area ?>
     </ul>
     <?php if(is_page(13) ) { ?>
      <?php dynamic_sidebar('event-calender-news-page'); ?> 
	<?php } ?>	
    
    <?php if(is_page(14) ) { ?>
      <?php include('newsletter-form.php'); ?> 
	<?php } ?>		

   </div><!-- #primary .widget-area -->



