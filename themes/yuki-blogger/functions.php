<?php
/**
 * Theme bootstrap
 *
 * @package Yuki Blogger
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'YUKI_BLOGGER_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'YUKI_BLOGGER_VERSION', '1.0.1' );
}

if ( ! defined( 'YUKI_BLOGGER_PATH' ) ) {
	define( 'YUKI_BLOGGER_PATH', trailingslashit( get_stylesheet_directory() ) );
}

if ( ! defined( 'YUKI_BLOGGER_URL' ) ) {
	define( 'YUKI_BLOGGER_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}

if ( ! defined( 'YUKI_BLOGGER_ASSETS_URL' ) ) {
	define( 'YUKI_BLOGGER_ASSETS_URL', YUKI_BLOGGER_URL . 'assets/' );
}

if ( ! function_exists( 'yuki_blogger_image_url' ) ) {
	/**
	 * Get image url
	 *
	 * @param $image
	 *
	 * @return string
	 */
	function yuki_blogger_image_url( $image ) {
		return YUKI_BLOGGER_ASSETS_URL . 'images/' . $image;
	}
}

if ( ! function_exists( 'yuki_blogger_return_yes' ) ) {
	function yuki_blogger_return_yes() {
		return 'yes';
	}
}

if ( ! function_exists( 'yuki_blogger_return_no' ) ) {
	function yuki_blogger_return_no() {
		return 'no';
	}
}

if ( ! function_exists( 'yuki_blogger_starter_content' ) ) {
	/**
	 * Change starter content
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	function yuki_blogger_starter_content( $content ) {
		return array(
			'widgets'   => $content['widgets'],
			'posts'     => array(
				'home' => array(
					'post_type'    => 'page',
					'post_title'   => __( 'Home', 'yuki-blogger' ),
					'post_content' => '',
				),
				'about',
				'contact',
				'blog',
			),
			'nav_menus' => array(
				'yuki_header_el_menu_1' => array(
					'name'  => __( 'Top Bar Menu', 'yuki-blogger' ),
					'items' => array(
						'page_about',
						'page_contact',
						'page_blog',
						'post_news',
					),
				),
				'yuki_header_el_menu_2' => array(
					'name'  => __( 'Primary Menu', 'yuki-blogger' ),
					'items' => array(
						'link_home',
						'page_about',
						'page_contact',
						'page_blog',
					),
				),
				'yuki_footer_el_menu'   => array(
					'name'  => __( 'Footer Menu', 'yuki-blogger' ),
					'items' => array(
						'link_home',
						'page_about',
						'page_contact',
						'page_blog',
					),
				),
			),
			'options'   => array(
				'show_on_front' => 'posts',
			),
		);
	}
}
add_filter( 'yuki_starter_content', 'yuki_blogger_starter_content' );

//
// Featured image
//

if ( ! function_exists( 'yuki_blogger_fallback_image' ) ) {
	function yuki_blogger_fallback_image() {
		return [
			'url' => yuki_blogger_image_url( 'fallback-image.png' )
		];
	}
}
add_filter( 'yuki_post_featured_image_fallback_default_value', 'yuki_blogger_fallback_image' );

if ( ! function_exists( 'yuki_blogger_featured_image_position' ) ) {
	function yuki_blogger_featured_image_position() {
		return 'below';
	}
}
add_filter( 'yuki_post_featured_image_position_default_value', 'yuki_blogger_featured_image_position' );
add_filter( 'yuki_page_featured_image_position_default_value', 'yuki_blogger_featured_image_position' );

//
// Footer elements
//

if ( ! function_exists( 'yuki_blogger_footer_middle_row_elements' ) ) {
	/**
	 * Change middle footer row default elements
	 *
	 * @return array[]
	 */
	function yuki_blogger_footer_middle_row_elements() {
		return [
			[
				'elements' => [],
				'settings' => [
					'width' => [ 'desktop' => '25%', 'tablet' => '50%', 'mobile' => '100%' ],
				],
			],
			[
				'elements' => [],
				'settings' => [
					'width' => [ 'desktop' => '25%', 'tablet' => '50%', 'mobile' => '100%' ],
				],
			],
			[
				'elements' => [],
				'settings' => [
					'width' => [ 'desktop' => '25%', 'tablet' => '50%', 'mobile' => '100%' ],
				],
			],
			[
				'elements' => [],
				'settings' => [
					'width' => [ 'desktop' => '25%', 'tablet' => '50%', 'mobile' => '100%' ],
				],
			]
		];
	}
}
add_filter( 'yuki_footer_middle_row_default_value', 'yuki_blogger_footer_middle_row_elements' );

