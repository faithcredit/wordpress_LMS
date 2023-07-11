<?php
/**
 * Recommended Plugins Panel
 *
 * @package Newsup
 */
?>
<div id="recommended-plugins-panel" class="panel-left">
	<?php 
	$newsup_free_plugins = array(
		'one-click-demo-import' => array(
		    'name'     	=> 'Ansar Import',
			'slug'     	=> 'ansar-import',
			'filename' 	=> 'ansar-import.php',
		),
	);
	if( !empty( $newsup_free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $newsup_free_plugins as $newsup_plugin ) {
			$info 		= newsup_call_plugin_api( $newsup_plugin['slug'] ); ?>
			<div class="recom-plugin-wrap mb-0">
				<div class="plugin-title-install clearfix">
					<span class="title">
					<?php echo esc_html( $newsup_plugin['name'] ); ?>
					</span>
					<?php if($newsup_plugin['slug'] == 'ansar-import') : ?>
					<p><?php echo esc_html( 'First of all Install and activate','newsup'); ?> <a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/ansar-import/' ); ?>"><?php esc_html_e( 'Ansar Demo Import', 'newsup' ); ?></a>
					<?php echo esc_html('plugin. After that, activate the plugin then, visit','newsup');?>
					<a target="_blank" href="<?php echo esc_url( 'themes.php?page=ansar-demo-import' ); ?>"><?php echo esc_html('Ansar Demo Importer', 'newsup'); ?></a>
					<?php echo esc_html('in menu under Appearance.', 'newsup'); ?>
					<a target="_blank" href="<?php echo esc_url( 'https://docs.themeansar.com/docs/wordpress/how-to-import-demo-content/' ); ?>"><?php echo esc_html('Following Documentation', 'newsup'); ?></a>
				</p>
					<?php endif; ?>
					<?php echo '<div class="button-wrap">';
					echo Newsup_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $newsup_plugin['slug'] );
					echo '</div>';
					?>
				</div>
			</div>
			</br>
			<?php
		} ?>
		</div>
	<?php
	} ?>
</div>