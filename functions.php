<?php

/**
 * Functions and definitions
 */
define('THEMENAME', 'cottagetheme');

// Include css and javascript functions file
require_once 'includes/functions_styles_and_css.php';

/**
 * Theme init
 * 
 * @since 1.0
 */
function cottagetheme_init()
{
    // Register nav menus
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu', THEMENAME ),
            'quicklinks-menu' => __( 'Quicklinks Menu', THEMENAME ),
            'footer-menu' => __( 'Footer Menu', THEMENAME )
        )
    );
}
add_action('init', 'cottagetheme_init');

/**
 * Setup.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0
 */
function cottagetheme_setup()
{
    load_theme_textdomain( THEMENAME, get_template_directory() . '/languages' );

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // This theme supports a variety of post formats.
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', THEMENAME . '_setup' );


/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0
 */
function cottagetheme_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', THEMENAME . '_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since 1.0
 */
function cottagetheme_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', THEMENAME ),
        'id' => 'sidebar-1',
        'description' => __( 'Appears on posts and pages.', THEMENAME ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', THEMENAME . '_widgets_init' );

if ( ! function_exists( 'cottagetheme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * 
 * @return void
 */
function cottagetheme_comment( $comment, $args, $depth )
{
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', THEMENAME ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', THEMENAME ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
                    break;
            default :
            // Proceed with normal comments.
            global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
                <?php
                    echo get_avatar( $comment, 44 );
                    printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', THEMENAME ) . '</span>' : ''
                    );
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                        sprintf( __( '%1$s at %2$s', THEMENAME ), get_comment_date(), get_comment_time() )
                    );
                ?>
            </header><!-- .comment-meta -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', THEMENAME ); ?></p>
            <?php endif; ?>

            <section class="comment-content comment">
                <?php comment_text(); ?>
                <?php edit_comment_link( __( 'Edit', THEMENAME ), '<p class="edit-link">', '</p>' ); ?>
            </section><!-- .comment-content -->

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', THEMENAME ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
    <?php
            break;
    endswitch; // end comment_type check
}
endif;

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function cottagetheme_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
            return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', THEMENAME ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', THEMENAME . '_wp_title', 10, 2 );

if ( ! function_exists( 'cottagetheme_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since 1.0
 */
function cottagetheme_content_nav( $html_id ) {
    global $wp_query;

    $html_id = esc_attr( $html_id );

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
            <h3 class="assistive-text"><?php _e( 'Post navigation', THEMENAME ); ?></h3>
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', THEMENAME ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', THEMENAME ) ); ?></div>
        </nav><!-- #<?php echo $html_id; ?> .navigation -->
    <?php endif;
}
endif;

/**
 * Change the search form to add more styling / elements to it
 * 
 * @param \aw\formfields\forms\Form $form Form object
 * 
 * @return void
 */
function alterSearchForm($form)
{
    if (!is_front_page()) {
        $form->getElementBy('getType', 'fieldset')
            ->addChild(
            \aw\formfields\forms\StaticForm::getNewLabelAndCheckboxField(
                'Pet Friendly?'
            )->getElementBy('getType', 'checkbox')
            ->setValue('true')
            ->setName(WPTABSAPIPLUGINSEARCHPREFIX . 'pets')
            ->getParent()
        );
    }
    
    // Alter fromdate label
    $form->getElementBy('getName', 'wp_fromDate')->getParent()->setLabel('From');
    
    bootstrapifyForm($form);
}
add_action('wpTabsApiWidgetFormModify', 'alterSearchForm');


/**
 * Brochure form processing
 *
 * @param \aw\formfields\form\Form $brochureForm Form object
 *
 * @return void
 */
function brochureFormProcessing($brochureForm)
{
    bootstrapifyForm($brochureForm);
    
    // Set the validation call back
    $brochureForm->setCallback(
        function($brochureForm, $ele, $e) {
            
            // Add label message
            if ($ele->getParent()->getType() == 'label') {
                $ele->getParent()->setLabel(
                    $ele->getParent()->getLabel()
                    . ' - ' . $e->getMessage()
                );
            }
        
            $ele->getParent()->setTemplate(
                str_replace(
                    'form-group', 
                    'form-group has-error ', 
                    $ele->getParent()->getTemplate()
                )
            );
        }
    );
}
add_action('wpTabsApiBrochurePreprocess', 'brochureFormProcessing');
add_action('wpTabsApiOwnerpackPreprocess', 'brochureFormProcessing');


/**
 * Brochure form processing
 *
 * @param array $array Array containing $booking, $property, $bookingForm objects
 *
 * @return void
 */
function bookingFormProcessing($array)
{
    extract($array);
    bootstrapifyForm($bookingForm);

    $ele = $bookingForm->getElementBy('getLegend', 'About your Party');
    $ele->getParent()->each('getType', 'label', function ($label) {
        $label->setTemplate(
            str_replace(
                'form-group',
                'form-group col-sm-3 ',
                $label->getTemplate()
            )
        );
    });
    
    // Set the validation call back
    $bookingForm->setCallback(
        function($bookingForm, $ele, $e) {
            
            // Add label message
            if ($ele->getParent()->getType() == 'label') {
                $ele->getParent()->setLabel(
                    $ele->getParent()->getLabel()
                    . ' - ' . $e->getMessage()
                );
            }
        
            $ele->getParent()->setTemplate(
                str_replace(
                    'form-group', 
                    'form-group has-error ', 
                    $ele->getParent()->getTemplate()
                )
            );
        }
    );
}
add_action('wpTabsApiBookingPreprocess', 'bookingFormProcessing');

/**
 * Re-template a form so it fits in with the bootstrap theme
 *
 * @param \aw\formfields\form\Form &$form Form object
 *
 * @return \aw\formfields\form\Form
 */
function bootstrapifyForm($form)
{
    // Set form attributes
    $form->setAttribute('role', 'form');

    // Apply a different template to each of the labels
    $form->each('getType', 'label', function ($label) {
        $label->setClass('control-label')
            ->setTemplate(
            '<div class="form-group">
                <label{implodeAttributes}>{getLabel}</label>
                <div class="">
                    {renderChildren}
                </div>
            </div>'
        );
    });

    $form->each('getType', 'text', function ($textfield) {
        $placeholder = $textfield->getParent()->getLabel();
        $textfield->setClass('form-control')->setAttribute('placeholder', $placeholder);
    });

    $form->each('getType', 'textarea', function ($textfield) {
        $placeholder = $textfield->getParent()->getLabel();
        $textfield->setClass('form-control')->setAttribute('placeholder', $placeholder);
    });

    $form->each('getType', 'select', function ($textfield) {
        $textfield->setClass('form-control');
    });
    
    $form->each('getType', 'fieldset', function ($fieldset) {
        if (in_array($fieldset->getClass(), array('your-details', 'your-address'))) {
            $fieldset->each('getType', 'label', function ($label) {
                $label->setTemplate(
                    str_replace(
                        'form-group',
                        'form-group col-sm-6',
                        $label->getTemplate()
                    )
                );
            });
        }
    });

    $form->each('getType', 'checkbox', function($checkbox) {
        $checkbox->getParent()
                ->setClass('')
                ->setTemplate(
                    '<div class="form-group">
                        <label{implodeAttributes}>{renderChildren} {getLabel}</label>
                    </div>'
                );
    });

    // Set the button template
    $form->getElementBy('getType', 'submit')
        ->setClass('btn btn-primary btn-block')
        ->setTemplate(
            '<div class="form-group">
                <input type="{getType}"{implodeAttributes}>
            </div>');
}
/**
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */
if ( !function_exists( 'of_get_option' ) ) {
    function of_get_option($name, $default = false) {
        $optionsframework_settings = get_option('optionsframework');
        // Gets the unique option id
        $option_name = $optionsframework_settings['id'];
        if ( get_option($option_name) ) {
            $options = get_option($option_name);
        }
        if ( isset($options[$name]) ) {
            return $options[$name];
        } else {
            return $default;
        }
    }
}

/**
 * Custom breadcrumb
 */
function custom_breadcrumb() {
  if(!is_home()) {
    echo '<ol class="breadcrumb">';
    echo '<li><a href="'.get_option('home').'">Home</a></li>';
    if (is_single()) {
        echo '<li>';
        the_title();
        echo '</li>';
    } elseif (is_category()) {
      echo '<li>';
      single_cat_title();
      echo '</li>';
    } elseif (is_page() && (!is_front_page())) {
      echo '<li>';
      the_title();
      echo '</li>';
    } elseif (is_tag()) {
      echo '<li>Tag: ';
      single_tag_title();
      echo '</li>';
    } elseif (is_day()) {
      echo'<li>Archive for ';
      the_time('F jS, Y');
      echo'</li>';
    } elseif (is_month()) {
      echo'<li>Archive for ';
      the_time('F, Y');
      echo'</li>';
    } elseif (is_year()) {
      echo'<li>Archive for ';
      the_time('Y');
      echo'</li>';
    } elseif (is_author()) {
      echo'<li>Author Archives';
      echo'</li>';
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
      echo '<li>Blog Archives';
      echo'</li>';
    } elseif (is_search()) {
      echo'<li>Search Results';
      echo'</li>';
    }
    echo '</ol>';
  }
}



function get_breadcrumbs(
    $starting_page, 
    $deco = array(
        'before_all' => '<ol class="breadcrumb">', 
        'after_all' => '</ol>', 
        'before_each' => '<li>', 
        'after_each' => '</li>', 
        'separator' => ''
    )
) {
	// get our "decorations"
	extract($deco);
    
	// reverse it so the highest (most-parent?) page is first
	$ids = array_reverse(_get_breadcrumbs($post));
    
	// loop through each, create decorated links
	$links = array();
	foreach ($ids as $url => $title) {
		$links[] = sprintf(
            '%s<a href="%s">%s</a>%s',
            $before_each,
            $url,
            $title,
            $after_each
        );
	}
    
	// return it all together
	return $before_all . implode( $separator, $links ) . $after_all;
}

//recursive function for getting all parent, grandparent, etc. IDs
//not intended for direct use
function _get_breadcrumbs( $starting_page, $container = array() ) {

	//make sure you're working with an object
	$sp = ( ! is_object( $starting_page ) ) ? get_post( $starting_page ) : $starting_page;
    
	//make sure to insert starting page only once
	if ( ! in_array( get_permalink( $sp->ID ), $container ) ) {
		$container[ get_permalink( $sp->ID ) ] = get_the_title( $sp->ID );
    }
	
	//if parent, recursion!
	if ( $sp->post_parent > 0 ) {
		$container[ get_permalink( $sp->post_parent ) ] = get_the_title( $sp->post_parent );
		$container = _get_breadcrumbs( $sp->post_parent, $container );
	}
    
	return $container;
}