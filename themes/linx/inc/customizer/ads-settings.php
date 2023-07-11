<?php

$locations = array(
	array( 'before_header', esc_html__( 'Before header', 'linx' ) ),
	array( 'after_header', esc_html__( 'After header', 'linx' ) ),
	array( 'before_footer', esc_html__( 'Before footer', 'linx' ) ),
);

LINX_Kirki::add_panel( $kirki_prefix . 'ads', array(
  'title' => esc_html__( 'Ads Settings', 'linx' ),
  'priority' => 18,
) );

foreach ( $locations as $location ) {
	LINX_Kirki::add_section( $kirki_prefix . 'ads_' . $location[0], array(
		'title' => $location[1],
		'panel' => $kirki_prefix . 'ads',
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'radio',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_style',
		'label' => esc_html__( 'Choose a style', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => 'none',
		'multiple' => 1,
		'choices' => array(
			'none' => esc_html__( 'None', 'linx' ),
			'image' => esc_html__( 'Image', 'linx' ),
			'html' => esc_html__( 'HTML', 'linx' ),
		),
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'image',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_image',
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'active_callback' => array(
			array(
				'setting' => $kirki_prefix . 'ads_' . $location[0] . '_style',
				'operator' => '==',
				'value' => 'image',
			),
		),
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'text',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_link',
		'label' => esc_html__( 'Link', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'active_callback' => array(
			array(
				'setting' => $kirki_prefix . 'ads_' . $location[0] . '_style',
				'operator' => '==',
				'value' => 'image',
			),
		),
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'toggle',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_new_tab',
		'label' => esc_html__( 'Open link in a new tab', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => false,
		'active_callback' => array(
			array(
				'setting' => $kirki_prefix . 'ads_' . $location[0] . '_style',
				'operator' => '==',
				'value' => 'image',
			),
		),
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'code',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_html',
		'label' => esc_html__( 'HTML code', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'choices' => array(
			'language' => 'html',
		),
		'active_callback' => array(
			array(
				'setting' => $kirki_prefix . 'ads_' . $location[0] . '_style',
				'operator' => '==',
				'value' => 'html',
			),
		),
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'toggle',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_hide_post',
		'label' => esc_html__( 'Hide on single posts', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => false,
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'toggle',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_hide_page',
		'label' => esc_html__( 'Hide on single pages', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => false,
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'toggle',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_hide_archive',
		'label' => esc_html__( 'Hide on archive pages', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => false,
	) );

	LINX_Kirki::add_field( 'linx', array(
		'type' => 'toggle',
		'settings' => $kirki_prefix . 'ads_' . $location[0] . '_hide_home',
		'label' => esc_html__( 'Hide on home page', 'linx' ),
		'section' => $kirki_prefix . 'ads_' . $location[0],
		'default' => false,
	) );
}
