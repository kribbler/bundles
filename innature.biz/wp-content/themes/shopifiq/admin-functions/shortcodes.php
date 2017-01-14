<?php



function recent_projects_func( $atts,  $content ) {
    global $post;

    query_posts('category_name=portfolio&order=ASC&posts_per_page=99999');
    
    $max_per_pages = $content;
    $number_of_columns = "four-column";
    
    $return_data = '<h4>' . __('Recent projects', 'shopifiq') . '</h4>';
    
    $return_data .= '<div class="main-wrapper portfolio-wrapper recent-projects"><ul style="margin : 0" class="portfolio clearfix">';
        
        $args = array(
            'post_type'    => 'portfolio',
            'orderby'      => 'id',
            'order'        => 'DESC',
            'numberposts'  => -1,
        );
        
        $thumbnail_args = array(
            'alt'   => "",
            'title' => "",
        );
                
        $current_number = 0;
        $current_class = 1;
        $portfolio_posts = get_posts( $args );
        $first_line = 'style="margin-top: 20px"';
        
        foreach( $portfolio_posts as $post ) :  setup_postdata($post); ?>
                
                <?php
                    if ( $current_number++ == $max_per_pages) {
                        break;
                        $current_number = 1;
                        $current_class++;
                    }
                    if( $current_number == 5 ) {
                        $first_line = '';
                    }
                ?>
                
            <?php $return_data .= '<li ' . $first_line . ' class="isotope-item  page-1 ' . $number_of_columns . '">'; ?> 
                    
                    <?php if( $number_of_columns == "four-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-4-column", $thumbnail_args); ?>
                    <?php elseif ( $number_of_columns == "three-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-3-column", $thumbnail_args); ?>
                    <?php else: ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-2-column", $thumbnail_args); ?>
                    <?php endif; ?>
                    
                    <?php $return_data .= '<div class="portfolio-responsive">' . get_the_post_thumbnail($post->ID, "portfolio-first-responsive", $thumbnail_args) . '</div>';
                    
                    $return_data .= '<h3>' . get_the_title() . '</h3>';
                    
                    $return_data .= '<div class="portfolio-hover">';
                    $return_data .= '<h3>';
                    $return_data .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    $return_data .= '</h3>';
                    $return_data .= '<p>';
                    ?>
                            <?php 
                                global $more;
                                $more = 0;
                                $return_data .= get_the_content(''); 
                            ?>
                        <?php $return_data .= '</p>';
                        $return_data .= '<a rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '" class="enlarge"></a>';
                        $return_data .= '<a href="' . get_permalink() . '" class="open"></a>';
                    $return_data .= '</div>';
                    
               $return_data .= '</li>';
        endforeach; 
    $return_data .= '</ul>'; 
$return_data .= '</div><div class="main-wrapper clearfix">';
    


    return $return_data;

}

add_shortcode( 'recent_projects', 'recent_projects_func' );





function projects_by_id_func( $atts,  $content ) {
    global $post;

    query_posts('category_name=portfolio&order=ASC&posts_per_page=99999');
    
    $number_of_columns = "four-column";
        
    $return_data = '<div class="main-wrapper portfolio-wrapper recent-projects"><ul style="margin : 0" class="portfolio clearfix">';
        
        $args = array(
            'post_type'    => 'portfolio',
            'numberposts'  => -1,
            'post__in'      =>  explode(",", $content)
        );
        
        $thumbnail_args = array(
            'alt'   => "",
            'title' => "",
        );
                
        $current_number = 0;
        $current_class = 1;
        $portfolio_posts = get_posts( $args );
        $first_line = 'style="margin-top: 20px"';
        
        foreach( $portfolio_posts as $post ) :  setup_postdata($post); ?>
                
                <?php
                    $current_number++;

                    if( $current_number == 5 ) {
                        $first_line = '';
                    }
                ?>
                
            <?php $return_data .= '<li ' . $first_line . ' class="isotope-item  page-1 ' . $number_of_columns . '">'; ?> 
                    
                    <?php if( $number_of_columns == "four-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-4-column", $thumbnail_args); ?>
                    <?php elseif ( $number_of_columns == "three-column" ): ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-3-column", $thumbnail_args); ?>
                    <?php else: ?>
                        <?php $return_data .= get_the_post_thumbnail($post->ID, "portfolio-thumbnail-2-column", $thumbnail_args); ?>
                    <?php endif; ?>
                    
                    <?php $return_data .= '<div class="portfolio-responsive">' . get_the_post_thumbnail($post->ID, "portfolio-first-responsive", $thumbnail_args) . '</div>';
                    
                    $return_data .= '<h3>' . get_the_title() . '</h3>';
                    
                    $return_data .= '<div class="portfolio-hover">';
                    $return_data .= '<h3>';
                    $return_data .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    $return_data .= '</h3>';
                    $return_data .= '<p>';
                    ?>
                            <?php 
                                global $more;
                                $more = 0;
                                $return_data .= get_the_content(''); 
                            ?>
                        <?php $return_data .= '</p>';
                        $return_data .= '<a rel="lightbox" href="' . get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')) . '" class="enlarge"></a>';
                        $return_data .= '<a href="' . get_permalink() . '" class="open"></a>';
                    $return_data .= '</div>';
                    
               $return_data .= '</li>';
        endforeach; 
    $return_data .= '</ul>'; 
$return_data .= '</div><div class="main-wrapper clearfix">';
    


    return $return_data;

}

add_shortcode( 'projects_by_id', 'projects_by_id_func' );






function recent_project_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'link' => '',

                'alt' => '',

                'title' => '',

                'rel' => '',

                'project' => '',

	), $atts ) );



	return '<a rel="' . $rel . '" href="' . $link . '"><img src="' . $content . '" alt="' . $alt . '" title="' . $title . '" /><div class="magnifier"><div>' . $project . '<div></div></div></div></a>';

}

add_shortcode( 'recent_project', 'recent_project_func' );









function content_with_menu_wrapper_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

	return '<div class="content" id="content-with-menu"><div class="contentWrapperTop"></div>' . $content . '<div class="clear"></div></div>';

}

