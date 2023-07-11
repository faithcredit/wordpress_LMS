<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'linx' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style' => 'ol',
					'short_ping' => true,
					'callback' => 'linx_comment',
					'avatar_size' => 100,
				) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'linx' ); ?></h2>
				<div class="nav-links">
					<?php if ( get_next_comments_link() ) : ?>
						<div class="nav-next"><?php next_comments_link( '<i class="mdi mdi-chevron-left"></i>' ); ?></div>
					<?php endif; ?>
					<?php if ( get_previous_comments_link() ) : ?>
						<div class="nav-previous"><?php previous_comments_link( '<i class="mdi mdi-chevron-right"></i>' ); ?></div>
					<?php endif; ?>
				</div>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'linx' ); ?></p>
	<?php endif; ?>

	<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

  	$fields = array(
  		'author' => '<div class="row comment-author-inputs"><div class="col-md-4 input"><p class="comment-form-author">' .
      '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name (required)', 'linx' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' /></p></div>',

  		'email' => '<div class="col-md-4 input"><p class="comment-form-email">' .
      '<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'E-mail (required)', 'linx' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' /></p></div>',

  		'url' => '<div class="col-md-4 input"><p class="comment-form-url">' .
      '<input id="url" name="url" type="text" placeholder="' . esc_attr__( 'Website', 'linx' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p></div></div>',
			
			'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>'
  	);

		$comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment (required)', 'linx' ) . '" rows="8" aria-required="true">' .
    '</textarea></p>';

		$comment_args = array( 'comment_field' => $comment_field, 'fields' => $fields, 'class_submit' => 'button', 'comment_notes_before' => '', 'comment_notes_after' => '' );
	?>

	<?php comment_form( $comment_args ); ?>

</div>
