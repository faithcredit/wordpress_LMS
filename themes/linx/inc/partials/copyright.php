<?php if ( linx_get_option( 'linx_copyright_text', '' ) != '' ) : ?>
  <div class="site-info">
    <?php echo wp_kses( linx_get_option( 'linx_copyright_text', '' ), array(
      'a'      => array( 'href' => array(), 'target' => array() ),
      'span'   => array( 'style' => array() ),
      'img'    => array( 'src' => array(), 'alt' => array() ),
      'i'      => array( 'class' => array(), 'style' => array() ),
      'em'     => array(),
      'strong' => array(),
      'p'      => array(),
      'br'     => array(),
    ) ); ?>
  </div>
<?php endif; ?>
