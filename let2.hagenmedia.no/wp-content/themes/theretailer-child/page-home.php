<?php
/*
Template Name: HOME Page
*/
?>

<?php get_header(); ?>



<div class="container_12">
	
    <div class="grid_8">
		<div id="home_content">
			<?php while ( have_posts() ) : the_post(); ?>
	
	            <?php get_template_part( 'content', 'page' ); ?>
	
	        <?php endwhile; // end of the loop. ?>
		</div>
		        
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="entry-content">
                    <div class="content_wrapper">
                        <!--<h1><?php the_title(); ?></h1>-->
						
						<div class="home_search_box">
	                        <h2>Velg drivstoff</h2>
	                        <?php
	                        $terms = get_terms("pa_drivstoff", array('hide_empty' => false));
							
	                        foreach ($terms as $term){
	                        	if ($term->name != 'Gass+bensin' && $term->name != 'Gass'){?>
		                            <div class="content_grid_4">
		                                	<a href="<?php echo get_site_url() . '/produktkategori/bil/' . $term->slug;?>" title="<?php echo $term->name;?>"><?php echo $term->name;?></a>
		                            </div>    
		                        <?php } ?>
	                        <?php } ?>
	                        <div class="clear"></div>
                        </div>
                        
                        
                        <div class="home_search_box" id='kaross'>
	                        <h2>Velg karosseri</h2>
	                        <?php
	                        $bodies = get_terms("pa_karosseri", array('hide_empty' => false));
	                        foreach ($bodies as $body){?>
	                            <div class="content_grid_4">
	                                <a class="kaross_<?php echo $body->slug;?>" href="<?php echo get_site_url() . '/produktkategori/bil/' . $body->slug;?>" title="<?php echo $body->name;?>"><?php echo $body->name;?></a>
	                            </div>    
	                        <?php } ?>
	                        <div class="clear"></div>
                        </div>
                        
                        
                        <div class="home_search_box">
	                        <h2>Velg merke og modell</h2>
	                        <?php /*
	                        $catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'parent' => NULL));
	                        foreach ($catTerms as $category){?>
	                        	<div class="content_grid_4">
	                                <a href="<?php echo get_term_link( $category->slug, $category->taxonomy );?>" title="<?php echo $category->name;?>"><?php echo $category->name;?></a>
	                            </div>
	                        <?php } */
	                        
	                        $brands = get_terms("pa_merke", array('hide_empty' => false));
							//echo "<pre>"; var_dump($brands[0]);
							
							/*
	                        foreach ($brands as $brand){?>
	                            <div class="content_grid_4">
	                                <a href="<?php echo get_site_url() . '/produktkategori/bil/' . $brand->slug;?>" title="<?php echo $brand->name;?>"><?php echo $brand->name;?></a>
	                                <!--<a href="<?php echo get_site_url() . '/product-category/bil/?filter_merke=' . $brand->term_id;?>" title="<?php echo $brand->name;?>"><?php echo $brand->name;?></a>-->
	                            </div>    
	                            <?php //if ($model->slug=='c4' || $model->slug=='citroen'){echo "<pre>";var_dump($model);}?>
	                        <?php } */?>
	                        <div class="clear"></div>

	                        <?php
	                        $items = $brands; // Get the values into an array.
							$columnCount = 4;
							$itemCount = count($brands);

							$rowCount = ceil($itemCount / $columnCount);
							for ($i = 0; $i < $rowCount * $columnCount; $i++)
							{
							    $index = ($i % $columnCount) * $rowCount + floor($i / $columnCount);
							    if ($index < $itemCount)
							    { ?>
							<div class="content_grid_4">
							      <a href="<?php echo get_site_url() . '/produktkategori/bil/' . $brands[$index]->slug;?>" title="<?php echo $brands[$index]->name;?>"><?php echo $brands[$index]->name;?></a>  
							     </div>
							    <?php }
							    else
							    {
							        //DisplayBlank();
							    }
							}
	                        ?>
	                        <div class="clear"></div>
						</div>
                    </div>
                </div>
                
            </div><!-- #content .site-content -->
        </div><!-- #primary .content-area -->
        
    </div>

	<div id="right_sidebar">
		<?php
        if ( is_active_sidebar( 'right_banner' ) ){?>
            <div class="top_banner_wrapper">        
				<?php dynamic_sidebar('right_banner'); ?>
            </div>

        <?php } ?>
	</div>

</div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>