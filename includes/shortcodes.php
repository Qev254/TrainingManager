<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register shortcodes
function tm_register_shortcodes() {
    add_shortcode('tm_dashboard', 'tm_dashboard_shortcode');
    add_shortcode('tm_proposal_form', 'tm_proposal_form_shortcode');
    add_shortcode('tm_proposal_list', 'tm_proposal_list_shortcode');
    add_shortcode('tm_event_form', 'tm_event_form_shortcode');
    add_shortcode('tm_event_list', 'tm_event_list_shortcode');
}
add_action('init', 'tm_register_shortcodes');

// Dashboard Shortcode
function tm_dashboard_shortcode() {
    ob_start();

    // Output different content based on user role
    if (current_user_can('training_organizer') || current_user_can('training_coordinator') || current_user_can('world_zone_leader')) {
        echo '<h2>Training Management Dashboard</h2>';
        echo '<div class="tm-dashboard-section">';
        echo do_shortcode('[tm_proposal_form]');
        echo '</div>';
        echo '<div class="tm-dashboard-section">';
        echo do_shortcode('[tm_proposal_list]');
        echo '</div>';
        echo '<div class="tm-dashboard-section">';
        echo do_shortcode('[tm_event_form]');
        echo '</div>';
        echo '<div class="tm-dashboard-section">';
        echo do_shortcode('[tm_event_list]');
        echo '</div>';
    } elseif (current_user_can('trainee')) {
        echo '<h2>Trainee Dashboard</h2>';
        echo '<div class="tm-dashboard-section">';
        echo do_shortcode('[tm_event_list]');
        echo '</div>';
    }

    return ob_get_clean();
}

// Proposal Form Shortcode
function tm_proposal_form_shortcode() {
    ob_start();

    // Use ACF Frontend form for creating/editing proposals
    if (function_exists('acf_form')) {
        acf_form(array(
            'post_id' => 'new_post',
            'new_post' => array(
                'post_type' => 'training_proposal',
                'post_status' => 'publish'
            ),
            'field_groups' => array('group_basic_event_details'),
            'submit_value' => __('Submit Proposal', 'training-manager')
        ));
    }

    return ob_get_clean();
}

// Proposal List Shortcode
function tm_proposal_list_shortcode() {
    ob_start();

    $query = new WP_Query(array(
        'post_type' => 'training_proposal',
        'post_status' => 'publish',
        'author' => get_current_user_id(), // Show only proposals by current user
    ));

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li>';
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No proposals found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

// Event Form Shortcode
function tm_event_form_shortcode() {
    ob_start();

    if (isset($_GET['proposal_id'])) {
        $proposal_id = intval($_GET['proposal_id']);

        // Use ACF Frontend form for creating events from proposals
        if (function_exists('acf_form')) {
            acf_form(array(
                'post_id' => 'new_post',
                'new_post' => array(
                    'post_type' => 'training_event',
                    'post_status' => 'publish'
                ),
                'field_groups' => array('group_basic_event_details'),
                'submit_value' => __('Create Event', 'training-manager'),
                'return' => add_query_arg('created', 'true', get_permalink())
            ));
        }
    } else {
        echo '<p>No proposal selected.</p>';
    }

    return ob_get_clean();
}

// Event List Shortcode
function tm_event_list_shortcode() {
    ob_start();

    $query = new WP_Query(array(
        'post_type' => 'training_event',
        'post_status' => 'publish',
        'author' => get_current_user_id(), // Show only events by current user
    ));

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li>';
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No events found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
?>
