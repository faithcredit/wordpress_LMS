<?php
include_once 'helpers/console.php';
include_once 'helpers/ajax.php';

function linx_child_scripts() {
  wp_enqueue_style( 'linx-style', get_template_directory_uri() . '/style.css', array(), LINX_VERSION );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'linx-style' ), LINX_VERSION );

  wp_enqueue_script( 'app-js', get_stylesheet_directory_uri().'/helpers/app.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'linx_child_scripts' );

/**
 * Load courses more...
 */
function courses_load_more() {

    $ajaxposts = new WP_Query([
      'post_type' => $_POST['post_type'],
      'post_status' => 'publish',
      'tax_query' => array(
          array(
              'taxonomy' => 'course_categories',
              'field' => 'slug',
              'terms' => $_POST['cat'],
          ),
      ),
      'paged' => $_POST['paged'],
      'posts_per_page' => 3,
      'orderby' => 'title',
      'order' => 'ASC',
    ]);


    //console($ajaxposts);
  
    $response = '';
  
    if($ajaxposts->have_posts()) {
      while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_template_part( 'template-parts/content', $ajaxposts->get_post_format() );							

      endwhile;
    } else {
      $response = '';
    }
  
    echo $response;
    exit;
  }
  add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
  add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');
























