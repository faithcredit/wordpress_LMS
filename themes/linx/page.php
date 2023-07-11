<?php
	$sidebar = linx_sidebar();
	$column_classes = linx_column_classes( $sidebar );
?>

<?php get_header(); ?>

<div class="row">
	<div class="<?php echo esc_attr( $column_classes[0] ); ?>">
		<div class="content-area">
			<main class="site-main">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content-page' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
			?>

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
