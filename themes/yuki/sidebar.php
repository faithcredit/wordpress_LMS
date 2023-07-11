<?php
/**
 * The default primary sidebar.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yuki
 */

use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

$default_sidebar = apply_filters( 'yuki_filter_default_sidebar_id', 'primary-sidebar', 'primary' );
$attrs           = [
	'class' => 'yuki-sidebar sidebar-primary prose prose-yuki shrink-0 yuki-heading yuki-heading-' . CZ::get( 'yuki_global_sidebar_title-style' ),
	'role'  => 'complementary',
];

if ( is_customize_preview() ) {
	$attrs['data-shortcut']          = 'border';
	$attrs['data-shortcut-location'] = 'yuki_global:yuki_global_sidebar_section';
}

?>

<?php if ( is_active_sidebar( $default_sidebar ) ): ?>
    <div <?php Utils::print_attribute_string( $attrs ); ?>>
		<?php dynamic_sidebar( $default_sidebar ); ?>
    </div>
<?php endif; ?>

