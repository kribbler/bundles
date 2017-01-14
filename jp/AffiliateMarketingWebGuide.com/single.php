<?php 
include 'functions.php';
include 'index-posts.php';
include 'index-single-pages.php';

$page = get_page($_GET['page']);

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
                  <div class="cp-post-content_">
                    <br /><br />
                    <?php echo $page['content'];?>
                  </div>
                  <!--Post Content End--> 

                  <?php include 'you-may-also-like.php'; ?>
                </div>
              </li>
              <!--Post End-->
              
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