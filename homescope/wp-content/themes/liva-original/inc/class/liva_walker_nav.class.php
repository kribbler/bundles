<?php

/**
 * Create HTML list of nav menu items
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class liva_walker_nav_menu extends Walker_Nav_Menu {
	
	/**
	 * Blog menu parents, all child items must be skipped for blog menu items (from deppth = 0)
	 * @var array
	 */
	var $blog_menu_parents = array();
	
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		//skip menu elements if blog menu is activated for parent element
		if ($depth > 0  && in_array($item -> menu_item_parent, $this -> blog_menu_parents)) {
			return;
		}
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		if ($depth == 0 && $item -> megamenu == 'enabled') {
			$classes[] = 'mega-menu';
		}
		
		//check if post menu (posts thumbnails presented in the menu)
		if ($depth == 0 && $item -> blogmenu == 'enabled') {
			$classes[] = 'post-menu';
			$this -> blog_menu_parents[] = $item -> ID;
		}
		
		$link_after = '';
		if ($depth == 0 && $item -> hasChildren == 1) {
			$link_after = '<i class="icon-angle-down"></i>';
		}
		
		$classes_a = array();
		if ($depth == 0 && !empty($item -> icon) && ts_get_main_menu_style() == 'style5') {
			$classes_a[] = $item -> icon;
		}
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= count($classes_a) > 0      ? ' class="'   . implode(' ', $classes_a    ) .'"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after. $link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		//append blog posts
		if ($depth == 0 && $item -> blogmenu == 'enabled') {
			global $query_string, $post;
			$args = array(
				'posts_per_page'  => 12,
				'offset'          => 0,
				'post_type'       => 'post',
				'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
				'paged'				=> 1,
				'post_status'     => 'publish'
			);
			$the_query = new WP_Query( $args );
			
			if ( $the_query->have_posts() )
			{
				$output.= '<ul class="sub-menu" style="display: none;">'."\n";
				
				while ( $the_query->have_posts() )
				{
					$the_query->the_post();
					
					$output.= "\n".'<li id="menu-item-'.$post -> ID.'" class="menu-item">
						<a href="'.get_permalink().'">'.ts_get_resized_post_thumbnail($post -> ID, 'blogmenu-thumb',get_the_title()).'</a>
						<div class="post-details">
						  '.ts_get_resized_post_thumbnail($post -> ID, 'blogmenu',get_the_title()).'
						  <span class="format-'.get_post_format().'"></span>
						  <p class="menu-post-description">'.ts_get_the_excerpt_theme(15).'</p>
						</div>
					  </li>'."\n";
				}
				
				$output.= '</ul>'."\n";
			}
			// Restore original Query & Post Data
			wp_reset_query();
			wp_reset_postdata();
		}
	}
	
	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
		//skip menu elements if blog menu is activated for parent element
		if ($depth > 0  && !in_array($item -> menu_item_parent, $this -> blog_menu_parents)) {
			return;
		}
		
		$output .= "</li>\n";
	}
}
