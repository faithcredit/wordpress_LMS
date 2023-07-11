<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Yuki
 */
use  LottaFramework\Facades\CZ ;
use  LottaFramework\Icons\IconsManager ;
use  LottaFramework\Utils ;
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function yuki_body_classes( $classes )
{
    $classes[] = 'yuki-body overflow-x-hidden yuki-form-' . CZ::get( 'yuki_content_form_style' );
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    $default_sidebar = apply_filters( 'yuki_filter_default_sidebar_id', 'primary-sidebar', 'primary' );
    if ( !is_active_sidebar( $default_sidebar ) ) {
        $classes[] = 'yuki-no-sidebar no-sidebar';
    }
    return $classes;
}

add_filter( 'body_class', 'yuki_body_classes' );
/**
 * Sets the post excerpt length to n words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function yuki_excerpt_length( $length )
{
    if ( is_admin() || !yuki_app()->has( 'store.excerpt_length' ) || absint( yuki_app()['store.excerpt_length'] ) <= 0 ) {
        return $length;
    }
    return absint( yuki_app()['store.excerpt_length'] );
}

add_filter( 'excerpt_length', 'yuki_excerpt_length' );
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
 *
 * @return string option from customizer prepended with an ellipsis.
 */
function yuki_excerpt_more( $link )
{
    if ( is_admin() || !yuki_app()->has( 'store.excerpt_more_text' ) || yuki_app()['store.excerpt_more_text'] === '' ) {
        return $link;
    }
    return yuki_app()['store.excerpt_more_text'];
}

