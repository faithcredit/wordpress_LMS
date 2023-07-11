<?php

class LINX_Promo_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'linx_promo_widget',
			esc_html__( 'LINX: Promo', 'linx' ),
			array( 'description' => esc_html__( 'Displays a promo box.', 'linx' ), )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$image = isset( $instance['image'] ) ? $instance['image'] : '';
		$link = isset( $instance['link'] ) ? $instance['link'] : '';

		$before_widget = str_replace( 'class="', 'class="small-padding ', $before_widget );
		echo $before_widget;
		ob_start(); ?>

		<div class="promo lazyload" data-bg="<?php echo esc_url( $image ); ?>">
			<?php if ( ! empty( $link ) ) : ?>
				<a class="u-permalink" href="<?php echo esc_url( $link ); ?>"></a>
			<?php endif; ?>
			<h6 class="promo-title"><?php echo esc_html( $title ); ?></h6>
		</div> <?php

		echo ob_get_clean();
		echo $after_widget;
	}

	public function form( $instance ) {
		$defaults = array(
			'title' => '',
			'image' => '',
			'link' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'linx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image:', 'linx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['image'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'linx' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['link'] ); ?>" />
		</p> <?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

}
