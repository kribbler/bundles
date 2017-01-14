
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

wp_check_tables();
$attributes = wp_get_attributes();

function wp_check_tables(){
	global $wpdb;
	$query = "SHOW tables LIKE 'wp_metasets'";
	$results = $wpdb->get_results($query);
	if (!$results){
		$query = "CREATE TABLE IF NOT EXISTS `wp_metasets` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(255) NOT NULL,
			  `title` varchar(255) NOT NULL,
			  `keyword` varchar(255) NOT NULL,
			  `description` text NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
		$results = $wpdb->get_results($query);
		
		$query = "CREATE TABLE IF NOT EXISTS `wp_metaset_links` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `metaset_id` int(11) NOT NULL,
			  `link_id` int(11) NOT NULL,
			  `type` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
		$results = $wpdb->get_results($query);
	}
	
	$query = "SELECT attribute_searchable FROM `wp_woocommerce_attribute_taxonomies` WHERE 1=1 LIMIT 1"; 
	$results = $wpdb->get_results($query);
	
	if (!$results || count($results) != 1){
		//I need to initialize the column first!
		$query = "ALTER TABLE `wp_woocommerce_attribute_taxonomies` ADD `attribute_searchable` TINYINT NOT NULL DEFAULT '0';";
		$results = $wpdb->get_results($query);
	}
}

function set_attributes_searchable(){
	global $wpdb;
	$query = "
		UPDATE `wp_woocommerce_attribute_taxonomies` SET `attribute_searchable` = '0' WHERE 1=1;
	";
	
	$results = $wpdb->get_results($query);
	foreach ($_POST as $key=>$value):
		$split = explode("_", $key);
		$query = "UPDATE `wp_woocommerce_attribute_taxonomies` SET `attribute_searchable` = '1' WHERE `wp_woocommerce_attribute_taxonomies`.`attribute_id` =" . $split[1];
		$results = $wpdb->get_results($query);		
	endforeach;
}

function wp_save_metaset($post){
	global $wpdb;
	$id = NULL;
	if ($_POST['metaset_id']) $id = $_POST['metaset_id'];
	//pr($_POST);die();
	if (!$id){
		$query = "INSERT INTO `wp_metasets` (
			`id` ,
			`name` ,
			`title` ,
			`keyword` ,
			`description`
			)
			VALUES (
			NULL , 
			'".$post['metaset_name']."', 
			'".$post['metaset_metatitle']."', 
			'".$post['metaset_metakeywords']."', 
			'".$post['metaset_metadescription']."'
			);
		";
	} else {
		$query = "UPDATE `wp_metasets` SET (
				`name` = '".$post['metaset_name']."',
				`title` = '".$post['metaset_metatitle']."',  
				`keyword` = '".$post['metaset_metakeywords']."',
				`description` = '".$post['metaset_metadescription']."'  
			) WHERE 1=1;";
	}
	
	$results = $wpdb->get_results($query);
	
	$metaset_id = ($id) ? $id : mysql_insert_id();
	
	if ($id){
		$query = "DELETE FROM `wp_metaset_links` WHERE `wp_metaset_links`.`metaset_id` = $id";
		$results = $wpdb->get_results($query);
	}
	
	foreach ($post as $key=>$value):
		$split = explode("_", $key);
		if ($split[0] == 'attributes'){
			wp_set_link($split, $value, $metaset_id, "A");
		}
		if ($split[0] == 'attribute-values'){
			wp_set_link($split, $value, $metaset_id, "AV");
		}
		if ($split[0] == 'categories'){
			wp_set_link($split, $value, $metaset_id, "C");
		}
	endforeach;
	
}