add_shortcode( 'content_with_menu_wrapper', 'content_with_menu_wrapper_func' );











function content_menu_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

	return '<ul class="content-menu">' . $content . '</ul>';

}



add_shortcode( 'content_menu', 'content_menu_func' );











function content_menu_item_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => '',

	), $atts ) );

        

        if ( $id == "selected-submenu" ) {

            return '<li id="' . $id . '">' . $content . '<div class="content-menu-over">Developing web</div><div class="content-menu-shadow-right"></div></li>';

        }

        else {

            return '<li>' . $content . '</li>';

        }

}



add_shortcode( 'content_menu_item', 'content_menu_item_func' );











function content_with_menu_wrapper_posts_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        

        $tab_posts = explode( ',', $content );

        

        

        $data = '<div class="content" id="content-with-menu"><div class="contentWrapperTop"></div><ul class="content-menu">';

        

        

        /*

         * 

         *  Get top menu

         * 

         */

        $index = 0;

        

        foreach ( $tab_posts as $post_id ) {

            

            $post = get_post( $post_id );  
            if(!isset($post)) $post->post_title='';
            $title = $post->post_title;

            

            

            if ( $index++ == 0 ) {

                $data .= '<li id="selected-submenu">' . $title . '<div class="content-menu-over">' . $title . '</div><div class="content-menu-shadow-right"></div></li>';

            }

            else {

                $data .= '<li>' . $title . '</li>';

            }

            

        }

        

        $data .= '</ul>';

        

        $index = 1;

        

        foreach ( $tab_posts as $post_id ) {

            

            $post = get_post( $post_id ); 
            $post = get_post( $post_id );  
            if(!isset($post)) { $post->post_title=''; $post->post_content='';}
            $post_title = $post->post_title;

            $post_content = $post->post_content;

            

            $post_content = do_shortcode( shortcode_unautop( $post_content ) );

                 if ( '</p>' == substr( $post_content, 0, 4 )

                 and '<p>' == substr( $post_content, strlen( $post_content ) - 3 ) )

                 $post_content = substr( $post_content, 4, strlen( $post_content ) - 7 );

            if($index==1){

                $data .= '<h2 id="selected-small-heading" class="small-menu-heading">' . $post_title . '</h2>';

            } else {

                $data .= '<h2 class="small-menu-heading">' . $post_title . '</h2>';

            }

            

            $data .= '<div id="menu-content-' . $index++ . '" style="display: block; ">';



            $data .= $post_content . '<br class="clear"></div>';

            

        }

        

	$data .= '<div class="clear"></div></div>';

        

        return $data;

        

}

add_shortcode( 'content_with_menu_wrapper_posts', 'content_with_menu_wrapper_posts_func' );










function full_content_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );
        
        return '<div class="content-full">' . $content . '</div>';

}



add_shortcode( 'full_content', 'full_content_func' );

















function content_half_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );
        
        if ( $id == "last" ) {

            return '<div class="content-half last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-half">' . $content . '</div>';

        }

}



add_shortcode( 'content_half', 'content_half_func' );







function content_third_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );

        if ( $id == "last" ) {

            return '<div class="content-third last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-third">' . $content . '</div>';

        }

}



add_shortcode( 'content_third', 'content_third_func' );





function content_two_third_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );

        if ( $id == "last" ) {

            return '<div class="content-two-third last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-two-third">' . $content . '</div>';

        }

}



add_shortcode( 'content_two_third', 'content_two_third_func' );



function content_quarter_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );

        if ( $id == "last" ) {

            return '<div class="content-quarter last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-quarter">' . $content . '</div>';

        }

}



add_shortcode( 'content_quarter', 'content_quarter_func' );





function content_two_quarter_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );

        if ( $id == "last" ) {

            return '<div class="content-two-quarter last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-two-quarter">' . $content . '</div>';

        }

}



add_shortcode( 'content_two_quarter', 'content_two_quarter_func' );



function content_three_quarter_func( $atts,  $content ) {

	extract( shortcode_atts( array(

		'id' => ''

	), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        if ( '</p>' == substr( $content, 0, 4 )
        and '<p>' == substr( $content, strlen( $content ) - 3 ) )
        $content = substr( $content, 4, strlen( $content ) - 7 );

        if ( $id == "last" ) {

            return '<div class="content-three-quarter last">' . $content . '</div><div class="clearfix"></div>';

        }

        else {

            return '<div class="content-three-quarter">' . $content . '</div>';

        }

}



add_shortcode( 'content_three_quarter', 'content_three_quarter_func' );











function button_func( $atts,  $content ) {

	extract( shortcode_atts( array(

            'link'      => '',
            'target'    => '',
            'size'      => 'small',
            
            'style'     => '',
            
            'font_color' => '#fff',
            'gradient_top' => '',
            'gradient_bottom' => ''

        ), $atts ) );
            
            if ( $target != '' ) {
                $target = ' target="' . $target . '"';
            }
            
            $style_attr = '';
            
            if( $style == '' ) {
                $style_attr = 'color: ' . $font_color . ' !important;
                               background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(' . $gradient_top . '), to' . $gradient_bottom . '));
                               background-image: -webkit-linear-gradient(top, ' . $gradient_top . ', ' . $gradient_bottom . ');
                               background-image: -moz-linear-gradient(top, ' . $gradient_top . ', ' . $gradient_bottom . ');
                               background-image: -ms-linear-gradient(top, ' . $gradient_top . ', ' . $gradient_bottom . ');
                               background-image: -o-linear-gradient(top, ' . $gradient_top . ', ' . $gradient_bottom . ');
filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=' . $gradient_top . ', endColorstr=' . $gradient_top . ');
-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=' . $gradient_top . ', endColorstr=' . $gradient_top . ')";';
            }
            
            return '<a' . $target . ' href="' . $link . '" style="' . $style_attr . '" class="button ' . $size . ' button-' . $style . '">' . $content . '</a>';

}



add_shortcode( 'button', 'button_func' );







