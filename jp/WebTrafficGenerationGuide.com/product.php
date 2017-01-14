<?php 
include 'functions.php';
include 'index-posts.php';

$product = get_product($_GET['product']);

//pr($product);
?>
<?php include 'header-post.php'; ?>

<?php include 'navigation-post.php'; ?>

<?php include 'page-title.php'; ?>

  </header>
  <!--HEADER END--> 

  <!--CONTENT START-->
  <div id="cp-content-wrap" class="cp-content-wrap">
    <div class="container">
      <div class="row"> 
        <!--LEFT CONTENT START-->
        <div class="col-md-9">
          <div class="cp-posts-style-1">
            <ul class="cp-posts-list cp-post-details">
              
              <!--Post Start-->
              <li class="cp-post cp-text-post">
              	<?php if ($product['thumb']) { ?>
                <div class="cp-thumb"> <img src="<?php echo $product['thumb']['src'];?>" alt=""> </div>
                <?php } ?>
                <div class="cp-post-base"> 
                  
                  <!--Post Content Start-->
                  <div class="cp-post-content">
                    <h2><a href="<?php echo $product['thumb_link'];?>" target="_blank"><?php echo $product['title'];?></a></h2>
                    <ul class="cp-post-meta" style="display: none">
                      <li><a href="#">1 months ago</a></li>
                      <li><a href="#">Travel</a></li>
                      <li><a href="#"><i class="fa fa-comment-o"></i> 2 Comments</a></li>
                    </ul>
                    <p><?php echo $product['short_description']; ?></p>
                    <br />
                    <?php if ($product['inner_image']) {?>
                    	<center>
                    		<a href="<?php echo $product['thumb_link'];?>" target="_blank">
		                    	<img class="full_width" src="<?php echo $product['inner_image']['src'];?>" 
		                    		title="<?php echo $product['inner_image']['title'];?>" 
		                    		align="middle"
		                    	/>
		                    </a>
	                    </center>
                    <?php } ?>
                    <br /><br />
                    <?php echo $product['content']; ?>
                    <br />
                    <center>
                      <a href="<?php echo $product['thumb_link'];?>" class="btn btn-primary btn-lg">Click HERE To Learn More</a>
                    </center>
                    <br /><br />
                    <?php if ($product['bottom_image']){?>
                    <center>
                    	<a href="<?php echo $product['thumb_link'];?>" target="_blank">
                    		<img src="<?php echo $product['bottom_image']['src'];?>" 
                    			title="<?php echo $product['bottom_image']['title'];?>" />
                    	</a>
                    </center>
                    <br />
                    <?php } ?>
					       <br />

                 <h3>Tags</h3>
                <?php if(isset($product['tags'])) foreach ($product['tags'] as $tag) { ?>
                  <a class="btn btn-info" href="<?php echo $tag[1];?>.html"><?php echo $tag[0]; ?></a>
                <?php } ?>
                  </div>
                  <!--Post Content End--> 
                  

                  <!--Share Start-->
                  
                  <div class="cp-post-share">
                    <ul>
                      <li> <a href="#"><i class="fa fa-facebook"></i> Share Facebook</a> </li>
                      <li> <a href="#"><i class="fa fa-twitter"></i> Share Twitter</a> </li>
                      <li> <a href="#"><i class="fa fa-google-plus"></i> Share Google</a> </li>
                    </ul>
                  </div>
                  
                  <!--Share End--> 

                  <div class="clear"></div>
                  <br /><br />
                  <?php include 'you-may-also-like.php'; ?>
                  <br />                  
                  <?php include 'comments.php'; ?>                  
                  <br />
                  <br />
                </div>
                <br /><br />
              </li>
              <!--Post End-->
              <br /><br />
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