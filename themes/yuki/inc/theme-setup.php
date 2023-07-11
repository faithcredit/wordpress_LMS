<?php

/**
 * Yuki Theme Setup
 *
 * @package Yuki
 */
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Typography\Fonts ;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yuki_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Yuki, use a find and replace
     * to change 'yuki' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'yuki', get_template_directory() . '/languages' );
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    // Support align wide
    add_theme_support( 'align-wide' );
    // Gutenberg custom stylesheet
    add_theme_support( 'editor-styles' );
    add_editor_style( 'dist/css/editor-style' . (( defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min' )) . '.css' );
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ) );
    // Support responsive embeds
    add_theme_support( "responsive-embeds" );
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
    // Starter Content
    add_theme_support( 'starter-content', apply_filters( 'yuki_starter_content', array(
        'widgets'   => array(
        'yuki_header_el_widgets'   => array(
        'search',
        'recent-posts',
        'categories',
        'text_business_info'
    ),
        'primary-sidebar'          => array( 'search', 'text_about', 'text_business_info' ),
        'yuki_footer_el_widgets_1' => array( 'text_business_info' ),
        'yuki_footer_el_widgets_2' => array( 'text_about' ),
        'yuki_footer_el_widgets_3' => array( 'recent-posts' ),
        'yuki_footer_el_widgets_4' => array( 'search', 'recent-comments' ),
        'frontpage-widgets-1'      => array( 'categories', 'meta' ),
    ),
        'posts'     => array(
        'home' => array(
        'post_type'    => 'page',
        'post_title'   => __( 'Home', 'yuki' ),
        'post_content' => '',
    ),
        'about',
        'contact',
        'blog',
    ),
        'nav_menus' => array(
        'yuki_header_el_menu_1' => array(
        'name'  => __( 'Top Bar Menu', 'yuki' ),
        'items' => array(
        'page_about',
        'page_contact',
        'page_blog',
        'post_news'
    ),
    ),
        'yuki_header_el_menu_2' => array(
        'name'  => __( 'Primary Menu', 'yuki' ),
        'items' => array(
        'link_home',
        'page_about',
        'page_contact',
        'page_blog'
    ),
    ),
        'yuki_footer_el_menu'   => array(
        'name'  => __( 'Footer Menu', 'yuki' ),
        'items' => array( 'page_about', 'page_contact', 'page_blog' ),
    ),
    ),
        'options'   => array(
        'show_on_front'  => 'page',
        'page_on_front'  => '{{home}}',
        'page_for_posts' => '{{blog}}',
    ),
    ) ) );
}

add_action( 'after_setup_theme', 'yuki_setup' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yuki_widgets_init()
{
    $sidebar_class = 'yuki-widget yuki-scroll-reveal-widget clearfix %2$s';
    $title_class = 'widget-title mb-half-gutter heading-content';
    $tag = CZ::get( 'yuki_global_sidebar_title-tag' );
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'yuki' ),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'yuki' ),
        'before_widget' => '<section id="%1$s" class="' . esc_attr( $sidebar_class ) . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<' . $tag . ' class="' . esc_attr( $title_class ) . '">',
        'after_title'   => '</' . $tag . '>',
    ) );
    for ( $i = 1 ;  $i <= 4 ;  $i++ ) {
        register_sidebar( [
            'name'          => __( 'Frontpage Widgets', 'yuki' ) . ' #' . $i,
            'id'            => 'frontpage-widgets-' . $i,
            'before_widget' => '<aside id="%1$s" class="' . $sidebar_class . '">',
            'after_widget'  => '</aside>',
            'before_title'  => '<' . $tag . ' class="' . $title_class . '">',
            'after_title'   => '</' . $tag . '>',
        ] );
    }
}

