<?php

if ( is_front_page() ) {
  $style = linx_get_option( 'linx_hero_home_style', 'none' );
  $content = linx_get_option( 'linx_hero_home_content', 'image' );
  $heading = linx_get_option( 'linx_hero_home_heading', '' );
  $subheading = linx_get_option( 'linx_hero_home_subheading', '' );
  $link = linx_get_option( 'linx_hero_home_link', '' );
  $button_secondary_text = linx_get_option( 'linx_hero_home_button_secondary_text', '' );
  $button_secondary_link = linx_get_option( 'linx_hero_home_button_secondary_link', '' );
  $button_primary_text = linx_get_option( 'linx_hero_home_button_primary_text', '' );
  $button_primary_link = linx_get_option( 'linx_hero_home_button_primary_link', '' );
  $bg_image = linx_get_option( 'linx_hero_home_bg_image', '' );
  $bg_slider = array();
  $slides = linx_get_option( 'linx_hero_home_bg_slider', false );
  if ( $slides ) {
    foreach ( $slides as $slide ) {
      $image = wp_get_attachment_image_src( $slide['slider_image'], 'full' );
      $bg_slider[] = array(
        'image' => $image[0],
        'heading' => $slide['slider_heading'],
        'subheading' => $slide['slider_subheading'],
        'link' => $slide['slider_link'],
        'button_secondary_text' => $slide['slider_button_secondary_text'],
        'button_secondary_link' => $slide['slider_button_secondary_link'],
        'button_primary_text' => $slide['slider_button_primary_text'],
        'button_primary_link' => $slide['slider_button_primary_link'],
      );
    }
  }
} elseif ( is_singular( 'post' ) || is_page() ) {
  $queried_object = get_queried_object();
  $style = linx_compare_options( linx_get_option( 'linx_hero_single_style', 'none' ), rwmb_meta( 'linx_hero_single_style', '', $queried_object->ID ) );
  $content = get_post_format( $queried_object->ID ) ? get_post_format( $queried_object->ID ) : 'image';
  $heading = rwmb_meta( 'linx_hero_single_heading', '', $queried_object->ID ) == '' ? get_the_title( $queried_object->ID ) : rwmb_meta( 'linx_hero_single_heading', '', $queried_object->ID );
  $subheading = rwmb_meta( 'linx_hero_single_subheading', '', $queried_object->ID );
  $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $queried_object->ID ), 'full' );
  $bg_image = $bg_image[0];
  $bg_slider = array();
  $slides = rwmb_meta( 'linx_pf_gallery_data', '', $queried_object->ID );
  if ( ! empty( $slides ) ) {
    foreach ( $slides as $slide ) {
      $image = wp_get_attachment_image_src( $slide['ID'], 'full' );
      $bg_slider[] = array(
        'image' => $image[0],
        'heading' => get_the_title( $queried_object->ID ),
        'subheading' => '',
      );
    }
  }
}

$hero_class = 'hero lazyload visible';

if ( $content == 'gallery' ) {
  $hero_class = 'hero';
  $bg_image = '';
} ?>

<div class="<?php echo esc_attr( $hero_class ); ?>" data-bg="<?php echo esc_url( $bg_image ); ?>">
  <?php if ( $content == 'image' && $heading != '' ) : ?>
    <div class="hero-content">
      <?php if ( ! is_singular( 'post' ) ) : ?>
        <header class="entry-header">
          <?php if ( $heading != '' ) : ?>
            <h1 class="hero-heading"><?php echo esc_html( $heading ); ?></h1>
          <?php endif; ?>
          <?php if ( $subheading != '' ) : ?>
            <div class="hero-subheading"><?php echo esc_html( $subheading ); ?></div>
          <?php endif; ?>
          <?php if ( $button_secondary_text != '' ) : ?>
            <a class="button transparent" href="<?php echo esc_url( $button_secondary_link ); ?>"><?php echo esc_html( $button_secondary_text ); ?></a>
          <?php endif; ?>
          <?php if ( $button_primary_text != '' ) : ?>
            <a class="button" href="<?php echo esc_url( $button_primary_link ); ?>"><?php echo esc_html( $button_primary_text ); ?></a>
          <?php endif; ?>
        </header>
      <?php elseif ( linx_compare_options( linx_get_option( 'linx_hero_single_show_title', false ), rwmb_meta( 'linx_hero_single_show_title', '', $queried_object->ID ) ) == true ) :
        linx_entry_header( array( 'id' => $queried_object->ID, 'tag' => 'h1', 'link' => false ) );
      endif; ?>
    </div>
    <?php if ( is_front_page() && $link != '' ) : ?>
      <a class="u-permalink" href="<?php echo esc_url( $link ); ?>"></a>
    <?php endif;
  endif; ?>

  <?php if ( $content == 'gallery' && $bg_slider ) : ?>
    <div class="hero-slider owl-carousel">
      <?php foreach ( $bg_slider as $slide ) : ?>
        <div class="slider-item lazyload visible" data-bg="<?php echo esc_url( $slide['image'] ); ?>">
          <?php if ( $slide['heading'] != '') : ?>
            <div class="hero-content">
              <?php if ( ! is_singular( 'post' ) ) : ?>
                <header class="entry-header">
                  <h2 class="hero-heading"><?php echo esc_html( $slide['heading'] ); ?></h2>
                  <div class="hero-subheading"><?php echo esc_html( $slide['subheading'] ); ?></div>
                  <?php if ( $slide['button_secondary_text'] != '' ) : ?>
                    <a class="button transparent" href="<?php echo esc_url( $slide['button_secondary_link'] ); ?>"><?php echo esc_html( $slide['button_secondary_text'] ); ?></a>
                  <?php endif; ?>
                  <?php if ( $slide['button_primary_text'] != '' ) : ?>
                    <a class="button" href="<?php echo esc_url( $slide['button_primary_link'] ); ?>"><?php echo esc_html( $slide['button_primary_text'] ); ?></a>
                  <?php endif; ?>
                </header>
              <?php elseif ( linx_compare_options( linx_get_option( 'linx_hero_single_show_title', false ), rwmb_meta( 'linx_hero_single_show_title', '', $queried_object->ID ) ) == true ) :
                linx_entry_header( array( 'id' => $queried_object->ID, 'tag' => 'h1', 'link' => false ) );
              endif; ?>
            </div>
          <?php endif;
          if ( is_front_page() && $slide['link'] != '' ) : ?>
            <a class="u-permalink" href="<?php echo esc_url( $slide['link'] ); ?>"></a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php
    if ( ( is_singular( 'post' ) || is_page() ) && ( $content == 'video' || $content == 'audio' ) ) :
      echo '<div class="hero-media"><div class="container">' . rwmb_meta( 'linx_pf_' . get_post_format() . '_data' ) . '</div></div>';
    endif;
  ?>
</div>
