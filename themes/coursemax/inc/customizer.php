<?php
/**
 * Coursemax Theme Customizer
 *
 * @package coursemax
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function coursemax_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$coursemax_options = coursemax_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'coursemax_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'coursemax_customize_partial_blogdescription',
			)
		);
	}

    $wp_customize->add_setting('coursemax_theme_options[site_title_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $coursemax_options['site_title_show'],
            'sanitize_callback' => 'coursemax_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('coursemax_theme_options[site_title_show]',
        array(
            'label' => esc_html__('Show Title & Tagline', 'coursemax'),
            'type' => 'Checkbox',
            'section' => 'title_tagline',

        )
    );
    $wp_customize->add_panel(
        'theme_options',
        array(
            'title' => esc_html__('Theme Options', 'coursemax'),
            'priority' => 2,
        )
    );



    /* Header Section */
    $wp_customize->add_section(
        'header_section',
        array(
            'title' => esc_html__( 'Header Section','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

	$wp_customize->add_setting('coursemax_theme_options[header_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $coursemax_options['header_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('coursemax_theme_options[header_button_txt]',
	    array(
	        'label' => esc_html__('Button Text', 'coursemax'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'coursemax_theme_options[header_button_txt]',
	    )
	);
	$wp_customize->add_setting('coursemax_theme_options[header_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $coursemax_options['header_button_url'],
	        'sanitize_callback' => 'coursemax_sanitize_url',
	    )
	);
	$wp_customize->add_control('coursemax_theme_options[header_button_url]',
	    array(
	        'label' => esc_html__('Button Link', 'coursemax'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'coursemax_theme_options[header_button_url]',
	    )
	);




    /* Banner Section */

    $wp_customize->add_section(
        'banner_section',
        array(
            'title' => esc_html__( 'Banner Section','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );




	$wp_customize->add_setting('coursemax_theme_options[banner_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('banner_title',
	    array(
	        'label' => esc_html__('Title', 'coursemax'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'coursemax_theme_options[banner_title]',
	    )
	);


	$wp_customize->add_setting('coursemax_theme_options[banner_desc]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('banner_desc',
	    array(
	        'label' => esc_html__('Description', 'coursemax'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'coursemax_theme_options[banner_desc]',
	    )
	);


	$wp_customize->add_setting('coursemax_theme_options[banner_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'coursemax_theme_options[banner_bg_image]',
	        array(
	            'label' => esc_html__('Add Background Image', 'coursemax'),
	            'section' => 'banner_section',
	            'settings' => 'coursemax_theme_options[banner_bg_image]',
	        ))
	);
	$wp_customize->add_setting('coursemax_theme_options[banner_height]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'absint',
	    )
	);
	$wp_customize->add_control('banner_height',
	    array(
	        'label' => esc_html__('Banner Height (Enter Numeric Value like 700)', 'coursemax'),
	        'type' => 'number',
	        'section' => 'banner_section',
	        'settings' => 'coursemax_theme_options[banner_height]',
			'input_attrs' => array(
				'min' => 400,
				'max' => 800
			)
	    )
	);



	/* Course Section*/


    $wp_customize->add_section(
        'course_section',
        array(
            'title' => esc_html__( 'Course Section ','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('coursemax_theme_options[course_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $coursemax_options['course_show'],
            'sanitize_callback' => 'coursemax_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('coursemax_theme_options[course_show]',
        array(
            'label' => esc_html__('Show course Section', 'coursemax'),
			'description' => esc_html__('Only 4 Courses will be shown in Free Version', 'coursemax'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'course_section',

        )
    );
	$wp_customize->add_setting('coursemax_theme_options[course_title]',
	    array(
	        'default' => $coursemax_options['course_title'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('coursemax_theme_options[course_title]',
	    array(
	        'label' => esc_html__('course Section Title', 'coursemax'),
	        'type' => 'text',
	        'section' => 'course_section',
	        'settings' => 'coursemax_theme_options[course_title]',
	    )
	);
	$wp_customize->add_setting('coursemax_theme_options[course_desc]',
	    array(
	        'default' => $coursemax_options['course_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('coursemax_theme_options[course_desc]',
	    array(
	        'label' => esc_html__('course Section Description', 'coursemax'),
	        'type' => 'text',
	        'section' => 'course_section',
	        'settings' => 'coursemax_theme_options[course_desc]',
	    )
	);

	$wp_customize->add_setting('coursemax_theme_options[all_course_btn]',
	array(
		'type' => 'option',
		'default' => $coursemax_options['all_course_btn'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('coursemax_theme_options[all_course_btn]',
	array(
		'label' => esc_html__('All Course Page Button Text', 'coursemax'),
		'type' => 'text',
		'section' => 'course_section',
		'settings' => 'coursemax_theme_options[all_course_btn]',
	)
);
$wp_customize->add_setting('coursemax_theme_options[all_course_url]',
	array(
		'type' => 'option',
		'default' => $coursemax_options['all_course_url'],
		'sanitize_callback' => 'coursemax_sanitize_url',
	)
);
$wp_customize->add_control('coursemax_theme_options[all_course_url]',
	array(
		'label' => esc_html__('All Course Page Button Link', 'coursemax'),
		'type' => 'text',
		'section' => 'course_section',
		'settings' => 'coursemax_theme_options[all_course_url]',
	)
);




    $wp_customize->add_section(
        'cta_section',
        array(
            'title' => esc_html__( 'Call to Action Section','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('coursemax_theme_options[cta_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $coursemax_options['cta_show'],
            'sanitize_callback' => 'coursemax_sanitize_checkbox',
        )
    );



    $wp_customize->add_control('coursemax_theme_options[cta_show]',
        array(
            'label' => esc_html__('Show CTA Section', 'coursemax'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'cta_section',

        )
    );
	$wp_customize->add_setting('coursemax_theme_options[cta_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('cta_title',
	    array(
	        'label' => esc_html__('Title', 'coursemax'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'coursemax_theme_options[cta_title]',
	    )
	);

	
	$wp_customize->add_setting('coursemax_theme_options[cta_subtitle]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('cta_subtitle',
	    array(
	        'label' => esc_html__('Description', 'coursemax'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'coursemax_theme_options[cta_subtitle]',
	    )
	);

	$wp_customize->add_setting('coursemax_theme_options[cta_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $coursemax_options['cta_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('coursemax_theme_options[cta_button_txt]',
	    array(
	        'label' => esc_html__('CTA Button Text', 'coursemax'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'coursemax_theme_options[cta_button_txt]',
	    )
	);
	$wp_customize->add_setting('coursemax_theme_options[cta_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $coursemax_options['cta_button_url'],
	        'sanitize_callback' => 'coursemax_sanitize_url',
	    )
	);
	$wp_customize->add_control('coursemax_theme_options[cta_button_url]',
	    array(
	        'label' => esc_html__('CTA Button Link', 'coursemax'),
	        'type' => 'text',
	        'section' => 'cta_section',
	        'settings' => 'coursemax_theme_options[cta_button_url]',
	    )
	);


	$wp_customize->add_setting('coursemax_theme_options[cta_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'coursemax_theme_options[cta_bg_image]',
	        array(
	            'label' => esc_html__('Add Background Image', 'coursemax'),
	            'section' => 'cta_section',
	            'settings' => 'coursemax_theme_options[cta_bg_image]',
	        ))
	);









    /* Blog Section */

    $wp_customize->add_section(
        'blog_section',
        array(
            'title' => esc_html__( 'Blog Section','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('coursemax_theme_options[blog_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $coursemax_options['blog_show'],
            'sanitize_callback' => 'coursemax_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('coursemax_theme_options[blog_show]',
        array(
            'label' => esc_html__('Show Blog Section', 'coursemax'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'blog_section',

        )
    );
	$wp_customize->add_setting('coursemax_theme_options[blog_title]',
	    array(
	        'capability' => 'edit_theme_options',
	        'default' => $coursemax_options['blog_title'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'type' => 'option',
	    )
	);
	$wp_customize->add_control('coursemax_theme_options[blog_title]',
	    array(
	        'label' => esc_html__('Section Title', 'coursemax'),
	        'priority' => 1,
	        'section' => 'blog_section',
	        'type' => 'text',
	    )
	);

	$wp_customize->add_setting('coursemax_theme_options[blog_desc]',
	    array(
	        'default' => $coursemax_options['blog_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('coursemax_theme_options[blog_desc]',
	    array(
	        'label' => esc_html__('Blog Section Description', 'coursemax'),
	        'type' => 'text',
	        'section' => 'blog_section',
	        'settings' => 'coursemax_theme_options[blog_desc]',
	    )
	);

	$wp_customize->add_setting('coursemax_theme_options[blog_category]', array(
	    'default' => $coursemax_options['blog_category'],
	    'type' => 'option',
	    'sanitize_callback' => 'coursemax_sanitize_select',
	    'capability' => 'edit_theme_options',

	));

	$wp_customize->add_control(new coursemax_Dropdown_Customize_Control(
	    $wp_customize, 'coursemax_theme_options[blog_category]',
	    array(
	        'label' => esc_html__('Select Blog Category', 'coursemax'),
	        'section' => 'blog_section',
	        'choices' => coursemax_get_categories_select(),
	        'settings' => 'coursemax_theme_options[blog_category]',
	    )
	));



    /* Blog Section */

    $wp_customize->add_section(
        'prefooter_section',
        array(
            'title' => esc_html__( 'Prefooter Section','coursemax' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('coursemax_theme_options[show_prefooter]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $coursemax_options['show_prefooter'],
            'sanitize_callback' => 'coursemax_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('coursemax_theme_options[show_prefooter]',
        array(
            'label' => esc_html__('Show Prefooter Section', 'coursemax'),
			'description' => esc_html__('Copyright text can be changed in Premium Version only', 'coursemax'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'prefooter_section',

        )
    );
}
add_action( 'customize_register', 'coursemax_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function coursemax_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function coursemax_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coursemax_customize_preview_js() {
	wp_enqueue_script( 'coursemax-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'coursemax_customize_preview_js' );
