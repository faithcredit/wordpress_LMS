<div class="term-bar">
  <?php if ( is_author() ) : ?>
    <div class="author-image">
      <?php echo get_avatar( get_the_author_meta( 'email' ), '120', null, get_the_author_meta( 'display_name' ) ); ?>
    </div>
  <?php endif; ?>
  <div class="term-info">
    <?php if ( is_category() ) :
      $current = get_queried_object();
      $categories = get_categories();
      
      foreach ( $categories as $category ) :
        $class = $current->term_id == $category->term_id ? 'active' : '';
        $color = get_term_meta( $category->term_id, 'category_color', true ); ?>
        <a class="<?php echo esc_attr( $class ); ?>" style="border-color: <?php echo esc_attr( $color ); ?>;" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
          <?php echo esc_html( $category->name ); ?>
        </a>
      <?php endforeach;
    else :
      if ( is_tag() ) {
        echo '<span>' . esc_html__( 'Browsing tag', 'linx' ) . '</span>';
      } elseif ( is_author() ) {
        echo '<span>' . esc_html__( 'Posts by', 'linx' ) . '</span>';
      } elseif ( is_search() ) {
        echo '<span>' . esc_html__( 'Search results for', 'linx' ) . '</span>';
      }

      if ( is_archive() ) {
        the_archive_title( '<h1 class="term-title">', '</h1>' );

        if ( ! is_author() ) {
          the_archive_description( '<div class="term-description">', '</div>' );
        }
      } elseif ( is_search() ) {
        echo '<h1 class="term-title">' . get_search_query() . '</h1>';
      }
    endif; ?>
  </div>
</div>