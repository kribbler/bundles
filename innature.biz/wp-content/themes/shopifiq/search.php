<?php get_header(); ?>

    <div class="clearfix">

        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="blog-main clearfix">
                    
                    <header>
                        <h2 class="article-text-only"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-date-comments2">
                            <?php echo get_the_date('M d Y'); ?>,
                            <a href="<?php echo the_permalink(); ?>#comments">
                                <?php echo $post->comment_count; ?> <?php echo __('comments', 'shopifiq'); ?>
                            </a>
                            
                        </div>
                    </header>
                    
                    <div class="blog-more-content">
                        <?php the_excerpt(); ?>
                    </div>
                        
                    <div class="clearfix"><?php tagsAndAuthor(); ?></div>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <div id="post-0" class="post no-results not-found">
                <h2 class="post-title"><?php _e( 'Nothing Found', 'shopifiq' ); ?></h2>
                <div class="post-text">
                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'shopifiq' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </div>

        <?php endif; ?>

        </div>
        
<?php get_footer(); ?>
