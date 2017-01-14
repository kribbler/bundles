<?php get_header(); ?>

<div class="white-wrap page-content">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php if (have_posts()): ?>
					<?php while(have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part('404'); ?>
				<?php endif; ?>
			</div>
			<?php /*
			<aside class="span4">
				<div class="aside-wrap">
					<?php get_sidebar(); ?>
				</div>
			</aside>
			*/?>
		</div>
	</div>
</div>

<?php get_footer(); ?>