<?php
$coursemax_options = coursemax_theme_options();

$blog_show = $coursemax_options['blog_show'];
$blog_section_title = $coursemax_options['blog_title'];
$blog_desc = $coursemax_options['blog_desc'];
$blog_category = $coursemax_options['blog_category'];
$content_length = '100';
if($blog_show) {

    if (1 == $blog_show):
        if ($blog_category == 'none') {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',

            );
        } else {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => array( $blog_category ),
                    ),
                ),
            );
        } ?>
        <div class="blog-section section">
            <div class="container">
                <div class="row">
                    <?php if ($blog_section_title || $blog_desc): ?>
                        <div class="section-title">
                            <?php


                            
                            if ($blog_section_title)
                                echo '<h2>' . esc_html($blog_section_title) . '</h2>';
                                if ($blog_desc)
                                echo '<p>' . esc_html($blog_desc) . '</p>';
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
             </div>

             <div class="container">
                <div class="row"> 
                <?php $recent_query = new WP_Query($args);
                    if ($recent_query->have_posts()) :
                    ?>


                        <?php
                        while ($recent_query->have_posts()) : $recent_query->the_post();
                        global $post;
                            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $image = wp_get_attachment_image_src($post_thumbnail_id, 'coursemax-blog-thumbnail-img');
                            $content = get_the_content();
  

                            if (!empty($image)) {
                                $image_style = "style='background-image:url(" . esc_url($image[0]) . ")'";
                            } else {
                                $image_style = '';
                            }
                            ?>
                            <div class="col-md-4 col-sm-4">
                                <div class="blog-wrap">
                                  <img src="<?php echo esc_url($image[0]); ?>" alt="" />
                                  <div class="date"><span class="day"><?php echo get_the_time('d') ?></span><span class="month"><?php echo get_the_time('M') ?></span></div>
                                  <figcaption>
                                    <h3><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo wp_kses_post(coursemax_get_excerpt($recent_query->post->ID, $content_length)); ?></p>

                                  </figcaption>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php
                    endif; ?>
                </div>
             </div>
        </div>
        <?php
        
    endif;
}
