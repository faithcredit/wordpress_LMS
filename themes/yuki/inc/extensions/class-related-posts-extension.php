<?php

use LottaFramework\Customizer\Controls\Number;
use LottaFramework\Customizer\Controls\Section;
use LottaFramework\Customizer\Controls\Select;
use LottaFramework\Customizer\Controls\Separator;
use LottaFramework\Customizer\Controls\Slider;
use LottaFramework\Customizer\Controls\Tabs;
use LottaFramework\Customizer\Controls\Text;
use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

if ( ! class_exists( 'Yuki_Related_Posts_Extension' ) ) {

	/**
	 * Class for related posts extension
	 *
	 * @package Yuki
	 */
	class Yuki_Related_Posts_Extension {

		use Yuki_Article_Controls;
		use Yuki_Post_Card;

		/**
		 * Register hooks
		 */
		public function __construct() {
			add_filter( 'yuki_single_post_section_controls', [ $this, 'controls' ] );
			add_action( 'yuki_action_after_single_post', [ $this, 'render' ], 20 );
		}

		/**
		 * @param $controls
		 *
		 * @return mixed
		 */
		public function controls( $controls ) {
			$selective = [
				'.yuki-related-posts-container',
				[ $this, 'render' ],
				[
					'container_inclusive' => true
				]
			];

			$content_controls = apply_filters( 'yuki_filter_related_posts_content_controls', [
				( new Select( 'yuki_related_posts_criteria' ) )
					->setLabel( __( 'Related Criteria', 'yuki' ) )
					->selectiveRefresh( ...$selective )
					->setDefaultValue( 'category' )
					->setChoices( [
						'category' => __( 'Category', 'yuki' ),
						'tag'      => __( 'Tag', 'yuki' ),
						'author'   => __( 'Author', 'yuki' ),
					] )
				,
				( new Select( 'yuki_related_posts_sort' ) )
					->setLabel( __( 'Sort By', 'yuki' ) )
					->selectiveRefresh( ...$selective )
					->setDefaultValue( 'recent' )
					->setChoices( [
						'default' => __( 'Default', 'yuki' ),
						'recent'  => __( 'Recent', 'yuki' ),
						'random'  => __( 'Random', 'yuki' ),
						'comment' => __( 'Comment Count', 'yuki' ),
					] )
				,
				( new Number( 'yuki_related_posts_number' ) )
					->setLabel( __( 'Posts Count', 'yuki' ) )
					->selectiveRefresh( ...$selective )
					->setMin( 1 )
					->setMax( 20 )
					->setDefaultUnit( false )
					->setDefaultValue( 3 )
				,
				( new Separator() ),
				( new Text( 'yuki_related_posts_section_title' ) )
					->setLabel( __( 'Section Title', 'yuki' ) )
					->asyncText( '.yuki-related-posts-wrap .heading-content' )
					->setDefaultValue( __( 'Related Posts', 'yuki' ) )
				,
			] );

			$layout_controls = apply_filters( 'yuki_filter_related_posts_layout_controls', array_merge(
				[
					$this->getPostElementsLayer( 'yuki_related_posts_card_structure', 'related_posts', [
						'selective-refresh' => $selective,
						'selector'          => '.yuki-related-posts-wrap .card',
						'value'             => [
							[ 'id' => 'thumbnail', 'visible' => true ],
							[ 'id' => 'categories', 'visible' => false ],
							[ 'id' => 'title', 'visible' => true ],
							[ 'id' => 'excerpt', 'visible' => true ],
							[ 'id' => 'metas', 'visible' => true ],
							[ 'id' => 'divider', 'visible' => false ],
							[ 'id' => 'read-more', 'visible' => false ],
						],
						'thumbnail'         => [ 'full-width' => 'no', 'height' => '128px' ],
						'title'             => [
							'tag'        => 'h4',
							'typography' => [
								'family'     => 'inherit',
								'fontSize'   => [ 'desktop' => '1rem', 'tablet' => '1rem', 'mobile' => '1rem' ],
								'variant'    => '700',
								'lineHeight' => '1.5'
							],
							'initial'    => 'var(--yuki-accent-color)',
							'hover'      => 'var(--yuki-primary-color)',
						],
						'cats'              => [],
						'tags'              => [],
						'metas'             => [],
						'divider'           => [],
						'excerpt'           => [ 'length' => 10 ],
					] ),
					( new Separator() ),
					( new Slider( 'yuki_related_posts_grid_columns' ) )
						->setLabel( __( 'Grid Columns', 'yuki' ) )
						->enableResponsive()
						->setMin( 1 )
						->setMax( 4 )
						->setDefaultUnit( false )
						->setDefaultValue( [
							'desktop' => 3,
							'tablet'  => 2,
							'mobile'  => 1,
						] )
					,
					( new Slider( 'yuki_related_posts_grid_items_gap' ) )
						->setLabel( __( 'Items Gap', 'yuki' ) )
						->enableResponsive()
						->setMin( 0 )
						->setMax( 50 )
						->setDefaultUnit( 'px' )
						->setDefaultValue( '24px' )
					,
					( new Separator() )
				],
				$this->getCardContentControls( 'yuki_related_posts_', [
					'selector'          => '.yuki-related-posts-wrap .card',
					'spacing'           => '0px',
					'scroll-reveal'     => 'no',
					'thumbnail-spacing' => '12px',
				] )
			) );

			$style_controls = apply_filters( 'yuki_filter_related_posts_style_controls',
				$this->getCardStyleControls( 'yuki_related_posts_', [
					'selector'      => '.yuki-related-posts-wrap .card',
					'background'    => [
						'type'  => 'color',
						'color' => \LottaFramework\Facades\Css::INITIAL_VALUE,
					],
					'border'        => [ 1, 'none', 'var(--yuki-base-200)' ],
					'shadow-enable' => false
				] )
			);

			$controls[] = ( new Section( 'yuki_post_related_posts' ) )
				->setLabel( __( 'Related Posts', 'yuki' ) )
				->enableSwitch()
				->setControls( [
					( new Tabs() )
						->setActiveTab( 'content' )
						->addTab( 'content', __( 'Content', 'yuki' ), $content_controls )
						->addTab( 'layout', __( 'Layout', 'yuki' ), $layout_controls )
						->addTab( 'style', __( 'Style', 'yuki' ), $style_controls )
					,
				] );

			return $controls;
		}

		/**
		 * Render related posts
		 */
		public function render() {
			$current = get_post();

			if ( ! CZ::checked( 'yuki_post_related_posts' ) || ! $current ) {
				return;
			}

			$args = [
				'post_type'           => $current->post_type,
				'ignore_sticky_posts' => 0,
				'post__not_in'        => array( get_the_ID() ),
				'posts_per_page'      => absint( CZ::get( 'yuki_related_posts_number' ) ),
			];

			$sort     = CZ::get( 'yuki_related_posts_sort' );
			$criteria = CZ::get( 'yuki_related_posts_criteria' );

			if ( $criteria === 'category' ) {
				$args['category__in'] = wp_get_post_categories( get_the_ID(), [ 'fields' => 'ids' ] );
			} elseif ( $criteria === 'tag' ) {
				$args['tag__in'] = wp_get_post_tags( get_the_ID(), [ 'fields' => 'ids' ] );
			} else if ( $criteria === 'author' ) {
				$args['author'] = isset( $current->post_author ) ? $current->post_author : 0;
			}

			if ( $sort !== 'default' ) {
				$orderby_map = [
					'random'  => 'rand',
					'recent'  => 'post_date',
					'comment' => 'comment_count'
				];

				if ( isset( $orderby_map[ $sort ] ) ) {
					$args['orderby'] = $orderby_map[ $sort ];
				}
			}

			$related_query = new \WP_Query( $args );

			if ( ! $related_query->have_posts() ) {
				return;
			}

			$attrs = [
				'class' => 'yuki-max-w-content mx-auto',
			];

			if ( is_customize_preview() ) {
				$attrs['class']                  = $attrs['class'] . ' yuki-related-posts-container';
				$attrs['data-shortcut']          = 'border';
				$attrs['data-shortcut-location'] = 'yuki_single_post:yuki_post_related_posts';
			}
			?>
            <div <?php \LottaFramework\Utils::print_attribute_string( $attrs ); ?>>
                <div class="yuki-related-posts-wrap yuki-heading yuki-heading-style-1">
                    <h3 class="heading-content uppercase my-gutter"><?php echo esc_html( CZ::get( 'yuki_related_posts_section_title' ) ) ?></h3>
                    <div class="flex flex-wrap yuki-related-posts-list">
						<?php while ( $related_query->have_posts() ): $related_query->the_post(); ?>
                            <div class="card-wrapper">
                                <article data-card-layout="archive-grid" class="<?php Utils::the_clsx(
									get_post_class( 'card overflow-hidden h-full', get_the_ID() ),
									[
										'card-thumb-motion'  => CZ::checked( 'yuki_related_posts_thumbnail_motion' ),
										'yuki-scroll-reveal' => CZ::checked( 'yuki_related_posts_card_scroll_reveal' )
									]
								); ?>">
									<?php
									yuki_post_structure( 'related_posts', CZ::layers( 'yuki_related_posts_card_structure' ), CZ::layers( 'yuki_related_posts_metas' ), [
										'title_link'   => true,
										'title_tag'    => CZ::get( 'yuki_related_posts_title_tag' ),
										'excerpt_type' => CZ::get( 'yuki_related_posts_excerpt_type' ),
									] );
									?>
                                </article>
                            </div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
			<?php
		}
	}
}

new Yuki_Related_Posts_Extension();
