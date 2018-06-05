<?php
add_action('wp_enqueue_scripts', 'CHfw_child_enqueue_styles');
function CHfw_child_enqueue_styles()
{
    wp_register_style('chfw-style',  get_stylesheet_directory_uri() . '/assets/css/CHfw-style.css', '', '2.7', 'all');
    wp_enqueue_style('chfw-style');
    wp_enqueue_style('chfw-style-child-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('chfw-style-child-style');
}