function left_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );



            return '<div class="left">' . $content . '</div>';

}



add_shortcode( 'left', 'left_func' );



$google_maps_counter = 0;

function google_maps_func( $atts,  $content ) {

    
    global $google_maps_counter;
    $google_maps_counter++;
	extract( shortcode_atts( array(
                'height' => '500',
		'layout' => 'boxed',
                 'zoom' => '15'
        ), $atts ) );
        
        $before = "";
        $after = "";
        
        
        if( $layout == "full" ) {
             $before = "</div></div>";
             $after = "<div class=\"boxed\"><section><div class=\"main-wrapper clearfix\">";
        }

        return "<div class='map content'>

<script>

jQuery(document).ready(function( $ ) { 

$('#google-map$google_maps_counter').gmap3(

{ action:'init',

    options:{

        zoom: {$zoom}

    }

},

{

    action: 'getLatLng',

    address: '" . $content .  "',

    callback: function(result){

        $(this).gmap3(

        {

            action: 'setCenter', 

            args:[ result[0].geometry.location ]

        });

    } 

}, 

{

    action: 'addMarker',

    address: '" . $content .  "'

    

}

);    

});

</script>
{$before}
<div style='height:{$height}px' id='google-map$google_maps_counter'></div></div>
{$after}
";
}



add_shortcode( 'google_maps', 'google_maps_func' );

function vimeo_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );
    global $anpsPreURL;
        
    return '<div class="video-wrapper"><iframe src="' . $anpsPreURL . '://player.vimeo.com/video/' . $content . '?color=' . str_replace("#", "", get_option('primary_color', '#719400')) . '" frameborder="0" width="320" height="240"></iframe></div>';
}

add_shortcode( 'vimeo', 'vimeo_func' );


function youtube_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
    global $anpsPreURL;

    return '<div class="video-wrapper"><iframe src="' . $anpsPreURL . '://www.youtube.com/embed/' . $content . '?wmode=transparent" frameborder="0" width="560" height="315" wmode="Opaque"></iframe></div>';
}

add_shortcode( 'youtube', 'youtube_func' );


function dailymotion_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );
    global $anpsPreURL;

    return '<div class="video-wrapper"><iframe frameborder="0" width="480" height="270" src="' . $anpsPreURL . '://www.dailymotion.com/embed/video/' . $content . '&highlight=' . str_replace("#", "", get_option('primary_color', '#719400')) . '"></iframe><br /><a href="' . $anpsPreURL . '://www.dailymotion.com/video/x11mhko_lost-found_creation" target="_blank">Lost &amp; Found</a> <i>by <a href="' . $anpsPreURL . '://www.dailymotion.com/MiShorts" target="_blank">MiShorts</a></i></div>';
}

add_shortcode( 'dailymotion', 'dailymotion_func' );

function contact_func( $atts,  $content ) {

	extract( shortcode_atts( array(

                'success' => ''
	), $atts ) );

        global $wpdb;
        $return_data = '';
		
		$data = $wpdb->get_results("SELECT email FROM " . $wpdb->prefix . "envoo_account");
		
		$admin_mail = $data[0]->email;
		
        $data = $wpdb->get_results("SELECT label, form_type, required, placeholder, validation FROM " . $wpdb->prefix . "contact");

        $return_data .= '<form data-sucess="' . $success . '" class="contact-form">';
			
			$return_data .= '<input data-placeholder="' . $admin_mail . '" class="none" type="text" name="envoo-admin-mail" value="' . $admin_mail . '">';
			
			$element_num = 0;
			
	        foreach( $data as $element ) {
	            
				$element_num++;
				
				$return_data .= '<div class="form-element-wrap">';
				
				$placeholder_star = "";
				
				$required = '';
				
				if( $element->required == 'on' ) {
					$required = 'data-required="required"';
					$placeholder_star = "*";
				}
				
				$validation = $element->validation;				
				
				$type = "text";
				
				if ( $element->form_type == 'text' ) {
					$return_data .= '<input name="' . urlencode($element->placeholder) . '" '.  $required . ' id="form-element-' . $element_num . '" type="text" data-validation="' . $element->validation . '" placeholder="' . $element->placeholder . $placeholder_star . '" data-required="' . $element->required . '"" data-placeholder="' . $element->placeholder . $placeholder_star . '" />';
				} else {
					$return_data .= '<textarea name="' . urlencode($element->placeholder) . '" ' .  $required . ' id="form-element-' . $element_num . '" data-validation="' . $element->validation . '" placeholder="' . $element->placeholder . $placeholder_star . '" data-placeholder="' . $element->placeholder . $placeholder_star . '"></textarea>';
				}
				
				$return_data .= '</div>';
	        }
			$return_data .= '<div class="form-buttons">';
				$return_data .= '<input type="button" id="reset" value="'. __("Reset", "shopifiq") .'" />';
				$return_data .= '<input type="submit" value="'. __("Send", "shopifiq") .'" />';
			$return_data .= '</div>';
	        $return_data .= '</form>';

        return $return_data;

}



add_shortcode( 'contact', 'contact_func' );