//
// Header top row
//
if ( ! function_exists( 'yuki_blogger_header_top_row_elements' ) ) {
	function yuki_blogger_header_top_row_elements() {
		return [
			'desktop' => [
				[
					'elements' => [],
					'settings' => [ 'width' => '70%' ]
				],
				[
					'elements' => [],
					'settings' => [ 'width' => '30%', 'justify-content' => 'flex-end' ]
				],
			],
			'mobile'  => [
				[
					'elements' => [],
					'settings' => [ 'width' => '100%', 'justify-content' => 'center' ]
				],
			],
		];
	}
}
add_filter( 'yuki_header_top_row_default_value', 'yuki_blogger_header_top_row_elements' );

if ( ! function_exists( 'yuki_blogger_header_top_row_height' ) ) {
	function yuki_blogger_header_top_row_height() {
		return '40px';
	}
}
add_filter( 'yuki_header_top_bar_row_min_height_default_value', 'yuki_blogger_header_top_row_height' );

//
// Header middle row
//

if ( ! function_exists( 'yuki_blogger_header_primary_row_elements' ) ) {
	function yuki_blogger_header_primary_row_elements() {
		return [
			'desktop' => [
				[
					'elements' => [ 'logo' ],
					'settings' => [ 'width' => '100%', 'justify-content' => 'center' ]
				],
			],
			'mobile'  => [
				[
					'elements' => [ 'logo' ],
					'settings' => [ 'width' => '100%', 'justify-content' => 'center' ]
				],
			],
		];
	}
}
add_filter( 'yuki_header_primary_row_default_value', 'yuki_blogger_header_primary_row_elements' );

if ( ! function_exists( 'yuki_blogger_primary_navbar_row_height' ) ) {
	function yuki_blogger_primary_navbar_row_height() {
		return '240px';
	}
}
add_filter( 'yuki_header_primary_navbar_row_min_height_default_value', 'yuki_blogger_primary_navbar_row_height' );

if ( ! function_exists( 'yuki_blogger_primary_navbar_row_background' ) ) {
	function yuki_blogger_primary_navbar_row_background() {
		return [
			'type'  => 'image',
			'color' => 'var(--yuki-accent-color)',
			'image' => [
				'size'   => 'cover',
				'repeat' => 'no-repeat',
				'source' => [
					'x'   => 0.5,
					'y'   => 0.5,
					'url' => yuki_blogger_image_url( 'hero-background.png' ),
				]
			]
		];
	}
}
add_filter( 'yuki_header_primary_navbar_row_background_default_value', 'yuki_blogger_primary_navbar_row_background' );

if ( ! function_exists( 'yuki_blogger_primary_navbar_row_border_bottom' ) ) {
	function yuki_blogger_primary_navbar_row_border_bottom() {
		return [
			'style'   => 'none',
			'width'   => 1,
			'color'   => 'var(--yuki-base-200)',
			'hover'   => '',
			'inherit' => false,
		];
	}
}
add_filter( 'yuki_header_primary_navbar_row_border_bottom_default_value', 'yuki_blogger_primary_navbar_row_border_bottom' );

// overlay
//add_filter( 'yuki_header_primary_navbar_row_overlay_default_value', 'yuki_blogger_return_yes' );

