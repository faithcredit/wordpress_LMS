<?php

LINX_Kirki::add_section( $kirki_prefix . 'footer_settings', array(
	'title'    => esc_html__( 'Footer Settings', 'linx' ),
  'priority' => 17,
) );

LINX_Kirki::add_field( 'linx', array(
	'type'        => 'textarea',
	'settings'    => $kirki_prefix . 'copyright_text',
	'label'       => esc_html__( 'Copyright text', 'linx' ),
	'section'     => $kirki_prefix . 'footer_settings',
) );
