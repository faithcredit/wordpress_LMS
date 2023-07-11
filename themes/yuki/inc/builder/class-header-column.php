<?php
/**
 * Header builder column
 *
 * @package Yuki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Header_Column' ) ) {

	class Yuki_Header_Column extends Yuki_Builder_Column {
		/**
		 * @return false
		 */
		protected function isResponsive() {
			return false;
		}

		/**
		 * @return array
		 */
		protected function getDefaultSettings() {
			return [
				'align-items' => 'center',
			];
		}
	}
}
