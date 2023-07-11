<?php

if ( ! function_exists( 'linx_logo' ) ) :
function linx_logo( $options = array() ) {
  $options = array_merge( array( 'contrary' => true ), $options );
  $logo_regular = linx_get_option( 'linx_logo_regular', '' );
  $logo_contrary = linx_get_option( 'linx_logo_contrary', '' ); ?>

  <?php if ( ! empty( $logo_regular ) ) : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img class="logo regular" src="<?php echo esc_url( $logo_regular ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    </a>
  <?php else : ?>
    <a class="logo text" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
  <?php endif; ?>

  <?php if ( $options['contrary'] && ! empty( $logo_contrary ) ) : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img class="logo contrary" src="<?php echo esc_url( $logo_contrary ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    </a>
  <?php endif;
}
endif;

if ( ! function_exists( 'linx_entry_media' ) ) :
function linx_entry_media( $options = array() ) {
  $options = array_merge( array( 'gallery' => false, 'cover' => false ), $options );
  $sidebar = linx_sidebar();
  $class = 'entry-media with-placeholder';
  $alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt' );
  $alt = ! empty( $alt ) ? $alt[0] : '';
  $title = get_the_title( get_post_thumbnail_id() );

  switch ( $options['layout'] ) {
    case 'one' :
      $image_size = 'linx_full_420';
      break;
    case 'two' :
      $image_size = linx_get_option( 'linx_enable_cropped_image', false ) == true ? 'linx_420' : 'linx_full_420';
      break;
    case 'three' :
      $image_size = linx_get_option( 'linx_enable_cropped_image', false ) == true ? 'linx_420' : 'linx_full_420';
      break;
    case 'four' :
      $image_size = linx_get_option( 'linx_enable_cropped_image', false ) == true ? 'linx_420' : 'linx_full_420';
      break;
    case 'related' :
      $image_size = linx_get_option( 'linx_enable_cropped_image', false ) == true ? 'linx_420' : 'linx_full_420';
      break;
    case 'post' :
      $image_size = 'linx_full_420';
      break;
    case 'rect' :
      $image_size = 'linx_420';
      break;
  } ?>

  <?php if ( ! $options['gallery'] ) :
    if ( ! linx_is_gif() ) :
      if ( wp_get_attachment_image_srcset( get_post_thumbnail_id(), $image_size ) ) :
        $ratio = linx_thumbnail_ratio( $image_size ); ?>
        <div class="<?php echo esc_attr( $class ); ?>" style="padding-bottom: <?php echo esc_attr( $ratio ); ?>;">
          <?php if ( ! $options['cover'] ) : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>">
              <img class="lazyload" data-srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_post_thumbnail_id(), $image_size ) ); ?>" data-sizes="auto" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $title ); ?>">
            </a>
          <?php endif; ?>
          <?php get_template_part( 'inc/partials/format' ); ?>
        </div>
      <?php else :
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size ); ?>
        <div class="entry-media">
          <?php if ( ! $options['cover'] ) : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>">
              <img class="lazyload" data-src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $title ); ?>">
            </a>
          <?php endif; ?>
          <?php get_template_part( 'inc/partials/format' ); ?>
        </div>
      <?php endif;
    else :
      $ratio = linx_thumbnail_ratio( 'full' );
      $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
      <div class="<?php echo esc_attr( $class ); ?>" style="padding-bottom: <?php echo esc_attr( $ratio ); ?>;">
        <?php if ( ! $options['cover'] ) : ?>
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            <img class="lazyload" data-src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $title ); ?>">
          </a>
        <?php endif; ?>
        <?php get_template_part( 'inc/partials/format' ); ?>
      </div>
    <?php endif;
  else :
    $gallery = rwmb_meta( 'linx_pf_gallery_data' );
    if ( ! empty( $gallery ) ) : ?>
      <div class="entry-media">
        <div class="entry-gallery owl-carousel">
          <?php foreach ( $gallery as $image ) : ?>
            <img class="lazyload" data-srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image['ID'], $image_size ) ); ?>" data-sizes="auto" alt="<?php echo esc_attr( $image['alt'] ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>">
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif;
  endif;
}
endif;

