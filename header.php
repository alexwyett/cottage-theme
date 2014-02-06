<?php
/**
 * The Header template for our theme
 * 
 * 
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <!-- Main wrapper -->
    <div class="wrapper">
        
        <!-- Inner wrapper for bevel -->
        <div class="wrapper-inner">

            <header id="masthead" class="main-header">
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'quicklinks-menu',
                            'menu_class' => 'quicklinks'
                        )
                    );
                ?>
            </header>
            <div class="main-body">
                <div class="main-body-inner">
                    <?php 
                        wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'menu_class' => 'main-menu',
                                'container' => 'nav'
                            )
                        );
                    ?>

                    <?php get_sidebar(); ?>