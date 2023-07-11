<?php
  $website = get_the_author_meta( 'user_url' );
  $facebook = get_the_author_meta( 'facebook' );
  $twitter = get_the_author_meta( 'twitter' );
  $instagram = get_the_author_meta( 'instagram' );
  $pinterest = get_the_author_meta( 'pinterest' );
  $google = get_the_author_meta( 'google' );
  $linkedin = get_the_author_meta( 'linkedin' );
  $email = get_the_author_meta( 'user_email' );
?>

<?php if ( get_the_author_meta( 'description' ) != '' && linx_get_option( 'linx_disable_author_box', false ) == false ) : ?>
  <div class="about-author">
    <div class="author-image">
      <?php echo get_avatar( get_the_author_meta( 'email' ), '140', null, get_the_author_meta( 'display_name' ) ); ?>
    </div>

    <div class="author-info">
      <h4 class="author-name">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
      </h4>

      <div class="author-bio"><?php the_author_meta( 'description' ); ?></div>

      <?php if ( $email != '' || $website != '' || $facebook != '' || $twitter != '' || $instagram != '' || $pinterest != '' || $google != '' || $linkedin != '' ) : ?>
        <div class="author-meta">
          <?php if ( $website != '' ) : ?>
            <a href="<?php echo esc_url( $website ); ?>" target="_blank"><i class="mdi mdi-web"></i></a>
          <?php endif; ?>
          <?php if ( $facebook != '' ) : ?>
            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="mdi mdi-facebook-box"></i></a>
          <?php endif; ?>
          <?php if ( $twitter != '' ) : ?>
            <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="mdi mdi-twitter-box"></i></a>
          <?php endif; ?>
          <?php if ( $instagram != '' ) : ?>
            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="mdi mdi-instagram"></i></a>
          <?php endif; ?>
          <?php if ( $pinterest != '' ) : ?>
            <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="mdi mdi-pinterest-box"></i></a>
          <?php endif; ?>
          <?php if ( $google != '' ) : ?>
            <a href="<?php echo esc_url( $google ); ?>" target="_blank"><i class="mdi mdi-google-plus-box"></i></a>
          <?php endif; ?>
          <?php if ( $linkedin != '' ) : ?>
            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="mdi mdi-linkedin-box"></i></a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
