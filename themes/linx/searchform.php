<form method="get" class="search-form inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input type="search" class="search-field inline-field" placeholder="<?php echo apply_filters( 'linx_search_field_placeholder', esc_html__( 'Enter keyword...', 'linx' ) ); ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ) ?>" name="s" required="true">
  <button type="submit" class="search-submit"><i class="mdi mdi-magnify"></i></button>
</form>
