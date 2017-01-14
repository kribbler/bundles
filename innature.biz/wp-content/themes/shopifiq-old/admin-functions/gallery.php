<?php
class Gallery {
    public function __construct() {
        $this->register_post_type();
        register_taxonomy('gallery_category', 'gallery', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
    }
    
    private function register_post_type() {
        $args = array(
          'labels' => array(
              'name' =>'Gallery',
              'singular_name' => 'Gallery',
              'add_new' => 'Add new',
              'add_new_item' => 'Add new item',
              'edit_item' => 'Edit item',
              'new_item' => 'New item',
              'view_item' => 'View gallery',
              'search_items' => 'Search gallery',
              'not_found' => 'No gallery found'
          ),
            'query_var' => 'gallery',
            'rewrite' => array(
                'slug' => 'gallery'
            ),
            'public' => true,
            'supports' => array(
                            'title',
                            'thumbnail',
                            'editor',
                            'categories'
            )
        );
        
       register_post_type('gallery', $args);
    }
}