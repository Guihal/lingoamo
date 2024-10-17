<?php

/**
 * Blogus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blogus
 */

$blogus_theme_path = get_template_directory() . '/inc/ansar/';

require($blogus_theme_path . '/blogus-custom-navwalker.php');
require($blogus_theme_path . '/default_menu_walker.php');
require($blogus_theme_path . '/font/font.php');
require($blogus_theme_path . '/template-tags.php');
require($blogus_theme_path . '/template-functions.php');
require($blogus_theme_path . '/widgets/widgets-common-functions.php');
require($blogus_theme_path . '/custom-control/custom-control.php');
require($blogus_theme_path . '/custom-control/font/font-control.php');
require_once get_template_directory() . '/inc/ansar/customizer-admin/blogus-admin-plugin-install.php';
require_once(trailingslashit(get_template_directory()) . 'inc/ansar/customize-pro/class-customize.php');

// Theme version.
$blogus_theme = wp_get_theme();
define('BLOGUS_THEME_VERSION', $blogus_theme->get('Version'));
define('BLOGUS_THEME_NAME', $blogus_theme->get('Name'));

/*-----------------------------------------------------------------------------------*/
/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
require($blogus_theme_path . '/enqueue.php');
/* ----------------------------------------------------------------------------------- */
/* Customizer */
/* ----------------------------------------------------------------------------------- */
require($blogus_theme_path . '/customize/customizer.php');

/* ----------------------------------------------------------------------------------- */
/* Customizer */
/* ----------------------------------------------------------------------------------- */

require($blogus_theme_path  . '/widgets/widgets-init.php');

/* ----------------------------------------------------------------------------------- */
/* Widget */
/* ----------------------------------------------------------------------------------- */

require($blogus_theme_path  . '/hooks/hooks-init.php');

/* custom-color file. */
require(get_template_directory() . '/css/colors/theme-options-color.php');

require get_template_directory() . '/inc/ansar/hooks/blocks/header/header-init.php';

/* Style For Sidebar*/
require_once  get_template_directory()  . '/css/custom-style.php';


if (! function_exists('blogus_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function blogus_setup()
    {
        /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blogus, use a find and replace
	 * to change 'blogus' to the name of your theme in all the template files.
	 */
        load_theme_textdomain('blogus', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
        add_theme_support('title-tag');

        /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
        add_theme_support('post-thumbnails');

        // Add featured image sizes
        add_image_size('blogus-slider-full', 1280, 720, true); // width, height, crop
        add_image_size('blogus-featured', 1024, 0, false); // width, height, crop
        add_image_size('blogus-medium', 720, 380, true); // width, height, crop

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary menu', 'blogus'),
            'footer' => __('Footer menu', 'blogus'),
        ));

        /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        $args = array(
            'default-color' => '#eee',
            'default-image' => '',
        );
        add_theme_support('custom-background', $args);

        // Set up the woocommerce feature.
        add_theme_support('woocommerce');

        // Woocommerce Gallery Support
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // Added theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /* Add theme support for gutenberg block */
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');

        //Custom logo
        add_theme_support('custom-logo');

        // custom header Support
        $args = array(
            'width'            => '1600',
            'height'        => '300',
            'flex-height'        => false,
            'flex-width'        => false,
            'header-text'        => true,
            'default-text-color'    => '000',
            'wp-head-callback'       => 'blogus_header_color',
        );
        add_theme_support('custom-header', $args);


        /*
     * Enable support for Post Formats on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/post-formats/
     */
        add_theme_support('post-formats', array('image', 'video', 'gallery', 'audio'));

        // Enable default block styles for Gutenberg blocks
        add_theme_support('wp-block-styles');

        //Editor Styling
        add_editor_style(array('css/editor-style.css'));
    }
endif;
add_action('after_setup_theme', 'blogus_setup');


function blogus_the_custom_logo()
{

    if (function_exists('the_custom_logo')) {
        the_custom_logo();
    }
}

add_filter('get_custom_logo', 'blogus_logo_class');


function blogus_logo_class($html)
{
    $html = str_replace('custom-logo-link', 'navbar-brand', $html);
    return $html;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogus_content_width()
{
    $GLOBALS['content_width'] = apply_filters('blogus_content_width', 640);
}
add_action('after_setup_theme', 'blogus_content_width', 0);


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogus_widgets_init()
{

    $blogus_footer_column_layout = esc_attr(get_theme_mod('blogus_footer_column_layout', 3));

    $blogus_footer_column_layout = 12 / $blogus_footer_column_layout;

    register_sidebar(array(
        'name'          => esc_html__('Sidebar Widget Area', 'blogus'),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
        'after_title'   => '</h2></div>',
    ));



    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'blogus'),
        'id'            => 'footer_widget_area',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="col-md-' . $blogus_footer_column_layout . ' rotateInDownLeft animated bs-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
        'after_title'   => '</h2></div>',
    ));
}
add_action('widgets_init', 'blogus_widgets_init');

function popup($atts, $content)
{
    return  '<div class="popup center hide" id="callback">
        <div class="popup__wrapper">
            <div class="popup__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.0675 15.1828C16.1256 15.2409 16.1717 15.3098 16.2031 15.3857C16.2345 15.4615 16.2507 15.5429 16.2507 15.625C16.2507 15.7071 16.2345 15.7884 16.2031 15.8643C16.1717 15.9402 16.1256 16.0091 16.0675 16.0672C16.0095 16.1252 15.9405 16.1713 15.8647 16.2027C15.7888 16.2342 15.7075 16.2503 15.6253 16.2503C15.5432 16.2503 15.4619 16.2342 15.386 16.2027C15.3102 16.1713 15.2412 16.1252 15.1832 16.0672L10.0003 10.8836L4.81753 16.0672C4.70026 16.1844 4.5412 16.2503 4.37535 16.2503C4.2095 16.2503 4.05044 16.1844 3.93316 16.0672C3.81588 15.9499 3.75 15.7908 3.75 15.625C3.75 15.4591 3.81588 15.3001 3.93316 15.1828L9.11675 9.99998L3.93316 4.81717C3.81588 4.69989 3.75 4.54083 3.75 4.37498C3.75 4.20913 3.81588 4.05007 3.93316 3.93279C4.05044 3.81552 4.2095 3.74963 4.37535 3.74963C4.5412 3.74963 4.70026 3.81552 4.81753 3.93279L10.0003 9.11639L15.1832 3.93279C15.3004 3.81552 15.4595 3.74963 15.6253 3.74963C15.7912 3.74963 15.9503 3.81552 16.0675 3.93279C16.1848 4.05007 16.2507 4.20913 16.2507 4.37498C16.2507 4.54083 16.1848 4.69989 16.0675 4.81717L10.8839 9.99998L16.0675 15.1828Z"
                        fill="#5E4A8A" />
                </svg>
            </div>
            <div class="title center title-30 mob-24">Send request</div>' .
        do_shortcode($content) . '
        </div>
    </div>';
}

add_shortcode('popup', 'popup');
