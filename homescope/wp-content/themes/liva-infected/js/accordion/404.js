<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package liva
 * @since liva 1.0
 */

get_header(); ?>
<div class="container">

	<div class="content_fullwidth">

	<div class="error_pagenotfound">
    	
        <strong><?php _e('404','liva');?></strong>
        <br />
    	<b><?php _e('Oops... Page Not Found!','liva');?></b>
        
        <em><?php _e('Sorry the Page Could not be Found here.','liva');?></em>

        <p><?php _e('Try using the button below to go to main page of the site','liva');?></p>
        
        <div class="clearfix mar_top3"></div>
    	
        <a href="javascript:window.history.back()" class="but_goback"><i class="icon-circle-arrow-left icon-large"></i>&nbsp; <?php _e('Go Back','liva');?></a>
        
    </div><!-- end error page notfound -->
        
</div>

</div><!-- end content area -->


<div class="clearfix mar_top5"></div>

<?php get_footer(); ?>