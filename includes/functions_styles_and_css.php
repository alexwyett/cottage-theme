<?php

/**
 * Script loader
 * 
 * @return void
 */
function cottagetheme_load_scripts()
{
    // Register css
    //wp_register_style(
    //    THEMENAME . 'css', 
    //    get_template_directory_uri() . '/css/style.css'
    //);
    
    // Load css
    //wp_enqueue_style(THEMENAME . 'css');
}
add_action('wp_enqueue_scripts', cottagetheme_load_scripts);

/**
 * Less stylesheet loader
 * 
 * @return void
 */
function cottagetheme_load_less()
{
    $path = get_stylesheet_directory_uri();
    $output = "\n<!-- loading less css files -->\n";
    $output .= sprintf(
        '<link rel="stylesheet/less" type="text/css" href="%s/css/stylesheet.less">', 
        $path
    );
    $output .= sprintf(
        '<script type="text/javascript" src="%s/js/less-1.6.2-min.js"></script>', 
        $path
    );
    $output .= '
        <script type="text/javascript">
            less.env = "development";
            less.watch();
        </script>
    ';
    
    print $output;
}
add_action('wp_head', 'cottagetheme_load_less');