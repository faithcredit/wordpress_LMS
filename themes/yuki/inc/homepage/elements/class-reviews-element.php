<?php

/**
 * Reviews element
 *
 * @package Yuki
 */
use  LottaFramework\Customizer\Controls\Collapse ;
use  LottaFramework\Customizer\Controls\ColorPicker ;
use  LottaFramework\Customizer\Controls\Editor ;
use  LottaFramework\Customizer\Controls\Repeater ;
use  LottaFramework\Customizer\Controls\Separator ;
use  LottaFramework\Customizer\Controls\Slider ;
use  LottaFramework\Customizer\Controls\Text ;
use  LottaFramework\Customizer\Controls\Typography ;
use  LottaFramework\Customizer\PageBuilder\Element ;
use  LottaFramework\Facades\Css ;
use  LottaFramework\Utils ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

if ( !class_exists( 'Yuki_Reviews_Element' ) ) {
    class Yuki_Reviews_Element extends Element
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
                $this->getReviewsControl(),
                new Separator(),
                ( new ColorPicker( $this->getSlug( 'card-color' ) ) )->setLabel( __( 'Colors', 'yuki' ) )->addColor( 'rating', __( 'Rating', 'yuki' ), '#ffc900' )->addColor( 'message', __( 'Message', 'yuki' ), 'var(--yuki-accent-color)' )->addColor( 'reviewer', __( 'Reviewer', 'yuki' ), 'var(--yuki-accent-active)' )->addColor( 'job-title', __( 'Job Title', 'yuki' ), 'var(--yuki-accent-color)' ),
                ( new Collapse() )->setLabel( __( 'Typography', 'yuki' ) )->setControls( [ ( new Typography( $this->getSlug( 'message-typography' ) ) )->setLabel( __( 'Message Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '1rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ), ( new Typography( $this->getSlug( 'reviewer-typography' ) ) )->setLabel( __( 'Reviewer Typography', 'yuki' ) )->setDefaultValue( [
                'family'        => 'inherit',
                'fontSize'      => '1rem',
                'variant'       => '600',
                'lineHeight'    => '1.5',
                'textTransform' => 'capitalize',
            ] ), ( new Typography( $this->getSlug( 'job-title-typography' ) ) )->setLabel( __( 'Job Title Typography', 'yuki' ) )->setDefaultValue( [
                'family'     => 'inherit',
                'fontSize'   => '0.875rem',
                'variant'    => '400',
                'lineHeight' => '1.5',
            ] ) ] ),
                ( new Collapse() )->setLabel( __( 'Card Style', 'yuki' ) )->setControls( $this->getCardStyleControls() )
            ];
        }
        
        protected function getReviewsControl()
        {
            $message = $this->getDefaultSetting( 'message', 'Lorem ipsum dolor sit amet consectetur elit sed do eiusmod tempor incididunt labore dolore magna.' );
            $repeater = ( new Repeater( $this->getSlug( 'reviews' ) ) )->setLabel( __( 'Reviews', 'yuki' ) )->setTitleField( '<%= settings.reviewer %>' )->setDefaultValue( $this->getDefaultSetting( 'reviews', [ [
                'visible'  => true,
                'settings' => [
                'message'   => $message,
                'rating'    => 5,
                'reviewer'  => 'Richard Murray',
                'job-title' => 'CEO',
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'message'   => $message,
                'rating'    => 5,
                'reviewer'  => 'Jason Knowles',
                'job-title' => 'Designer',
            ],
            ], [
                'visible'  => true,
                'settings' => [
                'message'   => $message,
                'rating'    => 5,
                'reviewer'  => 'Jesus Martin',
                'job-title' => 'Freelancer',
            ],
            ] ] ) )->setControls( [
                ( new Text( $this->getSlug( 'reviewer' ) ) )->setLabel( __( 'Reviewer', 'yuki' ) )->setDefaultValue( __( 'Someone', 'yuki' ) ),
                ( new Text( $this->getSlug( 'job-title' ) ) )->setLabel( __( 'Job Title', 'yuki' ) )->setDefaultValue( 'CEO' ),
                ( new Slider( $this->getSlug( 'rating' ) ) )->setLabel( __( 'Rating', 'yuki' ) )->setMin( 0 )->setMax( 5 )->setDefaultValue( 5 )->setDefaultUnit( false ),
                ( new Editor( $this->getSlug( 'message' ) ) )->setLabel( __( 'Message', 'yuki' ) )->setDefaultValue( $message )
            ] );
            if ( yuki_fs()->is_not_paying() ) {
                $repeater->setLimit( 3, yuki_upsell_info( __( 'Add More than 3 reviews in our %sPro Version%s', 'yuki' ) ) );
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
                $reviews = (int) count( $this->repeater( $this->getSlug( 'reviews' ), $settings ) );
                if ( $reviews <= 0 ) {
                    return $css;
                }
                $css[".yuki-reviews.{$id} .review-item-wrap"] = [
                    'width' => [
                    'mobile'  => 'auto',
                    'tablet'  => 'auto',
                    'desktop' => sprintf( "%.2f", substr( sprintf( "%.3f", 100 / $reviews ), 0, -1 ) ) . '%',
                ],
                ];
                $css[".yuki-reviews.{$id} .review-item"] = array_merge(
                    [
                    'text-align' => $this->get( $this->getSlug( 'content-align' ), $settings ),
                ],
                    Css::dimensions( $this->get( $this->getSlug( 'card-padding' ), $settings ), 'padding' ),
                    Css::dimensions( $this->get( $this->getSlug( 'card-radius' ), $settings ), 'border-radius' ),
                    Css::background( $this->get( $this->getSlug( 'card-background' ), $settings ) ),
                    Css::shadow( $this->get( $this->getSlug( 'card-shadow' ), $settings ) ),
                    Css::border( $this->get( $this->getSlug( 'card-border' ), $settings ) )
                );
                $css[".yuki-reviews.{$id} .review-rating"] = Css::colors( $this->get( $this->getSlug( 'card-color' ), $settings ), [
                    'rating' => 'color',
                ] );
                $css[".yuki-reviews.{$id} .review-message"] = array_merge( Css::colors( $this->get( $this->getSlug( 'card-color' ), $settings ), [
                    'message' => 'color',
                ] ), Css::typography( $this->get( $this->getSlug( 'message-typography' ), $settings ) ) );
                $css[".yuki-reviews.{$id} .review-reviewer"] = array_merge( Css::colors( $this->get( $this->getSlug( 'card-color' ), $settings ), [
                    'reviewer' => 'color',
                ] ), Css::typography( $this->get( $this->getSlug( 'reviewer-typography' ), $settings ) ) );
                $css[".yuki-reviews.{$id} .review-job-title"] = array_merge( Css::colors( $this->get( $this->getSlug( 'card-color' ), $settings ), [
                    'job-title' => 'color',
                ] ), Css::typography( $this->get( $this->getSlug( 'job-title-typography' ), $settings ) ) );
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
            $this->add_render_attribute( $id, 'class', Utils::clsx( [ 'yuki-page-builder-element', 'yuki-reviews lg:flex', $id ] ) );
            
            if ( is_customize_preview() ) {
                $this->add_render_attribute( $id, 'data-shortcut', 'drop' );
                $this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
            }
            
            $reviews = $this->repeater( $this->getSlug( 'reviews' ), $settings );
            ?>
            <div <?php 
            $this->print_attribute_string( $id );
            ?>>
				<?php 
            foreach ( $reviews as $index => $review ) {
                $message = $review['message'] ?? '';
                $reviewer = $review['reviewer'] ?? '';
                $job_title = $review['job-title'] ?? '';
                ?>
                    <div class="review-item-wrap p-half-gutter flex-grow">
                        <div class="review-item h-full yuki-scroll-reveal">

                            <div class="review-rating">
								<?php 
                $rating = min( absint( $review['rating'] ?? 0 ), 5 );
                for ( $i = 0 ;  $i < $rating ;  $i++ ) {
                    echo  '<i class="fa-solid fa-star"></i>' ;
                }
                for ( $i = 0 ;  $i < 5 - $rating ;  $i++ ) {
                    echo  '<i class="fa-regular fa-star"></i>' ;
                }
                ?>
                            </div>

                            <div class="review-message py-half-gutter yuki-raw-html">
								<?php 
                echo  wp_kses_post( $message ) ;
                ?>
                            </div>

                            <h4 class="review-reviewer">
								<?php 
                echo  esc_html( $reviewer ) ;
                ?>
                            </h4>
                            <span class="review-job-title">
	                            <?php 
                echo  esc_html( $job_title ) ;
                ?>
	                        </span>
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