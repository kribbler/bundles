<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post;

if ( ! $post->post_excerpt && ! $post->post_content) return;
?>

    <div itemprop="description" class="gbtr_product_description">
    	<?php if (!$post->post_excerpt){
    		//echo apply_filters( 'woocommerce_short_description', $post->post_content ) ;
    	} else {	
        	//echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
        }?>
    </div>
