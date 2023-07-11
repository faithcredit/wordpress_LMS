<?php
/**
 * The template part for pages.
 *
 * @package Yuki
 */

use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

$layout = 'no-sidebar';

if ( ( ! is_front_page() || is_home() ) && CZ::checked( 'yuki_page_sidebar_section' ) ) {
	$layout = CZ::get( 'yuki_page_sidebar_layout' );
}

?>

<?php
/**
 * Hook - yuki_action_before_page_container.
 */
do_action( 'yuki_action_before_page_container' );
?>

<div class="<?php Utils::the_clsx( yuki_container_css( $layout ) ) ?>">
    <div id="content" class="flex-grow max-w-full">
		<?php
		// posts loop
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook - yuki_action_before_page.
			 */
			do_action( 'yuki_action_before_page' );

			/**
			 * Hook - yuki_action_page.
			 */
			do_action( 'yuki_action_page' );

			/**
			 * Hook - yuki_action_after_page.
			 */
			do_action( 'yuki_action_after_page' );
		}
		?>
    </div>

	<?php
	/**
	 * Hook - yuki_action_sidebar.
	 */
	do_action( 'yuki_action_sidebar', $layout );
	?>
</div>

