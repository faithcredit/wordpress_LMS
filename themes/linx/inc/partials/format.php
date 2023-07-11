<?php
  $format = get_post_format();

  switch ( $format ) {
    case 'video' : ?>
      <div class="entry-format">
        <i class="mdi mdi-youtube-play"></i>
      </div>
      <?php break;
    case 'gallery' : ?>
      <div class="entry-format">
        <i class="mdi mdi-image-multiple"></i>
      </div>
      <?php break;
    case 'audio' : ?>
      <div class="entry-format">
        <i class="mdi mdi-music"></i>
      </div>
      <?php break;
  }
?>
