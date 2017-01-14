<?php

	global $wpdb;
	$data = $wpdb->get_results("SELECT top_menu FROM " . $wpdb->prefix . "envoo_account");
	$top_menu = "";
	  
	if ( isset($data[0]) ) {
	  	$top_menu = $data[0]->top_menu; 	
	}

    $number_of_fields = 0;
    $has_icons = true;

    $data = $wpdb->get_results("SELECT facebook, google, twitter, linkedin, vimeo, youtube, flickr, copyright FROM " . $wpdb->prefix . "envoo_account");
    if ( ! isset( $data[0]->twitter ) ) {
        $data[0]->twitter = '';
    }

    if ( ! isset( $data[0]->facebook ) ) {
        $data[0]->facebook = '';
    }
    
    if ( ! isset( $data[0]->google ) ) {
        $data[0]->google = '';
    }

    if ( ! isset( $data[0]->linkedin ) ) {
        $data[0]->linkedin = '';
    }

    if ( ! isset( $data[0]->vimeo ) ) {
        $data[0]->vimeo = '';
    }

    if ( ! isset( $data[0]->youtube ) ) {
        $data[0]->youtube = '';
    }

    if ( ! isset( $data[0]->flickr ) ) {
        $data[0]->flickr = '';
    }

    if ( $data[0]->twitter == '' && $data[0]->facebook == '' && $data[0]->google == '' && $data[0]->linkedin == '' && $data[0]->vimeo == '' && $data[0]->youtube == '' && $data[0]->flickr == '' ) {
        $has_icons = false;
    }

    $top_menu_left = $wpdb->get_results("SELECT top_menu_label, top_menu_input FROM " . $wpdb->prefix . "envoo_account");

?>
    <input type="text" class="none" id="always-open" data-placeholder="<?php if ( $top_menu ==  "always open" ){ echo "yes"; } else { echo "no"; } ?>" value="<?php if ( $top_menu ==  "always open" ){ echo "yes"; } else { echo "no"; } ?>" />

          <?php if ( isset( $top_menu_left[0] ) ): ?>
          <div class="upper-menu <?php if ( $top_menu ==  "always open" ){ echo "upper-menu-open"; }; ?>">
              
            <div class="upper-menu-before"></div>

              <div class="main-wrapper">

                    <div class="header-xoxo">

                        <span class="announce clearfix">
                            <?php echo $top_menu_left[0]->top_menu_label; ?>
                        </span>
                        <span class="announce-after">
                            <?php echo $top_menu_left[0]->top_menu_input; ?>
                        </span>

                    </div>


                    <?php if ( ! $has_icons ): ?>
                        <div class="social-icons-wrapper">
                            <div class="social-icons">
                                <span style="visibility: hidden" class="announce clearfix"></span>
                                <span class="social-icons-wrap"></span>
                            </div>
                        </div>
					<?php else: ?>

						<div class="social-icons-wrapper">
                            <div class="social-icons">
                                <span class="announce clearfix"><?php echo __('socialise', 'shopifiq'); ?></span>
                                <span class="social-icons-wrap">
                                
                                    <?php if ( $data[0]->twitter != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="http://twitter.com/<?php echo $data[0]->twitter; ?>" class="twitter"><img alt="Twitter social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/twitter.png"></a>
                                    <?php endif;

                                    if ( $data[0]->facebook != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->facebook; ?>" class="facebook"><img alt="Facebook social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/facebook.png"></a>
                                    <?php endif;
        							
                                    if ( $data[0]->google != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->google; ?>" class="google"><img alt="Google social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/google.png"></a>
                                    <?php endif;
        							
                                    if ( $data[0]->linkedin != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->linkedin; ?>" class="linkedin"><img alt="Linkedin social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/linkedin.png"></a>
                                    <?php endif;

                                    if ( $data[0]->vimeo != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->vimeo; ?>" class="vimeo"><img alt="Vimeo social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/vimeo.png"></a>
                                    <?php endif;

                                    if ( $data[0]->youtube != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->youtube; ?>" class="youtube"><img alt="Youtube social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/youtube.png"></a>
                                    <?php endif;

                                    if ( $data[0]->flickr != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->flickr; ?>" class="flickr"><img alt="Flickr social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/flickr.png"></a>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                    <?php endif; ?>
              
                <div class="header-xoxo">
                    <div style="float: <?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ) { echo "left"; } else {echo "right";} ?> ">
                        <span class="announce clearfix"><?php echo __('search', 'shopifiq'); ?></span>
                        <div class="announce-after">
                  
                          	<form role="search" method="get" id="searchform_top" action="<?php echo home_url( '/' ); ?>">
                                <input type="text" value="" name="s" id="s-top" />
                            </form>
                  
                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
   

          <div class="upper-menu2 <?php if ( $top_menu ==  "always open" ){ echo "upper-menu-open"; }; ?>">
              
            <div class="upper-menu2-before"></div>

              <div class="main-wrapper">

                    <div class="header-xoxo">

                        <span class="announce clearfix">
                            <?php echo $top_menu_left[0]->top_menu_label; ?>
                        </span>
                        <span class="announce-after">
                            <?php echo $top_menu_left[0]->top_menu_input; ?>
                        </span>

                    </div>


                    <?php if ( ! $has_icons ): ?>
                        <div class="social-icons-wrapper">
                            <div class="social-icons">
                                <span style="visibility: hidden" class="announce clearfix"></span>
                                <span class="social-icons-wrap"></span>
                            </div>
                        </div>
                    <?php else: ?>

                        <div class="social-icons-wrapper">
                            <div class="social-icons">
                                <span class="announce clearfix"><?php echo __('socialise', 'shopifiq'); ?></span>
                                <span class="social-icons-wrap">
                                
                                    <?php if ( $data[0]->twitter != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="http://twitter.com/<?php echo $data[0]->twitter; ?>" class="twitter"><img alt="Twitter social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/twitter.png"></a>
                                    <?php endif;

                                    if ( $data[0]->facebook != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->facebook; ?>" class="facebook"><img alt="Facebook social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/facebook.png"></a>
                                    <?php endif;
                                    
                                    if ( $data[0]->google != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->google; ?>" class="google"><img alt="Google social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/google.png"></a>
                                    <?php endif;
                                    
                                    if ( $data[0]->linkedin != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->linkedin; ?>" class="linkedin"><img alt="Linkedin social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/linkedin.png"></a>
                                    <?php endif;

                                    if ( $data[0]->vimeo != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->vimeo; ?>" class="vimeo"><img alt="Vimeo social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/vimeo.png"></a>
                                    <?php endif;

                                    if ( $data[0]->youtube != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->youtube; ?>" class="youtube"><img alt="Youtube social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/youtube.png"></a>
                                    <?php endif;

                                    if ( $data[0]->flickr != '' ): $number_of_fields++; ?>
                                        <a target="_blank" href="<?php echo $data[0]->flickr; ?>" class="flickr"><img alt="Flickr social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/flickr.png"></a>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                    <?php endif; ?>
              
                <div class="header-xoxo">
                    <div style="float: right">
                        <span class="announce clearfix"><?php echo __('search', 'shopifiq'); ?></span>
                        <div class="announce-after">
                  
                            <form role="search" method="get" id="searchform2" action="<?php echo home_url( '/' ); ?>">
                                <input type="text" value="" name="s" id="s2-top" />
                            </form>
                  
                  
                        </div>
                    </div>
                </div>
            </div>
        </div>


          <?php endif; ?>
          