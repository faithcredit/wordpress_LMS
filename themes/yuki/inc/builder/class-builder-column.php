<?php

/**
 * Generic builder column
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\PageBuilder\Container ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;
if ( !class_exists( 'Yuki_Builder_Column' ) ) {
    class Yuki_Builder_Column extends Container
    {
        use  Yuki_Advanced_CSS_Controls ;
        /**
         * @return bool
         */
        protected function isResponsive()
        {
            return true;
        }
        
        /**
         * @return array
         */
        protected function getDefaultSettings()
        {
            return [];
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts( $id, $data )
        {
            $settings = $data['settings'] ?? [];
            // Add builder column dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) use( $id, $settings ) {
                $css[".{$id}"] = array_merge( Css::dimensions( $this->get( 'padding', $settings ), 'padding' ), [
                    'width'                       => $this->get( 'width', $settings ),
                    'flex-direction'              => $this->get( 'direction', $settings ),
                    'justify-content'             => $this->get( 'justify-content', $settings ),
                    'align-items'                 => $this->get( 'align-items', $settings ),
                    '--yuki-builder-elements-gap' => $this->get( 'elements-gap', $settings ),
                ] );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function start( $id, $data, $location = '' )
        {
            $index = $data['index'] ?? 0;
            $device = $data['device'] ?? 0;
            $settings = $data['settings'] ?? [];
            $dir = $this->get( 'direction', $settings );
            if ( !is_array( $dir ) ) {
                $dir = [
                    'desktop' => $dir,
                    'tablet'  => $dir,
                    'mobile'  => $dir,
                ];
            }
            $css_classes = Utils::clsx( [
                'yuki-builder-column',
                'yuki-builder-column-' . $index,
                'yuki-builder-column-' . $device,
                'yuki-builder-column-desktop-dir-' . $dir['desktop'] ?? 'row',
                'yuki-builder-column-tablet-dir-' . $dir['tablet'] ?? 'row',
                'yuki-builder-column-mobile-dir-' . $dir['mobile'] ?? 'row',
                $id
            ], $data['css'] ?? [] );
            $this->add_render_attribute( $id, 'class', $css_classes );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut-inner', 'true' );
                $this->add_render_attribute( $id, 'data-shortcut', 'dashed-border' );
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
        
        public function getControls()
        {
            $defaults = wp_parse_args( $this->getDefaultSettings(), [
                'width'           => '100%',
                'elements-gap'    => '12px',
                'direction'       => 'row',
                'justify-content' => 'flex-start',
                'align-items'     => 'flex-start',
                'padding'         => [
                'top'    => '0px',
                'right'  => '0px',
                'bottom' => '0px',
                'left'   => '0px',
                'linked' => true,
            ],
            ] );
            $controls = [
                ( new Slider( 'width' ) )->setLabel( __( 'Width', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setMin( 0 )->setMax( 100 )->setDefaultUnit( '%' )->setDefaultValue( $defaults['width'] ),
                new Separator(),
                ( new Slider( 'elements-gap' ) )->setLabel( __( 'Elements Gap', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( $defaults['elements-gap'] ),
                new Separator(),
                ( new Radio( 'direction' ) )->setLabel( __( 'Direction', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setDefaultValue( $defaults['direction'] )->buttonsGroupView()->setChoices( [
                'row'    => __( 'Row', 'yuki' ),
                'column' => __( 'Column', 'yuki' ),
            ] ),
                new Separator(),
                ( new Radio( 'justify-content' ) )->setLabel( __( 'Justify Content', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setDefaultValue( $defaults['justify-content'] )->buttonsGroupView()->setChoices( [
                'flex-start' => __( 'Start', 'yuki' ),
                'center'     => __( 'Center', 'yuki' ),
                'flex-end'   => __( 'End', 'yuki' ),
            ] ),
                new Separator(),
                ( new Radio( 'align-items' ) )->setLabel( __( 'Align Items', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setDefaultValue( $defaults['align-items'] )->buttonsGroupView()->setChoices( [
                'flex-start' => __( 'Start', 'yuki' ),
                'center'     => __( 'Center', 'yuki' ),
                'flex-end'   => __( 'End', 'yuki' ),
            ] ),
                new Separator(),
                ( new Spacing( 'padding' ) )->setLabel( __( 'Padding', 'yuki' ) )->setOption( 'responsive', $this->isResponsive() )->setDefaultValue( $defaults['padding'] )
            ];
            return array_merge( $controls, $this->getAdvancedCssControls() );
        }
    
    }
}