<?php

/**
 * Colors customizer section
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\ColorPalettes ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Section ;
use  LottaFramework\Facades\AsyncCss ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Colors_Section' ) ) {
    class Yuki_Colors_Section extends Section
    {
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [
                ( new Tabs( 'yuki_color_scheme' ) )->setActiveTab( 'light' )->addTab( 'light', __( 'Light', 'yuki' ), $this->getColors( 'light', apply_filters( 'yuki_light_color_palettes', [
                [
                'yuki-light-primary-color'  => '#10b981',
                'yuki-light-primary-active' => '#0d9488',
                'yuki-light-accent-color'   => '#475569',
                'yuki-light-accent-active'  => '#334155',
                'yuki-light-base-300'       => '#c5c6c5',
                'yuki-light-base-200'       => '#e0e2e0',
                'yuki-light-base-100'       => '#f8f9f8',
                'yuki-light-base-color'     => '#ffffff',
            ],
                [
                'yuki-light-primary-color'  => '#ffc300',
                'yuki-light-primary-active' => '#fca311',
                'yuki-light-accent-color'   => '#003566',
                'yuki-light-accent-active'  => '#14213d',
                'yuki-light-base-300'       => '#c5c5c5',
                'yuki-light-base-200'       => '#e0e0e0',
                'yuki-light-base-100'       => '#f8f8f8',
                'yuki-light-base-color'     => '#ffffff',
            ],
                [
                'yuki-light-primary-color'  => '#7678ed',
                'yuki-light-primary-active' => '#5253cd',
                'yuki-light-accent-color'   => '#533f68',
                'yuki-light-accent-active'  => '#35095d',
                'yuki-light-base-300'       => '#c5c6c5',
                'yuki-light-base-200'       => '#e0e2e0',
                'yuki-light-base-100'       => '#f8f9f8',
                'yuki-light-base-color'     => '#ffffff',
            ],
                [
                'yuki-light-primary-color'  => '#00a4db',
                'yuki-light-primary-active' => '#096dd9',
                'yuki-light-accent-color'   => '#687385',
                'yuki-light-accent-active'  => '#000c2d',
                'yuki-light-base-300'       => '#dbdddf',
                'yuki-light-base-200'       => '#eaecee',
                'yuki-light-base-100'       => '#f7f8f9',
                'yuki-light-base-color'     => '#ffffff',
            ],
                [
                'yuki-light-primary-color'  => '#dc2626',
                'yuki-light-primary-active' => '#b91c1c',
                'yuki-light-accent-color'   => '#6b7280',
                'yuki-light-accent-active'  => '#374151',
                'yuki-light-base-300'       => '#e1d5cb',
                'yuki-light-base-200'       => '#ece9e7',
                'yuki-light-base-100'       => '#f7f5f4',
                'yuki-light-base-color'     => '#fefcfc',
            ],
                [
                'yuki-light-primary-color'  => '#000000',
                'yuki-light-primary-active' => '#000000',
                'yuki-light-accent-color'   => '#000000',
                'yuki-light-accent-active'  => '#000000',
                'yuki-light-base-300'       => '#000000',
                'yuki-light-base-200'       => '#000000',
                'yuki-light-base-100'       => '#ffffff',
                'yuki-light-base-color'     => '#ffffff',
            ]
            ] ) ) )->addTab( 'dark', __( 'Dark', 'yuki' ), $this->getColors( 'dark', apply_filters( 'yuki_dark_color_palettes', [
                [
                'yuki-dark-primary-color'  => '#10b981',
                'yuki-dark-primary-active' => '#0d9488',
                'yuki-dark-accent-color'   => '#a3a9a3',
                'yuki-dark-accent-active'  => '#f3f4f6',
                'yuki-dark-base-300'       => '#3f463f',
                'yuki-dark-base-200'       => '#2f2f2f',
                'yuki-dark-base-100'       => '#212a33',
                'yuki-dark-base-color'     => '#17212a',
            ],
                [
                'yuki-dark-primary-color'  => '#ffc300',
                'yuki-dark-primary-active' => '#fca311',
                'yuki-dark-accent-color'   => '#c5c5c5',
                'yuki-dark-accent-active'  => '#e5e5e5',
                'yuki-dark-base-300'       => '#4f4f4f',
                'yuki-dark-base-200'       => '#373747',
                'yuki-dark-base-100'       => '#2a2a2a',
                'yuki-dark-base-color'     => '#171717',
            ],
                [
                'yuki-dark-primary-color'  => '#7678ed',
                'yuki-dark-primary-active' => '#5253cd',
                'yuki-dark-accent-color'   => '#9f9baa',
                'yuki-dark-accent-active'  => '#f3f4f6',
                'yuki-dark-base-300'       => '#3f463f',
                'yuki-dark-base-200'       => '#2f2f2f',
                'yuki-dark-base-100'       => '#212a33',
                'yuki-dark-base-color'     => '#17212a',
            ],
                [
                'yuki-dark-primary-color'  => '#00a4db',
                'yuki-dark-primary-active' => '#096dd9',
                'yuki-dark-accent-color'   => '#c2c3c8',
                'yuki-dark-accent-active'  => '#fefefe',
                'yuki-dark-base-300'       => '#656571',
                'yuki-dark-base-200'       => '#484852',
                'yuki-dark-base-100'       => '#32323a',
                'yuki-dark-base-color'     => '#26262d',
            ],
                [
                'yuki-dark-primary-color'  => '#dc2626',
                'yuki-dark-primary-active' => '#b91c1c',
                'yuki-dark-accent-color'   => '#a1a1aa',
                'yuki-dark-accent-active'  => '#e4e4e7',
                'yuki-dark-base-300'       => '#3f3f46',
                'yuki-dark-base-200'       => '#27272a',
                'yuki-dark-base-100'       => '#262626',
                'yuki-dark-base-color'     => '#1e1c1c',
            ],
                [
                'yuki-dark-primary-color'  => '#ffffff',
                'yuki-dark-primary-active' => '#ffffff',
                'yuki-dark-accent-color'   => '#ffffff',
                'yuki-dark-accent-active'  => '#ffffff',
                'yuki-dark-base-300'       => '#ffffff',
                'yuki-dark-base-200'       => '#ffffff',
                'yuki-dark-base-100'       => '#000000',
                'yuki-dark-base-color'     => '#000000',
            ]
            ] ) ) ),
                ( new Radio( 'yuki_default_color_scheme' ) )->setLabel( __( 'Default Scheme', 'yuki' ) )->setDefaultValue( 'light' )->buttonsGroupView()->setChoices( [
                'light' => __( 'Light', 'yuki' ),
                'dark'  => __( 'Dark', 'yuki' ),
            ] ),
                ( new \LottaFramework\Customizer\Controls\Toggle( 'yuki_save_color_scheme' ) )->setLabel( __( 'Save User Color Scheme', 'yuki' ) )->setDescription( __( "Save the user's color scheme to the cookie and refresh the page without losing current color scheme.", 'yuki' ) )->openByDefault(),
                new Separator( 'yuki_site_background_separator' ),
                ( new Background( 'yuki_site_background' ) )->setLabel( __( 'Site Background', 'yuki' ) )->asyncCss( '.yuki-body', AsyncCss::background() )->enableResponsive()->setDefaultValue( [
                'type'  => 'color',
                'color' => 'var(--yuki-base-100)',
            ] )
            ];
        }
        
        public function getColors( $scheme, $palettes = array() )
        {
            $palettesControl = ( new ColorPalettes( "yuki_{$scheme}_color_palettes", [
                "yuki-{$scheme}-primary-color"   => __( 'Primary Color', 'yuki' ),
                "yuki-{$scheme}-primary-active"  => __( 'Primary Active', 'yuki' ),
                "yuki-{$scheme}-primary-content" => __( 'Primary Content', 'yuki' ),
                "yuki-{$scheme}-accent-color"    => __( 'Accent Color', 'yuki' ),
                "yuki-{$scheme}-accent-active"   => __( 'Accent Active', 'yuki' ),
                "yuki-{$scheme}-accent-content"  => __( 'Accent Content', 'yuki' ),
                "yuki-{$scheme}-base-color"      => __( 'Base Color', 'yuki' ),
                "yuki-{$scheme}-base-100"        => __( 'Base 100', 'yuki' ),
                "yuki-{$scheme}-base-200"        => __( 'Base 200', 'yuki' ),
                "yuki-{$scheme}-base-300"        => __( 'Base 300', 'yuki' ),
            ] ) )->setLabel( __( 'Color Presets', 'yuki' ) )->bindSelectiveRefresh( 'yuki-global-selective-css' )->setDefaultValue( apply_filters( "yuki_default_{$scheme}_palette", 'palette-1' ) );
            foreach ( $palettes as $index => $palette ) {
                $palettesControl->addPalette( 'palette-' . ($index + 1), $palette );
            }
            $controls = [ $palettesControl ];
            $controls = array_merge( $controls, [
                ( new Placeholder( "yuki_{$scheme}_primary_color" ) )->addColor( 'default', "var(--yuki-{$scheme}-primary-color)" )->addColor( 'active', "var(--yuki-{$scheme}-primary-active)" ),
                ( new Placeholder( "yuki_{$scheme}_accent_color" ) )->addColor( 'default', "var(--yuki-{$scheme}-accent-color)" )->addColor( 'active', "var(--yuki-{$scheme}-accent-active)" ),
                ( new Placeholder( "yuki_{$scheme}_base_color" ) )->addColor( '300', "var(--yuki-{$scheme}-base-300)" )->addColor( '200', "var(--yuki-{$scheme}-base-200)" )->addColor( '100', "var(--yuki-{$scheme}-base-100)" )->addColor( 'default', "var(--yuki-{$scheme}-base-color)" ),
                new Separator(),
                yuki_upsell_info_control( __( 'Fully customize your colors in %sPro Version%s', 'yuki' ) )
            ] );
            return $controls;
        }
    
    }
}