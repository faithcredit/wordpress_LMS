<?php
/**
 * Article trait
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Background;
use LottaFramework\Customizer\Controls\BoxShadow;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Condition;
use LottaFramework\Customizer\Controls\ImageRadio;
use LottaFramework\Customizer\Controls\ImageUploader;
use LottaFramework\Customizer\Controls\Layers;
use LottaFramework\Customizer\Controls\Radio;
use LottaFramework\Customizer\Controls\Select;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Spacing;
use LottaFramework\Facades\AsyncCss;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! trait_exists( 'Yuki_Article_Controls' ) ) {

	/**
	 * Post structure functions
	 */
	trait Yuki_Article_Controls {

		use Yuki_Post_Structure;

		/**
		 * @param $type
		 * @param array $defaults
		 *
		 * @return array
		 */
		protected function getContainerControls( $type, $defaults = [] ) {
			$defaults = wp_parse_args( $defaults, [
				'style'  => 'boxed',
				'layout' => 'normal',
			] );

			return [
				( new ImageRadio( 'yuki_' . $type . '_container_layout' ) )
					->setLabel( __( 'Content Width', 'yuki' ) )
					->setDefaultValue( $defaults['layout'] )
					->asyncCss( '.yuki-container', [
						'--yuki-max-w-content' => AsyncCss::unescape( AsyncCss::valueMapper( [
							'normal' => 'auto',
							'narrow' => '65ch',
						] ) )
					] )
					->setChoices( [
						'narrow' => [
							'title' => __( 'Narrow', 'yuki' ),
							'src'   => yuki_image_url( 'narrow.png' ),
						],
						'normal' => [
							'title' => __( 'Normal', 'yuki' ),
							'src'   => yuki_image_url( 'normal.png' ),
						],
					] )
				,
				( new Condition() )
					->setCondition( [ 'yuki_' . $type . '_container_layout' => 'narrow' ] )
					->setControls( [
						( new Slider( 'yuki_' . $type . '_container_max_width' ) )
							->setLabel( __( 'Content Max Width', 'yuki' ) )
							->asyncCss( '.yuki-body', [
								'--yuki-max-w-content' => 'value'
							] )
							->setUnits( [
								[ 'unit' => 'px', 'min' => 500, 'max' => 1400 ],
								[ 'unit' => '%', 'min' => 50, 'max' => 100 ],
								[ 'unit' => 'ch', 'min' => 50, 'max' => 150 ],
							] )
							->setDefaultValue( '75ch' )
					] )
				,
			];
		}

		/**
		 * @return array
		 */
		protected function getHeaderControls( $type, $defaults = [] ) {
			$defaults = wp_parse_args( $defaults, [
				'selective-css' => 'yuki-global-selective-css',
				'selector'      => '',
				'elements'      => [
					[ 'id' => 'title', 'visible' => true ],
					[ 'id' => 'metas', 'visible' => true ],
					[ 'id' => 'categories', 'visible' => false ],
					[ 'id' => 'tags', 'visible' => false ],
				],
				'metas'         => [],
			] );

			$layer_defaults = array(
				'selective-css' => $defaults['selective-css'],
				'selector'      => $defaults['selector'],
			);

			return [
				( new Layers( 'yuki_' . $type . '_header_elements' ) )
					->setLabel( __( 'Header Elements', 'yuki' ) )
					->setDefaultValue( $defaults['elements'] )
					->addLayer( 'title', __( 'Title', 'yuki' ), $this->getTitleLayerControls( $type, false, array_merge( $layer_defaults, [
						'tag'        => 'h1',
						'typography' => [
							'family'     => 'inherit',
							'fontSize'   => [ 'desktop' => '3rem', 'tablet' => '2rem', 'mobile' => '1.875em' ],
							'variant'    => '700',
							'lineHeight' => '1.25'
						]
					] ) ) )
					->addLayer( 'metas', __( 'Metas', 'yuki' ), $this->getMetasControls( $type, array_merge( $layer_defaults, $defaults['metas'] ) ) )
					->addLayer( 'categories', __( 'Categories', 'yuki' ), $this->getTaxonomyControls( $type, '_cats', array_merge( $layer_defaults, [
						'style'      => 'badge',
						'typography' => [
							'family'        => 'inherit',
							'fontSize'      => '0.75rem',
							'variant'       => '400',
							'lineHeight'    => '1.5',
							'textTransform' => 'uppercase',
						],
					] ) ) )
					->addLayer( 'tags', __( 'Tags', 'yuki' ), $this->getTaxonomyControls( $type, '_tags', $layer_defaults ) )
				,
				( new ImageRadio( 'yuki_' . $type . '_header_alignment' ) )
					->setLabel( __( 'Content Alignment', 'yuki' ) )
					->setDefaultValue( 'center' )
					->bindSelectiveRefresh( 'yuki-global-selective-css' )
					->inlineChoices()
					->setChoices( [
						'left'   => [
							'src'   => yuki_image( 'text-left' ),
							'title' => __( 'Left', 'yuki' ),
						],
						'center' => [
							'src'   => yuki_image( 'text-center' ),
							'title' => __( 'Center', 'yuki' ),
						],
						'right'  => [
							'src'   => yuki_image( 'text-right' ),
							'title' => __( 'Right', 'yuki' ),
						]
					] )
				,
				( new Separator() ),
				( new Spacing( 'yuki_' . $type . '_header_spacing' ) )
					->setLabel( __( 'Spacing', 'yuki' ) )
					->bindSelectiveRefresh( 'yuki-global-selective-css' )
					->setDisabled( [ 'left', 'right' ] )
					->setDefaultValue( [
						'top'    => '48px',
						'right'  => '0px',
						'bottom' => '48px',
						'left'   => '0px',
						'linked' => true,
					] )
				,
			];
		}

		/**
		 * @return array
		 */
		protected function getFeaturedImageControls( $type, $defaults = [] ) {
			$defaults = wp_parse_args( $defaults, [
				'image-style' => 'behind',
			] );

			return [
				( new ImageUploader( 'yuki_' . $type . '_featured_image_fallback' ) )
					->setLabel( __( 'Image Fallback', 'yuki' ) )
					->setDescription( __( 'If the current post does not have a featured image, then this image will be displayed.', 'yuki' ) )
					->setDefaultValue( '' )
				,
				( new Select( 'yuki_' . $type . '_featured_image_size' ) )
					->setLabel( __( 'Image Size', 'yuki' ) )
					->setDefaultValue( 'full' )
					->setChoices( yuki_image_size_options( false ) )
				,
				( new Separator() ),
				( new ImageRadio( 'yuki_' . $type . '_featured_image_position' ) )
					->setLabel( __( 'Image Style', 'yuki' ) )
					->setColumns( 3 )
					->setDefaultValue( $defaults['image-style'] )
					->setChoices( [
						'above'  => [
							'src' => yuki_image_url( 'above-header.png' ),
						],
						'below'  => [
							'src' => yuki_image_url( 'below-header.png' ),
						],
						'behind' => [
							'src' => yuki_image_url( 'behind-header.png' ),
						],
					] )
				,
				( new Separator() ),
				( new Condition() )
					->setCondition( [ 'yuki_' . $type . '_featured_image_position' => 'behind' ] )
					->setControls( [
						( new ColorPicker( 'yuki_' . $type . '_featured_image_elements_override' ) )
							->setLabel( __( 'Header Color Override', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->addColor( 'override', __( 'Override', 'yuki' ), '#eeeeee' )
						,
						( new Separator() ),
						( new Background( 'yuki_' . $type . '_featured_image_background_overlay' ) )
							->setLabel( __( 'Header Overlay', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setDefaultValue( [
								'type'     => 'gradient',
								'gradient' => 'linear-gradient(180deg,rgba(50,65,84,0.26) 0%,rgba(50,65,84,0.73) 100%)',
								'color'    => 'var(--yuki-accent-active)',
							] )
						,
						( new Separator() ),
						( new Spacing( 'yuki_' . $type . '_featured_image_background_spacing' ) )
							->setLabel( __( 'Spacing', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->enableResponsive()
							->setDefaultValue( [
								'top'    => '68px',
								'right'  => '68px',
								'bottom' => '68px',
								'left'   => '68px',
								'linked' => true,
							] )
						,
					] )
					->setReverseControls( [
						( new Radio( 'yuki_' . $type . '_featured_image_width' ) )
							->setLabel( __( 'Image Width', 'yuki' ) )
							->buttonsGroupView()
							->setDefaultValue( 'wide' )
							->setChoices( [
								'default' => __( 'Default', 'yuki' ),
								'wide'    => __( 'Wide', 'yuki' ),
								'full'    => __( 'Full', 'yuki' ),
							] )
						,
						( new Slider( 'yuki_' . $type . '_featured_image_height' ) )
							->setLabel( __( 'Image Height', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setUnits( [
								[ 'unit' => 'px', 'min' => 100, 'max' => 1000 ],
								[ 'unit' => '%', 'min' => 10, 'max' => 10 ],
							] )
							->setDefaultValue( '420px' )
						,
						( new BoxShadow( 'yuki_' . $type . '_featured_image_shadow' ) )
							->setLabel( __( 'Shadow', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setDefaultShadow(
								'rgba(54,63,70,0.35)',
								'0px',
								'18px',
								'18px',
								'-15px', false
							)
						,
						( new Separator() ),
						( new Spacing( 'yuki_' . $type . '_featured_image_radius' ) )
							->setLabel( __( 'Border Radius', 'yuki' ) )
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setDefaultValue( [
								'top'    => '2px',
								'right'  => '2px',
								'bottom' => '2px',
								'left'   => '2px',
								'linked' => true
							] )
						,
						( new Separator() ),
						( new Spacing( 'yuki_' . $type . '_featured_image_spacing' ) )
							->setLabel( __( 'Spacing', 'yuki' ) )
							->enableResponsive()
							->bindSelectiveRefresh( 'yuki-global-selective-css' )
							->setDisabled( [ 'left', 'right' ] )
							->setDefaultValue( [
								'top'    => '12px',
								'right'  => '0px',
								'bottom' => '12px',
								'left'   => '0px',
								'linked' => true,
							] )
						,
					] )
				,
			];
		}
	}

}


