<?php

function linx_register_meta_boxes( $meta_boxes ) {
  $prefix = 'linx_';

  $meta_boxes[] = array(
    'id' => 'general_settings',
    'title' => esc_html__( 'General Settings', 'linx' ),
    'pages' => array( 'post', 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Navbar style', 'linx' ),
        'id' => "{$prefix}navbar_style",
        'type' => 'select',
        'options' => array(
          'sticky' => esc_html__( 'Sticky', 'linx' ),
          'transparent' => esc_html__( 'Transparent', 'linx' ),
          'sticky_transparent' => esc_html__( 'Sticky+Transparent', 'linx' ),
          'regular' => esc_html__( 'Regular', 'linx' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Same as customizer', 'linx' ),
      ),
      array(
        'name' => esc_html__( 'Sidebar style', 'linx' ),
        'id' => "{$prefix}sidebar_single",
        'type' => 'select',
        'options' => array(
          'none' => esc_html__( 'No sidebar', 'linx' ),
          'right' => esc_html__( 'Right sidebar', 'linx' ),
          'left' => esc_html__( 'Left sidebar', 'linx' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Same as customizer', 'linx' ),
      ),
      array(
        'name' => esc_html__( 'Make the post style cover?', 'linx' ),
        'id' => "{$prefix}cover",
        'type' => 'checkbox',
        'std' => 0,
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'hero_settings_post',
    'title' => esc_html__( 'Hero Settings', 'linx' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Hero style', 'linx' ),
        'id' => "{$prefix}hero_single_style",
        'type' => 'select',
        'options' => array(
          'wide' => esc_html__( 'Wide', 'linx' ),
          'full' => esc_html__( 'Full', 'linx' ),
          'none' => esc_html__( 'None', 'linx' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Same as customizer', 'linx' ),
      ),
      array(
        'name' => esc_html__( 'Show post title on hero', 'linx' ),
        'id' => "{$prefix}hero_single_show_title",
        'type' => 'select',
        'options' => array(
          '1' => esc_html__( 'Yes', 'linx' ),
          '0' => esc_html__( 'No', 'linx' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Same as customizer', 'linx' ),
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'hero_settings_page',
    'title' => esc_html__( 'Hero Settings', 'linx' ),
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Hero style', 'linx' ),
        'id' => "{$prefix}hero_single_style",
        'type' => 'select',
        'options' => array(
          'wide' => esc_html__( 'Wide', 'linx' ),
          'full' => esc_html__( 'Full', 'linx' ),
          'none' => esc_html__( 'None', 'linx' ),
        ),
        'multiple' => false,
        'placeholder' => esc_html__( 'Same as customizer', 'linx' ),
      ),
      array(
        'name' => esc_html__( 'Hero heading', 'linx' ),
        'id' => "{$prefix}hero_single_heading",
        'type' => 'text',
      ),
      array(
        'name' => esc_html__( 'Hero subheading', 'linx' ),
        'id' => "{$prefix}hero_single_subheading",
        'type' => 'text',
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'feature_settings',
    'title' => esc_html__( 'Featured Content Settings', 'linx' ),
    'pages' => array( 'post', 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'name' => esc_html__( 'Feature this post/page?', 'linx' ),
        'id' => "{$prefix}featured",
        'type' => 'checkbox',
        'std' => 0,
      ),
    )
  );

  $meta_boxes[] = array(
    'id' => 'format_settings',
    'title' => esc_html__( 'Post Format Settings', 'linx' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Video Format', 'linx' ),
        'id' => 'heading_id',
      ),
      array(
        'name' => esc_html__( 'Video embed code', 'linx' ),
        'id' => "{$prefix}pf_video_data",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 4,
      ),
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Gallery Format', 'linx' ),
        'id' => 'heading_id',
      ),
      array(
        'name' => esc_html__( 'Gallery images', 'linx' ),
        'id' => "{$prefix}pf_gallery_data",
        'type' => 'image_advanced',
        'max_file_uploads' => 10,
      ),
      array(
        'type' => 'heading',
        'name' => esc_html__( 'Audio Format', 'linx' ),
        'id' => 'heading_id',
      ),
      array(
        'name' => esc_html__( 'Audio embed code', 'linx' ),
        'id' => "{$prefix}pf_audio_data",
        'type' => 'textarea',
        'cols' => 20,
        'rows' => 4,
      ),
    )
  );

  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'linx_register_meta_boxes' );
