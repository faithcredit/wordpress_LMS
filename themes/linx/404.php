<?php get_header(); ?>

<div class="content-area">
	<main class="site-main">
		<div class="_404">
			<h1 class="entry-title"><?php echo apply_filters( 'linx_404_title', esc_html__( 'Sorry, this page doesn\'t exist', 'linx' ) ); ?></h1>
			<div class="entry-content">
				<?php echo apply_filters( 'linx_404_message', esc_html__( 'It may have been removed, or the URL you are using is incorrect. Maybe try a search?', 'linx' ) ); ?>
			</div>
			<?php
				get_search_form();
				get_template_part( 'inc/partials/popular-categories' );
			?>
		</div>
	</main>
</div>

<?php get_footer(); ?>