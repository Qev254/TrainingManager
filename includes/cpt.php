<?php
// Register Custom Post Types
function tm_register_cpts() {
    // Register Training Proposal CPT
    $proposal_labels = array(
        'name' => _x('Training Proposals', 'Post Type General Name', 'training-manager'),
        'singular_name' => _x('Training Proposal', 'Post Type Singular Name', 'training-manager'),
        'menu_name' => _x('Training Proposals', 'Admin Menu text', 'training-manager'),
        'name_admin_bar' => _x('Training Proposal', 'Add New on Toolbar', 'training-manager'),
        'all_items' => __('All Training Proposals', 'training-manager'),
        'add_new_item' => __('Add New Training Proposal', 'training-manager'),
        'new_item' => __('New Training Proposal', 'training-manager'),
        'edit_item' => __('Edit Training Proposal', 'training-manager'),
        'view_item' => __('View Training Proposal', 'training-manager'),
        'search_items' => __('Search Training Proposal', 'training-manager'),
        'not_found' => __('Not found', 'training-manager'),
        'not_found_in_trash' => __('Not found in Trash', 'training-manager'),
    );
    $proposal_args = array(
        'label' => __('Training Proposal', 'training-manager'),
        'labels' => $proposal_labels,
        'supports' => array('title', 'editor', 'custom-fields'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'has_archive' => true,
        'exclude_from_search' => false,
        'capability_type' => array('training_proposal', 'training_proposals'),
        'map_meta_cap' => true,
    );

    // Inside tm_register_cpts()
$proposal_args = array(
    // ... other arguments ...
    'capability_type' => array('training_proposal', 'training_proposals'),
    'capabilities' => array(
        'publish_posts' => 'publish_training_proposals',
        'edit_posts' => 'edit_training_proposals',
        'edit_others_posts' => 'edit_others_training_proposals',
        'delete_posts' => 'delete_training_proposals',
        'delete_others_posts' => 'delete_others_training_proposals',
        'read_private_posts' => 'read_private_training_proposals',
        'edit_post' => 'edit_training_proposal',
        'delete_post' => 'delete_training_proposal',
        'read_post' => 'read_training_proposal',
    ),
    'map_meta_cap' => true,
);

$event_args = array(
    // ... other arguments ...
    'capability_type' => array('training_event', 'training_events'),
    'capabilities' => array(
        'publish_posts' => 'publish_training_events',
        'edit_posts' => 'edit_training_events',
        'edit_others_posts' => 'edit_others_training_events',
        'delete_posts' => 'delete_training_events',
        'delete_others_posts' => 'delete_others_training_events',
        'read_private_posts' => 'read_private_training_events',
        'edit_post' => 'edit_training_event',
        'delete_post' => 'delete_training_event',
        'read_post' => 'read_training_event',
    ),
    'map_meta_cap' => true,
);

    register_post_type('training_proposal', $proposal_args);

    // Register Training Event CPT
    $event_labels = array(
        'name' => _x('Training Events', 'Post Type General Name', 'training-manager'),
        'singular_name' => _x('Training Event', 'Post Type Singular Name', 'training-manager'),
        'menu_name' => _x('Training Events', 'Admin Menu text', 'training-manager'),
        'name_admin_bar' => _x('Training Event', 'Add New on Toolbar', 'training-manager'),
        'all_items' => __('All Training Events', 'training-manager'),
        'add_new_item' => __('Add New Training Event', 'training-manager'),
        'new_item' => __('New Training Event', 'training-manager'),
        'edit_item' => __('Edit Training Event', 'training-manager'),
        'view_item' => __('View Training Event', 'training-manager'),
        'search_items' => __('Search Training Event', 'training-manager'),
        'not_found' => __('Not found', 'training-manager'),
        'not_found_in_trash' => __('Not found in Trash', 'training-manager'),
    );
    $event_args = array(
        'label' => __('Training Event', 'training-manager'),
        'labels' => $event_labels,
        'supports' => array('title', 'editor', 'custom-fields'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'has_archive' => true,
        'exclude_from_search' => false,
        'capability_type' => array('training_event', 'training_events'),
        'map_meta_cap' => true,
    );
    register_post_type('training_event', $event_args);
}

add_action('init', 'tm_register_cpts');
