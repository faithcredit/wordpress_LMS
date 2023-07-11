<?php
/**
 * Template Name: Category Index
 */

$categories = get_categories();

get_header(); ?>

<div class="content-area">
  <main class="site-main">
    <?php if ( $categories ) : ?>
      <div class="explore">
        <?php foreach ( $categories as $category ) : ?>
          <div class="explore-row">
            <h3 class="explore-category"><?php echo esc_html( $category->name ); ?></h3>
            <?php
              $args = array( 'cat' => $category->cat_ID, 'posts_per_page' => 6 );
              $category_posts = new WP_Query( $args );
              $index = 1;

              if ( $category_posts->have_posts() ) :
                echo '<div class="explore-posts owl-carousel with-arrow">';
                while ( $category_posts->have_posts() ) : $category_posts->the_post();
                  echo '<div class="explore-post">';

                  if ( $index == $category_posts->post_count ) {
                    echo '<div class="last">';
                    echo '<a href="' . esc_url( get_category_link( $category->cat_ID ) ) . '">' . apply_filters( 'linx_explore_button_text', esc_html__( 'View all', 'linx' ) ) . '</a>';
                  }

                  if ( has_post_thumbnail() ) {
                    linx_entry_media( array( 'layout' => 'rect' ) );
                  }

                  if ( $index == $category_posts->post_count ) {
                    echo '</div>';
                  }

                  linx_entry_header( array( 'tag' => 'h4', 'category' => false ) );

                  echo '</div>';
                  $index++;
                endwhile;
                echo '</div>';
              endif;
              wp_reset_postdata();
            ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>
</div>

<?php get_footer(); ?>
