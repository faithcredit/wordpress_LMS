<?php
if ( ! class_exists( 'Elite_Blog_Popular_Posts_Widget' ) ) {
	/**
	 * Adds Elite_Blog_Popular_Posts_Widget Widget.
	 */
	class Elite_Blog_Popular_Posts_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$elite_blog_grid_widget_ops = array(
				'classname'   => 'blog-popular-section',
				'description' => __( 'Retrive Popular Posts Widgets', 'elite-blog' ),
			);
			parent::__construct(
				'elite_blog_popular_posts_widget',
				__( 'Ascendoor Popular Posts Widget', 'elite-blog' ),
				$elite_blog_grid_widget_ops
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			$popular_posts_title       = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
			$popular_posts_title       = apply_filters( 'widget_title', $popular_posts_title, $instance, $this->id_base );
			$popular_posts_post_offset = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';
			$popular_posts_category    = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';

			echo $args['before_widget'];
			if ( ! empty( $popular_posts_title ) ) {
				echo $args['before_title'] . esc_html( $popular_posts_title ) . $args['after_title'];
			}
			?>
			<div class="popular-post-wrapper">
				<?php
				$popular_posts_widgets_args = array(
					'post_type'      => 'post',
					'posts_per_page' => absint( 4 ),
					'offset'         => absint( $popular_posts_post_offset ),
					'orderby'        => 'date',
					'order'          => 'desc',
					'cat'            => absint( $popular_posts_category ),
				);

				$query = new WP_Query( $popular_posts_widgets_args );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<div class="blog-post-container list-layout">
							<div class="blog-post-inner">
								<div class="blog-post-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
								<div class="blog-post-detail">
									<ul class="post-categories">
										<?php the_category( '', '', get_the_ID() ); ?>
									</ul>
									<h3 class="post-main-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-meta-button">
										<div class="post-meta">
											<span class="post-author">
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
											</span>
											<span class="post-date">
												<a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_date() ); ?></a>
											</span>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$popular_posts_title       = isset( $instance['title'] ) ? $instance['title'] : '';
			$popular_posts_post_offset = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';
			$popular_posts_category    = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Section Title:', 'elite-blog' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $popular_posts_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Number of posts to displace or pass over:', 'elite-blog' ); ?></label>
				<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo absint( $popular_posts_post_offset ); ?>" size="3" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select the category to show posts:', 'elite-blog' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" class="widefat" style="width:100%;">
					<?php
					$categories = elite_blog_get_post_cat_choices();
					foreach ( $categories as $category => $value ) {
						?>
						<option value="<?php echo absint( $category ); ?>" <?php selected( $popular_posts_category, $category ); ?>><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
				</select>
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance             = $old_instance;
			$instance['title']    = sanitize_text_field( $new_instance['title'] );
			$instance['offset']   = (int) $new_instance['offset'];
			$instance['category'] = (int) $new_instance['category'];
			return $instance;
		}
	}
}
