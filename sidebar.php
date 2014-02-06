<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 * 
 * @package Tabs
 * @subpackage CottageTheme
 * @since 1.0
 */
?>
<aside class="left">
    <div class="box">
        <section class="logo">
            <a href="<?php get_home_url(); ?>">
                Home
            </a>
            <a href="tel:">Tel</a>
        </section>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        <?php endif; ?>
    </div>
</aside>