<?php
/**
 * Single page customizer section
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\ImageRadio;
use LottaFramework\Customizer\Controls\Section;
use LottaFramework\Customizer\Section as CustomizerSection;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Pages_Section' ) ) {

	class Yuki_Pages_Section extends CustomizerSection {

		use Yuki_Article_Controls;
		use Yuki_Socials_Controls;

		/**
		 * @param string $id
		 *
		 * @return string
		 */
		protected function getSocialControlId( $id ) {
			return 'yuki_page_share_box_' . $id;
		}

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {
			$controls = [
				( new Section( 'yuki_page_container' ) )
					->setLabel( __( 'Container', 'yuki' ) )
					->setControls( $this->getContainerControls( 'pages' ) )
				,
				( new Section( 'yuki_page_sidebar_section' ) )
					->setLabel( __( 'Sidebar', 'yuki' ) )
					->enableSwitch( false )
					->setControls( [
						( new ImageRadio( 'yuki_page_sidebar_layout' ) )
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

				( new Section( 'yuki_page_header' ) )
					->setLabel( __( 'Page Header', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getHeaderControls( 'page', [
						'metas' => [
							'elements' => [
								[ 'id' => 'published', 'visible' => true ]
							],
						],
					] ) )
				,

				( new Section( 'yuki_page_featured_image' ) )
					->setLabel( __( 'Featured Image', 'yuki' ) )
					->enableSwitch()
					->setControls( $this->getFeaturedImageControls( 'page', [
						'image-style' => 'below'
					] ) )
				,

				( new Section( 'yuki_page_share_box' ) )
					->setLabel( __( 'Share Box', 'yuki' ) )
					->enableSwitch( false )
					->setControls( $this->getSocialControls( array(
						'selector'            => '.yuki-page-socials',
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
			];

			return apply_filters( 'yuki_pages_section_controls', $controls );
		}
	}
}


