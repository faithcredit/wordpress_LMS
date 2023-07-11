<?php
/**
 * Open HTML document
 *
 * @package Yuki
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php yuki_html_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>
        data-yuki-scroll-reveal="<?php echo esc_attr( wp_json_encode( yuki_scroll_reveal_args() ) ); ?>">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content">
	<?php esc_html_e( 'Skip to content', 'yuki' ); ?>
</a>
