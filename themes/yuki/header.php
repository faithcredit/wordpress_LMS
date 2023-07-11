<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yuki
 */

// document open
get_template_part( 'template-parts/document', 'open' );

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

	/**
	 * Hook - yuki_action_before.
	 */
	do_action( 'yuki_action_before' );

	/**
	 * Hook - yuki_action_before_header.
	 */
	do_action( 'yuki_action_before_header' );

	/**
	 * Hook - yuki_action_header.
	 */
	do_action( 'yuki_action_header' );

	/**
	 * Hook - yuki_action_after_header.
	 */
	do_action( 'yuki_action_after_header' );

	/**
	 * Hook - yuki_action_before_content.
	 */
	do_action( 'yuki_action_before_content' );

	/**
	 * Hook - yuki_action_content.
	 */
	do_action( 'yuki_action_content' );
}
