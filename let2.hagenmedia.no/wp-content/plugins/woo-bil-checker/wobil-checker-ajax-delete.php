<?php
$deleted = array();
if ($_POST['ids']){
	foreach ($_POST['ids'] as $id){
		$x = wp_delete_post($id);
		$deleted[] = $id;
	}
}

echo json_encode($deleted);