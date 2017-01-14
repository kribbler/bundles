<?php require 'index-posts.php'; ?>  

<?php
global $sidebar_featured_posts;
global $footer_like_posts;
global $menu_links;

set_popular_index();
set_sidebar_featured_posts();
set_footer_like_posts();
set_menu_links();

function set_menu_links(){
	global $menu_links, $posts;

	$menu_links[] = array(
		'title' => 'SEO Consultant',
		'posts' => array(1, 2, 3)
	);

	$menu_links[] = array(
		'title' => 'Internet Success',
		'posts' => array(4, 5, 6)
	);

	$menu_links[] = array(
		'title' => 'Search Engine',
		'posts' => array(2, 0, 5)
	);
}

function set_footer_like_posts() {
	global $footer_like_posts;
	$footer_like_posts = UniqueRandomNumbersWithinRange(0,6,3);
}

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function set_banners() {
	global $posts;
	$banners = array(
		array(
			'image' => 'images/banner/banner-img-1.jpg',
			'url' => $posts[0]['url'],
			'title' => $posts[0]['title']
		),
		array(
			'image' => 'images/banner/banner-img-2.jpg',
			'url' => $posts[1]['url'],
			'title' => $posts[1]['title']
		),
		array(
			'image' => 'images/banner/banner-img-3.jpg',
			'url' => $posts[3]['url'],
			'title' => $posts[3]['title']
		)
	);

	return $banners;
}

function set_sidebar_featured_posts() {
	global $sidebar_featured_posts;
	global $posts;

	$sidebar_featured_posts = array();
	foreach ($posts as $post) {
		$featured_post = array();
		$featured_post['image'] = $post['sidebar_image'];
		$featured_post['title'] = $post['title'];
		$featured_post['url'] = $post['url'];

		$sidebar_featured_posts[] = $featured_post;
	}
	return $sidebar_featured_posts;
}

function set_popular_index() {
	global $popular_index;
	$popular_index = rand(1,6);
}
function get_product($str) {
	$product = null;
	global $posts;

	foreach ($posts as $post) {
		//if ($post['url'] == substr($str, 0, -4)) {
		if ($post['url'] == $str) {
			$product = $post;
			break;
		}
	}

	return $product;
}

function get_page($str) {
	$page_ = null;
	global $pages;

	foreach ($pages as $page) {
		if ($page['url'] == $str) {
			$page_ = $page;
			break;
		}
	}

	return $page_;
}

function show_products_by_tag($tag) {
	global $posts;
	foreach ($posts as $post) {
		foreach ($post['tags'] as $post_tag) {
			if ($post_tag[1] == $tag) {
				echo '<li>';
				echo '<a href="'.$post['url'].'">'.$post['title'].'</a>';
				echo '</li>';
			}
		}
	}

}

function show_all_tags() {
	global $posts;
	$tags = array();

	if (isset($_GET['product']) && $_GET['product'] != '.html' ) {
		foreach ($posts as $post) {
			if ($post['url'] == $_GET['product']) {
				$tags = $post['tags'];
				break;
			}
		}
	} else {
		foreach ($posts as $post) {
			foreach ($post['tags'] as $t) {
				$tags[$t[1]] = $t;
			}
		}
	}


	foreach ($tags as $tag) {
		echo '<a href="'.$tag[1].'.html">'.$tag[0].'</a>';
	}
}

function pr($str) {
	echo '<pre>';
	var_dump($str);
	echo '</pre>';
}