add_filter( 'excerpt_more', 'yuki_excerpt_more' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function yuki_pingback_header()
{
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action( 'wp_head', 'yuki_pingback_header' );
function yuki_add_selective_css_container()
{
    if ( is_customize_preview() ) {
        ?>
        <style id="yuki-preloader-selective-css"></style>
        <style id="yuki-global-selective-css"></style>
        <style id="yuki-woo-selective-css"></style>
        <style id="yuki-header-selective-css"></style>
        <style id="yuki-footer-selective-css"></style>
        <style id="yuki-homepage-selective-css"></style>
		<?php 
    }
}

add_action( 'wp_head', 'yuki_add_selective_css_container' );
if ( !function_exists( 'yuki_add_preloader' ) ) {
    /**
     * Add global preloader
     */
    function yuki_add_preloader()
    {
        
        if ( CZ::checked( 'yuki_global_preloader' ) ) {
            $preset = CZ::get( 'yuki_preloader_preset' );
            ?>
            <div class="yuki-preloader-wrap yuki-preloader-<?php 
            echo  esc_attr( $preset ) ;
            ?>">
				<?php 
            echo  wp_kses_post( yuki_get_preloader( $preset )['html'] ) ;
            ?>
            </div>
			<?php 
        }
    
    }

}
add_action( 'yuki_action_before', 'yuki_add_preloader' );
/**
 * Add primary sidebar
 *
 * @param $layout
 */
function yuki_add_primary_sidebar( $layout )
{
    // Include primary sidebar.
    if ( $layout === 'left-sidebar' || $layout === 'right-sidebar' ) {
        get_sidebar();
    }
}

add_action( 'yuki_action_sidebar', 'yuki_add_primary_sidebar' );
/**
 * Site header open
 */
function yuki_add_header_open()
{
    ?>
    <header class="yuki-site-header">
	<?php 
}

add_action( 'yuki_action_before_header', 'yuki_add_header_open' );
/**
 * Header render
 */
function yuki_header_render()
{
    do_action( 'yuki_before_header_row_render', 'modal' );
    if ( Yuki_Header_Builder::hasContent( 'modal' ) ) {
        Yuki_Header_Builder::render( 'modal' );
    }
    do_action( 'yuki_after_header_row_render', 'modal' );
    do_action( 'yuki_before_header_row_render', 'top_bar' );
    if ( Yuki_Header_Builder::hasContent( 'top_bar' ) ) {
        Yuki_Header_Builder::render( 'top_bar' );
    }
    do_action( 'yuki_after_header_row_render', 'top_bar' );
    do_action( 'yuki_before_header_row_render', 'primary_navbar' );
    if ( Yuki_Header_Builder::hasContent( 'primary_navbar' ) ) {
        Yuki_Header_Builder::render( 'primary_navbar' );
    }
    do_action( 'yuki_after_header_row_render', 'primary_navbar' );
    do_action( 'yuki_before_header_row_render', 'bottom_row' );
    if ( Yuki_Header_Builder::hasContent( 'bottom_row' ) ) {
        Yuki_Header_Builder::render( 'bottom_row' );
    }
    do_action( 'yuki_after_header_row_render', 'bottom_row' );
}

add_action( 'yuki_action_header', 'yuki_header_render' );
/**
 * Site header closed
 */
function yuki_add_header_close()
{
    ?>
    </header>
	<?php 
}

add_action( 'yuki_action_after_header', 'yuki_add_header_close' );
/**
 * Render header row
 */
function yuki_header_row_start( $id, $key )
{
    $classes = 'yuki-header-row yuki-header-row-' . $id;
    $attrs = [
        'class'    => $classes,
        'data-row' => $id,
    ];
    
    if ( is_customize_preview() ) {
        $attrs['data-shortcut'] = 'border';
        $attrs['data-shortcut-location'] = 'yuki_header:' . $id;
    }
    
    echo  '<div ' . Utils::render_attribute_string( $attrs ) . '>' ;
}

add_action(
    'yuki_start_header_row',
    'yuki_header_row_start',
    10,
    2
);
function yuki_header_row_overlay( $id, $key )
{
    if ( CZ::checked( "yuki_header_{$id}_row_overlay" ) ) {
        echo  '<div class="yuki-overlay"></div>' ;
    }
}

add_action(
    'yuki_start_header_row',
    'yuki_header_row_overlay',
    15,
    2
);
function yuki_header_row_container_start( $id, $key )
{
    echo  '<div class="container mx-auto text-xs px-gutter flex flex-wrap items-stretch">' ;
}

add_action(
    'yuki_start_header_row',
    'yuki_header_row_container_start',
    20,
    2
);
function yuki_header_row_close()
{
    echo  '</div>' ;
}

// header row
add_action( 'yuki_after_header_row', 'yuki_header_row_close', 10 );
// container
add_action( 'yuki_after_header_row', 'yuki_header_row_close', 20 );
/**
 * Show posts pagination
 */
function yuki_show_posts_pagination()
{
    global  $wp_query ;
    $pages = $wp_query->max_num_pages;
    global  $paged ;
    $paged = ( empty($paged) ? 1 : $paged );
    // Don't print empty markup in archives if there's only one page or pagination is disabled.
    if ( !CZ::checked( 'yuki_archive_pagination_section' ) || $pages < 2 && (is_home() || is_archive() || is_search()) ) {
        return;
    }
    $type = CZ::get( 'yuki_pagination_type' );
    $show_disabled_button = CZ::checked( 'yuki_pagination_disabled_button' );
    $css = [ 'yuki-pagination yuki-scroll-reveal' ];
    $pagination_attrs = [
        'class'                     => Utils::clsx( $css ),
        'data-pagination-type'      => $type,
        'data-pagination-max-pages' => $pages,
    ];
    
    if ( is_customize_preview() ) {
        $pagination_attrs['data-shortcut'] = 'border';
        $pagination_attrs['data-shortcut-location'] = 'yuki_posts:yuki_archive_pagination_section';
    }
    
    $btn_class = 'yuki-btn';
    $current_btn_class = $btn_class . ' yuki-btn-active';
    $disabled_btn_class = $btn_class . ' yuki-btn-disabled';
    $show_previous_button = function ( $disabled = false ) use( $paged, $btn_class, $disabled_btn_class ) {
        $prev_type = CZ::get( 'yuki_pagination_prev_next_type' );
        
        if ( $disabled ) {
            echo  '<span class="' . esc_attr( $disabled_btn_class . ' yuki-prev-btn yuki-prev-btn-' . $prev_type ) . '">' ;
        } else {
            echo  '<a href="' . esc_url( get_pagenum_link( $paged - 1, true ) ) . '" class="' . esc_attr( $btn_class . ' yuki-prev-btn yuki-prev-btn-' . $prev_type ) . '">' ;
        }
        
        echo  '<span>' ;
        
        if ( $prev_type === 'text' ) {
            esc_html_e( CZ::get( 'yuki_pagination_prev_text' ) );
        } else {
            IconsManager::print( CZ::get( 'yuki_pagination_prev_icon' ) );
        }
        
        echo  '</span>' ;
        echo  ( $disabled ? '</span>' : '</a>' ) ;
    };
    $show_next_button = function ( $disabled = false ) use( $paged, $btn_class, $disabled_btn_class ) {
        $next_type = CZ::get( 'yuki_pagination_prev_next_type' );
        
        if ( $disabled ) {
            echo  '<span class="' . esc_attr( $disabled_btn_class . ' yuki-next-btn yuki-next-btn-' . $next_type ) . '">' ;
        } else {
            echo  '<a href="' . esc_url( get_pagenum_link( $paged + 1, true ) ) . '" class="' . esc_attr( $btn_class . ' yuki-next-btn yuki-next-btn-' . $next_type ) . '">' ;
        }
        
        echo  '<span>' ;
        
        if ( $next_type === 'text' ) {
            esc_html_e( CZ::get( 'yuki_pagination_next_text' ) );
        } else {
            IconsManager::print( CZ::get( 'yuki_pagination_next_icon' ) );
        }
        
        echo  '</span>' ;
        echo  ( $disabled ? '</span>' : '</a>' ) ;
    };
    echo  '<nav ' . Utils::render_attribute_string( $pagination_attrs ) . '>' ;
    
    if ( 'prev-next' === $type ) {
        // Show previous button
        
        if ( $paged > 1 ) {
            $show_previous_button();
        } elseif ( $show_disabled_button ) {
            $show_previous_button( true );
        }
        
        // Show next button
        
        if ( $paged < $pages ) {
            $show_next_button();
        } elseif ( $show_disabled_button ) {
            $show_next_button( true );
        }
    
    } elseif ( 'numbered' === $type ) {
        $range = 2;
        $showitems = $range * 2 + 1;
        // Show previous button
        if ( CZ::checked( 'yuki_pagination_prev_next_button' ) ) {
            
            if ( $paged > 1 ) {
                $show_previous_button();
            } elseif ( $show_disabled_button ) {
                $show_previous_button( true );
            }
        
        }
        // Show numeric buttons
        for ( $i = 1 ;  $i <= $pages ;  $i++ ) {
            if ( 1 !== $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems) ) {
                
                if ( $paged === $i ) {
                    echo  '<span class="' . esc_attr( $current_btn_class ) . '">' . $i . '</span>' ;
                } else {
                    echo  '<a class="' . esc_attr( $btn_class ) . '" href="' . esc_url( get_pagenum_link( $i, true ) ) . '">' . $i . '</a>' ;
                }
            
            }
        }
        // Show next button
        if ( CZ::checked( 'yuki_pagination_prev_next_button' ) ) {
            
            if ( $paged < $pages ) {
                $show_next_button();
            } elseif ( $show_disabled_button ) {
                $show_next_button( true );
            }
        
        }
    } else {
        
        if ( yuki_fs()->is_not_paying() ) {
            echo  '<p>' ;
            echo  wp_kses_post( yuki_upsell_info( __( 'Upgrade to %sPro Version%s to enable this feature', 'yuki' ) ) ) ;
            echo  '</p>' ;
        }
    
    }
    
    echo  '</nav>' ;
}

add_action( 'yuki_action_posts_pagination', 'yuki_show_posts_pagination' );
/**
 * Show page header
 */
function yuki_show_page_header()
{
    $header = !(is_front_page() && !is_home()) || CZ::checked( 'yuki_show_frontpage_header' );
    if ( $header && CZ::get( 'yuki_page_featured_image_position' ) === 'behind' ) {
        
        if ( have_posts() ) {
            the_post();
            yuki_show_article_header( 'yuki_pages', 'page' );
            rewind_posts();
        }
    
    }
}

add_action( 'yuki_action_before_page_container', 'yuki_show_page_header' );
/**
 * Show page content
 */
function yuki_show_page_content()
{
    if ( is_front_page() && !is_home() ) {
        // show homepage elements
        
        if ( CZ::checked( 'yuki_homepage_builder_section' ) ) {
            echo  '<div class="yuki-homepage-builder-container">' ;
            Yuki_Homepage_Builder::render();
            echo  '</div>' ;
        }
    
    }
    $header = !(is_front_page() && !is_home()) || CZ::checked( 'yuki_show_frontpage_header' );
    yuki_show_article( 'yuki_pages', 'page', $header );
}

add_action( 'yuki_action_page', 'yuki_show_page_content' );
/**
 * Show single post header
 */
function yuki_show_single_post_header()
{
    if ( CZ::get( 'yuki_post_featured_image_position' ) === 'behind' ) {
        
        if ( have_posts() ) {
            the_post();
            yuki_show_article_header( 'yuki_single_post', 'post' );
            rewind_posts();
        }
    
    }
}

add_action( 'yuki_action_before_single_post_container', 'yuki_show_single_post_header' );
/**
 * Show single post content
 */
function yuki_show_single_post_content()
{
    yuki_show_article( 'yuki_single_post', 'post' );
}

add_action( 'yuki_action_single_post', 'yuki_show_single_post_content' );
/**
 * Show share box
 */
function yuki_add_post_share_box()
{
    if ( is_page() && !is_front_page() && CZ::checked( 'yuki_page_share_box' ) ) {
        yuki_show_share_box( 'page', 'yuki_pages:yuki_page_share_box' );
    }
    if ( is_single() && CZ::checked( 'yuki_post_share_box' ) ) {
        yuki_show_share_box( 'post', 'yuki_single_post:yuki_post_share_box' );
    }
}

add_action( 'yuki_action_after_single_post', 'yuki_add_post_share_box', 10 );
add_action( 'yuki_action_after_page', 'yuki_add_post_share_box', 10 );
/**
 * Show posts navigation
 */
function yuki_add_post_navigation()
{
    if ( !CZ::checked( 'yuki_post_navigation' ) ) {
        return;
    }
    
    if ( is_customize_preview() ) {
        $attrs = [
            'data-shortcut'          => 'border',
            'data-shortcut-location' => 'yuki_single_post:yuki_post_navigation',
        ];
        echo  '<div ' . Utils::render_attribute_string( $attrs ) . '>' ;
    }
    
    echo  '<div class="yuki-max-w-content mx-auto">' ;
    $fallback_image = ( CZ::hasImage( 'yuki_post_featured_image_fallback' ) ? '<img class="wp-post-image" ' . Utils::render_attribute_string( CZ::imgAttrs( 'yuki_post_featured_image_fallback' ) ) . ' />' : '' );
    $prev_post = get_previous_post();
    $prev_thumbnail = $fallback_image;
    $next_thumbnail = $fallback_image;
    if ( has_post_thumbnail( ( $prev_post ? $prev_post->ID : null ) ) ) {
        $prev_thumbnail = get_the_post_thumbnail( ( $prev_post ? $prev_post->ID : null ), 'medium' );
    }
    $prev_thumbnail = '<div class="prev-post-thumbnail post-thumbnail">' . $prev_thumbnail . IconsManager::render( CZ::get( 'yuki_post_navigation_prev_icon' ) ) . '</div>';
    $next_post = get_next_post();
    if ( has_post_thumbnail( ( $next_post ? $next_post->ID : null ) ) ) {
        $next_thumbnail = get_the_post_thumbnail( ( $next_post ? $next_post->ID : null ), 'medium' );
    }
    $next_thumbnail = '<div class="next-post-thumbnail post-thumbnail">' . $next_thumbnail . IconsManager::render( CZ::get( 'yuki_post_navigation_next_icon' ) ) . '</div>';
    the_post_navigation( [
        'prev_text'          => $prev_thumbnail . '<div class="item-wrap px-gutter"><span class="item-label">' . esc_html__( 'Previous Post', 'yuki' ) . '</span><span class="item-title">%title</span></div>',
        'next_text'          => $next_thumbnail . '<div class="item-wrap px-gutter"><span class="item-label">' . esc_html__( 'Next Post', 'yuki' ) . '</span><span class="item-title">%title</span></div>',
        'screen_reader_text' => '<span class="nav-subtitle screen-reader-text">' . esc_html__( 'Page', 'yuki' ) . '</span>',
        'class'              => 'yuki-post-navigation',
    ] );
    if ( is_customize_preview() ) {
        echo  '</div>' ;
    }
    echo  '</div>' ;
}

add_action( 'yuki_action_after_single_post', 'yuki_add_post_navigation', 10 );
function yuki_show_post_comments()
{
    // If comments are open, or we have at least one comment, load up the comment template.
    if ( !is_front_page() && (comments_open() || get_comments_number()) ) {
        comments_template();
    }
}

add_action( 'yuki_action_after_page', 'yuki_show_post_comments', 30 );
add_action( 'yuki_action_after_single_post', 'yuki_show_post_comments', 30 );
/**
 * Footer open
 */
function yuki_footer_open()
{
    ?>
    <footer class="yuki-footer-area">
	<?php 
}

add_action( 'yuki_action_before_footer', 'yuki_footer_open' );
/**
 * Footer render
 */
function yuki_footer_render()
{
    $rows = [ 'top', 'middle', 'bottom' ];
    foreach ( $rows as $row ) {
        if ( Yuki_Footer_Builder::hasContent( $row ) ) {
            Yuki_Footer_Builder::render( $row, function ( $css, $args ) {
                $css[] = 'flex';
                return $css;
            } );
        }
    }
}

add_action( 'yuki_action_footer', 'yuki_footer_render' );
/**
 * Close footer
 */
function yuki_footer_close()
{
    ?>
    </footer>
	<?php 
}

add_action( 'yuki_action_after_footer', 'yuki_footer_close' );
/**
 * Add to top button
 */
function yuki_add_to_top()
{
    if ( !CZ::checked( 'yuki_global_scroll_to_top' ) ) {
        return;
    }
    $css = [ 'yuki-to-top', 'yuki-to-top-' . CZ::get( 'yuki_to_top_position' ) ];
    $attrs = [
        'href'  => '#',
        'id'    => 'scroll-top',
        'class' => Utils::clsx( $css ),
    ];
    echo  '<a ' . Utils::render_attribute_string( $attrs ) . '>' ;
    
    if ( is_customize_preview() ) {
        echo  '<div data-shortcut="arrow" data-shortcut-location="yuki_global:yuki_global_scroll_to_top">' ;
        echo  '</div>' ;
    }
    
    IconsManager::print( CZ::get( 'yuki_to_top_icon' ) );
    echo  '</a>' ;
}

add_action( 'yuki_action_after_footer', 'yuki_add_to_top' );
/**
 * Add admin menu page
 */
function yuki_add_admin_menu()
{
    add_theme_page(
        esc_html__( 'Yuki Theme', 'yuki' ),
        esc_html__( 'Yuki Theme', 'yuki' ),
        'edit_theme_options',
        'yuki',
        function () {
        get_template_part( 'template-parts/admin', 'welcome' );
    }
    );
}

add_action( 'admin_menu', 'yuki_add_admin_menu' );