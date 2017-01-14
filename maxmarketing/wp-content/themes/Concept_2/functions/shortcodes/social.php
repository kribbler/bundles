<?php
function tweets($atts, $content = null) {
	extract(shortcode_atts(array('username' => '', 'quantity' => '3'), $atts));
   $output = "";
   $output .= '<div id="jqt_object" class="flexslider"><ul id="twitter_update_list" class="slides"><li></li></ul><div class="tweets-button"><a href="https://twitter.com/'.$username.'" class="twitter-follow-button" data-show-count="true">Follow @'.$username.'</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
                    <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
                    <script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?callback=twitterCallback2&screen_name='.$username.'&count='.$quantity.'"></script>
                </div>';
   return $output;
}
add_shortcode('tweets', 'tweets');


function tweets_big($atts, $content = null) {
	extract(shortcode_atts(array('username' => '', 'quantity' => '3'), $atts));
   $output = "";
   $output .= '<img src="'. get_template_directory_uri() .'/images/tweets-big.png" style="display: block; margin:0px auto 10px;" /><div id="jqt_object" class="flexslider flexslider_m jqt_big"><ul id="twitter_update_list" class="slides"><li></li></ul><div class="tweets-button"><a href="https://twitter.com/'.$username.'" class="twitter-follow-button" data-show-count="true">Follow @'.$username.'</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
                    <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
                    <script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?callback=twitterCallback2&screen_name='.$username.'&count='.$quantity.'"></script>
                </div>';
   return $output;
}
add_shortcode('tweets_big', 'tweets_big');


function facebook($atts, $content = null) {
	extract(shortcode_atts(array('page_id' => '', 'connections' => '4', 'height' => '150'), $atts));
	$url = get_template_directory_uri();
   $output = "";
   $output .= '<fb:fan profileid="' .$page_id. '" stream="0" connections="' .$connections. '" logobar="0" height="' .$height. '" css="http://phowebstudio.com/fanpage/like6.css?2.0&amp;language=ltr"></fb:fan>';
   return $output;
}
add_shortcode('facebook', 'facebook');

function flickr($atts, $content = null) {
	extract(shortcode_atts(array('id' => '', 'quantity' => '6'), $atts));
   $output = "";
   $output .= '<ul class="flickr no-bullets">
					<li class="clearfix"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$quantity.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$id.'"></script></li>
				</ul>';
   return $output;
}
add_shortcode('flickr', 'flickr');

?>