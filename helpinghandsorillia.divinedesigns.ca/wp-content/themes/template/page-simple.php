<?php
/** Template Name: SimplePage */
?>

<?php get_header(); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
<div id="post">
	<div class="container">
		<div class="row-fluid">
			<div class="span12 large_margin" style="margin-top:40px">
				<h1><?php echo get_the_title();?></h1>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div> <!-- .post -->
<?php endwhile; endif;?>

<?php get_footer();?>