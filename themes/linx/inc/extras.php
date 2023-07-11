<?php

function linx_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( linx_get_option( 'linx_enable_dark_mode', false ) == true ) {
		$classes[] = 'dark-mode';
	}

	$navbar_style = linx_get_option( 'linx_navbar_style', 'sticky' );
	if ( is_singular( 'post' ) || is_page() ) {
  	$navbar_style = linx_compare_options( $navbar_style, rwmb_meta( 'linx_navbar_style' ) );
	}
	$classes[] = 'navbar-' . $navbar_style;

	if ( linx_get_option( 'linx_navbar_full', false ) == true ) {
		$classes[] = 'navbar-full';
	}

	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-thumbnail';
	}

	if ( linx_show_hero() ) {
		$classes[] = 'with-hero';

		if ( is_front_page() ) {
			$classes[] = 'hero-' . linx_get_option( 'linx_hero_home_style', 'none' );
			$classes[] = 'hero-' . linx_get_option( 'linx_hero_home_content', 'image' );
		} elseif ( is_singular( 'post' ) || is_page() ) {
			$classes[] = 'hero-' . linx_compare_options( linx_get_option( 'linx_hero_single_style', 'none' ), rwmb_meta( 'linx_hero_single_style' ) );
			$classes[] = get_post_format() ? 'hero-' . get_post_format() : 'hero-image';
		}
	}

	if ( linx_show_featured() ) {
		$classes[] = 'with-featured';
	}

	if ( linx_show_featured_wrapper() ) {
		$classes[] = 'with-featured-wrapper';
	}

	if ( linx_show_category_boxes() ) {
		$classes[] = 'with-category-boxes';
	}

	if ( linx_show_instagram() ) {
		$classes[] = 'with-instagram-slider';
	}

	if ( linx_get_option( 'linx_disable_masonry', false ) == false ) {
		$classes[] = 'with-masonry';
	}

	$classes[] = 'layout-' . linx_get_option( 'linx_main_layout', 'three' );

	$classes[] = 'sidebar-' . linx_sidebar();

	$classes[] = 'pagination-' . linx_get_option( 'linx_pagination', 'infinite_button' );

	if ( get_previous_posts_link() ) {
		$classes[] = 'paged-previous';
	}

	if ( get_next_posts_link() ) {
		$classes[] = 'paged-next';
	}

	if ( linx_get_option( 'linx_enable_offcanvas_social', false ) == true ) {
		$classes[] = 'social-off-canvas';
	}

	if ( linx_show_ads( 'before_header' ) ) {
		$classes[] = 'ads-before-header';
	}

	if ( linx_show_ads( 'after_header' ) ) {
		$classes[] = 'ads-after-header';
	}

	return $classes;
}
add_filter( 'body_class', 'linx_body_classes' );

function linx_opengraph_tags() {
  global $post;

  if ( is_singular( 'post' ) ) : ?>
    <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <meta property="og:url" content="<?php echo esc_url( get_the_permalink() ); ?>">

    <?php
			$description = strip_tags( $post->post_content );
			$description = $description != '' ? substr( $description, 0, 200 ) : get_bloginfo( 'description' );
    ?>
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">

    <?php if ( has_post_thumbnail() ) : ?>
      <meta property="og:image" content="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>">
    <?php endif;
  endif;
}
add_action( 'wp_head', 'linx_opengraph_tags' );

function linx_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'linx_pingback_header' );

function linx_get_option( $setting, $default ) {
	$options = get_option( 'linx_admin_options', array() );
  $value = $default;

  if ( isset( $options[ $setting ] ) ) {
    $value = $options[ $setting ];
  }

  return $value;
}

function linx_compare_options( $global, $override ) {
  if ( $global == $override || $override == '' ) {
    return $global;
  } else {
    return $override;
  }
}

function linx_sidebar() {
	if ( is_singular( 'post' ) || is_page() ) {
		return linx_compare_options( linx_get_option( 'linx_sidebar_single', 'right' ), rwmb_meta( 'linx_sidebar_single' ) );
	} elseif ( is_archive() ) {
		return linx_get_option( 'linx_sidebar_archive', 'right' );
	} else {
		return linx_get_option( 'linx_sidebar_home', 'right' );
	}
}

