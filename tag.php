<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 * 
 * @package Tabs
 * @subpackage CottageTheme
 * @since 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
    <header class="archive-header">
            <h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', THEMENAME ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

    <?php if ( tag_description() ) : // Show an optional tag description ?>
            <div class="archive-meta"><?php echo tag_description(); ?></div>
    <?php endif; ?>
    </header><!-- .archive-header -->

    <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();

                /*
                 * Include the post format-specific template for the content. If you want to
                 * this in a child theme then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                get_template_part( 'content', get_post_format() );

        endwhile;
    ?>

<?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>