<?php

/**
 * Yuki Theme Customizer
 *
 * @package Yuki
 */
use  LottaFramework\Facades\CZ ;
// customizer elements
require get_template_directory() . '/inc/elements/class-logo-element.php';
require get_template_directory() . '/inc/elements/class-menu-element.php';
require get_template_directory() . '/inc/elements/class-button-element.php';
require get_template_directory() . '/inc/elements/class-divider-element.php';
require get_template_directory() . '/inc/elements/class-socials-element.php';
require get_template_directory() . '/inc/elements/class-search-element.php';
require get_template_directory() . '/inc/elements/class-trigger-element.php';
require get_template_directory() . '/inc/elements/class-collapsable-menu-element.php';
require get_template_directory() . '/inc/elements/class-widgets-element.php';
require get_template_directory() . '/inc/elements/class-theme-switch-element.php';
require get_template_directory() . '/inc/elements/class-copyright-element.php';
require get_template_directory() . '/inc/elements/class-cart-element.php';
// customizer builder
require get_template_directory() . '/inc/builder/class-builder-column.php';
require get_template_directory() . '/inc/builder/class-header-column.php';
require get_template_directory() . '/inc/builder/class-header-row.php';
require get_template_directory() . '/inc/builder/class-footer-column.php';
require get_template_directory() . '/inc/builder/class-footer-row.php';
require get_template_directory() . '/inc/builder/class-modal-row.php';
require get_template_directory() . '/inc/builder/class-header-builder.php';
require get_template_directory() . '/inc/builder/class-footer-builder.php';
// homepage customizer elements
require get_template_directory() . '/inc/homepage/class-magazine-layout.php';
require get_template_directory() . '/inc/homepage/class-posts-base-element.php';
require get_template_directory() . '/inc/homepage/elements/class-heading-element.php';
require get_template_directory() . '/inc/homepage/elements/class-text-element.php';
require get_template_directory() . '/inc/homepage/elements/class-hero-element.php';
require get_template_directory() . '/inc/homepage/elements/class-features-element.php';
require get_template_directory() . '/inc/homepage/elements/class-reviews-element.php';
require get_template_directory() . '/inc/homepage/elements/class-magazine-element.php';
require get_template_directory() . '/inc/homepage/elements/class-posts-grid-element.php';
require get_template_directory() . '/inc/homepage/elements/class-posts-slider-element.php';
require get_template_directory() . '/inc/homepage/elements/class-homepage-widgets-element.php';
// homepage customizer builder
require get_template_directory() . '/inc/homepage/class-homepage-row.php';
require get_template_directory() . '/inc/homepage/class-homepage-column.php';
require get_template_directory() . '/inc/homepage/class-homepage-builder.php';
// customizer sections
require get_template_directory() . '/inc/customizer/class-header-section.php';
require get_template_directory() . '/inc/customizer/class-footer-section.php';
require get_template_directory() . '/inc/customizer/class-homepage-section.php';
require get_template_directory() . '/inc/customizer/class-colors-section.php';
require get_template_directory() . '/inc/customizer/class-global-section.php';
require get_template_directory() . '/inc/customizer/class-archive-section.php';
require get_template_directory() . '/inc/customizer/class-content-section.php';
require get_template_directory() . '/inc/customizer/class-single-post-section.php';
require get_template_directory() . '/inc/customizer/class-pages-section.php';
require get_template_directory() . '/inc/customizer/class-store-notice-section.php';
require get_template_directory() . '/inc/customizer/class-store-catalog-section.php';
/**
 * Theme customizer register
 *
 * @param WP_Customize_Manager|null $wp_customize Theme Customizer object.
 */
function yuki_customize_register( $wp_customize )
{
    
    if ( !$wp_customize instanceof WP_Customize_Manager ) {
        $wp_customize = null;
    } else {
        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        
        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial( 'blogname', array(
                'selector'        => '.site-title a',
                'render_callback' => function () {
                echo  esc_html( get_bloginfo( 'name' ) ) ;
            },
            ) );
            $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                'selector'        => '.site-tagline',
                'render_callback' => function () {
                echo  esc_html( get_bloginfo( 'description' ) ) ;
            },
            ) );
        }
    
    }
    
    CZ::addSection( $wp_customize, new Yuki_Header_Section( 'yuki_header', __( 'Header Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Footer_Section( 'yuki_footer', __( 'Footer Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Homepage_Section( 'static_front_page', __( 'Homepage Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Global_Section( 'yuki_global', __( 'Global Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Colors_Section( 'yuki_colors', __( 'Colors Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Archive_Section( 'yuki_archive', __( 'Archive Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Content_Section( 'yuki_content', __( 'Content Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Single_Post_Section( 'yuki_single_post', __( 'Single Post Settings', 'yuki' ) ) );
    CZ::addSection( $wp_customize, new Yuki_Pages_Section( 'yuki_pages', __( 'Pages Settings', 'yuki' ) ) );
    
    if ( YUKI_WOOCOMMERCE_ACTIVE ) {
        
        if ( $wp_customize ) {
            CZ::changeObject(
                $wp_customize,
                'panel',
                'woocommerce',
                'priority',
                20
            );
            // Remove default catalog columns
            $wp_customize->remove_control( 'woocommerce_catalog_columns' );
        }
        
        CZ::addSection( $wp_customize, new Yuki_Store_Notice_Section(
            'woocommerce_store_notice',
            __( 'Store Notice', 'yuki' ),
            0,
            'woocommerce'
        ) );
        CZ::addSection( $wp_customize, new Yuki_Store_Catalog_Section(
            'woocommerce_product_catalog',
            __( 'Product Catalog', 'yuki' ),
            0,
            'woocommerce'
        ) );
    }

}

add_action( 'customize_register', 'yuki_customize_register' );
add_action( 'yuki_after_lotta_framework_bootstrap', 'yuki_customize_register' );
if ( !function_exists( 'yuki_customizer_scripts' ) ) {
    /**
     * Enqueue customizer scripts
     */
    function yuki_customizer_scripts()
    {
        yuki_enqueue_global_vars( true );
    }

}
add_action( 'customize_controls_enqueue_scripts', 'yuki_customizer_scripts' );
/**
 * Change customizer localize object
 *
 * @param $localize
 *
 * @return mixed
 */
function yuki_customizer_localize( $localize )
{
    $localize['customizer']['colorPicker']['swatches'] = [
        'var(--yuki-primary-color)',
        'var(--yuki-primary-active)',
        'var(--yuki-accent-color)',
        'var(--yuki-accent-active)',
        'var(--yuki-base-300)',
        'var(--yuki-base-200)',
        'var(--yuki-base-100)',
        'var(--yuki-base-color)'
    ];
    return $localize;
}

add_filter( 'lotta_filter_customizer_js_localize', 'yuki_customizer_localize' );