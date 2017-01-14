<?php
global $post;
/* Add in any custom meta fields */
foreach ($meta_fields as $field => $properties) {
	$label		 = $properties['label'];
	$fieldname	 = DD_VE_Opportunities::$cpt . "_" . $field;
	$value		 = get_post_meta($post->ID, $fieldname, true);
	$type		 = $properties['type'];
	?>
	<div style="margin-top:15px;" class="<?php echo DD_VE_Opportunities::$cpt; ?>_field_wrapper <?php echo $fieldname . ' field-type-' . $type; ?>">
		<?php
		/*
		 * Did this field get its own meta_box? This is only set if a meta_box was specifically created for this metafield
		 */
		if (empty($properties['own_box'])) { ?>
			<p class="description"><?php echo html($label); ?>:</p>
		<?php } ?>
		<?php
		switch ($type) {

			case 'custom_owner':
				if (!class_exists('DD_PeopleManager')) {
					echo 'You need the People Manager plugin by Daniel Roth for this to work';
					continue;
				}

				$args	 = array(
					'post_type'		 => DD_PeopleManager::$cpt,
					'post_status'	 => 'publish',
					'posts_per_page' => -1,
					'orderby'		 => 'title',
					'order'			 => 'ASC',
				);
				$people	 = get_posts($args);
				if (!empty($people)):
					echo '<div>';
						?><input type="radio" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" value="0" <?php echo (empty($value))?"CHECKED='CHECKED'":"" ?> />No Contact<br><?php
					foreach ($people as $person) :
						//print_r($person);
						?><input type="radio" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" value="<?php echo htmlq($person->ID); ?>" <?php checked( $value, $person->ID ); ?> /><?php echo $person->post_title; ?><br>
						<?php
					endforeach;

					echo "</div>";
				else:
					echo "No People Found";
				endif;
				break;
			case 'textarea':
				?><textarea id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" style="width:100%"><?php echo htmlq($value); ?></textarea>
				<?php
				break;
			case 'wysiwyg':
				wp_editor($value, $fieldname, array('media_buttons' => false));
				?>
				<?php
				break;
			case 'date':
				/* $date = (!empty($value)) ? date('Y-m-d', $value) : ''; */
				global $wp_locale;
				$edit		 = (!empty($value));
				$time_adj	 = current_time('timestamp') + WEEK_IN_SECONDS;
				$post_date	 = $value;

				$jj	 = ($edit) ? mysql2date('d', $post_date, false) : gmdate('d', $time_adj);
				$mm	 = ($edit) ? mysql2date('m', $post_date, false) : gmdate('m', $time_adj);
				$aa	 = ($edit) ? mysql2date('Y', $post_date, false) : gmdate('Y', $time_adj);
				$hh	 = ($edit) ? mysql2date('H', $post_date, false) : gmdate('H', $time_adj);
				$mn	 = ($edit) ? mysql2date('i', $post_date, false) : gmdate('i', $time_adj);
				$ss	 = ($edit) ? mysql2date('s', $post_date, false) : gmdate('s', $time_adj);

				$cur_jj	 = gmdate('d', $time_adj);
				$cur_mm	 = gmdate('m', $time_adj);
				$cur_aa	 = gmdate('Y', $time_adj);
				$cur_hh	 = gmdate('H', $time_adj);
				$cur_mn	 = gmdate('i', $time_adj);

				$month = '<label class="screen-reader-text" for="' . $fieldname . '_mm">' . __('Month') . '</label><select name="' . $fieldname . '_mm" >\n';
				for ($i = 1; $i < 13; $i = $i + 1) {
					$monthnum = zeroise($i, 2);
					$month .= "\t\t\t" . '<option value="' . $monthnum . '" ' . selected($monthnum, $mm, false) . '>';
					/* translators: 1: month number (01, 02, etc.), 2: month abbreviation */
					$month .= sprintf(__('%1$s-%2$s'), $monthnum, $wp_locale->get_month_abbrev($wp_locale->get_month($i))) . "</option>\n";
				}
				$month .= '</select>';

				$day	 = '<label for="' . $fieldname . '_jj" class="screen-reader-text">' . __('Day') . '</label><input type="text" name="' . $fieldname . '_jj" value="' . $jj . '" size="2" maxlength="2" autocomplete="off" />';
				$year	 = '<label for="' . $fieldname . '_aa" class="screen-reader-text">' . __('Year') . '</label><input type="text" name="' . $fieldname . '_aa" value="' . $aa . '" size="4" maxlength="4" autocomplete="off" />';
				$hour	 = '<label for="' . $fieldname . '_hh" class="screen-reader-text">' . __('Hour') . '</label><input type="text" name="' . $fieldname . '_hh" value="' . $hh . '" size="2" maxlength="2" autocomplete="off" />';
				$minute	 = '<label for="' . $fieldname . '_mn" class="screen-reader-text">' . __('Minute') . '</label><input type="text" name="' . $fieldname . '_mn" value="' . $mn . '" size="2" maxlength="2" autocomplete="off" />';

				echo '<div class="timestamp-wrap">';
				/* translators: 1: month, 2: day, 3: year, 4: hour, 5: minute */
				printf(__('%1$s %2$s, %3$s @ %4$s : %5$s'), $month, $day, $year, $hour, $minute);

				echo '</div><input type="hidden" name="' . $fieldname . '_ss" value="' . $ss . '" />';
				?>
				<?php /* 	<input type="text" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" style="width:100%" value="<?php echo htmlq($date); ?>"/> */ ?>
				<style>
					.timestamp-wrap select,
					.timestamp-wrap input {
						height: 21px;
						line-height: 14px;
						padding: 0;
						vertical-align: top;
						font-size: 12px;
					}</style><?php
					break;
				case 'text':
				default:
					?><input type="text" id="<?php echo $fieldname ?>" name="<?php echo $fieldname; ?>" style="width:100%" value="<?php echo htmlq($value); ?>"/>
				<?php
				break;
		}
		?>
	</div><?php
}
?>