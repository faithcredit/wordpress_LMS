<?php

/**
 * Text element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Editor ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\PageBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Text_Element' ) ) {
    class Yuki_Text_Element extends Element
    {
        /**
         * @param null $id
         * @param array $data
         */
        public function after_register( $id = null, $data = array() )
        {
        }
        
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [
                ( new Toggle( $this->getSlug( 'prose' ) ) )->setLabel( __( 'Prose Style', 'yuki' ) )->openByDefault(),
                new Separator(),
                ( new Editor( $this->getSlug( 'text' ) ) )->setLabel( __( 'Text Content', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' ) ),
                new Separator(),
                ( new Slider( $this->getSlug( 'max_width' ) ) )->setLabel( __( 'Max Width', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'max_width', '' ) )->setOption( 'units', Utils::units_config( [ [
                'unit' => 'px',
                'min'  => 0,
                'max'  => 1200,
            ], [
                'unit' => '%',
                'min'  => 0,
                'max'  => 100,
            ], [
                'unit' => 'vw',
                'min'  => 0,
                'max'  => 100,
            ] ] ) ),
                ( new ImageRadio( $this->getSlug( 'position' ) ) )->setLabel( __( 'Position', 'yuki' ) )->inlineChoices()->setDefaultValue( $this->getDefaultSetting( 'position', 'left' ) )->setChoices( [
                'left'   => [
                'src'   => yuki_image( 'justify-start-h' ),
                'title' => __( 'Left', 'yuki' ),
            ],
                'center' => [
                'src'   => yuki_image( 'justify-center-h' ),
                'title' => __( 'Center', 'yuki' ),
            ],
                'right'  => [
                'src'   => yuki_image( 'justify-end-h' ),
                'title' => __( 'Right', 'yuki' ),
            ],
            ] ),
                ( new ImageRadio( $this->getSlug( 'alignment' ) ) )->setLabel( __( 'Text Alignment', 'yuki' ) )->inlineChoices()->setDefaultValue( $this->getDefaultSetting( 'alignment', 'left' ) )->setChoices( [
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
            ] )
            ] )->addTab( 'style', __( 'Style', 'yuki' ), [
                ( new Typography( $this->getSlug( 'typography' ) ) )->setLabel( __( 'Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '0.875rem',
                'variant'    => '400',
                'lineHeight' => '1.5em',
            ] ),
                new Separator(),
                ( new ColorPicker( $this->getSlug( 'colors' ) ) )->setLabel( __( 'Colors', 'yuki' ) )->enableAlpha()->addColor( 'text', __( 'Text', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'initial', __( 'Link Initial', 'yuki' ), 'var(--yuki-primary-color)' )->addColor( 'hover', __( 'Link Hover', 'yuki' ), 'var(--yuki-primary-active)' ),
                new Separator(),
                ( new Spacing( $this->getSlug( 'spacing' ) ) )->setLabel( __( 'Spacing', 'yuki' ) )->setDefaultValue( [
                'top'    => '0px',
                'bottom' => '0px',
                'left'   => '24px',
                'right'  => '24px',
                'linked' => true,
            ] )
            ] ) ];
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts( $id = null, $data = array() )
        {
            if ( !$id ) {
                return;
            }
            $settings = $data['settings'] ?? [];
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) use( $id, $settings ) {
                $position = $this->get( $this->getSlug( 'position' ), $settings );
                $css[".yuki-text-element.{$id}"] = array_merge( [
                    'text-align' => $this->get( $this->getSlug( 'alignment' ), $settings ),
                ], Css::colors( $this->get( $this->getSlug( 'colors' ), $settings ), [
                    'text'    => 'color',
                    'initial' => '--yuki-link-initial-color',
                    'hover'   => '--yuki-link-hover-color',
                ] ) );
                $css[".yuki-text-element.{$id} .yuki-text-element-content"] = array_merge(
                    [
                    'max-width' => $this->get( $this->getSlug( 'max_width' ), $settings ),
                ],
                    ( $position === 'center' ? [
                    'margin' => '0 auto',
                ] : [] ),
                    ( $position === 'right' ? [
                    'margin-left' => 'auto',
                ] : [] ),
                    Css::typography( $this->get( $this->getSlug( 'typography' ), $settings ) ),
                    Css::dimensions( $this->get( $this->getSlug( 'spacing' ), $settings ), 'padding' )
                );
                return $css;
            } );
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $id = $attrs['id'];
            $settings = $attrs['settings'];
            $this->add_render_attribute( $id, 'class', Utils::clsx( [
                'yuki-page-builder-element',
                'yuki-text-element relative',
                'yuki-raw-html',
                'prose prose-yuki' => $this->checked( $this->getSlug( 'prose' ), $settings ),
                $id
            ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'arrow' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $text = $this->get( $this->getSlug( 'text' ), $settings );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>
                <div class="yuki-text-element-content">
					<?php 
            echo  do_shortcode( wp_kses_post( $text ) ) ;
            ?>
                </div>
            </div>
			<?php 
        }
    
    }
}