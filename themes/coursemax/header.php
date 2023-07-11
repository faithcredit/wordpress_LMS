<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coursemax
 */



$coursemax_options = coursemax_theme_options();

$header_button_txt = $coursemax_options['header_button_txt'];
$header_button_url = $coursemax_options['header_button_url'];
$site_title_show = $coursemax_options['site_title_show'];


?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'coursemax' ); ?></a>


<div class="main-wrap">
	<header id="masthead" class="site-header">

		<div class="container">
             <div class="row">
				 <div class="col-md-12">
				<div class="site-branding">
					<?php
					the_custom_logo(); 

				 ?>
				<?php  if($site_title_show == 1) { ?>
					<div class="logo-wrap">

					<?php

					if ( is_front_page() && is_home() ) :
						?>
						<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
						<?php
					else :
						?>
						<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
						<?php
					endif;
					$coursemax_description = get_bloginfo( 'description', 'display' );
					if ( $coursemax_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $coursemax_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
					</div>
			

					<?php } ?>

					
	                

			
				</div><!-- .site-branding -->


			<div id="mobile-menu-wrap">
            <!-- Collect the nav links, forms, and other content for toggling -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
	                        data-target="#navbar-collapse" aria-expanded="false">
	                    <span class="sr-only"><?php echo esc_html__('Toggle navigation','coursemax'); ?></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	            </button>
	            <div class="collapse navbar-collapse" id="navbar-collapse">

	             <?php
	                if (has_nav_menu('primary')) { ?>
	                <?php
	                    wp_nav_menu(array(
	                        'theme_location' => 'primary',
	                        'container' => '',
	                        'menu_class' => 'nav navbar-nav navbar-right',
	                        'menu_id' => 'menu-main',
	                        'walker' => new coursemax_nav_walker(),
	                        'fallback_cb' => 'coursemax_nav_walker::fallback',
	                    ));

	                    ?>

	                <?php } else { ?>
	                    <nav id="site-navigation" class="main-navigation clearfix">
	                        <?php   wp_page_menu(array('menu_class' => 'menu','menu_id' => 'menuid')); ?>
	                    </nav>
	                <?php } ?>

					<?php  if( $header_button_txt && $header_button_url):?>
				<a href="<?php echo esc_url($header_button_url); ?>" class="header-btn btn btn-default"><?php echo esc_html($header_button_txt); ?></a>
				<?php endif; ?>		

	            </div>
				</div><!-- End navbar-collapse -->

				

	            </div>
			</div>
		</div>
	</header><!-- #masthead -->

	<!-- /main-wrap -->

