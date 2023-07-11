<?php
if (!function_exists('coursemax_theme_options')) :
    function coursemax_theme_options()
    {
        $defaults = array(

            //banner section
            'header_button_txt' => '',
            'header_button_url' => '',
            'banner_title' => '',
            'banner_desc' => '',
            'site_title_show' => '1',
            'banner_bg_image' => '',
            'banner_height' => '',

            

            'about_show' => 0,

            'cta_show' => 0,
            'cta_title' => '',
            'cta_bg_image' => '',
            'cta_subtitle' => '',
            'cta_button_txt' => '',
            'cta_button_url' => '',

            'all_course_btn' => '',
            'all_course_url' => '',



            'course_show' => 1,
            'course_title' => '',
            'course_desc' => '',
            'course_category' => '',

            'blog_show' => 1,
            'blog_title' => '',
            'blog_desc' => '',
            'blog_category' => '',
            'show_prefooter' => 1,


        );

        $options = get_option('coursemax_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
