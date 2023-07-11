<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newswiz
 */

if ( ! is_active_sidebar( 'front-left-page-sidebar' ) ) {
	return;
}

if ( is_active_sidebar( 'front-right-page-sidebar' ) ) { ?>
	<aside class="col-md-3">
	<div id="sidebar-left" class="mg-sidebar">
		<?php dynamic_sidebar( 'front-left-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->
<?php } else { ?>
<aside class="col-md-4">
	<div id="sidebar-left" class="mg-sidebar">
		<?php dynamic_sidebar( 'front-left-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->
<?php } ?>
