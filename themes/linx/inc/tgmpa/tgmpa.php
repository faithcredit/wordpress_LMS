<?php

function linx_register_required_plugins() {

  $plugins = array(
    array(
      'name' => esc_html__( 'LINX Essentials', 'linx' ),
      'slug' => 'linx-essentials',
      'source' => get_template_directory() . '/inc/plugins/linx-essentials.zip',
      'required' => true,
      'version' => '1.2',
    ),
    array(
      'name' => esc_html__( 'Kirki', 'linx' ),
      'slug' => 'kirki',
      'required' => true,
    ),
    array(
      'name' => esc_html__( 'Meta Box', 'linx' ),
      'slug' => 'meta-box',
      'required' => true,
    ),
    array(
      'name' => esc_html__( 'WP Instagram Widget', 'linx' ),
      'slug' => 'wp-instagram-widget',
      'required' => true,
    ),
  );

  if ( linx_get_option( 'linx_disable_recommended_plugins', false ) == false ) {
    $plugins[] = array(
      'name' => esc_html__( 'Contact Form 7', 'linx' ),
      'slug' => 'contact-form-7',
      'required' => false,
    );

    $plugins[] = array(
      'name' => esc_html__( 'One Click Demo Import', 'linx' ),
      'slug' => 'one-click-demo-import',
      'required' => false,
    );
  }

  $config = array(
    'id' => 'tgmpa',
    'default_path' => '',
    'menu' => 'tgmpa-install-plugins',
    'parent_slug' => 'themes.php',
    'capability' => 'edit_theme_options',
    'has_notices' => true,
    'dismissable' => false,
    'is_automatic' => true,
  );

  tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'linx_register_required_plugins' );
