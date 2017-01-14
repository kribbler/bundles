<?php if ( ! isset($_COOKIE['responsive_on_demand']) || $_COOKIE['responsive_on_demand'] == 'off' ):  ?>
	<meta name="viewport" content="width=device-width, maximum-scale=1">
	<style>
		body, html {
			overflow-x: hidden;
		}
	</style>
<?php endif; ?>