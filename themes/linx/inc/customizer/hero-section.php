<?php

LINX_Kirki::add_panel( $kirki_prefix . 'hero', array(
  'title'    => esc_html__( 'Hero Section', 'linx' ),
  'priority' => 12,
) );

LINX_Kirki::add_section( $kirki_prefix . 'hero_home', array(
	'title'    => esc_html__( 'Home Page', 'linx' ),
  'panel'    => $kirki_prefix . 'hero',
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'radio',
	'settings'    => $kirki_prefix . 'hero_home_style',
	'label'       => esc_html__( 'Choose a style', 'linx' ),
	'section'     => $kirki_prefix . 'hero_home',
	'default'     => 'none',
	'multiple'    => 1,
	'choices'     => array(
		'wide' => esc_html__( 'Widescreen area', 'linx' ),
		'full' => esc_html__( 'Fullscreen area', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'radio',
	'settings'    => $kirki_prefix . 'hero_home_content',
	'label'       => esc_html__( 'Add the following content', 'linx' ),
	'section'     => $kirki_prefix . 'hero_home',
	'default'     => 'image',
	'multiple'    => 1,
	'choices'     => array(
		'image'   => esc_html__( 'Image', 'linx' ),
		'gallery' => esc_html__( 'Gallery', 'linx' ),
	),
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'image',
	'settings' => $kirki_prefix . 'hero_home_bg_image',
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_heading',
	'label'    => esc_html__( 'Heading', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_subheading',
	'label'    => esc_html__( 'Subheading', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_link',
	'label'    => esc_html__( 'Link', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_button_secondary_text',
	'label'    => esc_html__( 'Secondary button text', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_button_secondary_link',
	'label'    => esc_html__( 'Secondary button link', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_button_primary_text',
	'label'    => esc_html__( 'Primary button text', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type'     => 'text',
	'settings' => $kirki_prefix . 'hero_home_button_primary_link',
	'label'    => esc_html__( 'Primary button link', 'linx' ),
	'section'  => $kirki_prefix . 'hero_home',
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'image',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'repeater',
	'settings' => $kirki_prefix . 'hero_home_bg_slider',
	'section'  => $kirki_prefix . 'hero_home',
  'row_label' => array(
    'type' => 'text',
    'value' => esc_html__( 'slide', 'linx' ),
  ),
  'fields' => array(
    'slider_image' => array(
    	'type' => 'image',
    ),
    'slider_heading' => array(
      'type' => 'text',
      'label' => esc_html__( 'Heading', 'linx' ),
    ),
    'slider_subheading' => array(
      'type' => 'text',
      'label' => esc_html__( 'Subheading', 'linx' ),
    ),
    'slider_link' => array(
      'type' => 'text',
      'label' => esc_html__( 'Link', 'linx' ),
    ),
    'slider_button_secondary_text' => array(
      'type' => 'text',
      'label' => esc_html__( 'Secondary button text', 'linx' ),
    ),
    'slider_button_secondary_link' => array(
      'type' => 'text',
      'label' => esc_html__( 'Secondary button link', 'linx' ),
    ),
    'slider_button_primary_text' => array(
      'type' => 'text',
      'label' => esc_html__( 'Primary button text', 'linx' ),
    ),
    'slider_button_primary_link' => array(
      'type' => 'text',
      'label' => esc_html__( 'Primary button link', 'linx' ),
    ),
  ),
  'active_callback' => array(
    array(
      'setting' => $kirki_prefix . 'hero_home_content',
      'operator' => '==',
      'value' => 'gallery',
    ),
    array(
      'setting' => $kirki_prefix . 'hero_home_style',
      'operator' => '!=',
      'value' => 'none',
    ),
  ),
) );

LINX_Kirki::add_section( $kirki_prefix . 'hero_single', array(
	'title'    => esc_html__( 'Single Post/Page', 'linx' ),
  'panel'    => $kirki_prefix . 'hero',
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'radio',
	'settings'    => $kirki_prefix . 'hero_single_style',
	'label'       => esc_html__( 'Choose a style', 'linx' ),
	'section'     => $kirki_prefix . 'hero_single',
	'default'     => 'none',
	'multiple'    => 1,
	'choices'     => array(
		'wide' => esc_html__( 'Widescreen area', 'linx' ),
		'full' => esc_html__( 'Fullscreen area', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'hero_single_show_title',
	'label' => esc_html__( 'Show post title on hero', 'linx' ),
	'section' => $kirki_prefix . 'hero_single',
	'default' => false,
) );
