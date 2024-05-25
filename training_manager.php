<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add custom roles
function tm_add_custom_user_roles() {
    add_role(
        'training_organizer',
        __('Training Organizer', 'training-manager'),
        array(
            'read' => true,
            'edit_posts' => true,
            'edit_training_proposals' => true,
            'edit_others_training_proposals' => true,
            'publish_training_proposals' => true,
            'delete_training_proposals' => true,
            'delete_others_training_proposals' => true,
            'read_private_training_proposals' => true,
            'edit_training_events' => true,
            'edit_others_training_events' => true,
            'publish_training_events' => true,
            'delete_training_events' => true,
            'delete_others_training_events' => true,
            'read_private_training_events' => true,
        )
    );

    add_role(
        'training_coordinator',
        __('Training Coordinator', 'training-manager'),
        array(
            'read' => true,
            'edit_posts' => true,
            'edit_training_proposals' => true,
            'edit_others_training_proposals' => true,
            'publish_training_proposals' => true,
            'delete_training_proposals' => true,
            'delete_others_training_proposals' => true,
            'read_private_training_proposals' => true,
            'edit_training_events' => true,
            'edit_others_training_events' => true,
            'publish_training_events' => true,
            'delete_training_events' => true,
            'delete_others_training_events' => true,
            'read_private_training_events' => true,
        )
    );

    add_role(
        'world_zone_leader',
        __('World Zone Leader', 'training-manager'),
        array(
            'read' => true,
            'edit_posts' => true,
            'edit_training_proposals' => true,
            'edit_others_training_proposals' => true,
            'publish_training_proposals' => true,
            'delete_training_proposals' => true,
            'delete_others_training_proposals' => true,
            'read_private_training_proposals' => true,
            'edit_training_events' => true,
            'edit_others_training_events' => true,
            'publish_training_events' => true,
            'delete_training_events' => true,
            'delete_others_training_events' => true,
            'read_private_training_events' => true,
        )
    );
}

add_action('init', 'tm_add_custom_user_roles');

// Remove custom roles on plugin deactivation
function tm_remove_custom_user_roles() {
    remove_role('training_organizer');
    remove_role('training_coordinator');
    remove_role('world_zone_leader');
}

register_deactivation_hook(__FILE__, 'tm_remove_custom_user_roles');
?>
