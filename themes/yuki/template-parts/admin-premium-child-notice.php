<?php
/**
 * Premium child theme notice
 *
 * @package Yuki
 */

global $current_user;
$user_id = $current_user->ID;

if ( get_user_meta( $user_id, 'yuki_dismissed_premium_' . get_template() ) ) {
	return;
}

$dismiss_url = add_query_arg( array( 'yuki_dismiss' => 'premium_' . get_template(), ), admin_url() );
?>

<div data-dismiss-url="<?php echo esc_url( $dismiss_url ) ?>"
     class="yuki-theme-notice yuki-theme-notice-has-label notice notice-error">
    <label class="yuki-notice-label"><?php esc_html_e( 'Yuki', 'yuki' ); ?></label>
    <p class="yuki-notice-message">
        <span class="yuki-error-message">
		<?php
		esc_html_e( 'The child theme you are using is for the Yuki Free Edition. ', 'yuki' );
		?>
        </span>
		<?php
		echo wp_kses_post( sprintf(
			__( 'Please go %s here %s to download the premium version.', 'yuki' ),
			'<b><a href="' . esc_url( 'https://github.com/wpmoose/' . get_stylesheet() . '/releases' ) . '" target="_blank">',
			'</b></a>'
		) );
		?>
    </p>

    <p class="yuki-notice-sub-message">
		<?php esc_html_e( 'Note: Asset with a premium suffix is premium Edition.', 'yuki' ); ?>
    </p>

    <button type="button" class="yuki-notice-dismiss">
		<?php esc_html_e( 'Dismiss', 'yuki' ); ?>
    </button>
</div>
