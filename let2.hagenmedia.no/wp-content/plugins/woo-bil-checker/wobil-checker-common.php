<?php
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "cake_jewelry-scrap";
} else {
	$host = "localhost";
	$user = "impoku";
	$pass = "Import12oku!";
	$db = "impoku";
}

$cake_db = new wpdb( $user, $pass, $db, $host );
$sellers = get_sellers($cake_db);
$categories = get_master_categories();

function get_sellers($cake_db, $no_all = NULL){
	$query = "SELECT * FROM jewelry_websites";
	$results = $cake_db->get_results($query);

	if (!isset($no_all)){
		$all = new stdClass();
		$all->id = 99;
		$all->pretty_name = 'All';
		$results[] = $all;
	}
	
	return $results;
}

function get_seller_id($cake_db, $seller){
	$query = "SELECT id FROM jewelry_websites WHERE pretty_name='{$seller}' LIMIT 1";
	$results = $cake_db->get_results($query);
	return $results[0]->id;
}

function get_category_id($cake_db, $category){
	$query = "SELECT id FROM jewelry_master_categories WHERE name='{$category}' LIMIT 1";
	$results = $cake_db->get_results($query);
	return $results[0]->id;
}

function get_master_categories(){
	$categories = get_terms("pa_merke", array('hide_empty' => false));	
	return $categories;
}

function get_items($cake_db, $seller, $category){
	if ($seller != 'All' && $category != 'All'){
		$seller_id = get_seller_id($cake_db, $seller);
		$category_id = get_category_id($cake_db, $category);
		
		$query = "SELECT id FROM jewelry_actions WHERE website_id={$seller_id} AND master_category_id={$category_id} ORDER BY id DESC LIMIT 1 ";
		$results = $cake_db->get_results($query);
		$action_id = $results[0]->id;
		
		$query = "SELECT items.*, materials.name AS material_name, 
			categories.name AS category_name,
			sellers.pretty_name AS seller_name FROM jewelry_items AS items 
		LEFT JOIN jewelry_materials AS materials
		ON (materials.id = items.material_id)
		LEFT JOIN jewelry_master_categories AS categories
		ON (categories.id = items.master_category_id)
		LEFT JOIN jewelry_websites AS sellers
		ON (sellers.id = items.website_id)
		WHERE website_id={$seller_id} AND master_category_id={$category_id} AND action_id={$action_id}";
		$results = $cake_db->get_results($query);
	} else if ($seller == 'All' && $category == 'All'){
		$results_array = array();
		$sellers = get_sellers($cake_db, TRUE);
		$categories = get_master_categories($cake_db, TRUE);
		foreach ($sellers as $seller){
			$seller_id = get_seller_id($cake_db, $seller->pretty_name);
			foreach ($categories as $category){
				$category_id = get_category_id($cake_db, $category->name);
				$query = "SELECT id FROM jewelry_actions WHERE website_id={$seller_id} AND master_category_id={$category_id} ORDER BY id DESC LIMIT 1 ";
				$results = $cake_db->get_results($query);
				
				if ($results){
					$action_id = $results[0]->id;
					$query = "SELECT items.*, materials.name AS material_name, 
						categories.name AS category_name,
						sellers.pretty_name AS seller_name FROM jewelry_items AS items 
					LEFT JOIN jewelry_materials AS materials
					ON (materials.id = items.material_id)
					LEFT JOIN jewelry_master_categories AS categories
					ON (categories.id = items.master_category_id)
					LEFT JOIN jewelry_websites AS sellers
					ON (sellers.id = items.website_id)
					WHERE website_id={$seller_id} AND master_category_id={$category_id} AND action_id={$action_id}";
					$r = $cake_db->get_results($query);
					//pr($r);
					$results_array = array_merge($results_array, $r);
				}
			}
		}
		$results = $results_array;
	} else if ($seller == 'All' && $category != 'All'){
		$results_array = array();
		$sellers = get_sellers($cake_db, TRUE);
		$category_id = get_category_id($cake_db, $category);
		foreach ($sellers as $seller){
			$seller_id = get_seller_id($cake_db, $seller->pretty_name);
				$query = "SELECT id FROM jewelry_actions WHERE website_id={$seller_id} AND master_category_id={$category_id} ORDER BY id DESC LIMIT 1 ";
				$results = $cake_db->get_results($query);
				
				if ($results){
					$action_id = $results[0]->id;
					$query = "SELECT items.*, materials.name AS material_name, 
						categories.name AS category_name,
						sellers.pretty_name AS seller_name FROM jewelry_items AS items 
					LEFT JOIN jewelry_materials AS materials
					ON (materials.id = items.material_id)
					LEFT JOIN jewelry_master_categories AS categories
					ON (categories.id = items.master_category_id)
					LEFT JOIN jewelry_websites AS sellers
					ON (sellers.id = items.website_id)
					WHERE website_id={$seller_id} AND master_category_id={$category_id} AND action_id={$action_id}";
					$r = $cake_db->get_results($query);
					//pr($r);
					$results_array = array_merge($results_array, $r);
				}
		}
		$results = $results_array;
	} else if ($seller != 'All' && $category == 'All'){
		$results_array = array();
		$seller_id = get_seller_id($cake_db, $seller);
		$categories = get_master_categories($cake_db, TRUE);
		foreach ($categories as $category){
			$category_id = get_category_id($cake_db, $category->name);
			$query = "SELECT id FROM jewelry_actions WHERE website_id={$seller_id} AND master_category_id={$category_id} ORDER BY id DESC LIMIT 1 ";
			$results = $cake_db->get_results($query);
				
			if ($results){
				$action_id = $results[0]->id;
				$query = "SELECT items.*, materials.name AS material_name, 
					categories.name AS category_name,
					sellers.pretty_name AS seller_name FROM jewelry_items AS items 
				LEFT JOIN jewelry_materials AS materials
				ON (materials.id = items.material_id)
				LEFT JOIN jewelry_master_categories AS categories
				ON (categories.id = items.master_category_id)
				LEFT JOIN jewelry_websites AS sellers
				ON (sellers.id = items.website_id)
				WHERE website_id={$seller_id} AND master_category_id={$category_id} AND action_id={$action_id}";
				$r = $cake_db->get_results($query);
				//pr($r);
				$results_array = array_merge($results_array, $r);
			}
		}
		$results = $results_array;
	}
	//pr($results[0]);die();
	return $results;
}

function check_existence($product){
	$product_link = get_post_meta($product['ID'], "finn-url", true);
	if ($product_link){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $product_link);	
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$head_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($head_code > 400){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function wp_get_product_by_seller_sku($code){
	global $wpdb;
	$query = "SELECT * FROM `wp_postmeta` WHERE meta_value like '%{$code}%'";
	$results = $wpdb->get_results($query);
	if ($results){
		$product = get_product( $results[0]->post_id );
		return $product;
	} else {
		return NULL;
	}
}

function wp_get_products($category){
	global $wpdb;
	
	$query = "SELECT * FROM `wp_posts` WHERE post_status = 'publish' AND post_type='product'"; 
	//echo $query;die();
	$results = $wpdb->get_results($query);
	$products = array();
	foreach ($results as $result){
		$terms = wp_get_post_terms( $result->ID, "product_cat" );
		if (html_entity_decode($terms[0]->name) == $category){
			$products[] = get_product( $result->ID );
		}
	}
	return $products;
}

function c_pr($arr){
	echo "<pre>"; var_dump($arr); echo "</pre>";
}