if ( ! function_exists( 'yuki_blogger_primary_navbar_row_overlay_opacity' ) ) {
	function yuki_blogger_primary_navbar_row_overlay_opacity() {
		return 0.6;
	}
}
add_filter( 'yuki_header_primary_navbar_row_overlay_opacity_default_value', 'yuki_blogger_primary_navbar_row_overlay_opacity' );

if ( ! function_exists( 'yuki_blogger_primary_navbar_row_overlay_background' ) ) {
	function yuki_blogger_primary_navbar_row_overlay_background() {
		return [
			'type'  => 'color',
			'color' => 'var(--yuki-base-color)',
		];
	}
}
add_filter( 'yuki_header_primary_navbar_row_overlay_background_default_value', 'yuki_blogger_primary_navbar_row_overlay_background' );

//
// Header bottom row
//
if ( ! function_exists( 'yuki_blogger_header_bottom_row_elements' ) ) {
	function yuki_blogger_header_bottom_row_elements() {
		return [
			'desktop' => [
				[
					'elements' => [ 'trigger' ],
					'settings' => [ 'width' => '20%' ]
				],
				[
					'elements' => [ 'menu-2' ],
					'settings' => [ 'width' => '60%', 'justify-content' => 'center' ]
				],
				[
					'elements' => [ 'socials', 'theme-switch', 'search' ],
					'settings' => [ 'width' => '20%', 'justify-content' => 'flex-end' ]
				],
			],
			'mobile'  => [
				[
					'elements' => [ 'trigger' ],
					'settings' => [ 'width' => '20%' ]
				],
				[
					'elements' => [ 'socials' ],
					'settings' => [ 'width' => '60%', 'justify-content' => 'center' ]
				],
				[
					'elements' => [ 'theme-switch', 'search' ],
					'settings' => [ 'width' => '20%', 'justify-content' => 'flex-end' ]
				],
			],
		];
	}
}
add_filter( 'yuki_header_bottom_row_default_value', 'yuki_blogger_header_bottom_row_elements' );

if ( ! function_exists( 'yuki_blogger_bottom_row_height' ) ) {
	function yuki_blogger_bottom_row_height() {
		return '60px';
	}
}
add_filter( 'yuki_header_bottom_row_row_min_height_default_value', 'yuki_blogger_bottom_row_height' );

if ( ! function_exists( 'yuki_blogger_bottom_row_shadow' ) ) {
	function yuki_blogger_bottom_row_shadow() {
		return [
			'enable'     => 'yes',
			'horizontal' => '0px',
			'vertical'   => '2px',
			'blur'       => '10px',
			'spread'     => '0px',
			'color'      => 'rgba(44, 62, 80, 0.1)',
		];
	}
}
add_filter( 'yuki_header_bottom_row_row_shadow_default_value', 'yuki_blogger_bottom_row_shadow' );

if ( ! function_exists( 'yuki_blogger_bottom_row_border_top' ) ) {
	function yuki_blogger_bottom_row_border_top() {
		return [
			'style'   => 'solid',
			'width'   => 4,
			'color'   => 'var(--yuki-primary-color)',
			'hover'   => '',
			'inherit' => false,
		];
	}
}
add_filter( 'yuki_header_bottom_row_row_border_top_default_value', 'yuki_blogger_bottom_row_border_top' );

//
// Canvas area
//
if ( ! function_exists( 'yuki_blogger_canvas_drawer_placement' ) ) {
	function yuki_blogger_canvas_drawer_placement() {
		return 'left';
	}
}
add_filter( 'yuki_canvas_drawer_placement_default_value', 'yuki_blogger_canvas_drawer_placement' );

//
// Header socials element
//
if ( ! function_exists( 'yuki_blogger_socials_icons_color_type' ) ) {
	function yuki_blogger_socials_icons_color_type() {
		return 'custom';
	}
}
add_filter( 'yuki_header_el_socials_icons_color_type_default_value', 'yuki_blogger_socials_icons_color_type' );

//
// Header logo element
//

