<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package liva
 * @since liva 1.0
 */
?>

<div class="footer <?php echo ot_get_option('footer_background_pattern'); ?>">
	
	<?php if (ot_get_option('show_footer_arrow') != 'no'): ?>
		<div class="arrow_02"></div>
	<?php endif; ?>

	<div class="clearfix mar_top5"></div>

	<div class="container">

		<div class="one_fourth">
			
			<?php dynamic_sidebar( 'footer-area-1' ); ?>
			
<!--			<div class="footer_logo"><img src="images/footer-logo.png" alt="" /></div>

			<ul class="contact_address">
				<li><i class="icon-map-marker icon-large"></i>&nbsp; 2901 Marmora Road, Glassgow,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seattle, WA 98122-1090</li>
				<li><i class="icon-phone"></i>&nbsp; 1 -234 -456 -7890</li>
				<li><i class="icon-print"></i>&nbsp; 1 -234 -456 -7890</li>
				<li><img src="images/footer-wmap.png" alt="" /></li>
			</ul>-->

		</div><!-- end address section -->


		<div class="one_fourth">
			
			<?php dynamic_sidebar( 'footer-area-2' ); ?>
			
<!--			<h2>Useful <i>Links</i></h2>

			<ul class="list">
				<li><a href="#"><i class="icon-angle-right"></i> Home Page Variations</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Awsome Slidershows</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Features and Typography</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Different &amp; Unique Pages</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Single and Portfolios</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Recent Blogs or News</a></li>
				<li><a href="#"><i class="icon-angle-right"></i> Layered PSD Files</a></li>
			</ul>-->

		</div><!-- end useful links -->


		<div class="one_fourth">
			
			<?php dynamic_sidebar( 'footer-area-3' ); ?>
			
<!--			<div class="twitter_feed">

				<h2>Latest <i>Tweets</i></h2>

				<div class="left"><i class="icon-twitter icon-large"></i></div>
				<div class="right"><a href="https://twitter.com/google" target="_blank">google</a>: Lorem ipsum dolor sit amet, suspendisse welcome to our paradise.<br />
				<a href="#" class="small">.9 days ago</a> .<a href="#" class="small">reply</a> .<a href="#" class="small">retweet</a> .<a href="#" class="small">favorite</a></div>

				<div class="clearfix divider_line4"></div>

				<div class="left"><i class="icon-twitter icon-large"></i></div>
				<div class="right"><a href="https://twitter.com/google" target="_blank">google</a>: Lorem ipsum dolor sit amet, suspendisse welcome to our paradise.<br />
				<a href="#" class="small">.10 days ago</a> .<a href="#" class="small">reply</a> .<a href="#" class="small">retweet</a> .<a href="#" class="small">favorite</a></div>

			</div>-->

		</div><!-- end tweets -->


		<div class="one_fourth last">
			
			<?php dynamic_sidebar( 'footer-area-4' ); ?>
			
<!--			<h2>Flickr <i>Photos</i></h2>

			<div id="flickr_badge_wrapper">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=h&amp;source=user&amp;user=93382411%40N07"></script>     
			</div>-->

		</div><!-- end flickr -->


	</div>

	<div class="clearfix mar_top6"></div>

</div>
