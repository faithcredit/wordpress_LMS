<?php

/**
 * Yuki dynamic css
 */
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Utils ;
/**
 * Enqueue global css variables
 */
function yuki_enqueue_global_vars( $defaultScheme = false )
{
    wp_register_style( 'yuki-dynamic-vars', false );
    wp_enqueue_style( 'yuki-dynamic-vars' );
    wp_add_inline_style( 'yuki-dynamic-vars', yuki_global_css_vars( $defaultScheme ) );
}

/**
 * Enqueue dynamic css for our theme
 */
function yuki_enqueue_dynamic_css()
{
    wp_register_style( 'yuki-preloader', false );
    wp_enqueue_style( 'yuki-preloader' );
    wp_add_inline_style( 'yuki-preloader', yuki_preloader_css() );
    wp_register_style( 'yuki-dynamic', false );
    wp_enqueue_style( 'yuki-dynamic' );
    wp_add_inline_style( 'yuki-dynamic', yuki_dynamic_css() );
}

/**
 * Enqueue dynamic css for our theme editor
 */
function yuki_enqueue_admin_dynamic_css()
{
    wp_register_style( 'yuki-admin-dynamic', false );
    wp_enqueue_style( 'yuki-admin-dynamic' );
    wp_add_inline_style( 'yuki-admin-dynamic', yuki_admin_dynamic_css() );
}

/**
 * Generate global css vars
 *
 * @return mixed
 */
function yuki_global_css_vars( $defaultScheme = false )
{
    $vars = [
        '--yuki-transparent' => 'rgba(0, 0, 0, 0)',
    ];
    if ( $defaultScheme ) {
        $vars = [
            '--yuki-transparent'    => 'rgba(0, 0, 0, 0)',
            '--yuki-primary-color'  => 'var(--yuki-light-primary-color)',
            '--yuki-primary-active' => 'var(--yuki-light-primary-active)',
            '--yuki-accent-color'   => 'var(--yuki-light-accent-color)',
            '--yuki-accent-active'  => 'var(--yuki-light-accent-active)',
            '--yuki-base-color'     => 'var(--yuki-light-base-color)',
            '--yuki-base-100'       => 'var(--yuki-light-base-100)',
            '--yuki-base-200'       => 'var(--yuki-light-base-200)',
            '--yuki-base-300'       => 'var(--yuki-light-base-300)',
        ];
    }
    foreach ( [ 'light', 'dark' ] as $scheme ) {
        /**
         * Palette
         */
        $colors = [
            "yuki_{$scheme}_primary_color" => [
            'default' => "yuki-{$scheme}-primary-color",
            'active'  => "yuki-{$scheme}-primary-active",
        ],
            "yuki_{$scheme}_accent_color"  => [
            'default' => "yuki-{$scheme}-accent-color",
            'active'  => "yuki-{$scheme}-accent-active",
        ],
            "yuki_{$scheme}_base_color"    => [
            'default' => "yuki-{$scheme}-base-color",
            '100'     => "yuki-{$scheme}-base-100",
            '200'     => "yuki-{$scheme}-base-200",
            '300'     => "yuki-{$scheme}-base-300",
        ],
        ];
        $palettes = Utils::array_path( CZ::getSettingArgs( "yuki_{$scheme}_color_palettes" ), 'options.palettes' );
        $palette = $palettes[CZ::get( "yuki_{$scheme}_color_palettes" )] ?? [];
        foreach ( $colors as $setting => $args ) {
            $color = CZ::get( $setting );
            foreach ( $args as $key => $var ) {
                
                if ( Utils::str_starts_with( $color[$key], 'var' ) && isset( $palette[$var] ) ) {
                    $vars['--' . $var] = $palette[$var];
                    continue;
                }
                
                $vars['--' . $var] = $color[$key];
            }
        }
    }
    $content_colors = [
        'yuki_content_base_color'     => [
        'initial' => 'yuki-content-base-color',
    ],
        'yuki_content_headings_color' => [
        'initial' => 'yuki-headings-color',
    ],
    ];
    foreach ( $content_colors as $setting => $args ) {
        $color = CZ::get( $setting );
        foreach ( $args as $key => $var ) {
            $vars['--' . $var] = $color[$key];
        }
    }
    return Css::parse( [
        ':root' => $vars,
    ] );
}

