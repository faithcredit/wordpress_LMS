<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php linx_ads( array( 'location' => 'before_header' ) ); ?>

<div class="site">
	<header class="site-header">
		<?php get_template_part( 'inc/partials/navigation-bar' ); ?>
	</header>
	<div class="header-gap"></div>

	<div class="off-canvas">
		<div class="mobile-menu"></div>
		<div class="close"><i class="mdi mdi-close"></i></div>
	</div>

	<?php
		if ( linx_show_hero() ) {
			get_template_part( 'inc/partials/hero' );
		}

		linx_ads( array( 'location' => 'after_header' ) );

		if ( linx_show_featured() ) {
			get_template_part( 'inc/partials/featured-posts' );
		}

		if ( linx_show_instagram() ) {
			dynamic_sidebar( 'sidebar-4' );
		}

		if ( linx_show_category_boxes() ) {
			get_template_part( 'inc/partials/category-boxes' );
		}
	?>

	<div class="site-content container">
