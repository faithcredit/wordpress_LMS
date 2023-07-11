<?php
/**
 * Banner Slider Section
 *
 * @package Elite_Blog
 */

$wp_customize->add_section(
	'elite_blog_slider_section',
	array(
		'panel'    => 'elite_blog_front_page_options',
		'title'    => esc_html__( 'Banner Slider Section', 'elite-blog' ),
		'priority' => 10,
	)
);

// Banner Slider Section - Enable Section.
$wp_customize->add_setting(
	'elite_blog_enable_slider_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'elite_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Elite_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'elite_blog_enable_slider_section',
		array(
			'label'    => esc_html__( 'Enable Banner Slider Section', 'elite-blog' ),
			'section'  => 'elite_blog_slider_section',
			'settings' => 'elite_blog_enable_slider_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'elite_blog_enable_slider_section',
		array(
			'selector' => '#elite_blog_slider_section .section-link',
			'settings' => 'elite_blog_enable_slider_section',
		)
	);
}

// Banner Slider Section - Banner Slider Content Type.
$wp_customize->add_setting(
	'elite_blog_slider_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'elite_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'elite_blog_slider_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'elite-blog' ),
		'section'         => 'elite_blog_slider_section',
		'settings'        => 'elite_blog_slider_content_type',
		'type'            => 'select',
		'active_callback' => 'elite_blog_is_slider_section_enabled',
		'choices'         => array(
			'page' => esc_html__( 'Page', 'elite-blog' ),
			'post' => esc_html__( 'Post', 'elite-blog' ),
		),
	)
);

for ( $i = 1; $i <= 3; $i++ ) {

	// Banner Slider Section - Select Banner Post.
	$wp_customize->add_setting(
		'elite_blog_slider_content_post_' . $i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'elite_blog_slider_content_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Select Post %d', 'elite-blog' ), $i ),
			'section'         => 'elite_blog_slider_section',
			'settings'        => 'elite_blog_slider_content_post_' . $i,
			'active_callback' => 'elite_blog_is_slider_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => elite_blog_get_post_choices(),
		)
	);

	// Banner Slider Section - Select Banner Page.
	$wp_customize->add_setting(
		'elite_blog_slider_content_page_' . $i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'elite_blog_slider_content_page_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Select Page %d', 'elite-blog' ), $i ),
			'section'         => 'elite_blog_slider_section',
			'settings'        => 'elite_blog_slider_content_page_' . $i,
			'active_callback' => 'elite_blog_is_slider_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => elite_blog_get_page_choices(),
		)
	);

}
