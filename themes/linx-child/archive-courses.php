<?php
	$sidebar = linx_sidebar();
	$column_classes = linx_column_classes( $sidebar );
?>

<?php get_header(); ?>

<div class="row">
	<div class="<?php echo esc_attr( $column_classes[0] ); ?>">

		<?php if ( is_archive() || is_search() ) {
			get_template_part( 'inc/partials/term-bar' );
		} ?>

		<div class="content-area">
			<main class="site-main">

			<?php 
			//// Categories...
			$args = array(
						'taxonomy' => 'course_categories',
						'orderby'  => 'name',
						'order'    => 'ASC'
					);
			$cats = get_categories($args);

			//// Contents...
			foreach($cats as $cat) {

				//// Query...
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args=array(
						'post_type' => get_post_type(),
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => 'course_categories',
								'field' => 'slug',
								'terms' => $cat->slug,
							),
						),
						'paged' => $paged,
						'posts_per_page' => 3,
						'orderby' => 'title',
						'order' => 'ASC',
					);

				global $wp_query;
				$temp_query = $wp_query;

				$wp_query = new WP_Query( $args );
				?>

				<!-- Labeling... -->
				<div class="<?php echo $cat->slug; ?>">
					<a href="<?php echo get_category_link( $cat->term_id ) ?>">
						<h1><?php echo $cat->name; ?></h1>
					</a>

					<?php
					//// Loop...
					if( have_posts() ) : ?>
						<div class="row posts-wrapper-4-<?php echo $cat->slug; ?>">
							<?php if ( linx_get_option( 'linx_disable_masonry', false ) == false ) : ?>
								<div class="grid-sizer <?php echo esc_attr( linx_grid_class() ); ?>"></div>
							<?php endif;

							while ( have_posts() ) : the_post(); 
								get_template_part( 'template-parts/content', get_post_format() );							
							endwhile; 

							?>
						</div>
						<?php get_template_part( 'template-parts/pagination_course' ); ?>
						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

					<?php $wp_query = $temp_query; ?>

					<!-- <div class="btn__wrapper">
						<a href="#!" class="btn btn__primary" id="load-more">Load more</a>
					</div> -->

				</div>
				
			<?php } ?>

			</main>
		</div>
	</div>

	<?php if ( $sidebar != 'none' ) : ?>
		<div class="<?php echo esc_attr( $column_classes[1] ); ?>">
			<?php get_sidebar(); ?>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
