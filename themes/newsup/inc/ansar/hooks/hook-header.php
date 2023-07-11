<?php
if (!function_exists('newsup_header_section')) :
/**
 *  Slider
 *
 * @since Newsup
 *
 */
function newsup_header_section()
{
    
    $header_social_icon_enable = esc_attr(get_theme_mod('header_social_icon_enable','true'));
    $header_data_enable = esc_attr(get_theme_mod('header_data_enable','true'));
    $header_time_enable = esc_attr(get_theme_mod('header_time_enable','true'));
 if(($header_data_enable == true) || ($header_time_enable == true) || ($header_social_icon_enable == true)) {
?>
<div class="mg-head-detail hidden-xs">
    <div class="container-fluid">
        <div class="row align-items-center">
            <?php
            $newsup_header_fb_link = get_theme_mod('newsup_header_fb_link');
            $newsup_header_fb_target = esc_attr(get_theme_mod('newsup_header_fb_target','true'));
            $newsup_header_twt_link = get_theme_mod('newsup_header_twt_link');
            $newsup_header_twt_target = esc_attr(get_theme_mod('newsup_header_twt_target','true'));
            $newsup_header_lnkd_link = get_theme_mod('newsup_header_lnkd_link');
            $newsup_header_lnkd_target = esc_attr(get_theme_mod('newsup_header_lnkd_target','true'));
            $newsup_header_insta_link = get_theme_mod('newsup_header_insta_link');
            $newsup_insta_insta_target = esc_attr(get_theme_mod('newsup_insta_insta_target','true'));
            $newsup_header_youtube_link = get_theme_mod('newsup_header_youtube_link');
            $newsup_header_youtube_target = esc_attr(get_theme_mod('newsup_header_youtube_target','true'));
            $newsup_header_pintrest_link = get_theme_mod('newsup_header_pintrest_link');
            $newsup_header_pintrest_target = esc_attr(get_theme_mod('newsup_header_pintrest_target','true'));
            $newsup_header_telegram_link = get_theme_mod('newsup_header_tele_link');
            $newsup_header_tele_target = esc_attr(get_theme_mod('newsup_header_tele_target','true'));
              ?>
            <div class="col-md-6 col-xs-12">
                <ul class="info-left">
                    <?php newsup_date_display_type(); ?>
                </ul>
            </div>
            <?php 
            if($header_social_icon_enable == true)
            {
            ?>
            <div class="col-md-6 col-xs-12">
                <ul class="mg-social info-right">
                    
                      <?php if($newsup_header_fb_link !=''){ ?>
                      <li><a <?php if($newsup_header_fb_target) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($newsup_header_fb_link); ?>">
                      <span class="icon-soci facebook"><i class="fab fa-facebook"></i></span> </a></li>
                      <?php } ?>
                      <?php if($newsup_header_twt_link !=''){ ?>
                      <li><a <?php if($newsup_header_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($newsup_header_twt_link);?>">
                      <span class="icon-soci twitter"><i class="fab fa-twitter"></i></span></a></li>
                      <?php } ?>
                      <?php if($newsup_header_lnkd_link !=''){ ?>
                      <li><a <?php if($newsup_header_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_lnkd_link); ?>">
                      <span class="icon-soci linkedin"><i class="fab fa-linkedin"></i></span></a></li>
                      <?php } ?>
                      <?php if($newsup_header_insta_link !=''){ ?>
                      <li><a <?php if($newsup_insta_insta_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_insta_link); ?>">
                      <span class="icon-soci instagram"><i class="fab fa-instagram"></i></span></a></li>
                      <?php } ?>
                      <?php if($newsup_header_youtube_link !=''){ ?>
                      <li><a <?php if($newsup_header_youtube_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_youtube_link); ?>">
                      <span class="icon-soci youtube"><i class="fab fa-youtube"></i></span></a></li>
                      <?php } ?>
                       <?php if($newsup_header_pintrest_link !=''){ ?>
                      <li><a <?php if($newsup_header_pintrest_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_pintrest_link); ?>">
                      <span class="icon-soci pinterest"><i class="fab fa-pinterest-p"></i></span></a></li>
                      <?php } ?> 
                      <?php if($newsup_header_telegram_link !=''){ ?>
                      <li><a <?php if($newsup_header_tele_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($newsup_header_telegram_link); ?>">
                      <span class="icon-soci telegram"><i class="fab fa-telegram"></i></span></a></li>
                      <?php } ?>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php 
} }
endif;
add_action('newsup_action_header_section', 'newsup_header_section', 5);