/**
 * @param $scope
 * @param array $css
 *
 * @return array|mixed
 */
function yuki_content_typography_css( $scope, $css = array() )
{
    $css[$scope] = array_merge( Css::typography( CZ::get( 'yuki_content_base_typography' ) ), $css[$scope] ?? [] );
    $css[$scope . ' .has-drop-cap::first-letter'] = array_merge( Css::typography( CZ::get( 'yuki_content_drop_cap_typography' ) ), $css[$scope . ' .has-drop-cap::first-letter'] ?? [] );
    return $css;
}

/**
 * Button css
 *
 * @return array
 */
function yuki_content_buttons_css()
{
    return array_merge(
        [
        '--yuki-button-height' => CZ::get( 'yuki_content_buttons_min_height' ),
    ],
        Css::shadow( CZ::get( 'yuki_content_buttons_shadow' ), '--yuki-button-shadow' ),
        Css::shadow( CZ::get( 'yuki_content_buttons_shadow_active' ), '--yuki-button-shadow-active' ),
        Css::typography( CZ::get( 'yuki_content_buttons_typography' ) ),
        Css::border( CZ::get( 'yuki_content_buttons_border' ), '--yuki-button-border' ),
        Css::dimensions( CZ::get( 'yuki_content_buttons_padding' ), '--yuki-button-padding' ),
        Css::dimensions( CZ::get( 'yuki_content_buttons_radius' ), '--yuki-button-radius' ),
        Css::colors( CZ::get( 'yuki_content_buttons_text_color' ), [
        'initial' => '--yuki-button-text-initial-color',
        'hover'   => '--yuki-button-text-hover-color',
    ] ),
        Css::colors( CZ::get( 'yuki_content_buttons_button_color' ), [
        'initial' => '--yuki-button-initial-color',
        'hover'   => '--yuki-button-hover-color',
    ] )
    );
}

/**
 * Preloader css
 *
 * @return mixed
 */
function yuki_preloader_css()
{
    if ( !CZ::checked( 'yuki_global_preloader' ) ) {
        return '';
    }
    $css = [
        '.yuki-preloader-wrap' => array_merge( [
        '--yuki-preloader-background' => 'var(--yuki-base-100)',
        '--yuki-preloader-primary'    => 'var(--yuki-primary-color)',
        '--yuki-preloader-accent'     => 'var(--yuki-accent-active)',
        'position'                    => 'fixed',
        'top'                         => '0',
        'left'                        => '0',
        'width'                       => '100%',
        'height'                      => '100%',
        'z-index'                     => '100000',
        'display'                     => 'flex',
        'align-items'                 => 'center',
        'background'                  => 'var(--yuki-preloader-background)',
    ], Css::colors( CZ::get( 'yuki_preloader_colors' ), [
        'background' => '--yuki-preloader-background',
        'accent'     => '--yuki-preloader-accent',
        'primary'    => '--yuki-preloader-primary',
    ] ) ),
    ];
    $preset = yuki_get_preloader( CZ::get( 'yuki_preloader_preset' ) );
    return Css::parse( array_merge( $css, $preset['css'] ) ) . Css::keyframes( $preset['keyframes'] );
}

/**
 * Generate dynamic css
 *
 * @return mixed
 */
