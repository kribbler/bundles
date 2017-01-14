<div class="social">

	<div class="main-wrapper">
		
		
		<?php
			global $wpdb;
			$data_on_demand = $wpdb->get_results("SELECT responsive_demand  FROM " . $wpdb->prefix . "envoo_account");
			if( isset($data_on_demand[0]->responsive_demand) && $data_on_demand[0]->responsive_demand == "on" ): ?>        
				  <a class="responsive-on-demand<?php if ( isset($_COOKIE['responsive_on_demand']) && $_COOKIE['responsive_on_demand'] == 'on' ) { echo '-selected'; } ?>"></a>
	    	<?php endif; ?>   
		
		
		<?php
            global $wpdb;
            $number_of_fields = 0;
            $data = $wpdb->get_results("SELECT facebook, google, twitter, linkedin, vimeo, youtube, flickr, copyright FROM " . $wpdb->prefix . "envoo_account");
         ?>
          
		<?php if(isset($data[0]->copyright)): ?>
            <div style="text-align:center"><div class="copyright"><?php echo $data[0]->copyright; ?></div></div>
        <?php endif; ?>
          
    	<?php
            
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
            
            if ( $data[0]->twitter == '' && $data[0]->facebook == '' && $data[0]->google == '' && $data[0]->linkedin == '' && $data[0]->vimeo == '' && $data[0]->youtube == '' && $data[0]->flickr == '' ):
                
            else:
    		?>
    
    			<div class="social-icons-wrapper"><div class="social-icons"><span class="announce clearfix"><?php echo __('socialise', 'shopifiq'); ?></span><span class="social-icons-wrap">
    
            <?php 
                    
                    if ( $data[0]->twitter != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="http://twitter.com/<?php echo $data[0]->twitter; ?>" class="twitter"><img alt="Twitter social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/twitter.png"></a>
                        <?php
                    endif;
                    
                    if ( $data[0]->facebook != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->facebook; ?>" class="facebook"><img alt="Facebook social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/facebook.png"></a>
                        <?php
                    endif;
                    
                    if ( $data[0]->google != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->google; ?>" class="google"><img alt="Google social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/google.png"></a>
                        <?php
                    endif;
					 
                    if ( $data[0]->linkedin != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->linkedin; ?>" class="linkedin"><img alt="Linkedin social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/linkedin.png"></a>
                        <?php
                    endif;
                    
                    if ( $data[0]->vimeo != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->vimeo; ?>" class="vimeo"><img alt="Vimeo" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/vimeo.png"></a>
                        <?php
                    endif;
                    
                    if ( $data[0]->youtube != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->youtube; ?>" class="youtube"><img alt="Youtube social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/youtube.png"></a>
                        <?php
                    endif;
                    
                    if ( $data[0]->flickr != '' ): $number_of_fields++;
                        ?>
                            <a target="_blank" href="<?php echo $data[0]->flickr; ?>" class="flickr"><img alt="Flickr social icon" src="<?php echo get_template_directory_uri(); ?>/images/social-icons/flickr.png"></a>
                        <?php
                    endif;
            ?></span></div></div>
		<?php endif; ?>
        
        
     </div>
  </div>
