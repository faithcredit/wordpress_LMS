<?php

/**
 * Post card trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Facades\AsyncCss ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Post_Card' ) ) {
    /**
     * Post card functions
     */
    trait Yuki_Post_Card
    {
        /**
         * @param string $prefix
         * @param array $defaults
         *
         * @return array
         */
        protected function getCardContentControls( $prefix = '', $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, apply_filters( 'yuki_card_content_defaults', [
                'exclude'           => [],
                'selector'          => '',
                'spacing'           => '24px',
                'text'              => 'left',
                'vertical'          => 'flex-start',
                'thumbnail-spacing' => '0px',
            ] ) );
            $exclude = $defaults['exclude'];
            $controls = [];
            
            if ( !in_array( 'thumb-spacing', $exclude ) ) {
                $controls[] = ( new Slider( $prefix . 'card_thumbnail_spacing' ) )->setLabel( __( 'Thumbnail Spacing', 'yuki' ) )->asyncCss( $defaults['selector'], [
                    '--card-thumbnail-spacing' => 'value',
                ] )->enableResponsive()->setDefaultUnit( 'px' )->setDefaultValue( $defaults['thumbnail-spacing'] );
                $controls[] = new Separator();
            }
            
            
            if ( !in_array( 'content-spacing', $exclude ) ) {
                $controls[] = ( new Slider( $prefix . 'card_content_spacing' ) )->setLabel( __( 'Content Spacing', 'yuki' ) )->asyncCss( $defaults['selector'], [
                    '--card-content-spacing' => 'value',
                ] )->enableResponsive()->setDefaultUnit( 'px' )->setDefaultValue( $defaults['spacing'] );
                $controls[] = new Separator();
            }
            
            if ( !in_array( 'alignment', $exclude ) ) {
                $controls = array_merge( $controls, [ ( new ImageRadio( $prefix . 'card_content_alignment' ) )->setLabel( __( 'Content Alignment', 'yuki' ) )->asyncCss( $defaults['selector'], [
                    'text-align' => 'value',
                ] )->enableResponsive()->inlineChoices()->setDefaultValue( $defaults['text'] )->setChoices( [
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
                ],
                ] ), new Separator(), ( new ImageRadio( $prefix . 'card_vertical_alignment' ) )->setLabel( __( 'Vertical Alignment', 'yuki' ) )->asyncCss( $defaults['selector'], [
                    'justify-content' => 'value',
                ] )->enableResponsive()->inlineChoices()->setDefaultValue( $defaults['vertical'] )->setChoices( [
                    'flex-start'    => [
                    'src'   => yuki_image( 'justify-start-v' ),
                    'title' => __( 'Start', 'yuki' ),
                ],
                    'center'        => [
                    'src'   => yuki_image( 'justify-center-v' ),
                    'title' => __( 'Center', 'yuki' ),
                ],
                    'flex-end'      => [
                    'src'   => yuki_image( 'justify-end-v' ),
                    'title' => __( 'End', 'yuki' ),
                ],
                    'space-between' => [
                    'src'   => yuki_image( 'justify-space-between-v' ),
                    'title' => __( 'Between', 'yuki' ),
                ],
                    'space-around'  => [
                    'src'   => yuki_image( 'justify-space-around-v' ),
                    'title' => __( 'Around', 'yuki' ),
                ],
                ] ) ] );
            }
            return $controls;
        }
        
        /**
         * @return array
         */
        protected function getCardStyleControls( $prefix = '', $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, apply_filters( 'yuki_card_style_defaults', [
                'selector'      => '',
                'exclude'       => [],
                'background'    => [
                'type'  => 'color',
                'color' => 'var(--yuki-base-color)',
            ],
                'border'        => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'shadow'        => [
                'rgba(44, 62, 80, 0.45)',
                '0px',
                '15px',
                '18px',
                '-15px'
            ],
                'shadow-enable' => true,
                'radius'        => [
                'top'    => '4px',
                'bottom' => '4px',
                'left'   => '4px',
                'right'  => '4px',
                'linked' => true,
            ],
            ] ) );
            return [
                yuki_upsell_info_control( __( 'Fully customize your posts card style in our %sPro Version%s', 'yuki' ) ),
                ( new Placeholder( $prefix . 'card_background' ) )->setDefaultValue( $defaults['background'] ),
                ( new Placeholder( $prefix . 'card_border' ) )->setDefaultBorder( ...$defaults['border'] ),
                ( new Placeholder( $prefix . 'card_shadow' ) )->setDefaultShadow( ...array_merge( $defaults['shadow'], [ $defaults['shadow-enable'] ] ) ),
                ( new Placeholder( $prefix . 'card_radius' ) )->setDefaultValue( $defaults['radius'] )
            ];
        }
        
        /**
         * @return array
         */
        protected function getCardOverlayStyleControls( $prefix = '', $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'background' => [
                'type'     => 'gradient',
                'gradient' => 'linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, #24262b 100%)',
            ],
                'radius'     => [
                'top'    => '0px',
                'right'  => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'linked' => true,
            ],
            ] );
            return [ ( new Background( $prefix . 'overlay_background' ) )->setLabel( __( 'Background', 'yuki' ) )->setDefaultValue( $defaults['background'] ), ( new Spacing( $prefix . 'overlay_radius' ) )->setLabel( __( 'Border Radius', 'yuki' ) )->setDefaultValue( $defaults['radius'] ) ];
        }
    
    }
}