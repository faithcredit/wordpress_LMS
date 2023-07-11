<?php
/**
 * Store catalog section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\ImageRadio;
use LottaFramework\Customizer\Controls\Number;
use LottaFramework\Customizer\Controls\Section;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\Controls\Typography;
use LottaFramework\Customizer\Section as CustomizerSection;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Store_Catalog_Section' ) ) {

	class Yuki_Store_Catalog_Section extends CustomizerSection {

		use Yuki_Post_Card;

		public function getControls() {
			return [
				( new Separator( 'yuki_store_catalog_default_divider' ) ),
				( new Slider( 'yuki_store_catalog_columns' ) )
					->setLabel( __( 'Shop Columns', 'yuki' ) )
					->bindSelectiveRefresh( 'yuki-woo-selective-css' )
					->setDefaultUnit( false )
					->setMin( 1 )
					->setMax( 6 )
					->enableResponsive()
					->setDefaultValue( [
						'desktop' => 4,
						'tablet'  => 2,
						'mobile'  => 1,
					] )
				,
				( new Slider( 'yuki_store_catalog_gap' ) )
					->setLabel( __( 'Shop Gap', 'yuki' ) )
					->asyncCss( '.yuki-products', [ '--card-gap' => 'value' ] )
					->enableResponsive()
					->setDefaultUnit( 'px' )
					->setDefaultValue( '24px' )
				,
				( new Number( 'yuki_store_catalog_per_page' ) )
					->setLabel( __( 'Products Per Page', 'yuki' ) )
					->setDefaultValue( 12 )
					->setMin( 1 )
					->setMax( 99999 )
					->setDefaultUnit( false )
				,
				( new Section( 'yuki_store_product_card_section' ) )
					->setLabel( __( 'Store Product Card', 'yuki' ) )
					->setControls( $this->getCardControls() )
				,

				( new Section( 'yuki_store_sidebar_section' ) )
					->setLabel( __( 'Sidebar', 'yuki' ) )
					->enableSwitch( false )
					->setControls( [
						( new ImageRadio( 'yuki_store_sidebar_layout' ) )
							->setLabel( __( 'Sidebar Layout', 'yuki' ) )
							->setDefaultValue( 'right-sidebar' )
							->setChoices( [
								'left-sidebar'  => [
									'title' => __( 'Left Sidebar', 'yuki' ),
									'src'   => yuki_image_url( 'left-sidebar.png' ),
								],
								'right-sidebar' => [
									'title' => __( 'Right Sidebar', 'yuki' ),
									'src'   => yuki_image_url( 'left-sidebar.png' ),
								],
							] )
						,
					] )
				,

				( new Section( 'yuki_store_form_section' ) )
					->setLabel( __( 'Form', 'yuki' ) )
					->setControls( [
						( new Typography( 'yuki_store_form_typography' ) )
							->setLabel( __( 'Typography', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setDefaultValue( [
								'family'     => 'inherit',
								'fontSize'   => '0.85rem',
								'variant'    => '400',
								'lineHeight' => '1.5em'
							] )
						,
						( new Separator() ),
						( new ColorPicker( 'yuki_store_form_color' ) )
							->setLabel( __( 'Controls Color', 'yuki' ) )
							->enableAlpha()
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->addColor( 'background', __( 'Background', 'yuki' ), 'var(--yuki-base-color)' )
							->addColor( 'border', __( 'Border', 'yuki' ), 'var(--yuki-base-200)' )
							->addColor( 'active', __( 'Active', 'yuki' ), 'var(--yuki-primary-color)' )
						,
					] )
				,
			];
		}

		protected function getCardControls() {
			$selector = '.woocommerce .yuki-products li.product .yuki-product-wrapper';

			$content_controls = $this->getCardContentControls( 'yuki_store_', [
				'selector'          => $selector,
				'spacing'           => '24px',
				'thumbnail-spacing' => '0px',
			] );

			$style_controls = $this->getCardStyleControls( 'yuki_store_', [
				'selector'  => $selector,
				'selective' => 'yuki-woo-selective-css',
			] );

			return [
				( new Tabs() )
					->setActiveTab( 'content' )
					->addTab( 'content', __( 'Content', 'yuki' ), apply_filters(
						'yuki_store_card_content_controls', $content_controls
					) )
					->addTab( 'style', __( 'Style', 'yuki' ), apply_filters(
						'yuki_store_card_style_controls', $style_controls, [
							'selector' => $selector,
						]
					) )
			];
		}
	}
}
