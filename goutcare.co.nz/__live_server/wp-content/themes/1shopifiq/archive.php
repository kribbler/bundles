<?php get_header(); ?>

<?php   
         $month = get_the_date('m');
         $year = get_the_date('Y');
	 get_template_part( 'loop', 'archive' );
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>