<?php

/**
 * Heading element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\ImageRadio ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\PageBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Heading_Element' ) ) {
    class Yuki_Heading_Element extends Element
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
            return [
                ( new Text( $this->getSlug( 'title' ) ) )->setLabel( __( 'Title', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'title', __( 'Awesome title', 'yuki' ) ) ),
                ( new Text( $this->getSlug( 'sub-title' ) ) )->setLabel( __( 'Sub Title', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'sub-title', 'Lorem ipsum is placeholder text commonly used' ) ),
                ( new Select( $this->getSlug( 'title-tag' ) ) )->setLabel( __( 'Widget Title Tag', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'title-tag', 'h3' ) )->setChoices( [
                'h1'   => 'H1',
                'h2'   => 'H2',
                'h3'   => 'H3',
                'h4'   => 'H4',
                'h5'   => 'H5',
                'h6'   => 'H6',
                'span' => 'Span',
            ] ),
                new Separator(),
                ( new ColorPicker( $this->getSlug( 'colors' ) ) )->setLabel( __( 'Colors', 'yuki' ) )->enableAlpha()->addColor( 'title', __( 'Title', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'sub-title', __( 'Sub Title', 'yuki' ), 'var(--yuki-accent-color)' ),
                ( new ImageRadio( $this->getSlug( 'alignment' ) ) )->setLabel( __( 'Alignment', 'yuki' ) )->inlineChoices()->setDefaultValue( 'center' )->setChoices( [
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
                ( new Typography( $this->getSlug( 'title-typography' ) ) )->setLabel( __( 'Title Typography', 'yuki' ) )->setDefaultValue( [
                'family'        => 'inherit',
                'fontSize'      => [
                'desktop' => '2.25rem',
                'tablet'  => '1.5rem',
                'mobile'  => '1.25rem',
            ],
                'variant'       => '600',
                'lineHeight'    => '2',
                'textTransform' => 'capitalize',
            ] ),
                ( new Typography( $this->getSlug( 'sub-title-typography' ) ) )->setLabel( __( 'Sub Title Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => [
                'desktop' => '1rem',
                'tablet'  => '1rem',
                'mobile'  => '0.875rem',
            ],
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ),
                new Separator(),
                ( new Spacing( $this->getSlug( 'spacing' ) ) )->setLabel( __( 'Spacing', 'yuki' ) )->setDefaultValue( [
                'top'    => '0px',
                'bottom' => '0px',
                'left'   => '24px',
                'right'  => '24px',
                'linked' => true,
            ] )
            ];
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
                $css[".yuki-heading-element.{$id}"] = array_merge( [
                    'text-align' => $this->get( $this->getSlug( 'alignment' ), $settings ),
                ], Css::dimensions( $this->get( $this->getSlug( 'spacing' ), $settings ), 'padding' ) );
                $css[".yuki-heading-element.{$id} .heading-title"] = array_merge( Css::colors( $this->get( $this->getSlug( 'colors' ), $settings ), [
                    'title' => 'color',
                ] ), Css::typography( $this->get( $this->getSlug( 'title-typography' ), $settings ) ) );
                $css[".yuki-heading-element.{$id} .heading-sub-title"] = array_merge( Css::colors( $this->get( $this->getSlug( 'colors' ), $settings ), [
                    'sub-title' => 'color',
                ] ), Css::typography( $this->get( $this->getSlug( 'sub-title-typography' ), $settings ) ) );
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
            $this->add_render_attribute( $id, 'class', Utils::clsx( [ 'yuki-page-builder-element', 'yuki-heading-element relative', $id ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'arrow' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $title = $this->get( $this->getSlug( 'title' ), $settings );
            $sub_title = $this->get( $this->getSlug( 'sub-title' ), $settings );
            $tag = $this->get( $this->getSlug( 'title-tag' ), $settings );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>
				<?php 
            echo  '<' . $tag . ' class="heading-title">' ;
            echo  esc_html( $title ) ;
            echo  '</' . $tag . '>' ;
            ?>
                <p class="heading-sub-title">
					<?php 
            echo  esc_html( $sub_title ) ;
            ?>
                </p>
            </div>
			<?php 
        }
    
    }
}