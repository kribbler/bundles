<?php
$args = array(
	'post_type'		 => DD_PeopleManager::$cpt,
	'post_status'	 => 'publish',
	'posts_per_page' => -1,
	'tax_query'		 => array(
		array(
			'taxonomy'	 => DD_PeopleManager::$taxonomy,
			'field'		 => 'slug',
			'terms'		 => 'board-member'
		)
	)
);
query_posts($args);

$profiles_without_bios	 = array();
$profiles_with_bios		 = array();

while (have_posts()) {
	the_post();
	$details = array();
	$content = get_the_content();
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	$details['name'] = get_the_title();

	$details['content']			 = $content;
	$details['profile_image_id'] = get_post_thumbnail_id();
	$details['has_bio']			 = (!empty($details['content']) ? true : false);
	//$details['type'] = dd_boardmember_category;
	$details['edit_link']		 = get_edit_post_link();
	/* Add in any custom meta fields */
	foreach (DD_PeopleManager::$custom_meta_fields as $key => $label) {
		$fieldname		 = DD_PeopleManager::$cpt . "_" . $key;
		$details[$key]	 = get_post_meta(get_the_ID(), $fieldname, true);
	}

	if (!empty($details['name'])) {
		if ($details['has_bio'])
			$profiles_with_bios[$details['name']]	 = $details;
		else
			$profiles_without_bios[$details['name']] = $details;
	}
}
wp_reset_query();
ksort($profiles_with_bios);
ksort($profiles_without_bios);
if (!empty($profiles_with_bios)) {
	?>
	<div class="profiles-with-bios large_margin">
		<?php foreach ($profiles_with_bios as $profile): ?>
			<div class="profile-wrapper<?php echo ($profile['has_bio']) ? " has-bio" : " no-bio"; ?>">
				<div class="row-fluid">
					<div class="span3">
						<div class="thumbnail-wrapper"><?php echo wp_get_attachment_image($profile['profile_image_id'], 'full'); ?></div>
					</div>
					<div class="span9">
						<div class="name-wrapper">
							<h3 class="name">
								<?php echo $profile['name'] ?>,
								<?php if (!empty($profile['credentials'])) : ?>
									<span><?php echo $profile['credentials']; ?></span>
								<?php endif; ?>
							</h3>
							<h4 class="position"><?php echo $profile['position']; ?></h4>
						</div>
						<div class="bio-content"><?php echo $profile['content']; ?></div>
						<?php
						if (!empty($profile['edit_link']))
							echo "<a href='" . esc_url($profile['edit_link']) . "' class='edit_link'>Edit Person</a>";
						?>
					</div>
				</div>
				<div class="back_to_top back_blueish">BACK TO TOP</div>
				&nbsp;
				&nbsp;
			</div>
		<?php endforeach; ?>
		
	</div>
	<?php
}
if (!empty($profiles_without_bios)) {
	?>
	<hr />
	<div class="profiles-without-bios">
		<div class="large_margin2">
			<div class="row-fluid">
				<?php $x = 0; foreach ($profiles_without_bios as $profile): ?>
					<?php echo ($x++ % 3 == 0) ? '</div><br /><div class="row-fluid">' : '';?>
					<div class="span4">
						<div class="profile-wrapper<?php echo ($profile['has_bio']) ? " has-bio" : " no-bio"; ?>">
							<div class="name-wrapper">
								<h3 class="name">
									<?php echo $profile['name'] ?>,
									<?php if (!empty($profile['credentials'])) : ?>
										<span><?php echo $profile['credentials']; ?></span>
									<?php endif; ?>
								</h3>
								<h4 class="position"><?php echo $profile['position']; ?></h4>
							</div>
							<?php
							if (!empty($profile['edit_link']))
								echo "<a href='" . esc_url($profile['edit_link']) . "' class='edit_link'>Edit Person</a>";
							?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="back_to_top back_blueish">BACK TO TOP</div>
		</div>
	</div>
<?php } ?>