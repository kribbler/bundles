<?php get_header(); ?>
<?php if ( ( is_home() || is_front_page() ) && get_option('minimal_featured') == 'on') include(TEMPLATEPATH . '/includes/featured.php');?>


<?php include(TEMPLATEPATH . '/includes/default.php'); ?>
<?php if ( dynamic_sidebar('Home Icons') ) ?>
<?php if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163' || 1==1){?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$( ".firsticon" ).hover(
				function() {
					$('#content_firsticon').show();
				}, function() {
					$('#content_firsticon').hide();
				}
			);
			
			$( ".secondicon" ).hover(
				function() {
					$('#content_secondicon').show();
				}, function() {
					$('#content_secondicon').hide();
				}
			);
			
			$( ".thirdicon" ).hover(
				function() {
					$('#content_thirdicon').show();
				}, function() {
					$('#content_thirdicon').hide();
				}
			);
			
			$( ".fourthicon" ).hover(
				function() {
					$('#content_fourthicon').show();
				}, function() {
					$('#content_fourthicon').hide();
				}
			);
		});
	</script>
<? }?>
<?php get_footer(); ?>