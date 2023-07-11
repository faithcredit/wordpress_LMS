<?php

LINX_Kirki::add_section( $kirki_prefix . 'social_links', array(
	'title'    => esc_html__( 'Social Links', 'linx' ),
  'priority' => 16,
) );

$social_links = linx_social_links();

foreach ( $social_links as $link ) {
	LINX_Kirki::add_field( 'linx', array(
		'type'     => 'text',
		'settings' => $kirki_prefix . $link['option'],
		'label'    => sprintf( esc_html__( '%s', 'linx' ), $link['name'] ),
		'section'  => $kirki_prefix . 'social_links',
	) );
}
