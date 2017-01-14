<?php $thumb = ''; 	  

	$width = get_option('minimal_thumbnail_width_usual');
	$height = get_option('minimal_thumbnail_height_usual');
	$classtext = 'thumbnail-post alignleft';
	$titletext = get_the_title();
	
	$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
	$thumb = $thumbnail["thumb"]; ?>
	
<?php global $post;
	  $page_result = is_search() && ($post->post_type == 'page') ? true : false; ?>	
	  
<h2 class="title<?php if ($page_result) echo(' page_result'); ?>"><a href="<?php the_permalink() ?>" title="<?php printf(__ ('Permanent Link to %s', 'Minimal'), $titletext) ?>"><?php the_title(); ?></a></h2>



<?php if($thumb <> '' && get_option('minimal_thumbnails_index') == 'on') { ?>
	<a href="<?php the_permalink() ?>" title="<?php printf(__ ('Permanent Link to %s', 'Minimal'), $titletext) ?>">
		<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
	</a>
<?php }; ?>

<?php if (get_option('minimal_blog_style') == 'on') the_content(""); else { ?>
	<p><?php truncate_post(400); ?></p>
<?php }; ?>
<div style="width: 100%; padding: 15px; color: #000; border-top: 2px solid #C42027;"><a href="http://www.ebooksnzonline.com/think/" target="_blank"><img src="http://markcollinsnzltd.co.nz/wp-content/uploads/Screen-Shot-2015-03-31-at-10.44.43-am.png" style="float: right; width: 30%; height: auto;"></a><div style="font-family: 'Covered By Your Grace'; font-size: 29px; text-align: center; color: rgb(0, 0, 0); margin-bottom: 25px; margin-top: 15px;">My Gift to you</div>
<strong>Thinking Differently- over 100 idea starters</strong><br/><br/>
I have just released my first E book and for your interest I have gifted you the link to access your very own copy - pass it on to your friends!!! <br />
Simply click on the image to access your copy now!</div>
<div style="clear: both;">&nbsp;</div>
<div style="padding: 15px; margin-left: auto; margin-right: auto; background-color: rgb(192, 192, 192); width: 550px; box-shadow: 0px 0px 5px rgb(153, 153, 153);">
<div style="font-family: 'Covered By Your Grace'; font-size: 29px; text-align: center; color: rgb(0, 0, 0); margin-bottom: 10px;">Never miss another update! </div>
<p style="width: 580px; text-align: center;">Enter your details below, and receive our regular Newsletter DIRECT to your inbox!!
<?php gravity_form($id_or_title=2, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=false, $tabindex); ?>
</div>
<div class="clear"></div>