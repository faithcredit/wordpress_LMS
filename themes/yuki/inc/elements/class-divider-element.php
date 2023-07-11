<?php
/**
 * Divider element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Border;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Spacing;
use LottaFramework\Customizer\GenericBuilder\Element;
use LottaFramework\Facades\AsyncCss;
use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Divider_Element' ) ) {

	class Yuki_Divider_Element extends Element {

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			return [
				( new Border( $this->getSlug( 'divider' ) ) )
					->setLabel( __( 'Divider', 'yuki' ) )
					->asyncCss( ".{$this->slug} .yuki-divider-inner", AsyncCss::border( 'border-right' ) )
					->setDefaultBorder( 1, 'solid', 'var(--yuki-base-300)' )
				,
				( new Slider( $this->getSlug( 'height' ) ) )
					->setLabel( __( 'Height', 'yuki' ) )
					->asyncCss( ".{$this->slug} .yuki-divider-inner", [ 'height' => 'value' ] )
					->setUnits( [
						[ 'unit' => 'px', 'min' => 1, 'max' => 200 ],
						[ 'unit' => '%', 'min' => 1, 'max' => 100 ],
					] )
					->setDefaultValue( '28px' )
				,
				( new Separator() ),
				( new Spacing( $this->getSlug( 'spacing' ) ) )
					->setLabel( __( 'Spacing', 'yuki' ) )
					->asyncCss( ".{$this->slug}", AsyncCss::dimensions( 'padding' ) )
					->setDisabled( [ 'top', 'bottom' ] )
					->setSpacing( [
						'left'  => '12px',
						'right' => '12px',
					] )
				,
			];
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add button dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {

				$css[".{$this->slug}"] = Css::dimensions( CZ::get( $this->getSlug( 'spacing' ) ), 'padding' );

				$css[".{$this->slug} .yuki-divider-inner"] = array_merge(
					Css::border( CZ::get( $this->getSlug( 'divider' ) ), 'border-right' ),
					[
						'width'  => '0',
						'height' => CZ::get( $this->getSlug( 'height' ) ),
					]
				);

				return $css;
			} );
		}


		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {

			$attrs['class'] = Utils::clsx( [
				'yuki-divider',
				$this->slug
			], $attrs['class'] ?? [] );

			foreach ( $attrs as $attr => $value ) {
				$this->add_render_attribute( 'divider', $attr, $value );
			}

			?>
            <div <?php $this->print_attribute_string( 'divider' ); ?>>
                <div class="yuki-divider-inner"></div>
            </div>
			<?php
		}
	}
}

