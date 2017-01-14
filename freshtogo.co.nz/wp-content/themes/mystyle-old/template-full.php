<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Template Name: Full (Home)
 *
 * This template is a full-width version of the page.php template file. It removes the sidebar area.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
?> 
    <div id="content" class="page">
    
    	<?php woo_main_before(); ?>
    	
		
           
        <?php
        	if ( have_posts() ) { $count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                             
                <article>
					
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
                    
                    <section class="entry">
	                	<?php the_content(); ?>
	               	</section><!-- /.entry -->

					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                </article><!-- /.post -->
                                                    
			<?php
					} // End WHILE Loop
				} else {
			?>
				<article <?php post_class(); ?>>
                	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
                </article><!-- /.post -->
            <?php } ?>  
        
		<!-- /#main -->
		
		<?php //woo_main_after(); ?>
		

		
		
		
    </div><!-- /#content -->

    <div class="homedetails">
	    <div class="homebody hometexts">

			<div class="lowerbanner">
		    	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Lower Banner')) :endif; ?>
		    </div>

		</div>
		<div class="homeproductslide homebody">
			<?php 

				preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);

				if (count($matches)>1){
					//Then we're using IE
					$version = $matches[1];

					if ($version<=10) {

					} else {
						echo do_shortcode(""); 
					}
					
				} else {
					echo do_shortcode(""); 
				}
			?>
		</div>
		<div class="homebody threecolumns">
		    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Below Product Carousel')) :endif; ?>
		</div>
		<div class="homebody saladplates">
		    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Salad and Video')) :endif; ?>
		</div>
	</div>
	
		
<?php get_footer(); ?>