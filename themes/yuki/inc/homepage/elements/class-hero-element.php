<?php

/**
 * Homepage hero element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Background ;
use  LottaFramework\Customizer\Controls\Collapse ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Editor ;
use  LottaFramework\Customizer\Controls\ImageUploader ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Section ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\PageBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Hero_Element' ) ) {
    class Yuki_Hero_Element extends Element
    {
        use  Yuki_Button_Controls ;
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
                ( new Section() )->setLabel( __( 'Hero Content', 'yuki' ) )->setControls( $this->getContentControls() ),
                ( new Section() )->setLabel( __( 'Hero Layout', 'yuki' ) )->setControls( $this->getLayoutControls() ),
                ( new Section() )->setLabel( __( 'Hero Shape Divider', 'yuki' ) )->setControls( $this->getShapeDividerControls() ),
                ( new Section() )->setLabel( __( 'Hero Style', 'yuki' ) )->setControls( $this->getStyleControls() ),
                ( new Section( $this->getSlug( 'overlay' ) ) )->setLabel( __( 'Hero Overlay', 'yuki' ) )->enableSwitch( false )->setControls( [ ( new Background( $this->getSlug( 'overlay_background' ) ) )->setLabel( __( 'Overlay Color', 'yuki' ) )->setDefaultValue( [
                'type'  => 'color',
                'color' => 'rgba(0,0,0,0.45)',
            ] ), ( new Slider( $this->getSlug( 'overlay_opacity' ) ) )->setLabel( __( 'Overlay Opacity', 'yuki' ) )->setMin( 0 )->setMax( 1 )->setDecimals( 2 )->setDefaultUnit( false )->setDefaultValue( 1 ) ] )
            ];
        }
        
        /**
         * @return array
         */
        protected function getContentControls()
        {
            return [ ( new Tabs() )->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [
                ( new Text( $this->getSlug( 'title' ) ) )->setLabel( __( 'Title', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'title', __( 'Build Your Awesome Business', 'yuki' ) ) ),
                ( new Editor( $this->getSlug( 'description' ) ) )->setLabel( __( 'Description', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' ) ),
                new Separator(),
                ( new Text( $this->getSlug( 'button_text' ) ) )->setLabel( __( 'Button Text', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'button-text', __( 'Get Started', 'yuki' ) ) ),
                ( new Text( $this->getSlug( 'button_url' ) ) )->setLabel( __( 'Button URL', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'button-url', '#' ) ),
                ( new Toggle( $this->getSlug( 'button_open_new_tab' ) ) )->setLabel( __( 'Open In New Tab', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'button-open-new-tab', 'no' ) ),
                ( new Toggle( $this->getSlug( 'button_no_follow' ) ) )->setLabel( __( 'No Follow', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'button-no-follow', 'no' ) ),
                new Separator(),
                ( new Radio( $this->getSlug( 'content_align' ) ) )->setLabel( __( 'Content Alignment', 'yuki' ) )->buttonsGroupView()->setDefaultValue( $this->getDefaultSetting( 'content-align', 'left' ) )->setChoices( [
                'left'   => __( 'Left', 'yuki' ),
                'center' => __( 'Center', 'yuki' ),
                'right'  => __( 'Right', 'yuki' ),
            ] ),
                ( new Spacing( $this->getSlug( 'content_spacing' ) ) )->enableResponsive()->setLabel( __( 'Content Spacing', 'yuki' ) )->setDefaultValue( [
                'top'    => '24px',
                'right'  => '24px',
                'bottom' => '24px',
                'left'   => '24px',
                'linked' => true,
            ] )
            ] )->addTab( 'media', __( 'Media', 'yuki' ), [ ( new ImageUploader( $this->getSlug( 'media' ) ) )->setLabel( __( 'Media', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'media', [
                'url' => yuki_image_url( 'hero-media.png' ),
            ] ) ), ( new Slider( $this->getSlug( 'media_height' ) ) )->setLabel( __( 'Media Height', 'yuki' ) )->enableResponsive()->setMin( 200 )->setMax( 800 )->setDefaultUnit( 'px' )->setDefaultValue( $this->getDefaultSetting( 'media-height', '360px' ) ), ( new Radio( $this->getSlug( 'media_align' ) ) )->setLabel( __( 'Media Alignment', 'yuki' ) )->buttonsGroupView()->setDefaultValue( $this->getDefaultSetting( 'media-align', 'center' ) )->setChoices( [
                'left'   => __( 'Left', 'yuki' ),
                'center' => __( 'Center', 'yuki' ),
                'right'  => __( 'Right', 'yuki' ),
            ] ) ] ) ];
        }
        
        /**
         * @return array
         */
        protected function getLayoutControls()
        {
            return [ ( new Slider( $this->getSlug( 'min_height' ) ) )->setLabel( __( 'Min Height', 'yuki' ) )->enableResponsive()->setUnits( [ [
                'unit' => 'px',
                'min'  => 100,
                'max'  => 800,
            ], [
                'unit' => 'vh',
                'min'  => 10,
                'max'  => 100,
            ] ] )->setDefaultValue( $this->getDefaultSetting( 'min-height', '640px' ) ), ( new Select( $this->getSlug( 'layout' ) ) )->setLabel( __( 'Layout', 'yuki' ) )->setDefaultValue( $this->getDefaultSetting( 'layout', 'content-media' ) )->setChoices( [
                'content-media' => __( 'Content - Media', 'yuki' ),
                'media-content' => __( 'Media - Content', 'yuki' ),
            ] ) ];
        }
        
        /**
         * @return array
         */
        protected function getShapeDividerControls()
        {
            return [
                ( new Select( $this->getSlug( 'shape_divider' ) ) )->setLabel( __( 'Shape Divider', 'yuki' ) )->setDefaultValue( 'tilt' )->setChoices( Utils::array_pluck( 'title', yuki_get_shapes() ) ),
                ( new Toggle( $this->getSlug( 'shape_flip' ) ) )->setLabel( __( 'Flip', 'yuki' ) )->openByDefault(),
                ( new Toggle( $this->getSlug( 'shape_invert' ) ) )->setLabel( __( 'Invert', 'yuki' ) )->closeByDefault(),
                new Separator(),
                ( new Slider( $this->getSlug( 'shape_width' ) ) )->setLabel( __( 'Shape Divider Width', 'yuki' ) )->setMin( 0 )->setMax( 100 )->setDefaultUnit( '%' )->setDefaultValue( '100%' ),
                ( new Slider( $this->getSlug( 'shape_height' ) ) )->setLabel( __( 'Shape Divider Height', 'yuki' ) )->setMin( 0 )->setMax( 200 )->setDefaultUnit( 'px' )->setDefaultValue( $this->getDefaultSetting( 'shape-height', '50px' ) ),
                new Separator(),
                ( new ColorPicker( $this->getSlug( 'shape_color' ) ) )->setLabel( __( 'Shape Color', 'yuki' ) )->enableAlpha()->addColor( 'initial', __( 'Initial', 'yuki' ), $this->getDefaultSetting( 'title-initial', 'var(--yuki-base-100)' ) )
            ];
        }
        
        /**
         * @return array
         */
        protected function getStyleControls()
        {
            return [ ( new Background( $this->getSlug( 'background' ) ) )->setLabel( __( 'Background', 'yuki' ) )->enableResponsive()->setDefaultValue( $this->getDefaultSetting( 'background', [
                'type'  => 'color',
                'color' => 'var(--yuki-accent-active)',
            ] ) ), ( new Collapse() )->setLabel( __( 'Title & Description Style', 'yuki' ) )->setControls( [
                ( new Typography( $this->getSlug( 'title_typography' ) ) )->setLabel( __( 'Title Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '2.75rem',
                'variant'    => '700',
                'lineHeight' => '1.25em',
            ] ),
                ( new ColorPicker( $this->getSlug( 'title_color' ) ) )->setLabel( __( 'Title Color', 'yuki' ) )->enableAlpha()->addColor( 'initial', __( 'Initial', 'yuki' ), $this->getDefaultSetting( 'title-initial', 'var(--yuki-base-color)' ) ),
                new Separator(),
                ( new Typography( $this->getSlug( 'description_typography' ) ) )->setLabel( __( 'Description Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '1rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ),
                ( new ColorPicker( $this->getSlug( 'description_color' ) ) )->setLabel( __( 'Description Color', 'yuki' ) )->enableAlpha()->addColor( 'initial', __( 'Initial', 'yuki' ), $this->getDefaultSetting( 'description-initial', 'var(--yuki-base-100)' ) )
            ] ), ( new Collapse() )->setLabel( __( 'Button Style', 'yuki' ) )->setControls( $this->getButtonStyleControls( $this->getSlug( 'button_' ), [
                'min-height'     => '48px',
                'button-initial' => 'var(--yuki-transparent)',
                'button-hover'   => 'var(--yuki-primary-active)',
                'border-initial' => 'var(--yuki-base-color)',
                'border-hover'   => 'var(--yuki-primary-active)',
                'border-radius'  => [
                'left'   => '4px',
                'right'  => '4px',
                'top'    => '4px',
                'bottom' => '4px',
            ],
                'padding'        => [
                'top'    => '0.25em',
                'right'  => '1.5em',
                'bottom' => '0.25em',
                'left'   => '1.5em',
            ],
            ] ) ) ];
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
                $css[".yuki-hero.{$id}"] = array_merge(
                    [
                    '--media-max-height'        => $this->get( $this->getSlug( 'media_height' ), $settings ),
                    '--yuki-hero-media-align'   => $this->get( $this->getSlug( 'media_align' ), $settings ),
                    '--yuki-hero-content-align' => $this->get( $this->getSlug( 'content_align' ), $settings ),
                    'min-height'                => $this->get( $this->getSlug( 'min_height' ), $settings ),
                ],
                    Css::dimensions( $this->get( $this->getSlug( 'content_spacing' ), $settings ), '--yuki-hero-content-padding' ),
                    Css::background( $this->get( $this->getSlug( 'background' ), $settings ) ),
                    Css::colors( $this->get( $this->getSlug( 'shape_color' ), $settings ), [
                    'initial' => '--yuki-hero-shape-fill',
                ] )
                );
                // overlay
                $css[".yuki-hero.{$id} .hero-overlay"] = array_merge( Css::background( $this->get( $this->getSlug( 'overlay_background' ), $settings ) ), [
                    'opacity' => $this->get( $this->getSlug( 'overlay_opacity' ), $settings ),
                ] );
                // shape divider
                $shape_data = yuki_get_shapes( $this->get( $this->getSlug( 'shape_divider' ), $settings ) );
                
                if ( $shape_data ) {
                    $flip = $this->checked( $this->getSlug( 'shape_flip' ), $settings ) && in_array( 'shape_flip', $shape_data['options'] );
                    $css[".yuki-hero.{$id} .hero-shape-divider svg"] = [
                        'width'     => 'calc(' . $this->get( $this->getSlug( 'shape_width' ), $settings ) . ' + 1.3px)',
                        'height'    => $this->get( $this->getSlug( 'shape_height' ), $settings ),
                        'transform' => ( $flip ? 'translateX(-50%) rotateY(180deg)' : 'translateX(-50%)' ),
                    ];
                }
                
                // title
                $css[".yuki-hero.{$id} .hero-title"] = array_merge( Css::typography( $this->get( $this->getSlug( 'title_typography' ), $settings ) ), Css::colors( $this->get( $this->getSlug( 'title_color' ), $settings ), [
                    'initial' => 'color',
                ] ) );
                // description
                $css[".yuki-hero.{$id} .hero-description"] = array_merge( Css::typography( $this->get( $this->getSlug( 'description_typography' ), $settings ) ), Css::colors( $this->get( $this->getSlug( 'description_color' ), $settings ), [
                    'initial' => 'color',
                ] ) );
                // button
                $css[".yuki-hero.{$id} .hero-button"] = array_merge(
                    [
                    '--yuki-button-height' => $this->get( $this->getSlug( 'button_min_height' ), $settings ),
                ],
                    Css::typography( $this->get( $this->getSlug( 'button_typography' ), $settings ) ),
                    Css::dimensions( $this->get( $this->getSlug( 'button_padding' ), $settings ), '--yuki-button-padding' ),
                    Css::dimensions( $this->get( $this->getSlug( 'button_radius' ), $settings ), '--yuki-button-radius' ),
                    Css::colors( $this->get( $this->getSlug( 'button_text_color' ), $settings ), [
                    'initial' => '--yuki-button-text-initial-color',
                    'hover'   => '--yuki-button-text-hover-color',
                ] ),
                    Css::colors( $this->get( $this->getSlug( 'button_button_color' ), $settings ), [
                    'initial' => '--yuki-button-initial-color',
                    'hover'   => '--yuki-button-hover-color',
                ] ),
                    Css::border( $this->get( $this->getSlug( 'button_border' ), $settings ), '--yuki-button-border' )
                );
                return $css;
            } );
        }
        
        protected function get_shape_path( $shape, $is_negative = false )
        {
            $shape_data = yuki_get_shapes( $shape );
            if ( !$shape_data ) {
                return '';
            }
            
            if ( isset( $shape_data['path'] ) ) {
                $path = $shape_data['path'];
                return ( $is_negative ? str_replace( '.svg', '-negative.svg', $path ) : $path );
            }
            
            $folder = 'images/shapes/';
            if ( isset( $shape_data['folder'] ) ) {
                $folder = trailingslashit( $shape_data['folder'] );
            }
            $file_name = $shape;
            if ( $is_negative ) {
                $file_name .= '-negative';
            }
            return trailingslashit( get_template_directory() ) . 'dist/' . ($folder . $file_name . '.svg');
        }
        
        protected function shape_divider( $settings )
        {
            $shape = $this->get( $this->getSlug( 'shape_divider' ), $settings );
            $shape_data = yuki_get_shapes( $shape );
            if ( !$shape_data ) {
                return;
            }
            if ( yuki_fs()->is_not_paying() && isset( $shape_data['folder'] ) ) {
                return;
            }
            $negative = $this->checked( $this->getSlug( 'shape_invert' ), $settings ) && in_array( 'shape_invert', $shape_data['options'] );
            $shape_path = $this->get_shape_path( $shape, $negative );
            if ( !is_file( $shape_path ) || !is_readable( $shape_path ) ) {
                return;
            }
            ?>
            <div class="hero-shape-divider" data-negative="<?php 
            // PHPCS - the variable $negative is getting a setting value with a strict structure.
            echo  var_export( $negative ) ;
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>">
				<?php 
            // PHPCS - The file content is being read from a strict file path structure.
            echo  file_get_contents( $shape_path ) ;
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            </div>
			<?php 
        }
        
        /**
         * {@inheritDoc}
         */
        public function render( $attrs = array() )
        {
            $id = $attrs['id'];
            $settings = $attrs['settings'];
            $this->add_render_attribute( $id, 'class', Utils::clsx( [ 'yuki-page-builder-element', 'yuki-hero relative', $id ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'drop' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $title = $this->get( $this->getSlug( 'title' ), $settings );
            $desc = $this->get( $this->getSlug( 'description' ), $settings );
            $button_text = $this->get( $this->getSlug( 'button_text' ), $settings );
            
            if ( $button_text != '' ) {
                $this->add_render_attribute( $this->getSlug( 'button' ), 'href', esc_url( $this->get( 'button_url', $settings ) ) );
                if ( $this->checked( $this->getSlug( 'button_open_new_tab' ), $settings ) ) {
                    $this->add_render_attribute( $this->getSlug( 'button' ), 'target', '_blank' );
                }
                if ( $this->checked( $this->getSlug( 'button_no_follow' ), $settings ) ) {
                    $this->add_render_attribute( $this->getSlug( 'button' ), 'rel', 'nofollow' );
                }
            }
            
            $media = $this->get( $this->getSlug( 'media' ), $settings );
            $media_attr = yuki_image_attr( $media );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>

				<?php 
            if ( $this->checked( $this->getSlug( 'overlay' ), $settings ) ) {
                ?>
                    <div class="hero-overlay absolute w-full h-full left-0 top-0"></div>
				<?php 
            }
            ?>

                <div class="<?php 
            Utils::the_clsx( [ 'hero-container container mx-auto px-gutter relative z-[1]', 'flex-row-reverse' => $this->get( $this->getSlug( 'layout' ), $settings ) === 'media-content' ] );
            ?>">
                    <div class="hero-content yuki-scroll-reveal">
						<?php 
            
            if ( $title != '' ) {
                ?>
                            <h1 class="hero-title mb-gutter"><?php 
                echo  esc_html( $title ) ;
                ?></h1>
						<?php 
            }
            
            ?>
						<?php 
            
            if ( $desc != '' ) {
                ?>
                            <div class="hero-description mb-gutter yuki-raw-html"><?php 
                echo  do_shortcode( wp_kses_post( $desc ) ) ;
                ?></div>
						<?php 
            }
            
            ?>
						<?php 
            
            if ( $button_text != '' ) {
                ?>
                            <div class="mt-double-gutter">
                                <a class="hero-button yuki-button" <?php 
                $this->print_attribute_string( $this->getSlug( 'button' ) );
                ?>>
									<?php 
                echo  esc_html( $button_text ) ;
                ?>
                                </a>
                            </div>
						<?php 
            }
            
            ?>
                    </div>

					<?php 
            
            if ( !empty($media_attr) ) {
                ?>
                        <div class="hero-media yuki-scroll-reveal p-gutter">
                            <img <?php 
                Utils::print_attribute_string( $media_attr );
                ?> />
                        </div>
					<?php 
            }
            
            ?>
                </div>

				<?php 
            $this->shape_divider( $settings );
            ?>
            </div>
			<?php 
        }
    
    }
}