function wp_get_metaset($id){
	global $wpdb;
	$query = "SELECT * FROM wp_metasets as metasets WHERE id=$id";
	$results = $wpdb->get_results($query, ARRAY_A);
	foreach ($results as $key=>$value){
		$query = "SELECT * FROM wp_metaset_links WHERE wp_metaset_links.metaset_id = " . $results[$key]['id'];
		$r_l = $wpdb->get_results($query, ARRAY_A);
		$results[$key]['links'] = $r_l;
	}
	
	foreach ($results as $key=>$value){
		foreach ($results[$key]['links'] as $k=>$v){
			if ($results[$key]['links'][$k]['type'] == "C"){
				$query = "SELECT wp_terms.name FROM wp_terms WHERE wp_terms.term_id = " . $results[$key]['links'][$k]['link_id'];
				$r_c = $wpdb->get_results($query);
				$results[$key]['links'][$k]['link_name'] = $r_c[0]->name;
			}
			
			if ($results[$key]['links'][$k]['type'] == "A"){
				$query = "SELECT attribute_name FROM `wp_woocommerce_attribute_taxonomies` WHERE attribute_id = " . $results[$key]['links'][$k]['link_id'];
				
				$r_a = $wpdb->get_results($query);
				$results[$key]['links'][$k]['link_name'] = $r_a[0]->attribute_name;
			}
			
			if ($results[$key]['links'][$k]['type'] == "AV"){
				$query = "SELECT termmeta.*, terms.* FROM wp_woocommerce_termmeta AS termmeta 
					LEFT JOIN wp_terms AS terms ON
					(terms.term_id = termmeta.woocommerce_term_id)
					WHERE meta_key = " . $results[$key]['links'][$k]['link_id'];
				//$query = "SELECT attribute_name FROM `wp_woocommerce_attribute_taxonomies` WHERE attribute_id = " . $results[$key]['links'][$k]['link_id'];
				
				$r_a = $wpdb->get_results($query);
				$results[$key]['links'][$k]['link_name'] = $r_a[0]->attribute_name;
			}
		}
	}
	return $results[0];
}

function wp_get_categories(){
	global $wpdb;
	$query = "SELECT term_taxonomy.term_id, terms.name FROM `wp_term_taxonomy` AS term_taxonomy 
	LEFT JOIN wp_terms AS terms ON
		(terms.term_id = term_taxonomy.term_id)
	WHERE taxonomy = 'product_cat'";

	$results = $wpdb->get_results($query);
	return $results;
}

function wp_get_attributes($full = NULL){
	global $wpdb;
	$query = "SELECT * FROM `wp_woocommerce_attribute_taxonomies` WHERE 1=1 ORDER BY attribute_order ASC, attribute_name ASC";
	$results = $wpdb->get_results($query);
	
	if (isset($full)){
		$searchable_attributes = get_searchable_attributes();
		foreach ($results as $key=>$value){
			if (in_array($value->attribute_name, $searchable_attributes)){
				$query = "SELECT termmeta.*, terms.* FROM wp_woocommerce_termmeta AS termmeta 
					LEFT JOIN wp_terms AS terms ON
					(terms.term_id = termmeta.woocommerce_term_id)
					WHERE meta_key = 'order_pa_".$value->attribute_name."'";
				$res = $wpdb->get_results($query);
				$results[$key]->Attribute_values = $res;
			}
		}
	}
	
	return $results;
}

function get_searchable_attributes(){
	global $wpdb;
	$query = "SELECT attribute_name FROM `wp_woocommerce_attribute_taxonomies` WHERE attribute_searchable=1";
	$r_a = $wpdb->get_results($query, ARRAY_N);
	$searchable_attributes = array();
	foreach ($r_a as $a){
		$searchable_attributes[] = $a[0];
	}
	return $searchable_attributes;
}

function wp_set_link($attribute, $value, $metaset_id, $type){
	global $wpdb;
	$query = "INSERT INTO `wp_metaset_links` (
		`id` ,
		`metaset_id` ,
		`link_id` ,
		`type`
		)
		VALUES (
		NULL , 
		'".$metaset_id."', 
		'".$attribute[1]."',  
		'".$type."'
		);
			";
	$results = $wpdb->get_results($query);		
}