function services_func( $atts,  $content ) {
    
    global $post;

	extract( shortcode_atts( array(), $atts ) );

	

	$return_data = '';

		

	$return_data .= '<div class="content" style="padding: 0"><div class="slider-arrow-left"></div><div class="slider-arrow-right"></div>   <div id="slider-wrapper"><div  id="slider"><ul class="slides">';

global $wpdb;

            $new_query = new WP_Query();

            $new_query->query( 'category_name=services&posts_per_page=99999' );



            //The Loop

            while ($new_query->have_posts()) : $new_query->the_post();

            $content = get_the_content();

        $return_data .= '<li><article><header><h3>' . get_the_title() . '</h3></header><figure>';

                        $link = get_the_content();  

                        

                        $min = strpos($link, '<span');

                        

                        $link = substr($link, 0, $min);

                        

                        $min = strpos($link, 'href="') + 6;

                        $max = strpos($link, '"', $min);

                        

                        

                        $cur = substr($link, $min, $max-$min);

                        

                        $link1 = substr($link, 0, $max + 1);

                        

                        $link2 = substr($link, $max + 2, strlen($link));

                        

                        #$attachment_ids = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date");

                        

                        $default_attr = array(

                                'class'	=> "services-photo-hover",

                        );

                        

                        

                        $attachments = get_posts( array(

                                'post_type' => 'attachment',

                                'posts_per_page' => -1,

                                'post_parent' => get_the_ID(),

                                'orderby' => 'id',

                                'order' => 'ASC'

                        ) );

                        

                        $att_id = 0;

                        foreach ( $attachments as $attachment ) {

                            if( get_post_thumbnail_id( $post->ID ) != $attachment->ID ) {

                                $att_id = $attachment->ID;

                            }

                        }

                        $link2 = str_replace($cur,'' . get_the_post_thumbnail($post->ID, 100, 64) . wp_get_attachment_image( $att_id, "portfolio", 0, $default_attr),$link2);
                            
                        $return_data = str_replace('0=""','',$return_data);
                        
                        $return_data .= $link1 . " " . $link2;

                        

                    

                    

                $return_data .= '</figure><p>';                   

                 

                     $content = str_replace($cur,"",$content);

                     $return_data .= $content; 
                     
                     $return_data = str_replace('<a href="" target="_blank"></a>','',$return_data);
                     
                $return_data .= '</p></article></li>';



        endwhile;

    $return_data .= '</ul>';

	wp_reset_query();

 $return_data .= '<div class="clear"></div></div></div></div>';





        return $return_data;

}



add_shortcode( 'services', 'services_func' );













function quote_func( $atts,  $content ) {

	extract( shortcode_atts( array( 'align' => 'right', ), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );


	return '<div class="quote-' . $align . '">' . $content . '</div>';

}

add_shortcode( 'quote', 'quote_func' );





function contact_info_func( $atts,  $content ) {

	extract( shortcode_atts( array( 'align' => '', ), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );

        if ( '</p>' == substr( $content, 0, 4 )

        and '<p>' == substr( $content, strlen( $content ) - 3 ) )

            $content = substr( $content, 4, strlen( $content ) - 7 );

			

	    global $wpdb;

        $data = $wpdb->get_results("SELECT id, icon, tekst FROM " . $wpdb->prefix . "envoo_contact_info");

		

		$margin = "right";

		

		if($align == "right") {

			$margin = "left";

		} else if( $align == "" ) {

			$margin = "";

			$align = "none";

		}
        
        if(empty($data))  {
            $data[0]->icon = '';
            $data[1]->icon = '';
            $data[2]->icon = '';
            $data[0]->tekst = '';
            $data[1]->tekst = '';
            $data[2]->tekst = '';
        }
                
	$return = '';	
                
	$return .= '<div style="float:' .  $align . '; 	margin-' .  $margin . ': 30px;" class="contact-info-wrapper"><table><tbody><tr>';

        $return .= '<td><div id="pin" style="background: url(' . $data[0]->icon . ');"></div></td>';

        $return .= '<td>' . nl2br($data[0]->tekst) . '

                    </td>

                </tr>

            

            <tr><td style="height: 17px"></td></tr>

            <tr><td>

                    <div id="phone" style="background: url(' . $data[1]->icon . ');"></div></td><td>' . nl2br($data[1]->tekst) . '</td></tr>

           <tr><td><div id="mail" style="background: url(' . $data[2]->icon . ');"></div></td><td>' . nl2br($data[2]->tekst) . '</td></tr></tbody></table></div>';

		
	return '<div class="contact-info-' . $align . '">' . $return . '</div>';

}



add_shortcode( 'contact_info', 'contact_info_func' );













function add_shortcode_func( $atts,  $content ) {

	extract( shortcode_atts( array(), $atts ) );
        
        global $wpdb;

        $data_blocks = $wpdb->get_results("SELECT id, title, url, icon, hover_icon FROM " . $wpdb->prefix . "envoo_blocks");

        $data_shortcode = $data_blocks[1]->title;

        
        $data_shortcode = do_shortcode( shortcode_unautop( $data_shortcode ) );

        
        
        
        
        
        return $data_shortcode; 

}

add_shortcode( 'add_shortcode', 'add_shortcode_func' );



function progress_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'percentage' => '100'
	), $atts ) );
        
	return  '<div class="progress-wrapper"><div class="progress" style="width: ' . $percentage . '%">' . $content . ' / ' . $percentage . '%</div></div>';
}
add_shortcode( 'progress', 'progress_func' );



function person_func( $atts,  $content ) {
    extract( shortcode_atts( array(
              'name'      => 'John Doe',
                'picture'   => '',
                'title'     => 'Title',
                'facebook'  => '',
                'twitter'    => '',
                'linkedin'  => '',
                'google' => '',
                'instagram' => ''
    ), $atts ) );
        
        $data_return = "<article class='person'>";
        $data_return .= '<header><img class="clearfix" src="' . $picture . '">';
        $data_return .= '<div class="person-social">';
    
        if ( $twitter ) {
            $data_return .= '<a class="twitter" href="' . $twitter . '"></a>';
        }
        if( $facebook ) {
            $data_return .= '<a class="facebook" href="' . $facebook . '"></a>';
        }
        if ( $google ) {
            $data_return .= '<a class="google" href="' . $google . '"></a>';
        }
        if ( $linkedin ) {
            $data_return .= '<a class="linkedin" href="' . $linkedin . '"></a>';
        }

        $data_return .= '</div>';
        $data_return .= '</header>';
        $data_return .= '<h2>' . $name . ' / </h2>';
        $data_return .= '<h3>' . $title . '</h3>';
        $data_return .= '<p>' . $content . '</p>';
        $data_return .= '</article>';
        
    return  $data_return;
}
add_shortcode( 'person', 'person_func' );




