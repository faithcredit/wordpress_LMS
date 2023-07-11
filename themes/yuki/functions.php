<?php

/**
 * Yuki functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Yuki
 */
if ( !defined( 'YUKI_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( 'YUKI_VERSION', '1.3.7' );
}
if ( !defined( 'YUKI_WOOCOMMERCE_ACTIVE' ) ) {
    // Used to check whether WooCommerce plugin is activated
    define( 'YUKI_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
}
if ( !function_exists( 'yuki_custom_pricing_js_path' ) ) {
    function yuki_custom_pricing_js_path()
    {
        return get_template_directory() . '/freemius-pricing/freemius-pricing.js';
    }

}

if ( !function_exists( 'yuki_fs' ) ) {
    // Create a helper function for easy SDK access.
    function yuki_fs()
    {
        global  $yuki_fs ;
        
        if ( !isset( $yuki_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $yuki_fs = fs_dynamic_init( array(
                'id'             => '10671',
                'slug'           => 'yuki',
                'type'           => 'theme',
                'public_key'     => 'pk_add32a34a0ba63b92abede52e5046',
                'is_premium'     => false,
                'premium_suffix' => 'Professional',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'   => 'yuki',
                'parent' => array(
                'slug' => 'themes.php',
            ),
            ),
                'is_live'        => true,
            ) );
        }
        
        return $yuki_fs;
    }
    
    // Init Freemius.
    yuki_fs();
    // Signal that SDK was initiated.
    do_action( 'yuki_fs_loaded' );
    // Using pricing table v2
    yuki_fs()->add_filter( 'freemius_pricing_js_path', 'yuki_custom_pricing_js_path' );
}

/**
 * Load lotta-framework
 */
require get_template_directory() . '/lotta-framework/vendor/autoload.php';
/**
 * Helper functions
 */
require get_template_directory() . '/inc/helpers.php';
/**
 * Dynamic Css
 */
require get_template_directory() . '/inc/dynamic-css.php';
/**
 * Theme Setup
 */
require get_template_directory() . '/inc/theme-setup.php';
if ( YUKI_WOOCOMMERCE_ACTIVE ) {
    /**
     * WooCommerce Setup
     */
    require get_template_directory() . '/inc/woo-setup.php';
}
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Traits functions
 */
require get_template_directory() . '/inc/traits.php';
/**
 * Traits functions
 */
require get_template_directory() . '/inc/extensions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
if ( is_admin() ) {
    /**
     * Admin
     */
    require get_template_directory() . '/inc/admin.php';
}
/**
 * Boostrap lotta-framework
 */
\LottaFramework\Bootstrap::run( 'yuki', trailingslashit( get_template_directory_uri() ) . 'lotta-framework/' );
// support locally hosted google-fonts
yuki_app()->support( 'local_webfonts' );
// save theme settings in options
yuki_app( 'CZ' )->storeAs( 'option' );
// add preloader customize partial
yuki_app( 'CZ' )->addPartial( 'yuki-preloader-selective-css', '#yuki-preloader-selective-css', function () {
    echo  yuki_preloader_css() ;
} );
// add WooCommerce css partial
yuki_app( 'CZ' )->addPartial( 'yuki-woo-selective-css', '#yuki-woo-selective-css', function () {
    if ( function_exists( 'yuki_woo_dynamic_css' ) ) {
        echo  \LottaFramework\Facades\Css::parse( yuki_woo_dynamic_css() ) ;
    }
} );
// add global customize partial
yuki_app( 'CZ' )->addPartial( 'yuki-global-selective-css', '#yuki-global-selective-css', function () {
    echo  yuki_global_css_vars() ;
    echo  yuki_dynamic_css() ;
} );
// add header customize partial
yuki_app( 'CZ' )->addPartial( 'yuki-header-selective-css', '#yuki-header-selective-css', function () {
    Yuki_Header_Builder::instance()->builder()->do( 'enqueue_frontend_scripts' );
    echo  \LottaFramework\Facades\Css::parse( apply_filters( 'yuki_filter_dynamic_css', [] ) ) ;
} );
// add footer customize partial
yuki_app( 'CZ' )->addPartial( 'yuki-footer-selective-css', '#yuki-footer-selective-css', function () {
    Yuki_Footer_Builder::instance()->builder()->do( 'enqueue_frontend_scripts' );
    echo  \LottaFramework\Facades\Css::parse( apply_filters( 'yuki_filter_dynamic_css', [] ) ) ;
} );
// add homepage customize partial
yuki_app( 'CZ' )->addPartial( 'yuki-homepage-selective-css', '#yuki-homepage-selective-css', function () {
    Yuki_Homepage_Builder::enqueue_frontend_scripts();
    echo  \LottaFramework\Facades\Css::parse( apply_filters( 'yuki_filter_dynamic_css', [] ) ) ;
} );
/**
 * After lotta-framework boostrap
 */
do_action( 'yuki_after_lotta_framework_bootstrap' );