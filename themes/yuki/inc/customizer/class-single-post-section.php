<?php
/**
 * Single post customizer section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Border;
use LottaFramework\Customizer\Controls\ColorPicker;
use LottaFramework\Customizer\Controls\Icons;
use LottaFramework\Customizer\Controls\ImageRadio;
use LottaFramework\Customizer\Controls\Section;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Spacing;
use LottaFramework\Customizer\Section as CustomizerSection;
use LottaFramework\Facades\AsyncCss;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Single_Post_Section' ) ) {

	class Yuki_Single_Post_Section extends CustomizerSection {

		use Yuki_Article_Controls;
		use Yuki_Socials_Controls;

		/**
		 * @param string $id
		 *
		 * @return string
		 */
		protected function getSocialControlId( $id ) {
			return 'yuki_post_share_box_' . $id;
		}

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			$controls = [
				( new Section( 'yuki_post_container' ) )
					->setLabel( __( 'Container', 'yuki' ) )
					->setControls( $this->getContainerControls( 'single_post', [
						'layout' => 'narrow',
					] ) )
				,
				( new Section( 'yuki_post_sidebar_section' ) )
					->setLabel( __( 'Sidebar', 'yuki' ) )
					->enableSwitch( false )
					->setControls( [
						( new ImageRadio( 'yuki_post_sidebar_layout' ) )
							->setLabel( __( 'Sidebar Layout', 'yuki' ) )
							->setDefaultValue( 'right-sidebar' )
							->setChoices( [
								'left-sidebar'  => [
									'title' => __( 'Left Sidebar', 'yuki' ),
									'src'   => yuki_image_url( 'left-sidebar.png' ),
								],
								'right-sidebar' => [
									'title' => __( 'Right Sidebar', 'yuki' ),
									'src'   => yuki_image_url( 'right-sidebar.png' ),
								],
							] )
						,
					] )
				,

				( new Section( 'yuki_post_header' ) )
					->setLabel( __( 'Post Header', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getHeaderControls( 'post' ) )
				,

				( new Section( 'yuki_post_featured_image' ) )
					->setLabel( __( 'Featured Image', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getFeaturedImageControls( 'post' ) )
				,

				( new Section( 'yuki_post_share_box' ) )
					->setLabel( __( 'Share Box', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getSocialControls( array(
						'selector'            => '.yuki-post-socials',
						'icon-size'           => '18px',
						'icons-shape'         => 'rounded',
						'icons-color-initial' => 'var(--yuki-base-color)',
						'icons-color-hover'   => 'var(--yuki-base-color)',
						'icons-bg-initial'    => 'var(--yuki-official-color)',
						'icons-bg-hover'      => 'var(--yuki-primary-color)',
						'disabled-padding'    => [ 'left', 'right' ],
						'disabled-margin'     => [ 'left', 'right' ],
						'icons-box-padding'   => [
							'top'    => '0px',
							'right'  => '0px',
							'bottom' => '0px',
							'left'   => '0px',
							'linked' => true,
						],
						'icons-box-spacing'   => [
							'top'    => '36px',
							'right'  => '0px',
							'bottom' => '36px',
							'left'   => '0px',
							'linked' => true,
						],
					) ) )
				,

				( new Section( 'yuki_post_navigation' ) )
					->setLabel( __( 'Posts Navigation', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getNavigationControls( 'post' ) )
				,
			];

			return apply_filters( 'yuki_single_post_section_controls', $controls );
		}

		/**
		 * @return array
		 */
		protected function getNavigationControls( $type ) {
			return [
				( new ColorPicker( 'yuki_' . $type . '_navigation_text_color' ) )
					->setLabel( __( 'Text Color', 'yuki' ) )
					->asyncColors( '.yuki-post-navigation', [
						'initial' => '--yuki-navigation-initial-color',
						'hover'   => '--yuki-navigation-hover-color',
					] )
					->addColor( 'initial', __( 'Initial', 'yuki' ), 'var(--yuki-accent-color)' )
					->addColor( 'hover', __( 'Hover', 'yuki' ), 'var(--yuki-primary-color)' )
				,
				( new Separator() ),
				( new Icons( 'yuki_' . $type . '_navigation_prev_icon' ) )
					->setLabel( __( 'Prev Icon', 'yuki' ) )
					->setDefaultValue( [
						'value'   => 'fas fa-arrow-left-long',
						'library' => 'fa-solid',
					] )
				,
				( new Icons( 'yuki_' . $type . '_navigation_next_icon' ) )
					->setLabel( __( 'Prev Icon', 'yuki' ) )
					->setDefaultValue( [
						'value'   => 'fas fa-arrow-right-long',
						'library' => 'fa-solid',
					] )
				,
				( new Separator() ),
				( new Border( 'yuki_' . $type . '_navigation_border_top' ) )
					->setLabel( __( 'Border Top', 'yuki' ) )
					->asyncCss( '.yuki-post-navigation', AsyncCss::border( 'border-top' ) )
					->setDefaultBorder( 1, 'dashed', 'var(--yuki-base-300)' )
				,
				( new Border( 'yuki_' . $type . '_navigation_border_bottom' ) )
					->setLabel( __( 'Border Bottom', 'yuki' ) )
					->asyncCss( '.yuki-post-navigation', AsyncCss::border( 'border-bottom' ) )
					->setDefaultBorder( 1, 'dashed', 'var(--yuki-base-300)' )
				,
				( new Separator() ),
				( new Spacing( 'yuki_' . $type . '_navigation_padding' ) )
					->setLabel( __( 'Padding', 'yuki' ) )
					->asyncCss( '.yuki-post-navigation', AsyncCss::dimensions( 'padding' ) )
					->setDisabled( [ 'left', 'right' ] )
					->setSpacing( [
						'top'    => '24px',
						'bottom' => '24px',
						'linked' => true
					] )
				,
				( new Spacing( 'yuki_' . $type . '_navigation_margin' ) )
					->setLabel( __( 'Margin', 'yuki' ) )
					->asyncCss( '.yuki-post-navigation', AsyncCss::dimensions() )
					->setDisabled( [ 'left', 'right' ] )
					->setSpacing( [
						'top'    => '36px',
						'bottom' => '36px',
						'linked' => true
					] )
				,
				( new Spacing( 'yuki_' . $type . '_navigation_thumb_radius' ) )
					->setLabel( __( 'Thumbnail Radius', 'yuki' ) )
					->asyncCss( '.yuki-post-navigation', AsyncCss::dimensions( '--yuki-navigation-thumb-radius' ) )
					->setSpacing( [
						'top'    => '8px',
						'right'  => '8px',
						'bottom' => '8px',
						'left'   => '8px',
						'linked' => true
					] )
				,
			];
		}
	}
}


