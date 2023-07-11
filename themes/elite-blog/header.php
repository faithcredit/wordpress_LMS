<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elite_Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php $image = get_the_post_thumbnail_url( get_the_ID() ); ?>
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'elite-blog' ); ?></a>

		<div id="loader" class="loader-1">
			<div class="loader-container">
				<div id="preloader">
				</div>
			</div>
		</div><!-- #loader -->

		<header id="masthead" class="site-header">
			<div class="navigation-outer-wrapper">
				<div class="elite-blog-navigation">
					<div class="section-wrapper"> 
						<div class="elite-blog-navigation-container">
							<div class="site-branding">
								<div class="site-logo">
									<?php the_custom_logo(); ?>
								</div>
								<div class="site-identity">
									<?php
									if ( is_front_page() && is_home() ) :
										?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php
									else :
										?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php
									endif;
									$elite_blog_description = get_bloginfo( 'description', 'display' );
									if ( $elite_blog_description || is_customize_preview() ) :
										?>
										<p class="site-description"><?php echo $elite_blog_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
									<?php endif; ?>
								</div>	
							</div>
							<div class="nav-wrapper">
								<nav id="site-navigation" class="main-navigation">
									<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
										<span class="ham-icon"></span>
										<span class="ham-icon"></span>
										<span class="ham-icon"></span>
										<i class="fa fa-bars" aria-hidden="true"></i>
									</button>
									<div class="navigation-area">
										<?php
										if ( has_nav_menu( 'primary' ) ) {

											wp_nav_menu(
												array(
													'theme_location' => 'primary',
													'menu_id' => 'primary-menu',
												)
											);
										}
										?>
									</div>
								</nav><!-- #site-navigation -->
								<div class="elite-blog-header-search">
									<div class="header-search-wrap">
										<a href="#" class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></a>
										<div class="header-search-form">
											<?php get_search_form(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end of navigation -->
		</header><!-- #masthead -->

	<?php
	if ( ! is_front_page() || is_home() ) {
		if ( is_front_page() ) {

			require get_template_directory() . '/sections/sections.php';
			elite_blog_homepage_sections();

		}
		?>
		<div class="elite-blog-main-wrapper">
			<div class="section-wrapper">
				<div class="elite-blog-container-wrapper">
				<?php } ?>
