<?php
$metaset_id = $_GET['id'];
wp_delete_metaset($metaset_id);

header("Location: " . get_admin_url().'tools.php?page=wooku-seo');