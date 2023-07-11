<div class="entry-author">
  <?php echo get_avatar( get_the_author_meta( 'email' ), '160', null, get_the_author_meta( 'display_name' ) ); ?>
  <div class="author-info">
    <a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
    <span class="entry-date"><?php echo sprintf( '<time datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?></span>
  </div>
</div>