function linx_column_classes( $sidebar ) {
	$content_column_class = 'col-lg-9';
	$sidebar_column_class = 'col-lg-3 hidden-xs hidden-sm hidden-md';
	$related_column_class = 'col-lg-3 order-lg-first';

	if ( is_singular( 'post' ) ) {
		if ( $sidebar != 'none' && linx_get_option( 'linx_disable_related_posts', false ) == false && linx_related_posts() ) {
			$content_column_class = 'col-lg-6';
		} elseif ( $sidebar != 'none' || ( linx_get_option( 'linx_disable_related_posts', false ) == false && linx_related_posts() ) ) {
			$content_column_class = 'col-lg-9';
		} else {
			$content_column_class = 'col-lg-12';
		}
	} else {
		if ( $sidebar == 'none' ) {
			$content_column_class = 'col-lg-12';
		}
	}

	if ( $sidebar == 'left' ) {
		$sidebar_column_class .= ' order-lg-first';
		$related_column_class = 'col-lg-3 order-lg-last';
	}

	return array( $content_column_class, $sidebar_column_class, $related_column_class );
}

function linx_grid_class() {
	$sidebar = linx_sidebar();
	$layout = linx_get_option( 'linx_main_layout', 'three' );

	switch ( $layout ) {
		case 'one' :
			$grid_class = 'col-12';
			break;
		case 'two' :
			$grid_class = 'col-md-6';
			break;
		case 'three' :
			$grid_class = $sidebar != 'none' ? 'col-md-6 col-xl-4' : 'col-md-6 col-lg-4';
			break;
		case 'four' :
			$grid_class = $sidebar != 'none' ? 'col-md-6 col-xl-4' : 'col-md-6 col-lg-4 col-xl-3';
			break;
	}

	if ( linx_is_first_post() && linx_get_option( 'linx_first_post_full', false ) == true ) {
		$grid_class = 'col-12';
	}

	$grid_class .= ' grid-item';

	return $grid_class;
}

function linx_is_first_post() {
  global $wp_query;
	return $wp_query->current_post == 0 && ! is_paged();
}

function linx_is_gif() {
  if ( has_post_thumbnail() ) {
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $featured_image = $featured_image[0];

    $path_parts = pathinfo( $featured_image );
    $extension = $path_parts['extension'];

    return $extension == 'gif' ? true : false;
  }

  return false;
}

function linx_related_posts() {
	$type = 'tag';
	$terms = get_the_tags();

	if ( ! $terms ) {
		$terms = get_the_category();
		$type = 'category';
	}

	if ( $terms && linx_get_option( 'linx_disable_related_posts', false ) == false ) {
		$args = array(
			'post__not_in' => array( get_the_ID() ),
			'posts_per_page' => 3,
			'orderby' => 'rand'
		);

		$term_ids = array();

		foreach ( $terms as $term ) {
			$term_ids[] = $term->term_id;
		}

		switch ( $type ) {
			case 'tag' :
				$args['tag__in'] = $term_ids;
				break;
			case 'category' :
				$args['category__in'] = $term_ids;
				break;
		}

		$related_posts = new WP_Query( $args );

		if ( $related_posts->have_posts() ) {
			return $related_posts;
		}
	}

	return false;
}

function linx_show_hero() {
	$queried_object = get_queried_object();
	return
		( is_front_page() && ! is_paged() && linx_get_option( 'linx_hero_home_style', 'none' ) != 'none' ) ||
		( is_singular( 'post' ) || is_page() ) && linx_compare_options( linx_get_option( 'linx_hero_single_style', 'none' ), rwmb_meta( 'linx_hero_single_style', '', $queried_object->ID ) ) != 'none';
}

function linx_show_featured() {
	if ( linx_get_option( 'linx_featured_enable_category', false ) == true ) {
		return ( is_front_page() || is_category() ) && linx_get_option( 'linx_featured_style', 'none' ) != 'none';
	}

	return is_front_page() && linx_get_option( 'linx_featured_style', 'none' ) != 'none';
}

function linx_show_featured_wrapper() {
	return linx_show_featured() && ( linx_get_option( 'linx_featured_wrapper_image', '' ) != '' || linx_get_option( 'linx_featured_wrapper_color', '' ) != '' );
}

function linx_show_category_boxes() {
	return is_front_page() && linx_get_option( 'linx_disable_category_boxes', false ) == false && linx_get_option( 'linx_box_categories', '' ) != '';
}

function linx_show_instagram() {
	return is_front_page() && is_active_sidebar( 'sidebar-4' );
}

function linx_show_ads( $location ) {
	$option = 'linx_ads_' . $location . '_';

	return
		linx_get_option( $option . 'style', 'none' ) != 'none' &&
		(
			( is_singular( 'post' ) && linx_get_option( $option . 'hide_post', false ) == false ) ||
			( is_page() && linx_get_option( $option . 'hide_page', false ) == false ) ||
			( ( is_archive() || is_search() ) && linx_get_option( $option . 'hide_archive', false ) == false ) ||
			( is_front_page() && linx_get_option( $option . 'hide_home', false ) == false )
		);
}

