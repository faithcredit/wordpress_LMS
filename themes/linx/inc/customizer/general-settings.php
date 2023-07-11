<?php

LINX_Kirki::add_section( $kirki_prefix . 'general_settings', array(
	'title' => esc_html__( 'General Settings', 'linx' ),
  'priority' => 10,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'enable_dark_mode',
	'label' => esc_html__( 'Enable dark mode', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'radio',
	'settings' => $kirki_prefix . 'main_layout',
	'label' => esc_html__( 'Main layout', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'three',
	'multiple' => 1,
	'choices' => array(
		'one' => esc_html__( '1 column', 'linx' ),
		'two' => esc_html__( '2 column', 'linx' ),
		'three' => esc_html__( '3 column', 'linx' ),
		'four' => esc_html__( '4 column', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'color_accent',
	'label' => esc_html__( 'Accent color', 'linx' ),
  'section' => $kirki_prefix . 'general_settings',
  'output' => array(
    array(
      'element' => array( 'html' ),
      'property' => '--accent-color',
		),
  ),
  'transport' => 'auto',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'disable_masonry',
	'label' => esc_html__( 'Disable masonry', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'enable_social_bar',
	'label' => esc_html__( 'Enable social bar', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'enable_offcanvas_social',
	'label' => esc_html__( 'Social icons in off-canvas only', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'radio',
	'settings' => $kirki_prefix . 'image_crop',
	'label' => esc_html__( 'Image crop', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'horizontal',
	'multiple' => 1,
	'choices' => array(
		'horizontal' => esc_html__( 'Horizontal', 'linx' ),
		'square' => esc_html__( 'Square', 'linx' ),
		'vertical' => esc_html__( 'Vertical', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'enable_cropped_image',
	'label' => esc_html__( 'Use cropped image', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'radio',
	'settings' => $kirki_prefix . 'pagination',
	'label' => esc_html__( 'Pagination', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'infinite_button',
	'multiple' => 1,
	'choices' => array(
		'navigation' => esc_html__( 'Navigation', 'linx' ),
		'numeric' => esc_html__( 'Numeric', 'linx' ),
		'infinite_button' => esc_html__( 'Infinite + Button', 'linx' ),
		'infinite_scroll' => esc_html__( 'Infinite + Scroll', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'select',
	'settings' => $kirki_prefix . 'sidebar_home',
	'label' => esc_html__( 'Home page sidebar', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'right',
	'multiple' => 1,
	'choices' => array(
		'right' => esc_html__( 'Right', 'linx' ),
		'left' => esc_html__( 'Left', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'select',
	'settings' => $kirki_prefix . 'sidebar_single',
	'label' => esc_html__( 'Single post/page sidebar', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'right',
	'multiple' => 1,
	'choices' => array(
		'right' => esc_html__( 'Right', 'linx' ),
		'left' => esc_html__( 'Left', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'select',
	'settings' => $kirki_prefix . 'sidebar_archive',
	'label' => esc_html__( 'Archive page sidebar', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => 'right',
	'multiple' => 1,
	'choices' => array(
		'right' => esc_html__( 'Right', 'linx' ),
		'left' => esc_html__( 'Left', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'disable_recommended_plugins',
	'label' => esc_html__( 'Disable recommended plugins notice', 'linx' ),
	'section' => $kirki_prefix . 'general_settings',
	'default' => false,
) );
