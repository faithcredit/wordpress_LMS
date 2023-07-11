<?php
/**
 * Homepage magazine element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Collapse;
use LottaFramework\Customizer\Controls\ImageRadio;
use LottaFramework\Customizer\Controls\Select;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\Controls\Toggle;
use LottaFramework\Facades\Css;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Magazine_Element' ) ) {

	class Yuki_Magazine_Element extends Yuki_Posts_Base_Element {

		use Yuki_Password_Protected;

		/**
		 * {@inheritDoc}
		 */
		public function getControls() {

			return [
				( new Tabs() )
					->ghostStyle()
					->setActiveTab( 'content' )
					->addTab( 'content', __( 'Content', 'yuki' ), [
						( new Collapse() )
							->setLabel( __( 'Query', 'yuki' ) )
							->setControls( $this->getPostsQueryControls() )
						,
						( new Collapse() )
							->setLabel( __( 'Elements', 'yuki' ) )
							->setControls( array_merge( [
								$this->getPostElementsLayer( 'structure', 'el', [
									'exclude'   => [ 'divider', 'thumbnail' ],
									'value'     => [
										[ 'id' => 'categories', 'visible' => true ],
										[ 'id' => 'title', 'visible' => true ],
										[ 'id' => 'metas', 'visible' => true ],
									],
									'title'     => [
										'tag'     => 'h3',
										'initial' => 'rgba(255, 255, 255, 0.8)',
										'hover'   => 'rgb(255, 255, 255)',
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
										'color' => 'rgba(255, 255, 255, 0.8)'
									],
									'read-more' => [
										'text-initial'   => 'var(--yuki-base-color)',
										'text-hover'     => 'var(--yuki-base-color)',
										'button-initial' => 'var(--yuki-primary-color)',
										'button-hover'   => 'var(--yuki-primary-active)',
										'border-initial' => 'var(--yuki-primary-color)',
										'border-hover'   => 'var(--yuki-primary-active)',
									],
								] ),
								( new Toggle( 'thumb-motion' ) )
									->setLabel( __( 'Thumbnail Motion', 'yuki' ) )
									->openByDefault()
								,
								( new Separator() ),
							], $this->getCardContentControls( '', [
								'exclude'  => [ 'thumb-spacing' ],
								'vertical' => 'flex-end'
							] ) ) )
						,
						( new Collapse() )
							->setLabel( __( 'Layout', 'yuki' ) )
							->setControls( $this->getLayoutControls() )
					] )
					->addTab( 'style', __( 'Style', 'yuki' ), [
						( new Collapse() )
							->setLabel( __( 'Card', 'yuki' ) )
							->setControls( $this->getCardStyleControls( '', [
								'exclude' => [ 'background' ],
							] ) )
						,
						( new Collapse() )
							->setLabel( __( 'Overlay', 'yuki' ) )
							->setControls( $this->getCardOverlayStyleControls() )
						,
						( new Collapse() )
							->setLabel( __( 'Password Protected', 'yuki' ) )
							->setControls( $this->getPasswordProtectedStyleControls() )
						,
					] )
				,
			];
		}

		protected function getLayoutControls() {
			$controls = [
				( new ImageRadio( 'grid-layout' ) )
					->setLabel( __( 'Select Layout', 'yuki' ) )
					->setColumns( 3 )
					->setDefaultValue( 'style1' )
					->setChoices( Yuki_Magazine_Layout::all() )
				,
				( new Separator() ),
			];

			if ( yuki_fs()->is_not_paying() ) {
				$controls[] = yuki_upsell_info_control( __( 'Unlock all magazine grid layouts in our %sPro Version%s', 'yuki' ) );

				$controls[] = new Separator();
			}

			$controls = array_merge( $controls, [
				( new Select( 'image-size' ) )
					->setLabel( __( 'Image Size', 'yuki' ) )
					->setDefaultValue( 'full' )
					->setChoices( yuki_image_size_options( false ) )
				,
				( new Separator() ),
				( new Slider( 'container-height' ) )
					->setLabel( __( 'Container Height', 'yuki' ) )
					->enableResponsive()
					->setMin( 100 )
					->setMax( 1500 )
					->setDefaultValue( '520px' )
					->setDefaultUnit( 'px' )
				,
				( new Separator() ),
				( new Slider( 'h-gutter' ) )
					->setLabel( __( 'Horizontal Gutter', 'yuki' ) )
					->enableResponsive()
					->setDefaultUnit( 'px' )
					->setMin( 0 )
					->setMax( 50 )
					->setDefaultValue( '12px' )
				,
				( new Slider( 'v-gutter' ) )
					->setLabel( __( 'Vertical Gutter', 'yuki' ) )
					->enableResponsive()
					->setDefaultUnit( 'px' )
					->setMin( 0 )
					->setMax( 50 )
					->setDefaultValue( '12px' )
				,
			] );

			return $controls;
		}

		/**
		 * {@inheritDoc}
		 */
		public function enqueue_frontend_scripts( $id = null, $data = [] ) {
			if ( ! $id ) {
				return;
			}

			$settings = $data['settings'] ?? [];

			// Add magazine grid dynamic css
			add_filter( 'yuki_filter_dynamic_css', function ( $css ) use ( $id, $settings ) {
				$elements = [ 'title', 'metas', 'categories', 'tags', 'excerpt', 'read-more' ];

				// global
				$css[".$id"] = [
					'--yuki-magazine-container-height' => $this->get( 'container-height', $settings ),
					'--yuki-magazine-v-gutter'         => $this->get( 'v-gutter', $settings ),
					'--yuki-magazine-h-gutter'         => $this->get( 'h-gutter', $settings ),
				];

				// post item content alignment
				$css[".$id .yuki-post-item-content"] = [
					'text-align'             => $this->get( 'card_content_alignment', $settings ),
					'justify-content'        => $this->get( 'card_vertical_alignment', $settings ),
					'--card-content-spacing' => $this->get( 'card_content_spacing', $settings ),
				];

				// password protected
				$css[".$id .yuki-post-item-protected"] = $this->getPasswordProtectedCss( $this, $settings );

				// grid item
				$css[".$id .yuki-magazine-item"]   = Css::shadow( $this->get( 'card_shadow', $settings ) );
				$css[".$id .yuki-post-item-inner"] = array_merge(
					Css::border( $this->get( 'card_border', $settings ) ),
					Css::dimensions( $this->get( 'card_radius', $settings ), 'border-radius' )
				);

				// overlay
				$css[".$id .yuki-post-item-inner::after"] = array_merge(
					Css::background( $this->get( 'overlay_background', $settings ) ),
					Css::dimensions( $this->get( 'overlay_radius', $settings ), 'border-radius' )
				);

				// grid layout placer
				$style = $this->get( 'grid-layout', $settings );
				if ( is_customize_preview() ) {
					$count = Yuki_Magazine_Layout::all( $style )['count'] ?? 4;
					$css   = $this->magazine_items_style_padding( $id, $count, $css );
				}
				$css = call_user_func( [ Yuki_Magazine_Layout::class, $style ], $id, $css );

				return array_merge(
					$css,
					yuki_post_elements_css( ".$id .yuki-post-item-content", 'el',
						$elements, $this, $settings
					) );
			} );
		}

		protected function magazine_items_style_padding( $id, $count, $css = [] ) {
			for ( $i = 1; $i <= $count; $i ++ ) {
				$css[".$id .yuki-magazine-item:nth-child($i)"] = [
					'grid-column' => [ 'desktop' => 'auto', 'tablet' => 'auto', 'mobile' => 'auto' ],
					'grid-row'    => [ 'desktop' => 'auto', 'tablet' => 'auto', 'mobile' => 'auto' ],
				];
			}

			return $css;
		}

		/**
		 * {@inheritDoc}
		 */
		public function render( $attrs = [] ) {
			$id       = $attrs['id'];
			$settings = $attrs['settings'];

			$this->add_render_attribute( $id, 'class', Utils::clsx( [
				'yuki-page-builder-element',
				'yuki-magazine-grid',
				$id,
			] ) );

			if ( is_customize_preview() ) {
				$this->add_render_attribute( $id, 'data-shortcut', 'drop' );
				$this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
			}

			// Get Posts
			$style = $this->get( 'grid-layout', $settings );
			$count = Yuki_Magazine_Layout::all( $style )['count'] ?? 4;
			$posts = new \WP_Query( $this->getPostsQueryArgs( $count, $settings ) );

			?>
            <div <?php $this->print_attribute_string( $id ); ?>>
				<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
                    <article class="<?php Utils::the_clsx(
						get_post_class( 'yuki-magazine-item', get_the_ID() ),
						[ 'yuki-post-motion-item' => $this->checked( 'thumb-motion', $settings ) ]
					); ?>">

						<?php $this->renderPasswordProtectedInput(); ?>

                        <div class="yuki-post-item-inner">
                            <!-- Post thumbnail -->
                            <div class="yuki-post-item-thumb"
                                 style="background-image: url('<?php
							     echo esc_url( get_the_post_thumbnail_url( get_the_ID(), $this->get( 'image-size', $settings ) ) )
							     ?>')">
                            </div>

                            <!-- Post content -->
                            <div class="yuki-post-item-content-wrapper">
                                <div class="yuki-post-item-content yuki-scroll-reveal">
									<?php
									yuki_post_structure( ...$this->get_post_structure_args( $id, $settings ) );
									?>
                                </div>
                            </div>
                        </div>
                    </article>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
            </div>
			<?php
		}
	}

}