function list_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'type' => 'default'
            ), $atts ) );
	
        $tags = 'ul';
        
        if ( $type == 'number' ) {
            $tags = 'ol';
        }
        
	return '<' . $tags . ' class="list-' . $type . '">' . do_shortcode( shortcode_unautop( $content ) ) . '</' . $tags . '>';
}
add_shortcode( 'list', 'list_func' );



function list_item_func( $atts,  $content ) {
	extract( shortcode_atts( array(
	), $atts ) );
        
	return '<li>' . $content . '</li>';
}
add_shortcode( 'list_item', 'list_item_func' );


function statement_box_func( $atts,  $content ) {
	extract( shortcode_atts( array(
		'title'   => 'Title',
                'button'  => 'Click here',
                'link'    => ''
            ), $atts ) );
        
	return '<div class="box statement-box">
                    <div class="statement-box-left">
                        <h2>' . $title . '</h2>
                        <p>' . $content . '</p>
                    </div>
                    <div class="statement-box-right">
                        <a href="' . $link . '">
                            <form action="' . $link . '"><button>' . $button . '</button></a></form>
                        </a>
                    </div>
              </div>';
}
add_shortcode( 'statement_box', 'statement_box_func' );


$number_of_logos = 0;

function logo_box_func( $atts,  $content ) {
	extract( shortcode_atts( array(
	), $atts ) );
        
        
        $content = do_shortcode( shortcode_unautop( $content ) );
        
        global $number_of_logos;
        
        $type = "more";
        
        switch ( $number_of_logos ) {
            case 1: $type = 'one'; break;
            case 2: $type = 'two'; break;
            case 3: $type = 'three'; break;
        }
        
        $number_of_logos = 0;
        
	return '<div class="box logo-box logo-box-' . $type . '">' . $content . '</div></div>';
}
add_shortcode( 'logo_box', 'logo_box_func' );



function logo_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'link' => ''
	), $atts ) );
        
        
        global $number_of_logos;
        
        $number_of_logos++;
        
        $return_data  = '';
        
        if( $number_of_logos == 1 ) {
            $return_data  = '<div class="logo-box-row">';
        } else if ( $number_of_logos %5 == 0 ) {
            $return_data  = '</div><div class="logo-box-row">';
        }
        
	return $return_data . '<div class="logo"><a target="_blank" href="' . $link . '"><img src="' .  $content . '" /></a></div>';
}
add_shortcode( 'logo', 'logo_func' );



function alert_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'type' => 'general'
	), $atts ) );
        
	return '<div class="alert ' . $type . '">' .  $content . '<span class="alert-close"></span></div>';
}
add_shortcode( 'alert', 'alert_func' );


$accordion_counter = 0;

function accordion_func( $atts,  $content ) {
    extract( shortcode_atts( array('closed' => 'false'), $atts ) );
        
        global $accordion_counter;
        
        $accordion_counter = 0;

        $closed_class = "";
        if ( $closed == "true" ) {
            $closed_class = " accordion-closed";
        }
        
    return '<div class="accordion' . $closed_class . '">' .  do_shortcode( shortcode_unautop( $content ) ) . '</div>';
}
add_shortcode( 'accordion', 'accordion_func' );

function accordion_item_func( $atts,  $content ) {
    extract( shortcode_atts( array(
            'title' => 'Title'
    ), $atts ) );
        
        global $accordion_counter;
        
        $accordion_counter++;
        return '<div class="accordion-item accordion-item-' . $accordion_counter . '">
                    <h3 data-accordion-counter="' . $accordion_counter . '" class="accordion-h3 accordion-title-' . $accordion_counter . '">' . $title . '</h3>
                    <div class="accordion-item-content">' .  do_shortcode($content) . '</div>
                </div>';
}
add_shortcode( 'accordion_item', 'accordion_item_func' );





function testimonial_func( $atts,  $content ) {

	extract( shortcode_atts( array( 'name' => 'John Doe', ), $atts ) );


	return '<div class="testimonial"><p>' . $content . '</p><span>' . $name . '</span></div>';

}

add_shortcode( 'testimonial', 'testimonial_func' );


$pricing_table_counter = 0;

function pricing_table_func( $atts,  $content ) {

	extract( shortcode_atts( array( 
                                        'name' => 'John Doe', 
                                ), $atts ) );
        $content = do_shortcode( shortcode_unautop( $content ) );
        
        global $pricing_table_counter;
        
        $content = '<div class="clearfix pricing-table pricing-columns-' . $pricing_table_counter . '">' . $content . '</div>';
        $pricing_table_counter = 0;
        
	return $content;

}

add_shortcode( 'pricing_table', 'pricing_table_func' );



function pricing_column_func( $atts,  $content ) {

	extract( shortcode_atts( array( 
                                        'title' => 'Price number 1',
                                ), $atts ) );
        global $pricing_table_counter;
        $pricing_table_counter++;
	return '<div class="pricing-table-column"><div class="pricing-table-title">' . $title . '</div>' . do_shortcode( shortcode_unautop( $content ) ) . "<div class='pricing-table-column-before'></div></div>";
}

add_shortcode( 'pricing_column', 'pricing_column_func' );




function pricing_price_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'currency' => '&#8364;',
			'decimal'  => '00'
        ), $atts ) );
    
    if ( get_option('rtl', '') && get_option('rtl', '') == "on" ) {
        return '<div class="pricing-table-price"><span class="decimal">' . $decimal . '</span><span class="price">,' . $content . '</span><span class="currency1">' . $currency . '</span></div>'; 
    } else {
        return '<div class="pricing-table-price"><span class="price"><span class="currency">' . $currency . '</span>' . $content . ',</span><span class="decimal">' . $decimal . '</span></div>'; 
    }

}

add_shortcode( 'pricing_price', 'pricing_price_func' );




function pricing_row_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
        
	return '<div class="pricing-table-row">' . $content . "</div>";
}

add_shortcode( 'pricing_row', 'pricing_row_func' );



function pricing_footer_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'link' => ''
        ), $atts ) );
        
	return '<div class="pricing-table-footer"><a href="' . $link . '">' . $content . "</a></div>";
}

add_shortcode( 'pricing_footer', 'pricing_footer_func' );



