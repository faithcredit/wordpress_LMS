<?php
/**
 * Password protected trait
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\Border;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Typography;
use LottaFramework\Facades\Css;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! trait_exists( 'Yuki_Password_Protected' ) ) {
	/**
	 * Password Protected controls
	 */
	trait Yuki_Password_Protected {

		/**
		 * @return array
		 */
		protected function getPasswordProtectedStyleControls() {
			return [
				( new Typography( 'password-form-typography' ) )
					->setLabel( __( 'Typography', 'yuki' ) )
					->setDefaultValue( [
						'family'     => 'inherit',
						'fontSize'   => '1rem',
						'variant'    => '400',
						'lineHeight' => '1.5em'
					] )
				,
				( new Separator() ),
				( new Background( 'password-background' ) )
					->setLabel( __( 'Background', 'yuki' ) )
					->setDefaultValue( [
						'type'  => 'color',
						'color' => 'var(--yuki-accent-active)',
					] )
				,
				( new Separator() ),
				( new Border( 'password-border' ) )
					->setLabel( __( 'Border', 'yuki' ) )
					->setDefaultBorder( 1, 'none', 'var(--yuki-base-200)' )
				,
				( new Separator() ),
				( new ColorPicker( 'password-text-color' ) )
					->setLabel( __( 'Text Color', 'yuki' ) )
					->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-base-color)' )
				,
				( new ColorPicker( 'password-form-input-color' ) )
					->setLabel( __( 'Input Color', 'yuki' ) )
					->enableAlpha()
					->addColor( 'background', __( 'Background', 'yuki' ), 'var(--yuki-base-100)' )
					->addColor( 'text', __( 'Text', 'yuki' ), 'var(--yuki-accent-active)' )
					->addColor( 'border', __( 'Border', 'yuki' ), 'var(--yuki-base-300)' )
					->addColor( 'active', __( 'Active', 'yuki' ), 'var(--yuki-primary-color)' )
				,
			];
		}

		/**
		 * @param $options
		 * @param $settings
		 *
		 * @return array
		 */
		protected function getPasswordProtectedCss( $options, $settings ) {
			return array_merge(
				Css::typography( $options->get( 'password-form-typography', $settings ) ),
				Css::background( $options->get( 'password-background', $settings ) ),
				Css::border( $options->get( 'password-border', $settings ) ),
				Css::colors( $options->get( 'password-text-color', $settings ), [
					'initial' => '--yuki-initial-color',
				] ),
				Css::colors( $options->get( 'password-form-input-color', $settings ), [
					'background' => '--yuki-form-background-color',
					'text'       => '--yuki-form-text-color',
					'border'     => '--yuki-form-border-color',
					'active'     => '--yuki-form-active-color',
				] )
			);
		}

		/**
		 * Render password protected input
		 */
		protected function renderPasswordProtectedInput() {
			if ( ! post_password_required() ) {
				return;
			}

			add_filter( 'the_password_form', function () {
				$output = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass' ) ) . '" method="post">';
				$output .= yuki_image( 'lock' );
				$output .= '<p>' . esc_html( get_the_title() ) . '</p>';
				$output .= '<input type="password" name="post_password" id="post-' . esc_attr( get_the_id() ) . '" placeholder="' . __( 'Type and hit Enter...', 'yuki' ) . '">';
				$output .= '</form>';

				return $output;
			} );

			echo '<div class="yuki-post-item-protected">';
			echo '<div class="yuki-post-protected-form yuki-form">';
			echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
			echo '</div>';
		}
	}
}
