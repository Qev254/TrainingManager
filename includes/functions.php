<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add custom button to create event from proposal
function tm_add_create_event_button($post) {
    if ($post->post_type == 'training_proposal' && current_user_can('publish_posts', $post->ID)) {
        echo '<a href="' . esc_url(admin_url('admin-post.php?action=create_training_event&proposal_id=' . $post->ID)) . '" class="button button-primary">Create Event</a>';
    }
}
add_action('post_submitbox_misc_actions', 'tm_add_create_event_button');

// Handle the creation of a training event from a proposal
function tm_create_training_event_from_proposal() {
    if (!isset($_GET['proposal_id']) || !current_user_can('publish_posts', $_GET['proposal_id'])) {
        wp_die(__('You do not have permission to perform this action.'));
    }

    $proposal_id = intval($_GET['proposal_id']);
    $proposal = get_post($proposal_id);

    if (!$proposal || $proposal->post_type != 'training_proposal') {
        wp_die(__('Invalid proposal.'));
    }

    // Copy data from proposal to new event
    $new_event = array(
        'post_title' => $proposal->post_title,
        'post_content' => $proposal->post_content,
        'post_status' => 'publish',
        'post_type' => 'training_event',
    );

    $new_event_id = wp_insert_post($new_event);

    // Copy ACF fields
    $fields = ['venue', 'start_date', 'end_date', 'country', 'region'];
    foreach ($fields as $field) {
        $value = get_field($field, $proposal_id);
        update_field($field, $value, $new_event_id);
    }

    // Redirect to the new event
    wp_redirect(admin_url('post.php?post=' . $new_event_id . '&action=edit'));
    exit;
}
add_action('admin_post_create_training_event', 'tm_create_training_event_from_proposal');

// Restrict access to proposals and events based on user roles
function tm_restrict_proposal_and_event_access($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $user = wp_get_current_user();
    if (!in_array('administrator', $user->roles)) {
        if (in_array('training_organizer', $user->roles)) {
            $query->set('author', $user->ID);
        } elseif (in_array('training_coordinator', $user->roles) || in_array('world_zone_leader', $user->roles)) {
            $query->set('post_type', ['training_proposal', 'training_event']);
        } elseif (in_array('trainee', $user->roles)) {
            $query->set('post_type', 'training_event');
            $query->set('post_status', 'publish');
        }
    }
}
add_action('pre_get_posts', 'tm_restrict_proposal_and_event_access');
