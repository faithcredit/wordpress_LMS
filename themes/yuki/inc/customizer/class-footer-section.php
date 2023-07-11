<?php
/**
 * Footer customizer section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Section as CustomizerSection;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Footer_Section' ) ) {

	class Yuki_Footer_Section extends CustomizerSection {

		public function getControls() {

			$controls = [
				Yuki_Footer_Builder::instance()->builder()->setPreviewLocation( $this->id )
			];

			if ( yuki_fs()->is_not_paying() ) {
				$controls[] = yuki_upsell_info_control( __( 'More Footer Elements in %sPro Version%s', 'yuki' ), 'yuki_footer_elements_upsell' )
					->showBackground();
			}

			return $controls;
		}
	}
}