<?php
/**
 * Plugin Name: Training Manager
 * Description: A plugin to manage training events with a proposal and approval workflow.
 * Version: 1.0
 * Author: Your Name
 * Text Domain: training-manager
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin path
define( 'TM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Include necessary files
require_once TM_PLUGIN_PATH . 'includes/cpt.php';
require_once TM_PLUGIN_PATH . 'includes/user_roles.php';
require_once TM_PLUGIN_PATH . 'includes/functions.php';

// Initialize the plugin
function tm_initialize_plugin() {
    // Register CPTs
    tm_register_cpts();

    // Add user roles and capabilities
    tm_add_custom_user_roles_and_caps();
    tm_add_custom_caps_to_roles();
}
add_action( 'init', 'tm_initialize_plugin' );

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'tm_activate_plugin' );
register_deactivation_hook( __FILE__, 'tm_deactivate_plugin' );

// Activation hook function
function tm_activate_plugin() {
    // Register CPTs and roles on activation
    tm_register_cpts();
    tm_add_custom_user_roles_and_caps();
    tm_add_custom_caps_to_roles();

    // Flush rewrite rules
    flush_rewrite_rules();
}

// Deactivation hook function
function tm_deactivate_plugin() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
}
