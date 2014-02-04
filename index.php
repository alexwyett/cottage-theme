<?php
/**
 * The main template file
 * 
 * 
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>

<?php else : ?>

<?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', THEMENAME ); ?>
<?php get_search_form(); ?>

    
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>