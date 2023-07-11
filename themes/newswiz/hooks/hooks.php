<?php if(!function_exists('newswiz_frontpage_editor_post_section')):

/**
*
* @since Newswiz
*
*
*/
  function newswiz_frontpage_editor_post_section()
    {

        if(is_front_page() || is_home())
        { 
         $number_of_posts = '3';
         $newsup_editor_news_category = newsup_get_option('select_editor_news_category');
         $newsup_all_posts_main = newsup_get_posts($number_of_posts, $newsup_editor_news_category);
        ?>

      
               
                        <?php if ($newsup_all_posts_main->have_posts()) :
                        while ($newsup_all_posts_main->have_posts()) : $newsup_all_posts_main->the_post();
                        global $post;
                        $newsup_url = newsup_get_freatured_image_url($post->ID, 'newsup-slider-full'); ?>
                        <div class="col-md-4">
                        <div class="mg-blog-post lg mins back-img mr-bot30" style="background-image: url('<?php echo esc_url($newsup_url); ?>'); ">
                                        <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                                    <article class="bottom">
                                        <div class="mg-blog-category"> <?php newsup_post_categories(); ?> </div>
                                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <?php newsup_post_meta(); ?>
                                    </article>
                                </div>
                        </div>
                        
                            
                        <?php
    endwhile;
endif;
wp_reset_postdata();
?>
            
                   
        
       <?php }
    }

endif;

add_action('newswiz_action_front_page_editor_section', 'newswiz_frontpage_editor_post_section', 30);

//Front Page Banner
if (!function_exists('newswiz_front_page_banner_section')) :
    /**
     *
     * @since Newswiz
     *
     */
    function newswiz_front_page_banner_section()
    {
        if (is_front_page() || is_home()) {
        $newsup_enable_main_slider = newsup_get_option('show_main_news_section');
        $newsup_enable_editor_section = get_theme_mod('newswiz_enable_editor_section',1);
        $select_vertical_slider_news_category = newsup_get_option('select_vertical_slider_news_category');
        $vertical_slider_number_of_slides = newsup_get_option('vertical_slider_number_of_slides');
        $all_posts_vertical = newsup_get_posts($vertical_slider_number_of_slides, $select_vertical_slider_news_category);
          

            $main_banner_section_background_image = newsup_get_option('main_banner_section_background_image');
            $main_banner_section_background_image_url = wp_get_attachment_image_src($main_banner_section_background_image, 'full');
        if(!empty($main_banner_section_background_image)){ ?>
             <section class="mg-fea-area over" style="background-image:url('<?php echo esc_url($main_banner_section_background_image_url[0]); ?>');">
        <?php }else{ ?>
            <section class="mg-fea-area">
        <?php  } ?>
            <div class="overlay">
                <div class="container-fluid">
                   <?php if ($newsup_enable_editor_section): ?>  
                     <div class="row">  
                        <?php do_action('newswiz_action_front_page_editor_section');?>
                    </div>
                <?php endif; ?>
                     
                    <?php if ($newsup_enable_main_slider): ?>
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <div id="homemain"class="homemain owl-carousel mr-bot60 pd-r-10"> 
                                <?php newsup_get_block('list', 'banner'); ?>
                            </div>
                        </div> 
                        <?php do_action('newswiz_action_banner_tabbed_posts');?>
                    </div>
                   <?php endif; ?>
                </div>
            </div>
        </section>
        <!--==/ Home Slider ==-->
        <!-- end slider-section -->
        <?php }
    }
endif;
add_action('newswiz_action_front_page_main_section_1', 'newswiz_front_page_banner_section', 40);



//Banner Tabed Section
if (!function_exists('newswiz_banner_tabbed_posts')):
    /**
     *
     * @since Newswiz 1.0.0
     *
     */
    function newswiz_banner_tabbed_posts()
    {
        
            $show_excerpt = 'false';
            $excerpt_length = '20';
            $number_of_posts = '4';

            $enable_categorised_tab = 'true';
            $latest_title = newsup_get_option('latest_tab_title');
            $popular_title = newsup_get_option('popular_tab_title');
            $categorised_title = newsup_get_option('trending_tab_title');
            $category = newsup_get_option('select_trending_tab_news_category');
            $tab_id = 'tan-main-banner-latest-trending-popular'
            ?>
            <div class="col-md-4 col-sm-6 top-right-area">
                    <div id="exTab2" >
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_attr_e('Recent', 'newswiz'); ?>">
                               <i class="fa fa-clock-o"></i><?php echo esc_html($latest_title); ?>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_attr_e('Popular', 'newswiz'); ?>">
                                <i class="fa fa-fire"></i> <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>-categorised"
                               aria-controls="<?php esc_attr_e('Categorised', 'newswiz'); ?>">
                                <i class="fa fa-bolt"></i> <?php echo esc_html($categorised_title); ?>
                            </a>
                        </li>

                    </ul>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane active">
                        <?php
                        newsup_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>


                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane">
                        <?php
                        newsup_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>

                    <?php if ($enable_categorised_tab == 'true'): ?>
                        <div id="<?php echo esc_attr($tab_id); ?>-categorised" role="tabpanel" class="tab-pane ">
                            <?php
                            newsup_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php

    }
