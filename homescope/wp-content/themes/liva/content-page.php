<?php
/**
 * The default template for displaying single page content
 *
 * @package liva
 * @since liva 1.0
 */

$classes = array(
	'post',
	(get_post_format() ? 'format-'.get_post_format() : '')
);

if (get_post_meta(get_the_ID(), 'show_page_content',true) != 'no'): ?>
	<div <?php post_class($classes); ?>>	
		<?php the_content( ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'liva' ), 'after' => '</div>' ) ); ?>
	</div>
<?php endif; ?>