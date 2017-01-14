<?php
$args = array(
	'post_type'		 => DD_UsefulLinks::$cpt,
	'post_status'	 => 'publish',
	'posts_per_page' => -1,
	'orderby'		 => 'title',
	'order'			 => 'ASC',
);
query_posts($args);

$links = array();

while (have_posts()) {
	the_post();
	$details = array();
	$content = get_the_content();
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	$details['organization'] = get_the_title();

	$details['content']			 = $content;
	$details['logo_image_id']	 = get_post_thumbnail_id();
	$details['edit_link']		 = get_edit_post_link();

	/* Add in any custom meta fields */
	foreach (DD_UsefulLinks::$custom_meta_fields as $key => $label) {
		$fieldname		 = DD_UsefulLinks::$cpt . "_" . $key;
		$details[$key]	 = get_post_meta(get_the_ID(), $fieldname, true);
	}
	if (!empty($details['organization'])) {
		$links[$details['organization']] = $details;
	}
}
wp_reset_query();
ksort($links);
if (!empty($links)) {
	?>
	<div class="useful-links">
		<?php $k=0; foreach ($links as $link): ?>
			<hr />
			<div class="useful-link-wrapper large_margin">
				<div class="row-fluid">
					<div class="span4">
						<div class="thumbnail-wrapper"><?php echo wp_get_attachment_image($link['logo_image_id']); ?></div>
					</div>
					<div class="span8">
						<?php echo (++$k%5 == 0) ? '<div class="back_to_top back_blueish">BACK TO TOP</div>' : '';?>
						<h2 class="organization"><?php echo $link['organization'] ?></h2>
						<div class="link-content"><?php echo $link['content']; ?></div>
						<?php if (!empty($link['link'])) { ?>
							<a class="help_link" href="<?php echo esc_url($link['link']); ?>" class="link" target="_blank" title="Visit <?php echo esc_attr($link['organization']); ?>'s website">Go to Website</a>
							<?php
						}
						if (!empty($link['edit_link']))
							echo "<a href='" . esc_url($link['edit_link']) . "' class='edit_link'>Edit Link</a>";
						?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}