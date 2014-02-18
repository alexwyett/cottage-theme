<?php
/**
 * Template Name: Cottage Search Page - Map
 *
 * Description: This template should be set to display the cottages on a page
 *
 * @package Tabs
 * @subpackage CottageTheme
 * @since 1.0
 */
 
add_action(
    "wp_enqueue_scripts", 
    function () {
        WPTabsApiAdmin::enqueueJs(
            'mapsearch',
            'jQuery.viewonmap.js'
        );
    }, 
    11
);

add_action('wp_footer', function() {
    ?>
        <script type="text/javascript">
        // js code goes here
        </script>
    <?php
});

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
        
        
    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>