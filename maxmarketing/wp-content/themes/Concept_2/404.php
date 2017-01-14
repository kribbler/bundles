<?php get_header(); ?>
    <div id="page-content" class="wrapper boxed-wrapper">
    <div class="clear" style="height:35px;"></div>
    	<div class="container">
        	<div class="row">
                <h4 style="text-align:center;"><?php _e('The page you try to looking for couldn\'t be retrieved. Try another search, please:', 'concept7')?></h4>
                <form style="overflow:hidden;text-align:center;" method="get" class="row-fluid" id="searchbar" action="<?php echo home_url(); ?>/" >
                <input type="text" style="margin:10px auto; padding:10px; width:300px; float:none;" name="s" id="search" value="Search ..."/>
                </form>
                <div class="clear" style="height:20px;"></div>
                <h3 style="text-align:center;"><?php _e('Site map', 'concept7')?></h3>
            </div>
            <div class="row">
                <div class="span4">
                    <h3 id="authors"><i class="icon-group"></i>Authors<hr style="margin:5px auto 1px 0; width:80%;" /><hr style="width:75%; margin:1px 0;" /><hr style="width:70%; margin:1px 0;" /></h3>
                        <ul style="margin-top:20px;">
                        <?php
                        wp_list_authors(
                          array(
                            'exclude_admin' => false,
                          )
                        );
                        ?>
                        </ul>
                </div>
                <div class="span4">      
                    <h3 id="pages"><i class="icon-file-alt"></i>Pages<hr style="margin:5px auto 1px 0; width:80%;" /><hr style="width:75%; margin:1px 0;" /><hr style="width:70%; margin:1px 0;" /></h3>
                    <ul style="margin-top:20px;">
                    <?php
                    // Add pages you'd like to exclude in the exclude here
                    wp_list_pages(
                      array(
                        'exclude' => '',
                        'title_li' => '',
                        'link_before' => '<i class="icon-caret-right"></i>',
                      )
                    );
                    ?>
                    </ul>
                </div>
                <div class="span4">
                    <h3 id="posts"><i class="icon-list-alt"></i>Posts<hr style="margin:5px auto 1px 0; width:80%;" /><hr style="width:75%; margin:1px 0;" /><hr style="width:70%; margin:1px 0;" /></h3>
                    <ul style="margin-top:20px;">
                    <?php
                    // Add categories you'd like to exclude in the exclude here
                    $cats = get_categories('exclude=');
                    foreach ($cats as $cat) {
                      echo "<li><h4>".$cat->cat_name."</h4>";
                      echo '<ul class="list_wrap" style="margin-top:10px;">';
                      query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
                      while(have_posts()) {
                        the_post();
                        $category = get_the_category();
                        // Only display a post link once, even if it's in multiple categories
                        if ($category[0]->cat_ID == $cat->cat_ID) {
                          echo '<li><i class="icon-caret-right"></i><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                        }
                      }
                      echo "</ul>";
                      echo "</li>";
                    }
                    ?>
                    </ul>
                </div>
            </div> 
        </div> 
        <?php echo do_shortcode('[clear size="60"]'); ?>
    </div>

<?php get_footer(); ?>