function get_metasets(){
	global $wpdb;
	$query = "SELECT * FROM wp_metasets as metasets WHERE 1=1";
	$results = $wpdb->get_results($query, ARRAY_A);
	
	foreach ($results as $key=>$value){
		$query = "SELECT * FROM wp_metaset_links WHERE wp_metaset_links.metaset_id = " . $results[$key]['id'];
		$r_l = $wpdb->get_results($query, ARRAY_A);
		$results[$key]['links'] = $r_l;
	}
	
	foreach ($results as $key=>$value){
		foreach ($results[$key]['links'] as $k=>$v){
			if ($results[$key]['links'][$k]['type'] == "C"){
				$query = "SELECT wp_terms.name FROM wp_terms WHERE wp_terms.term_id = " . $results[$key]['links'][$k]['link_id'];
				$r_c = $wpdb->get_results($query);
				$results[$key]['links'][$k]['link_name'] = $r_c[0]->name;
			}
			
			if ($results[$key]['links'][$k]['type'] == "A"){
				$query = "SELECT attribute_name FROM `wp_woocommerce_attribute_taxonomies` WHERE attribute_id = " . $results[$key]['links'][$k]['link_id'];
				
				$r_a = $wpdb->get_results($query);
				$results[$key]['links'][$k]['link_name'] = $r_a[0]->attribute_name;
			}
			
			if ($results[$key]['links'][$k]['type'] == "AV"){
				$query = "SELECT termmeta.*, terms.* FROM wp_woocommerce_termmeta AS termmeta 
					LEFT JOIN wp_terms AS terms ON
					(terms.term_id = termmeta.woocommerce_term_id)
					WHERE terms.term_id = " . $results[$key]['links'][$k]['link_id'];
				//$query = "SELECT attribute_name FROM `wp_woocommerce_attribute_taxonomies` WHERE attribute_id = " . $results[$key]['links'][$k]['link_id'];
				$r_a = $wpdb->get_results($query);
				
				$results[$key]['links'][$k]['link_name'] = $r_a[0]->name;
				$results[$key]['links'][$k]['attribute_name'] = str_ireplace("order_pa_", "", $r_a[0]->meta_key);
			}
		}
	}
	
	return $results;
}

function wp_delete_metaset($id){
	global $wpdb;
	$query = "DELETE FROM `wp_metasets` WHERE `wp_metasets`.`id` = $id";
	$results = $wpdb->get_results($query);	
	
	$query = "DELETE FROM `wp_metaset_links` WHERE `wp_metaset_links`.`metaset_id` = $id";
	$results = $wpdb->get_results($query);
}

function wp_check_link_metaset($metaset_id, $link_id, $c){
	global $wpdb;
	$query = "SELECT * FROM `wp_metaset_links` WHERE metaset_id = $metaset_id AND link_id = $link_id AND type = '".$c."'";
	$results = $wpdb->get_results($query);
	//pr($query);pr($results);die();
	if ($results) return TRUE;
	else return FALSE;
}