function slider_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
        
	return '<div class="slider-short">' . do_shortcode( shortcode_unautop( $content ) ) . '
	<div class="slider-short-controls">
            <a class="slider-short-left-control"></a>
            <a class="slider-short-right-control"></a>
    </div>
	</div>';
}

add_shortcode( 'slider', 'slider_func' );


function slide_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'link' => '',
			'target' => ''
        ), $atts ) );
        
		if ( $target != '' ) {
			$target = 'target="' . $target . '"';
		}
		
	return '<a class="slide" ' . $target . ' href="' . $link . '"><img src="' . do_shortcode( shortcode_unautop( $content ) ) . '" /></a>';
}

add_shortcode( 'slide', 'slide_func' );


function icon_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'link'    => '',
			'target'  => '',
			'icon_url' => '',
			'title'   => 'Title',
			'wrapper' => 'none'
        ), $atts ) );
        
		if ( $target != '' ) {
			$target = 'target="' . $target . '"';
		}
		
	$return_data = "";
	
	if( $wrapper == "default" ) {
		$return_data = '
						<span class="icon-over"></span>
						<span class="icon-hover"></span>
						<span class="icon-image" style="background: url(' . $icon_url . ') center no-repeat"></span>';
	}
	
	if( $wrapper == "circle" ) {
		$return_data = '
						<span class="icon-over"></span>
						<span class="icon-hover"></span>
						<span class="icon-image" style="background: url(' . $icon_url . ') center no-repeat"></span>';
	}
	
	if( $wrapper == "square" ) {
		$return_data = '
						<span class="icon-over"></span>
						<span class="icon-hover"></span>
						<span class="icon-image" style="background: url(' . $icon_url . ') center no-repeat"></span>';
	}
	
	if( $wrapper == "diamond" ) {
		$return_data = '
						<span class="icon-over"></span>
						<span class="icon-hover"></span>
						<span class="icon-image" style="background: url(' . $icon_url . ') center no-repeat"></span>';
	}
	
	if( $wrapper == "none" ) {
		$return_data = '<img src="' . $icon_url . '" />';
	}
	
	return  '<a ' . $target . ' href="' . $link . '" class="icon">
				<span class="wrapper ' . $wrapper . '">
					' . $return_data . '
				</span>
				<h3>' . $title . '</h3>
				<p>' . $content . '</p>
			</a>';
}

add_shortcode( 'icon', 'icon_func' );




function tabs_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'tab1' => '',
			'tab2' => '',
			'tab3' => ''
        ), $atts ) );
		
		
		if( $tab1 != '' ) {
			$tab1 = '<li class="selected-tab-menu">'. $tab1 . '<div class="tab-over">' . $tab1 . '</div></li>';
		}
		
		if( $tab2 != '' ) {
			$tab2 = '<li>'. $tab2  . '<div class="tab-over">' . $tab2 . '</div></li>';
		}
		
		if( $tab3 != '' ) {
			$tab3 = '<li>'. $tab3  . '<div class="tab-over">' . $tab3 . '</div></li>';
		}
		
	return '<div class="tabs">
			<ul class="tabs-menu clearfix">
				'. $tab1 .'
				'. $tab2 .'
				'. $tab3 .'
			</ul>
			<div class="tabs-wrapper">' . do_shortcode($content) . '</div></div>';
}

add_shortcode( 'tabs', 'tabs_func' );



function tab_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	$content = str_replace('&nbsp;', '<p class="blank-line clearfix"><br /></p>', $content);
		
	return '<div class="tab">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'tab', 'tab_func' );







function recent_posts_func( $atts,  $content ) {

	$query = new WP_Query();
	$query->query( 'posts_per_page=' . $content . '&paged='.$paged.'&post_type=post' );
	
	$return_data = '';
	
	global $more;
	$more = 0;
	
	while ($query->have_posts()) : $query->the_post(); ?>
		<?php $return_data .= '<article class="latest-post">'; ?>
			<?php 
				$number_of_chars = 100;
				$class = "";		
			?>
			
			
        	<?php if ( strpos(get_post_field('post_content', get_the_ID()), "[vimeo]") > -1 ): ?>
	            <?php
	                $check_if_text_only = false;
	                $content = get_post_field('post_content', get_the_ID());
	                $start = strpos($content, "[vimeo]");
	                $end = strpos($content, "[/vimeo]");
	                $class = "video";  
	                $return_data .= do_shortcode(substr($content, $start, $end - $start + 8));
	            ?>
        	<?php elseif ( strpos(get_post_field('post_content', get_the_ID()), "[youtube]") > -1 ): ?>
	            <?php
	                $check_if_text_only = false;
	                $content = get_post_field('post_content', get_the_ID());
	                $start = strpos($content, "[youtube]");
	                $end = strpos($content, "[/youtube]");
	                $class = "video"; 
	                $return_data .= do_shortcode(substr($content, $start, $end - $start + 10));
	            ?>
            <?php elseif ( get_the_post_thumbnail($post->ID, 'portfolio-thumbnail-4-column') == "" ): ?>
                    <?php 
                    	$number_of_chars = 420; 
						$class = "no-image";
                    ?>
            <?php else: ?>
            		<?php $return_data .= '<a class="normal" href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'portfolio-thumbnail-4-column') . '</a>';  ?>
            		<?php $return_data .= '<a class="responsive" href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'portfolio-first-responsive') . '</a>';  ?>
			<?php endif; ?>			
			
			<?php $return_data .= '<a href="' . get_permalink() . '"><h4 class="'.  $class . '">' . get_the_title() . '</h4></a>'; ?>
			<?php $return_data .= '<span class="subheading">posted by <strong>' . get_the_author() . '</strong> / ' . get_the_date('d.m.Y') . '</span>'; ?>
			<?php $return_data .= '<p>' . mb_substr(strip_tags(get_the_content('')), 0, $number_of_chars)  . '</p>'; ?>
			<?php $return_data .= '<span class="read-more"><img alt="Readmore arrow" src="' . get_stylesheet_directory_uri() . '/images/arrow_right.png" class="breadcrumbs-arrow" /><a href="' . get_permalink() . '">Read more</a></span>'; ?>                        
		<?php $return_data .= '</article>'; ?>
	<?php endwhile;

    return $return_data;

}

