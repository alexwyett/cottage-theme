<?php
/**
 * Template Name: Cottage Search Page
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
    <div class="main-body col-xs-12 col-sm-12 col-md-12"">

        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <?php echo WpTabsApi__getSearchPageContent(); ?>
        <?php endwhile; // end of the loop. ?>
        
    </div>

<?php get_footer(); ?>