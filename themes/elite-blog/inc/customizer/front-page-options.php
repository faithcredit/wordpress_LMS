<?php
/**
 * Front Page Options
 *
 * @package Elite_Blog
 */

$wp_customize->add_panel(
	'elite_blog_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'elite-blog' ),
		'priority' => 130,
	)
);

// Banner Slider Section.
require get_template_directory() . '/inc/customizer/front-page-options/slider.php';

// Categories Section.
require get_template_directory() . '/inc/customizer/front-page-options/categories.php';