add_filter( 'yuki_header_el_logo_enable_site_tagline_default_value', 'yuki_blogger_return_yes' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_content_alignment' ) ) {
	function yuki_blogger_header_el_logo_content_alignment() {
		return 'center';
	}
}
add_filter( 'yuki_header_el_logo_content_alignment_default_value', 'yuki_blogger_header_el_logo_content_alignment' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_position' ) ) {
	function yuki_blogger_header_el_logo_position() {
		return 'top';
	}
}
add_filter( 'yuki_header_el_logo_position_default_value', 'yuki_blogger_header_el_logo_position' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_site_title_color' ) ) {
	function yuki_blogger_header_el_logo_site_title_color() {
		return [
			'initial' => '#000000',
			'hover'   => '#000000',
		];
	}
}
add_filter( 'yuki_header_el_logo_site_title_color_default_value', 'yuki_blogger_header_el_logo_site_title_color' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_site_title_typography' ) ) {
	function yuki_blogger_header_el_logo_site_title_typography() {
		return [
			'family'        => 'inherit',
			'fontSize'      => '32px',
			'variant'       => '500',
			'lineHeight'    => '1.7',
			'textTransform' => 'uppercase',
		];
	}
}
add_filter( 'yuki_header_el_logo_site_title_typography_default_value', 'yuki_blogger_header_el_logo_site_title_typography' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_site_tagline_color' ) ) {
	function yuki_blogger_header_el_logo_site_tagline_color() {
		return [
			'initial' => 'rgba(0, 0, 0, 0.65)',
		];
	}
}
add_filter( 'yuki_header_el_logo_site_tagline_color_default_value', 'yuki_blogger_header_el_logo_site_tagline_color' );

if ( ! function_exists( 'yuki_blogger_header_el_logo_site_tagline_typography' ) ) {
	function yuki_blogger_header_el_logo_site_tagline_typography() {
		return [
			'family'     => 'inherit',
			'fontSize'   => '15px',
			'variant'    => '500',
			'lineHeight' => '1.5',
		];
	}
}
add_filter( 'yuki_header_el_logo_site_tagline_typography_default_value', 'yuki_blogger_header_el_logo_site_tagline_typography' );

//
// Footer row
//

if ( ! function_exists( 'yuki_blogger_footer_row_border' ) ) {
	function yuki_blogger_footer_row_border() {
		return [
			'style'   => 'solid',
			'width'   => 3,
			'color'   => 'var(--yuki-primary-color)',
			'hover'   => '',
			'inherit' => false,
		];
	}
}
add_filter( 'yuki_footer_bottom_row_border_top_default_value', 'yuki_blogger_footer_row_border' );

if ( ! function_exists( 'yuki_blogger_footer_vt_spacing' ) ) {
	function yuki_blogger_footer_vt_spacing() {
		return '8px';
	}
}
add_filter( 'yuki_footer_bottom_row_vt_spacing_default_value', 'yuki_blogger_footer_vt_spacing' );

//
// Archive Layout
//
if ( ! function_exists( 'yuki_blogger_archive_layout' ) ) {
	function yuki_blogger_archive_layout() {
		return 'archive-grid';
	}
}
add_filter( 'yuki_archive_layout_default_value', 'yuki_blogger_archive_layout' );

// Disable sidebar
add_filter( 'yuki_archive_sidebar_section_default_value', 'yuki_blogger_return_no' );
if ( ! function_exists( 'yuki_blogger_pagination_alignment' ) ) {
	function yuki_blogger_pagination_alignment() {
		return 'center';
	}
}
add_filter( 'yuki_pagination_alignment_default_value', 'yuki_blogger_pagination_alignment' );

if ( ! function_exists( 'yuki_blogger_excerpt_length' ) ) {
	function yuki_blogger_excerpt_length() {
		return 6;
	}
}
add_filter( 'yuki_entry_excerpt_length_default_value', 'yuki_blogger_excerpt_length' );

