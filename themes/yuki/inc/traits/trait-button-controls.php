<?php
/**
 * Button trait
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Border;
use LottaFramework\Customizer\Controls\BoxShadow;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Spacing;
use LottaFramework\Customizer\Controls\Typography;
use LottaFramework\Facades\AsyncCss;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! trait_exists( 'Yuki_Button_Controls' ) ) {

	/**
	 * Button controls
	 */
	trait Yuki_Button_Controls {

		/**
		 * @param string $id
		 * @param array $defaults
		 *
		 * @return array
		 */
		protected function getButtonStyleControls( $id = '', $defaults = [] ) {

			$defaults = wp_parse_args( $defaults, [
				'selective-refresh' => false,
				'button-selector'   => null,
				'text-initial'      => 'var(--yuki-base-color)',
				'text-hover'        => 'var(--yuki-base-color)',
				'button-initial'    => 'var(--yuki-primary-active)',
				'button-hover'      => 'var(--yuki-accent-active)',
				'border-initial'    => 'var(--yuki-primary-active)',
				'border-hover'      => 'var(--yuki-accent-active)',
				'min-height'        => '32px',
				'border'            => [ 1, 'solid' ],
				'shadow'            => [
					'rgba(44, 62, 80, 0.2)',
					'0px',
					'0px',
					'15px',
					'0px',
					false
				],
				'shadow-active'     => [
					'rgba(44, 62, 80, 0.2)',
					'0px',
					'0px',
					'15px',
					'0px',
					true
				],
				'typography'        => [
					'family'        => 'inherit',
					'fontSize'      => '0.75rem',
					'variant'       => '500',
					'lineHeight'    => '1',
					'textTransform' => 'capitalize'
				],
				'border-radius'     => [
					'linked' => true,
					'left'   => '2px',
					'right'  => '2px',
					'top'    => '2px',
					'bottom' => '2px',
				],
				'padding'           => [
					'top'    => '0.85em',
					'right'  => '1.25em',
					'bottom' => '0.85em',
					'left'   => '1.25em',
				],
			] );

			$selector = $defaults['button-selector'];

			$controls = [
				( new Slider( $id . 'min_height' ) )
					->setLabel( __( 'Min Height', 'yuki' ) )
					->asyncCss( $selector, [ '--yuki-button-height' => 'value' ] )
					->enableResponsive()
					->setMin( 30 )
					->setMax( 100 )
					->setDefaultUnit( 'px' )
					->setDefaultValue( $defaults['min-height'] )
				,
				( new Separator() )
				,
				( new ColorPicker( $id . 'text_color' ) )
					->setLabel( __( 'Text Color', 'yuki' ) )
					->enableAlpha()
					->asyncColors( $selector, array(
						'initial' => '--yuki-button-text-initial-color',
						'hover'   => '--yuki-button-text-hover-color',
					) )
					->addColor( 'initial', __( 'Initial', 'yuki' ), $defaults['text-initial'] )
					->addColor( 'hover', __( 'Hover', 'yuki' ), $defaults['text-hover'] )
				,
				( new ColorPicker( $id . 'button_color' ) )
					->setLabel( __( 'Button Color', 'yuki' ) )
					->enableAlpha()
					->asyncColors( $selector, array(
						'initial' => '--yuki-button-initial-color',
						'hover'   => '--yuki-button-hover-color',
					) )
					->addColor( 'initial', __( 'Initial', 'yuki' ), $defaults['button-initial'] )
					->addColor( 'hover', __( 'Hover', 'yuki' ), $defaults['button-hover'] )
				,
				( new Separator() )
				,
				( new Border( $id . 'border' ) )
					->setLabel( __( 'Border', 'yuki' ) )
					->enableHoverColor()
					->asyncCss( $selector, AsyncCss::border( '--yuki-button-border' ) )
					->setDefaultBorder( ...array_merge( $defaults['border'], [
						$defaults['border-initial'],
						$defaults['border-hover']
					] ) )
				,
				( new Separator() ),
				( new BoxShadow( $id . 'shadow' ) )
					->setLabel( __( 'Shadow', 'yuki' ) )
					->asyncCss( $selector, AsyncCss::shadow( '--yuki-button-shadow' ) )
					->setDefaultShadow(
						...$defaults['shadow'] )
				,
				( new BoxShadow( $id . 'shadow_active' ) )
					->setLabel( __( 'Shadow Active', 'yuki' ) )
					->asyncCss( $selector, AsyncCss::shadow( '--yuki-button-shadow-active' ) )
					->setDefaultShadow(
						...$defaults['shadow-active'] )
				,
				( new Separator() ),
			];

			$controls = array_merge( $controls, [
				( new Typography( $id . 'typography' ) )
					->setLabel( __( 'Typography', 'yuki' ) )
					->asyncCss( $selector, AsyncCss::typography() )
					->setDefaultValue( $defaults['typography'] )
				,
				( new Separator() )
				,
				( new Spacing( $id . 'radius' ) )
					->setLabel( __( 'Border Radius', 'yuki' ) )
					->enableResponsive()
					->asyncCss( $selector, AsyncCss::dimensions( '--yuki-button-radius' ) )
					->setDefaultValue( $defaults['border-radius'] )
				,
				( new Separator() )
				,
				( new Spacing( $id . 'padding' ) )
					->setLabel( __( 'Padding', 'yuki' ) )
					->enableResponsive()
					->asyncCss( $selector, AsyncCss::dimensions( '--yuki-button-padding' ) )
					->setDefaultValue( $defaults['padding'] )
				,
			] );

			return $controls;
		}
	}
}
