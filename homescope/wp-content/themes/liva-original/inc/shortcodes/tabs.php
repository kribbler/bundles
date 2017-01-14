<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [tabs animation="bounceInUp" orientation="horizontal"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]
 */
add_shortcode('tabs', 'ts_tabs_func');

function ts_tabs_func( $atts, $content = null ) {

	//[tabs ]
	extract(shortcode_atts(array(
		'animation' => '',
	    'orientation' => 'horizontal'
    ), $atts));

	if (!in_array($orientation,array('horizontal','vertical')))
	{
		$orientation = 'horizontal';
	}

	global $shortcode_tabs;
    $shortcode_tabs = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
	$rand = rand(15000,50000);
	$tabs_nav = '';
	$tabs_content = '';
	$i = 1;
	foreach ($shortcode_tabs as $tab) {

		$active_class = '';
		if ($i == 1) {
			$active_class = 'active-'.$rand;
		}
		$tabs_nav .= '<li class="'.$active_class.'"><a href="#tab-'.$i.'-'.$rand.'">';
		if ($tab['icon'] != 'no')
		{
			$tabs_nav.= '<i class="'.$tab['icon'].' '.$tab['iconsize'].'"></i>';
		} else if (!empty($tab['iconupload'])) {
			$tabs_nav.= '<img src="'.$tab['iconupload'].'" />';
		}
		$tabs_nav .= ''.$tab['title'].'</a></li>';

		$tabs_content .= ' <div id="tab-'.$i.'-'.$rand.'" class="tab-'.$orientation.'-content fullpage">'.$tab['content'].'</div>';
		$i++;
	}
    $shortcode_tabs = array();

	$content = '
		<div id="tabs-container-'.$rand.'" class="tabs-'.$orientation.'-wrapper '.ts_get_animation_class($animation).'">
			<ul id="tabs-'.$orientation.'" class="tabs-'.$orientation.' fullpage">
				'.$tabs_nav.'
			</ul>
			<div class="tab-'.$orientation.'-container fullpage">'.$tabs_content.'</div>
		</div>
		<div class="clear"></div>
		<script>
			jQuery(document).ready(function() {

				//When page loads...
				$(".tab-'.$orientation.'-content").hide(); //Hide all content
				$("#tabs-'.$orientation.' li:first").addClass("active").show(); //Activate first tab
				$(".tab-'.$orientation.'-content:first").show(); //Show first tab content

				//On Click Event
				$("#tabs-'.$orientation.' li").click(function() {

					$("#tabs-'.$orientation.' li").removeClass("active"); //Remove any "active" class
					$(this).addClass("active"); //Add "active" class to selected tab
					$(".tab-'.$orientation.'-content").hide(); //Hide all tab content

					var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
					$(activeTab).fadeIn(); //Fade in the active ID content
					return false;
				});

			});
		</script>

';
	return $content;
}

/**
 * Shortcode Title: Tab - can be used only with tabs shortcode
 * Shortcode: tab
 * Usage: [tabs][tab label="New 1"]Your text here...[/tab][/tabs]
 * Options: action="url/open"
 */
add_shortcode('tab', 'ts_tab_func');
function ts_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'icon' => 'no',
	    'iconsize' => '',
	    'iconupload' => ''
    ), $atts));
    global $shortcode_tabs;
    $shortcode_tabs[] = array(
		'title' => $title,
		'icon' => $icon,
		'iconsize' => $iconsize,
		'iconupload' => $iconupload,
		'content' => trim(do_shortcode($content)));
}