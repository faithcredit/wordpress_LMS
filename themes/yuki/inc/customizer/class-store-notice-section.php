<?php
/**
 * Store notice section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Section as CustomizerSection;
use LottaFramework\Facades\AsyncCss;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Store_Notice_Section' ) ) {

	class Yuki_Store_Notice_Section extends CustomizerSection {

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return [
				( new Separator( 'yuki_store_notice_divider' ) ),
				( new ColorPicker( 'yuki_store_notice_colors' ) )
					->setLabel( __( 'Colors', 'yuki' ) )
					->asyncColors( '.woocommerce-store-notice, p.demo_store', [
						'text'            => 'color',
						'dismiss-initial' => '--yuki-link-initial-color',
						'dismiss-hover'   => '--yuki-link-hover-color',
					] )
					->addColor( 'text', __( 'Text', 'yuki' ), '#ffffff' )
					->addColor( 'dismiss-initial', __( 'Dismiss Initial', 'yuki' ), '#ffffff' )
					->addColor( 'dismiss-hover', __( 'Dismiss Hover', 'yuki' ), '#ffffff' )
				,
				( new Background( 'yuki_store_notice_background' ) )
					->setLabel( __( 'Background', 'yuki' ) )
					->asyncCss( '.woocommerce-store-notice, p.demo_store', AsyncCss::background() )
					->setDefaultValue( [
						'type'  => 'color',
						'color' => 'var(--yuki-primary-active)'
					] )
				,
			];
		}
	}
}
