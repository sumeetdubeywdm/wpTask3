<?php
// Display the country on single post display page
function display_country_on_single_post($content) {
    if (is_singular('post')) {
        $post_id = get_the_ID();
        $country = get_post_meta($post_id, '_country_location', true);

        if (!empty($country && !($country=='Not Selected'))) {
            $content .= '<p><strong>Country:</strong> ' . esc_html($country) . '</p>';
        }
    }

    return $content;
}
add_filter('the_content', 'display_country_on_single_post');

function country_shortcode(){

}

add_shortcode('country_shortcodeTest', 'country_shortcode');
