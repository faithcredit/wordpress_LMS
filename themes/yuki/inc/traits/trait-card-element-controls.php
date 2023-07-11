<?php

/**
 * Homepage card trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Spacing ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Card_Element_Controls' ) ) {
    /**
     * Post structure functions
     */
    trait Yuki_Card_Element_Controls
    {
        protected function getCardStyleControls( $prefix = '', $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'content-align'      => 'center',
                'card-padding'       => [
                'top'    => '48px',
                'bottom' => '48px',
                'left'   => '48px',
                'right'  => '48px',
                'linked' => true,
            ],
                'card-radius'        => [
                'top'    => '4px',
                'bottom' => '4px',
                'left'   => '4px',
                'right'  => '4px',
                'linked' => true,
            ],
                'card-border'        => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'card-shadow'        => [
                'rgba(44, 62, 80, 0.15)',
                '0px',
                '10px',
                '20px',
                '0px'
            ],
                'card-shadow-enable' => false,
                'card-background'    => [
                'type'  => 'color',
                'color' => 'var(--yuki-base-color)',
            ],
            ] );
            $controls = [
                ( new ImageRadio( $prefix . 'content-align' ) )->setLabel( __( 'Alignment', 'yuki' ) )->inlineChoices()->setDefaultValue( $defaults['content-align'] )->setChoices( [
                'left'   => [
                'src' => yuki_image( 'text-left' ),
            ],
                'center' => [
                'src' => yuki_image( 'text-center' ),
            ],
                'right'  => [
                'src' => yuki_image( 'text-right' ),
            ],
            ] ),
                new Separator(),
                ( new Spacing( $prefix . 'card-padding' ) )->setLabel( __( 'Padding', 'yuki' ) )->setDefaultValue( $defaults['card-padding'] ),
                ( new Spacing( $prefix . 'card-radius' ) )->setLabel( __( 'Radius', 'yuki' ) )->setDefaultValue( $defaults['card-radius'] ),
                new Separator()
            ];
            $controls = array_merge( $controls, [
                ( new Placeholder( $prefix . 'card-border' ) )->setDefaultBorder( ...$defaults['card-border'] ),
                ( new Placeholder( $prefix . 'card-shadow' ) )->setDefaultShadow( ...array_merge( $defaults['card-shadow'], [ $defaults['card-shadow-enable'] ] ) ),
                ( new Placeholder( $prefix . 'card-background' ) )->setDefaultValue( $defaults['card-background'] ),
                yuki_upsell_info_control( __( 'Fully customize card style in our %sPro Version%s', 'yuki' ) )
            ] );
            return $controls;
        }
    
    }
}