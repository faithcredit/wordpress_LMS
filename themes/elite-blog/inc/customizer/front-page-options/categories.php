<?php
/**
 * Categories Section
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_categories_section',
	array(
		'panel'    => 'elite_blog_front_page_options',
		'title'    => esc_html__( 'Categories Section', 'elite-blog' ),
		'priority' => 20,
	)
);

// Categories Section - Enable Section.
$wp_customize->add_setting(
	'elite_blog_enable_categories_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_enable_categories_section',
		array(
			'label'    => esc_html__( 'Enable Categories Section', 'elite-blog' ),
			'section'  => 'elite_blog_categories_section',
			'settings' => 'elite_blog_enable_categories_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'elite_blog_enable_categories_section',
		array(
			'selector' => '#elite_blog_categories_section .section-link',
			'settings' => 'elite_blog_enable_categories_section',
		)
	);
}

// Categories Section - Section Title.
$wp_customize->add_setting(
	'elite_blog_categories_title',
	array(
		'default'           => __( 'Discover Asia', 'elite-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'elite_blog_categories_title',
	array(
		'label'           => esc_html__( 'Section Title', 'elite-blog' ),
		'section'         => 'elite_blog_categories_section',
		'settings'        => 'elite_blog_categories_title',
		'type'            => 'text',
		'active_callback' => 'elite_blog_is_categories_section_enabled',
	)
);


for ( $i = 1; $i <= 4; $i++ ) {

	// Categories Section - Select Category.
	$wp_customize->add_setting(
		'elite_blog_categories_content_category_' . $i,
		array(
			'sanitize_callback' => 'elite_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'elite_blog_categories_content_category_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Select Category %d', 'elite-blog' ), $i ),
			'section'         => 'elite_blog_categories_section',
			'settings'        => 'elite_blog_categories_content_category_' . $i,
			'active_callback' => 'elite_blog_is_categories_section_enabled',
			'type'            => 'select',
			'choices'         => elite_blog_get_post_cat_choices(),
		)
	);

	// Categories Section - Category Image.
	$wp_customize->add_setting(
		'elite_blog_category_category_image_' . $i,
		array(
			'sanitize_callback' => 'elite_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'elite_blog_category_category_image_' . $i,
			array(
				'label'           => sprintf( esc_html__( 'Category Image %d', 'elite-blog' ), $i ),
				'section'         => 'elite_blog_categories_section',
				'settings'        => 'elite_blog_category_category_image_' . $i,
				'active_callback' => 'elite_blog_is_categories_section_enabled',
			)
		)
	);

	// Categories Section - Horizontal Line.
	$wp_customize->add_setting(
		'elite_blog_categories_horizontal_line_' . $i,
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Elite_Blog_Customize_Horizontal_Line(
			$wp_customize,
			'elite_blog_categories_horizontal_line_' . $i,
			array(
				'section'         => 'elite_blog_categories_section',
				'settings'        => 'elite_blog_categories_horizontal_line_' . $i,
				'active_callback' => 'elite_blog_is_categories_section_enabled',
				'type'            => 'hr',
			)
		)
	);

}
