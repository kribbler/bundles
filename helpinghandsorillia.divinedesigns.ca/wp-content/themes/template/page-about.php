<?php
/** Template Name: AboutPage */
?>


<?php get_header('about'); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail( $post->ID )) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php 
			$h1_title = get_post_meta( $post->ID, 'page_title', true );
			$extra_padding = '260px';
			$header_height = '600px';
			
		?>
  		<div id="header_image" style="margin-top: 14px; height: 532px;background-image: url('<?php echo $image[0]; ?>');">
			<h1 style="padding-top: <?php echo $extra_padding;?>"><?php echo $h1_title;?></h1>
			<h2><?php echo get_post_meta( $post->ID, 'page_subtitle', true );?></h2>
		</div>
		<?php endif;?>
	
<div id="post">
<?php the_content(); ?>
</div> <!-- .post -->
<?php endwhile; endif;?>

<?php get_footer();?>