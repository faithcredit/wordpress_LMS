<?php
/**
 * Breadcrumb
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_breadcrumb',
	array(
		'title' => esc_html__( 'Breadcrumb', 'elite-blog' ),
		'panel' => 'elite_blog_theme_options',
	)
);

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'elite_blog_enable_breadcrumb',
	array(
		'sanitize_callback' => 'elite_blog_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'elite-blog' ),
			'section' => 'elite_blog_breadcrumb',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'elite_blog_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'elite_blog_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'elite-blog' ),
		'active_callback' => 'elite_blog_is_breadcrumb_enabled',
		'section'         => 'elite_blog_breadcrumb',
	)
);
