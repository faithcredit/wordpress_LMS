<?php

// Popular Posts Widget.
require get_template_directory() . '/inc/widgets/popular-posts-widget.php';

// Trending Posts Widget.
require get_template_directory() . '/inc/widgets/trending-posts-widget.php';

// Author Info Widget.
require get_template_directory() . '/inc/widgets/info-author-widget.php';

// Social Icons Widget.
require get_template_directory() . '/inc/widgets/social-icons-widget.php';

/**
 * Register Widgets
 */
function elite_blog_register_widgets() {

	register_widget( 'Elite_Blog_Popular_Posts_Widget' );

	register_widget( 'Elite_Blog_Trending_Posts_Widget' );

	register_widget( 'Elite_Blog_Author_Info_Widget' );

	register_widget( 'Elite_Blog_Social_Icons_Widget' );

}
add_action( 'widgets_init', 'elite_blog_register_widgets' );
