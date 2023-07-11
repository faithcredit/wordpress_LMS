<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Newsup
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function newsup_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }


    $global_site_mode_setting = newsup_get_option('global_site_mode_setting');
    $classes[] = $global_site_mode_setting;


    $single_post_featured_image_view = newsup_get_option('single_post_featured_image_view');
    if ($single_post_featured_image_view == 'full') {
        $classes[] = 'ta-single-full-header';
    }

    $global_hide_post_date_author_in_list = newsup_get_option('global_hide_post_date_author_in_list');
    if ($global_hide_post_date_author_in_list == true) {
        $classes[] = 'ta-hide-date-author-in-list';
    }

    global $post;

    


    $global_alignment = newsup_get_option('newsup_content_layout');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = newsup_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'newsup-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }


    return $classes;


}

add_filter('body_class', 'newsup_body_classes');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsup_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'newsup_pingback_header');


/**
 * Returns posts.
 *
 * @since Newsup 1.0.0
 */
if (!function_exists('newsup_get_posts')):
    function newsup_get_posts($number_of_posts, $category = '0')
    {

        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $category = isset($category) ? $category : '0';
        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;

if (!function_exists('newsup_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since newsup 1.0.0
     *
     */
    function newsup_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/ansar/hooks/blocks/block-' . $section, $block);

    }
endif;





/**
 * Check if given term has child terms
 *
 */
function newsup_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Top Tags", $number = 5)
{
    

      $show_popular_tags_section = esc_attr(get_theme_mod('show_popular_tags_section','true'));
      $show_popular_tags_title = get_theme_mod('show_popular_tags_title', esc_html('Top Tags'));
      if($show_popular_tags_section == true){
      $popular_taxonomies = get_terms(array(
        'taxonomy' => $taxonomy,
        'number' => absint($number),
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => true,
    ));

    $html = '';

    if (isset($popular_taxonomies) && !empty($popular_taxonomies)):
        $html .= '<section class="mg-tpt-tag-area"><div class="container-fluid"><div class="mg-tpt-txnlst clearfix">';
        if (!empty($title)):
            $html .= '<strong>';
            $html .= esc_html($title);
            $html .= '</strong>';
        endif;
        $html .= '<ul>';
        foreach ($popular_taxonomies as $tax_term):
            $html .= '<li>';
            $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
            $html .= $tax_term->name;
            $html .= '</a>';
            $html .= '</li>';
        endforeach;
        $html .= '</ul>';
        $html .= '</div></div></section>';
    endif;

    echo $html;
}
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function newsup_get_freatured_image_url($post_id, $size = 'newsup-featured')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        $url = $thumb !== false ? '' . $thumb[0] . '' : '""';

    } else {
        $url = '';
    }


    return $url;
}

if (!function_exists('newsup_edit_link')) :

    function newsup_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'newsup'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );

    } 
endif;

function newsup_date_display_type() {
    // Return if date display option is not enabled
    $header_data_enable = esc_attr(get_theme_mod('header_data_enable','true'));
    $header_time_enable = esc_attr(get_theme_mod('header_time_enable','true'));
    $newsup_date_time_show_type = get_theme_mod('newsup_date_time_show_type','newsup_default');
    if(($header_data_enable == true) || ($header_time_enable == true)) {
    if ( $newsup_date_time_show_type == 'newsup_default' ) {
    ?>
        <li><?php if($header_data_enable == true) {
            echo date_i18n('D. M jS, Y ', strtotime(current_time("Y-m-d"))); }
             if($header_time_enable == true) { ?>
            <span  id="time" class="time"></span>
        <?php } ?>
            
        </li>
    <?php } elseif( $newsup_date_time_show_type == 'wordpress_date_setting') { ?>
        <li><?php if($header_data_enable == true) {
            echo date_i18n( get_option( 'date_format' ) ); }
            if($header_time_enable == true) { ?>
            <span class="time"> <?php $format = get_option('') . ' ' . get_option('time_format');
            print date_i18n($format, current_time('timestamp')); ?></span>
           <?php } ?>
        </li>
   <?php } } }

function newsup_post_image_display_type($post)
{
$post_image_type = get_theme_mod('post_image_type','newsup_post_img_hei');
$url = newsup_get_freatured_image_url($post->ID, 'newsup-medium');
if ( $post_image_type == 'newsup_post_img_hei' ) {
if($url) { ?>
<div class="col-12 col-md-6">
    <div class="mg-post-thumb back-img md" style="background-image: url('<?php echo esc_url($url); ?>');">
        <?php echo newsup_post_format_type($post); ?>
        <a class="link-div" href="<?php the_permalink(); ?>"></a>
    </div> 
</div>
<?php } 
}
elseif ( $post_image_type == 'newsup_post_img_acc' )  {
if(has_post_thumbnail()) { ?>
        
<div class="col-12 col-md-6">
        <div class="mg-post-thumb img">
<?php echo '<a href="'.esc_url(get_the_permalink()).'">';
     the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
    echo '</a>'; ?>
        <?php echo newsup_post_format_type($post); ?>
        </div>
</div> <?php } 
} 
}

