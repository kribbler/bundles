<?php
/**
 * The default template for displaying post info
 *
 * @package liva
 * @since liva 1.0
 */
global $template_small;

$small_class = '';
if ( isset($template_small) && $template_small === true ) { 
	$small_class = '_small';
}
?>
<ul class="post_meta_links<?php echo $small_class; ?>">
	<li class="post_by"><?php the_author_posts_link();?></li>
	<li class="post_categoty">
		<?php
		$categories = get_the_category_list(' ');
		if (!empty($categories)): ?>
			<?php echo $categories; ?>
		<?php endif; ?>
	</li>
	<li class="post_comments"><a><?php comments_number(); ?></a></li>
</ul>