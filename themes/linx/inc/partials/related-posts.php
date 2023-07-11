<?php if ( $related_posts = linx_related_posts() ) : ?>
  <div class="related-posts">
    <h3><?php echo apply_filters( 'linx_related_posts_title', esc_html__( 'You might also like', 'linx' ) ); ?></h3>
    <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
      <article class="post">
        <?php if ( has_post_thumbnail() ) :
          linx_entry_media( array( 'layout' => 'related' ) );
        endif; ?>
        <div class="entry-wrapper">
          <?php linx_entry_header( array( 'tag' => 'h4', 'author' => false, 'comment' => false ) ); ?>
          <div class="entry-excerpt">
            <?php the_excerpt(); ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php wp_reset_postdata();