function linx_thumbnail_ratio( $image_size ) {
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );

	if ( $thumbnail ) {
		return $thumbnail[2] / $thumbnail[1] * 100 . '%';
	} else {
		return 0;	
	}
}

function linx_excerpt_length( $length ) {
	return linx_get_option( 'linx_excerpt_length', 12 );
}
add_filter( 'excerpt_length', 'linx_excerpt_length', 999 );

function linx_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'linx_excerpt_more' );

function linx_archive_title( $title ) {
	if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
  	$title = single_tag_title( '', false );
  } elseif ( is_author() ) {
		$title = get_the_author();
	}

  return $title;
}
add_filter( 'get_the_archive_title', 'linx_archive_title' );

function linx_social_links() {
	return array(
    array( 'name' => 'Facebook', 'option' => 'facebook_url', 'icon' => 'facebook', 'color' => '#3b5998' ),
    array( 'name' => 'Twitter', 'option' => 'twitter_url', 'icon' => 'twitter', 'color' => '#1da1f2' ),
    array( 'name' => 'Instagram', 'option' => 'instagram_url', 'icon' => 'instagram', 'color' => '#e1306c' ),
    array( 'name' => 'Pinterest', 'option' => 'pinterest_url', 'icon' => 'pinterest', 'color' => '#bd081c' ),
    array( 'name' => 'Google+', 'option' => 'google_plus_url', 'icon' => 'google-plus', 'color' => '#dd4b39' ),
    array( 'name' => 'YouTube', 'option' => 'youtube_url', 'icon' => 'youtube-play', 'color' => '#ff0000' ),
    array( 'name' => 'Dribbble', 'option' => 'dribbble_url', 'icon' => 'dribbble', 'color' => '#ea4c89' ),
    array( 'name' => 'LinkedIn', 'option' => 'linkedin_url', 'icon' => 'linkedin', 'color' => '#0077b5' ),
    array( 'name' => 'Behance', 'option' => 'behance_url', 'icon' => 'behance', 'color' => '#1769ff' ),
    array( 'name' => 'Flickr', 'option' => 'flickr_url', 'icon' => 'flickr', 'color' => '#0063dc' ),
    array( 'name' => 'Reddit', 'option' => 'reddit_url', 'icon' => 'reddit', 'color' => '#ff4500' ),
    array( 'name' => 'SoundCloud', 'option' => 'soundcloud_url', 'icon' => 'soundcloud', 'color' => '#ff8800' ),
    array( 'name' => 'Steam', 'option' => 'steam_url', 'icon' => 'steam', 'color' => '#000000' ),
    array( 'name' => 'Twitch', 'option' => 'twitch_url', 'icon' => 'twitch', 'color' => '#6441a5' ),
    array( 'name' => 'VK', 'option' => 'vk_url', 'icon' => 'vk-box', 'color' => '#45668e' ),
    array( 'name' => 'RSS', 'option' => 'rss_url', 'icon' => 'rss', 'color' => '#f26522' ),
  );
}

function linx_sharing_links() {
	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'linx_full_1130' );
	
	return array(
		'facebook' => array(
			'link' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_the_permalink() ),
			'icon' => 'facebook',
		),
		'twitter' => array(
			'link' => 'https://twitter.com/intent/tweet?text=' . urlencode( get_the_title() ) . '&url=' . urlencode( get_the_permalink() ),
			'icon' => 'twitter',
		),
		/* error is occured in &media part, so marked temporarily by David C. Hunter...
		'pinterest' => array(
			'link' => 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_the_permalink() ) . '&media=' . urlencode( $featured_image[0] ) . '&description=' . urlencode( get_the_title() ),
			'icon' => 'pinterest',
		),*/
		'google' => array(
			'link' => 'https://plus.google.com/share?url=' . urlencode( get_the_permalink() ) . '&text=' . urlencode( get_the_title() ),
			'icon' => 'google-plus',
		),
		'linkedin' => array(
			'link' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),
			'icon' => 'linkedin',
		),
		'reddit' => array(
			'link' => 'https://reddit.com/submit?url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),
			'icon' => 'reddit',
		),
		'tumblr' => array(
			'link' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),
			'icon' => 'tumblr',
		),
		'vk' => array(
			'link' => 'http://vk.com/share.php?url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),
			'icon' => 'vk',
		),
		'email' => array(
			'link' => 'mailto:?subject=' . get_the_title() . '&body=' . urlencode( get_the_permalink() ),
			'icon' => 'email',
		),
	);
}

