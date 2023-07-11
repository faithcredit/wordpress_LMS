<?php

/**
 * Widgets trait
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\BoxShadow ;
use  LottaFramework\Customizer\Controls\CallToAction ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Facades\AsyncCss ;
use  LottaFramework\Facades\Css ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !trait_exists( 'Yuki_Widgets_Controls' ) ) {
    /**
     * Widgets controls
     */
    trait Yuki_Widgets_Controls
    {
        /**
         * Get Widgets Control
         */
        public function getWidgetsControls( $defaults = array() )
        {
            $defaults = wp_parse_args( $defaults, apply_filters( 'yuki_widgets_controls_defaults', [
                'selective-refresh'     => '',
                'async-selector'        => '',
                'customize-location'    => 'sidebar-widgets-' . $this->getSlug(),
                'widgets-style'         => 'style-1',
                'widgets-spacing'       => '24px',
                'title-tag'             => 'h3',
                'title-style'           => 'style-1',
                'content-align'         => 'left',
                'title-typography'      => [
                'family'        => 'inherit',
                'fontSize'      => '0.875rem',
                'variant'       => '600',
                'lineHeight'    => '1.5em',
                'textTransform' => 'uppercase',
            ],
                'title-color'           => 'var(--yuki-accent-active)',
                'title-indicator'       => 'var(--yuki-primary-active)',
                'content-typography'    => [
                'family'     => 'inherit',
                'fontSize'   => '0.875rem',
                'variant'    => '400',
                'lineHeight' => '1.5em',
            ],
                'text-color'            => 'var(--yuki-accent-color)',
                'link-initial'          => 'var(--yuki-accent-color)',
                'link-hover'            => 'var(--yuki-primary-active)',
                'widgets-background'    => 'var(--yuki-base-color)',
                'widgets-border'        => [ 1, 'solid', 'var(--yuki-base-200)' ],
                'widgets-shadow'        => [
                'rgba(44, 62, 80, 0.15)',
                '0px',
                '15px',
                '18px',
                '-15px'
            ],
                'widgets-shadow-enable' => true,
                'widgets-padding'       => [
                'top'    => '12px',
                'right'  => '12px',
                'bottom' => '12px',
                'left'   => '12px',
                'linked' => true,
            ],
                'widgets-radius'        => [
                'top'    => '4px',
                'bottom' => '4px',
                'left'   => '4px',
                'right'  => '4px',
                'linked' => true,
            ],
            ] ) );
            return [ ( new CallToAction() )->setLabel( __( 'Edit Widgets', 'yuki' ) )->displayAsButton()->expandCustomize( $defaults['customize-location'] ), ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), $this->getContentControls( $defaults ) )->addTab( 'style', __( 'Style', 'yuki' ), $this->getStyleControls( $defaults ) ) ];
        }
        
        protected function getContentControls( $defaults )
        {
            $selective = ( $defaults['selective-refresh'] ?: '' );
            $controls = [
                ( new ImageRadio( $this->getSlug( 'widgets-style' ) ) )->setLabel( __( 'Widgets Style', 'yuki' ) )->setDefaultValue( $defaults['widgets-style'] )->setColumns( 2 )->setChoices( [
                'style-1' => [
                'title' => __( 'Style 1', 'yuki' ),
                'src'   => yuki_image_url( 'sidebar-style-1.png' ),
            ],
                'style-2' => [
                'title' => __( 'Style 2', 'yuki' ),
                'src'   => yuki_image_url( 'sidebar-style-2.png' ),
            ],
            ] ),
                new Separator(),
                ( new Select( $this->getSlug( 'title-tag' ) ) )->setLabel( __( 'Widget Title Tag', 'yuki' ) )->setDefaultValue( $defaults['title-tag'] )->setChoices( [
                'h1'   => 'H1',
                'h2'   => 'H2',
                'h3'   => 'H3',
                'h4'   => 'H4',
                'h5'   => 'H5',
                'h6'   => 'H6',
                'span' => 'Span',
            ] ),
                ( new Select( $this->getSlug( 'title-style' ) ) )->setLabel( __( 'Style', 'yuki' ) )->setDefaultValue( $defaults['title-style'] )->setChoices( [
                'plain'   => __( 'Plain', 'yuki' ),
                'style-1' => __( 'Style 1', 'yuki' ),
                'style-2' => __( 'Style 2', 'yuki' ),
            ] )
            ];
            if ( yuki_fs()->is_not_paying() ) {
                $controls = array_merge( $controls, [ ( new Placeholder( $this->getSlug( 'widgets-spacing' ) ) )->setDefaultValue( $defaults['widgets-spacing'] ), ( new Placeholder( $this->getSlug( 'content-alignment' ) ) )->setDefaultValue( $defaults['content-align'] ), yuki_upsell_info_control( __( 'More widget options in our %sPro Version%s', 'yuki' ) ) ] );
            }
            return $controls;
        }
        
        protected function getStyleControls( $defaults )
        {
            $selective = ( $defaults['selective-refresh'] ? 'yuki-global-selective-css' : '' );
            $selector = ( $defaults['async-selector'] ?: '' );
            $controls = [
                ( new Typography( $this->getSlug( 'title-typography' ) ) )->setLabel( __( 'Widgets Title Typography', 'yuki' ) )->asyncCss( "{$selector} .widget-title", AsyncCss::typography() )->setDefaultValue( $defaults['title-typography'] ),
                ( new ColorPicker( $this->getSlug( 'title-color' ) ) )->setLabel( __( 'Widgets Title Color', 'yuki' ) )->asyncColors( "{$selector} .widget-title", array(
                'initial'   => 'color',
                'indicator' => '--yuki-heading-indicator',
            ) )->addColor( 'initial', __( 'Initial', 'yuki' ), $defaults['title-color'] )->addColor( 'indicator', __( 'Indicator', 'yuki' ), $defaults['title-indicator'] ),
                new Separator(),
                ( new Typography( $this->getSlug( 'content-typography' ) ) )->setLabel( __( 'Widgets Typography', 'yuki' ) )->asyncCss( $selector, AsyncCss::typography() )->setDefaultValue( $defaults['content-typography'] ),
                ( new ColorPicker( $this->getSlug( 'content-color' ) ) )->setLabel( __( 'Widgets Color', 'yuki' ) )->asyncColors( $selector, array(
                'text'    => '--yuki-widgets-text-color',
                'initial' => '--yuki-widgets-link-initial',
                'hover'   => '--yuki-widgets-link-hover',
            ) )->addColor( 'text', __( 'Text Initial', 'yuki' ), $defaults['text-color'] )->addColor( 'initial', __( 'Link Initial', 'yuki' ), $defaults['link-initial'] )->addColor( 'hover', __( 'Link Hover', 'yuki' ), $defaults['link-hover'] )
            ];
            if ( yuki_fs()->is_not_paying() ) {
                $controls = array_merge( $controls, [
                    ( new Placeholder( $this->getSlug( 'widgets-background' ) ) )->setDefaultValue( [
                    'type'  => 'color',
                    'color' => $defaults['widgets-background'],
                ] ),
                    ( new Placeholder( $this->getSlug( 'widgets-border' ) ) )->setDefaultBorder( ...$defaults['widgets-border'] ),
                    ( new Placeholder( $this->getSlug( 'widgets-shadow' ) ) )->setDefaultShadow( ...array_merge( $defaults['widgets-shadow'], [ $defaults['widgets-shadow-enable'] ] ) ),
                    ( new Placeholder( $this->getSlug( 'widgets-padding' ) ) )->setDefaultValue( $defaults['widgets-padding'] ),
                    ( new Placeholder( $this->getSlug( 'widgets-radius' ) ) )->setDefaultValue( $defaults['widgets-radius'] ),
                    yuki_upsell_info_control( __( 'Fully customize your widgets in our %sPro Version%s', 'yuki' ) )
                ] );
            }
            return $controls;
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts( $id = null, $data = array() )
        {
            $id = $id ?? $this->slug;
            $options = $this->getOptions();
            $settings = $data['settings'] ?? [];
            // Add widgets area dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) use( $id, $options, $settings ) {
                $widgets_style = $options->get( $this->getSlug( 'widgets-style' ), $settings );
                $widgets_css = array_merge(
                    Css::background( $options->get( $this->getSlug( 'widgets-background' ) ) ),
                    Css::border( $options->get( $this->getSlug( 'widgets-border' ) ) ),
                    Css::shadow( $options->get( $this->getSlug( 'widgets-shadow' ) ) ),
                    Css::dimensions( $options->get( $this->getSlug( 'widgets-padding' ) ), 'padding' ),
                    Css::dimensions( $options->get( $this->getSlug( 'widgets-radius' ) ), 'border-radius' )
                );
                if ( $widgets_style === 'style-1' ) {
                    $css[".{$id} .yuki-widget"] = $widgets_css;
                }
                $css[".{$id}"] = array_merge(
                    ( $widgets_style === 'style-2' ? $widgets_css : [] ),
                    Css::typography( $options->get( $this->getSlug( 'content-typography' ), $settings ) ),
                    Css::colors( $options->get( $this->getSlug( 'content-color' ), $settings ), [
                    'text'    => '--yuki-widgets-text-color',
                    'initial' => '--yuki-widgets-link-initial',
                    'hover'   => '--yuki-widgets-link-hover',
                ] ),
                    [
                    'width'                  => '100%',
                    'text-align'             => $options->get( $this->getSlug( 'content-alignment' ), $settings ),
                    '--yuki-widgets-spacing' => $options->get( $this->getSlug( 'widgets-spacing' ), $settings ),
                ]
                );
                $css[".{$id} .widget-title"] = array_merge( Css::typography( $options->get( $this->getSlug( 'title-typography' ), $settings ) ), Css::colors( $options->get( $this->getSlug( 'title-color' ), $settings ), [
                    'initial'   => 'color',
                    'indicator' => '--yuki-heading-indicator',
                ] ) );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $this->beforeRender( $attrs );
            ?>
            <div <?php 
            $this->print_attribute_string( $this->getAttrId( $attrs ) );
            ?>>
				<?php 
            dynamic_sidebar( $this->getSidebarId( $attrs ) );
            ?>
            </div>
			<?php 
        }
    
    }
}