<?php
	$layout = linx_get_option( 'linx_main_layout', 'three' );
	$cover = rwmb_meta( 'linx_cover' ) == '1';
	$post_class = 'post';

	if ( $cover ) {
		$bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'linx_full_840' );
		$post_class .= ' cover lazyload';
	}
?>

<div class="<?php echo esc_attr( linx_grid_class() ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?><?php echo esc_attr( $cover ) ? ' data-bg="' . esc_url( $bg_image[0] ) . '"' : ''; ?>>
		<?php
			if ( $layout == 'one' || ( linx_is_first_post() && linx_get_option( 'linx_first_post_full', false ) == true ) ) {
				if ( ! get_post_format() && has_post_thumbnail() ) :
					linx_entry_media( array( 'layout' => 'one', 'cover' => $cover ) );
				elseif ( get_post_format() == 'video' && rwmb_meta( 'linx_pf_video_data' ) != '' ) : ?>
					<div class="entry-media">
						<?php echo rwmb_meta( 'linx_pf_video_data' ); ?>
					</div> <?php
				elseif ( get_post_format() == 'gallery' ) :
					linx_entry_media( array( 'layout' => $layout, 'gallery' => true ) );
				elseif ( get_post_format() == 'audio' && rwmb_meta( 'linx_pf_audio_data' ) != '' ) : ?>
					<div class="entry-media">
						<?php echo rwmb_meta( 'linx_pf_audio_data' ); ?>
					</div> <?php
				endif;
			} else {
				linx_entry_media( array( 'layout' => $layout, 'cover' => $cover ) );
			}
		?>

		<div class="entry-wrapper">
			<?php linx_entry_header(); ?>

			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<?php get_template_part( 'inc/partials/post-author' ); ?>
		</div>

		<?php get_template_part( 'inc/partials/action' ); ?>
	</article>
</div>
