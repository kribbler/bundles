<?php 
include 'functions.php';
include 'index-posts.php';
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
                <div class="cp-post-base"> 
                  
                  <br />
                  <br />

                  <?php if (isset($_GET['tag'])) {
                  	$tag = substr($_GET['tag'], 0, -5);?>
                  	<h1>Products having <b><?php echo $tag; ?></b> as tag</h1>
                  	<ul><?php show_products_by_tag($tag); ?></ul>
                  <?php }?>

                  <br /><br />
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