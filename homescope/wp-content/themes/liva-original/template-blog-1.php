<?php
/*
* Template Name: Blog Template 1
*/

get_header();
$have_posts = false; ?>

<?php
//adhere to paging rules
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
	$posts_per_page = get_option('posts_per_page');
}

global $query_string;
	$args = array(
		'numberposts'     => '',
		'posts_per_page' => $posts_per_page,
		'offset'          => 0,
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'post',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> $paged,
		'post_status'     => 'publish'
	);
query_posts( $args );
?>

<div class="container">
	<?php ts_get_single_post_sidebar('left'); ?>
	<div class="<?php echo ts_get_liva_content_class(); ?>">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			
			<?php ts_the_liva_navi(); ?>
		<?php else : //No posts were found ?>
			<?php get_template_part( 'no-results' ); ?>
		<?php endif; ?>
	</div>
	<?php ts_get_single_post_sidebar('right'); ?>
</div>
<div class="clearfix mar_top7"></div>
<?php get_footer(); ?>