<?php

/**
 * Homepage builder row
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\PageBuilder\Container ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Homepage_Row' ) ) {
    class Yuki_Homepage_Row extends Container
    {
        use  Yuki_Advanced_CSS_Controls ;
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts( $id, $data )
        {
            $settings = $data['settings'] ?? [];
            // Add builder row dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) use( $id, $settings ) {
                $css[".{$id}"] = array_merge(
                    [
                    'align-items'        => $this->get( 'vt_align', $settings ),
                    'justify-content'    => $this->get( 'hr_align', $settings ),
                    'overflow'           => $this->get( 'overflow', $settings ),
                    '--yuki-columns-gap' => $this->get( 'columns-gap', $settings ),
                ],
                    Css::background( $this->get( 'background', $settings ) ),
                    Css::shadow( $this->get( 'box-shadow', $settings ) ),
                    Css::border( $this->get( 'border', $settings ) ),
                    Css::dimensions( $this->get( 'radius', $settings ), 'border-radius' ),
                    Css::dimensions( $this->get( 'margin', $settings ), 'margin' ),
                    Css::dimensions( $this->get( 'padding', $settings ), 'padding' )
                );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function start( $id, $data, $location = '' )
        {
            $settings = $data['settings'] ?? [];
            $css_classes = Utils::clsx( [ 'yuki-page-builder-row', 'yuki-page-builder-stretch-row' => $this->checked( 'stretch', $settings ), $id ] );
            $this->add_render_attribute( $id, 'class', $css_classes );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'section-border' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $location );
            }
            
            echo  '<div ' . $this->render_attribute_string( $id ) . '>' ;
        }
        
        /**
         * {@inheritDoc}
         */
        public function end( $id, $data )
        {
            echo  '</div>' ;
        }
        
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'layout' )->addTab( 'layout', __( 'Layout', 'yuki' ), [
                ( new Slider( 'columns-gap' ) )->enableResponsive()->setLabel( __( 'Columns Gap', 'yuki' ) )->setDefaultValue( '6px' )->setDefaultUnit( 'px' )->setMin( 0 )->setMax( 200 ),
                new Separator(),
                ( new ImageRadio( 'vt_align' ) )->setLabel( __( 'Vertical Alignment', 'yuki' ) )->enableResponsive()->inlineChoices()->setDefaultValue( 'flex-start' )->setChoices( [
                'flex-start' => [
                'src'   => yuki_image( 'justify-start-v' ),
                'title' => __( 'Start', 'yuki' ),
            ],
                'center'     => [
                'src'   => yuki_image( 'justify-center-v' ),
                'title' => __( 'Center', 'yuki' ),
            ],
                'flex-end'   => [
                'src'   => yuki_image( 'justify-end-v' ),
                'title' => __( 'End', 'yuki' ),
            ],
            ] ),
                new Separator(),
                ( new ImageRadio( 'hr_align' ) )->setLabel( __( 'Horizontal Alignment', 'yuki' ) )->enableResponsive()->inlineChoices()->setDefaultValue( 'flex-start' )->setChoices( [
                'flex-start' => [
                'src'   => yuki_image( 'justify-start-h' ),
                'title' => __( 'Start', 'yuki' ),
            ],
                'center'     => [
                'src'   => yuki_image( 'justify-center-h' ),
                'title' => __( 'Center', 'yuki' ),
            ],
                'flex-end'   => [
                'src'   => yuki_image( 'justify-end-h' ),
                'title' => __( 'End', 'yuki' ),
            ],
            ] ),
                new Separator(),
                ( new Radio( 'overflow' ) )->enableResponsive()->setLabel( __( 'Overflow', 'yuki' ) )->setDefaultValue( 'visible' )->setChoices( [
                'visible' => __( 'Visible', 'yuki' ),
                'hidden'  => __( 'Hidden', 'yuki' ),
                'scroll'  => __( 'Scroll', 'yuki' ),
                'auto'    => __( 'Auto', 'yuki' ),
            ] ),
                new Separator(),
                ( new Toggle( 'stretch' ) )->setLabel( __( 'Stretch Row', 'yuki' ) )->setDescription( __( 'Stretch the row to the full width of the page.', 'yuki' ) )->closeByDefault()
            ] )->addTab( 'style', __( 'Style', 'yuki' ), [
                ( new Background( 'background' ) )->setLabel( __( 'Background', 'yuki' ) )->setDefaultValue( [
                'type'  => 'color',
                'color' => 'var(--yuki-transparent)',
            ] ),
                new Separator(),
                ( new BoxShadow( 'box-shadow' ) )->setLabel( __( 'Shadow', 'yuki' ) )->setDefaultShadow(
                'rgba(44, 62, 80, 0.35)',
                '0px',
                '0px',
                '10px',
                '0px',
                false
            ),
                new Separator(),
                ( new Border( 'border' ) )->setLabel( __( 'Border', 'yuki' ) )->setDefaultBorder( 1, 'none', 'var(--yuki-base-200)' ),
                new Separator(),
                ( new Spacing( 'radius' ) )->setLabel( __( 'Border Radius', 'yuki' ) )->enableResponsive()->setDefaultValue( [
                'linked' => true,
                'left'   => '0px',
                'right'  => '0px',
                'top'    => '0px',
                'bottom' => '0px',
            ] ),
                new Separator(),
                ( new Spacing( 'margin' ) )->setLabel( __( 'Margin', 'yuki' ) )->enableResponsive()->setDisabled( [ 'left', 'right' ] )->setDefaultValue( [
                'linked' => false,
                'left'   => '0px',
                'right'  => '0px',
                'top'    => '0px',
                'bottom' => '48px',
            ] ),
                ( new Spacing( 'padding' ) )->setLabel( __( 'Padding', 'yuki' ) )->enableResponsive()->setDefaultValue( [
                'linked' => true,
                'left'   => '0px',
                'right'  => '0px',
                'top'    => '0px',
                'bottom' => '0px',
            ] )
            ] )->addTab( 'advanced', __( 'Advanced', 'yuki' ), $this->getAdvancedCssControls() ) ];
        }
    
    }
}