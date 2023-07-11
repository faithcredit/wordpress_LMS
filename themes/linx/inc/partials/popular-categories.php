<?php
  $categories = get_categories( array(
    'number' => 5,
    'order' => 'DESC',
    'orderby' => 'count',
  ) );
?>

<div class="popular-categories">
  <?php foreach ( $categories as $category ) : ?>
    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'linx' ), $category->name ) ); ?>">
      <span class="category-name"><?php echo esc_html( $category->name ); ?></span>
      <span class="category-count"><?php echo esc_html( $category->count ); ?></span>
    </a>
  <?php endforeach; ?>
</div>