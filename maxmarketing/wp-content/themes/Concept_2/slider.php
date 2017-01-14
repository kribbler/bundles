<?php 
global $concept7_data; 
global $post;
?>
<?php if(!is_page_template('template-blank.php')){?>
<div id="page-info-section" class="wrapper boxed-wrapper">
	<div class="container">
        <div class="row">
            <div class="span12" style="position:relative;">
            	<?php if(is_tax('portfolio_cats')){?>
                    <h2 class="page-title page-title-archive"><i class="icon-th"></i><?php _e('Portfolio category: ','concept7')?>"<?php single_cat_title(); ?>"</h2>
                <?php }elseif(is_search()){ ?>
                    <h2 class="page-title page-title-archive"><i class="icon-search"></i><?php _e('Search Results For: ','concept7')?>"<?php the_search_query(); ?>"</h2>
                <?php }elseif(is_archive()){ ?>
                    <?php if (have_posts()) : ?>
                    <?php $post = $posts[0]; ?>
                    <?php if (is_category()) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-th"></i><?php _e('Category: ','concept7') ?>"<?php single_cat_title(); ?>"</h2>
                    <?php } elseif( is_tag() ) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-tags"></i><?php _e('Posts Tagged: ','concept7') ?>&quot;<?php single_tag_title(); ?>&quot;</h2>
                    <?php  } elseif (is_day()) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-calendar"></i><?php _e('Archive For: ','concept7') ?><?php the_time('F jS, Y'); ?></h2>
                    <?php  } elseif (is_month()) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-calendar"></i><?php _e('Archive For: ','concept7') ?><?php the_time('F, Y'); ?></h2>
                    <?php  } elseif (is_year()) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-calendar"></i><?php _e('Archive For: ','concept7') ?><?php the_time('Y'); ?></h2>
                    <?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                    <h2 class="page-title page-title-archive"><i class="icon-list"></i><?php _e('Blog Archives','concept7') ?></h2>
                    <?php }endif; ?>  
                <?php }elseif(is_404()){?>
                    <h2 class="page-title page-title-archive"><i class="icon-ban-circle"></i><?php _e('"404 ! Page not found !"','concept7')?></h2>
                <?php }else{?>
					  <?php if(!is_singular('post') && !is_singular('portfolio')){ 
                        if(empty( $post->post_parent )) $icon = get_post_meta( $post->ID, 'icon', true );	
                        else $icon = get_post_meta( $post->post_parent, 'icon', true );	
						if(is_home()) echo '<h2 class="page-title"><i class="icon-list"></i>Blog</h2>'; else{
                    ?>
                			<h2 class="page-title"><i class="<?php echo $icon; ?>"></i><a href="<?php echo empty( $post->post_parent ) ? get_permalink( $post->ID ) : get_permalink( $post->post_parent ); ?>"><?php echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent ); ?></a></h2>
                	  <?php }}else{?>
                <h2 class="page-title">
					<?php if(is_singular('post')) echo __('<i class="icon-list"></i>Blog', 'concept7'); elseif(is_singular('portfolio')) echo '<i class="icon-shopping-cart"></i>' .get_the_title(); ?>
                </h2>
                <?php }}?>
                <?php the_breadcrumb(); ?>
                <div class="sharing">
                    <div class="sharing-icons">
                        <i class="icon-remove-sign"></i>
                        <a class="facebook-sharing" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=660');return false;" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/fb@2x.png" /></a>
                        <a class="twitter-sharing" href="http://twitter.com/share?url=<?php the_permalink() ?>&amp;lang=en&amp;text=Check out this awesome project:&amp;" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=620');return false;" data-count="none" data-via=" "><img src="<?php echo get_template_directory_uri();?>/images/tw@2x.png" /></a>
                      <a class="google-sharing" href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php wp_title('') ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=500');return false;"><img src="<?php echo get_template_directory_uri();?>/images/gg@2x.png" /></a>
                    </div>
                    <div class="post-sharing">
                        <p class="post-sharing-text"><?php _e('Share this', 'concept7') ?><i class="icon-share"></i></p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
  	</div>
</div>
<div class="clear"></div>
<?php }?>