function yuki_dynamic_css()
{
    $css = [];
    $is_woo_page = YUKI_WOOCOMMERCE_ACTIVE && (is_cart() || is_account_page() || is_checkout());
    $is_shop_page = YUKI_WOOCOMMERCE_ACTIVE && is_shop();
    $post_type = 'archive';
    if ( is_page() ) {
        $post_type = 'pages';
    }
    if ( is_single() ) {
        $post_type = 'single_post';
    }
    if ( is_front_page() && !is_home() ) {
        $post_type = 'homepage';
    }
    if ( yuki_is_woo_shop() ) {
        $post_type = 'store';
    }
    /**
     * Site container
     */
    $content_container_type = CZ::get( "yuki_{$post_type}_container_layout" ) ?? 'normal';
    $css['.yuki-container'] = [
        'padding-top'    => CZ::get( "yuki_{$post_type}_content_spacing" ),
        'padding-bottom' => CZ::get( "yuki_{$post_type}_content_spacing" ),
    ];
    /**
     * Site background
     */
    $css['.yuki-body'] = array_merge( Css::background( CZ::get( 'yuki_site_background' ) ), [
        '--yuki-max-w-content'  => ( $content_container_type === 'normal' ? 'auto' : CZ::get( 'yuki_' . $post_type . '_container_max_width' ) ),
        '--wp-admin-bar-height' => ( !is_admin_bar_showing() || is_customize_preview() ? [] : [
        'desktop' => '32px',
        'tablet'  => '32px',
        'mobile'  => '46px',
    ] ),
    ] );
    /**
     * Post card
     */
    
    if ( is_archive() || is_home() || is_search() ) {
        $css['.card-list'] = [
            '--card-gap'             => CZ::get( 'yuki_card_gap' ),
            '--card-thumbnail-width' => CZ::get( 'yuki_archive_image_width' ),
        ];
        $archive_layout = CZ::get( 'yuki_archive_layout' );
        
        if ( $archive_layout === 'archive-grid' || $archive_layout === 'archive-masonry' ) {
            $card_width = [];
            foreach ( CZ::get( 'yuki_archive_columns' ) as $device => $columns ) {
                $card_width[$device] = sprintf( "%.2f", substr( sprintf( "%.3f", 100 / (int) $columns ), 0, -1 ) ) . '%';
            }
            $css['.card-wrapper'] = [
                'width' => $card_width,
            ];
        }
        
        $css['.card'] = array_merge(
            Css::background( CZ::get( 'yuki_card_background' ) ),
            Css::shadow( CZ::get( 'yuki_card_shadow' ) ),
            Css::border( CZ::get( 'yuki_card_border' ) ),
            Css::dimensions( CZ::get( 'yuki_card_radius' ), 'border-radius' ),
            [
            'text-align'               => CZ::get( 'yuki_card_content_alignment' ),
            'justify-content'          => CZ::get( 'yuki_card_vertical_alignment' ),
            '--card-content-spacing'   => CZ::get( 'yuki_card_content_spacing' ),
            '--card-thumbnail-spacing' => CZ::get( 'yuki_card_thumbnail_spacing' ),
        ]
        );
    }
    
    /**
     * Post elements
     */
    $post_elements_scope = [
        'entry'         => [
        'condition' => is_archive() || is_home() || is_search(),
        'elements'  => [
        'title',
        'metas',
        'categories',
        'tags',
        'excerpt',
        'thumbnail',
        'divider',
        'read-more'
    ],
        'selector'  => '.card',
    ],
        'post'          => [
        'condition' => is_single(),
        'elements'  => [
        'title',
        'metas',
        'categories',
        'tags'
    ],
        'selector'  => '.yuki-article-header',
    ],
        'page'          => [
        'condition' => is_page(),
        'elements'  => [
        'title',
        'metas',
        'categories',
        'tags'
    ],
        'selector'  => '.yuki-article-header',
    ],
        'related_posts' => [
        'condition' => is_single() && CZ::checked( 'yuki_post_related_posts' ),
        'elements'  => [
        'title',
        'metas',
        'categories',
        'tags',
        'excerpt',
        'thumbnail',
        'divider',
        'read-more'
    ],
        'selector'  => '.yuki-related-posts-wrap .card',
    ],
    ];
    foreach ( $post_elements_scope as $id => $scope ) {
        if ( !$scope['condition'] ) {
            continue;
        }
        $scope_selector = $scope['selector'];
        $css = array_merge( $css, yuki_post_elements_css( $scope_selector, $id, $scope['elements'] ) );
    }
    /**
     * Archive title
     */
    $css['.yuki-archive-header'] = array_merge( [
        'text-align' => CZ::get( 'yuki_archive_header_alignment' ),
    ], Css::background( CZ::get( 'yuki_archive_header_background' ) ) );
    $css['.yuki-archive-header .container'] = Css::dimensions( CZ::get( 'yuki_archive_header_padding' ), 'padding' );
    $css['.yuki-archive-header .archive-title'] = array_merge( Css::typography( CZ::get( 'yuki_archive_title_typography' ) ), Css::colors( CZ::get( 'yuki_archive_title_color' ), [
        'initial' => 'color',
    ] ) );
    $css['.yuki-archive-header .archive-description'] = array_merge( Css::typography( CZ::get( 'yuki_archive_description_typography' ) ), Css::colors( CZ::get( 'yuki_archive_description_color' ), [
        'initial' => 'color',
    ] ) );
    $css['.yuki-archive-header::after'] = array_merge( [
        'opacity' => CZ::get( 'yuki_archive_header_overlay_opacity' ),
    ], Css::background( CZ::get( 'yuki_archive_header_overlay' ) ) );
    /**
     * Posts Pagination
     */
    
    if ( CZ::checked( 'yuki_archive_pagination_section' ) ) {
        $pagination_type = CZ::get( 'yuki_pagination_type' );
        $pagination_css = [];
        
        if ( $pagination_type === 'numbered' || $pagination_type === 'prev-next' ) {
            $button_color = CZ::get( 'yuki_pagination_button_color' );
            $pagination_css = array_merge( Css::border( CZ::get( 'yuki_pagination_button_border' ), '--yuki-pagination-button-border' ), [
                '--yuki-pagination-button-radius' => CZ::get( 'yuki_pagination_button_radius' ),
                '--yuki-pagination-initial-color' => $button_color['initial'],
                '--yuki-pagination-active-color'  => $button_color['active'],
                '--yuki-pagination-accent-color'  => $button_color['accent'],
            ] );
        }
        
        $css['.yuki-pagination'] = array_merge( $pagination_css, Css::typography( CZ::get( 'yuki_pagination_typography' ) ), [
            'justify-content' => CZ::get( 'yuki_pagination_alignment' ),
        ] );
    }
    
    /**
     * Sidebar
     */
    $widgets_style = CZ::get( 'yuki_global_sidebar_widgets-style' );
    $widgets_css = array_merge(
        Css::background( CZ::get( 'yuki_global_sidebar_widgets-background' ) ),
        Css::border( CZ::get( 'yuki_global_sidebar_widgets-border' ) ),
        Css::shadow( CZ::get( 'yuki_global_sidebar_widgets-shadow' ) ),
        Css::dimensions( CZ::get( 'yuki_global_sidebar_widgets-padding' ), 'padding' ),
        Css::dimensions( CZ::get( 'yuki_global_sidebar_widgets-radius' ), 'border-radius' )
    );
    if ( $widgets_style === 'style-1' ) {
        $css[".yuki-sidebar .yuki-widget"] = $widgets_css;
    }
    $css[".yuki-sidebar"] = array_merge(
        ( $widgets_style === 'style-2' ? $widgets_css : [] ),
        Css::typography( CZ::get( 'yuki_global_sidebar_content-typography' ) ),
        Css::colors( CZ::get( 'yuki_global_sidebar_content-color' ), [
        'text'    => '--yuki-widgets-text-color',
        'initial' => '--yuki-widgets-link-initial',
        'hover'   => '--yuki-widgets-link-hover',
    ] ),
        [
        'text-align'             => CZ::get( 'yuki_global_sidebar_content-alignment' ),
        '--yuki-sidebar-width'   => CZ::get( 'yuki_global_sidebar_width' ) ?? '27%',
        '--yuki-sidebar-gap'     => CZ::get( 'yuki_global_sidebar_gap' ) ?? '24px',
        '--yuki-widgets-spacing' => CZ::get( 'yuki_global_sidebar_widgets-spacing' ),
    ]
    );
    $css[".yuki-sidebar .widget-title"] = array_merge( Css::typography( CZ::get( 'yuki_global_sidebar_title-typography' ) ), Css::colors( CZ::get( 'yuki_global_sidebar_title-color' ), [
        'initial'   => 'color',
        'indicator' => '--yuki-heading-indicator',
    ] ) );
    /**
     * Single post & page
     */
    
    if ( is_single() || is_page() ) {
        $article_type = ( is_page() ? 'page' : 'post' );
        $prefix = 'yuki_' . $article_type;
        // Article header
        $css['.yuki-article-header'] = array_merge( Css::dimensions( CZ::get( "{$prefix}_header_spacing" ), 'padding' ), [
            'text-align' => CZ::get( "{$prefix}_header_alignment" ),
        ] );
        // Article header background
        $css['.yuki-article-header-background::after'] = Css::background( CZ::get( "{$prefix}_featured_image_background_overlay" ) );
        $css['.yuki-article-header-background'] = array_merge( Css::dimensions( CZ::get( "{$prefix}_featured_image_background_spacing" ), 'padding' ), Css::colors( CZ::get( "{$prefix}_featured_image_elements_override" ), [
            'override' => '--yuki-article-header-override',
        ] ), [
            'position'            => 'relative',
            'background-position' => 'center',
            'background-size'     => 'cover',
            'background-repeat'   => 'no-repeat',
        ] );
        // Article thumbnail
        $css['.article-featured-image'] = Css::dimensions( CZ::get( "{$prefix}_featured_image_spacing" ), 'padding' );
        $css['.article-featured-image img'] = array_merge( [
            'height' => CZ::get( "{$prefix}_featured_image_height" ),
        ], Css::shadow( CZ::get( "{$prefix}_featured_image_shadow" ) ), Css::dimensions( CZ::get( "{$prefix}_featured_image_radius" ), 'border-radius' ) );
        // Article typography
        $css = yuki_content_typography_css( '.yuki-article-content', $css );
        // Article links
        $css = yuki_content_link_style_preset( '.yuki-article-content a', CZ::get( 'yuki_content_link_style' ), $css );
        // Article button
        $button_selectors = [
            // widgets
            '.wp-block-search__button',
            '.wc-block-product-search__button',
            // article
            '.yuki-article-content .wp-block-button',
            '.yuki-article-content button',
            '.prose-yuki .wp-block-button',
            '.prose-yuki button',
            '[type="submit"]',
        ];
        $css[implode( ',', $button_selectors )] = yuki_content_buttons_css();
        // Share box
        
        if ( CZ::checked( 'yuki_' . $article_type . '_share_box' ) ) {
            $css['.yuki-' . $article_type . '-socials'] = array_merge( [
                '--yuki-social-icons-size'    => CZ::get( 'yuki_' . $article_type . '_share_box_icons_size' ),
                '--yuki-social-icons-spacing' => CZ::get( 'yuki_' . $article_type . '_share_box_icons_spacing' ),
            ], Css::dimensions( CZ::get( 'yuki_' . $article_type . '_share_box_padding' ), 'padding' ), Css::dimensions( CZ::get( 'yuki_' . $article_type . '_share_box_margin' ), 'margin' ) );
            $css['.yuki-' . $article_type . '-socials .yuki-social-link'] = array_merge( Css::colors( CZ::get( 'yuki_' . $article_type . '_share_box_icons_color' ), [
                'initial' => '--yuki-social-icon-initial-color',
                'hover'   => '--yuki-social-icon-hover-color',
            ] ), Css::colors( CZ::get( 'yuki_' . $article_type . '_share_box_icons_bg_color' ), [
                'initial' => '--yuki-social-bg-initial-color',
                'hover'   => '--yuki-social-bg-hover-color',
            ] ), Css::colors( CZ::get( 'yuki_' . $article_type . '_share_box_icons_border_color' ), [
                'initial' => '--yuki-social-border-initial-color',
                'hover'   => '--yuki-social-border-hover-color',
            ] ) );
        }
        
        // Post navigation
        if ( is_single() ) {
            $css['.yuki-post-navigation'] = array_merge(
                Css::dimensions( CZ::get( 'yuki_post_navigation_padding' ), 'padding' ),
                Css::dimensions( CZ::get( 'yuki_post_navigation_margin' ), 'margin' ),
                Css::dimensions( CZ::get( 'yuki_post_navigation_thumb_radius' ), '--yuki-navigation-thumb-radius' ),
                Css::border( CZ::get( 'yuki_post_navigation_border_top' ), 'border-top' ),
                Css::border( CZ::get( 'yuki_post_navigation_border_bottom' ), 'border-bottom' ),
                Css::colors( CZ::get( 'yuki_post_navigation_text_color' ), [
                'initial' => '--yuki-navigation-initial-color',
                'hover'   => '--yuki-navigation-hover-color',
            ] )
            );
        }
        // Post comments
        $css['.yuki-comments-area'] = array_merge(
            Css::typography( CZ::get( 'yuki_content_comments_typography' ) ),
            Css::colors( CZ::get( 'yuki_content_comments_text_color' ), [
            'initial' => '--yuki-comments-initial-color',
            'hover'   => '--yuki-comments-hover-color',
        ] ),
            Css::colors( CZ::get( 'yuki_content_comments_form_color' ), [
            'background' => '--yuki-form-background-color',
            'border'     => '--yuki-form-border-color',
            'active'     => '--yuki-form-active-color',
        ] ),
            Css::dimensions( CZ::get( 'yuki_content_comments_padding' ), 'padding' ),
            Css::dimensions( CZ::get( 'yuki_content_comments_margin' ), 'margin' ),
            Css::border( CZ::get( 'yuki_content_comments_border_top' ), 'border-top' ),
            Css::border( CZ::get( 'yuki_content_comments_border_bottom' ), 'border-bottom' )
        );
        // Related posts
        
        if ( CZ::checked( 'yuki_post_related_posts' ) ) {
            $css['.yuki-related-posts-list'] = [
                '--card-gap' => CZ::get( 'yuki_related_posts_grid_items_gap' ),
            ];
            $archive_layout = CZ::get( 'yuki_archive_layout' );
            $card_width = [];
            foreach ( CZ::get( 'yuki_related_posts_grid_columns' ) as $device => $columns ) {
                $card_width[$device] = sprintf( "%.2f", substr( sprintf( "%.3f", 100 / (int) $columns ), 0, -1 ) ) . '%';
            }
            $css['.yuki-related-posts-list .card-wrapper'] = [
                'width' => $card_width,
            ];
            $css['.yuki-related-posts-list .card'] = array_merge(
                Css::background( CZ::get( 'yuki_related_posts_card_background' ) ),
                Css::shadow( CZ::get( 'yuki_related_posts_card_shadow' ) ),
                Css::border( CZ::get( 'yuki_related_posts_card_border' ) ),
                Css::dimensions( CZ::get( 'yuki_related_posts_card_radius' ), 'border-radius' ),
                [
                'text-align'               => CZ::get( 'yuki_related_posts_card_content_alignment' ),
                'justify-content'          => CZ::get( 'yuki_related_posts_card_vertical_alignment' ),
                '--card-content-spacing'   => CZ::get( 'yuki_related_posts_card_content_spacing' ),
                '--card-thumbnail-spacing' => CZ::get( 'yuki_related_posts_card_thumbnail_spacing' ),
            ]
            );
        }
    
    }
    
    /**
     * WooCommerce
     */
    
    if ( YUKI_WOOCOMMERCE_ACTIVE ) {
        // WooCommerce button
        $woo_buttons = [
            '.woocommerce #respond input#submit',
            '.woocommerce #respond input#submit.alt',
            '.woocommerce .page-content .widget_price_filter .button',
            '.woocommerce .page-content .woocommerce-message .button',
            '.woocommerce .page-content a.button.alt',
            '.woocommerce .page-content button.button.alt',
            '.woocommerce .page-content .woocommerce-message .button',
            '.woocommerce .woocommerce-page .page-content .woocommerce-message .button',
            '.woocommerce a.button',
            '.woocommerce a.button.alt',
            '.woocommerce button.button',
            '.woocommerce button.button.alt',
            '.woocommerce input.button',
            '.woocommerce input.button.alt'
        ];
        $css[implode( ',', $woo_buttons )] = yuki_content_buttons_css();
        // form
        $css['.woocommerce form'] = array_merge( Css::typography( CZ::get( 'yuki_store_form_typography' ) ), Css::colors( CZ::get( 'yuki_store_form_color' ), [
            'background' => '--yuki-form-background-color',
            'border'     => '--yuki-form-border-color',
            'active'     => '--yuki-form-active-color',
        ] ) );
        // shop page
        if ( $is_shop_page ) {
            // pagination
            $css['.woocommerce-pagination .page-numbers, nav.woocommerce-pagination .page-numbers'] = array_merge(
                Css::typography( CZ::get( 'yuki_pagination_typography' ) ),
                Css::border( CZ::get( 'yuki_pagination_button_border' ), '--yuki-pagination-button-border' ),
                Css::colors( CZ::get( 'yuki_pagination_button_color' ), [
                'initial' => '--yuki-pagination-initial-color',
                'active'  => '--yuki-pagination-active-color',
                'accent'  => '--yuki-pagination-accent-color',
            ] ),
                [
                '--yuki-pagination-button-radius' => CZ::get( 'yuki_pagination_button_radius' ),
            ]
            );
        }
    }
    
    /**
     * To top button
     */
    if ( CZ::checked( 'yuki_global_scroll_to_top' ) ) {
        $css['.yuki-to-top'] = array_merge(
            Css::shadow( CZ::get( 'yuki_to_top_shadow' ) ),
            Css::dimensions( CZ::get( 'yuki_to_top_radius' ), 'border-radius' ),
            //			Css::dimensions( CZ::get( 'yuki_to_top_padding' ), 'padding' ),
            Css::colors( CZ::get( 'yuki_to_top_icon_color' ), [
                'initial' => '--yuki-to-top-icon-initial',
                'hover'   => '--yuki-to-top-icon-hover',
            ] ),
            Css::colors( CZ::get( 'yuki_to_top_background' ), [
                'initial' => '--yuki-to-top-background-initial',
                'hover'   => '--yuki-to-top-background-hover',
            ] ),
            [
                '--yuki-to-top-icon-size'     => CZ::get( 'yuki_to_top_icon_size' ),
                '--yuki-to-top-bottom-offset' => CZ::get( 'yuki_to_top_bottom_offset' ),
                '--yuki-to-top-side-offset'   => CZ::get( 'yuki_to_top_side_offset' ),
            ]
        );
    }
    // Forms
    $css['form, .yuki-form, [type="submit"]'] = Css::typography( CZ::get( 'yuki_content_form_typography' ) );
    $form_presets = yuki_form_style_presets();
    $css[implode( ',', array_keys( $form_presets ) )] = array_merge( Css::colors( CZ::get( 'yuki_content_form_color' ), [
        'background' => '--yuki-form-background-color',
        'border'     => '--yuki-form-border-color',
        'active'     => '--yuki-form-active-color',
    ] ) );
    foreach ( $form_presets as $selector => $preset ) {
        $css[$selector] = $preset;
    }
    $css = apply_filters( 'yuki_filter_dynamic_css', $css );
    return Css::parse( $css );
}

/**
 * Generate dynamic css for admin
 *
 * @return mixed
 */
function yuki_admin_dynamic_css()
{
    $css = [];
    $css['.editor-styles-wrapper .wp-block-button'] = yuki_content_buttons_css();
    return Css::parse( apply_filters( 'yuki_filter_admin_dynamic_css', yuki_content_typography_css( '.editor-styles-wrapper', $css ) ) );
}
