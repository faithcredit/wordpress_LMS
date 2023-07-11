<?php
		// Load WooCommerce default styles if WooCommerce is active.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	wp_enqueue_style(
		'seedprod-woocommerce-layout',
		str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-layout.css',
		'',
		defined( 'WC_VERSION' ) ? WC_VERSION : null,
		'all'
	);
	wp_enqueue_style(
		'seedprod-woocommerce-smallscreen',
		str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-smallscreen.css',
		'',
		defined( 'WC_VERSION' ) ? WC_VERSION : null,
		'only screen and (max-width: 1088px)' // 768px default break + 320px for sidebar
	);
	wp_enqueue_style(
		'seedprod-woocommerce-general',
		str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce.css',
		'',
		defined( 'WC_VERSION' ) ? WC_VERSION : null,
		'all'
	);
}
// get settings.
if ( ! empty( $settings ) && isset( $settings->no_conflict_mode ) ) {
	$google_fonts_str = seedprod_lite_construct_font_str( $settings );
	$content          = $page->post_content;
	$lpage_uuid       = get_post_meta( $page->ID, '_seedprod_page_uuid', true );
} else {
	global $wpdb, $post;
	$settings         = json_decode( $post->post_content_filtered );
	$google_fonts_str = seedprod_lite_construct_font_str( json_decode( $post->post_content_filtered, true ) );
	$content          = $post->post_content;
	$lpage_uuid       = get_post_meta( $post->ID, '_seedprod_page_uuid', true );
}

// remove vue comment bug.
$content = str_replace( 'function(e,n,r,i){return fn(t,e,n,r,i,!0)}', '', $content );

$plugin_url = SEEDPROD_PLUGIN_URL;



// check to see if we have a shortcode, form or giveaway.
$settings_str = wp_json_encode( $settings );
if ( strpos( $settings_str, 'contact-form' ) !== false ) {
	$settings->no_conflict_mode = false;
}
if ( strpos( $settings_str, 'giveaway' ) !== false ) {
	$settings->no_conflict_mode = false;
}

$include_seed_fb_sdk                 = false;
$include_seed_twitter_sdk            = false;
$include_seedprod_headline_sdk       = false;
$include_seedprod_animation_sdk      = false;
$include_gallery_lightbox_sdk        = false;
$include_gallery_sdk                 = false;
$include_counter_sdk                 = false;
$include_seedprod_image_lightbox_sdk = false;
$include_beforeaftertoggle_sdk       = false;
$include_hotspot_sdk                 = false;




// get url
$scheme             = 'http';
$server_request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
$server_http_host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
$server_port        = isset( $_SERVER['SERVER_PORT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_PORT'] ) ) : '';
if ( '443' == $server_port ) {
	$scheme = 'https';
}
if ( ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' == $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$scheme = 'https';
}
$ogurl = "$scheme://$server_http_host$server_request_uri";

// subscriber callback
$seedprod_subscribe_callback_ajax_url          = html_entity_decode( wp_nonce_url( admin_url() . 'admin-ajax.php?action=seedprod_lite_subscribe_callback', 'seedprod_lite_subscribe_callback' ) );
$seedprod_subscribe_callback_fallback_ajax_url = '';
$seedprod_subscribe_callback_ajax_url_parsed   = wp_parse_url( $seedprod_subscribe_callback_ajax_url );
if ( ! empty( $seedprod_subscribe_callback_ajax_url_parsed['path'] ) ) {
	$seedprod_subscribe_callback_fallback_ajax_url = $seedprod_subscribe_callback_ajax_url_parsed['path'] . '?' . $seedprod_subscribe_callback_ajax_url_parsed['query'];
}

// If site uses WP Rocket, disable minify
seedprod_lite_wprocket_disable_minify();

