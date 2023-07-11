<?php
if ( ! get_theme_mod( 'elite_blog_enable_slider_section', false ) ) {
	return;
}

$slider_content_ids  = array();
$slider_content_type = get_theme_mod( 'elite_blog_slider_content_type', 'post' );

for ( $i = 1; $i <= 3; $i++ ) {
	$slider_content_ids[] = get_theme_mod( 'elite_blog_slider_content_' . $slider_content_type . '_' . $i );
}

$slider_args = array(
	'post_type'           => $slider_content_type,
	'posts_per_page'      => absint( 3 ),
	'ignore_sticky_posts' => true,
);
if ( ! empty( array_filter( $slider_content_ids ) ) ) {
	$slider_args['post__in'] = array_filter( $slider_content_ids );
	$slider_args['orderby']  = 'post__in';
} else {
	$slider_args['orderby'] = 'date';
}

$slider_args = apply_filters( 'elite_blog_slider_section_args', $slider_args );

elite_blog_render_slider_section( $slider_args );

/**
 * Render Banner Slider Section.
 */
function elite_blog_render_slider_section( $slider_args ) {

	$query = new WP_Query( $slider_args );
	if ( $query->have_posts() ) {
		?>
		<section id="elite_blog_slider_section" class="banner-section no-background banner-style-1">
			<?php
			if ( is_customize_preview() ) :
				elite_blog_section_link( 'elite_blog_slider_section' );
			endif;
			?>
			<div class="banner-wrapper">
				<div class="banner-slider slick-button">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<div class="blog-post-container ">
							<div class="blog-post-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="blog-post-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'post-thumbnail' ); ?>
										</a>
									</div>
								<?php endif ?>
								<div class="blog-post-detail">
									<ul class="post-categories">
										<?php the_category( '', '', get_the_ID() ); ?>
									</ul>
									<h3 class="post-main-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<p class="post-excerpt">
										<?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?>
									</p>
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
					?>
				</div>
			</div>
		</section>
		<?php
	}
}
