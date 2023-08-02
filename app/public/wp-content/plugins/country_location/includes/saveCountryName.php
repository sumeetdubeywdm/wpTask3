<?php

// Save the meta field value when the post is saved or updated
function save_country_location_meta($post_id) {
    if (isset($_POST['country_location'])) {
        $country = sanitize_text_field($_POST['country_location']);
        update_post_meta($post_id, '_country_location', $country);
    }
}
add_action('save_post', 'save_country_location_meta');