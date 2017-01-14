<?php 
wp_enqueue_style('admin-style', get_stylesheet_directory_uri().'/admin-functions/admin-style.css');
wp_enqueue_style('color-picker', get_stylesheet_directory_uri().'/css/colorpicker.css');
wp_enqueue_style('custom', get_stylesheet_directory_uri().'/custom.css');
wp_enqueue_style('media-queries', get_stylesheet_directory_uri().'/media-queries.css');
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('color-picker', get_stylesheet_directory_uri().'/js/colorpicker.js', array('jquery')); 
wp_enqueue_script('pattern', get_stylesheet_directory_uri().'/admin-functions/pattern.js', array('jquery')); 
wp_enqueue_script('contact', get_stylesheet_directory_uri().'/admin-functions/contact.js', array('jquery')); 
wp_enqueue_script('slider', get_stylesheet_directory_uri().'/admin-functions/slider.js', array('jquery')); 
wp_enqueue_script('slider-h', get_stylesheet_directory_uri().'/slider.js', array('jquery')); 

?>
    <div class="envoo-admin">
        <ul class="envoo-admin-menu">
            <li><h2>Theme Options</h2></li>
            <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=theme_style">Theme style</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=options">Theme options</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "contact_form") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=contact_form">Contact form</a></li>
            <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content") {
        echo 'id="selected-menu-item"';
    } ?> href="themes.php?page=theme_options&sub_page=dummy_content">Dummy content</a></li>
        </ul>
        <div class="envoo-admin-content">
            <?php
            include_once 'adminThemeOptions.php';

            $contact = new adminThemeOptions();

            if (!isset($_GET['sub_page']))
                echo $contact->style() . "<br>";

            else if ($_GET['sub_page'] == "options") {
                echo $contact->info() . "<br>";
            } else if ($_GET['sub_page'] == "contact_form") {
                echo $contact->contact() . "<br>";
            } else if ($_GET['sub_page'] == "dummy_content") {
                echo $contact->dummy() . "<br>";
            } else {
                echo $contact->style() . "<br>";
            }
            ?>
        </div></div> 