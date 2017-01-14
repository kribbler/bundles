<?php
//
//	echo "<pre>";
//print_r(get_defined_vars());
//echo "</pre>";
$is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
if (!$is_ajax) 
	get_header();
else {

	$args = array(
		'post_type'		 => DD_VE_Opportunities::$cpt,
		'post_status'	 => 'publish',
		'posts_per_page' => -1,
		'orderby'		 => 'date',
		'order'			 => 'ASC',
	);
	query_posts($args);

	?>
	<div id="opt_header">
		<img src="<?php echo get_stylesheet_directory_uri();?>/images/logo-popup.png" />
		<div id="print_button">PRINT</div>
	</div>
	<div id="opt_content">
	<?php 
}

if (have_posts()) :
	while (have_posts()) : the_post();
		/* Add in any custom meta fields */
		$meta_fields = DD_VE_Opportunities::$custom_meta_fields;
		foreach ($meta_fields as $key => $properties) {
			$fieldname	 = DD_VE_Opportunities::$cpt . "_" . $key;
			$meta[$key]	 = get_post_meta(get_the_ID(), $fieldname, true);
		}
		/*
		 * $meta now contains all of the meta fields declared in dd-ve-opportunities/dd-ve-opportunities.php
		 */

		$closing_date	 = (!empty($meta['closing_date'])) ? date(get_option('date_format'), strtotime($meta['closing_date'])) : '';
		$terms			 = get_the_terms($post, DD_VE_Opportunities::$taxonomy);
		if ($terms && !is_wp_error($terms)) :
			$job_cats = array();
			foreach ($terms as $term) {
				$job_cats[] = $term->name;
			}
			$job_categories = join(", ", $job_cats);
		endif;
		$contact_person;
		if (class_exists('DD_PeopleManager') && !empty($meta['contact_id']) && $meta['contact_id'] > 0) {
			$contact_person = get_post($meta['contact_id']);
		}
		?>
		<?php if (!$is_ajax) {?>
		<div class="container">
		<div class="row-fluid">
			<div class="span12 large_margin" style="margin-top:40px">
		<?php } ?>
		<div class="">
			<h1 href="<?php the_permalink(); ?>"><?php the_title(); ?></h1>
			<?php
			if (!empty($contact_person)):
				?><div class="name"><?php echo $contact_person->post_title; ?></div>
				<?php
			else:
			/* Enter Default contact stuff here */
			endif;
			?>
			<div class="date_posted"><?php the_date(); ?></div>
			<div class="date_closed"><?php echo $closing_date; ?></div>
			<div class="job_call"><?php echo $job_categories; ?></div>
			<?php
			$edit_post_link = get_edit_post_link();
			if (!empty($edit_post_link))
				echo "<a href='" . esc_url($edit_post_link) . "' class='edit_link'>Edit Link</a>";
			?>
		</div>

		<div id="post">
			<?php the_content(); ?>
		</div> <!-- .post -->

		<?php if (!$is_ajax) {?>
		</div>
		</div>
		</div>
		<?php } ?>
		<?php
	endwhile; ?>
	</div>
	<div id="opt_footer">
		<div id="print_button2">PRINT</div>
		<a id="fancybox-close2"></a>
	</div>
<?php
endif;
?>

<script type="text/javascript">
jQuery(function($) {
    $("#print_button").click(function() {
        window.print();
    });
	$("#print_button2").click(function() {
        window.print();
    });

    $('#fancybox-close2').click(function(){
    	$('#fancybox-close').trigger('click');
    })

});
</script>
<?php
if (!$is_ajax)
	get_footer();
else
	wp_reset_query();
?>