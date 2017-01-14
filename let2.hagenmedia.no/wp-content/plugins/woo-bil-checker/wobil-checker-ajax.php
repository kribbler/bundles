<?php
$products = $_POST['products'];
//echo "<pre>";var_dump($products[$_POST['offset']]);
$expired = array();

$response = array();
$response['remaining_count'] = count($products) - $_POST['offset'] - 1;
$response['limit'] = $_POST['limit'];
$response['new_offset'] = $_POST['offset'] + 1;
$response['exist'] = check_existence($products[$_POST['offset']]);
$response['product_id'] = $products[$_POST['offset']]['ID'];
//echo "<pre>";var_dump($response);
echo json_encode($response);die();