<?php

	$data = $wpdb->get_results("SELECT responsive FROM " . $wpdb->prefix . "envoo_account");
	$responsive = "";

	if (isset($data[0])) {
	$responsive = $data[0]->responsive;     
	}

?>

<?php if ( ($responsive == "on" && !isset($_COOKIE['responsive_on_demand'])) || ($responsive == "on" && $_COOKIE['responsive_on_demand']!= 'on' )): ?>

		<?php if ( ! isset($_COOKIE['responsive_on_demand']) || $_COOKIE['responsive_on_demand'] == 'off' ):  ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<style>
			body, html {
				overflow-x: hidden;
			}
		</style>

	<?php endif; ?>

<?php endif; ?>