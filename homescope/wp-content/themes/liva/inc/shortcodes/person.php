<?php
/**
 * Shortcode Title: Person
 * Shortcode: person
 * Usage: [persons animation="bounceInUp" id=1]
 */
add_shortcode('person', 'ts_person_func');

function ts_person_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		"id" => 0,
		"align" => "",
					), $atts));

	global $post;

	$new_post = null;
	if (!empty($id)) {
		$new_post = get_post($id);
	}
	if ($new_post) {
		$old_post = $post;
		$post = $new_post;

		$image = '';
		if (has_post_thumbnail($post->ID, 'post')) {
			$image = ts_get_resized_post_thumbnail($post->ID, 'person-mid');
		}

		$facebook = get_post_meta($post->ID, 'facebook_url', true);
		$twitter = get_post_meta($post->ID, 'twitter_url', true);
		$google_plus = get_post_meta($post->ID, 'google_plus_url', true);
		$youtube = get_post_meta($post->ID, 'youtube_url', true);
		$rss = get_post_meta($post->ID, 'rss_url', true);

		$content = stripslashes($post->post_content);

		$html = '
			<div class="our_team '.ts_get_animation_class($animation).' '.($align == 'center' ?  'centered' : '').'" data-animation="'.$animation.'">

				'.$image.'

				<h4>' . get_the_title() . '<em> - ' . get_post_meta($post->ID, 'team_position', true) . '</em></h4>

				<ul class="people_soci">
					' . (!empty($facebook) ? '<li><a href="'.$facebook.'"><i class="icon-facebook"></i></a></li>' : '') . '
					' . (!empty($twitter) ? '<li><a href="'.$twitter.'"><i class="icon-twitter"></i></a></li>' : '') . '
					' . (!empty($google_plus) ? '<li><a href="'.$google_plus.'"><i class="icon-google-plus"></i></a></li>' : '') . '
					' . (!empty($youtube) ? '<li><a href="'.$youtube.'"><i class="icon-youtube"></i></a></li>' : '') . '
					' . (!empty($rss) ? '<li><a href="'.$rss.'"><i class="icon-rss"></i></a></li>' : '') . '
				</ul>
				<div class="clearfix"></div>
				<p>'.ts_get_shortened_string(strip_tags($content),30).'</p>
			</div>';

		$post = $old_post;
	}
	return $html;
}