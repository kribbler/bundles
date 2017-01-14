<?php get_header(); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail( $post->ID )) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php 
			$h1_title = get_post_meta( $post->ID, 'page_title', true );
			$extra_padding = '300px';
			$header_height = '600px';
			if ($h1_title == 'Meals on Wheels') {
				$extra_padding = '350px';
				$header_height = '600px';
				$div_icon = 'icon_meals_on_wheels';
			}
			if ($h1_title == 'Transportation') {
				$header_height = '490px';
				$div_icon = 'icon_transportation';
			}
			if ($h1_title == 'Social Programs') {
				$header_height = '535px';
				$div_icon = 'icon_social_programs';
			} 
			if ($h1_title == 'Personal Care, Caregiver Relief<br />& Homemaking') {
				$header_height = '580px';	
				$div_icon = 'icon_personal_care';
			}

			if ($h1_title == 'Friendly Visiting & Telephone Reassurance') {
				$header_height = '580px';	
				$div_icon = 'icon_friendly_visiting';
			}
		?>
  		<div id="header_image" style="background-image: url('<?php echo $image[0]; ?>'); height: <?php echo $header_height;?>">
			<div id="<?php echo $div_icon;?>" class="header_icon"></div>
			<h1 style="padding-top: <?php echo $extra_padding;?>"><?php echo $h1_title;?></h1>
			<h2><?php echo get_post_meta( $post->ID, 'page_subtitle', true );?></h2>
		</div>
		<?php endif;?>
		
<div id="post">
<?php the_content(); ?>
</div> <!-- .post -->
<?php endwhile; endif;?>

<?php get_footer();?>