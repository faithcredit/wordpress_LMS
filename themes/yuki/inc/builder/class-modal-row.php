<?php
/**
 * Modal row
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\BoxShadow;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Condition;
use LottaFramework\Customizer\Controls\Radio;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\GenericBuilder\Row;
use LottaFramework\Facades\AsyncCss;
use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Modal_Row' ) ) {

	class Yuki_Modal_Row extends Row {
		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {
			// Add dynamic css for row
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
				$fixed = Css::colors( CZ::get( 'yuki_canvas_close_button_color' ), [
					'initial' => '--yuki-modal-action-initial',
					'hover'   => '--yuki-modal-action-hover',
				] );

				if ( CZ::get( 'yuki_canvas_modal_type' ) === 'drawer' ) {
					$fixed['width'] = CZ::get( 'yuki_canvas_drawer_width' );

					$fixed[ ( CZ::get( 'yuki_canvas_drawer_placement' ) === 'left' ) ? 'margin-right' : 'margin-left' ] = 'auto';
				}

				$css['.yuki-off-canvas .yuki-modal-inner'] = array_merge(
					Css::shadow( CZ::get( 'yuki_canvas_modal_shadow' ) ),
					Css::background( CZ::get( 'yuki_canvas_modal_background' ) )
					, $fixed
				);

				$css['.yuki-off-canvas'] = Css::background( CZ::get( 'yuki_canvas_modal_mask' ) );

				return $css;
			} );
		}

		/**
		 * {@inheritDoc}
		 */
		public function beforeRow() {
			$behaviour = 'toggle';

			if ( CZ::get( 'yuki_canvas_modal_type' ) === 'drawer' ) {
				$behaviour = 'drawer-' . CZ::get( 'yuki_canvas_drawer_placement' );
			}

			$attrs = [
				'id'                    => 'yuki-off-canvas-modal',
				'class'                 => 'yuki-off-canvas yuki-modal',
				'data-toggle-behaviour' => $behaviour,
			];

			$inner_attrs = [
				'class' => 'yuki-modal-inner'
			];

			if ( is_customize_preview() ) {
				$inner_attrs['data-shortcut']          = 'border';
				$inner_attrs['data-shortcut-location'] = 'yuki_header:' . $this->id;
			}

			?>
        <div <?php Utils::print_attribute_string( $attrs ); ?>>
        <div <?php Utils::print_attribute_string( $inner_attrs ); ?>>
                <div class="yuki-modal-actions">
                    <button id="yuki-close-off-canvas-modal"
                            class="yuki-close-modal"
                            data-toggle-target="#yuki-off-canvas-modal"
                            type="button"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="yuki-modal-content" data-redirect-focus="#yuki-close-off-canvas-modal">
			<?php
		}

		/**
		 * {@inheritDoc}
		 */
		public function afterRow() {
			echo '</div></div></div>';
		}

		protected function getRowControls() {
			return [
				( new Tabs() )
					->setActiveTab( 'content' )
					->addTab( 'content', __( 'Content', 'yuki' ), $this->getContentControls() )
					->addTab( 'style', __( 'Style', 'yuki' ), $this->getStyleControls() )
			];
		}

		protected function getStyleControls() {
			return [
				( new ColorPicker( 'yuki_canvas_close_button_color' ) )
					->setLabel( __( 'Close Button Color', 'yuki' ) )
					->asyncColors( '.yuki-off-canvas .yuki-modal-inner', array(
						'initial' => '--yuki-modal-action-initial',
						'hover'   => '--yuki-modal-action-hover',
					) )
					->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-accent-color)' )
					->addColor( 'hover', __( 'Hover', 'yuki' ), 'var(--yuki-primary-color)' )
				,
				( new Separator() ),
				( new Background( 'yuki_canvas_modal_background' ) )
					->setLabel( __( 'Modal Background', 'yuki' ) )
					->asyncCss( '.yuki-off-canvas .yuki-modal-inner', AsyncCss::background() )
					->setDefaultValue( [
						'type'  => 'color',
						'color' => 'var(--yuki-base-color)',
					] )
				,
				( new Condition() )
					->setCondition( [ 'yuki_canvas_modal_type' => 'drawer' ] )
					->setControls( [
						( new Background( 'yuki_canvas_modal_mask' ) )
							->setLabel( __( 'Modal Mask', 'yuki' ) )
							->asyncCss( '.yuki-off-canvas', AsyncCss::background() )
							->setDefaultValue( [
								'type'  => 'color',
								'color' => 'rgba(0, 0, 0, 0)',
							] )
						,
						( new BoxShadow( 'yuki_canvas_modal_shadow' ) )
							->setLabel( __( 'Modal Shadow', 'yuki' ) )
							->asyncCss( '.yuki-off-canvas .yuki-modal-inner', AsyncCss::shadow() )
							->setDefaultShadow(
								'rgba(44, 62, 80, 0.35)',
								'0px', '0px',
								'70px', '0px', true
							)
						,
					] )
				,
			];
		}

		protected function getContentControls() {
			return [
				( new Radio( 'yuki_canvas_modal_type' ) )
					->setLabel( __( 'Modal Type', 'yuki' ) )
					->setDefaultValue( 'drawer' )
					->buttonsGroupView()
					->setChoices( [
						'modal'  => __( 'Modal', 'yuki' ),
						'drawer' => __( 'Drawer', 'yuki' ),
					] )
				,
				( new Condition() )
					->setCondition( [ 'yuki_canvas_modal_type' => 'drawer' ] )
					->setControls( [
						( new Radio( 'yuki_canvas_drawer_placement' ) )
							->setLabel( __( 'Drawer Placement', 'yuki' ) )
							->setDefaultValue( 'right' )
							->buttonsGroupView()
							->setChoices( [
								'left'  => __( 'Left', 'yuki' ),
								'right' => __( 'Right', 'yuki' ),
							] )
						,
						( new Separator() ),
						( new Slider( 'yuki_canvas_drawer_width' ) )
							->setLabel( __( 'Drawer Width', 'yuki' ) )
							->enableResponsive()
							->asyncCss( '.yuki-off-canvas .yuki-modal-inner', [ 'width' => 'value' ] )
							->setDefaultValue( [
								'desktop' => '500px',
								'tablet'  => '65vw',
								'mobile'  => '90vw',
							] )
							->setOption( 'units', Utils::units_config( [
								[ 'unit' => 'px', 'min' => 0, 'max' => 1000 ],
							] ) )
						,
					] )
				,
			];
		}
	}
}