if ( ! function_exists( 'yuki_blogger_archive_image_width' ) ) {
	function yuki_blogger_archive_image_width() {
		return [
			'desktop' => '35%',
			'tablet'  => '35%',
			'mobile'  => '100%',
		];
	}
}
add_filter( 'yuki_archive_image_width_default_value', 'yuki_blogger_archive_image_width' );

//
// Colors
//

if ( ! function_exists( 'yuki_blogger_light_color_scheme' ) ) {
	/**
	 * Add light theme color scheme
	 *
	 * @param $palettes
	 *
	 * @return mixed
	 */
	function yuki_blogger_light_color_scheme( $palettes ) {
		array_unshift( $palettes, [
			'yuki-light-primary-color'  => '#c4403b',
			'yuki-light-primary-active' => '#af1d2c',
			'yuki-light-accent-color'   => '#212a33',
			'yuki-light-accent-active'  => '#17212a',
			'yuki-light-base-300'       => '#c5c6c5',
			'yuki-light-base-200'       => '#e0e2e0',
			'yuki-light-base-100'       => '#f8f9f8',
			'yuki-light-base-color'     => '#ffffff',
		] );

		return $palettes;
	}
}
add_filter( 'yuki_light_color_palettes', 'yuki_blogger_light_color_scheme' );

if ( ! function_exists( 'yuki_blogger_dark_color_scheme' ) ) {
	/**
	 * Add dark theme color scheme
	 *
	 * @param $palettes
	 *
	 * @return mixed
	 */
	function yuki_blogger_dark_color_scheme( $palettes ) {
		array_unshift( $palettes, [
			'yuki-dark-primary-color'  => '#c4403b',
			'yuki-dark-primary-active' => '#af1d2c',
			'yuki-dark-accent-color'   => '#a3a9a3',
			'yuki-dark-accent-active'  => '#f3f4f6',
			'yuki-dark-base-300'       => '#3f463f',
			'yuki-dark-base-200'       => '#2f2f2f',
			'yuki-dark-base-100'       => '#212a33',
			'yuki-dark-base-color'     => '#17212a',
		] );

		return $palettes;
	}
}
add_filter( 'yuki_dark_color_palettes', 'yuki_blogger_dark_color_scheme' );

if ( ! function_exists( 'yuki_blogger_preloader_colors' ) ) {
	function yuki_blogger_preloader_colors() {
		return [
			'background' => '#17212a',
			'accent'     => '#f3f4f6',
			'primary'    => 'var(--yuki-primary-color)',
		];
	}
}
add_filter( 'yuki_preloader_colors_default_value', 'yuki_blogger_preloader_colors' );

//
// Card style
//

if ( ! function_exists( 'yuki_blogger_card_border' ) ) {
	function yuki_blogger_card_border() {
		return [
			'style'   => 'none',
			'width'   => 1,
			'color'   => 'var(--yuki-base-200)',
			'hover'   => '',
			'inherit' => false,
		];
	}
}
add_filter( 'yuki_card_border_default_value', 'yuki_blogger_card_border' );
add_filter( 'yuki_global_sidebar_widgets-border_default_value', 'yuki_blogger_card_border' );

if ( ! function_exists( 'yuki_blogger_card_shadow' ) ) {
	function yuki_blogger_card_shadow() {
		return [
			'enable'     => 'yes',
			'horizontal' => '0px',
			'vertical'   => '15px',
			'blur'       => '18px',
			'spread'     => '-15px',
			'color'      => 'rgba(44, 62, 80, 0.15)',
		];
	}
}
add_filter( 'yuki_card_shadow_default_value', 'yuki_blogger_card_shadow' );
add_filter( 'yuki_global_sidebar_widgets-shadow_default_value', 'yuki_blogger_card_shadow' );

//
// Form style
//
if ( ! function_exists( 'yuki_blogger_form_style' ) ) {
	function yuki_blogger_form_style() {
		return 'modern';
	}
}
add_filter( 'yuki_content_form_style_default_value', 'yuki_blogger_form_style' );

