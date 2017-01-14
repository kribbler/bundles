<?php
class Faq {
    public function __construct() {
        $this->register_post_type();
        register_taxonomy('faq_category', 'faq', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
    }
    
    private function register_post_type() {
        $args = array(
          'labels' => array(
              'name' =>'Faq',
              'singular_name' => 'Faq',
              'add_new' => 'Add new',
              'add_new_item' => 'Add new item',
              'edit_item' => 'Edit item',
              'new_item' => 'New item',
              'view_item' => 'View faq',
              'search_items' => 'Search faq',
              'not_found' => 'No tesimonials found'
          ),
            'query_var' => 'faq',
            'rewrite' => array(
                'slug' => 'faq'
            ),
            'public' => true,
            'supports' => array(
                            'title',
                            'editor',
                            'categories'
            )
        );
        
       register_post_type('faq', $args);
    }
}