add_shortcode( 'recent_posts', 'recent_posts_func' );



function error_title_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h1 class="error_title">' . $content . '</h1>';
}

add_shortcode( 'error_title', 'error_title_func' );


function error_sub_title_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h3 class="error_sub_title">' . $content . '</h3>';
}

add_shortcode( 'error_sub_title', 'error_sub_title_func' );



function error_text_large_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h4 class="error_text_large">' . $content . '</h4>';
}

add_shortcode( 'error_text_large', 'error_text_large_func' );


function error_text_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '<h5 class="error_text">' . $content . '</h5>';
}

add_shortcode( 'error_text', 'error_text_func' );



$photostreams = 0;

function photostream_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'limit' => '8',
			'title' => 'Photostream',
			'social_network' => 'dribbble'
        ), $atts ) );
        
		global $photostreams;
		
		$root = get_stylesheet_directory_uri() . "/admin-functions/photostream/";

        wp_register_script( 'bra_photostream', $root."bra_photostream_widget.js", array('jquery'), '1.3', true );
        wp_enqueue_script( 'bra_photostream' );
        
        wp_register_style( 'bra_photostream', $root."bra_photostream_widget.css");
        wp_enqueue_style( 'bra_photostream' );

        
        $hover_color = '#ffffff';
	
		 $user = $content;
        
	    $unique_id =  $user . $social_network . $limit . $photostreams ;
	    $html = '<div class="photostream clearfix" id="' . $unique_id . $photostreams  .'"></div>';
	    $html .= '<script type="text/javascript"> jQuery(document).ready(function($){ ';
	    $html .= '$("#' . $unique_id  . $photostreams .'").bra_photostream({user: "' . $content . '", limit:' . $limit . ', social_network: "' . $social_network . '"});';
	    $html .= '});</script>';
		
		$photostreams++;
		
		return "<h4>" . $title . "</h4>" . $html;
}

add_shortcode( 'photostream', 'photostream_func' );






function image_links_func( $atts,  $content ) {
	extract( shortcode_atts( array(), $atts ) );
		
	return '</div><div class="main-wrapper portfolio-wrapper recent-projects "><ul class="portfolio clearfix image_links">' . do_shortcode($content) . '</ul></div><div>';
}

add_shortcode( 'image_links', 'image_links_func' );



function image_link_func( $atts,  $content ) {
	extract( shortcode_atts( array(
            'title' => 'Title',
			'url' => '',
			'target' => '_blank',
			'image_url' => ''
        ), $atts ) );
		$val = '<img src="' . $image_url . '">
				<div class="portfolio-responsive"><img src="' . $image_url . '" class="attachment-portfolio-first-responsive wp-post-image" alt="" title=""></div>
				<div class="portfolio-hover">
					<h3><a target="' . $target. '" href="' . $url . '">
					' . $title . '
					</a></h3>
					
					<p>' . $content. '</p>
					<a target="' . $target. '" href="' . $url . '" class="open"></a></div>';
		return '<li class="isotope-item  page-1 four-column">' . $val . '<h3>' . $title . '</h3></li>';
}

add_shortcode( 'image_link', 'image_link_func' );

function search_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );

    return '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '"><div>' . 
                '<input type="text" value="fsaafsa" name="s" id="s" placeholder="' . __("Search...", "shopifiq") . '" />' .
                '<input type="submit" id="searchsubmit" value="">' .
            '</div></form>';
}

add_shortcode( 'search', 'search_func' );


function img_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        "align" => ""
    ), $atts ) );

    $class="";

    if( $align != "" ) {
        $class = $align;
    }

    return "<img class='$class' src='" . $content . "' />";
}

add_shortcode( 'img', 'img_func' );

function mega_product_func( $atts,  $content ) {
    extract( shortcode_atts( array(), $atts ) );

    $args = array( 'post_type' => 'product', "p" => $content );
    $loop = new WP_Query( $args );
    $return = "";

    ob_start();

    while ( $loop->have_posts() ) : $loop->the_post();

        woocommerce_get_template( 'loop/price.php' );

        echo '<a href="' . get_permalink($content) . '">' . get_the_post_thumbnail($content, "full") . '</a>';

    endwhile; wp_reset_query();

    return ob_get_clean();
}

add_shortcode( 'mega_product', 'mega_product_func' );


function featured_products_slider_func( $atts,  $content ) {
    extract( shortcode_atts( array(
        'num' => 4
    ), $atts ) );

    $return = '';

    $first_product_title = "";
    $first_product_excerpt = "";

    function get_the_popular_excerpt(){
        $excerpt = get_the_content();
        $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, 190);
        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
        $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
        $excerpt = $excerpt.'. <a href="'.get_permalink().'">' . __('view product', 'shopifiq') . '</a>';

        return $excerpt;
    }

    $post = new WP_Query(array(
        'post_status' => 'publish',
        'post_type' => 'product',
        'meta_key' => '_featured',
        'meta_value' => 'yes',
        'posts_per_page' => $num
    ));

    $return .= '<div class="featured-slider-outer box clearfix"><div class="featured-slider-inner">';
        $return .= '<ul class="products featured-slider">';
        $selected_class = " selected";

        if ($post ->have_posts()) : while ($post ->have_posts()) : $post ->the_post();

            global $product;

            if( $selected_class != "" ) {
                $first_product_title = get_the_title();
                $first_product_excerpt = get_the_popular_excerpt();
            }

            $return .= '<li class="product' . $selected_class . '">';

                $return .= get_the_post_thumbnail($post->ID, "blog-two-column");

                if ($price_html = $product->get_price_html()) :
                    $return .= '<span class="price">';
                        $return .= $price_html;
                    $return .= '</span>';
                endif;

                $return .= "<div class='none'>";
                    $return .= "<h3 id='infos-title'>" . get_the_title() . "</h3>";
                    $return .=  "<div id='infos-excerpt'>" . get_the_popular_excerpt() . "</div>";
                $return .= "</div>";
            $return .= '</li>';

            $selected_class = "";

        endwhile;

        $return .= '</ul>';
    $return .= '</div>';

    $return .= '<div class="featured-slider-right">';
        $return .= '<button class="btn-left"></button><button class="btn-right"></button><h2>' . $first_product_title . '</h2>';
        $return .= '<div class="description">' . $first_product_excerpt . '</div>';
    $return .= '</div>';

    $return .= '</div>';

    else:
        $return = __("No featured products found!", "shopifiq");
    endif;

    return $return;
}

