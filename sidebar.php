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
<aside class="sidebar col-xs-6 col-md-3 pull-right">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php endif; ?>
</aside>