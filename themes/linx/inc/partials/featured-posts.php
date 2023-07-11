<?php

$args = array(
  'ignore_sticky_posts' => true,
  'meta_key' => 'linx_featured',
  'meta_value' => '1',
  'post_status' => 'publish',
  'post_type' => array( 'post', 'page' ),
);
$featured_posts = new WP_Query( $args );

$style = linx_get_option( 'linx_featured_style', 'none' );
$image_size = $style == 'v1' ? 'linx_full_1130' : 'linx_full_840';

if ( $featured_posts->have_posts() ) : ?>

  <?php if ( linx_show_featured_wrapper() ) : ?>
  <div class="featured-wrapper lazyload" data-bg="<?php echo esc_url( linx_get_option( 'linx_featured_wrapper_image', '' ) ); ?>">
  <?php endif; ?>
  
    <div class="container">
      <div class="featured-posts <?php echo esc_attr( $style ); ?> owl-carousel with-padding">
        <?php while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
          if ( $style != 'v2' ) {
            $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
          } ?>
          <article class="featured-post lazyload visible"<?php echo isset( $bg_image ) ? ' data-bg="' . esc_url( $bg_image[0] ) . '"' : ''?>>
            <div class="entry-wrapper">
              <?php if ( $style == 'v2' ) :
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' ); ?>
                <div class="entry-thumbnail">
                  <img class="lazyload" data-src="<?php echo esc_url( $image[0] ); ?>">
                </div>
              <?php endif;
              linx_entry_header( array( 'tag' => 'h2', 'link' => false, 'white' => true, 'date' => false, 'author' => false, 'comment' => false ) );
              if ( $style == 'v1' || $style == 'v2' ) : ?>
                <div class="entry-excerpt">
                  <?php the_excerpt(); ?>
                </div>
              <?php endif;
              if ( $style == 'v1' ) :
                get_template_part( 'inc/partials/post-author' );
              endif; ?>
            </div>
            <a class="u-permalink" href="<?php echo esc_url( get_permalink() ); ?>"></a>
          </article>
        <?php endwhile; ?>
      </div>
    </div>
  
  <?php if ( linx_show_featured_wrapper() ) : ?>
  </div>
  <?php endif; ?>

<?php endif; ?>
