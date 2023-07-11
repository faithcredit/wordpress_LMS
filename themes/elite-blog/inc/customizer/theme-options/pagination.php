<?php
/**
 * Pagination
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_pagination',
	array(
		'panel' => 'elite_blog_theme_options',
		'title' => esc_html__( 'Pagination', 'elite-blog' ),
	)
);

// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'elite_blog_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'elite-blog' ),
			'section'  => 'elite_blog_pagination',
			'settings' => 'elite_blog_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'elite_blog_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'elite_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'elite_blog_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'elite-blog' ),
		'section'         => 'elite_blog_pagination',
		'settings'        => 'elite_blog_pagination_type',
		'active_callback' => 'elite_blog_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'elite-blog' ),
			'numeric' => __( 'Numeric', 'elite-blog' ),
		),
	)
);
