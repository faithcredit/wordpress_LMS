<?php
/**
 * Typography
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_typography',
	array(
		'panel' => 'elite_blog_theme_options',
		'title' => esc_html__( 'Typography', 'elite-blog' ),
	)
);

// Typography - Site Title Font.
$wp_customize->add_setting(
	'elite_blog_site_title_font',
	array(
		'default'           => 'Habibi',
		'sanitize_callback' => 'elite_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'elite_blog_site_title_font',
	array(
		'label'    => esc_html__( 'Site Title Font Family', 'elite-blog' ),
		'section'  => 'elite_blog_typography',
		'settings' => 'elite_blog_site_title_font',
		'type'     => 'select',
		'choices'  => elite_blog_get_all_google_font_families(),
	)
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'elite_blog_site_description_font',
	array(
		'default'           => 'Aleo',
		'sanitize_callback' => 'elite_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'elite_blog_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'elite-blog' ),
		'section'  => 'elite_blog_typography',
		'settings' => 'elite_blog_site_description_font',
		'type'     => 'select',
		'choices'  => elite_blog_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'elite_blog_header_font',
	array(
		'default'           => 'Fanwood Text',
		'sanitize_callback' => 'elite_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'elite_blog_header_font',
	array(
		'label'    => esc_html__( 'Header Font Family', 'elite-blog' ),
		'section'  => 'elite_blog_typography',
		'settings' => 'elite_blog_header_font',
		'type'     => 'select',
		'choices'  => elite_blog_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'elite_blog_body_font',
	array(
		'default'           => 'Aleo',
		'sanitize_callback' => 'elite_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'elite_blog_body_font',
	array(
		'label'    => esc_html__( 'Body Font Family', 'elite-blog' ),
		'section'  => 'elite_blog_typography',
		'settings' => 'elite_blog_body_font',
		'type'     => 'select',
		'choices'  => elite_blog_get_all_google_font_families(),
	)
);
