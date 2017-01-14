<?php the_post(); ?>

<?php get_header(); ?></div>
<div class="innerwrappermain">
	<div class="innerwrapper">
	<?php if (get_option('minimal_integration_single_top') <> '' && get_option('minimal_integrate_singletop_enable') == 'on') echo(get_option('minimal_integration_single_top')); ?>	
	
	<div id="content" class="clearfix">
		<div id="content-area">			
			<div class="entry clearfix">
				<h1 class="title"><?php the_title(); ?></h1>
				
				
				<?php if (get_option('minimal_thumbnails') == 'on') { ?>
			
					<?php $width = get_option('minimal_thumbnail_width_posts');
						  $height = get_option('minimal_thumbnail_height_posts');
						  $classtext = 'thumbnail-post alignleft';
						  $titletext = get_the_title();
					
						  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						  $thumb = $thumbnail["thumb"]; ?>
					
					<?php if($thumb <> '') print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
						
				<?php }; ?>
				
				<?php the_content(); ?> 
<div style="width: 100%; padding: 15px; color: #000; border-top: 2px solid #C42027;"><a href="http://www.ebooksnzonline.com/think/" target="_blank"><img src="http://markcollinsnzltd.co.nz/wp-content/uploads/Screen-Shot-2015-03-31-at-10.44.43-am.png" style="float: right; width: 30%; height: auto;"></a><div style="font-family: 'Covered By Your Grace'; font-size: 29px; text-align: center; color: rgb(0, 0, 0); margin-bottom: 25px; margin-top: 15px;">My Gift to you</div>
<strong>Thinking Differently- over 100 idea starters</strong><br/><br/>
I have just released my first E book and for your interest I have gifted you the link to access your very own copy - pass it on to your friends!!! <br />
Simply click on the image to access your copy now!</div>
<div style="clear: both;">&nbsp;</div>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','Minimal').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php edit_post_link(__('Edit this page','Minimal')); ?>
				
			</div> <!-- end .entry -->
			
			<?php if (get_option('minimal_integration_single_bottom') <> '' && get_option('minimal_integrate_singlebottom_enable') == 'on') echo(get_option('minimal_integration_single_bottom')); ?>		
			<?php if (get_option('minimal_468_enable') == 'on') { ?>
                      <?php if(get_option('minimal_468_adsense') <> '') echo(get_option('minimal_468_adsense'));
                    else { ?>
                       <a href="<?php echo(get_option('minimal_468_url')); ?>"><img src="<?php echo(get_option('minimal_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
               <?php } ?>  
            <?php } ?>
			
			<?php if (get_option('minimal_show_postcomments') == 'on') comments_template('', true); ?>
				
		</div> <!-- end #content-area -->	
	
<?php get_sidebar(); ?>
	</div> <!-- end #content --> 
	</div>
<?php get_footer(); ?>