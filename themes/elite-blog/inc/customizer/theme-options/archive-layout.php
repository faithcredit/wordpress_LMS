<?php
/**
 * Archive Layout
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_archive_layout',
	array(
		'title' => esc_html__( 'Archive Layout', 'elite-blog' ),
		'panel' => 'elite_blog_theme_options',
	)
);

// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'elite_blog_column_layout',
	array(
		'default'           => 'column-2',
		'sanitize_callback' => 'elite_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'elite_blog_column_layout',
	array(
		'label'   => esc_html__( 'Column Layout', 'elite-blog' ),
		'section' => 'elite_blog_archive_layout',
		'type'    => 'select',
		'choices' => array(
			'column-2' => __( 'Column 2', 'elite-blog' ),
			'column-3' => __( 'Column 3', 'elite-blog' ),
		),
	)
);
