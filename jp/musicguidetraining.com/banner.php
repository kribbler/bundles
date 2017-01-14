  <!--BANNER START-->
  <div id="cp-banner-style-1">
    <ul id="cp-banner-1">
    <?php $banners = set_banners(); foreach ($banners as $banner){?>
      <li> <img src="<?php echo $banner['image'];?>" alt="img">
        <div class="caption">
          <div class="container">
            <div class="holder">
              <ul style="display: none">
                <li>2 months ago</li>
                <li>Travel</li>
              </ul>
              <h1><a href="<?php echo $banner['url'];?>"><?php echo $banner['title'];?></a></h1>
            </div>
          </div>
        </div>
      </li>
    <?php } ?>
    </ul>
  </div>
  <!--BANNER END--> 