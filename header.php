<!DOCTYPE html>
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

        <!-- theme header -->
        <header id="masthead" class="main-header">
            <div class="inner">
                <p class="logo">
                    <a href="<?php echo get_home_url(); ?>">
                        Home
                    </a>
                </p>
                <ul class="contact-details">
                    <li>Email: <a href="mailto:<?php echo get_bloginfo( 'admin_email' ); ?>"><?php echo get_bloginfo( 'admin_email' ); ?></a></li>
                    <li>Telephone: <?php echo of_get_option('office_telephone', '+44 123456789'); ?></li>
                </ul>
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'menu_class' => '',
                            'container' => 'nav',
                            'container_class' => 'main-menu'
                        )
                    );
                ?>
            </div>
        </header>
        <!-- Breadcrumb to go here -->
        <nav class="breadcrumb">
            <a href="/">Home</a>
        </nav>