<?php
$args = array(
	'post_type'		 => DD_VE_Opportunities::$cpt,
	'post_status'	 => 'publish',
	'posts_per_page' => -1,
	'orderby'		 => 'date',
	'order'			 => 'ASC',
	'tax_query'		 => array(
		array(
			'taxonomy'	 => DD_VE_Opportunities::$taxonomy,
			'field'		 => 'slug',
			'terms'		 => $instance['type']
		)
	),
	'meta_key'		 => DD_VE_Opportunities::$cpt . '_closing_date',
	'meta_value'	 => date('Y-m-d H:i:s'),
	'meta_type'		 => 'DATETIME',
	'meta_compare'	 => '>=',
);

$query = new WP_Query($args);
?>	<table class="opportunities-wrapper" cellpadding="5px" cellspacing="5">
	<tr class="jobs jobs_header">
		<th class="my_th c1">Job Title</th>
		<th class="my_th c2">Date Posted</th>
		<th class="my_th c3">Close</th>
		<th class="my_th c4">Job Call</th>
	</tr>
	<?php
	if ($query->have_posts()):
		?>

		<?php
		$k = 0;
		while ($query->have_posts()) {
			$query->the_post();

			/* Add in any custom meta fields */
			$meta_fields = DD_VE_Opportunities::$custom_meta_fields;

			foreach ($meta_fields as $key => $properties) {
				$fieldname	 = DD_VE_Opportunities::$cpt . "_" . $key;
				$meta[$key]	 = get_post_meta(get_the_ID(), $fieldname, true);
			}
			$job_categories = join(", <br />", DD_VE_Opportunities::get_taxonomies());

			$closing_date	 = (!empty($meta['closing_date'])) ? date(get_option('date_format'), strtotime($meta['closing_date'])) : '';
			?>
			<?php /*
			  <div style="display: none" class="row-fluid jobs <?php echo ($k++ % 2 == 0) ? 'no-bg' : '';?>">
			  <div class="span3 c1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			  <div class="span3 c2">

			  <div class="date_posted"><?php echo date("d-m-y", strtotime(the_date())); ?></div>
			  </div>
			  <div class="span3 c3">
			  <div class="date_closed"><?php echo date("d-m-y", strtotime($closing_date)); ?></div>
			  </div>
			  <div class="span3 c4">
			  <div class="job_call"><?php echo $job_categories; ?></div>
			  <a class="help_link" href="<?php the_permalink(); ?>">More Info</a>
			  <?php
			  $edit_post_link	 = get_edit_post_link();
			  if (!empty($edit_post_link))
			  echo "<br /><a href='" . esc_url($edit_post_link) . "' class='edit_link'>Edit Link</a>";
			  ?>
			  </div>
			  </div>
			 */ ?>
			<tr class="jobs <?php echo ($k++ % 2 == 0) ? 'no-bg' : ''; ?>">
				<td class="c1"><a class="fancybox" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
				<td class="c2"><div class="date_posted"><?php the_date(); ?></div></td>
				<td class="c3"><div class="date_closed"><?php echo date(get_option('date_format'), strtotime($closing_date)); ?></div></td>
				<td class="c4">
					<div class="job_call"><?php echo $job_categories; ?></div>
					<a class="help_link2 fancybox learn_more" href="<?php the_permalink(); ?>">More Info</a>
					<?php
					$edit_post_link	 = get_edit_post_link();
					if (!empty($edit_post_link))
						echo "<br /><a href='" . esc_url($edit_post_link) . "' class='edit_link'>Edit Link</a>";
					?>
				</td>
			</tr>
			<?php
		}
		?>

	<?php else:
		?>
		<tr><td colspan="4"><div  class="no-positions">Sorry but there currently are no open <?php echo ucfirst($instance['type']); ?> positions</div></td></tr>
		<?php endif; ?>
</table>
<?php
wp_reset_query();
