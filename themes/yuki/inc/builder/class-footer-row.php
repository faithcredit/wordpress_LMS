<?php

/**
 * Footer builder row
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\MultiSelect ;
use  LottaFramework\Customizer\Controls\Number ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\GenericBuilder\Row ;
use  LottaFramework\Facades\AsyncCss ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Footer_Row' ) ) {
    class Yuki_Footer_Row extends Row
    {
        use  Yuki_Advanced_CSS_Controls ;
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts()
        {
            // Add dynamic css for row
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) {
                $visibility = CZ::get( $this->getRowControlKey( 'visibility' ) );
                $css[".yuki-footer-row-{$this->id}"] = array_merge(
                    [
                    'z-index'        => CZ::get( $this->getRowControlKey( 'z_index' ) ),
                    'display'        => [
                    'desktop' => ( isset( $visibility['desktop'] ) && $visibility['desktop'] === 'yes' ? 'block' : 'none' ),
                    'tablet'  => ( isset( $visibility['tablet'] ) && $visibility['tablet'] === 'yes' ? 'block' : 'none' ),
                    'mobile'  => ( isset( $visibility['mobile'] ) && $visibility['mobile'] === 'yes' ? 'block' : 'none' ),
                ],
                    'padding-top'    => CZ::get( $this->getRowControlKey( 'vt_spacing' ) ),
                    'padding-bottom' => CZ::get( $this->getRowControlKey( 'vt_spacing' ) ),
                ],
                    Css::background( CZ::get( $this->getRowControlKey( 'background' ) ) ),
                    Css::border( CZ::get( $this->getRowControlKey( 'border_top' ) ), 'border-top' ),
                    Css::border( CZ::get( $this->getRowControlKey( 'border_bottom' ) ), 'border-bottom' )
                );
                return apply_filters( 'yuki_footer_row_css', $css );
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function beforeRowDevice( $device, $settings )
        {
            $classes = 'yuki-footer-row yuki-footer-row-' . $this->id;
            $attrs = [
                'class'    => $classes,
                'data-row' => $this->id,
            ];
            
            if ( is_customize_preview() ) {
                $attrs['data-shortcut'] = 'border';
                $attrs['data-shortcut-location'] = 'yuki_footer:' . $this->id;
            }
            
            echo  '<div ' . Utils::render_attribute_string( $attrs ) . '>' ;
            echo  '<div class="container mx-auto px-gutter flex flex-wrap">' ;
        }
        
        /**
         * {@inheritDoc}
         */
        public function afterRowDevice( $device, $settings )
        {
            echo  '</div></div>' ;
        }
        
        /**
         * @param $key
         *
         * @return string
         */
        protected function getRowControlKey( $key )
        {
            return 'yuki_footer_' . $this->id . '_row_' . $key;
        }
        
        /**
         * {@inheritDoc}
         */
        protected function getRowControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'general' )->addTab( 'general', __( 'General', 'yuki' ), [
                ( new Slider( $this->getRowControlKey( 'vt_spacing' ) ) )->setLabel( __( 'Vertical Spacing', 'yuki' ) )->asyncCss( ".yuki-footer-row-{$this->id}", [
                'padding-top'    => 'value',
                'padding-bottom' => 'value',
            ] )->enableResponsive()->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( '24px' ),
                ( new Number( $this->getRowControlKey( 'z_index' ) ) )->setLabel( __( 'Z Index', 'yuki' ) )->setMin( -99999 )->setMax( 99999 )->setDefaultUnit( false )->setDefaultValue( $this->getRowControlDefault( 'z_index', 9 ) ),
                new Separator(),
                ( new MultiSelect( $this->getRowControlKey( 'visibility' ) ) )->setLabel( __( 'Visibility', 'yuki' ) )->buttonsGroupView()->setChoices( [
                'desktop' => yuki_image( 'desktop' ),
                'tablet'  => yuki_image( 'tablet' ),
                'mobile'  => yuki_image( 'mobile' ),
            ] )->asyncCss( ".yuki-footer-row-{$this->id}", [
                'display' => [
                'desktop' => AsyncCss::unescape( AsyncCss::valueMapper( [
                'yes' => 'block',
                'no'  => 'none',
            ], "value['desktop']" ) ),
                'tablet'  => AsyncCss::unescape( AsyncCss::valueMapper( [
                'yes' => 'block',
                'no'  => 'none',
            ], "value['tablet']" ) ),
                'mobile'  => AsyncCss::unescape( AsyncCss::valueMapper( [
                'yes' => 'block',
                'no'  => 'none',
            ], "value['mobile']" ) ),
            ],
            ] )->setDefaultValue( [
                'desktop' => 'yes',
                'tablet'  => 'yes',
                'mobile'  => 'yes',
            ] )
            ] )->addTab( 'style', __( 'Style', 'yuki' ), [
                ( new Background( $this->getRowControlKey( 'background' ) ) )->setLabel( __( 'Background', 'yuki' ) )->asyncCss( ".yuki-footer-row-{$this->id}", AsyncCss::background() )->enableResponsive()->setDefaultValue( [
                'type'  => 'color',
                'color' => 'var(--yuki-base-color)',
            ] ),
                new Separator(),
                ( new Border( $this->getRowControlKey( 'border_top' ) ) )->setLabel( __( 'Top Border', 'yuki' ) )->asyncCss( ".yuki-footer-row-{$this->id}", AsyncCss::border( 'border-top' ) )->enableResponsive()->displayBlock()->setDefaultBorder( ...$this->getRowControlDefault( 'border_top', [ 1, 'none', 'var(--yuki-base-300)' ] ) ),
                new Separator(),
                ( new Border( $this->getRowControlKey( 'border_bottom' ) ) )->setLabel( __( 'Bottom Border', 'yuki' ) )->asyncCss( ".yuki-footer-row-{$this->id}", AsyncCss::border( 'border-bottom' ) )->enableResponsive()->displayBlock()->setDefaultBorder( ...$this->getRowControlDefault( 'border_bottom', [ 1, 'none', 'var(--yuki-base-300)' ] ) )
            ] )->addTab( 'advanced', __( 'Advanced', 'yuki' ), $this->getAdvancedCssControls( $this->getRowControlKey( '' ) ) ) ];
        }
    
    }
}