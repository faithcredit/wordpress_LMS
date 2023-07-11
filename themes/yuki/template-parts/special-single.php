<?php
/**
 * The template part for single post.
 *
 * @package Yuki
 */

use LottaFramework\Facades\CZ;
use LottaFramework\Utils;

$layout = 'no-sidebar';

if ( CZ::checked( 'yuki_post_sidebar_section' ) ) {
	$layout = CZ::get( 'yuki_post_sidebar_layout' );
}

?>

<?php
/**
 * Hook - yuki_action_before_single_post_container.
 */
do_action( 'yuki_action_before_single_post_container' );
?>

<div class="<?php Utils::the_clsx( yuki_container_css( $layout ) ) ?>">
    <div id="content" class="flex-grow max-w-full">
		<?php
		// posts loop
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook - yuki_action_before_single_post.
			 */
			do_action( 'yuki_action_before_single_post' );

			/**
			 * Hook - yuki_action_single_post.
			 */
			do_action( 'yuki_action_single_post' );

			/**
			 * Hook - yuki_action_after_single_post.
			 */
			do_action( 'yuki_action_after_single_post' );
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

