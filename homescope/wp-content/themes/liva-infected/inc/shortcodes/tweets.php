<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [tweets animation="bounceInUp" limit="10"]
 */
add_shortcode('tweets', 'ts_tweets_func');

function ts_tweets_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
	    'limit' => '3'
    ), $atts));


	$tweets = ts_get_recent_tweet();

	if ($tweets['is_error'] == 'true' || empty($tweets['tweets'])) {
		return '';
	}
	$tweets['tweets'] = json_decode($tweets['tweets']);

	if (!is_array($tweets['tweets']) || count($tweets['tweets']) == 0) {
		return '';
	}

	$i = 0;
	$items = '';
	$controls = '';
	$rand = rand(10000,30000);
	foreach ($tweets['tweets'] as $tweet) {

		if (($i + 1) > intval($limit)) {
			break;
		}

		$datetime = $tweet->created_at;
		$date = date('M d, Y', strtotime($datetime));
		$time = date('g:ia', strtotime($datetime));
		$tweet_text = $tweet->text;

		// check if any entites exist and if so, replace then with hyperlinked versions
		if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
			foreach ($tweet->entities->urls as $url) {
				$find = $url->url;
				$replace = '<a href="'.$find.'" target="_blank">'.$find.'</a>';
				$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet->entities->hashtags as $hashtag) {
				$find = '#'.$hashtag->text;
				$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
				$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet->entities->user_mentions as $user_mention) {
				$find = "@".$user_mention->screen_name;
				$replace = '<a href="http://twitter.com/'.$user_mention->screen_name.'" target="_blank">'.$find.'</a>';
				$tweet_text = str_ireplace($find,$replace,$tweet_text);
			}
		}

		$username = ts_get_twitter_username();

		$items .= '
			<div id="slide'.$rand.'-'.$i.'" class="faide_slide '.($i == 1 ? 'faide_slide_first' : '').'">
				<i class="icon-twitter icon-4x"></i>
				<br /><br />
				<strong>'.__('Tweet from', 'liva').' <a href="http://twitter.com/'.$username.'" target="_blank">@'.$username.'</a></strong>
				<br /><br />
				'.$tweet_text.'
				<br /><br />
				<b>//'.__('Posted about','liva').' <span class="tweet_time">'.$tweet -> created_at.'</span></b>
			</div>';

		$controls .= '<li><a href="#slide'.$rand.'-'.$i.'"></a></li>';
		$i ++;
	}

	return '
		<div class="twitter_feeds '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
			<div class="faide_slider twitter_slider">
			  <div id="slider'.$rand.'" class="slider">
				  '.$items.'
			  </div>
			  <div class="clearfix mar_top3"></div>
			  <ul class="controlls">
				  '.$controls.'
			  </ul>
			</div>
		</div>';
}