function wp_find_metaset($cat_name, $attributes = NULL){
	global $wpdb;
	$seo_array = array();
	
	$query = "SELECT * FROM `wp_terms` WHERE slug = '".$cat_name."' LIMIT 1";
	$results = $wpdb->get_results($query);
	//echo 'I am on wooku-seo-common.php';pr($query);
	$cat_id = $results[0]->term_id;
        //pr($cat_id);
       // pr($attributes);
	if (!$attributes){
		$query = "SELECT * FROM `wp_metaset_links` WHERE 
			link_id = $cat_id AND type = 'C' ";
		$results = $wpdb->get_results($query, ARRAY_A);
		
		foreach ($results as $result){
			$query = "SELECT COUNT(*) AS counter FROM wp_metaset_links WHERE metaset_id = " . $result['metaset_id'];
			$res = $wpdb->get_results($query);
			if ($res[0]->counter == 1){
				$metaset_id = $result['metaset_id'];
			}
		}
	} else {
		$attributes_found = array();
		$metasets_found = array();
		foreach ($attributes as $key=>$value){
			$attributes_found[] = $value;
			$query = "SELECT metaset_id FROM wp_metaset_links WHERE link_id = " . $value;
			$res = $wpdb->get_results($query);
			foreach ($res as $r){
				$metasets_found[] = $r->metaset_id;
			}
		}
		$metasets_found = array_unique($metasets_found);
		//echo "<pre><p>Metasets found</p>";var_dump($metasets_found);
		foreach ($metasets_found as $m_id){
			//echo "<p>Metaset id: $m_id</p>";
			$query = "SELECT * FROM wp_metaset_links WHERE metaset_id = $m_id";
			$results = $wpdb->get_results($query);
			//echo "<p>Results: ";var_dump($results);echo "</p>";
			$good = 0;
			foreach ($results as $r){
				if (($r->link_id == $cat_id && $r->type == "C") || in_array($r->link_id, $attributes_found)){
					$good++;
				}
			}
                        //echo "<p>good = $good</p>";
                        //pr($attributes_found);
                        //echo "<p>attributes found = " . count($attributes_found) . "</p>";
                        
                        $dif = (count($attributes_found)) ? "0" : "-1";
                        //echo "<p>dif = $dif</p>";
			if ($good == $dif+1+count($attributes_found)){ //1 (category) + number of attributes
				$metaset_id = $m_id;
				//break; 
			}
		}
		//echo "<p>Attributes found: </p>";var_dump($attributes_found);echo  "</p>";
		//echo '<p>$good = </p>';pr($good);
	}
        //var_dump($metaset_id);
	if (isset($metaset_id) && $metaset_id){
		$query = "SELECT * FROM wp_metasets WHERE wp_metasets.id = " . $metaset_id;
		$results = $wpdb->get_results($query, ARRAY_A);
		//echo 'final results:';pr($results);
		$seo_array = $results[0];
		return $seo_array;
	} else {
		return NULL;
	}
}

function check_seo_query_vars($query_vars){
	global $metaset;
	require_once(plugin_dir_path(__FILE__).'wooku-seo-common.php');
	if (isset($query_vars['product_cat'])){
		
	}
	
	$cat = "";
	$filters = array();
	foreach ($query_vars as $key=>$value){
		if ($key == 'product_cat'){
			$cat = $value;
		}
		if (stristr($key, "filter_")){
			$filters[str_ireplace("filter_", "", $key)] = $value;
		}
	}

	if ($cat) {
		$metaset = wp_find_metaset($cat, $filters);
	}
	
	//pr($query_vars);
	return $metaset;
}

function pr($arr){
	echo "<pre>"; print_r($arr); echo "</pre>";
}

function include_styles(){
	echo '<style type="text/css">
.attribute_name{
	display: block;
    float: left;
    line-height: 31px;
    margin-top: -11px;
    padding: 0 3em .5em 1em;
    width: 150px;
}
.clear{clear:both;}
.form-table1{border-collapse: collapse; font-size:1em;}
.form-table1 th{font-weight:bold; border-bottom: 1px solid #eee;}
.form-table1 td{border-bottom: 1px solid #eee; padding:0.5em 0; line-height:1.5em}
.form-table1 th.align_right{padding-right:1em; text-align:right;}
.form-table1 {width:98%;}
.attribute_values{
	margin: 0 1em 1em;
	line-height:1.5em;
	border-bottom: 1px dashed #777;
}
.end_row td{
border-bottom:4px solid #ccc;
}
.form-table1 th.ms_small{width:30px;}
.table_short{width:300px;}
h3{
	margin: 0 1em 1em;
	border-bottom: 1px dashed #777;
	padding-bottom: .5em;
	clear: both;
}
.h3in{
	
}
</style>';
}