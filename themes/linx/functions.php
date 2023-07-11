<?php

define( 'LINX_VERSION', '1.4.1' );
define( 'LINX_TRANSIENTS_MINUTE', '5' );

if ( ! function_exists( 'linx_setup' ) ) :
function linx_setup() {
	load_theme_textdomain( 'linx', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-formats', array(
		'video', 'gallery', 'audio'
	) );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'linx' ),
	) );

	add_image_size( 'linx_full_420', 420 );
	add_image_size( 'linx_full_840', 840 );
	add_image_size( 'linx_full_1130', 1130 );

	switch ( linx_get_option( 'linx_image_crop', 'horizontal' ) ) {
		case 'horizontal' :
			add_image_size( 'linx_420', 420, 260, true );
			add_image_size( 'linx_840', 840, 520, true );			
			break;
		case 'square' :
			add_image_size( 'linx_420', 420, 420, true );
			add_image_size( 'linx_840', 840, 840, true );			
			break;
		case 'vertical' :
			add_image_size( 'linx_420', 420, 550, true );
			add_image_size( 'linx_840', 840, 1100, true );			
			break;
	}
}
endif;
add_action( 'after_setup_theme', 'linx_setup' );

function linx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'linx_content_width', 1140 );
}
add_action( 'after_setup_theme', 'linx_content_width', 0 );

function linx_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'linx' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add sidebar widgets here.', 'linx' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Footer', 'linx' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add Instagram widget here.', 'linx' ),
		'before_widget' => '<section id="%1$s" class="instagram-footer %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'linx' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add footer widgets here.', 'linx' ),
		'before_widget' => '<div class="col-md-4"><section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section></div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Slider', 'linx' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add Instagram widget here.', 'linx' ),
		'before_widget' => '<section id="%1$s" class="instagram-slider %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'linx_widgets_init' );

function linx_fonts_url() {
	$font_url = '';

	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	*/
	if ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'linx' ) ) {
	  $font_url = add_query_arg( 'family', urlencode( 'Rubik:400,500,700&subset=latin,latin-ext' ), '//fonts.googleapis.com/css' );
	}

	return esc_url( $font_url );
}

function linx_scripts() {
	wp_enqueue_style( 'linx-fonts', linx_fonts_url(), array(), LINX_VERSION );
	wp_enqueue_style( 'linx-style', get_stylesheet_uri(), array(), LINX_VERSION );

	wp_enqueue_script( 'linx-script', get_template_directory_uri() . '/js/linx.min.js', array( 'jquery', 'masonry' ), LINX_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$linx_params = array(
    'home_url' => esc_url( home_url() ),
    'admin_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
    'logo_regular' => esc_url( linx_get_option( 'linx_logo_regular@2x', '' ) ),
    'logo_contrary' => esc_url( linx_get_option( 'linx_logo_contrary@2x', '' ) ),
    'like_nonce' => wp_create_nonce( 'linx_like_nonce' ),
    'unlike_nonce' => wp_create_nonce( 'linx_unlike_nonce' ),
    'like_title' => apply_filters( 'linx_like_title', esc_html__( 'Click to like this post.', 'linx' ) ),
		'unlike_title' => apply_filters( 'linx_unlike_title', esc_html__( 'You have already liked this post. Click again to unlike it.', 'linx' ) ),
		'infinite_load' => apply_filters( 'linx_infinite_button_load', esc_html__( 'Load more', 'linx' ) ),
		'infinite_loading' => apply_filters( 'linx_infinite_button_load', esc_html__( 'Loading...', 'linx' ) ),
  );
  wp_localize_script( 'linx-script', 'linxParams', $linx_params );
}
add_action( 'wp_enqueue_scripts', 'linx_scripts' );

if ( ! function_exists( 'rwmb_meta' ) ) {
  function rwmb_meta( $key, $args = '', $post_id = null ) {
    return false;
  }
}

require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/walker.php';
require get_template_directory() . '/inc/category-walker.php';
require get_template_directory() . '/inc/customizer/class-linx-kirki.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgmpa/tgmpa.php';
