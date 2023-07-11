<?php
/**
 * Header customizer section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Section as CustomizerSection;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Header_Section' ) ) {

	class Yuki_Header_Section extends CustomizerSection {
		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			$controls = apply_filters( 'yuki_header_builder_controls', [
				Yuki_Header_Builder::instance()->builder()->setPreviewLocation( $this->id )
			] );

			if ( yuki_fs()->is_not_paying() ) {
				$controls[] = yuki_upsell_info_control( __( 'More Header Elements in %sPro Version%s', 'yuki' ), 'yuki_header_elements_upsell' )
					->showBackground();
			}

			return $controls;
		}
	}
}