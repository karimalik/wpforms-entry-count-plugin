<?php
/*
Plugin Name: WPForms Entry Counter
Description: A simple plugin to display the number of entries submitted via a WPForms form.
Version: 1.0
Author: Your Name
*/

// Function to retrieve the number of entries submitted for a specified WPForms form
function wpforms_get_entry_count($form_id) {
    $entry_count = wpforms()->entry->get_entries(
        array(
            'form_id' => $form_id,
            'status' => 'complete',
            'count' => true,
        )
    );
    return $entry_count;
}

// Shortcode to display the number of entries submitted for a specified WPForms form
function wpforms_entry_count_shortcode($atts) {
    // Default parameters
    $atts = shortcode_atts(
        array(
            'form_id' => '',
        ),
        $atts,
        'wpforms_entry_count'
    );

    // Check if form_id parameter is specified
    if (empty($atts['form_id'])) {
        return 'Please specify the WPForms form ID.';
    }

    // Get the entry count for the specified form
    $entry_count = wpforms_get_entry_count($atts['form_id']);

    // Display the entry count
    return 'Number of entries for WPForms form ' . $atts['form_id'] . ' : ' . $entry_count;
}
add_shortcode('wpforms_entry_count', 'wpforms_entry_count_shortcode');
