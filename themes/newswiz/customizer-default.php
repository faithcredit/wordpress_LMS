<?php
/**
 * Default theme options.
 *
 * @package Newswiz
 */

if (!function_exists('newswiz_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function newswiz_get_default_theme_options() {

    $defaults = array();

    $defaults['select_editor_news_category'] = 0;
    $defaults['newswiz_enable_editor_section'] = 1;
    $defaults['banner_right_advertisement_section'] = '';
    $defaults['banner_right_advertisement_section_url ']='#';


	return $defaults;

}
endif;