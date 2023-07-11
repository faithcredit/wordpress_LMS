<?php
/**
 * Yuki admin functions
 *
 * @package Yuki
 */

use LottaFramework\Utils;

if ( ! function_exists( 'yuki_dismiss_notice' ) ) {
	/**
	 * Dismiss admin notice
	 */
	function yuki_dismiss_notice() {
		global $current_user;

		$user_id = $current_user->ID;

		$dismiss_option = filter_input( INPUT_GET, 'yuki_dismiss', FILTER_UNSAFE_RAW );
		if ( is_string( $dismiss_option ) ) {
			add_user_meta( $user_id, "yuki_dismissed_$dismiss_option", 'true', true );
			// delete_user_meta( $user_id, "yuki_dismissed_$dismiss_option", 'true', true );
			wp_die( '', '', array( 'response' => 200 ) );
		}
	}
}
add_action( 'admin_init', 'yuki_dismiss_notice' );
if ( ! function_exists( 'yuki_premium_child_theme_notice' ) ) {
	/**
	 * Show premium child theme download notice
	 */
	function yuki_premium_child_theme_notice() {
		get_template_part( 'template-parts/admin-premium-child-notice' );
	}
}

// Yuki as parent theme
if ( get_stylesheet() !== 'yuki' && get_stylesheet() !== 'yuki-premium' ) {
	// Not using premium child theme but yuki-premium has been installed
	$premium = wp_get_theme( 'yuki-premium' );
	if ( $premium->exists() && ! Utils::str_ends_with( get_template(), 'premium' ) ) {
		/**
		 * Show download premium child theme notice
		 */
		add_action( 'admin_notices', 'yuki_premium_child_theme_notice' );
	}
}
