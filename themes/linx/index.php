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

			<?php if ( have_posts() ) : ?>

				<h1>PPP</h1>
				<div class="row posts-wrapper">
					<?php if ( linx_get_option( 'linx_disable_masonry', false ) == false ) : ?>
						<div class="grid-sizer <?php echo esc_attr( linx_grid_class() ); ?>"></div>
					<?php endif;
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile; ?>
				</div>

				<?php get_template_part( 'inc/partials/pagination' ); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

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
