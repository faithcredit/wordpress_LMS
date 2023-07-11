<?php 

//     ████████
//   ██        ▊
//   ██
//   ██
//   ██
//   ██        ▊
//     ████████
// ajax fetch function : Client Side
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">

    function ajax_send_req(type/*='post'*/, dataType/*='html'*/, action/*='data_fetch'*/, data, callback){

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type,
            dataType,
            data: {
                action,
                data,
            },
            success: function(res) {
                callback(res);
            },
            error: function() {
                alert('ajax-error!');
            }
        });
    }
</script>

<?php
}


//     ████████
//   ██        ▊
//   ██
//     ████████
//             ██
//   ██        ██      
//    █████████    
// the ajax function : Server Side
add_action('wp_ajax_course_data_fetch' , 'course_data_fetch');
add_action('wp_ajax_nopriv_course_data_fetch','course_data_fetch');
function course_data_fetch(){

    $ajaxposts = new WP_Query([
        'post_type' => 'courses',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'course_categories',
                'field' => 'slug',
                'terms' => $_POST['data']['cat'],
            ),
        ),
        'paged' => $_POST['data']['paged'],
        'posts_per_page' => 3,
        'orderby' => 'title',
        'order' => 'ASC',
      ]);

    $response = '';
    
    if($ajaxposts->have_posts()) {
        while($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $response .= get_template_part( 'template-parts/content', get_post_format() );
        endwhile;
    } else {
        $response = '';
    }

    echo $response;

    exit;

    // die();
}

/*
add_action( 'wp_ajax_my_action', 'my_action_callback' );

function my_action_callback() {
    // Handle AJAX request here
    wp_send_json( array( 'success' => true ) );
}
*/