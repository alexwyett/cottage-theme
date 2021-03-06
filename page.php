<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
        
<!-- Inner wrapper for bevel -->
<div class="wrapper-inner inner row">
    <div class="main-body col-xs-12 col-sm-6 col-md-8">

        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', 'page' ); ?>
            <?php comments_template( '', true ); ?>
        <?php endwhile; // end of the loop. ?>
    
    </div>
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>