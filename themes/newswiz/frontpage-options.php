<?php

/**
 * Option Panel
 *
 * @package Newswiz
 */


function newswiz_customize_register($wp_customize) {

$newsup_default = newswiz_get_default_theme_options();

$wp_customize->add_section('newsup_editor_post_section_settings',
    array(
        'title' => esc_html__('Editor 3 Post', 'newswiz'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('newswiz_enable_editor_section',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'newsup_sanitize_checkbox',
    )
);

$wp_customize->add_control('newswiz_enable_editor_section',
    array(
        'label' => esc_html__('Enable Editor Post Section', 'newswiz'),
        'section' => 'newsup_editor_post_section_settings',
        'type' => 'checkbox',
        'priority' => 10,

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_editor_news_category',
    array(
        'default' => $newsup_default['select_editor_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Newsup_Dropdown_Taxonomies_Control($wp_customize, 'select_editor_news_category',
    array(
        'label' => esc_html__('Category', 'newswiz'),
        'description' => esc_html__('Select category for Editor Post', 'newswiz'),
        'section' => 'newsup_editor_post_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 50,
        'active_callback' => 'newsup_main_banner_section_status'
    )));



// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_right_advertisement_section',
    array(
        'default' => $newsup_default['banner_right_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_right_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'newswiz'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newswiz'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 200,
        )
    )
);


/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_right_advertisement_section_url',
    array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_right_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'newswiz'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'url',
        'priority' => 210,
    )
);

$wp_customize->add_setting('newsup_right_open_on_new_tab',
    array(
        'default' => true,
        'sanitize_callback' => 'newsup_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new Newsup_Toggle_Control( $wp_customize, 'newsup_right_open_on_new_tab', 
        array(
            'label' => esc_html__('Open link in a new tab', 'newswiz'),
            'type' => 'toggle',
            'section' => 'frontpage_advertisement_settings',
            'priority' => 220,
        )
    ));


}
add_action('customize_register', 'newswiz_customize_register');
