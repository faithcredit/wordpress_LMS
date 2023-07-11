<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Yuki
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
?>

<?php if ( is_customize_preview() ): ?>
<div data-shortcut="border" data-shortcut-location="yuki_content:yuki_content_comments">
	<?php endif; ?>

    <div class="mx-auto yuki-max-w-content">
        <div id="comments" class="yuki-comments-area">
			<?php
			// Check for have_comments().
			if ( have_comments() ): ?>
                <h2 class="comments-title font-bold text-lg mb-gutter">
					<?php
					$comment_count = get_comments_number();
					if ( 1 == $comment_count ) {
						echo esc_html__( 'One Comment', 'yuki' );
					} else {
						/* translators: %s: The count of comments */
						printf( esc_html__( '%s Comments', 'yuki' ), $comment_count );
					}
					?>
                </h2>

				<?php the_comments_navigation(); ?>

                <ol class="comment-list mb-gutter">
					<?php
					wp_list_comments( [
						'style'      => 'ol',
						'short_ping' => true,
					] );
					?>
                </ol><!-- .comment-list -->

				<?php the_comments_navigation();

				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() ): ?>
                    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'yuki' ); ?></p>
				<?php
				endif;
			endif;

			comment_form( [
				'class_form' => 'comment-form yuki-form form-default'
			] );
			?>
        </div>
    </div><!-- #comments -->

	<?php if ( is_customize_preview() ): ?>
</div>
<?php endif; ?>
