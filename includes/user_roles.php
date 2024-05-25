<?php
// Define custom user roles and capabilities
function tm_add_custom_user_roles() {
    // Training Organizer (TO)
    add_role('training_organizer', 'Training Organizer', array(
        'read' => true,
        'edit_training_proposals' => true,
        'edit_training_events' => true,
        'publish_training_proposals' => true,
        'publish_training_events' => true,
        'delete_training_proposals' => true,
        'delete_training_events' => true,
        'edit_others_training_proposals' => true,
        'edit_others_training_events' => true,
    ));

    // Training Coordinator (TC)
    add_role('training_coordinator', 'Training Coordinator', array(
        'read' => true,
        'edit_training_proposals' => true,
        'edit_training_events' => true,
        'publish_training_proposals' => true,
        'publish_training_events' => true,
        'delete_training_proposals' => true,
        'delete_training_events' => true,
        'edit_others_training_proposals' => true,
        'edit_others_training_events' => true,
    ));

    // World Zone Leader (WZL)
    add_role('world_zone_leader', 'World Zone Leader', array(
        'read' => true,
        'edit_training_proposals' => true,
        'edit_training_events' => true,
        'publish_training_proposals' => true,
        'publish_training_events' => true,
        'delete_training_proposals' => true,
        'delete_training_events' => true,
        'edit_others_training_proposals' => true,
        'edit_others_training_events' => true,
    ));
}
