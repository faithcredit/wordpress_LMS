<div class="_404">
	<h1 class="entry-title"><?php echo apply_filters( 'linx_no_result_title', esc_html__( 'No results found', 'linx' ) ); ?></h1>
	<div class="entry-content">
		<?php echo apply_filters( 'linx_no_result_message', esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'linx' ) ); ?>
	</div>
	<?php
		get_search_form();
		get_template_part( 'inc/partials/popular-categories' );
	?>
</div>
