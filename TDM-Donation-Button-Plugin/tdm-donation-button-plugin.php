<?php

/*
 * Plugin Name:       TDM Donation Button Plugin
 * Plugin URI:        https://ephraimedeh.com
 * Description:       A Basic Plugin to add a donation button to your post or page via a shortcode
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ephraim Edeh
 * Author URI:        https://ephraimedeh.com/
 */


// Custom function to create a donate button
function donate_shortcode( $atts, $content = null) {
    global $post;extract(shortcode_atts(array(
    'account' => 'your-paypal-email-address',
    'for' => $post->post_title,
    'onHover' => '',
    ), $atts));
    if(empty($content)) $content='Make A Donation';
    return '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business='.$account.'&item_name=Donation for '.$for.'" title="'.$onHover.'">'.$content.'</a>';
    }
    add_shortcode('donate', 'donate_shortcode');

// Custom function to create a menu page
add_action('admin_menu', 'wporg_options_page');
function wporg_options_page() {
    add_menu_page(
        'TDM Donation Button Plugin',
        'TDM Donation Button',
        'manage_options',
        'TDM-donation-button-plugin',
        'tdm_options_page_content',
        'dashicons-money-alt',
        4
    );
}

// Add this new function to display the options page content
function tdm_options_page_content() {
    // Check if the user has the required capability
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Include the view file
    include(plugin_dir_path(__FILE__) . 'admin/view.php');
}