add_shortcode( 'featured_products_slider', 'featured_products_slider_func' );

/* Register oEmbed provider
   -------------------------------------------------------------------------- */

wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);


if (  ! in_array( 'jetpack/jetpack.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

/**
 * SoundCloud shortcode handler
 * @param  {string|array}  $atts     The attributes passed to the shortcode like [soundcloud attr1="value" /].
 *                                   Is an empty string when no arguments are given.
 * @param  {string}        $content  The content between non-self closing [soundcloud]…[/soundcloud] tags.
 * @return {string}                  Widget embed code HTML
 */
function soundcloud_shortcode($atts, $content = null) {

  // Custom shortcode options
  $shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());

  // Turn shortcode option "param" (param=value&param2=value) into array
  $shortcode_params = array();
  if (isset($shortcode_options['params'])) {
    parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
  }
  $shortcode_options['params'] = $shortcode_params;

  // User preference options
  $plugin_options = array_filter(array(
        'iframe' => soundcloud_get_option('player_iframe', 'true'),
        'width'  => soundcloud_get_option('player_width'),
        'height' =>  soundcloud_url_has_tracklist($shortcode_options['url']) ? soundcloud_get_option('player_height_multi') : soundcloud_get_option('player_height'),
        'params' => array_filter(array(
        'auto_play'     => soundcloud_get_option('auto_play'),
        'show_comments' => soundcloud_get_option('show_comments'),
        'color'         => str_replace("#", "", get_option('primary_color', '#719400')),
    )),
  ));
  // Needs to be an array
  if (!isset($plugin_options['params'])) { $plugin_options['params'] = array(); }

  // plugin options < shortcode options
  $options = array_merge(
    $plugin_options,
    $shortcode_options
  );

  // plugin params < shortcode params
  $options['params'] = array_merge(
    $plugin_options['params'],
    $shortcode_options['params']
  );

  // The "url" option is required
  if (!isset($options['url'])) {
    return '';
  } else {
    $options['url'] = trim($options['url']);
  }

  // Both "width" and "height" need to be integers
  if (isset($options['width']) && !preg_match('/^\d+$/', $options['width'])) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
  }
  if (isset($options['height']) && !preg_match('/^\d+$/', $options['height'])) { unset($options['height']); }

  // The "iframe" option must be true to load the iframe widget
  $iframe = soundcloud_booleanize($options['iframe'])
    // Default to flash widget for permalink urls (e.g. http://soundcloud.com/{username})
    // because HTML5 widget doesn’t support those yet
    ? preg_match('/api.soundcloud.com/i', $options['url'])
    : false;

  // Return html embed code
  if ($iframe) {
    return soundcloud_iframe_widget($options);
  } else {
    return soundcloud_flash_widget($options);
  }

}

/**
 * Plugin options getter
 * @param  {string|array}  $option   Option name
 * @param  {mixed}         $default  Default value
 * @return {mixed}                   Option value
 */
function soundcloud_get_option($option, $default = false) {
  $value = get_option('soundcloud_' . $option);
  return $value === '' ? $default : $value;
}

/**
 * Booleanize a value
 * @param  {boolean|string}  $value
 * @return {boolean}
 */
function soundcloud_booleanize($value) {
  return is_bool($value) ? $value : $value === 'true' ? true : false;
}

/**
 * Decide if a url has a tracklist
 * @param  {string}   $url
 * @return {boolean}
 */
function soundcloud_url_has_tracklist($url) {
  return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

/**
 * Parameterize url
 * @param  {array}  $match  Matched regex
 * @return {string}          Parameterized url
 */
function soundcloud_oembed_params_callback($match) {
  global $soundcloud_oembed_params;

  // Convert URL to array
  $url = parse_url(urldecode($match[1]));
  // Convert URL query to array
  parse_str($url['query'], $query_array);
  // Build new query string
  $query = http_build_query(array_merge($query_array, $soundcloud_oembed_params));

  return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
}

/**
 * Iframe widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Iframe embed code
 */
function soundcloud_iframe_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://w.soundcloud.com/player?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (soundcloud_url_has_tracklist($options['url']) ? '450' : '166');

  return sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
}

/**
 * Legacy Flash widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Flash embed code
 */
function soundcloud_flash_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (soundcloud_url_has_tracklist($options['url']) ? '255' : '81');

  return preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object>', $width, $height, $url, $width, $height, $url));
}



/* Settings
   -------------------------------------------------------------------------- */

/* Add settings link on plugin page */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), 'soundcloud_settings_link');

function soundcloud_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=soundcloud-shortcode">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

function register_soundcloud_settings() {
  register_setting('soundcloud-settings', 'soundcloud_player_height');
  register_setting('soundcloud-settings', 'soundcloud_player_height_multi');
  register_setting('soundcloud-settings', 'soundcloud_player_width ');
  register_setting('soundcloud-settings', 'soundcloud_player_iframe');
  register_setting('soundcloud-settings', 'soundcloud_auto_play');
  register_setting('soundcloud-settings', 'soundcloud_show_comments');
  register_setting('soundcloud-settings', 'soundcloud_color');
  register_setting('soundcloud-settings', 'soundcloud_theme_color');
}

}

/* Register SoundCloud shortcode
   -------------------------------------------------------------------------- */
add_shortcode("soundcloud", "soundcloud_shortcode");