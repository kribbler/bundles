<?php 
//pr($_POST);die();
$metaset = wp_save_metaset($_POST);
header("Location: " . get_admin_url().'tools.php?page=wooku-seo');
?>