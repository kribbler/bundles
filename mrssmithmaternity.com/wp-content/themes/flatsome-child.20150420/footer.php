<?php
/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
?>

</div><!-- #main-content -->

<footer class="footer-wrapper" role="contentinfo">
<div class="footfix_wrap">
<!-- FOOTER 1 -->
<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
<div class="footer footer-1 <?php echo $flatsome_opt['footer_1_color']; ?>" >
	<div class="row">
   		<?php dynamic_sidebar('sidebar-footer-1'); ?>        
	</div><!-- end row -->
</div><!-- end footer 1 -->
<?php endif; ?>


<?php if(isset($flatsome_opt['html_before_footer'])){
	// BEFORE FOOTER HTML BLOCK
	echo do_shortcode($flatsome_opt['html_before_footer']);
} ?>


<!-- FOOTER 2 -->
<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
<div class="footer footer-2 <?php echo $flatsome_opt['footer_2_color']; ?>">
	<div class="row">

   		<?php dynamic_sidebar('sidebar-footer-2'); ?>        
	</div><!-- end row -->
</div><!-- end footer 2 -->
<?php endif; ?>
<div class="footer foot_lastblk">
    <div class="contact_footer">
        <?php dynamic_sidebar('contft_blk'); ?>
    </div>
    <div class="socicon_foot">
        <?php dynamic_sidebar('socicon_foot'); ?>
    </div>
</div>
<?php if(isset($flatsome_opt['html_after_footer'])){
	// AFTER FOOTER HTML BLOCK
	echo do_shortcode($flatsome_opt['html_after_footer']);
} ?>

</div>
<!-- .absolute-footer -->
</footer><!-- .footer-wrapper -->
</div><!-- #wrapper -->

<!-- back to top -->
<a href="#top" id="top-link"><span class="icon-angle-up"></span></a>

<?php if(isset($flatsome_opt['html_scripts_footer'])){
	// Insert footer scripts
	echo $flatsome_opt['html_scripts_footer'];
} ?>


<?php wp_footer(); ?>

</body>
</html>