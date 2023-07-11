<?php
/*
* Plugin Name: PluginOps Landing Page Builder
* Description: A drag and drop free responsive page builder that simplifies building your landing pages & websites.
* Version: 1.5.0.9
* Author: PluginOps
* Text Domain: page-builder-add
* Domain Path: /languages
* Author URI: https://pluginops.com/page-builder
* Plugin URI: https://pluginops.com/page-builder
* Requires at least: 4.6
* Requires PHP: 5.6
* License: GPL V2
*/

if ( ! defined( 'ABSPATH' ) ) exit;
include 'config.php';
include 'includes.php';


function ulpb_pluginOps_load_textDomain() {
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'page-builder-add', false, $plugin_rel_path );
}
add_action('plugins_loaded', 'ulpb_pluginOps_load_textDomain');

function ulpb_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=page-builder-dashboard-ulpb">' . __( 'Dashboard','page-builder-add' ) . '</a>';
    $support_link = '<a href="https://wordpress.org/support/plugin/page-builder-add/#new-topic-0">' . __( 'Support','page-builder-add' ) . '</a>';

    $links['deactivate'] = str_replace( '<a', '<a id="pluginops-plugin-deactivate-link"', $links['deactivate'] );
    
    array_push( $links, $settings_link );
    array_push( $links, $support_link );
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'ulpb_plugin_add_settings_link' );



register_activation_hook(__FILE__, 'ulpb_plugin_activation');
add_action('admin_init', 'ulpb_plugin_redirect_activation');

function ulpb_plugin_activation() {
    
    // delete_option('ulpb_new_user_perm');
    // delete_option('ulpb_new_user');
    // delete_option( 'plugOps_activation_date' );

    if (get_option('plugOps_activation_date') == false) {
        //update_option('ulpb_new_user_perm',true);
        //update_option('ulpb_new_user',true);
    }
    
    
    flush_rewrite_rules();
    $now = strtotime( "now" );
    add_option( 'plugOps_activation_date', $now );

    $selectedPostTypes = array("page");

    if(!get_option('page_builder_SupportedPostTypes')){
        update_option('page_builder_SupportedPostTypes', $selectedPostTypes);
    }

    add_option( 'pluginOps_d_upd_not_req', false );
    add_option('ulpb_plugin_activation_check_option', true);
}


function ulpb_plugin_deactivation_pluginops() {
    delete_option( 'cpt_reset_ulpb_pluginops' );
}

register_deactivation_hook( __FILE__, 'ulpb_plugin_deactivation_pluginops' );


function ulpb_plugin_redirect_activation() {
if (get_option('ulpb_plugin_activation_check_option', false) ) {
    delete_option('ulpb_plugin_activation_check_option');
    if(!isset($_GET['activate-multi']))
    {
        wp_redirect("edit.php?post_type=ulpb_post&page=page-builder-dashboard-ulpb");
        exit();
    }
 }
}


?>