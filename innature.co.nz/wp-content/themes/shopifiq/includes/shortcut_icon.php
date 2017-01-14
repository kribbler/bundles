<?php 

global $wpdb; 

$media_data = $wpdb->get_results("SELECT type, url FROM " . $wpdb->prefix . "envoo_media");

if ( ! empty($media_data[0]->url) ): ?>

	<link rel="shortcut icon" href="<?php echo $media_data[0]->url; ?>" type="image/x-icon" />

<?php endif; ?>