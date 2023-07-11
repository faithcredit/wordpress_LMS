<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    if ( ! linx_show_hero() || linx_compare_options( linx_get_option( 'linx_hero_single_show_title', false ), rwmb_meta( 'linx_hero_single_show_title' ) ) == false ) {
      linx_entry_header( array( 'tag' => 'h1', 'link' => false ) );
    }
    get_template_part( 'inc/partials/action' );
  ?>
  
  <?php if ( ! linx_show_hero() ) :
    if ( ! get_post_format() && has_post_thumbnail() ) :
      linx_entry_media( array( 'layout' => 'post' ) );
    elseif ( get_post_format() == 'video' && rwmb_meta( 'linx_pf_video_data' ) != '' ) : ?>
      <div class="entry-media">
        <?php echo rwmb_meta( 'linx_pf_video_data' ); ?>
      </div> <?php
    elseif ( get_post_format() == 'gallery' ) :
      linx_entry_media( array( 'layout' => 'post', 'gallery' => true ) );
    elseif ( get_post_format() == 'audio' && rwmb_meta( 'linx_pf_audio_data' ) != '' ) : ?>
      <div class="entry-media">
        <?php echo rwmb_meta( 'linx_pf_audio_data' ); ?>
      </div> <?php
    endif;
  endif; ?>

  <div class="entry-wrapper">
    <div class="entry-content u-clearfix">
      <?php the_content(); ?>
    </div>
      
    <?php
      wp_link_pages( 'before=<div class="page-links">&after=</div>&link_before=<span>&link_after=</span>' );
      get_template_part( 'inc/partials/tags' );
      get_template_part( 'inc/partials/share' );
    ?>
  </div>
</article>
