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

    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
        <?php echo WpTabsApi__getSearchPageContent(); ?>
        <?php comments_template( '', true ); ?>
    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>