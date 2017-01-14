<?php
$args = array(
	'post_type'		 => DD_PeopleManager::$cpt,
	'post_status'	 => 'publish',
	'posts_per_page' => -1,
	'tax_query'		 => array(
		array(
			'taxonomy'	 => DD_PeopleManager::$taxonomy,
			'field'		 => 'slug',
			'terms'		 => 'contact'
		)
	)
);
query_posts($args);

$contacts = array();

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
	$details['edit_link']		 = get_edit_post_link();
	/* Add in any custom meta fields */
	foreach (DD_PeopleManager::$custom_meta_fields as $key => $label) {
		$fieldname		 = DD_PeopleManager::$cpt . "_" . $key;
		$details[$key]	 = get_post_meta(get_the_ID(), $fieldname, true);
	}

	/* Only add the person if they have a name */
	if (!empty($details['name'])) {
		$contacts[$details['name']] = $details;
	}
}
wp_reset_query();
ksort($contacts);
if (!empty($contacts)) {
	$k = 0;
	?>
	<div class="row-fluid contacts_row">
		<?php foreach ($contacts as $contact): ?>
			<div class="span2">
				<div class="thumbnail-wrapper"><?php echo wp_get_attachment_image($contact['profile_image_id']); ?></div>
				<div class="name-wrapper">
					<div class="info_wrap">
						<h3 class="name">
							<?php echo $contact['name'] ?>,
							<?php if (!empty($contact['credentials'])) : ?>
								<span><?php echo $contact['credentials']; ?></span>
							<?php endif; ?>
						</h3>
						<h4 class="position"><?php echo $contact['position']; ?></h4>
						<?php if (!empty($contact['phone_number'])) { ?>
							<span class="phone_number"><?php
								echo $contact['phone_number'];
								if (!empty($contact['phone_ext'])) {
									echo '<span class="phone_ext"> x' . $contact['phone_ext'] . '</span>';
								}
								?>
							</span>
							<?php
						}?>
					</div>
					<?php if (!empty($contact['email'])) {
						?>
						<a href="#contact_form_pop_<?php echo sanitize_title($contact['name']);?>" class="fancybox email_me" >Email Me</a>
						<div style="display:none" class="fancybox-hidden">
						    <div id="contact_form_pop_<?php echo sanitize_title($contact['name']);?>">
						       <?php echo do_shortcode($contact['contact_form_shortcode']);?>
						    </div>
						</div>
						<noscript>
						
						</noscript>
					<?php } ?>
				</div>
			</div>
			<?php if (++$k%5==0) {?>
			</div><br /><br /><div class="row-fluid contacts_row">
			<?php } ?>
		<?php endforeach; ?>
	</div>

	<div class="contacts" style="display: none">
		<?php foreach ($contacts as $contact): ?>
			<div class="contact-wrapper">
				<div class="thumbnail-wrapper"><?php echo wp_get_attachment_image($contact['profile_image_id']); ?></div>
				<div class="name-wrapper">
					<h3 class="name">
						<?php echo $contact['name'] ?>,
						<?php if (!empty($contact['credentials'])) : ?>
							<span><?php echo $contact['credentials']; ?></span>
						<?php endif; ?>
					</h3>
					<h4 class="position"><?php echo $contact['position']; ?></h4>
					<?php if (!empty($contact['phone_number'])) { ?>
						<span class="phone_number"><?php
							echo $contact['phone_number'];
							if (!empty($contact['phone_ext'])) {
								echo '<span class="phone_ext"> x' . $contact['phone_ext'] . '</span>';
							}
							?>
						</span>
						<?php
					}
					if (!empty($contact['email'])) {
						?>
						<a class="email_me" onclick="openContactForm('<?php echo DD_PeopleManager::generateEmailKey($contact['email']); ?>')">Email Me</a>
					<?php } ?>
				</div>
				<?php
				if (!empty($contact['edit_link']))
					echo "<a href='" . esc_url($contact['edit_link']) . "' class='edit_link'>Edit Person</a>";
				?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}
//print_r(descramble('daniel@divinedesigns.ca'));
//print_r(descramble('BW8PdlVpBGM='));
//echo DD_PeopleManager::descramble_recipient_address("WUptVWdSbzY1RlZrMGFaQ05YalVId3gxY0JGREMza0dyTGY4dml2UHRMQT0=");