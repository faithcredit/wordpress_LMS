<?php

function elite_blog_intro_text( $default_text ) {
	$default_text .= sprintf(
		'<div class="notice notice-info elite-blog-demo-data"><p class="demo-file-content">%1$s <a href="%2$s" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Demo content files for Elite Blog Theme.', 'elite-blog' ),
		esc_url( 'https://docs.ascendoor.com/docs/elite-blog/getting-started/introduction/#demo-content' ),
		esc_html__( 'Click here to download demo files.', 'elite-blog' )
	);
	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'elite_blog_intro_text' );

/**
 * OCDI after import.
 */
function elite_blog_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$social_menu  = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $primary_menu->term_id,
			'social'  => $social_menu->term_id,
		)
	);

}
add_action( 'ocdi/after_import', 'elite_blog_after_import_setup' );
