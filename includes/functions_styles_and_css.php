<?php

/**
 * Script loader
 * 
 * @return void
 */
function cottagetheme_load_scripts()
{
    // Register css
    wp_register_style(
        THEMENAME . 'css', 
        get_template_directory_uri() . '/css/stylesheet.css'
    );
    
    // Load css
    wp_enqueue_style(THEMENAME . 'css');
}
add_action('wp_enqueue_scripts', cottagetheme_load_scripts);

/**
 * Other JS/CSS
 * 
 * @return void
 */
function cottagetheme_load_less()
{
    $path = get_stylesheet_directory_uri();
    $output = '';
    print $output;
}
add_action('wp_head', 'cottagetheme_load_less');