function newsup_post_format_type($post_id)
{
    
    if(has_post_format( 'image' ))
    { 
      echo '<span class="post-form"><i class="fas fa-camera"></i></span>';   
    }

    elseif(has_post_format( 'video' ))
    { 
      echo '<span class="post-form"><i class="fas fa-video"></i></span>';   
    }

    elseif(has_post_format( 'gallery' ))
    {
       echo '<span class="post-form"><i class="fas fa-photo-video"></i></span>';  
    }

    else
    {
      echo '<span class="post-form"><i class="fas fa-camera"></i></span>';  
    }
    

}

function newsup_social_share_post($post) {

        $single_show_share_icon = esc_attr(get_theme_mod('single_show_share_icon','true'));
                if($single_show_share_icon == true) {
        $post_link  = esc_url( get_the_permalink() );
        $post_link = urlencode( esc_url( get_the_permalink() ) );
        $post_title = get_the_title();

        $facebook_url = add_query_arg(
        array(
        'u' => $post_link,
        ),
        'https://www.facebook.com/sharer.php'
        );

                    $twitter_url = add_query_arg(
                    array(
                    'url'  => $post_link,
                    'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
                     ),
                     'http://twitter.com/share'
                     );

                     $email_title = str_replace( '&', '%26', $post_title );

                     $email_url = add_query_arg(
                    array(
                    'subject' => wp_strip_all_tags( $email_title ),
                    'body'    => $post_link,
                     ),
                    'mailto:'
                     ); 

                     $linkedin_url = add_query_arg(
                     array('url'  => $post_link,
                    'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://www.linkedin.com/sharing/share-offsite/?url'
                    );

                     $pinterest_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'http://pinterest.com/pin/create/link/?url='
                    );

                     $telegram_url = add_query_arg(
                     array('url'  => $post_link,
                      'title' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) )
                     ),
                    'https://telegram.me/share/url?url=&text='
                    );


                     ?>
                     <script>
    function pinIt()
    {
      var e = document.createElement('script');
      e.setAttribute('type','text/javascript');
      e.setAttribute('charset','UTF-8');
      e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
      document.body.appendChild(e);
    }
    </script>
                     <div class="post-share">
                          <div class="post-share-icons cf">
                           
                              <a href="<?php echo esc_url("$facebook_url"); ?>" class="link facebook" target="_blank" >
                                <i class="fab fa-facebook"></i></a>
                            
            
                              <a href="<?php echo esc_url("$twitter_url"); ?>" class="link twitter" target="_blank">
                                <i class="fab fa-twitter"></i></a>
            
                              <a href="<?php echo esc_url("$email_url"); ?>" class="link email" target="_blank" >
                                <i class="fas fa-envelope"></i></a>


                              <a href="<?php echo esc_url("$linkedin_url"); ?>" class="link linkedin" target="_blank" >
                                <i class="fab fa-linkedin"></i></a>

                             <a href="<?php echo esc_url("$telegram_url"); ?>" class="link telegram" target="_blank" >
                                <i class="fab fa-telegram"></i></a>

                              <a href="javascript:pinIt();" class="link pinterest"><i class="fab fa-pinterest"></i></a>

                              <a class="print-r" href="javascript:window.print()"> <i class="fas fa-print"></i></a>  
                          </div>
                    </div>

<?php } } 

add_filter( 'woocommerce_show_page_title', 'newsup_hide_shop_page_title' );

function newsup_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
}

function newsup_custom_header_background() { 
$color = get_theme_mod( 'background_color', get_theme_support( 'custom-background', 'default-color' ) );
?>
<style type="text/css" id="custom-background-css">
    .wrapper { background-color: <?php echo esc_attr($color); ?>; }
</style>
<?php }
add_action('wp_head','newsup_custom_header_background');

if ( ! function_exists( 'newsup_header_color' ) ) :

function newsup_header_color() {
    $newsup_logo_text_color = get_header_textcolor();
    $newsup_title_font_size = newsup_get_option('newsup_title_font_size');

    ?>
    <style type="text/css">
    <?php
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
        else :
    ?>
        body .site-title a,
        body .site-description {
            color: #<?php echo esc_attr( $newsup_logo_text_color ); ?>;
        }

        .site-branding-text .site-title a {
                font-size: <?php echo esc_attr( $newsup_title_font_size ); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding-text .site-title a {
                    font-size: 40px;

                }
            }

            @media only screen and (max-width: 375px) {
                .site-branding-text .site-title a {
                    font-size: 32px;

                }
            }

    <?php endif; ?>
    </style>
    <?php
}
endif;
?>