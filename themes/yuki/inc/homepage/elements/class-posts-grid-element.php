<?php
/**
 * Homepage posts grid element
 *
 * @package Yuki
 */

use LottaFramework\Customizer\Controls\Collapse;
use LottaFramework\Customizer\Controls\Number;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Facades\Css;
use LottaFramework\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Yuki_Posts_Grid_Element' ) ) {

	class Yuki_Posts_Grid_Element extends Yuki_Posts_Base_Element {

		/**
		 * @return array
		 */
		public function getControls() {
			return [
				( new Tabs() )
					->ghostStyle()
					->setActiveTab( 'content' )
					->addTab( 'content', __( 'Content', 'yuki' ), [
						( new Collapse() )
							->setLabel( __( 'Query', 'yuki' ) )
							->setControls( array_merge( [
								( new Number( 'posts-count' ) )
									->setLabel( __( 'Posts Count', 'yuki' ) )
									->setMin( 1 )
									->setMax( 100 )
									->setDefaultValue( 6 )
								,
								( new Separator() ),
							], $this->getPostsQueryControls() ) )
						,
						( new Collapse() )
							->setLabel( __( 'Layout', 'yuki' ) )
							->setControls( [
								( new Slider( 'grid-columns' ) )
									->setLabel( __( 'Grid Columns', 'yuki' ) )
									->setDefaultUnit( false )
									->setMin( 1 )
									->setMax( 6 )
									->enableResponsive()
									->setDefaultValue( [
										'desktop' => 3,
										'tablet'  => 2,
										'mobile'  => 1,
									] )
								,
								( new Slider( 'items-gap' ) )
									->setLabel( __( 'Items Gap', 'yuki' ) )
									->enableResponsive()
									->setDefaultUnit( 'px' )
									->setDefaultValue( '24px' )
								,
							] )
						,
						( new Collapse() )
							->setLabel( __( 'Card', 'yuki' ) )
							->setControls( array_merge( [
								$this->getPostElementsLayer( 'structure', 'el', [
									'value' => [
										[ 'id' => 'thumbnail', 'visible' => true ],
										[ 'id' => 'categories', 'visible' => true ],
										[ 'id' => 'title', 'visible' => true ],
										[ 'id' => 'excerpt', 'visible' => true ],
										[ 'id' => 'metas', 'visible' => true ],
									],
									'title' => [],
									'cats'  => [],
									'tags'  => [],
									'metas' => [],
								] ),
								( new Separator() ),
							], $this->getCardContentControls() ) )
						,
					] )
					->addTab( 'style', __( 'Style', 'yuki' ), [
						( new Collapse() )
							->setLabel( __( 'Card', 'yuki' ) )
							->setControls( $this->getCardStyleControls() )
					] )
			];
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

				$elements = [ 'title', 'metas', 'categories', 'tags', 'excerpt', 'divider', 'thumbnail', 'read-more' ];

				$css[".$id"] = [
					'--card-gap' => $this->get( 'items-gap', $settings ),
				];

				$card_width = [];
				foreach ( $this->get( 'grid-columns', $settings ) as $device => $columns ) {
					$card_width[ $device ] = sprintf( "%.2f", substr( sprintf( "%.3f", ( 100 / (int) $columns ) ), 0, - 1 ) ) . '%';
				}
				$css[".$id .card-wrapper"] = [
					'width' => $card_width,
				];

				$css[".$id .card"] = array_merge(
					Css::background( $this->get( 'card_background', $settings ) ),
					Css::shadow( $this->get( 'card_shadow', $settings ) ),
					Css::border( $this->get( 'card_border', $settings ) ),
					Css::dimensions( $this->get( 'card_radius', $settings ), 'border-radius' )
				);

				$css[".$id .card .card-content"] = [
					'text-align'             => $this->get( 'card_content_alignment', $settings ),
					'justify-content'        => $this->get( 'card_vertical_alignment', $settings ),
					'--card-content-spacing' => $this->get( 'card_content_spacing', $settings ),
				];

				return array_merge(
					$css,
					yuki_post_elements_css( ".$id .card", 'el',
						$elements, $this, $settings
					) );
			} );
		}

		/**
		 * @param array $attrs
		 *
		 * @return mixed|void
		 */
		public function render( $attrs = [] ) {
			$id       = $attrs['id'];
			$settings = $attrs['settings'];

			$this->add_render_attribute( $id, 'class', Utils::clsx( [
				'yuki-page-builder-element',
				'yuki-posts-grid',
				'card-list',
				$id,
			] ) );

			if ( is_customize_preview() ) {
				$this->add_render_attribute( $id, 'data-shortcut', 'drop' );
				$this->add_render_attribute( $id, 'data-shortcut-location', $attrs['location'] );
			}

			$posts = new \WP_Query( $this->getPostsQueryArgs( $this->get( 'posts-count', $settings ), $settings ) );

			?>
            <div <?php $this->print_attribute_string( $id ); ?>>
				<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
                    <div class="card-wrapper">
                        <article data-card-layout="archive-grid" class="<?php Utils::the_clsx(
							get_post_class( 'yuki-scroll-reveal card overflow-hidden h-full', get_the_ID() ),
							[ 'card-thumb-motion' => $this->checked( 'yuki_el_thumbnail_motion', $settings ) ]
						); ?>">
							<?php
							yuki_post_structure( ...$this->get_post_structure_args( $id, $settings ) );
							?>
                        </article>
                    </div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
            </div>
			<?php
		}
	}
}