//
// Preloader preset
//
if ( ! function_exists( 'yuki_blogger_preloader_preset' ) ) {
	function yuki_blogger_preloader_preset() {
		return 'preset-4';
	}
}
add_filter( 'yuki_preloader_preset_default_value', 'yuki_blogger_preloader_preset' );

//
// Homepage design
//

if ( ! function_exists( 'yuki_blogger_homepage_builder_id' ) ) {
	/**
	 * Change default homepage builder id
	 *
	 * @return string
	 */
	function yuki_blogger_homepage_builder_id() {
		return 'yuki_blogger_homepage_builder';
	}
}
add_filter( 'yuki_homepage_builder_id', 'yuki_blogger_homepage_builder_id' );

if ( ! function_exists( 'yuki_blogger_homepage_content_spacing' ) ) {
	/**
	 * Change default content spacing for homepage
	 *
	 * @return string
	 */
	function yuki_blogger_homepage_content_spacing() {
		return '24px';
	}
}
add_filter( 'yuki_homepage_content_spacing_default_value', 'yuki_blogger_homepage_content_spacing' );

if ( ! function_exists( 'yuki_blogger_homepage_heading' ) ) {
	/**
	 * Generate heading element
	 *
	 * @param $title
	 * @param $sub_title
	 * @param $settings
	 *
	 * @return array
	 */
	function yuki_blogger_homepage_heading( $title, $sub_title = '', $settings = [] ) {
		return [
			'id'       => 'heading',
			'settings' => wp_parse_args( $settings, [
				'title'            => $title,
				'sub-title'        => $sub_title,
				'alignment'        => 'left',
				'title-typography' => [
					'family'        => 'inherit',
					'fontSize'      => [
						'desktop' => '1.5rem',
						'tablet'  => '1.25rem',
						'mobile'  => '1rem'
					],
					'variant'       => '600',
					'lineHeight'    => '1.5',
					'textTransform' => 'capitalize',
				],
				'spacing'          => [
					'top'    => '0px',
					'bottom' => '0px',
					'left'   => '0px',
					'right'  => '0px',
					'linked' => false,
				]
			] )
		];
	}
}

