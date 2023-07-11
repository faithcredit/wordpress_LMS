<?php
/** Plugin Name: Sandboxltc CPT plugin
**/
//// Create courses CPT
function courses_post_type() {
    $labels = array(
      'name'               => _x( 'Courses', 'post type general name' ),
      'singular_name'      => _x( 'Course', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'course' ),
      'add_new_item'       => __( 'Add New Course' ),
      'edit_item'          => __( 'Edit Course' ),
      'new_item'           => __( 'New Course' ),
      'all_items'          => __( 'All Courses' ),
      'view_item'          => __( 'View Course' ),
      'search_items'       => __( 'Search Courses' ),
      'not_found'          => __( 'No courses found' ),
      'not_found_in_trash' => __( 'No courses found in the Trash' ), 
      'parent_item_colon'  => '’',
      'name_admin_bar'     => __( 'Courses' ),
      'menu_name'          => __( 'Courses' ),
    );
    $args = array(
      'labels'             => $labels,
      'description'        => 'Holds our products and product specific data',
      'public'             => true,
      'menu_position'      => 3,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'        => true,
      'show_in_rest'       => true,
      'rewrite'            => array( 'slug' => 'courses' ),
      'menu_icon'          => 'dashicons-media-spreadsheet',
      //'taxonomies'    => array('cuisines', 'post_tag') // this is IMPORTANT
    );
    register_post_type( 'courses', $args ); 
}
add_action( 'init', 'courses_post_type' );

//// Add cources taxonomy
function create_cources_taxonomy() {
    $labels = array(
      'name' => _x( 'Categories', 'taxonomy general name' ),
      'singular_name'      => _x( 'Category', 'taxonomy singular name' ),
      'menu_name'          => __( 'Categories' ),
      'all_items'          => __( 'All Categories' ),
      'edit_item'          => __( 'Edit Category' ), 
      'update_item'        => __( 'Update Category' ),
      'add_new_item'       => __( 'Add Category' ),
      'new_item_name'      => __( 'New Category' ),
    );
    $args = array(
      'labels'             => $labels,
      'hierarchical'       => true,
      'show_ui'            => true,
      'show_in_rest'       => true,
      'show_admin_column'  => true,
    );
    register_taxonomy( 'course_categories', 'courses', $args ); 

    $labels = array(
      'name' => _x( 'Tags', 'taxonomy general name' ),
      'singular_name'      => _x( 'Tag', 'taxonomy singular name' ),
      'menu_name'          => __( 'Tags' ),
      'all_items'          => __( 'All Tags' ),
      'edit_item'          => __( 'Edit Tag' ), 
      'update_item'        => __( 'Update Tag' ),
      'add_new_item'       => __( 'Add Tag' ),
      'new_item_name'      => __( 'New Tag' ),
      );
      $args = array(
      'labels'             => $labels,
      'hierarchical'       => false,
      'show_ui'            => true,
      'show_in_rest'       => true,
      'show_admin_column'  => true,
    );
    register_taxonomy( 'tags', 'courses', $args ); 
}
add_action( 'init', 'create_cources_taxonomy', 0 );

//// Create sections CPT
function sections_post_type() {
    $labels = array(
      'name'               => _x( 'Sections', 'post type general name' ),
      'singular_name'      => _x( 'Section', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'section' ),
      'add_new_item'       => __( 'Add New Sections' ),
      'edit_item'          => __( 'Edit Section' ),
      'new_item'           => __( 'New Section' ),
      'all_items'          => __( 'All Sections' ),
      'view_item'          => __( 'View Section' ),
      'search_items'       => __( 'Search Sections' ),
      'not_found'          => __( 'No Sections found' ),
      'not_found_in_trash' => __( 'No Sections found in the Trash' ), 
      'parent_item_colon'  => '’',
      'name_admin_bar'     => __( 'Sections' ),
      'menu_name'          => __( 'Sections' ),
    );
    $args = array(
      'labels'             => $labels,
      'description'        => 'Holds our products and product specific data',
      'public'             => true,
      'menu_position'      => 7,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'        => true,
      'show_in_rest'       => true,
      'rewrite'            => array( 'slug' => 'sections' ),
      'menu_icon'          => 'dashicons-media-document',
      //'taxonomies'    => array('cuisines', 'post_tag') // this is IMPORTANT
    );
    register_post_type( 'sections', $args ); 
}
add_action( 'init', 'sections_post_type' );

//// Create lessons CPT
function lessons_post_type() {
    $labels = array(
      'name'               => _x( 'Lessons', 'post type general name' ),
      'singular_name'      => _x( 'Lesson', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'lesson' ),
      'add_new_item'       => __( 'Add New Lessons' ),
      'edit_item'          => __( 'Edit Lesson' ),
      'new_item'           => __( 'New Lesson' ),
      'all_items'          => __( 'All Lessons' ),
      'view_item'          => __( 'View Lesson' ),
      'search_items'       => __( 'Search Lessons' ),
      'not_found'          => __( 'No Lessons found' ),
      'not_found_in_trash' => __( 'No Lessons found in the Trash' ), 
      'parent_item_colon'  => '’',
      'name_admin_bar'     => __( 'Lessons' ),
      'menu_name'          => __( 'Lessons' ),
    );
    $args = array(
      'labels'             => $labels,
      'description'        => 'Holds our products and product specific data',
      'public'             => true,
      'menu_position'      => 8,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'        => true,
      'show_in_rest'       => true,
      'rewrite'            => array( 'slug' => 'lessons' ),
      'menu_icon'          => 'dashicons-text-page',
      //'taxonomies'    => array('cuisines', 'post_tag') // this is IMPORTANT
    );
    register_post_type( 'lessons', $args ); 
}
add_action( 'init', 'lessons_post_type' );

//// re-order Admin Menubar items
function dgtlnk_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;
    return array(
      'index.php', // Dashboard
      'separator1', // First separator
      'edit.php?post_type=courses', // Courses
      'edit.php?post_type=sections', // Sections
      'edit.php?post_type=lessons', // Lessons
      'separator2', // Second separator
    );
}
add_filter( 'custom_menu_order', 'dgtlnk_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'dgtlnk_custom_menu_order', 10, 1 );
