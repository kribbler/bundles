<?php
/**
 * Creates shortcode for related posts
 * @author Elio Rivero
 * @since 1.0.0
 */
class ILCPSShortcode {

	static $instance = 0;
	static $pagehtml = '';
	static $version;
	static $prefix = 'ilc_ps';
	
	function __construct($args = array()) {
		$defaults = array(
			'basefile' => ''
		);
		$args = wp_parse_args($args, $defaults);
		self::$version = $args['version'];
		
		add_action( 'init', array(&$this, 'init') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue') );
		add_action( 'wp_footer', array(&$this, 'styling'), 77);
	}
	
	/**
	 * Initialization function
	 */
	function init() {
		add_shortcode('products_carousel', array(&$this, 'shortcode'));
	}
	
	/**
	 * Add shortcode to WP
	 * @param $atts Array shortcode attributes
	 * @return String
	 * @since 1.0.0
	 */
	static function shortcode($atts) {
		global $post, $ilc_ps;
		wp_enqueue_style(self::$prefix.'-css');
		wp_enqueue_script(self::$prefix.'-carousel');
		wp_enqueue_script(self::$prefix.'-js');
		extract(shortcode_atts(array(
			'product_cat' 	=> $ilc_ps->get('product_cat'),
			'numberposts'	=> $ilc_ps->get('numberposts_int'),
			'image_size'	=> $ilc_ps->get('featimg'),
			'price'			=> $ilc_ps->get('price_chk'),
			'quantity'		=> $ilc_ps->get('quantity_chk'),
			'add_to_cart'	=> $ilc_ps->get('add_to_cart_chk'),
			'featured_only'	=> $ilc_ps->get('featured_chk'),
			'carousel'		=> $ilc_ps->get('makecarousel_chk'),
			'auto' 			=> $ilc_ps->get('auto_chk'),
			'minimum'		=> $ilc_ps->get('minimum_int'),
			'items_min'		=> $ilc_ps->get('min_int'),
			'items_max'		=> $ilc_ps->get('max_int'),
			'items_scroll'	=> $ilc_ps->get('nscroll_int'),
			'timeout'		=> $ilc_ps->get('timeout_int'),
			'items_width'	=> $ilc_ps->get('itemwidth_int'),
			'pager'			=> $ilc_ps->get('pager_chk'),
			'class' 		=> ''
		), $atts));
		
		$product_query_args = array(
			'post_type' => 'product',
			'posts_per_page' => $numberposts,
			'post__not_in' => array($post->ID)
		);
		if( 'featured' == $product_cat ){
			$product_query_args = array_merge(
				$product_query_args,
				array('meta_query' => array(
					array(
						'key' => '_featured',
						'value' => 'yes',
						)
					)
				)
			);
		} else {
			$product_query_args = array_merge(
				$product_query_args,
				array('tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => explode(',', str_replace(' ', '', $product_cat))
						)
					)
				)
			);
		}
		// Query posts using the terms
		$posts = get_posts( $product_query_args );
		
		// Title attribute arguments
		$targs = array(
			'before' => '',
			'after' => '',
			'echo' => 0
		);
		
		/** Get user agent @var String */
		$ua = $_SERVER['HTTP_USER_AGENT'];
		
		// Prepare classes depending on where and how it was triggered, add IE checking
		global $is_IE;
		$divclass = 'ilc_ps ' . $class;
		if ( $is_IE )
		$divclass .= ' ilc_is-ie';
		if( preg_match('/MSIE 8/i', $ua )  ){
			$divclass .= ' ilc_is-ie8';
		} elseif( preg_match('/MSIE 7/i', $ua )  ){
			$divclass .= ' ilc_is-ie7';
		} 
		
