<?php $data = linx_social_links(); ?>
<div style="display: none;">

<div class="social-links">
  <?php foreach ( $data as $d ) : ?>

    <?php if ( linx_get_option( 'linx_' . $d['option'], '' ) != '' ) : ?>
      <a href="<?php echo esc_url( linx_get_option( 'linx_' . $d['option'], '' ) ); ?>" title="<?php echo esc_attr( $d['name'] ); ?>" target="_blank" rel="noopener noreferrer">
        <i class="mdi mdi-<?php echo esc_attr( $d['icon'] ); ?>"></i>
      </a>
    <?php endif; ?>

  <?php endforeach; ?>
</div>
</div>