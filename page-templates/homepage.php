<?php
/**
 * Template Name: Home Page
 *
 * Description: This template should be set to display the cottages on a page
 *
 * @package Tabs
 * @subpackage CottageTheme
 * @since 1.0
 */

get_header(); ?>
        
<!-- Inner wrapper for bevel -->
<div class="wrapper-inner inner row">
    <div class="main-body col-xs-12 col-sm-6 col-md-8">

        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
        <?php endwhile; // end of the loop. ?>
    
    </div>
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>