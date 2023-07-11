<?php
/**
 * Theme Switch element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Icons;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\CZ;
use LottaFramework\Icons\IconsManager;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Theme_Switch_Element' ) ) {

	class Yuki_Theme_Switch_Element extends Element {

		use Yuki_Icon_Button_Controls;

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return [
				( new Tabs() )
					->setActiveTab( 'icon' )
					->addTab( 'icon', __( 'Icon', 'yuki' ), array_merge( [
						( new Icons( $this->getSlug( 'light_icon' ) ) )
							->setLabel( __( 'Light Icon', 'yuki' ) )
							->selectiveRefresh( ...$this->selectiveRefresh() )
							->setDefaultValue( [
								'value'   => 'fas fa-sun',
								'library' => 'fa-solid',
							] )
						,
						( new Icons( $this->getSlug( 'dark_icon' ) ) )
							->setLabel( __( 'Dark Icon', 'yuki' ) )
							->selectiveRefresh( ...$this->selectiveRefresh() )
							->setDefaultValue( [
								'value'   => 'fas fa-moon',
								'library' => 'fa-solid',
							] )
						,
						( new Separator() ),
					], $this->getIconControls( [
						'render-callback' => $this->selectiveRefresh(),
						'selector'        => ".{$this->slug}"
					] ) ) )
					->addTab( 'style', __( 'Style', 'yuki' ), $this->getIconStyleControls( [
						'selector' => ".{$this->slug}"
					] ) )
			];
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add button dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
				$css[".{$this->slug}"] = $this->getIconButtonCss();

				return $css;
			} );
		}


		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {
			$shape = CZ::get( $this->getSlug( 'icon_button_icon_shape' ) );
			$fill  = CZ::get( $this->getSlug( 'icon_button_shape_fill_type' ) );

			$attrs['class'] = Utils::clsx( [
				'yuki-theme-switch',
				'yuki-icon-button',
				'yuki-icon-button-' . $shape,
				'yuki-icon-button-' . $fill => $shape !== 'none',
				$this->slug
			], $attrs['class'] ?? [] );

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( 'theme-switch', $attr, $value );
			}
			?>
            <button type="button" <?php $this->print_attribute_string( 'theme-switch' ); ?>>
	            <span class="light-mode">
				<?php IconsManager::print( CZ::get( $this->getSlug( 'light_icon' ) ) ); ?>
	            </span>
                <span class="dark-mode">
				<?php IconsManager::print( CZ::get( $this->getSlug( 'dark_icon' ) ) ); ?>
	            </span>
            </button>
			<?php
		}
	}
}