add_action( 'widgets_init', 'yuki_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function yuki_enqueue_scripts()
{
    $suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min' );
    // Vendors
    wp_enqueue_script(
        'superfish',
        get_template_directory_uri() . '/dist/vendor/superfish/superfish.min.js',
        [ 'jquery' ],
        YUKI_VERSION
    );
    wp_register_script(
        'slick',
        get_template_directory_uri() . '/dist/vendor/slick/slick.min.js',
        [ 'jquery' ],
        YUKI_VERSION
    );
    if ( CZ::checked( 'yuki_global_scroll_reveal' ) ) {
        if ( !is_customize_preview() || CZ::checked( 'yuki_customize_preview_scroll_reveal' ) ) {
            wp_enqueue_script(
                'scrollreveal',
                get_template_directory_uri() . '/dist/vendor/scrollreveal/scrollreveal.min.js',
                [ 'jquery' ],
                YUKI_VERSION
            );
        }
    }
    // Enqueue infinite-scroll
    if ( is_archive() || is_home() || is_search() ) {
        if ( CZ::get( 'yuki_archive_layout' ) === 'archive-masonry' ) {
            wp_enqueue_script(
                'masonry',
                get_template_directory_uri() . '/dist/vendor/masonry/masonry.pkgd.min.js',
                [ 'jquery' ],
                YUKI_VERSION
            );
        }
    }
    wp_enqueue_style( 'lotta-fontawesome' );
    wp_enqueue_style(
        'yuki-style',
        get_template_directory_uri() . '/dist/css/style' . $suffix . '.css',
        array(),
        YUKI_VERSION
    );
    wp_enqueue_script(
        'yuki-script',
        get_template_directory_uri() . '/dist/js/app' . $suffix . '.js',
        array( 'jquery' ),
        YUKI_VERSION,
        true
    );
    if ( is_front_page() && !is_home() && CZ::checked( 'yuki_homepage_builder_section' ) ) {
        Yuki_Homepage_Builder::enqueue_frontend_scripts();
    }
    yuki_enqueue_global_vars();
    yuki_enqueue_dynamic_css();
    Fonts::enqueue_scripts( 'yuki_fonts', YUKI_VERSION );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'yuki_enqueue_scripts', 20 );
function yuki_enqueue_admin_scripts()
{
    $suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min' );
    yuki_enqueue_global_vars( true );
    yuki_enqueue_admin_dynamic_css();
    Fonts::enqueue_scripts( 'yuki_fonts', YUKI_VERSION );
    wp_register_script(
        'yuki-admin-script',
        get_template_directory_uri() . '/dist/js/admin' . $suffix . '.js',
        [ 'jquery' ],
        YUKI_VERSION
    );
    // Theme admin scripts
    wp_register_style(
        'yuki-admin-style',
        get_template_directory_uri() . '/dist/css/admin' . $suffix . '.css',
        [],
        YUKI_VERSION
    );
    wp_enqueue_script( 'yuki-admin-script' );
    wp_enqueue_style( 'yuki-admin-style' );
}

add_action( 'admin_enqueue_scripts', 'yuki_enqueue_admin_scripts' );
/**
 * Enqueue scripts and styles for customizer.
 */
function yuki_enqueue_customizer_scripts()
{
    $suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min' );
    wp_enqueue_style(
        'yuki-customizer-style',
        get_template_directory_uri() . '/dist/css/customizer' . $suffix . '.css',
        array(),
        YUKI_VERSION
    );
}

add_action( 'customize_controls_enqueue_scripts', 'yuki_enqueue_customizer_scripts', 10 );
function yuki_enqueue_customize_preview_scripts()
{
    $suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min' );
    wp_enqueue_script(
        'yuki-customizer-preview-script',
        get_template_directory_uri() . '/dist/js/customizer-preview' . $suffix . '.js',
        array( 'customize-preview', 'customize-selective-refresh' ),
        YUKI_VERSION
    );
}

add_action( 'customize_preview_init', 'yuki_enqueue_customize_preview_scripts', 20 );