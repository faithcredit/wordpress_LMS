<?php

$tags = get_the_tags();

if ( $tags && linx_get_option( 'linx_disable_post_tags', false ) == false ) : ?>
  <div class="entry-tags">
    <?php foreach ( $tags as $tag ) :
      $color = get_term_meta( $tag->term_id, 'tag_color', true ); ?>
      <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag">
        <span class="dot" style="background-color: <?php echo esc_attr( $color ); ?>;"></span>
        <?php echo esc_html( $tag->name ); ?>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif;
