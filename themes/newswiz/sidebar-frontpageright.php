<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Newswiz
 */

if ( ! is_active_sidebar( 'front-right-page-sidebar' ) ) {
	return;
}

if ( is_active_sidebar( 'front-left-page-sidebar' ) ) { ?>
	<aside class="col-md-3 col-sm-3">
	<div id="sidebar-right" class="mg-sidebar">
		<?php dynamic_sidebar( 'front-right-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->


<?php } else { ?>

<aside class="col-md-4 col-sm-4">
	<div id="sidebar-right" class="mg-sidebar">
		<?php dynamic_sidebar( 'front-right-page-sidebar' );
		 ?>
	</div>
</aside><!-- #secondary -->
<?php } ?>