function linx_like() {
	check_ajax_referer( 'linx_like_nonce', 'nonce' );

  $post_id = $_POST['post_id'];
	$current_count = get_post_meta( $post_id, 'linx_like', true );
	
  if ( $current_count == '' ) {
    $current_count = 0;
  }

  $updated_count = $current_count + 1;
  update_post_meta( $post_id, 'linx_like', $updated_count );

  wp_die( (string) $updated_count );
}
add_action( 'wp_ajax_linx_like', 'linx_like' );
add_action( 'wp_ajax_nopriv_linx_like', 'linx_like' );

function linx_unlike() {
  check_ajax_referer( 'linx_unlike_nonce', 'nonce' );

  $post_id = $_POST['post_id'];
  $current_count = get_post_meta( $post_id, 'linx_like', true );

  if ( $current_count == '' || $current_count == '0' ) {
    $current_count = 1;
  }

  $updated_count = $current_count - 1;

  if ( $updated_count >= 0 ) {
    update_post_meta( $post_id, 'linx_like', $updated_count );
  }

  wp_die( (string) $updated_count );
}
add_action( 'wp_ajax_linx_unlike', 'linx_unlike' );
add_action( 'wp_ajax_nopriv_linx_unlike', 'linx_unlike' );

function linx_view() {
	$post_id = get_the_ID();
	$current_count = get_post_meta( $post_id, 'linx_view', true );

	if ( $current_count == '' ) {
    $current_count = 0;
  }

	if ( ! is_user_logged_in() ) {
		$current_count = $current_count + 1;
	}

  update_post_meta( $post_id, 'linx_view', $current_count );
}

function linx_posts_per_page( $query ) {
	if ( $query->is_main_query() && ! is_admin() ) {
		$ppp = get_option( 'posts_per_page' );
		$offset = 1;
		
		if ( ! $query->is_paged() ) {
      $query->set( 'posts_per_page', $ppp + $offset );
    } else {
      $offset = $offset + ( $query->query_vars['paged'] - 1 ) * $ppp;
      $query->set( 'posts_per_page', $ppp );
      $query->set( 'offset', $offset );
    }
	}
}

function linx_pagination_offset( $found_posts, $query ) {
	$offset = 1;

	if ( $query->is_main_query() ) {
		$found_posts = $found_posts - $offset;
	}
	
	return $found_posts;
}

if ( linx_get_option( 'linx_first_post_full', false ) == true ) {
	add_action( 'pre_get_posts', 'linx_posts_per_page' );
	add_filter( 'found_posts', 'linx_pagination_offset', 10, 2 );
}

function linx_lazy_content_images( $content ) {
	if ( ! is_admin() && $content ) {
		$dom = new DOMDocument();
		libxml_use_internal_errors( true );
		$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
		libxml_clear_errors();

		$imgs = $dom->getElementsByTagName( 'img' );

		foreach ( $imgs as $img ) {
			$image_classes = $img->getAttribute( 'class' );
			$img->setAttribute( 'class', 'lazyload ' . $image_classes );
		}

		$content = $dom->saveHTML();
		$content = str_replace( 'src', 'data-src', $content );
	}
	
	return $content;
}
// add_filter( 'the_content', 'linx_lazy_content_images' );

function linx_color_add_category() { ?>
	<div class="form-field term-color-wrap">
		<label for="category-color"><?php echo esc_html__( 'Color', 'linx' ); ?></label>
		<input name="color" class="colorpicker" id="category-color">
	</div> <?php
}
add_action( 'category_add_form_fields', 'linx_color_add_category' );

function linx_color_edit_category( $term ) {
	$color = get_term_meta( $term->term_id, 'category_color', true ); ?>
	<tr class="form-field term-color-wrap">
		<th scope="row"><?php echo esc_html__( 'Color', 'linx' ); ?></th>
		<td><input name="color" class="colorpicker" id="category-color" value="<?php echo esc_attr( $color ); ?>"></td>
	</tr> <?php
}
add_action( 'category_edit_form_fields', 'linx_color_edit_category' );

function linx_save_term_meta( $term_id ) {
	if ( isset( $_POST['color'] ) && ! empty( $_POST['color'] ) ) {
		update_term_meta( $term_id, 'category_color', $_POST['color'] );
	} else {
		delete_term_meta( $term_id, 'category_color' );
	}
}
add_action( 'created_category', 'linx_save_term_meta' );
add_action( 'edited_category', 'linx_save_term_meta' );

function linx_category_colorpicker_script() {
	if ( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
		return;
	}
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'linx_category_colorpicker_script' );

function linx_category_colorpicker_init() {
	if ( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
		return;
	} ?>

	<script>
		jQuery( document ).ready( function() {
			jQuery( '.colorpicker' ).wpColorPicker();
		} );
	</script> <?php
}
add_action( 'admin_print_scripts', 'linx_category_colorpicker_init', 20 );
