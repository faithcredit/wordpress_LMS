<?php
/**
 * Homepage builder instance
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\PageBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Homepage_Builder' ) ) {

	class Yuki_Homepage_Builder {
		/**
		 * @var null
		 */
		protected static $_instance = null;

		/**
		 * @var PageBuilder|null
		 */
		protected $_builder = null;

		/**
		 * Construct builder
		 */
		protected function __construct() {
			$this->_builder = ( new PageBuilder( apply_filters( 'yuki_homepage_builder_id', 'yuki_homepage_builder' ), Yuki_Homepage_Row::instance(), Yuki_Homepage_Column::instance() ) )
				->setLabel( __( 'Homepage', 'yuki' ) )
				->bindSelectiveRefresh( 'yuki-homepage-selective-css' )
				->selectiveRefresh( '.yuki-homepage-builder-container', function () {
					Yuki_Homepage_Builder::render();
				} )
				->addElement( ( new Yuki_Heading_Element( 'heading', __( 'Heading', 'yuki' ) ) )->setIcon( yuki_image( 'heading' ) ) )
				->addElement( ( new Yuki_Text_Element( 'text', __( 'Text', 'yuki' ) ) )->setIcon( yuki_image( 'text' ) ) )
				->addElement( ( new Yuki_Hero_Element( 'hero', __( 'Hero', 'yuki' ) ) )->setIcon( yuki_image( 'call-to-action' ) ) )
				->addElement( ( new Yuki_Features_Element( 'features', __( 'Features', 'yuki' ) ) )->setIcon( yuki_image( 'featured-image' ) ) )
				->addElement( ( new Yuki_Reviews_Element( 'reviews', __( 'Reviews', 'yuki' ) ) )->setIcon( yuki_image( 'review' ) ) )
				->addElement( ( new Yuki_Magazine_Element( 'magazine-grid', __( 'Magazine Grid', 'yuki' ) ) )->setIcon( yuki_image( 'magazine-grid' ) ) )
				->addElement( ( new Yuki_Posts_Grid_Element( 'posts-grid', __( 'Posts Grid', 'yuki' ) ) )->setIcon( yuki_image( 'posts-grid' ) ) )
				->addElement( ( new Yuki_Posts_Slider_Element( 'posts-slider', __( 'Posts Slider', 'yuki' ) ) )->setIcon( yuki_image( 'slides' ) ) )
				->addElement(
					( new Yuki_Homepage_Widgets_Element( 'frontpage-widgets-1', __( 'Widgets #1', 'yuki' ) ) )
						->setIcon( yuki_image( 'wordpress' ) ) )
				->addElement(
					( new Yuki_Homepage_Widgets_Element( 'frontpage-widgets-2', __( 'Widgets #2', 'yuki' ) ) )
						->setIcon( yuki_image( 'wordpress' ) ) )
				->addElement(
					( new Yuki_Homepage_Widgets_Element( 'frontpage-widgets-3', __( 'Widgets #3', 'yuki' ) ) )
						->setIcon( yuki_image( 'wordpress' ) ) )
				->addElement(
					( new Yuki_Homepage_Widgets_Element( 'frontpage-widgets-4', __( 'Widgets #4', 'yuki' ) ) )
						->setIcon( yuki_image( 'wordpress' ) ) )
				->setDefaultValue( [
					[
						'settings' => [ 'stretch' => 'yes', 'columns-gap' => '0px' ],
						'columns'  => [
							[
								'elements' => [
									[
										'id'       => 'hero',
										'settings' => []
									],
								],
								'settings' => [],
							],
						],
					],
					[
						'settings' => [],
						'columns'  => [
							[
								'elements' => [
									[
										'id'       => 'heading',
										'settings' => [
											'title' => __( 'Exclusive Features', 'yuki' )
										],
									],
									[
										'id'       => 'features',
										'settings' => [
											'media-size'    => '64px',
											'media-spacing' => '24px',
											'features'      => [
												[
													'visible'  => true,
													'settings' => [
														'title'       => __( 'Online Business', 'yuki' ),
														'description' => 'Lorem ipsum dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore dolore magna.',
														'media-type'  => 'image',
														'image'       => [ 'url' => yuki_image_url( 'feature-01.png' ) ],
													]
												],
												[
													'visible'  => true,
													'settings' => [
														'title'       => __( 'Blogging', 'yuki' ),
														'description' => 'Lorem ipsum dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore dolore magna.',
														'media-type'  => 'image',
														'image'       => [ 'url' => yuki_image_url( 'feature-02.png' ) ],
													]
												],
												[
													'visible'  => true,
													'settings' => [
														'title'       => __( 'Powerful Design', 'yuki' ),
														'description' => 'Lorem ipsum dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore dolore magna.',
														'media-type'  => 'image',
														'image'       => [ 'url' => yuki_image_url( 'feature-03.png' ) ],
													]
												],
											],
										]
									],
								],
								'settings' => [
									//
								],
							],
						],
					],
					[
						'settings' => [ 'stretch' => 'yes', 'columns-gap' => '0px' ],
						'columns'  => [
							[
								'settings' => [
									'elements-gap' => '0px'
								],
								'elements' => [
									[
										'id'       => 'hero',
										'settings' => [
											'title'               => 'Proin sed libero enim sed faucibus',
											'description'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In aliquam sem fringilla ut morbi tincidunt augue interdum. Interdum varius sit amet mattis vulputate',
											'button_text'         => '',
											'media_align'         => 'center',
											'shape_divider'       => 'none',
											'min_height'          => '480px',
											'media'               => [
												'url' => yuki_image_url( 'feature-01.png' )
											],
											'background'          => [
												'type'  => 'color',
												'color' => 'var(--yuki-base-color)',
											],
											'title_color'         => [
												'initial' => 'var(--yuki-accent-active)',
											],
											'description_color'   => [
												'initial' => 'var(--yuki-accent-color)',
											],
											'button_border'       => [
												'width' => 1,
												'style' => 'solid',
												'color' => 'var(--yuki-primary-color)',
												'hover' => 'var(--yuki-primary-active)',
											],
											'button_text_color'   => [
												'initial' => 'var(--yuki-primary-color)',
												'hover'   => 'var(--yuki-base-color)',
											],
											'button_button_color' => [
												'initial' => 'var(--yuki-transparent)',
												'hover'   => 'var(--yuki-primary-active)',
											],
										]
									],

									[
										'id'       => 'hero',
										'settings' => [
											'title'               => 'Proin sed libero enim sed faucibus',
											'description'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In aliquam sem fringilla ut morbi tincidunt augue interdum. Interdum varius sit amet mattis vulputate',
											'button_text'         => '',
											'media_align'         => 'center',
											'shape_divider'       => 'none',
											'min_height'          => '480px',
											'layout'              => 'media-content',
											'media'               => [
												'url' => yuki_image_url( 'feature-02.png' )
											],
											'background'          => [
												'type'  => 'color',
												'color' => 'var(--yuki-base-color)',
											],
											'title_color'         => [
												'initial' => 'var(--yuki-accent-active)',
											],
											'description_color'   => [
												'initial' => 'var(--yuki-accent-color)',
											],
											'button_border'       => [
												'width' => 1,
												'style' => 'solid',
												'color' => 'var(--yuki-primary-color)',
												'hover' => 'var(--yuki-primary-active)',
											],
											'button_text_color'   => [
												'initial' => 'var(--yuki-primary-color)',
												'hover'   => 'var(--yuki-base-color)',
											],
											'button_button_color' => [
												'initial' => 'var(--yuki-transparent)',
												'hover'   => 'var(--yuki-primary-active)',
											],
										]
									],

									[
										'id'       => 'hero',
										'settings' => [
											'title'               => 'Proin sed libero enim sed faucibus',
											'description'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In aliquam sem fringilla ut morbi tincidunt augue interdum. Interdum varius sit amet mattis vulputate',
											'button_text'         => '',
											'media_align'         => 'center',
											'min_height'          => '640px',
											'layout'              => 'content-media',
											'media'               => [
												'url' => yuki_image_url( 'feature-03.png' )
											],
											'background'          => [
												'type'  => 'color',
												'color' => 'var(--yuki-base-color)',
											],
											'title_color'         => [
												'initial' => 'var(--yuki-accent-active)',
											],
											'description_color'   => [
												'initial' => 'var(--yuki-accent-color)',
											],
											'button_border'       => [
												'width' => 1,
												'style' => 'solid',
												'color' => 'var(--yuki-primary-color)',
												'hover' => 'var(--yuki-primary-active)',
											],
											'button_text_color'   => [
												'initial' => 'var(--yuki-primary-color)',
												'hover'   => 'var(--yuki-base-color)',
											],
											'button_button_color' => [
												'initial' => 'var(--yuki-transparent)',
												'hover'   => 'var(--yuki-primary-active)',
											],
										]
									],
								],
							],
						],
					],
					[
						'settings' => [],
						'columns'  => [
							[
								'elements' => [
									[
										'id'       => 'heading',
										'settings' => [
											'title' => __( 'What Our Clients Says?', 'yuki' )
										],
									],
									[
										'id'       => 'reviews',
										'settings' => []
									],
								],
								'settings' => [
									//
								],
							],
						],
					],
				] );
		}

		/**
		 * Get header builder
		 *
		 * @return Yuki_Homepage_Builder|null
		 */
		public static function instance() {
			if ( self::$_instance === null ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Magic static calls
		 *
		 * @param $method
		 * @param $args
		 *
		 * @return mixed
		 */
		public static function __callStatic( $method, $args ) {
			$builder = self::instance()->builder();

			if ( method_exists( $builder, $method ) ) {
				return $builder->$method( ...$args );
			}

			return null;
		}

		/**
		 * @return PageBuilder|null
		 */
		public function builder() {
			return $this->_builder;
		}
	}
}

