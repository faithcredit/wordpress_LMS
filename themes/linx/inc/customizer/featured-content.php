<?php

LINX_Kirki::add_section( $kirki_prefix . 'featured_content', array(
	'title'    => esc_html__( 'Featured Content', 'linx' ),
  'priority' => 13,
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'radio',
	'settings'    => $kirki_prefix . 'featured_style',
	'label'       => esc_html__( 'Choose a style', 'linx' ),
	'section'     => $kirki_prefix . 'featured_content',
	'default'     => 'none',
	'multiple'    => 1,
	'choices'     => array(
		'v1' => esc_html__( 'Big slider', 'linx' ),
		'v2' => esc_html__( 'Vertical boxes', 'linx' ),
		'v3' => esc_html__( 'Horizontal boxes', 'linx' ),
		'none' => esc_html__( 'None', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'image',
	'settings' => $kirki_prefix . 'featured_wrapper_image',
	'label' => esc_html__( 'Add background image', 'linx' ),
	'section' => $kirki_prefix . 'featured_content',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'featured_wrapper_color',
	'label' => esc_html__( 'Add background color', 'linx' ),
	'section' => $kirki_prefix . 'featured_content',
  'output' => array(
    array(
      'element' => '.featured-wrapper',
      'property' => 'background-color',
    ),
  ),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'featured_enable_category',
	'label' => esc_html__( 'Show on category pages', 'linx' ),
	'section' => $kirki_prefix . 'featured_content',
	'default' => false,
) );