if ( ! function_exists( 'linx_entry_header' ) ) :
function linx_entry_header( $options = array() ) {
  $options = array_merge( array( 'id' => get_the_ID(), 'tag' => 'h2', 'link' => true, 'category' => true, 'date' => false, 'author' => false, 'comment' => false, 'like' => false ), $options );

  $post_id = is_singular( 'post' ) ? get_queried_object_id() : get_the_ID();
  $author_id = get_post_field( 'post_author', $post_id );
  $categories = get_the_category( $options['id'] ); ?>

  <header class="entry-header">
    <?php if ( $categories && $options['category'] ) : ?>
      <div class="entry-category">
        <?php if ( linx_get_option( 'linx_enable_hierarchical_categories', false ) == false ) : ?>
          <?php foreach ( $categories as $category ) :
            $color = get_term_meta( $category->term_id, 'category_color', true ); ?>
            <a style="background-color: <?php echo esc_attr( $color ); ?>;" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" rel="category"><?php echo esc_html( $category->name ); ?></a>
          <?php endforeach; ?>
        <?php else : ?>
          <?php
            $walker = new LINX_Category_Walker();
            echo $walker->walk( $categories, 0 );
          ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php
      if ( $options['link'] ) {
        echo '<' . $options['tag'] . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title( $options['id'] ) . '</a></' . $options['tag'] . '>';
      } else {
        echo '<' . $options['tag'] . ' class="entry-title">' . get_the_title( $options['id'] ) . '</' . $options['tag'] . '>';
      }
    ?>

    <div class="entry-meta">
      <?php if ( $options['date'] ) :
        echo sprintf( '<time datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
      endif;
      
      if ( $options['comment'] && ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
        printf( _n( '%s comment', '%s comments', esc_html( get_comments_number() ), 'linx' ), esc_html( number_format_i18n( get_comments_number() ) ) );
      endif;

      if ( $options['like'] ) :
        $like_count = get_post_meta( get_the_ID(), 'linx_like', true );
        $like_count = $like_count != '' ? $like_count : '0';
        printf( _n( '%s like', '%s likes', esc_html( $like_count ), 'linx' ), esc_html( number_format_i18n( $like_count ) ) );
      endif; ?>
    </div>
  </header>
<?php
}
endif;

if ( ! function_exists( 'linx_ads' ) ) :
function linx_ads( $options = array() ) {
  $option = 'linx_ads_' . $options['location'] . '_';

  if ( linx_show_ads( $options['location'] ) ) : ?>
    <div class="ads <?php echo esc_attr( $options['location'] ); ?>">
      <div class="container">
        <?php if ( linx_get_option( $option . 'style', 'none' ) == 'image' ) :
          if ( linx_get_option( $option . 'link', '' ) == '' ) : ?>
            <img src="<?php echo esc_url( linx_get_option( $option . 'image', '' ) ); ?>">
          <?php else : ?>
            <a href="<?php echo esc_url( linx_get_option( $option . 'link', '' ) ); ?>"<?php echo linx_get_option( $option . 'new_tab', false ) == false ? '' : ' target="_blank"'; ?>>
              <img src="<?php echo esc_url( linx_get_option( $option . 'image', '' ) ); ?>">
            </a>
          <?php endif;
        elseif ( linx_get_option( $option . 'style', 'none' ) == 'html' ) :
          echo linx_get_option( $option . 'html', '' );
        endif; ?>
      </div>
    </div> <?php
  endif;
}
endif;

if ( ! function_exists( 'linx_comment' ) ) :
function linx_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;

  if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <div class="comment-body">
      <?php esc_html_e( 'Pingback:', 'linx' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'linx' ), '<span class="edit-link">', '</span>' ); ?>
    </div>

  <?php else : ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-wrapper u-clearfix" itemscope itemtype="https://schema.org/Comment">
      <div class="comment-author-avatar vcard">
        <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      </div>

      <div class="comment-content">
        <div class="comment-author-name vcard" itemprop="author">
          <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
        </div>

        <div class="comment-metadata">
          <time datetime="<?php comment_time( 'c' ); ?>" itemprop="datePublished">
            <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'linx' ), get_comment_date(), get_comment_time() ); ?>
          </time>

          <?php
            edit_comment_link( esc_html__( 'Edit', 'linx' ), ' <span class="edit-link">', '</span>' );
            comment_reply_link( array_merge( $args, array(
              'add_below' => 'div-comment',
              'depth'     => $depth,
              'max_depth' => $args['max_depth'],
              'before'    => '<span class="reply-link">',
              'after'     => '</span>',
            ) ) );
          ?>
        </div>

        <div class="comment-body" itemprop="comment">
          <?php comment_text(); ?>
        </div>

        <?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'linx' ); ?></p>
        <?php endif; ?>
      </div>
    </article> <?php

  endif;
}
endif;
