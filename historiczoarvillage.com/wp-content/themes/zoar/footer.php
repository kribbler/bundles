<?php



/**



 * The template for displaying the footer.



 *



 * Contains the closing of the id=main div and all content



 * after. Calls sidebar-footer.php for bottom widgets.



 *



 * @package WordPress



 * @subpackage Twenty_Ten



 * @since Twenty Ten 1.0



 */



?>



	</div><!-- #main -->







	<div id="footer" role="contentinfo">



		<div id="colophon">



         <div id="hold_first">



           <div class="f_box">



           <h3>WHAT'S NEW IN ZOAR</h3>



            <?php query_posts('cat=1&showposts=2');?>



               <?php if(have_posts()): while(have_posts()): the_post(); ?>



                  <div class="recent_news">



                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>  



                    <?php the_excerpt(); ?> 



                  </div>                               



               <?php endwhile; ?>



             <?php endif; ?>



            </div><!-- .f_box -->



            



           <?php dynamic_sidebar('footer-map-and-directions'); ?>



           <?php dynamic_sidebar('event-calender'); ?>           



           <div class="clear"></div>



         </div> <!-- #hold_first -->



         <div id="hold_second">



           <div class="left"><a href="#top">Return to top of page</a></div>



           <div class="right">Copyright &copy; <?php the_time('Y'); ?> Zoar Historic Village</div>



           <div class="clear"></div>



         </div> <!-- #hold_second -->



		</div><!-- #colophon -->



	</div><!-- #footer -->







</div><!-- #wrapper -->

<div style="width:990px; margin: 0 auto; text-align:center;">

<a style="color:#999;" href="http://www.sktthemes.net">SKT Wordpress Themes</a>

</div>

<?php



	/* Always have wp_footer() just before the closing </body>



	 * tag of your theme, or you will break many plugins, which



	 * generally use this hook to reference JavaScript files.



	 */







	wp_footer();



?>



</body>



</html>