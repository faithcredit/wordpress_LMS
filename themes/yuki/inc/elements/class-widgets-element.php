<?php
/**
 * Widgets element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Widgets_Element' ) ) {

	class Yuki_Widgets_Element extends Element {

		use Yuki_Widgets_Controls;

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return $this->getWidgetsControls( [
				'selective-refresh'     => $this->getDefaultSetting( 'selective-refresh', '' ),
				'async-selector'        => '.' . $this->slug,
				'widgets-background'    => 'var(--yuki-transparent)',
				'widgets-border'        => [ 1, 'none', 'var(--yuki-base-200)' ],
				'widgets-shadow-enable' => false,
				'widgets-padding'       => [
					'top'    => '0px',
					'right'  => '0px',
					'bottom' => '0px',
					'left'   => '0px',
					'linked' => true
				],
			] );
		}

		/**
		 * @param null $id
		 * @param array $data
		 */
		public function after_register( $id = null, $data = [] ) {
			$id = $id ?? $this->slug;

			$options  = $this->getOptions();
			$settings = $data['settings'] ?? [];

			add_action( 'widgets_init', function () use ( $id, $options, $settings ) {

				$widgets_class = 'yuki-widget clearfix %2$s';
				$title_class   = 'widget-title mb-half-gutter heading-content';
				$tag           = $options->get( $this->getSlug( 'title-tag' ), $settings );

				register_sidebar( [
					'name'          => $this->getLabel(),
					'id'            => $id,
					'before_widget' => '<aside id="%1$s" class="' . $widgets_class . '">',
					'after_widget'  => '</aside>',
					'before_title'  => '<' . $tag . ' class="' . $title_class . '">',
					'after_title'   => '</' . $tag . '>',
				] );
			} );
		}

		protected function getOptions() {
			return CZ::getFacadeRoot();
		}

		protected function getSidebarId( $attrs = [] ) {
			return $this->slug;
		}

		protected function getAttrId( $attrs = [] ) {
			return $this->slug;
		}

		protected function beforeRender( $attrs = [] ) {
			$attrs['class'] = Utils::clsx( [
				'prose',
				'yuki-heading',
				'yuki-heading-' . CZ::get( $this->getSlug( 'title-style' ) ),
				$this->slug
			], $attrs['class'] ?? [] );

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( $this->slug, $attr, $value );
			}
		}
	}
}
