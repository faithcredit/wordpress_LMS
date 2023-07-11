<?php
/**
 * Footer Options
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_footer_options',
	array(
		'panel' => 'elite_blog_theme_options',
		'title' => esc_html__( 'Footer Options', 'elite-blog' ),
	)
);

// Footer Options - Copyright Text.
/* translators: 1: Year, 2: Site Title with home URL. */
$copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'elite-blog' ), '[the-year]', '[site-link]' );
$wp_customize->add_setting(
	'elite_blog_footer_copyright_text',
	array(
		'default'           => $copyright_default,
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_control(
	'elite_blog_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'elite-blog' ),
		'section'  => 'elite_blog_footer_options',
		'settings' => 'elite_blog_footer_copyright_text',
		'type'     => 'textarea',
	)
);

// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'elite_blog_scroll_top',
	array(
		'sanitize_callback' => 'elite_blog_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'elite-blog' ),
			'section' => 'elite_blog_footer_options',
		)
	)
);
