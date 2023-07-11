<?php

/**
 * Homepage features element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Collapse ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Editor ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\ImageUploader ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Repeater ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\PageBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Icons\IconsManager ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Features_Element' ) ) {
    class Yuki_Features_Element extends Element
    {
        use  Yuki_Card_Element_Controls ;
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
                $this->getFeaturesControls(),
                ( new ColorPicker( $this->getSlug( 'card-color' ) ) )->setLabel( __( 'Colors', 'yuki' ) )->addColor( 'icon', __( 'Icon', 'yuki' ), 'var(--yuki-primary-active)' )->addColor( 'title', __( 'Text', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'description', __( 'Description', 'yuki' ), 'var(--yuki-accent-color)' ),
                ( new Collapse() )->setLabel( __( 'Card Style', 'yuki' ) )->setControls( $this->getCardStyleControls() ),
                ( new Collapse() )->setLabel( __( 'Title & Description', 'yuki' ) )->setControls( [
                ( new Typography( $this->getSlug( 'title-typography' ) ) )->setLabel( __( 'Title Typography', 'yuki' ) )->setDefaultValue( [
                'family'        => 'inherit',
                'fontSize'      => [
                'desktop' => '1.5rem',
                'tablet'  => '1.5rem',
                'mobile'  => '1.25rem',
            ],
                'variant'       => '600',
                'lineHeight'    => '2',
                'textTransform' => 'capitalize',
            ] ),
                ( new Typography( $this->getSlug( 'description-typography' ) ) )->setLabel( __( 'Description Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '0.875rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ),
                new Separator(),
                ( new Slider( $this->getSlug( 'title-spacing' ) ) )->setLabel( __( 'Spacing', 'yuki' ) )->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( '12px' )
            ] ),
                ( new Collapse() )->setLabel( __( 'Media', 'yuki' ) )->setControls( [ ( new Slider( $this->getSlug( 'media-size' ) ) )->setLabel( __( 'Size', 'yuki' ) )->setMin( 10 )->setMax( 200 )->setDefaultUnit( 'px' )->setDefaultValue( '28px' ), ( new Slider( $this->getSlug( 'media-spacing' ) ) )->setLabel( __( 'Spacing', 'yuki' ) )->setMin( 10 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( '12px' ) ] )
            ];
        }
        
        /**
         * @return Repeater
         */
        protected function getFeaturesControls()
        {
            $title = $this->getDefaultSetting( 'title', __( 'Awesome Feature', 'yuki' ) );
            $desc = $this->getDefaultSetting( 'description', 'Lorem ipsum dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore dolore magna.' );
            $repeater = ( new Repeater( $this->getSlug( 'features' ) ) )->setLabel( __( 'Features', 'yuki' ) )->setTitleField( "<%= settings.title %>" )->setDefaultValue( $this->getDefaultSetting( 'features', [ [
                'visible'  => true,
                'settings' => [
                'title'       => __( 'Online Business', 'yuki' ),
                'description' => $desc,
                'icon'        => [
                'value'   => 'fas fa-briefcase',
                'library' => 'fa-solid',
            ],
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'title'       => __( 'Blogging', 'yuki' ),
                'description' => $desc,
                'icon'        => [
                'value'   => 'fas fa-feather',
                'library' => 'fa-solid',
            ],
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'title'       => __( 'Powerful Design', 'yuki' ),
                'description' => $desc,
                'icon'        => [
                'value'   => 'fas fa-lightbulb',
                'library' => 'fa-solid',
            ],
            ],
            ] ] ) )->setControls( [
                ( new Radio( $this->getSlug( 'media-type' ) ) )->setLabel( __( 'Media Type', 'yuki' ) )->buttonsGroupView()->setDefaultValue( $this->getDefaultSetting( 'media-type', 'icon' ) )->setChoices( [
                'icon'  => __( 'Icon', 'yuki' ),
                'image' => __( 'Image', 'yuki' ),
            ] ),
                new Separator(),
                ( new Condition() )->setCondition( [
                $this->getSlug( 'media-type' ) => 'icon',
            ] )->setControls( [ ( new Icons( $this->getSlug( 'icon' ) ) )->setLabel( __( 'Icon', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'icon', [
                'value'   => 'fas fa-hashtag',
                'library' => 'fa-solid',
            ] ) ) ] )->setReverseControls( [ ( new ImageUploader( $this->getSlug( 'image' ) ) )->setLabel( __( 'Image', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'image', '' ) ) ] ),
                new Separator(),
                ( new Text( $this->getSlug( 'title' ) ) )->setLabel( __( 'Title', 'yuki' ) )->setDefaultValue( $title ),
                ( new Editor( $this->getSlug( 'description' ) ) )->setLabel( __( 'Description', 'yuki' ) )->setDefaultValue( $desc )
            ] );
            if ( yuki_fs()->is_not_paying() ) {
                $repeater->setLimit( 3, yuki_upsell_info( __( 'Add More than 3 features in our %sPro Version%s', 'yuki' ) ) );
            }
            return $repeater;
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
                $features = (int) count( $this->repeater( $this->getSlug( 'features' ), $settings ) );
                if ( $features <= 0 ) {
                    return $css;
                }
                $css[".yuki-features.{$id} .feature-item-wrap"] = [
                    'width' => [
                    'mobile'  => 'auto',
                    'tablet'  => 'auto',
                    'desktop' => sprintf( "%.2f", substr( sprintf( "%.3f", 100 / $features ), 0, -1 ) ) . '%',
                ],
                ];
                $css[".yuki-features.{$id} .feature-item"] = array_merge(
                    [
                    'text-align'                   => $this->get( $this->getSlug( 'content-align' ), $settings ),
                    '--yuki-feature-media-size'    => $this->get( $this->getSlug( 'media-size' ), $settings ),
                    '--yuki-feature-media-spacing' => $this->get( $this->getSlug( 'media-spacing' ), $settings ),
                ],
                    Css::dimensions( $this->get( $this->getSlug( 'card-padding' ), $settings ), 'padding' ),
                    Css::dimensions( $this->get( $this->getSlug( 'card-radius' ), $settings ), 'border-radius' ),
                    Css::background( $this->get( $this->getSlug( 'card-background' ), $settings ) ),
                    Css::shadow( $this->get( $this->getSlug( 'card-shadow' ), $settings ) ),
                    Css::border( $this->get( $this->getSlug( 'card-border' ), $settings ) ),
                    Css::colors( $this->get( $this->getSlug( 'card-color' ), $settings ), [
                    'icon'        => '--yuki-feature-icon-color',
                    'title'       => '--yuki-feature-title-color',
                    'description' => '--yuki-feature-description-color',
                ] )
                );
                $css[".yuki-features.{$id} .feature-title"] = array_merge( Css::typography( $this->get( $this->getSlug( 'title-typography' ), $settings ) ), [
                    'padding-bottom' => $this->get( $this->getSlug( 'title-spacing' ), $settings ),
                ] );
                $css[".yuki-features.{$id} .feature-description"] = array_merge( Css::typography( $this->get( $this->getSlug( 'title-description' ), $settings ) ) );
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
            $this->add_render_attribute( $id, 'class', Utils::clsx( [ 'yuki-page-builder-element', 'yuki-features lg:flex', $id ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'drop' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $features = $this->repeater( $this->getSlug( 'features' ), $settings );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>
				<?php 
            foreach ( $features as $index => $feature ) {
                ?>
                    <div class="feature-item-wrap p-half-gutter flex-grow">
                        <div class="feature-item h-full yuki-scroll-reveal">
							<?php 
                $media = $feature['media-type'] ?? 'icon';
                
                if ( $media === 'icon' ) {
                    echo  '<div class="feature-icon">' ;
                    IconsManager::print( $feature['icon'] ?? [] );
                    echo  '</div>' ;
                }
                
                
                if ( $media === 'image' ) {
                    $image_attr = yuki_image_attr( $feature['image'] );
                    
                    if ( !empty($image_attr) ) {
                        echo  '<div class="feature-image">' ;
                        echo  '<img ' . Utils::render_attribute_string( $image_attr ) . ' />' ;
                        echo  '</div>' ;
                    }
                
                }
                
                ?>
							<?php 
                
                if ( isset( $feature['title'] ) ) {
                    ?>
                                <h3 class="feature-title">
									<?php 
                    echo  esc_html( $feature['title'] ) ;
                    ?>
                                </h3>
							<?php 
                }
                
                ?>
							<?php 
                
                if ( isset( $feature['description'] ) ) {
                    ?>
                                <div class="feature-description yuki-raw-html">
									<?php 
                    echo  wp_kses_post( $feature['description'] ) ;
                    ?>
                                </div>
							<?php 
                }
                
                ?>
                        </div>
                    </div>
					<?php 
            }
            ?>
            </div>
			<?php 
        }
    
    }
}