<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add custom user roles and capabilities
function tm_add_custom_user_roles_and_caps() {
    add_role('training_organizer', 'Training Organizer', array(
        'read' => true,
        'edit_posts' => true,
        'delete_posts' => true,
        'edit_training_proposals' => true,
        'delete_training_proposals' => true,
        'publish_training_proposals' => true,
        'edit_training_events' => true,
    ));

    add_role('training_coordinator', 'Training Coordinator', array(
        'read' => true,
        'edit_training_proposals' => true,
        'delete_training_proposals' => true,
        'publish_training_proposals' => true,
        'edit_training_events' => true,
        'publish_training_events' => true,
        'delete_training_events' => true,
    ));

    add_role('world_zone_leader', 'World Zone Leader', array(
        'read' => true,
        'edit_training_proposals' => true,
        'delete_training_proposals' => true,
        'publish_training_proposals' => true,
        'edit_training_events' => true,
        'publish_training_events' => true,
        'delete_training_events' => true,
    ));

    add_role('trainee', 'Trainee', array(
        'read' => true,
    ));
}

// Ensure capabilities are assigned to the roles
function tm_add_custom_caps_to_roles() {
    $roles = ['training_organizer', 'training_coordinator', 'world_zone_leader'];
    $caps = [
        'edit_training_proposals',
        'delete_training_proposals',
        'publish_training_proposals',
        'edit_training_events',
        'publish_training_events',
        'delete_training_events'
    ];

    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            foreach ($caps as $cap) {
                $role->add_cap($cap);
            }
        }
    }
}
