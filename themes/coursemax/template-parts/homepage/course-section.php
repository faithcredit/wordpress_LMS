<?php
$coursemax_options = coursemax_theme_options();

$course_show = $coursemax_options['course_show'];
$course_title = $coursemax_options['course_title'];
$course_desc = $coursemax_options['course_desc'];
$all_course_btn = $coursemax_options['all_course_btn'];
$all_course_url = $coursemax_options['all_course_url'];
$content_length = '100';


if($course_show) {

    $args = array( 
        'post_type' =>              'lp_course', 
        'orderby' =>                'menu_order date', 
        'order' =>                  'DESC', 
        'posts_per_page' =>         4,

    ); 

    $query = new \WP_Query($args); ?>


    <div id="lms_courses_wrap" class="section course-grid fourcol">
    <div class="container">
                <div class="row">
                    <div class="col-md-8 text-left">
                    <?php if ($course_title || $course_desc): ?>
                        <div class="section-title">
                            <?php


                            
                            if ($course_title)
                                echo '<h2>' . esc_html($course_title) . '</h2>';
                                if ($course_desc)
                                echo '<p>' . esc_html($course_desc) . '</p>';
                            ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                    <?php  if( $all_course_btn && $all_course_url):?>
		        <a href="<?php echo esc_url($all_course_url); ?>" class="btn btn-default"><?php echo esc_html($all_course_btn); ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
		        <?php endif; ?>
                    </div>
                </div>
             </div>
        <div class="container">
    <?php $loop = 1;
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
        
     
        echo(($loop % 4 == 1 || $loop == 1) ? '<div class="row flex">' : '');



        $course_id = get_the_ID();
        

        $course_duration = get_post_meta( $course_id, '_lp_duration', true );
        $course_price = get_post_meta( $course_id, '_lp_price', true );
        $sale_price = get_post_meta( $course_id, '_lp_sale_price', true );
        $term_list = get_the_term_list( $course_id, 'course_category', '', ', ', '' ); 
        $currency = learn_press_get_currency_symbol();
        
        $course_thumbnai_id = get_post_thumbnail_id();
        $image = wp_get_attachment_image_src($course_thumbnai_id, 'coursemax-blog-thumbnail-img'); ?>

       
        
        

            <div class="courses-list-wrap">
                <div class="course-inner-wraps">
                <div class="courses-top">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($image[0]) ?>"></a>

                </div>

                <div class="lpr_course_inner_wrap">
                    <?php
                    if ($term_list != '') { ?>
                        <div class="entry-meta cmsmasters_cource_cat"><?php echo $term_list; ?></div>
                    <?php 
                    }  ?>
                    <header class="course_header">
                        <h4 class="course_title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo the_title() ?> </a></h4>
                    </header>

                   
                    
               
                


                     <div class="course-prices">
                        <?php if($course_price || $sale_price): ?>
                            <?php if($sale_price){ ?>

                                <span class="regular-price has-sale">
                            <?php } 

                            else { ?> 
                                <span class="regular-price"> 
                            <?php } ?>


                            <?php echo esc_html($currency); echo esc_html($course_price); ?></span>

                            <?php if($sale_price): ?>
                                <span class="sale-price"><?php echo esc_html($currency);echo esc_html($sale_price);?></span> 
                            <?php endif;
                        

                        else: ?>
                               <div class="cmsmasters_course_free"><?php echo esc_html__('Free', 'coursemax'); ?></div>
                        <?php endif;  ?>  
                    </div>
                </div> 
                </div> 
                
            </div>
        
         <?php



           echo(($loop % 4  == 0 && $loop != 1) ? '</div>' : '');
            $loop++; 

    endwhile;
    } ?>
</div>
    </div>
    <?php wp_reset_postdata();
}



