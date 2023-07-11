<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elite_Blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elite_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$classes[] = 'light-mode';

	$classes[] = elite_blog_sidebar_layout();

	return $classes;
}
add_filter( 'body_class', 'elite_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function elite_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'elite_blog_pingback_header' );

/**
 * Get all posts for customizer Post content type.
 */
function elite_blog_get_post_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'elite-blog' ) );
	$args    = array( 'numberposts' => -1 );
	$posts   = get_posts( $args );

	foreach ( $posts as $post ) {
		$id             = $post->ID;
		$title          = $post->post_title;
		$choices[ $id ] = $title;
	}

	return $choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function elite_blog_get_page_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'elite-blog' ) );
	$pages   = get_pages();

	foreach ( $pages as $page ) {
		$choices[ $page->ID ] = $page->post_title;
	}

	return $choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function elite_blog_get_post_cat_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'elite-blog' ) );
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$choices[ $cat->term_id ] = $cat->name;
	}

	return $choices;
}

if ( ! function_exists( 'elite_blog_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function elite_blog_sidebar_layout() {
		$sidebar_position      = get_theme_mod( 'elite_blog_sidebar_position', 'right-sidebar' );
		$sidebar_position_post = get_theme_mod( 'elite_blog_post_sidebar_position', 'right-sidebar' );
		$sidebar_position_page = get_theme_mod( 'elite_blog_page_sidebar_position', 'right-sidebar' );

		if ( is_single() ) {
			$sidebar_position = $sidebar_position_post;
		} elseif ( is_page() ) {
			$sidebar_position = $sidebar_position_page;
		}

		return $sidebar_position;
	}
}

if ( ! function_exists( 'elite_blog_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function elite_blog_is_sidebar_enabled() {
		$sidebar_position      = get_theme_mod( 'elite_blog_sidebar_position', 'right-sidebar' );
		$sidebar_position_post = get_theme_mod( 'elite_blog_post_sidebar_position', 'right-sidebar' );
		$sidebar_position_page = get_theme_mod( 'elite_blog_page_sidebar_position', 'right-sidebar' );

		$sidebar_enabled = true;
		if ( is_home() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $sidebar_position ) {
				$sidebar_enabled = false;
			}
		} elseif ( is_single() ) {
			if ( 'no-sidebar' === $sidebar_position || 'no-sidebar' === $sidebar_position_post ) {
				$sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $sidebar_position || 'no-sidebar' === $sidebar_position_page ) {
				$sidebar_enabled = false;
			}
		}
		return $sidebar_enabled;
	}
}

/**
* Excerpt Length Validation.
*/
if ( ! function_exists( 'elite_blog_validate_excerpt_length' ) ) :
	function elite_blog_validate_excerpt_length( $validity, $value ) {
		$value = intval( $value );
		if ( empty( $value ) || ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'You must supply a valid number.', 'elite-blog' ) );
		} elseif ( $value < 1 ) {
			$validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 1', 'elite-blog' ) );
		} elseif ( $value > 100 ) {
			$validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'elite-blog' ) );
		}
		return $validity;
	}
endif;

if ( ! function_exists( 'elite_blog_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function elite_blog_get_homepage_sections() {
		$sections = array(
			'slider'     => esc_html__( 'Banner Slider Section', 'elite-blog' ),
			'categories' => esc_html__( 'Categories Section', 'elite-blog' ),
		);
		return $sections;
	}
}

/**
 * Renders customizer section link
 */
function elite_blog_section_link( $section_id ) {
	$section_name      = str_replace( 'elite_blog_', ' ', $section_id );
	$section_name      = str_replace( '_', ' ', $section_name );
	$starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $starting_notation . $section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function elite_blog_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				inset-inline-start: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}
			.section-link-title {
				padding: 0 10px;
			}
			.banner-section{
				position: relative;
			}
			.banner-section .section-link{
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'elite_blog_section_link_css' );

/**
 * Breadcrumb.
 */
function elite_blog_breadcrumb( $args = array() ) {
	if ( ! get_theme_mod( 'elite_blog_enable_breadcrumb', true ) ) {
		return;
	}

	$args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $args );
}
add_action( 'elite_blog_breadcrumb', 'elite_blog_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function elite_blog_breadcrumb_trail_print_styles() {
	$breadcrumb_separator = get_theme_mod( 'elite_blog_breadcrumb_separator', '/' );

	$style = '
	.breadcrumbs ul li::after {
		content: "' . $breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		$style = apply_filters( 'elite_blog_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $style ) ) );

	if ( $style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'elite_blog_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function elite_blog_render_posts_pagination() {
	$is_pagination_enabled = get_theme_mod( 'elite_blog_enable_pagination', true );
	if ( $is_pagination_enabled ) {
		$pagination_type = get_theme_mod( 'elite_blog_pagination_type', 'default' );
		if ( 'default' === $pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'elite_blog_posts_pagination', 'elite_blog_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function elite_blog_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span>',
		)
	);
}
add_action( 'elite_blog_post_navigation', 'elite_blog_render_post_navigation' );

/**
 * Adds footer copyright text.
 */
function elite_blog_output_footer_copyright_content() {
	$theme_data = wp_get_theme();
	$search     = array( '[the-year]', '[site-link]' );
	$replace    = array( date( 'Y' ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
	/* translators: 1: Year, 2: Site Title with home URL. */
	$copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'elite-blog' ), '[the-year]', '[site-link]' );
	$copyright_text    = get_theme_mod( 'elite_blog_footer_copyright_text', $copyright_default );
	$copyright_text    = str_replace( $search, $replace, $copyright_text );
	$copyright_text   .= esc_html( ' | ' . $theme_data->get( 'Name' ) ) . '&nbsp;' . esc_html__( 'by', 'elite-blog' ) . '&nbsp;<a target="_blank" href="' . esc_url( $theme_data->get( 'AuthorURI' ) ) . '">' . esc_html( ucwords( $theme_data->get( 'Author' ) ) ) . '</a>';
	/* translators: %s: WordPress.org URL */
	$copyright_text .= sprintf( esc_html__( ' | Powered by %s', 'elite-blog' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'elite-blog' ) ) . '" target="_blank">WordPress</a>. ' );
	?>
	<p><?php echo wp_kses_post( $copyright_text ); ?></p>					
	<?php
}
add_action( 'elite_blog_footer_copyright', 'elite_blog_output_footer_copyright_content' );
