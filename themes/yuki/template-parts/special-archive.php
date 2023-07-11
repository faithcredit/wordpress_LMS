<?php
/**
 * The template for archive page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yuki
 */

yuki_show_archive_header();

get_template_part( 'template-parts/special', 'loop' );
