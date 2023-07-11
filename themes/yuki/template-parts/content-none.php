<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Yuki
 */

?>

<section class="px-half-gutter mb-60 max-w-prose mx-auto">
    <header class="text-center mt-10 mb-half-gutter">
        <h1 class="text-3xl font-bold text-accent-active">
			<?php
			if ( is_404() ) {
				esc_html_e( 'Oops! That page can&rsquo;t be found.', 'yuki' );
			} else {
				esc_html_e( 'Nothing Found', 'yuki' );
			}
			?>
        </h1>
    </header>

    <div class="text-center form-controls form-default form-primary">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <!-- For Home Page -->
            <p class="mb-gutter">
				<?php
				printf( wp_kses(
				/*translators: %1$s: the url of 'post-new.php'*/
					__( 'Ready to publish your first post? <a class="link" href="%1$s">Get started here</a>.', 'yuki' ),
					array( 'a' => array( 'href' => array(), 'class' => array() ) ) ),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
            </p>
		<?php elseif ( is_search() ) : ?>
            <!-- For Search Result -->
            <p class="mb-gutter text-accent">
				<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'yuki' ); ?>
            </p>
            <div class="yuki-max-w-content mx-auto yuki-no-result-search-form yuki-form">
				<?php get_search_form(); ?>
            </div>
		<?php else : ?>
            <!-- For Archive Page -->
            <p class="mb-gutter text-accent">
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'yuki' ); ?>
            </p>
            <div class="yuki-max-w-content mx-auto yuki-no-result-search-form yuki-form">
				<?php get_search_form(); ?>
            </div>
		<?php endif; ?>
    </div>
</section>
