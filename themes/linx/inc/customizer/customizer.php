<?php

if ( class_exists( 'LINX_Kirki' ) ) {
  $kirki_prefix = 'linx_';

  LINX_Kirki::add_config( 'linx', array(
    'option_type' => 'option',
    'option_name' => 'linx_admin_options',
  	'capability'  => 'edit_theme_options',
  ) );

  require_once get_template_directory() . '/inc/customizer/general-settings.php';
  require_once get_template_directory() . '/inc/customizer/header-logo.php';
  require_once get_template_directory() . '/inc/customizer/hero-section.php';
  require_once get_template_directory() . '/inc/customizer/featured-content.php';
  require_once get_template_directory() . '/inc/customizer/category-boxes.php';
  require_once get_template_directory() . '/inc/customizer/post-settings.php';
  require_once get_template_directory() . '/inc/customizer/social-links.php';
  require_once get_template_directory() . '/inc/customizer/footer-settings.php';
  require_once get_template_directory() . '/inc/customizer/ads-settings.php';

  function linx_kirki_config( $config ) {
    return wp_parse_args( array(
      'disable_loader' => true,
    ), $config );
  }
  add_filter( 'kirki_config', 'linx_kirki_config' );
}