if ( ! function_exists( 'yuki_blogger_homepage_design' ) ) {
	/**
	 * Override default homepage design
	 *
	 * @return array
	 */
	function yuki_blogger_homepage_design() {
		return [
			// Magazine Grid
			[
				'settings' => [
					'margin' => [
						'linked' => false,
						'left'   => '0px',
						'right'  => '0px',
						'top'    => '0px',
						'bottom' => '24px',
					],
				],
				'columns'  => [
					[
						'elements' => [
							[
								'id'       => 'magazine-grid',
								'settings' => [
									'grid-layout'      => 'style1',
									'container-height' => '450px',
								]
							],
						],
						'settings' => [],
					],
				],
			],
			// Posts Grid
			[
				'settings' => [
					'margin' => [
						'linked' => false,
						'left'   => '0px',
						'right'  => '0px',
						'top'    => '0px',
						'bottom' => '24px',
					],
				],
				'columns'  => [
					[
						'elements' => [
							yuki_blogger_homepage_heading( __( 'Most Recent', 'yuki-blogger' ) ),
							[
								'id'       => 'posts-grid',
								'settings' => [
									'posts-count'                     => 6,
									'grid-columns'                    => [
										'desktop' => 3,
										'tablet'  => 2,
										'mobile'  => 1,
									],
									'yuki_el_tax_style_cats'          => 'badge',
									'yuki_el_tax_badge_bg_color_cats' => [
										'initial' => 'var(--yuki-primary-color)',
										'hover'   => 'var(--yuki-primary-active)',
									],
									'yuki_el_thumbnail_height'        => '180px',
									'structure'                       => [
										[ 'id' => 'thumbnail', 'visible' => true ],
										[ 'id' => 'categories', 'visible' => true ],
										[ 'id' => 'title', 'visible' => true ],
										[ 'id' => 'excerpt', 'visible' => true ],
										[ 'id' => 'metas', 'visible' => true ],
									],
								]
							],
						],
						'settings' => [],
					],
				],
			],
			// Magazine Grid #2
			[
				'settings' => [
					'margin' => [
						'linked' => false,
						'left'   => '0px',
						'right'  => '0px',
						'top'    => '0px',
						'bottom' => '24px',
					],
				],
				'columns'  => [
					[
						'elements' => [
							[
								'id'       => 'magazine-grid',
								'settings' => [
									'grid-layout'      => 'style3',
									'container-height' => '360px',
								]
							],
						],
						'settings' => [],
					],
				],
			],
			// Posts Grid + Sidebar
			[
				'settings' => [],
				'columns'  => [
					[
						'elements' => [
							yuki_blogger_homepage_heading( __( 'Recommended', 'yuki-blogger' ), __( 'Top pic for you', 'yuki-blogger' ), [
								'spacing' => [
									'top'    => '0px',
									'right'  => '0px',
									'bottom' => '12px',
									'left'   => '0px',
									'linked' => false
								]
							] ),
						],
						'settings' => [],
					],
					[
						'elements' => [
							[
								'id'       => 'posts-grid',
								'settings' => [
									'posts-count'                     => 6,
									'grid-columns'                    => [
										'desktop' => 2,
										'tablet'  => 2,
										'mobile'  => 1,
									],
									'yuki_el_thumbnail_height'        => '180px',
									'yuki_el_tax_style_cats'          => 'badge',
									'yuki_el_tax_badge_bg_color_cats' => [
										'initial' => 'var(--yuki-primary-color)',
										'hover'   => 'var(--yuki-primary-active)',
									],
									'structure'                       => [
										[ 'id' => 'thumbnail', 'visible' => true ],
										[ 'id' => 'categories', 'visible' => true ],
										[ 'id' => 'title', 'visible' => true ],
										[ 'id' => 'excerpt', 'visible' => true ],
										[ 'id' => 'metas', 'visible' => true ],
									],
								]
							],
						],
						'settings' => [
							'width' => [ 'desktop' => '70%', 'tablet' => '100%', 'mobile' => '100%' ],
						],
					],
					[
						'elements' => [
							[
								'id'       => 'posts-slider',
								'settings' => [
									'container-height'         => '360px',
									'autoplay'                 => 'yes',
									'navigation'               => 'no',
									'yuki_el_title_typography' => [
										'family'     => 'inherit',
										'fontSize'   => [
											'desktop' => '1.25rem',
											'tablet'  => '1.15rem',
											'mobile'  => '1rem'
										],
										'variant'    => '700',
										'lineHeight' => '1.5em'
									],
								],
							],
							[
								'id'       => 'frontpage-widgets-1',
								'settings' => [],
							]
						],
						'settings' => [
							'width' => [ 'desktop' => '30%', 'tablet' => '100%', 'mobile' => '100%' ],
						],
					]
				]
			],
			// Stretch Sliders
			[
				'settings' => [ 'stretch' => 'yes' ],
				'columns'  => [
					[
						'elements' => [
							[
								'id'       => 'posts-slider',
								'settings' => [
									'container-height'         => '360px',
									'autoplay'                 => 'yes',
									'navigation'               => 'yes',
									'slides-to-show'           => [
										'desktop' => 3,
										'tablet'  => 3,
										'mobile'  => 1,
									],
									'yuki_el_title_typography' => [
										'family'     => 'inherit',
										'fontSize'   => [
											'desktop' => '1.25rem',
											'tablet'  => '1.15rem',
											'mobile'  => '1rem'
										],
										'variant'    => '700',
										'lineHeight' => '1.5em'
									],
								],
							]
						],
						'settings' => [],
					]
				],
			],
		];
	}
}
add_filter( 'yuki_blogger_homepage_builder_default_value', 'yuki_blogger_homepage_design' );
