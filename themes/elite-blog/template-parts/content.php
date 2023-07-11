<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite_Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post-container ">
		<div class="blog-post-inner">
			<div class="blog-post-image">
				<?php elite_blog_post_thumbnail(); ?>
			</div>
			<div class="blog-post-detail">
				
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="post-categories">
						<?php elite_blog_categories_list(); ?>
					</div>
				<?php endif; ?>
				
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="post-main-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
				
				<div class="post-excerpt">
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), get_theme_mod( 'elite_blog_excerpt_length', 20 ) ) ); ?></p>
				</div>

				<div class="post-meta-button">
					<div class="post-meta">
						<?php
						elite_blog_posted_by();
						elite_blog_posted_on();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</article><!-- #post-<?php the_ID(); ?> -->
