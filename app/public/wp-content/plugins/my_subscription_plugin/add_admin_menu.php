<?php
// Add the main menu in the admin sidebar
function my_plugin_add_admin_menu() {
    add_menu_page(
        'My Plugin', // Page Title
        'My Plugin', // Menu Title
        'manage_options', // Capability
        'my-plugin', // Menu Slug
        'my_plugin_main_page', // Callback function to display the main page content
        'dashicons-email' // Icon URL or Dashicon class
    );
}
add_action('admin_menu', 'my_plugin_add_admin_menu');

// Callback function for the main page content
function my_plugin_main_page() {
    ?>
    <h1>Welcome to My Plugin</h1>
    <!-- Main page content here -->
    <?php
}

// Add sub-menu items under the main menu
function my_plugin_add_submenus() {
    
    add_submenu_page(
        'my-plugin', // Parent slug (should match the main menu slug)
        'My Plugin Settings', // Page Title
        'Settings', // Menu Title
        'manage_options', // Capability
        'my-plugin-settings', // Sub-menu Slug
        'my_plugin_settings_page' // Callback function to display the settings page content
    );

   
    add_submenu_page(
        'my-plugin', 
        'Email Templates', 
        'Email Templates', 
        'manage_options', 
        'my-plugin-email-templates', 
        'my_plugin_email_templates_page' 
    );
}
add_action('admin_menu', 'my_plugin_add_submenus');
