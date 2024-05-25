<?php
/*
Plugin Name: Training Manager
Description: Custom plugin to manage training proposals and events with user roles.
Version: 1.0
Author: Kelvin Karanja
*/

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/user-roles.php';
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Register activation hook to ensure roles are created upon plugin activation
register_activation_hook(__FILE__, 'tm_activate_plugin');

function tm_activate_plugin() {
    tm_add_custom_user_roles();
    tm_register_cpts();
    flush_rewrite_rules();
}

// Register deactivation hook to clean up
register_deactivation_hook(__FILE__, 'tm_deactivate_plugin');

function tm_deactivate_plugin() {
    flush_rewrite_rules();
}
