<?php

LINX_Kirki::add_section( $kirki_prefix . 'header_logo', array(
	'title' => esc_html__( 'Header & Logo', 'linx' ),
  'priority' => 11,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'radio',
	'settings' => $kirki_prefix . 'navbar_style',
	'label' => esc_html__( 'Navigation bar style', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
	'default' => 'sticky',
	'multiple' => 1,
	'choices' => array(
		'sticky' => esc_html__( 'Sticky', 'linx' ),
		'transparent' => esc_html__( 'Transparent', 'linx' ),
		'sticky_transparent' => esc_html__( 'Sticky+Transparent', 'linx' ),
		'regular' => esc_html__( 'Regular', 'linx' ),
	),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'navbar_full',
	'label' => esc_html__( 'Full width navigation bar', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'disable_search',
	'label' => esc_html__( 'Disable search', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'image',
	'settings' => $kirki_prefix . 'logo_regular',
	'label' => esc_html__( 'Logo', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'image',
	'settings' => $kirki_prefix . 'logo_regular@2x',
	'label' => esc_html__( 'Retina logo', 'linx' ),
	'description' => esc_html__( 'Choose x2 version of your logo. If the logo is 150x50, the retina logo must be 300x100.', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'image',
	'settings' => $kirki_prefix . 'logo_contrary',
	'label' => esc_html__( 'Contrary logo', 'linx' ),
	'description' => esc_html__( 'This logo will be used on Transparent and Sticky+Transparent navigation bars.', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'image',
	'settings' => $kirki_prefix . 'logo_contrary@2x',
	'label' => esc_html__( 'Contrary retina logo', 'linx' ),
	'section' => $kirki_prefix . 'header_logo',
) );