		// Do we have posts?
		if( $posts ){
			
			// Parse carousel value
			$makecarousel = ( '' == $carousel || 'false' == $carousel )? false : true;
			/** @var Number Count products retrieved */
			$countli = count($posts);
			
			if( $makecarousel && ($countli > $minimum) ){
				// If we're making a carousel, hide it first. It will be shown later onCreate
				$divclass .= ' ilc_ps_hidden';
			}
			
			$html = '<div id="ilc_ps-'.self::$instance.'" class="'.$divclass.' woocommerce">';
			$html .='<h3>Our Customer Favorites</h3>';
				$html .= '<ul id="ilc_ps_list-'.self::$instance.'" class="ilc_ps_list">';
			foreach ($posts as $post) {
				setup_postdata($post);
				global $woocommerce, $product;
				if( ('' != $featured_only && 'false' != $featured_only) && ('yes' != $product->featured) ) continue;
				/** Start creating our related post */
				if( preg_match('/MSIE/i', $ua )) $html .= '<li style="width:'.$items_width.'px;">';
				else $html .= '<li><div class="mainprodhold">';
					if( 'none' != $image_size && has_post_thumbnail($post->ID) ){
						$html .= '<a href="'.get_permalink().'" title="'.the_title_attribute($targs).'">';
							$html .= get_the_post_thumbnail($post->ID, $image_size);
						$html .= '</a>';
					}
					$html .= '<h5>';
						$html .= '<a href="'.get_permalink().'" title="'.the_title_attribute($targs).'">';
							$html .= get_the_title();
						$html .= '</a>';
					$html .= '</h5>';
					$content = get_the_excerpt();
					$trimmed_content = wp_trim_words( $content, 9 );
					$html .= '<p class="prodcontent">'. $trimmed_content . '</p>';
					$html .='<div class="smallarrow">';
					$html .= '<a href="'.get_permalink().'" title="'.the_title_attribute($targs).'">';
							$html .= get_the_title();
						$html .= '</a>';
					$html .='</div> </div>';

					if ($product->is_on_sale()) {
						$sale = apply_filters('woocommerce_sale_flash', '<div class="onsale">'.__( 'Sale!', 'woocommerce' ).'</div>', $post, $product);
						$html .= $sale;
					}
					
					if( '' != $add_to_cart && 'false' != $add_to_cart ) {
						// Show Add to Cart
						$html .= '<div class="ilc_ps_add_cart_wrap">';
							$html .= '<div class="ilc_ps_add_cart">';
								ob_start();
								require( plugin_dir_path(__FILE__) . '/templates/add-to-cart.php' );
								$wc_html = ob_get_contents();
								ob_end_clean();
								$html .= $wc_html;
							$html .= '</div>';
						$html .= '</div>';


					}
					// Show price tag
					if( '' != $price && 'false' != $price )
						$html .= '<span class="ilc_ps_price">' . $product->get_price_html() . '</span>';
				$html .= '</li>';
				
				wp_reset_postdata();
			}
				$html .= '</ul>';

			if( $makecarousel && ($countli > $minimum) ){
				// Parse pagination value
				$haspager = ( '' == $pager || 'false' == $pager )? '' : 'ilc_ps_has_pager';
					 
				// begin user wants a carousel
				$html .= '<div class="clearfix"></div>';
				$html .= '<div class="ilc_ps_nav '.$haspager.'">
							<a class="ilc_ps_prev ilc_ps_arrow" title=' . __('Previous', 'themesrobot') . ' href="#">'
								. __('&lsaquo;', 'themesrobot') . '</a>';
				if( $haspager ){
					$html .= '<div class="pager"></div>';
				}
				$html.='	<a class="ilc_ps_next ilc_ps_arrow" title=' . __('Next', 'themesrobot') . ' href="#">'
								. __('&rsaquo;', 'themesrobot') . '</a>
						</div>';
				// end user wants a carousel
			}
			
			$html .= '</div><!-- /ilc_ps -->';
			
			if( $makecarousel && ($countli > $minimum) ){
				// Parse automatic playback value
				$autoplay = ( '' == $auto || 'false' == $auto )? 'false' : 'true';

				// Is the number of items to scroll set?
				if( ! isset( $items_scroll ) || '' == $items_scroll ) {
					$items_scroll = 1;
				}

				// Is the timeout duration set?
				if( ! isset( $timeout ) || '' == $timeout ) {
					$timeout = 3000;
				}
				
				// begin user wants a carousel
				$script = '
				<script type="text/javascript">';
				$script .= '
				jQuery(window).load(function(){
					if( jQuery("#ilc_ps_list-'.self::$instance.' li").length > '.$minimum.' ){
						jQuery("#ilc_ps_list-'.self::$instance.'").carouFredSel({';
				if( !preg_match('/MSIE/i', $ua )  )
					$script .= ' responsive: true, ';
				$script .= '
							width: "100%",
							height: "variable",
							items: {
								';
				if( !preg_match('/MSIE/i', $ua )  )
					$script .= '
							visible: {
									min: '.$items_min.',
									max: '.$items_max.'
							},
							width: '.$items_width.',
					';
				else 
					$script .= '
							visible: "variable",
							width: "variable",
					';
				$script .= '	minimum: '.$minimum.',
								height: "variable"
							},
							scroll: {
								items: '.$items_scroll.',
								pauseOnHover: true,
								wipe: true
							},
							auto: {
								play: '.$autoplay.',
								pauseDuration: '.$timeout.'
							},
							prev: {
								button: "#ilc_ps-'.self::$instance.' .ilc_ps_prev",
								key: "left"
							},
							next: {
								button: "#ilc_ps-'.self::$instance.' .ilc_ps_next",
								key: "right"
							},
							onCreate : function(items, sizes){
								jQuery("#ilc_ps-'.self::$instance.'").css({
									"height": "auto",
									"visibility": "visible"
								}).removeClass("ilc_ps_hidden");
							},
							pagination: {
								container : "#ilc_ps-'.self::$instance.' .pager"
							}
						});
					}
				});
				</script>';

				// end user wants a carousel
				self::$pagehtml .= $script;
			}
			
			self::$instance++;
			return $html;
		}
	}

	/**
	 * Register and/or enqueue scripts and stylesheets to use later
	 * @since 1.0.0
	 */
	function enqueue(){
		// Register styles
		wp_register_style(self::$prefix.'-css', plugin_dir_url(__FILE__) . "includes/ilc-plugin-style.css", array(), self::$version);
		wp_register_script(self::$prefix.'-carousel', plugin_dir_url(__FILE__) . "includes/jquery.carousel.js", array('jquery'), self::$version);
		wp_register_script(self::$prefix.'-js', plugin_dir_url(__FILE__) . "includes/ilc-plugin-script.js", array('jquery'), self::$version);
	}

	/**
	 * Outputs custom styling at the end of the site
	 * @since 1.0.0
	 */
	function styling(){
		global $ilc_ps;
		
		echo '<style type="text/css">';
		if ( 15 !== ($buttonsradius = $ilc_ps->get('arrowradius_int')) ){
			echo "
			.ilc_ps .ilc_ps_prev{
				-webkit-border-top-left-radius: {$buttonsradius}px;
				-webkit-border-bottom-left-radius: {$buttonsradius}px;
				-moz-border-radius-topleft: {$buttonsradius}px;
				-moz-border-radius-bottomleft: {$buttonsradius}px;
				border-top-left-radius: {$buttonsradius}px;
				border-bottom-left-radius: {$buttonsradius}px;
			}
			.ilc_ps .ilc_ps_next{
				-webkit-border-top-right-radius: {$buttonsradius}px;
				-webkit-border-bottom-right-radius: {$buttonsradius}px;
				-moz-border-radius-topright: {$buttonsradius}px;
				-moz-border-radius-bottomright: {$buttonsradius}px;
				border-top-right-radius: {$buttonsradius}px;
				border-bottom-right-radius: {$buttonsradius}px;
			} \n";
		}
		
		if ( 'inherit' !== ($front_color = $ilc_ps->get('front_color')) ){
			echo "
			.ilc_ps .ilc_ps_nav a { color: $front_color; } \n";
		}
		
		if ( 'inherit' !== ($bg_color = $ilc_ps->get('bg_color')) ){
			echo "
			.ilc_ps .ilc_ps_nav a { background: $bg_color; } \n";
		}
		
		if ( 'inherit' !== ($bghover_color = $ilc_ps->get('bghover_color')) ){
			echo "
			.ilc_ps .ilc_ps_nav a:hover { background: $bghover_color; } \n";
		}
		
		if ( 'inherit' !== ($fronthover_color = $ilc_ps->get('fronthover_color')) ){
			echo "
			.ilc_ps .ilc_ps_nav a:hover { color: $fronthover_color; } \n";
		}
		
		if ( 'inherit' !== ($border_color = $ilc_ps->get('border_color')) ){
			echo "
			.ilc_ps .ilc_ps_nav a { color: $border_color; } \n";
		}
		
		if ( '' !== ($customcss = $ilc_ps->get('customcss')) ){
			echo "\n" , $customcss;
		}
			
		echo '</style>';
		
		echo self::$pagehtml;
	}
}

?>