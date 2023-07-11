<?php
/**
 * Header builder row
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\Border;
use LottaFramework\Customizer\Controls\BoxShadow;
use LottaFramework\Customizer\Controls\Condition;
use LottaFramework\Customizer\Controls\MultiSelect;
use LottaFramework\Customizer\Controls\Number;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\Controls\Toggle;
use LottaFramework\Customizer\GenericBuilder\Row;
use LottaFramework\Facades\AsyncCss;
use LottaFramework\Facades\Css;
use LottaFramework\Facades\CZ;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Header_Row' ) ) {

	class Yuki_Header_Row extends Row {

		use Yuki_Advanced_CSS_Controls;

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts() {

			// Add dynamic css for row
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) {

				$visibility = CZ::get( $this->getRowControlKey( 'visibility' ) );

				$css[".yuki-header-row-{$this->id}"] = array_merge(
					Css::background( CZ::get( $this->getRowControlKey( 'background' ) ) ),
					Css::shadow( CZ::get( $this->getRowControlKey( 'shadow' ) ) ),
					Css::border( CZ::get( $this->getRowControlKey( 'border_top' ) ), 'border-top' ),
					Css::border( CZ::get( $this->getRowControlKey( 'border_bottom' ) ), 'border-bottom' ),
					[
						'z-index' => CZ::get( $this->getRowControlKey( 'z_index' ) ),
						'display' => [
							'desktop' => ( isset( $visibility['desktop'] ) && $visibility['desktop'] === 'yes' ) ? 'block' : 'none',
							'tablet'  => ( isset( $visibility['tablet'] ) && $visibility['tablet'] === 'yes' ) ? 'block' : 'none',
							'mobile'  => ( isset( $visibility['mobile'] ) && $visibility['mobile'] === 'yes' ) ? 'block' : 'none',
						],
					]
				);

				$css[".yuki-header-row-{$this->id} .container"] = [
					'min-height' => CZ::get( $this->getRowControlKey( 'min_height' ) )
				];

				if ( CZ::checked( $this->getRowControlKey( 'overlay' ) ) ) {
					$css[".yuki-header-row-{$this->id} .yuki-overlay"] = array_merge(
						Css::background( CZ::get( $this->getRowControlKey( 'overlay_background' ) ) ),
						[ 'opacity' => CZ::get( $this->getRowControlKey( 'overlay_opacity' ) ) ]
					);
				}

				return apply_filters( 'yuki_header_row_css', $css );
			} );
		}

		/**
		 * {@inheritDoc}
		 */
		public function beforeRow() {
			do_action( 'yuki_start_header_row', $this->id, $this->getRowControlKey( '' ) );
		}

		/**
		 * {@inheritDoc}
		 */
		public function afterRow() {
			do_action( 'yuki_after_header_row', $this->id, $this->getRowControlKey( '' ) );
		}

		/**
		 * @param $key
		 *
		 * @return string
		 */
		protected function getRowControlKey( $key ) {
			return 'yuki_header_' . $this->id . '_row_' . $key;
		}

		/**
		 * {@inheritDoc}
		 *
		 * @return array
		 */
		protected function getRowControls() {
			return [
				( new Tabs() )
					->setActiveTab( 'content' )
					->addTab( 'content', __( 'Content', 'yuki' ), [
						( new Slider( $this->getRowControlKey( 'min_height' ) ) )
							->setLabel( __( 'Min Height', 'yuki' ) )
							->asyncCss( ".yuki-header-row-{$this->id} .container", [ 'min-height' => 'value' ] )
							->setDefaultValue( $this->getRowControlDefault( 'min_height', '80px' ) )
							->setDefaultUnit( 'px' )
							->enableResponsive()
							->setMin( 20 )
							->setMax( 1000 )
						,
						( new Number( $this->getRowControlKey( 'z_index' ) ) )
							->setLabel( __( 'Z Index', 'yuki' ) )
							->setMin( - 99999 )
							->setMax( 99999 )
							->setDefaultUnit( false )
							->setDefaultValue( $this->getRowControlDefault( 'z_index', 9 ) )
						,
						( new Separator() ),
						( new MultiSelect( $this->getRowControlKey( 'visibility' ) ) )
							->setLabel( __( 'Visibility', 'yuki' ) )
							->buttonsGroupView()
							->setChoices( [
								'desktop' => yuki_image( 'desktop' ),
								'tablet'  => yuki_image( 'tablet' ),
								'mobile'  => yuki_image( 'mobile' )
							] )
							->asyncCss( ".yuki-header-row-{$this->id}", [
								'display' => [
									'desktop' => AsyncCss::unescape( AsyncCss::valueMapper( [
										'yes' => 'block',
										'no'  => 'none'
									], "value['desktop']" ) ),
									'tablet'  => AsyncCss::unescape( AsyncCss::valueMapper( [
										'yes' => 'block',
										'no'  => 'none'
									], "value['tablet']" ) ),
									'mobile'  => AsyncCss::unescape( AsyncCss::valueMapper( [
										'yes' => 'block',
										'no'  => 'none'
									], "value['mobile']" ) ),
								]
							] )
							->setDefaultValue( [
								'desktop' => 'yes',
								'tablet'  => 'yes',
								'mobile'  => 'yes',
							] )
						,
					] )
					->addTab( 'style', __( 'Style', 'yuki' ), [
						( new Border( $this->getRowControlKey( 'border_top' ) ) )
							->setLabel( __( 'Top Border', 'yuki' ) )
							->asyncCss( ".yuki-header-row-{$this->id}", AsyncCss::border( 'border-top' ) )
							->enableResponsive()
							->displayBlock()
							->setDefaultBorder(
								...$this->getRowControlDefault( 'border_top', [ 1, 'none', 'var(--yuki-base-200)' ] )
							)
						,
						( new Separator() )->setStyle( 'dashed' ),
						( new Border( $this->getRowControlKey( 'border_bottom' ) ) )
							->setLabel( __( 'Bottom Border', 'yuki' ) )
							->asyncCss( ".yuki-header-row-{$this->id}", AsyncCss::border( 'border-bottom' ) )
							->enableResponsive()
							->displayBlock()
							->setDefaultBorder(
								...$this->getRowControlDefault( 'border_bottom', [
								1,
								'none',
								'var(--yuki-base-200)'
							] )
							)
						,
						( new Separator() )->setStyle( 'dashed' ),
						( new BoxShadow( $this->getRowControlKey( 'shadow' ) ) )
							->setLabel( __( 'Box Shadow', 'yuki' ) )
							->asyncCss( ".yuki-header-row-{$this->id}", AsyncCss::shadow() )
							->enableResponsive()
							->displayBlock()
							->setDefaultShadow(
								...$this->getRowControlDefault( 'shadow', [
									'rgba(44, 62, 80, 0.05)',
									'0px',
									'10px',
									'10px',
									'0px',
									false
								]
							) )
						,
						( new Separator() )->setStyle( 'dashed' ),
						( new Background( $this->getRowControlKey( 'background' ) ) )
							->setLabel( __( 'Background', 'yuki' ) )
							->asyncCss( ".yuki-header-row-{$this->id}", AsyncCss::background() )
							->enableResponsive()
							->setDefaultValue( $this->getRowControlDefault( 'background', [
								'type'  => 'color',
								'color' => 'var(--yuki-base-color)'
							] ) )
						,
						( new Toggle( $this->getRowControlKey( 'overlay' ) ) )
							->setLabel( __( 'Enable Overlay', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-header-selective-css' )
							->selectiveRefresh( '.yuki-site-header', 'yuki_header_render' )
							->closeByDefault()
						,
						( new Condition() )
							->setCondition( [ $this->getRowControlKey( 'overlay' ) => 'yes' ] )
							->setControls( [
								( new Slider( $this->getRowControlKey( 'overlay_opacity' ) ) )
									->setLabel( __( 'Opacity', 'yuki' ) )
									->asyncCss( ".yuki-header-row-{$this->id} .yuki-overlay", [ 'opacity' => 'value' ] )
									->setMin( 0 )
									->setDecimals( 1 )
									->setMax( 1 )
									->setDefaultUnit( false )
									->setDefaultValue( 0.25 )
								,
								( new Background( $this->getRowControlKey( 'overlay_background' ) ) )
									->setLabel( __( 'Overlay Background', 'yuki' ) )
									->asyncCss( ".yuki-header-row-{$this->id} .yuki-overlay", AsyncCss::background() )
									->setDefaultValue( [
										'type'  => 'color',
										'color' => 'var(--yuki-base-color)'
									] )
								,
							] )
					] )
					->addTab( 'advanced', __( 'Advanced', 'yuki' ), $this->getAdvancedCssControls( $this->getRowControlKey( '' ) ) )
				,
			];
		}
	}
}