<?php class LINX_Category_Walker extends Walker {

  var $db_fields = array(
    'parent' => 'parent', 
    'id' => 'term_id' 
  );

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $color = get_term_meta( $item->term_id, 'category_color', true );
    $output .= sprintf( '<a style="background-color: %s;" href="%s" rel="category">%s</a>', $color, get_category_link( $item->term_id ), $item->name );
  }

} ?>