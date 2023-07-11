<?php

LINX_Kirki::add_section( $kirki_prefix . 'category_boxes', array(
	'title'    => esc_html__( 'Category Boxes', 'linx' ),
  'priority' => 14,
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'multicheck',
	'settings'    => $kirki_prefix . 'box_categories',
	'label'       => esc_html__( 'Choose categories', 'linx' ),
	'section'     => $kirki_prefix . 'category_boxes',
	'multiple'    => 1,
	'choices'     => class_exists( 'Kirki_Helper' ) ? Kirki_Helper::get_terms( array( 'taxonomy' => 'category' ) ) : array(),
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'box_random_thumbnails',
	'label' => esc_html__( 'Random thumbnails', 'linx' ),
	'section' => $kirki_prefix . 'category_boxes',
	'default' => false,
) );

LINX_Kirki::add_field( 'linx', array(
	'type' => 'toggle',
	'settings' => $kirki_prefix . 'disable_category_boxes',
	'label' => esc_html__( 'Disable category boxes', 'linx' ),
	'section' => $kirki_prefix . 'category_boxes',
	'default' => false,
) );