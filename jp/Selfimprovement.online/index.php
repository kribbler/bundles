<?php include 'header.php'; ?>
<?php require 'index-posts.php'; ?>  

  <!--CONTENT START-->
  <div id="cp-content-wrap" class="cp-content-wrap">
    <div class="container">
      <div class="row"> 
        <!--LEFT CONTENT START-->
        <div class="col-md-9">
          <div class="cp-posts-style-1">
            <ul class="cp-posts-list">
              
              <?php $k = 0; foreach ($posts as $post) { $k++; ?>
			  <!--Post Start-->
              <li class="cp-post cp-text-post">
              	<?php if ($post['thumb']) { ?>
                  <?php if ($k == 4) { ?>
                  <div class="cp-photoset-thumbs">
                    <ul>
                      <li><img src="<?php echo $post['thumb'][0][0]['src'];?>" title="<?php echo $post['thumb'][0][0]['title'];?>" alt="<?php echo $post['thumb'][0][0]['title'];?>"></li>
                      <li><img src="<?php echo $post['thumb'][0][1]['src'];?>" title="<?php echo $post['thumb'][0][1]['title'];?>" alt="<?php echo $post['thumb'][0][1]['title'];?>"></li>
                      <li><img src="<?php echo $post['thumb'][0][2]['src'];?>" title="<?php echo $post['thumb'][0][2]['title'];?>" alt="<?php echo $post['thumb'][0][2]['title'];?>"></li>
                      <li><img style="max-width:850px" src="<?php echo $post['thumb']['src'];?>" title="<?php echo $post['thumb']['title'];?>" alt="<?php echo $post['thumb']['title'];?>"></li>
                    </ul>
                  </div>
                <?php } else { ?>
                  <div class="cp-thumb"> <img src="<?php echo $post['thumb']['src'];?>" title="<?php echo $post['thumb']['title'];?>" alt="neo">
                    <div class="cp-post-hover"> <a href="<?php echo $post['thumb_link'];?>"><i class="fa fa-link"></i></a> <a href="<?php echo $post['url'];?>"><i class="fa fa-search"></i></a> </div>
                  </div>
                <?php } ?>
               	<?php } ?>
                <div class="cp-post-base">
                  <div class="cp-post-content">
                    <h2><a href="<?php echo $post['url'];?>"><?php echo $post['title'];?></a></h2>
                    <ul class="cp-post-meta">
                      <li><a href="#">Last week</a></li>
                      <li><a href="#">Weight Loss & Healthy Diets</a></li>
                    </ul>

                    <?php if ($post['inner_image']) {?>
                    	<a href="<?php echo $post['url'];?>">
                          <img src="<?php echo $post['inner_image']['src'];?>" 
                      		title="<?php echo $post['inner_image']['title'];?>" 
                      		align="left" class="product_image"
                      	/>
                      </a>
                    <?php } ?>
                    <p><?php echo $post['short_description'];?></p>

                    <div class="container-fluid">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<a href="<?php echo $post['url'];?>" class="read-more">Read More</a> <!--<a href="#" class="leave-comment"><i class="fa fa-comment-o"></i> Leave a Comment</a> -->
                    		</div>
                    	</div>
                    </div>


                   </div>
                </div>
              </li>
              <!--Post End--> 
              <?php }?>
              
              

              
            </ul>
          </div>
        </div>
        <!--LEFT CONTENT END--> 
        
 		<?php include 'sidebar.php'; ?>
        
      </div>
    </div>
  </div>
  <!--CONTENT END--> 
  
  <?php include 'footer.php'; ?>
  
</div>

<?php include 'footer-js.php'; ?>