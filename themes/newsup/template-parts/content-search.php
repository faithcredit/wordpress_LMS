<?php
/**
 * The template for displaying search results pages.
 *
 * @package Newsup
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- mg-posts-sec mg-posts-modul-6 -->
        <div class="mg-posts-sec mg-posts-modul-6 mt-4">
            <!-- mg-posts-sec-inner -->
                <div class="mg-posts-sec-inner">
                    <?php if ( have_posts() ) : /* Start the Loop */
                    while ( have_posts() ) : the_post(); ?>
                    <article class="d-md-flex mg-posts-sec-post">
                    <?php newsup_post_image_display_type($post); ?>
                            <div class="mg-sec-top-post py-3 col">
                                    <div class="mg-blog-category"> 
                                        <?php newsup_post_categories(); ?>
                                    </div>

                                    <h4 class="entry-title title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                    <?php newsup_post_meta(); ?>

                                
                                    <div class="mg-content">
                                        <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                </div>
                            </div>
                    </article>
                    <?php endwhile; else :?>
                    <div class="mg-card-box padding-20 search">              
                    <h2><?php esc_html_e( "Nothing Found", 'newsup' ); ?></h2>
                    
                    <p><?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'newsup' ); ?>
                    </p>
                    <?php get_search_form(); ?>
                    </div><!-- .blog_con_mn -->
                    <?php endif; ?>
                </div>
                <!-- // mg-posts-sec-inner -->
        </div>
        <!-- // mg-posts-sec block_6 -->
    <!--col-md-12-->
</div>