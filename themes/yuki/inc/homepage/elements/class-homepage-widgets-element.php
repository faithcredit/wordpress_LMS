<?php
/**
 * Homepage widgets element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\PageBuilder\Element;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Homepage_Widgets_Element' ) ) {

	class Yuki_Homepage_Widgets_Element extends Element {

		use Yuki_Widgets_Controls;

		public function getControls() {
			return $this->getWidgetsControls();
		}

		protected function getOptions() {
			return $this;
		}

		protected function getSidebarId( $attrs = [] ) {
			return $this->slug;
		}

		protected function getAttrId( $attrs = [] ) {
			return $attrs['id'];
		}

		protected function beforeRender( $attrs = [] ) {
			$id       = $attrs['id'];
			$settings = $attrs['settings'];

			$this->add_render_attribute( $id, 'class', Utils::clsx( [
				'yuki-page-builder-element',
				'yuki-widgets-element',
				'prose',
				'yuki-heading',
				'yuki-heading-' . $this->get( $this->getSlug( 'title-style' ), $settings ),
				$id,
			] ) );

			if ( is_customize_preview() ) {
				$this->add_render_attribute( $id, 'data-shortcut', 'drop' );
				$this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
			}
		}
	}
}
