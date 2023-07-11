<?php
/*
Plugin Name: LINX Essentials
Description: The default plugin for LINX.
Version: 1.2
Author: MondoTheme
Author URI: http://themeforest.net/user/mondotheme/portfolio
*/

class LINX_Essentials {

  public function __construct() {
    add_action( 'widgets_init', array( $this, 'linx_register_widgets' ) );
    add_filter( 'user_contactmethods', array( $this, 'linx_add_links_to_author_profile' ), 10, 1 );
    add_filter( 'pt-ocdi/import_files', array( $this, 'linx_import_demo' ) );
    add_filter( 'pt-ocdi/after_import', array( $this, 'linx_assign_menu' ) );
    add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
  }

  public static function linx_action() {
    $like_count = get_post_meta( get_the_ID(), 'linx_like', true );
    $like_button_text = $like_count != '' ? $like_count : '0';

    $view_count = get_post_meta( get_the_ID(), 'linx_view', true );
    $view_button_text = $view_count != '' ? $view_count : '0'; ?>

    <div class="entry-action">
      <div>
        <a class="like" data-id="<?php echo esc_attr( get_the_ID() ); ?>" href="#"><i class="mdi mdi-thumb-up"></i><span class="count"><?php echo esc_html( $like_button_text ); ?></span></a>
        <a class="view" href="<?php echo esc_url( get_the_permalink() ) ?>"><i class="mdi mdi-eye"></i><span class="count"><?php echo esc_html( $view_button_text ); ?></span></a>
        <a class="comment" href="<?php echo esc_url( get_the_permalink() . '#comments' ) ?>"><i class="mdi mdi-comment"></i><span class="count"><?php echo esc_html( get_comments_number() ); ?></span></a>
      </div>
      <div>
        <a class="bookmark" href="#" data-url="<?php echo esc_url( 'https://getpocket.com/edit?url=' . urlencode( get_the_permalink() ) ); ?>">
          <i class="mdi mdi-bookmark"></i>
          <span><?php echo esc_html( apply_filters( 'linx_read_later_text', esc_html__( 'Read Later', 'linx' ) ) ); ?></span>
        </a>
        <a class="share" href="#" data-url="<?php echo esc_url( get_the_permalink() ); ?>" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-thumbnail="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>" data-image="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'linx_full_1130' ) ); ?>">
          <i class="mdi mdi-share"></i>
          <span><?php echo esc_html( apply_filters( 'linx_share_text', esc_html__( 'Share', 'linx' ) ) ); ?></span>
        </a>
      </div>
    </div> <?php
  }

  public static function linx_share() {
    $links = linx_sharing_links();
    $options = linx_get_option( 'linx_sharing_links', array( 'facebook', 'twitter', 'pinterest', 'google', 'email' ) ); ?>

    <div class="entry-share">
      <?php foreach ( $options as $option ) : ?>
        <a class="<?php echo esc_attr( $option ); ?>" href="<?php echo esc_url( $links[ $option ]['link'] ); ?>" target="_blank">
          <i class="mdi mdi-<?php echo esc_attr( $links[ $option ]['icon'] ); ?>"></i>
        </a>
      <?php endforeach; ?>
    </div> <?php
  }

  public function linx_register_widgets() {
    require_once 'widgets/widget_about.php';
    require_once 'widgets/widget_category.php';
    require_once 'widgets/widget_facebook.php';
    require_once 'widgets/widget_picks.php';
    require_once 'widgets/widget_posts.php';
    require_once 'widgets/widget_promo.php';
    require_once 'widgets/widget_social.php';

    register_widget( 'LINX_About_Widget' );
    register_widget( 'LINX_Category_Widget' );
    register_widget( 'LINX_Facebook_Widget' );
    register_widget( 'LINX_Picks_Widget' );
    register_widget( 'LINX_Posts_Widget' );
    register_widget( 'LINX_Promo_Widget' );
    register_widget( 'LINX_Social_Widget' );
  }

  public function linx_add_links_to_author_profile( $contactmethods ) {
    $contactmethods['facebook'] = esc_html__( 'Facebook', 'linx' );
    $contactmethods['twitter'] = esc_html__( 'Twitter', 'linx' );
    $contactmethods['instagram'] = esc_html__( 'Instagram', 'linx' );
    $contactmethods['pinterest'] = esc_html__( 'Pinterest', 'linx' );
    $contactmethods['google'] = esc_html__( 'Google+', 'linx' );
    $contactmethods['linkedin'] = esc_html__( 'LinkedIn', 'linx' );

    return $contactmethods;
  }

  public function linx_import_demo() {
    return array(
      array(
        'import_file_name' => esc_html__( 'Demo 1', 'linx' ),
        'import_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-1.xml',
        'import_widget_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-1.wie',
        'import_customizer_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-1.dat',
        'import_preview_image_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-1.jpg',
        'preview_url' => 'http://linx.mondotheme.com/demo-1',
      ),
      array(
        'import_file_name' => esc_html__( 'Demo 2', 'linx' ),
        'import_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-2.xml',
        'import_widget_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-2.wie',
        'import_customizer_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-2.dat',
        'import_preview_image_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-2.jpg',
        'preview_url' => 'http://linx.mondotheme.com/demo-2',
      ),
      array(
        'import_file_name' => esc_html__( 'Demo 3', 'linx' ),
        'import_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-3.xml',
        'import_widget_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-3.wie',
        'import_customizer_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-3.dat',
        'import_preview_image_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-3.jpg',
        'preview_url' => 'http://linx.mondotheme.com/demo-3',
      ),
      array(
        'import_file_name' => esc_html__( 'Demo 4', 'linx' ),
        'import_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-4.xml',
        'import_widget_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-4.wie',
        'import_customizer_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-4.dat',
        'import_preview_image_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-4.jpg',
        'preview_url' => 'http://linx.mondotheme.com/demo-4',
      ),
      array(
        'import_file_name' => esc_html__( 'Demo 5', 'linx' ),
        'import_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-5.xml',
        'import_widget_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-5.wie',
        'import_customizer_file_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-5.dat',
        'import_preview_image_url' => 'https://s3.us-east-2.amazonaws.com/mondotheme/linx/demo-5.jpg',
        'preview_url' => 'http://linx.mondotheme.com/demo-5',
      ),
    );
  }

  public function linx_assign_menu() {
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array( 'menu-1' => $main_menu->term_id ) );
  }

}

$linx_essentials = new LINX_Essentials();
