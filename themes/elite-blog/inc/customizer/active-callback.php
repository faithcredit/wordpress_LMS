<?php

/**
 * Active Callbacks
 *
 * @package Elite_Blog
 */

// Theme Options.
function elite_blog_is_pagination_enabled( $control ) {
	return ( $control->manager->get_setting( 'elite_blog_enable_pagination' )->value() );
}
function elite_blog_is_breadcrumb_enabled( $control ) {
	return ( $control->manager->get_setting( 'elite_blog_enable_breadcrumb' )->value() );
}

// Banner Slider Section.
function elite_blog_is_slider_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'elite_blog_enable_slider_section' )->value() );
}
function elite_blog_is_slider_section_and_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'elite_blog_slider_content_type' )->value();
	return ( elite_blog_is_slider_section_enabled( $control ) && ( 'post' === $content_type ) );
}
function elite_blog_is_slider_section_and_content_type_page_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'elite_blog_slider_content_type' )->value();
	return ( elite_blog_is_slider_section_enabled( $control ) && ( 'page' === $content_type ) );
}

// Categories Section.
function elite_blog_is_categories_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'elite_blog_enable_categories_section' )->value() );
}

// Check if static home page is enabled.
function elite_blog_is_static_homepage_enabled( $control ) {
	return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() );
}