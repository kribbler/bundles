  <!--FOOTER START-->
  
  <footer class="cp-footer">
    <div class="footer-top">
      <div class="container">
        <div class="row"> 
          
          <!--Text Widget Start-->
          <div class="col-md-3">
            <div class="widget textwidget">
              <h3>About Stress Management Strategy</h3>
              <p>We provide reviews and information so that you can make informed decisions. </p>
              <ul class="footer-social">
                <li><a href="#"><i class="fa fa-facebook-square"></i> </a></li>
                <!--<li><a href="#"><i class="fa fa-envelope"></i> </a></li>
                <li><a href="#"><i class="fa fa-rss"></i> </a></li>
                <li><a href="#"><i class="fa fa-twitter"></i> </a></li>-->
              </ul>
            </div>
          </div>
          
          <!--Text Widget End--> 
          
          <!--Photo Stream Start-->
          <div class="col-md-3">
            <div class="widget photostram">
              <h3>Photostream</h3>
              <ul class="cp-photo-grid">
                <li><img src="images/footer/photostream/photo1.jpg" alt=""></li>
                <li><img src="images/footer/photostream/photo2.jpg" alt=""></li>
                <li><img src="images/footer/photostream/photo3.jpg" alt=""></li>
                <li><img src="images/footer/photostream/photo4.jpg" alt=""></li>
                <li><img src="images/footer/photostream/photo5.jpg" alt=""></li>
                <li><img src="images/footer/photostream/photo6.jpg" alt=""></li>
              </ul>
            </div>
          </div>
          
          <!--Photo Stream End--> 
          
          <!--Tags Start-->
          <div class="col-md-3">
            <div class="widget cp-tags">
              <h3>Tags</h3>
              <ul class="tags">
                <li>
<?php
foreach ($posts as $post) {
  foreach ($post['tags'] as $t) {
    $tags[$t[1]] = $t;
  }
}

$k = 0;
foreach ($tags as $tag) {
  if ($k++ > 7)
      break;
  echo '<a href="tag/'.$tag[1].'.html">'.$tag[0].'</a>';
}
?>
          </li>
              </ul>
            </div>
          </div>
          
          <!--Tags Start--> 
          
          <!--Newsletter Start-->
          <div class="col-md-3">
            <div class="widget cp-newsltter">
              <h3>Newsletter</h3>
              <form method="post" class="newsletter" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl">
<div style="display: none;">
<input type="hidden" name="meta_web_form_id" value="1447775217" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="awlist3734806" />
<input type="hidden" name="redirect" value="" id="redirect_9630425615a24b0ca69e9b279a477378" />

<input type="hidden" name="meta_adtracking" value="IAM_Weight_Loss_Diet" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="email" />
</div>
              
                  <input type="email" required placeholder="Enter email for subscription..." name="email">
                  <button type="submit">Join The Club</button>
                  <div style="display: none;"><img src="https://forms.aweber.com/form/displays.htm?id=jCws7OzsrEyM7A==" alt="" /></div>

                </form>
              
              
            </div>
          </div>
          
          <!--Newsletter End--> 
          
        </div>
      </div>
    </div>
    
    
    <div class="footer-mid">
    <ul class="cp-insta-feed">
    <li><img src="images/footer/footer1.jpg" alt=""></li>
    <li><img src="images/footer/footer2.jpg" alt=""></li>
    <li><img src="images/footer/footer3.jpg" alt=""></li>
    <li><img src="images/footer/footer4.jpg" alt=""></li>
    <li><img src="images/footer/footer5.jpg" alt=""></li>
    <li><img src="images/footer/footer6.jpg" alt=""></li>
    <li><img src="images/footer/footer7.jpg" alt=""></li>
    <li><img src="images/footer/footer8.jpg" alt=""></li>
    
    </ul>
    
    
    </div>
    
    
    <div class="cp-footer-bottom">
    
    <p>&copy; 2015 StressManagementStrategy.com <a href="privacy.html">Privacy Policy</a> <a href="disclaimer.html">Disclaimer</a></p>
    
    </div>
    
  </footer>
  
  <!--FOOTER END--> 