// allow acf shortcode to work in block themes
add_filter( 'acf/shortcode/allow_in_block_themes_outside_content', '__return_true' );

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	add_filter( 'woocommerce_enqueue_styles', 'seedprod_lite_wc_dequeue_styles' );
	/**
	 * Remove WooCommerce Styles
	 */
	function seedprod_lite_wc_dequeue_styles( $enqueue_styles ) {
		// Dequeue main syles as it may serve theme-specific styles for themes that may not match SeedProd page
		unset( $enqueue_styles['woocommerce-general'] );

		// Enqueue generic WooCommerce stylesheet for predictable defaults on SeedProd pages
		$enqueue_styles['woocommerce-general'] = array(
			'src'     => str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce.css',
			'deps'    => '',
			'version' => defined( 'WC_VERSION' ) ? WC_VERSION : null,
			'media'   => 'all',
			'has_rtl' => true,
		);
		return $enqueue_styles;
	}
}

if ( ! empty( $settings ) ) {
	?>
<!DOCTYPE html>
<html class="sp-html 
	<?php
	if ( wp_is_mobile() ) {
		echo 'sp-is-mobile';
	}
	?>
	<?php
	if ( is_user_logged_in() ) {
		echo 'sp-is-logged-in';
	}
	?>
	sp-seedprod sp-h-full" <?php language_attributes(); ?>>
<head>
	<?php
	if ( ! empty( $settings->no_conflict_mode ) ) {
		?>
		<?php if ( ! empty( $settings->seo_title ) ) : ?>
<title><?php echo esc_html( $settings->seo_title ); ?></title>
<?php endif; ?>
		<?php if ( ! empty( $settings->seo_description ) ) : ?>
<meta name="description" content="<?php echo esc_attr( $settings->seo_description ); ?>">
<?php endif; ?>
		<?php if ( ! empty( $settings->favicon ) ) : ?>
<link href="<?php echo esc_attr( $settings->favicon ); ?>" rel="shortcut icon" type="image/x-icon" />
<?php endif; ?>


		<?php if ( ! empty( $settings->no_index ) ) : ?>
<meta name="robots" content="noindex">
<?php endif; ?>



<!-- Open Graph -->
<meta property="og:url" content="<?php echo esc_url( $ogurl ); ?>" />
<meta property="og:type" content="website" />
		<?php if ( ! empty( $settings->seo_title ) ) : ?>
<meta property="og:title" content="<?php echo esc_attr( $settings->seo_title ); ?>" />
<?php endif; ?>
		<?php if ( ! empty( $settings->seo_description ) ) : ?>
<meta property="og:description" content="<?php echo esc_attr( $settings->seo_description ); ?>" />
<?php endif; ?>
		<?php if ( ! empty( $settings->social_thumbnail ) ) : ?>
<meta property="og:image" content="<?php echo esc_url( $settings->social_thumbnail ); ?>" />
<?php elseif ( ! empty( $settings->logo ) ) : ?>
<meta property="og:image" content="<?php echo esc_url( $settings->logo ); ?>" />
<?php endif; ?>

<!-- Twitter Card -->
<meta name="twitter:card" content="summary" />
		<?php if ( ! empty( $settings->seo_title ) ) : ?>
<meta name="twitter:title" content="<?php echo esc_attr( $settings->seo_title ); ?>" />
<?php endif; ?>
		<?php if ( ! empty( $settings->seo_description ) ) : ?>
<meta name="twitter:description" content="<?php echo esc_attr( $settings->seo_description ); ?>" />
<?php endif; ?>
		<?php if ( ! empty( $settings->social_thumbnail ) ) : ?>
<meta property="twitter:image" content="<?php echo esc_url( $settings->social_thumbnail ); ?>" />
<?php endif; ?>

		<?php
	}
	?>
	<?php if ( empty( $settings->no_conflict_mode ) ) : ?>
		<?php
		$sp_title = wp_title( '&raquo;', false );
		if ( ! empty( $sp_title ) ) {
			//remove extra title tag
			?>
<?php } ?>
	<?php endif; ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Default CSS -->
<link rel='stylesheet' id='seedprod-css-css'  href='<?php echo esc_url( $plugin_url ); ?>public/css/tailwind.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
<link rel='stylesheet' id='seedprod-fontawesome-css'  href='<?php echo esc_url( $plugin_url ); ?>public/fontawesome/css/all.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>

	<?php if ( true === $include_seedprod_headline_sdk ) { ?>
	<link rel='stylesheet' id='seedprod-animate-css'  href='<?php echo esc_url( $plugin_url ); ?>public/css/sp-animate.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
	<?php } ?>

	<?php if ( true === $include_seedprod_animation_sdk ) { ?>
	<link rel='stylesheet'   href='<?php echo esc_url( $plugin_url ); ?>public/css/animate.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
	<?php } ?>

	<?php if ( true === $include_gallery_sdk ) { ?>
	<link rel="stylesheet" id='seedprod-gallerylightbox-css' href="<?php echo esc_url( $plugin_url ); ?>public/css/seedprod-gallery-block.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>" type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
	<?php } ?>

	<?php if ( true === $include_hotspot_sdk ) { ?>
	<link rel="stylesheet" id='seedprod-hotspot-tooltipster-css' href="<?php echo esc_url( $plugin_url ); ?>public/css/tooltipster.bundle.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>" type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
	<?php } ?>

	<?php if ( true === $include_beforeaftertoggle_sdk ) { ?>
	<link rel='stylesheet' id='seedprod-twentytwenty-css'  href='<?php echo esc_url( $plugin_url ); ?>public/css/before-after-toggle.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
<?php } ?>
		

	<?php if ( true === $include_seedprod_image_lightbox_sdk ) { ?>
	<link rel='stylesheet' id='seedprod-image-lightbox-css'  href='<?php echo esc_url( $plugin_url ); ?>public/css/lightbox.min.css?ver=<?php echo esc_attr( SEEDPROD_VERSION ); ?>' type='text/css' media='all' /> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
	<?php } ?>

	<?php if ( ! empty( $google_fonts_str ) ) : ?>
<!-- Google Font -->
<link rel="stylesheet" href="<?php echo esc_url( $google_fonts_str ); ?>"> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet ?>
<?php endif; ?>


	<?php
	?>

<!-- Global Styles -->
<style>
	<?php echo $settings->document->settings->headCss; // phpcs:ignore ?>

	<?php if ( ! empty( $settings->document->settings->placeholderCss ) ) { ?>
		<?php echo $settings->document->settings->placeholderCss; // phpcs:ignore ?>
<?php } ?>

	<?php // Replace classnames for device visibility like below ?>

	@media only screen and (max-width: 480px) {
		<?php if ( ! empty( $settings->document->settings->mobileCss ) ) { ?>
			<?php echo str_replace( '.sp-mobile-view', '', $settings->document->settings->mobileCss );  // phpcs:ignore?>
		<?php } ?>

		<?php if ( ! empty( $settings->document->settings->mobileVisibilityCss ) ) { ?>
			<?php echo str_replace( '.sp-mobile-view', '', $settings->document->settings->mobileVisibilityCss ); // phpcs:ignore ?>
		<?php } ?>
	}

	@media only screen and (min-width: 480px) {
		<?php if ( ! empty( $settings->document->settings->desktopVisibilityCss ) ) { ?>
			<?php echo $settings->document->settings->desktopVisibilityCss; // phpcs:ignore ?>
		<?php } ?>
	}

	<?php
	// Get mobile css & Remove inline data attributes.
	preg_match_all( '/data-mobile-css="([^"]*)"/', $content, $matches );
	if ( ! empty( $matches ) ) {
		// remove inline data attributes
		foreach ( $matches[0] as $v ) {
			$content = str_replace( $v, '', $content );
		}
	}

	preg_match_all( '/data-mobile-visibility="([^"]*)"/', $content, $matches );
	if ( ! empty( $matches ) ) {
		// remove inline data attributes
		foreach ( $matches[0] as $v ) {
			$content = str_replace( $v, '', $content );
		}
	}

	preg_match_all( '/data-desktop-visibility="([^"]*)"/', $content, $matches );
	if ( ! empty( $matches ) ) {
		// remove inline data attributes
		foreach ( $matches[0] as $v ) {
			$content = str_replace( $v, '', $content );
		}
	}
	?>


	<?php if ( ! empty( $settings->document->settings->customCss ) ) { ?>
/* Custom CSS */
		<?php
		echo $settings->document->settings->customCss; // phpcs:ignore
		?>
	<?php } ?>
</style>

<!-- JS -->
<script>
</script>
	<?php
	?>

<?php
	?>

	<?php if ( true === $include_gallery_lightbox_sdk ) { ?>
		<script src="<?php echo esc_url( $plugin_url ); ?>public/js/img-previewer.min.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
	<?php } ?>

	<?php 
	$seedprod_theme_enabled = get_option( 'seedprod_theme_enabled' );
	if ( ! $seedprod_theme_enabled ||  ! empty( $settings->no_conflict_mode )) { 
	?>
	<script src="<?php echo esc_url( $plugin_url ); ?>public/js/sp-scripts.min.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
	<?php } ?>
	<?php
	?>

	<?php if ( ! empty( $settings->document->settings->useVideoBg ) ) { ?>
<script src="<?php echo esc_url( $plugin_url ); ?>public/js/tubular.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
	<?php } ?>

	<?php
	?>


	<?php
	if ( empty( $settings->no_conflict_mode ) ) {
		wp_enqueue_script( 'jquery' );
		wp_head();
	} else {
		$include_url = trailingslashit( includes_url() );
		if ( empty( $settings->enable_wp_head_footer ) ) {
			echo '<script src="' . esc_url( $include_url ) . 'js/jquery/jquery.min.js"></script>' . "\n"; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
		}
	}


	?>
	<?php
	if ( ! empty( $settings->header_scripts ) ) {
		echo $settings->header_scripts; // phpcs:ignore
	}
	?>
</head>
<body class="spBg<?php echo esc_attr( $settings->document->settings->bgPosition ); ?> sp-h-full sp-antialiased sp-bg-slideshow">
	<?php
	if ( ! empty( $settings->body_scripts ) ) {
		echo $settings->body_scripts; // phpcs:ignore
	}
	?>

	<?php
	?>
	<?php
	?>
	<?php
	$server_http_host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$server_request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	$actual_link        = rawurlencode( ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http' ) . "://$server_http_host$server_request_uri" );
	$content            = str_replace( 'the_link', $actual_link, $content );
	$content            = do_shortcode( $content );
	if ( empty( $content ) ) {
		$content = '<h1 style="margin-top:80px; text-align:center; font-size: 22px">The content for this page is empty or has not been saved. Please edit this page and "Save" the contents in the builder.</h1>';
	}
	echo apply_filters( 'seedprod_lpage_content', $content );

	// TODO: Add a way to run content in the loop
	// if ( have_posts() ) {
	// 	while ( have_posts() ) {
	//      the_post();
	// 		$content = do_shortcode( $content );
	// 		echo apply_filters( 'seedprod_lpage_content', $content );
	// 	} // end while
	// } // end if
	?>



<div class="tv">
	<div class="screen mute" id="tv"></div>
</div>

	<?php
	if ( ! empty( $settings->show_powered_by_link ) ) {
		$aff_link = 'https://www.seedprod.com/?utm_source=seedprod-plugin&utm_medium=seedprod-frontend&utm_campaign=powered-by-link';
		if ( ! empty( $settings->affiliate_url ) ) {
			$aff_link = $settings->affiliate_url;
		}

		?>
<div class="sp-credit" >
	<a target="_blank" href="<?php echo esc_url( $aff_link ); ?>" rel="nofollow"><span>made with</span><img src="<?php echo esc_url( $plugin_url ); ?>public/svg/powered-by-logo.svg"></a>
</div>
		<?php
	}
	?>

<script>
	<?php
	if ( wp_is_mobile() ) {
		echo 'var sp_is_mobile = true;';
	} else {
		echo 'var sp_is_mobile = false;';}
	?>
	<?php
	?>

</script>

	<?php

	if ( true === $include_seedprod_image_lightbox_sdk ) {
		?>
		<script src="<?php echo esc_url( $plugin_url ); ?>public/js/lightbox.min.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
		<?php
	}


	if ( empty( $settings->no_conflict_mode ) ) {
		wp_footer();
	}
	?>
	<?php
	if ( ! empty( $settings->footer_scripts ) ) {
		echo $settings->footer_scripts; // phpcs:ignore
	}

	
	if ( true === $include_beforeaftertoggle_sdk ) {
		?>

<script src="<?php echo esc_url( $plugin_url ); ?>public/js/jquery.event.move.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
<script src="<?php echo esc_url( $plugin_url ); ?>public/js/jquery.twentytwenty.min.js" defer></script> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
		
		<?php
	}
	?>
</body>

</html>

	<?php
} ?>
