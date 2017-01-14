<!--Related Posts-->
<div class="cp-related-posts">
  <h4>You May Also Like</h4>
  <ul class="cp-posts">
    <?php foreach ($footer_like_posts as $key) { ?>
    <li class="cp-post">
      <div class="cp-thumb-r"><img src="<?php echo $posts[$key]['like_image']['src'];?>" alt=""></div>
      <div class="cp-post-text">
        <h4><a href="<?php echo $posts[$key]['url'];?>"><?php echo $posts[$key]['title'];?></a></h4>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<!--Related Posts End--> 