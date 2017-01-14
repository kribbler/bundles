<?php
/**
 * Template Name:Template Vertual Tour
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">  
            <h1 class="entry-title"><?php the_title(); ?></h1>
              <?php if(have_posts()): while(have_posts()): the_post(); ?>                   
                    <?php the_content(); ?>
                    <div id="tours">
                        <a href="http://historiczoarvillage.com/meeting-house/">
                        <div class="tTip" id="cloud1" title="The Meeting House "></div>
                        </a>
                         <a href="http://historiczoarvillage.com/weaving-house/">
                         <div class="tTip" id="cloud2" title="The Weaving House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/school-house/">
                        <div class="tTip" id="cloud3" title="The School House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-bakery/">
                        <div class="tTip" id="cloud4" title="The Bakery"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/bimeler-cabin/">
                        <div class="tTip" id="cloud5" title="The Bimeler Cabin"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/number-9-house/">
                        <div class="tTip" id="cloud6" title="Number 9 House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/garden-house/">
                        <div class="tTip" id="cloud7" title="The Garden House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/sewing-house/">
                        <div class="tTip" id="cloud8" title="The Sewing House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-bimeler-museum/">
                        <div class="tTip" id="cloud9" title="The Bimeler Museum"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/number-one-house/">
                        <div class="tTip" id="cloud10" title="Number One House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/town-hall/">
                        <div class="tTip" id="cloud11" title="The Town Hall"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/treasurers-house/">
                        <div class="tTip" id="cloud12" title="The Treasurers House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-zoar-store/">
                        <div class="tTip" id="cloud13" title="The Zoar Store"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/tailor-shop/">
                        <div class="tTip" id="cloud14" title="The Tailor Shop"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/number-23-house/">
                        <div class="tTip" id="cloud15" title="Number 23 House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/tin-shop/">
                        <div class="tTip" id="cloud16" title="The Tin Shop"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/assembly-house/">
                        <div class="tTip" id="cloud17" title="The Assembly House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/cobbler-shop/">
                        <div class="tTip" id="cloud18" title="The Cobbler Shop"></div> 
                        </a>
                        <a href="http://historiczoarvillage.com/zoar-hotel/">
                        <div class="tTip" id="cloud19" title="The Zoar Hotel"></div> 
                        </a>
                        <a href="http://historiczoarvillage.com/cider-mill/">
                        <div class="tTip" id="cloud20" title="The Cider Mill"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-blacksmith/">
                        <div class="tTip" id="cloud21" title="The Blacksmith"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-print-shop/">
                        <div class="tTip" id="cloud22" title="The Print Shop"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-hermitage/">
                        <div class="tTip" id="cloud23" title="The Hermitage"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-bauer-house/">
                        <div class="tTip" id="cloud24" title="The Bauer House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-boys-dorm/">
                        <div class="tTip" id="cloud25" title="The Boys Dorm"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/number-14-house/">
                        <div class="tTip" id="cloud26" title="Number 14 House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/first-school/">
                        <div class="tTip" id="cloud27" title="The First School"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/the-cider-house/">
                        <div class="tTip" id="cloud28" title="The Cider House"></div>
                        </a>
                        <a href="http://historiczoarvillage.com/number-21-house/">
                        <div class="tTip" id="cloud29" title="Number 21 House"></div>
                        </a>
                    </div>                                         
               <?php endwhile; ?>
             <?php endif; ?>
              <?php wp_reset_query(); ?>                                  
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>