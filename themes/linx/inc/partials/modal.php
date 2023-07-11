<?php
  $links = linx_sharing_links();
  $options = linx_get_option( 'linx_sharing_links', array( 'facebook', 'twitter', 'pinterest', 'google', 'email' ) );
?>

<div class="dimmer"></div>
<div class="modal">
  <div class="modal-thumbnail">
    <img class="lazyload" data-src="">
  </div>
  <h6 class="modal-title"></h6>
  <div class="modal-share">
    <?php foreach ( $options as $option ) : ?>
      <a class="<?php echo esc_attr( $option ); ?>" href="#" target="_blank">
        <i class="mdi mdi-<?php echo esc_attr( $links[ $option ]['icon'] ); ?>"></i>
      </a>
    <?php endforeach; ?>
  </div>
  <form class="modal-form inline">
    <input class="modal-permalink inline-field" type="text" value="">
    <button data-clipboard-text="" type="submit"><i class="mdi mdi-content-copy"></i></button>
  </form>
</div>