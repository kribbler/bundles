<?php

include_once( 'widgets/layered-nav.php' );

/**
 * Registers the widgets 
 */
function woocommerce_seo_register_widgets(){
    register_widget( 'Woocommerce_Seo_Layered_Nav_Widget' );
}

/**
 * Similar to woocommerce_layered_nav_init to populate _attributes_array
 *
 * @global array $_chosen_attributes
 * @global type $woocommerce
 * @global type $_attributes_array 
 */
function woocommerce_seo_layered_nav_init(){
    
    global $_chosen_attributes, $woocommerce, $_attributes_array;

    $_chosen_attributes = $_attributes_array = array();

    $attribute_taxonomies = $woocommerce->get_attribute_taxonomies(); 
    if ( $attribute_taxonomies ) {
            foreach ( $attribute_taxonomies as $tax ) {

                $attribute = sanitize_title( $tax->attribute_name );
                $taxonomy = $woocommerce->attribute_taxonomy_name( $attribute ); 

                // create an array of product attribute taxonomies
                $_attributes_array[] = $taxonomy;                        

            }
    }

/*
    if( function_exists( 'woocommerce_layered_nav_query' ) ){
        add_filter('loop_shop_post_in', 'woocommerce_layered_nav_query');   
    } else { //woocommerce_layered_nav_query moved inside WC_Query class in Woocommerce 2.1
        $wc_query = new WC_Query();
        add_filter('loop_shop_post_in', array( $wc_query, 'layered_nav_query' ) );
    }
*/
    add_filter('loop_shop_post_in', 'woocommerce_layered_nav_query');
    
}


/**
 * Populates _chosen_attributes when filter selected in widget
 * Woocommerce has these variables in $_GET but since we don't, we have to hook into request to see what there and then populate chosen_attributes for use in query
 * (Wordpress has matched the URL with the corresponding ugly URL as populates the $_GET parmas here)
 * 
 * @global array $_chosen_attributes Woocommerce chosen attributes array
 * @param array $request Wordpress request variable
 * @return array 
 */
function woocommerce_seo_set_chosen_attributes( $request ){ 
    global $_chosen_attributes, $_attributes_array;
    //var_dump($_chosen_attributes);
    if( $_attributes_array ){
        foreach ( $_attributes_array as $attribute ){

            $name = str_replace( 'pa_', 'filter_', $attribute );

            if( array_key_exists( $name, $request ) ){ 
                $term_ids = explode( ",", $request[$name] );
                $_chosen_attributes[$attribute]['terms'] = $term_ids;
                $_chosen_attributes[$attribute]['query_type'] = 'and'; //always AND query
            }

        }
    }
    
    return $request;
}


/**
 * Appends Woocommerce SEO rewrite rules array to wordpress rewrite rules
 * 1.1 Added product rewrite rules if prodyct base removed
 * 
 * @param array $rules Current Wordpress rewrite rules
 * @return array 
 */
function woocommerce_seo_add_to_rules_array( $rules ){
    //category/filters rules
    $custom_rules = get_option( 'woocommerce_seo_rewrite_rules' );
    if( $custom_rules ){
        $custom_rules = (array) json_decode( $custom_rules ); 
        $rules =  $custom_rules + $rules;
    }
    
    return $rules;
}


/**
 * Add query vars for chosen attributes for Woocommerce product filtering
 * 
 * @param array $query_vars Wordpress query vars array
 * @return array 
 */
function woocommerce_seo_add_query_vars( $query_vars ) {
    global $_attributes_array;
    if( $_attributes_array ){
        foreach( $_attributes_array as $attribute ){
            $query_vars[] = str_replace( 'pa_', 'filter_', $attribute );
        }
    }
    return $query_vars;
}    

/**
 * Add rewrite rules to Woocommerce SEO rules arrays and returns seo freindly URL
 * 
 * @param string $link_terms The chosen taonomies/terms to use to make the url and rewrite rule
 * @param string $base_link  The base url to use
 */
function woocommerce_seo_add_rewrite_rules( $link_terms, $base_link){

    //if base_link if empty (products on homepage), use product_archive base
    if($base_link == "") $base_link = str_replace( home_url(), "", get_post_type_archive_link('product') );

    $product_cat = get_query_var( 'product_cat' );  
    $rewrite_url = ($product_cat != '') ? "index.php?product_cat=$product_cat" : "index.php?post_type=product" ;
   
    //create url
    $link = trailingslashit( $base_link );
    
    ksort( $link_terms ); //sort taxonomies alphabetically
    $rewrite_url_filter = "";
    $filters_link = "";
    foreach( $link_terms as $taxonomy_name => $taxonomy_terms ){
        if( !empty( $taxonomy_terms ) ){ 
            asort( $taxonomy_terms ); //sort terms in this taxonomy alphabetically
            $rewrite_url_filter .= "&".str_replace( "pa_", "filter_", $taxonomy_name )."=";
            foreach( $taxonomy_terms as $term_id => $term_slug ){
                $filters_link .= "/".$term_slug;
                $rewrite_url_filter .= $term_id.",";
            }
            $rewrite_url_filter = rtrim( $rewrite_url_filter, "," );
        }
    }
    $link .= ltrim($filters_link, "/");
    
	
    $rewrite_url .= $rewrite_url_filter; 
    $rewrite_rule = ltrim($link, "/"); 
  //die();
    //if (!is_admin())
    //    return $link;
    return $link;
    
    //add the url if it doesnt already exist
    $rules = get_option( 'woocommerce_seo_rewrite_rules' ); 
    $rules = (array)json_decode( $rules );

    $rewrite_rule_paged = $rewrite_rule."/page/?([0-9]{1,})/?$";
    $rewrite_url_paged = $rewrite_url."&paged=\$matches[1]";
    $rewrite_rule .= "/?$";
    
    if( !array_key_exists( $rewrite_rule, $rules ) ){
        $rules[$rewrite_rule] = $rewrite_url;
        $rules[$rewrite_rule_paged] = $rewrite_url_paged;
        update_option( 'woocommerce_seo_rewrite_rules', json_encode( $rules ) );
        update_option( 'woocommerce_seo_flush_rules', 1 );

    }
    
    return $link;

}


?>
