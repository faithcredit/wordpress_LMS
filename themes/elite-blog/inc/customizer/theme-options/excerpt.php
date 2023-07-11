<?php
/**
 * Excerpt
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_excerpt_options',
	array(
		'panel' => 'elite_blog_theme_options',
		'title' => esc_html__( 'Excerpt', 'elite-blog' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'elite_blog_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'elite_blog_sanitize_number_range',
		'validate_callback' => 'elite_blog_validate_excerpt_length',
	)
);

$wp_customize->add_control(
	'elite_blog_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'elite-blog' ),
		'description' => esc_html__( 'Note: Min 1 & Max 100. Please input the valid number and save. Then refresh the page to see the change.', 'elite-blog' ),
		'section'     => 'elite_blog_excerpt_options',
		'settings'    => 'elite_blog_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 200,
			'step' => 1,
		),
	)
);
