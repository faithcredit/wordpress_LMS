<?php

/**
 * Homepage posts slider element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Border ;
use  LottaFramework\Customizer\Controls\Collapse ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Condition ;
use  LottaFramework\Customizer\Controls\Icons ;
use  LottaFramework\Customizer\Controls\Number ;
use  LottaFramework\Customizer\Controls\Placeholder ;
use  LottaFramework\Customizer\Controls\Radio ;
use  LottaFramework\Customizer\Controls\Select ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Spacing ;
use  LottaFramework\Customizer\Controls\Tabs ;
use  LottaFramework\Customizer\Controls\Toggle ;
use  LottaFramework\Customizer\Sanitizes ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Icons\IconsManager ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Posts_Slider_Element' ) ) {
    class Yuki_Posts_Slider_Element extends Yuki_Posts_Base_Element
    {
        use  Yuki_Password_Protected ;
        /**
         * {@inheritDoc}
         */
        public function getControls()
        {
            return [ ( new Tabs() )->ghostStyle()->setActiveTab( 'content' )->addTab( 'content', __( 'Content', 'yuki' ), [ ( new Collapse() )->setLabel( __( 'Query', 'yuki' ) )->setControls( $this->getPostsQueryControls() ), ( new Collapse() )->setLabel( __( 'Elements', 'yuki' ) )->setControls( array_merge( [ $this->getPostElementsLayer( 'structure', 'el', [
                'exclude'   => [ 'divider', 'thumbnail' ],
                'value'     => [ [
                'id'      => 'categories',
                'visible' => true,
            ], [
                'id'      => 'title',
                'visible' => true,
            ], [
                'id'      => 'metas',
                'visible' => true,
            ] ],
                'title'     => [
                'tag'        => 'h3',
                'initial'    => 'rgba(255, 255, 255, 0.8)',
                'hover'      => 'rgb(255, 255, 255)',
                'typography' => [
                'family'     => 'inherit',
                'fontSize'   => [
                'desktop' => '2rem',
                'tablet'  => '1.875rem',
                'mobile'  => '1.25rem',
            ],
                'variant'    => '700',
                'lineHeight' => '1.5em',
            ],
            ],
                'metas'     => [
                'initial' => 'rgba(255, 255, 255, 0.8)',
                'hover'   => 'rgb(255, 255, 255)',
            ],
                'cats'      => [
                'style'            => 'badge',
                'text-initial'     => 'var(--yuki-primary-color)',
                'text-hover'       => 'var(--yuki-primary-active)',
                'typography'       => [
                'family'     => 'inherit',
                'fontSize'   => '0.75rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ],
                'badge-bg-initial' => 'var(--yuki-primary-color)',
                'badge-bg-hover'   => 'var(--yuki-primary-active)',
            ],
                'tags'      => [
                'style'            => 'badge',
                'text-initial'     => 'var(--yuki-primary-color)',
                'text-hover'       => 'var(--yuki-primary-active)',
                'typography'       => [
                'family'     => 'inherit',
                'fontSize'   => '0.75rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ],
                'badge-bg-initial' => 'var(--yuki-primary-color)',
                'badge-bg-hover'   => 'var(--yuki-primary-active)',
            ],
                'excerpt'   => [
                'color' => 'rgba(255, 255, 255, 0.8)',
            ],
                'read-more' => [
                'text-initial'   => 'var(--yuki-base-color)',
                'text-hover'     => 'var(--yuki-base-color)',
                'button-initial' => 'var(--yuki-primary-color)',
                'button-hover'   => 'var(--yuki-primary-active)',
                'border-initial' => 'var(--yuki-primary-color)',
                'border-hover'   => 'var(--yuki-primary-active)',
            ],
            ] ), ( new Toggle( 'thumb-motion' ) )->setLabel( __( 'Thumbnail Motion', 'yuki' ) )->openByDefault(), new Separator() ], $this->getCardContentControls( '', [
                'text'     => 'center',
                'vertical' => 'center',
            ] ) ) ), ( new Collapse() )->setLabel( __( 'Settings', 'yuki' ) )->setControls( $this->getSettingsControls() ) ] )->addTab( 'style', __( 'Style', 'yuki' ), [
                ( new Collapse() )->setLabel( __( 'Card', 'yuki' ) )->setControls( $this->getCardStyleControls( '', [
                'exclude' => [ 'background', 'shadow' ],
            ] ) ),
                ( new Collapse() )->setLabel( __( 'Overlay', 'yuki' ) )->setControls( $this->getCardOverlayStyleControls() ),
                ( new Collapse() )->setLabel( __( 'Password Protected', 'yuki' ) )->setControls( $this->getPasswordProtectedStyleControls() ),
                ( new Collapse() )->setLabel( __( 'Navigation', 'yuki' ) )->setControls( $this->getNavigationStyleControls() ),
                ( new Collapse() )->setLabel( __( 'Pagination', 'yuki' ) )->setControls( $this->getPaginationStyleControls() )
            ] ) ];
        }
        
        protected function getSettingsControls()
        {
            $controls = [ yuki_upsell_info_control( __( 'More options in %sPro Version%s', 'yuki' ) ) ];
            $maxItems = 4;
            $controls = array_merge( $controls, [
                new Separator(),
                ( new Icons( 'left-arrow' ) )->setLabel( __( 'Left Arrow', 'yuki' ) )->setDefaultValue( [
                'value'   => 'fas fa-chevron-left',
                'library' => 'fa-solid',
            ] ),
                ( new Icons( 'right-arrow' ) )->setLabel( __( 'Right Arrow', 'yuki' ) )->setDefaultValue( [
                'value'   => 'fas fa-chevron-right',
                'library' => 'fa-solid',
            ] ),
                new Separator(),
                ( new Select( 'image-size' ) )->setLabel( __( 'Image Size', 'yuki' ) )->setDefaultValue( 'full' )->setChoices( yuki_image_size_options( false ) ),
                new Separator(),
                ( new Slider( 'container-height' ) )->setLabel( __( 'Container Height', 'yuki' ) )->enableResponsive()->setMin( 100 )->setMax( 1500 )->setDefaultValue( '520px' )->setDefaultUnit( 'px' ),
                new Separator(),
                ( new Slider( 'slides-to-show' ) )->setLabel( __( 'Slides to Show (Columns)', 'yuki' ) )->enableResponsive()->setDefaultUnit( false )->setMin( 1 )->setMax( $maxItems )->setDefaultValue( 1 ),
                ( new Slider( 'slick-item-gutter' ) )->setLabel( __( 'Items Gutter', 'yuki' ) )->enableResponsive()->setDefaultUnit( 'px' )->setMin( 0 )->setMax( 100 )->setDefaultValue( '24px' ),
                ( new Slider( 'slides-to-scroll' ) )->setLabel( __( 'Slides to Scroll', 'yuki' ) )->setDefaultUnit( false )->setMin( 1 )->setMax( $maxItems )->setDefaultValue( 1 ),
                new Separator(),
                ( new Select( 'css-ease' ) )->setLabel( __( 'Css Ease', 'yuki' ) )->setChoices( $this->getCssEaseOptions() )->setDefaultValue( 'ease' ),
                new Separator(),
                ( new Radio( 'slide-effect' ) )->setLabel( __( 'Slick Effect', 'yuki' ) )->setDescription( __( 'Fade mode is valid only when Slides To Show is 1', 'yuki' ) )->setDefaultValue( 'slide' )->buttonsGroupView()->setChoices( [
                'slide' => __( 'Slide', 'yuki' ),
                'fade'  => __( 'Fade (Pro)', 'yuki' ),
            ] ),
                ( new Number( 'effect-duration' ) )->setLabel( __( 'Effect Duration', 'yuki' ) . '(ms)' )->setMin( 0 )->setMax( 5000 )->setDefaultValue( 700 ),
                new Separator(),
                ( new Toggle( 'infinite-loop' ) )->setLabel( __( 'Infinite Loop', 'yuki' ) )->openByDefault(),
                new Separator(),
                ( new Toggle( 'autoplay' ) )->setLabel( __( 'Autoplay', 'yuki' ) )->closeByDefault(),
                ( new Condition() )->setCondition( [
                'autoplay' => 'yes',
            ] )->setControls( [ ( new Toggle( 'pause-on-hover' ) )->setLabel( __( 'Pause on Hover', 'yuki' ) )->openByDefault(), ( new Number( 'autoplay-speed' ) )->setLabel( __( 'Autoplay Speed', 'yuki' ) . ' (ms)' )->setMin( 1000 )->setMax( 99999 )->setDefaultValue( 5000 ) ] ),
                new Separator(),
                ( new Toggle( 'navigation' ) )->setLabel( __( 'Navigation', 'yuki' ) )->openByDefault(),
                ( new Condition() )->setCondition( [
                'navigation' => 'yes',
            ] )->setControls( [ ( new Toggle( 'navigation-motion' ) )->setLabel( __( 'Display Navigation On Hover', 'yuki' ) )->openByDefault() ] ),
                new Separator(),
                ( new Toggle( 'pagination' ) )->setLabel( __( 'Pagination', 'yuki' ) )->openByDefault(),
                ( new Condition() )->setCondition( [
                'pagination' => 'yes',
            ] )->setControls( [ ( new Toggle( 'pagination-motion' ) )->setLabel( __( 'Display Pagination On Hover', 'yuki' ) )->closeByDefault() ] )
            ] );
            return $controls;
        }
        
        protected function getNavigationStyleControls()
        {
            $controls = [
                yuki_upsell_info_control( __( 'Fully customize slider navigation in our %sPro Version%s', 'yuki' ) ),
                ( new Placeholder( 'navigation-color' ) )->setDefaultValue( [
                'initial' => 'var(--yuki-base-color)',
                'hover'   => 'var(--yuki-base-color)',
            ] ),
                ( new Placeholder( 'navigation-background' ) )->setDefaultValue( [
                'initial' => 'var(--yuki-accent-active)',
                'hover'   => 'var(--yuki-primary-color)',
            ] ),
                ( new Placeholder( 'navigation-border' ) )->setDefaultBorder(
                4,
                'none',
                'var(--yuki-accent-active)',
                'var(--yuki-primary-color)'
            )
            ];
            $controls = array_merge( $controls, [
                new Separator(),
                ( new Spacing( 'navigation-radius' ) )->setLabel( __( 'Border Radius', 'yuki' ) )->enableResponsive()->setDefaultValue( [
                'linked' => true,
                'left'   => '9999px',
                'right'  => '9999px',
                'top'    => '9999px',
                'bottom' => '9999px',
            ] ),
                new Separator(),
                ( new Slider( 'navigation-size' ) )->setLabel( __( 'Icon Size', 'yuki' ) )->enableResponsive()->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( '16px' ),
                ( new Slider( 'navigation-box-size' ) )->setLabel( __( 'Box Size', 'yuki' ) )->enableResponsive()->setMin( 0 )->setMax( 200 )->setDefaultUnit( 'px' )->setDefaultValue( '42px' )
            ] );
            return $controls;
        }
        
        protected function getPaginationStyleControls()
        {
            $controls = [
                yuki_upsell_info_control( __( 'Fully customize slider pagination in our %sPro Version%s', 'yuki' ) ),
                new Separator(),
                ( new Placeholder( 'pagination-background' ) )->setDefaultValue( [
                'initial' => 'var(--yuki-base-300)',
                'active'  => 'var(--yuki-primary-color)',
            ] ),
                ( new Placeholder( 'pagination-border' ) )->setDefaultBorder(
                1,
                'none',
                'var(--yuki-accent-active)',
                'var(--yuki-primary-color)'
            ),
                ( new Placeholder( 'pagination-width' ) )->setLabel( __( 'Width', 'yuki' ) )->setDefaultValue( '8px' ),
                ( new Placeholder( 'pagination-height' ) )->setDefaultValue( '8px' )
            ];
            return array_merge( $controls, [ ( new Slider( 'pagination-gutter' ) )->setLabel( __( 'Gutter', 'yuki' ) )->enableResponsive()->setMin( 0 )->setMax( 100 )->setDefaultUnit( 'px' )->setDefaultValue( '6px' ), new Separator(), ( new Spacing( 'pagination-radius' ) )->setLabel( __( 'Border Radius', 'yuki' ) )->enableResponsive()->setDefaultValue( [
                'linked' => true,
                'left'   => '99px',
                'right'  => '99px',
                'top'    => '99px',
                'bottom' => '99px',
            ] ) ] );
        }
        
        /**
         * {@inheritDoc}
         */
        public function enqueue_frontend_scripts( $id = null, $data = array() )
        {
            if ( !$id ) {
                return;
            }
            wp_enqueue_script( 'slick' );
            $settings = $data['settings'] ?? [];
            // Add magazine grid dynamic css
            add_filter( 'yuki_filter_dynamic_css', function ( $css ) use( $id, $settings ) {
                $elements = [
                    'title',
                    'metas',
                    'categories',
                    'tags',
                    'excerpt',
                    'read-more'
                ];
                $css[".{$id}"] = array_merge( [
                    '--yuki-slick-items-gutter' => $this->get( 'slick-item-gutter', $settings ),
                ] );
                // post item
                $css[".{$id} .yuki-post-item"] = array_merge( [
                    'line-height' => 0,
                    'font-size'   => 0,
                    'height'      => $this->get( 'container-height', $settings ),
                ] );
                // post item content alignment
                $css[".{$id} .yuki-post-item-content"] = [
                    'justify-content'        => $this->get( 'card_vertical_alignment', $settings ),
                    'text-align'             => $this->get( 'card_content_alignment', $settings ),
                    '--card-content-spacing' => $this->get( 'card_content_spacing', $settings ),
                ];
                // password protected
                $css[".{$id} .yuki-post-item-protected"] = $this->getPasswordProtectedCss( $this, $settings );
                // grid item
                $css[".{$id} .yuki-post-item-inner"] = array_merge( Css::border( $this->get( 'card_border', $settings ) ), Css::dimensions( $this->get( 'card_radius', $settings ), 'border-radius' ) );
                // overlay
                $css[".{$id} .yuki-post-item-inner::after"] = array_merge( Css::background( $this->get( 'overlay_background', $settings ) ), Css::dimensions( $this->get( 'overlay_radius', $settings ), 'border-radius' ) );
                // slick navigation
                $css[".{$id} .yuki-slider-arrow"] = array_merge(
                    [
                    '--yuki-slick-nav-size'     => $this->get( 'navigation-size', $settings ),
                    '--yuki-slick-nav-box-size' => $this->get( 'navigation-box-size', $settings ),
                ],
                    Css::colors( $this->get( 'navigation-color', $settings ), [
                    'initial' => '--yuki-slick-nav-initial-color',
                    'hover'   => '--yuki-slick-nav-hover-color',
                ] ),
                    Css::colors( $this->get( 'navigation-background', $settings ), [
                    'initial' => '--yuki-slick-nav-initial-bg',
                    'hover'   => '--yuki-slick-nav-hover-bg',
                ] ),
                    Css::border( $this->get( 'navigation-border', $settings ) ),
                    Css::dimensions( $this->get( 'navigation-radius', $settings ), 'border-radius' )
                );
                // slick pagination
                $css[".{$id} .slick-dots"] = array_merge(
                    [
                    '--yuki-slick-pagination-dot-width'  => $this->get( 'pagination-width', $settings ),
                    '--yuki-slick-pagination-dot-height' => $this->get( 'pagination-height', $settings ),
                    '--yuki-slick-pagination-dot-gutter' => $this->get( 'pagination-gutter', $settings ),
                ],
                    Css::dimensions( $this->get( 'pagination-radius', $settings ), '--yuki-slick-pagination-dot-radius' ),
                    Css::colors( $this->get( 'pagination-background', $settings ), [
                    'initial' => '--yuki-slick-pagination-initial-color',
                    'active'  => '--yuki-slick-pagination-active-color',
                ] ),
                    Css::border( $this->get( 'pagination-border', $settings ), '--yuki-slick-pagination-border' )
                );
                return array_merge( $css, yuki_post_elements_css(
                    ".{$id} .yuki-post-item-content",
                    'el',
                    $elements,
                    $this,
                    $settings
                ) );
            } );
        }
        
        /**
         * @return array
         */
        protected function getCssEaseOptions()
        {
            return [
                'linear'                => __( 'Linear', 'yuki' ),
                'ease'                  => __( 'Ease', 'yuki' ),
                'ease-in-pro'           => __( 'Ease In', 'yuki' ) . ' (Pro)',
                'ease-out-pro'          => __( 'Ease Out', 'yuki' ) . ' (Pro)',
                'ease-in-out-pro'       => __( 'Ease In Out', 'yuki' ) . ' (Pro)',
                'ease-in-sine-pro'      => __( 'Ease In Sine', 'yuki' ) . ' (Pro)',
                'ease-out-sine-pro'     => __( 'Ease Out Sine', 'yuki' ) . ' (Pro)',
                'ease-in-out-sine-pro'  => __( 'Ease In Out Sine', 'yuki' ) . ' (Pro)',
                'ease-in-quad-pro'      => __( 'Ease In Quad', 'yuki' ) . ' (Pro)',
                'ease-out-quad-pro'     => __( 'Ease Out Quad', 'yuki' ) . ' (Pro)',
                'ease-in-out-Quad-pro'  => __( 'Ease In Out Quad', 'yuki' ) . ' (Pro)',
                'ease-in-cubic-pro'     => __( 'Ease In Cubic', 'yuki' ) . ' (Pro)',
                'ease-out-cubic-pro'    => __( 'Ease Out Cubic', 'yuki' ) . ' (Pro)',
                'ease-in-out-cubic-pro' => __( 'Ease In Out Cubic', 'yuki' ) . ' (Pro)',
                'ease-in-quart-pro'     => __( 'Ease In Quart', 'yuki' ) . ' (Pro)',
                'ease-out-quart-pro'    => __( 'Ease Out Quart', 'yuki' ) . ' (Pro)',
                'ease-in-out-quart-pro' => __( 'Ease In Out Quart', 'yuki' ) . ' (Pro)',
                'ease-in-quint-pro'     => __( 'Ease In Quint', 'yuki' ) . ' (Pro)',
                'ease-out-quint-pro'    => __( 'Ease Out Quint', 'yuki' ) . ' (Pro)',
                'ease-in-out-quint-pro' => __( 'Ease In Out Quint', 'yuki' ) . ' (Pro)',
                'ease-in-expo-pro'      => __( 'Ease In Expo', 'yuki' ) . ' (Pro)',
                'ease-out-expo-pro'     => __( 'Ease Out Expo', 'yuki' ) . ' (Pro)',
                'ease-in-out-expo-pro'  => __( 'Ease In Out Expo', 'yuki' ) . ' (Pro)',
                'ease-in-circ-pro'      => __( 'Ease In Circ', 'yuki' ) . ' (Pro)',
                'ease-out-circ-pro'     => __( 'Ease Out Circ', 'yuki' ) . ' (Pro)',
                'ease-in-out-circ-pro'  => __( 'Ease In Out Circ', 'yuki' ) . ' (Pro)',
                'ease-in-back-pro'      => __( 'Ease In Back', 'yuki' ) . ' (Pro)',
                'ease-out-back-pro'     => __( 'Ease Out Back', 'yuki' ) . ' (Pro)',
            ];
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
                'yuki-posts-slider',
                'yuki-slider-navigation-motion' => $this->checked( 'navigation-motion', $settings ),
                'yuki-slider-pagination-motion' => $this->checked( 'pagination-motion', $settings ),
                'yuki-post-motion-item' => $this->checked( 'thumb-motion', $settings ),
                $id
            ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'drop' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $slidesShow = Sanitizes::get_responsive_value( $this->get( 'slides-to-show', $settings ) );
            $slidesScroll = absint( $this->get( 'slides-to-scroll', $settings ) );
            $isFade = false;
            $slick_options = [
                'rtl'            => is_rtl(),
                'infinite'       => $this->checked( 'infinite-loop', $settings ),
                'fade'           => 1 == absint( $slidesShow['desktop'] ) && $isFade,
                'speed'          => absint( $this->get( 'effect-duration', $settings ) ),
                'arrows'         => $this->checked( 'navigation', $settings ),
                'dots'           => $this->checked( 'pagination', $settings ),
                'cssEase'        => $this->get( 'css-ease', $settings ),
                'autoplay'       => $this->checked( 'autoplay', $settings ),
                'autoplaySpeed'  => absint( $this->get( 'autoplay-speed', $settings ) ),
                'pauseOnHover'   => $this->checked( 'pause-on-hover', $settings ),
                'prevArrow'      => '#yuki-slider-prev-' . $id,
                'nextArrow'      => '#yuki-slider-next-' . $id,
                'slidesToShow'   => max( absint( $slidesShow['desktop'] ), 1 ),
                'slidesToScroll' => $slidesScroll,
                'responsive'     => [ [
                'breakpoint' => absint( Css::desktop() ),
                'settings'   => [
                'slidesToShow'   => max( absint( $slidesShow['tablet'] ), 1 ),
                'slidesToScroll' => ( $slidesScroll > absint( $slidesShow['tablet'] ) ? 1 : $slidesScroll ),
                'fade'           => 1 == absint( $slidesShow['tablet'] ) && $isFade,
            ],
            ], [
                'breakpoint' => absint( Css::tablet() ),
                'settings'   => [
                'slidesToShow'   => max( absint( $slidesShow['mobile'] ), 1 ),
                'slidesToScroll' => ( $slidesScroll > absint( $slidesShow['mobile'] ) ? 1 : $slidesScroll ),
                'fade'           => 1 == absint( $slidesShow['mobile'] ) && $isFade,
            ],
            ] ],
            ];
            $this->add_render_attribute( $id . '_slick', 'dir', ( is_rtl() ? 'rtl' : 'ltr' ) );
            $this->add_render_attribute( $id . '_slick', 'data-yuki-slick', true );
            $this->add_render_attribute( $id . '_slick', 'data-slick', wp_json_encode( $slick_options ) );
            $postsNumber = 4;
            $posts = new \WP_Query( $this->getPostsQueryArgs( $postsNumber, $settings ) );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>
                <div <?php 
            $this->print_attribute_string( $id . '_slick' );
            ?>>
					<?php 
            while ( $posts->have_posts() ) {
                $posts->the_post();
                ?>
                        <article class="<?php 
                Utils::the_clsx( get_post_class( 'yuki-post-item', get_the_ID() ) );
                ?>">

							<?php 
                $this->renderPasswordProtectedInput();
                ?>

                            <div class="yuki-post-item-inner">
                                <!-- Post thumbnail -->
                                <div class="yuki-post-item-thumb"
                                     style="background-image: url('<?php 
                echo  esc_url( get_the_post_thumbnail_url( get_the_ID(), $this->get( 'image-size', $settings ) ) ) ;
                ?>')">
                                </div>

                                <!-- Post content -->
                                <div class="yuki-post-item-content-wrapper">
                                    <div class="yuki-post-item-content">
										<?php 
                yuki_post_structure( ...$this->get_post_structure_args( $id, $settings ) );
                ?>
                                    </div>
                                </div>
                            </div>
                        </article>
					<?php 
            }
            ?>
					<?php 
            wp_reset_postdata();
            ?>
                </div>

                <div class="yuki-slider-controls">
                    <div class="yuki-slider-dots"></div>
                </div>

				<?php 
            
            if ( $this->checked( 'navigation', $settings ) ) {
                ?>
                    <div class="yuki-slider-arrow-container">
                        <div class="yuki-slider-prev-arrow yuki-slider-arrow"
                             id="<?php 
                echo  'yuki-slider-prev-' . esc_attr( $id ) ;
                ?>">
							<?php 
                IconsManager::print( $this->get( 'left-arrow', $settings ) );
                ?>
                        </div>
                        <div class="yuki-slider-next-arrow yuki-slider-arrow"
                             id="<?php 
                echo  'yuki-slider-next-' . esc_attr( $id ) ;
                ?>">
							<?php 
                IconsManager::print( $this->get( 'right-arrow', $settings ) );
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