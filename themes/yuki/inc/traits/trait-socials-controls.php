<?php

/**
 * Socials trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\CallToAction ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Facades\AsyncCss ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Socials_Controls' ) ) {
    /**
     * Socials controls
     */
    trait Yuki_Socials_Controls
    {
        /**
         * @param string $id
         *
         * @return string
         */
        protected function getSocialControlId( $id )
        {
            return $id;
        }
        
        /**
         * @return array
         */
        public function getSocialControls( $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, [
                'render-callback'      => [],
                'selector'             => '',
                'new-tab'              => 'yes',
                'no-follow'            => 'yes',
                'icon-size'            => '14px',
                'icon-spacing'         => '14px',
                'icons-color-type'     => 'custom',
                'icons-shape'          => 'none',
                'icons-fill-type'      => 'solid',
                'icons-color-initial'  => 'var(--yuki-accent-active)',
                'icons-color-hover'    => 'var(--yuki-primary-active)',
                'icons-bg-initial'     => 'var(--yuki-base-100)',
                'icons-bg-hover'       => 'var(--yuki-primary-active)',
                'icons-border-initial' => 'var(--yuki-base-200)',
                'icons-border-hover'   => 'var(--yuki-primary-active)',
                'disabled-padding'     => [ 'top', 'bottom' ],
                'disabled-margin'      => [ 'top', 'bottom' ],
                'icons-box-padding'    => [
                'top'    => '0px',
                'right'  => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'linked' => true,
            ],
                'icons-box-spacing'    => [
                'top'    => '0px',
                'right'  => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'linked' => true,
            ],
            ] );
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), $this->getSocialContentControls( $defaults ) )->addTab( 'style', __( 'Style', 'yuki' ), $this->getSocialStyleControls( $defaults ) ) ];
        }
        
        /**
         * @param array $defaults
         *
         * @return array
         */
        protected function getSocialContentControls( $defaults = array() )
        {
            $render_callback = $defaults['render-callback'];
            $controls = [
                ( new CallToAction() )->setLabel( __( 'Edit Social Network Accounts', 'yuki' ) )->displayAsButton()->expandCustomize( 'yuki_global:yuki_global_socials' ),
                new Separator(),
                ( new Toggle( $this->getSocialControlId( 'open_new_tab' ) ) )->setLabel( __( 'Open In New Tab', 'yuki' ) )->selectiveRefresh( ...$render_callback )->setDefaultValue( $defaults['new-tab'] ),
                ( new Toggle( $this->getSocialControlId( 'no_follow' ) ) )->setLabel( __( 'No Follow', 'yuki' ) )->selectiveRefresh( ...$render_callback )->setDefaultValue( $defaults['no-follow'] ),
                new Separator(),
                ( new Slider( $this->getSocialControlId( 'icons_size' ) ) )->setLabel( __( 'Icons Size', 'yuki' ) )->asyncCss( $defaults['selector'], [
                '--yuki-social-icons-size' => 'value',
            ] )->enableResponsive()->setMin( 5 )->setMax( 50 )->setDefaultUnit( 'px' )->setDefaultValue( $defaults['icon-size'] ),
                ( new Slider( $this->getSocialControlId( 'icons_spacing' ) ) )->setLabel( __( 'Icons Spacing', 'yuki' ) )->enableResponsive()->asyncCss( $defaults['selector'], [
                '--yuki-social-icons-spacing' => 'value',
            ] )->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( $defaults['icon-spacing'] ),
                new Separator(),
                ( new Radio( $this->getSocialControlId( 'icons_color_type' ) ) )->setLabel( __( 'Icons Color', 'yuki' ) )->buttonsGroupView()->selectiveRefresh( ...$render_callback )->setDefaultValue( $defaults['icons-color-type'] )->setChoices( [
                'custom'   => __( 'Custom', 'yuki' ),
                'official' => __( 'Official', 'yuki' ),
            ] )
            ];
            $controls = array_merge( $controls, [ ( new Placeholder( $this->getSocialControlId( 'icons_shape' ) ) )->setDefaultValue( $defaults['icons-shape'] ), ( new Placeholder( $this->getSocialControlId( 'shape_fill_type' ) ) )->setDefaultValue( $defaults['icons-fill-type'] ), yuki_upsell_info_control( __( 'More social icon options in our %sPro Version%s', 'yuki' ) ) ] );
            return $controls;
        }
        
        /**
         * @param array $defaults
         *
         * @return array
         */
        protected function getSocialStyleControls( $defaults = array() )
        {
            $controls = [ ( new Condition() )->setCondition( [
                $this->getSocialControlId( 'icons_color_type' ) => 'custom',
            ] )->setControls( [ ( new ColorPicker( $this->getSocialControlId( 'icons_color' ) ) )->setLabel( __( 'Icons Color', 'yuki' ) )->asyncColors( $defaults['selector'] . ' .yuki-social-link', [
                'initial' => '--yuki-social-icon-initial-color',
                'hover'   => '--yuki-social-icon-hover-color',
            ] )->addColor( 'initial', __( 'Initial', 'yuki' ), $defaults['icons-color-initial'] )->addColor( 'hover', __( 'Hover', 'yuki' ), $defaults['icons-color-hover'] ), new Separator() ] ) ];
            $controls = array_merge( $controls, [
                ( new Placeholder( $this->getSocialControlId( 'icons_bg_color' ) ) )->addColor( 'initial', $defaults['icons-bg-initial'] )->addColor( 'hover', $defaults['icons-bg-hover'] ),
                ( new Placeholder( $this->getSocialControlId( 'icons_border_color' ) ) )->addColor( 'initial', $defaults['icons-border-initial'] )->addColor( 'hover', $defaults['icons-border-hover'] ),
                ( new Placeholder( $this->getSocialControlId( 'padding' ) ) )->setDefaultValue( $defaults['icons-box-padding'] ),
                ( new Placeholder( $this->getSocialControlId( 'margin' ) ) )->setDefaultValue( $defaults['icons-box-spacing'] ),
                yuki_upsell_info_control( __( 'Fully customize your social icons in our %sPro Version%s', 'yuki' ) )
            ] );
            return $controls;
        }
    
    }
}