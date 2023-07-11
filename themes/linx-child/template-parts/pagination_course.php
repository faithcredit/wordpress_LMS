<?php
global $wp_query;
$max_pages = $wp_query->max_num_pages;
?>

<div class="infinite-scroll-course-status">
    <div class="infinite-scroll-course-request"></div>
</div>
<div class="infinite-scroll-course-action">
    <div class="infinite-scroll-course-button button" data-paged="1" data-max-pages="<?php echo $max_pages; ?>"><?php echo apply_filters( 'linx_infinite_button_load', esc_html__( 'Load more', 'linx' ) ); ?></div>
</div>

