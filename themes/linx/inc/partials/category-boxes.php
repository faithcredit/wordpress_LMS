<?php
  $ids = linx_get_option( 'linx_box_categories', '' );

  if ( ! empty( $ids ) ) : ?>
    <div class="container"><div class="category-boxes owl-carousel with-padding">
      <?php foreach ( $ids as $id ) : ?>
        <div class="category-box">
          <?php $category = get_category( $id );
          $args = array( 'cat' => $id, 'posts_per_page' => 3 );
          linx_get_option( 'linx_box_random_thumbnails', false ) == true ? $args['orderby'] = 'rand' : '';
          $category_posts = get_posts( $args );
          $thumbnails = array();
          $index = 0;
          
          foreach ( $category_posts as $category_post ) :
            $alt = get_post_meta( get_post_thumbnail_id( $category_post ), '_wp_attachment_image_alt' );
            $alt = ! empty( $alt ) ? $alt[0] : '';
            $image_size = $index == 0 ? 'linx_full_420' : 'thumbnail';

            $thumbnails[] = array(
              'url' => get_the_post_thumbnail_url( $category_post, $image_size ),
              'alt' => $alt,
            );

            $index++;
          endforeach; ?>

          <div class="entry-thumbnails">
            <div class="big thumbnail">
              <img class="lazyload" data-src="<?php echo esc_url( $thumbnails[0]['url'] ); ?>" alt="<?php echo esc_attr( $thumbnails[0]['alt'] ); ?>">
            </div>
            <div class="small">
              <div class="thumbnail">
                <img class="lazyload" data-src="<?php echo esc_url( $thumbnails[1]['url'] ); ?>" alt="<?php echo esc_attr( $thumbnails[1]['alt'] ); ?>">
              </div>
              <div class="thumbnail">
                <img class="lazyload" data-src="<?php echo esc_url( $thumbnails[2]['url'] ); ?>" alt="<?php echo esc_attr( $thumbnails[2]['alt'] ); ?>">
                <?php if ( $category->category_count > 3 ) : ?>
                  <span>+<?php echo esc_html( $category->category_count - 3 ); ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="entry-content">
            <div class="left">
              <h3 class="entry-title"><?php echo esc_html( $category->name ); ?></h3>
            </div>
            <div class="right">
              <a class="arrow" href="<?php echo esc_url( get_category_link( $category->cat_ID ) ); ?>"><i class="mdi mdi-arrow-right"></i></a>
            </div>
          </div>
          <a class="u-permalink" href="<?php echo esc_url( get_category_link( $category->cat_ID ) ); ?>"></a>
        </div>
      <?php endforeach; ?>
    </div></div>
  <?php endif;
?>