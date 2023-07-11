<?php
/**
 * Sidebar Option
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_sidebar_option',
	array(
		'title' => esc_html__( 'Layout', 'elite-blog' ),
		'panel' => 'elite_blog_theme_options',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'elite_blog_sidebar_position',
	array(
		'sanitize_callback' => 'elite_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'elite_blog_sidebar_position',
	array(
		'label'   => esc_html__( 'Global Sidebar Position', 'elite-blog' ),
		'section' => 'elite_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'elite-blog' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'elite-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'elite-blog' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'elite_blog_post_sidebar_position',
	array(
		'sanitize_callback' => 'elite_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'elite_blog_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'elite-blog' ),
		'section' => 'elite_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'elite-blog' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'elite-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'elite-blog' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'elite_blog_page_sidebar_position',
	array(
		'sanitize_callback' => 'elite_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'elite_blog_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'elite-blog' ),
		'section' => 'elite_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'elite-blog' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'elite-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'elite-blog' ),
		),
	)
);
