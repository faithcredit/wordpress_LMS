<?php
/**
 *
 * Template Name: Frontpage

 *
 * @package Coursemax
 */

$coursemax_options = coursemax_theme_options();

$blog_show = $coursemax_options['blog_show'];


get_header();


get_template_part('template-parts/homepage/banner', 'section');


get_template_part('template-parts/homepage/course', 'section');


get_template_part('template-parts/homepage/about', 'section');



if($blog_show == 1)
get_template_part('template-parts/homepage/blog', 'section');


get_footer();
