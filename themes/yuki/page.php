<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yuki
 */

get_header();

yuki_do_elementor_location( 'page', 'template-parts/special', 'page' );

get_footer();