endif;

add_action('newswiz_action_banner_tabbed_posts', 'newswiz_banner_tabbed_posts', 10);



//Banner Advertisment
if (!function_exists('newswiz_right_banner_advertisement')):
    /**
     *
     * @since Newswiz 0.1
     *
     */
    function newswiz_right_banner_advertisement()
    {

        if (('' != newsup_get_option('banner_right_advertisement_section')) ) {        
            $newsup_center_logo_title = get_theme_mod('newsup_center_logo_title',false); 
            if($newsup_center_logo_title == false ) { 
         
            if(newsup_get_option('banner_advertisement_section'))
            {
            ?>
            <div class="col-md-4 col-sm-8">
            <?php } else { ?>
             <div class="col-md-8 col-sm-8">
             <?php } } else { ?>    
             <div class="col-8 text-center mx-auto">
                <?php } if (('' != newsup_get_option('banner_right_advertisement_section'))):

                    $newsup_right_banner_advertisement = newsup_get_option('banner_right_advertisement_section');
                    $newsup_right_banner_advertisement = absint($newsup_right_banner_advertisement);
                    $newsup_right_banner_advertisement = wp_get_attachment_image($newsup_right_banner_advertisement, 'full');
                    $banner_right_advertisement_section_url = newsup_get_option('banner_advertisement_section_url');
                    $banner_right_advertisement_section_url = isset($banner_right_advertisement_section_url) ? esc_url($banner_right_advertisement_section_url) : '#';
                    $newsup_right_open_on_new_tab = get_theme_mod('newsup_right_open_on_new_tab',true);
                    ?>
                    <div class="header-ads">
                        <a class="pull-right" <?php echo esc_url($banner_right_advertisement_section_url); ?> href="<?php echo $banner_right_advertisement_section_url; ?>"
                            <?php if($newsup_right_open_on_new_tab) { ?>target="_blank" <?php } ?> >
                            <?php echo $newsup_right_banner_advertisement; ?>
                        </a>
                    </div>
                <?php endif; ?>                

            </div>
            <!-- Trending line END -->
            <?php
        }

    }
endif;

add_action('newswiz_action_right_banner_advertisement', 'newswiz_right_banner_advertisement', 10);




//Banner Advertisment
if (!function_exists('newswiz_left_banner_advertisement')):
    /**
     *
     * @since Newsup 1.0.0
     *
     */
    function newswiz_left_banner_advertisement()
    {

        if (('' != newsup_get_option('banner_advertisement_section')) ) {      
            $newsup_center_logo_title = get_theme_mod('newsup_center_logo_title',false); 
            if($newsup_center_logo_title == false ) { 
            
            if(newsup_get_option('banner_right_advertisement_section'))
            {
            ?>
            <div class="col-md-4 col-sm-8">
            <?php } else { ?>
             <div class="col-md-8 col-sm-8">
             <?php } } else { ?>    
             <div class="col-8 text-center mx-auto">
                <?php } if (('' != newsup_get_option('banner_advertisement_section'))):

                    $newsup_banner_advertisement = newsup_get_option('banner_advertisement_section');
                    $newsup_banner_advertisement = absint($newsup_banner_advertisement);
                    $newsup_banner_advertisement = wp_get_attachment_image($newsup_banner_advertisement, 'full');
                    $newsup_banner_advertisement_url = newsup_get_option('banner_advertisement_section_url');
                    $newsup_banner_advertisement_url = isset($newsup_banner_advertisement_url) ? esc_url($newsup_banner_advertisement_url) : '#';
                    $newsup_open_on_new_tab = get_theme_mod('newsup_open_on_new_tab',true);
                    ?>
                    <div class="header-ads">
                        <a class="pull-right" <?php echo esc_url($newsup_banner_advertisement_url); ?> href="<?php echo $newsup_banner_advertisement_url; ?>"
                            <?php if($newsup_open_on_new_tab) { ?>target="_blank" <?php } ?> >
                            <?php echo $newsup_banner_advertisement; ?>
                        </a>
                    </div>
                <?php endif; ?>                

            </div>
            <!-- Trending line END -->
            <?php
        }
    }
endif;

add_action('newswiz_action_banner_advertisement', 'newswiz_left_banner_advertisement', 10);