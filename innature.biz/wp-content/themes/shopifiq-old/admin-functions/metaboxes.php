<?php

class Metaboxes {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }

    public function add_meta_boxes() {
        add_meta_box('cb_sidebar_left', 'Sidebar left', array($this, 'sidebar_left', 'post'));
        add_meta_box('cb_sidebar_right', 'Sidebar right', array($this, 'sidebar_right', 'post'));
        add_meta_box('cb_sidebar_left', 'Sidebar left', array($this, 'sidebar_left', 'page'));
        add_meta_box('cb_sidebar_right', 'Sidebar right', array($this, 'sidebar_right', 'page'));
    }

    public function save_meta_boxes($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if(isset($_POST['sidebar_generator'])) {
            update_post_meta($post_id, 'cb_sidebar_left',$_POST['sidebar_generator']);
        }
        if(isset($_POST['sidebar_generator_replacement'])) {
            update_post_meta($post_id, 'cb_sidebar_right',$_POST['sidebar_generator_replacement']);
        }
    }

}

$metabox = new Metaboxes();