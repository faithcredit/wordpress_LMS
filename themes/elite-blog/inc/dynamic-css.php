<?php

/**
 * Dynamic CSS
 */
function elite_blog_dynamic_css() {

	$site_title_font       = get_theme_mod( 'elite_blog_site_title_font', 'Habibi' );
	$site_description_font = get_theme_mod( 'elite_blog_site_description_font', 'Aleo' );
	$header_font           = get_theme_mod( 'elite_blog_header_font', 'Fanwood Text' );
	$body_font             = get_theme_mod( 'elite_blog_body_font', 'Aleo' );

	$custom_css  = '';
	$custom_css .= '
    /* Color */
    :root {
        --site-title-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$custom_css .= '
    /* Typograhpy */
    :root {
        --font-heading: "' . esc_attr( $header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont,"' . esc_attr( $body_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea {
        font-family: "' . esc_attr( $body_font ) . '", serif;
	}

	.site-title a {
        font-family: "' . esc_attr( $site_title_font ) . '", serif;
	}
    
	.site-description {
        font-family: "' . esc_attr( $site_description_font ) . '", serif;
	}
    ';

	wp_add_inline_style( 'elite-blog-style', $custom_css );

}

add_action( 'wp_enqueue_scripts', 'elite_blog_dynamic_css', 99 );
