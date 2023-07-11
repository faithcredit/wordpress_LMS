<?php
/**
 * The template for displaying search results pages.
 *
 * @package Newsup
 */

get_header(); ?>
<!--==================== Newsup breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<div id="content">
    <!--container-->
    <div class="container-fluid">
    <!--row-->
        <div class="row">
            <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?>">
                <div class="mg-card-box padding-20 search">
                <h2><?php /* translators: %s: search term */ printf( esc_html__( 'Search Results for: %s','newsup'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                </div>
                <?php get_template_part( 'template-parts/content', 'search' ); ?>
            </div>
            <aside class="col-md-4">
                    <?php get_sidebar();?>
            </aside>
        </div><!--/row-->
    </div><!--/container-->
</div>
<?php
get_footer();
?>