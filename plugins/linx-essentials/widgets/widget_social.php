<?php

class LINX_Social_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'linx_social_widget',
      esc_html__( 'LINX: Social Links', 'linx' ),
      array( 'description' => esc_html__( 'Displays social links.', 'linx' ), )
    );
  }

  public function widget( $args, $instance ) {
    extract( $args );
    $title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Social Links', 'linx' );
    $brand_color = ! empty( $instance['brand_color'] ) ? 1 : 0;

    echo $before_widget;
    if ( ! empty( $title ) ) {
      echo $before_title . $title . $after_title;
    }

    $data = linx_social_links();

    ob_start(); ?>

    <div class="links">
      <?php foreach ( $data as $d ) : ?>

        <?php if ( linx_get_option( 'linx_' . $d['option'], '' ) != '' ) :
          $style = $brand_color ? 'color: ' . $d['color'] . ';' : ''; ?>
          <a href="<?php echo esc_url( linx_get_option( 'linx_' . $d['option'], '' ) ); ?>" target="_blank">
            <i class="mdi mdi-<?php echo esc_attr( $d['icon'] ); ?>" style="<?php echo esc_attr( $style ); ?>"></i>
            <span><?php echo esc_html( $d['name'] ); ?></span>
          </a>
        <?php endif; ?>

      <?php endforeach; ?>
    </div>

    <?php

    echo ob_get_clean();
    echo $after_widget;
  }

  public function form( $instance ) {
    $defaults = array(
      'title' => esc_html__( 'Social Links', 'linx' ),
      'brand_color' => 0,
    );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'linx' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>
    <p>
			<input class="checkbox" <?php checked( $instance['brand_color'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'brand_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'brand_color' ) ); ?>" type="checkbox">
			<label for="<?php echo esc_attr( $this->get_field_id( 'brand_color' ) ); ?>"><?php esc_html_e( 'Brand color?', 'linx' ); ?></label>
		</p>

    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['brand_color'] = ( ! empty( $new_instance['brand_color'] ) ) ? 1 : 0;

    return $instance;
  }

}
