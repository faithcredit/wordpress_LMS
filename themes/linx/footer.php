	</div>

	<?php
		dynamic_sidebar( 'sidebar-2' );

		if ( linx_get_option( 'linx_enable_social_bar', false ) == true ) {
			get_template_part( 'inc/partials/social-bar' );
		}

		linx_ads( array( 'location' => 'before_footer' ) );
	?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<footer class="site-footer">
			<div class="widget-footer container">
				<div class="row">
					<div class="col-md-5">
						<?php
							linx_logo( array( 'contrary' => false ) );
							get_template_part( 'inc/partials/copyright' );
							get_template_part( 'inc/partials/social' );
						?>
					</div>
					<div class="col-md-7">
						<div class="row">
							<?php dynamic_sidebar( 'sidebar-3' ); ?>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<?php elseif ( linx_get_option( 'linx_copyright_text', '' ) != '' ) : ?>
		<footer class="site-footer">
			<?php get_template_part( 'inc/partials/copyright' ); ?>
		</footer>
	<?php endif; ?>
</div>

<?php
	get_template_part( 'inc/partials/modal' );
	wp_footer();
?>

</body>
</html>
