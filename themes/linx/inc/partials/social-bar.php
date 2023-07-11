<?php $data = linx_social_links(); ?>
<div style="display: none;">
<div class="social-bar">
  <?php foreach ( $data as $d ) : ?>

    <?php if ( linx_get_option( 'linx_' . $d['option'], '' ) != '' ) : ?>
      <a href="<?php echo esc_url( linx_get_option( 'linx_' . $d['option'], '' ) ); ?>" target="_blank">
        <i class="mdi mdi-<?php echo esc_attr( $d['icon'] ); ?>"></i>
        <span class="hidden-xs hidden-sm"><?php echo esc_html( $d['name'] ); ?></span>
      </a>
    <?php endif; ?>

  <?php endforeach; ?>
</div>
</div>
