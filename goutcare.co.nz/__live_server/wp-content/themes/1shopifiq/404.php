<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div style="position: relative;">
    
    <?php
		global $wpdb;
        $data = $wpdb->get_results("SELECT details FROM " . $wpdb->prefix . "envoo_pages WHERE type='error'");
		
		if ( isset($data[0]->details) ) {
    		$page = get_page( $data[0]->details );
		 		
			echo do_shortcode(str_replace("&nbsp;", "<p><br /></p>", $page->post_content));
		}
    ?>
    
</div>
<?php get_footer(); ?>