<?php

/**
 * Icon Button trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Icon_Button_Controls' ) ) {
    /**
     * Icon Button controls
     */
    trait Yuki_Icon_Button_Controls
    {
        protected function getIconControls( $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'render-callback' => [],
                'selector'        => '',
                'size'            => '14px',
                'shape'           => 'none',
                'fill'            => 'solid',
            ] );
            $render_callback = $defaults['render-callback'];
            $controls = [ ( new Slider( $this->getSlug( 'icon_button_size' ) ) )->setLabel( __( 'Icon Size', 'yuki' ) )->enableResponsive()->asyncCss( $defaults['selector'], [
                '--yuki-icon-button-size' => 'value',
                'font-size'               => 'value',
            ] )->setDefaultValue( $defaults['size'] )->setMin( 5 )->setMax( 50 )->setDefaultUnit( 'px' ), new Separator() ];
            $controls = array_merge( $controls, [ ( new Placeholder( $this->getSlug( 'icon_button_icon_shape' ) ) )->setDefaultValue( $defaults['shape'] ), ( new Placeholder( $this->getSlug( 'icon_button_shape_fill_type' ) ) )->setDefaultValue( $defaults['fill'] ), yuki_upsell_info_control( __( 'More icon options in our %sPro Version%s', 'yuki' ) ) ] );
            return $controls;
        }
        
        protected function getIconStyleControls( $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'selector'       => '',
                'icon-initial'   => 'var(--yuki-accent-color)',
                'icon-hover'     => 'var(--yuki-primary-color)',
                'bg-initial'     => 'var(--yuki-base-100)',
                'bg-hover'       => 'var(--yuki-primary-active)',
                'border-initial' => 'var(--yuki-base-200)',
                'border-hover'   => 'var(--yuki-primary-active)',
            ] );
            $controls = [ ( new ColorPicker( $this->getSlug( 'icon_button_icon_color' ) ) )->setLabel( __( 'Icon Color', 'yuki' ) )->enableAlpha()->asyncColors( $defaults['selector'], [
                'initial' => '--yuki-icon-button-icon-initial-color',
                'hover'   => '--yuki-icon-button-icon-hover-color',
            ] )->addColor( 'initial', __( 'Initial', 'yuki' ), $defaults['icon-initial'] )->addColor( 'hover', __( 'Hover', 'yuki' ), $defaults['icon-hover'] ) ];
            $controls = array_merge( $controls, [ ( new Placeholder( $this->getSlug( 'icon_button_bg_color' ) ) )->addColor( 'initial', $defaults['bg-initial'] )->addColor( 'hover', $defaults['bg-hover'] ), ( new Placeholder( $this->getSlug( 'icon_button_border_color' ) ) )->addColor( 'initial', $defaults['border-initial'] )->addColor( 'hover', $defaults['border-hover'] ), yuki_upsell_info_control( __( 'Fully customize your icon button in our %sPro Version%s', 'yuki' ) ) ] );
            return $controls;
        }
        
        public function getIconButtonCss()
        {
            return array_merge(
                Css::colors( CZ::get( $this->getSlug( 'icon_button_icon_color' ) ), [
                'initial' => '--yuki-icon-button-icon-initial-color',
                'hover'   => '--yuki-icon-button-icon-hover-color',
            ] ),
                Css::colors( CZ::get( $this->getSlug( 'icon_button_bg_color' ) ), [
                'initial' => '--yuki-icon-button-bg-initial-color',
                'hover'   => '--yuki-icon-button-bg-hover-color',
            ] ),
                Css::colors( CZ::get( $this->getSlug( 'icon_button_border_color' ) ), [
                'initial' => '--yuki-icon-button-border-initial-color',
                'hover'   => '--yuki-icon-button-border-hover-color',
            ] ),
                [
                '--yuki-icon-button-size' => CZ::get( $this->getSlug( 'icon_button_size' ) ),
                'font-size'               => CZ::get( $this->getSlug( 'icon_button_size' ) ),
            ]
            );
        }
    
    }
}