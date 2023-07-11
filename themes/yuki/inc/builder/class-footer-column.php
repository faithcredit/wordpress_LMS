<?php
/**
 * Footer builder column
 *
 * @package Yuki
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Footer_Column' ) ) {

	class Yuki_Footer_Column extends Yuki_Builder_Column {
		/**
		 * @return false
		 */
		protected function isResponsive() {
			return true;
		}

		/**
		 * @return array
		 */
		protected function getDefaultSettings() {
			return [
				'direction' => 'column',
				'padding'   => [
					'top'    => '14px',
					'right'  => '14px',
					'bottom' => '14px',
					'left'   => '14px',
					'linked' => true,
				],
			];
		}
	}
}
