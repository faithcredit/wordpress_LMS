<?php

LINX_Kirki::add_section( $kirki_prefix . 'color_settings', array(
	'title'    => esc_html__( 'Color Settings', 'linx' ),
  'priority' => 18,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'color_accent',
	'label' => esc_html__( 'Accent color', 'linx' ),
  'section' => $kirki_prefix . 'color_settings',
  'output' => array(
    array(
      'element' => array( 'html' ),
      'property' => '--accent-color',
		),
  ),
  'transport' => 'auto',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'color_body_bg',
	'label' => esc_html__( 'Body background color', 'linx' ),
  'section' => $kirki_prefix . 'color_settings',
  'output' => array(
    array(
      'element' => array( 'body' ),
      'property' => 'background-color',
		),
  ),
  'transport' => 'auto',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'color_header_bg',
	'label' => esc_html__( 'Header background color', 'linx' ),
  'section' => $kirki_prefix . 'color_settings',
  'output' => array(
    array(
      'element' => array( '.site-header' ),
      'property' => 'background-color',
		),
  ),
  'transport' => 'auto',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'color',
	'settings' => $kirki_prefix . 'color_header_border',
	'label' => esc_html__( 'Header border color', 'linx' ),
  'section' => $kirki_prefix . 'color_settings',
  'output' => array(
    array(
      'element' => array( '.site-header', '.navbar > *:last-child > div' ),
      'property' => 'border-color',
    ),
  ),
  'transport' => 'auto',
) );