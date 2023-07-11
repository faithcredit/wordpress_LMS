<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<?php
		if ( ! linx_show_hero() ) :
			linx_entry_header( array( 'tag' => 'h1', 'link' => false ) );
		endif;

		if ( ! linx_show_hero() && has_post_thumbnail() ) :
			linx_entry_media( array( 'layout' => 'one' ) );
		endif;
	?>

	<div class="entry-wrapper">
		<div class="entry-content u-clearfix">
			<?php the_content(); ?>
		</div>
		<?php wp_link_pages( 'before=<div class="page-links">&after=</div>&link_before=<span>&link_after=</span>' ); ?>
	</div>
</article>
