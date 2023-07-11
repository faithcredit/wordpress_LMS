<?php
/**
 * Post Options
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'elite-blog' ),
		'panel' => 'elite_blog_theme_options',
	)
);

// Post Options - Hide Date.
$wp_customize->add_setting(
	'elite_blog_post_hide_date',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_post_hide_date',
		array(
			'label'   => esc_html__( 'Hide Date', 'elite-blog' ),
			'section' => 'elite_blog_post_options',
		)
	)
);

// Post Options - Hide Author.
$wp_customize->add_setting(
	'elite_blog_post_hide_author',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_post_hide_author',
		array(
			'label'   => esc_html__( 'Hide Author', 'elite-blog' ),
			'section' => 'elite_blog_post_options',
		)
	)
);

// Post Options - Hide Category.
$wp_customize->add_setting(
	'elite_blog_post_hide_category',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_post_hide_category',
		array(
			'label'   => esc_html__( 'Hide Category', 'elite-blog' ),
			'section' => 'elite_blog_post_options',
		)
	)
);

// Post Options - Hide Tag.
$wp_customize->add_setting(
	'elite_blog_post_hide_tags',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_post_hide_tags',
		array(
			'label'   => esc_html__( 'Hide Tag', 'elite-blog' ),
			'section' => 'elite_blog_post_options',
		)
	)
);

// Post Options - Hide Related Posts.
$wp_customize->add_setting(
	'elite_blog_post_hide_related_posts',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_post_hide_related_posts',
		array(
			'label'   => esc_html__( 'Hide Related Posts', 'elite-blog' ),
			'section' => 'elite_blog_post_options',
		)
	)
);

// Post Options - Related Post Label.
$wp_customize->add_setting(
	'elite_blog_post_related_post_label',
	array(
		'default'           => __( 'Related Posts', 'elite-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'elite_blog_post_related_post_label',
	array(
		'label'           => esc_html__( 'Related Posts Label', 'elite-blog' ),
		'section'         => 'elite_blog_post_options',
		'settings'        => 'elite_blog_post_related_post_label',
		'type'            => 'text',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'elite_blog_post_hide_related_posts' )->value() === false );
		},
	)
);
