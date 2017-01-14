<?php

function clients($atts, $content = null) {
	extract(shortcode_atts(array('margin_top' => '', 'margin_bottom' => ''), $atts));
	global $concept7_data;
	global $post;
	$output = "";
	$output .= '<div class="clients-container" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">
      	<div class="container">';
			$args = array(
				'post_type' =>'clients',
				'numberposts' => -1,
				'orderby' => 'ASC'
			);
			$clients = get_posts($args);
			
			if($clients) {
            $output .= '
             	<div class="client">
                    <div class="row client-list">';
						$client_i = 1 ;
						foreach($clients as $post) : setup_postdata($post);
                        $output .= '<div class="span3 client-logo">';
                        	if ( has_post_thumbnail()) :
                                $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
									$image_src = aq_resize( $thumbnail, 180, 90, false );
                                $output .= '<a href="' .get_post_meta($post->ID, 'client-url', true). '" title="' .get_the_title(). '" target="_blank"><img src="'.$thumbnail.'" alt="'.get_the_title(). '" class="client-img"/></a>';
                            endif;
                        $output .= '</div>';
						/*if($client_i%4 == 0 && $client_i != sizeof($clients)){
							$output .= '<span class="client-line"></span>';
						}
						$client_i++;*/
                        endforeach; wp_reset_postdata();
                    $output .= '</div>
                </div>
            </div>';
            }
        $output .= '</div>';

   return $output;
}
add_shortcode('clients', 'clients');

?>