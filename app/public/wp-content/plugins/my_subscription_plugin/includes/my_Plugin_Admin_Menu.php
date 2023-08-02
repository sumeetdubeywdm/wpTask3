<?php

class my_Plugin_Admin_Menu {
    
    public function init() {
        // Add the main menu to the admin menu
        add_action('admin_menu', array($this, 'add_main_menu'));

        // Add sub-menu items under the main menu
        add_action('admin_menu', array($this, 'add_submenus'));
    }


    public function add_main_menu() {
        add_menu_page(
            'My Plugin',       // Page Title
            'My Plugin',       // Menu Title
            'manage_options',  // Capability
            'my-plugin',       // Menu Slug
            array($this, 'display_main_page'), // Callback function 
            'dashicons-email'  // Icon URL or Dashicon class
        );
    }


    public function display_main_page() {
        ?>
        <h1>Welcome to My Plugin</h1>
        
        <?php
    }


    public function add_submenus() {
        
        add_submenu_page(
            'my-plugin',        // Parent slug 
            'My Plugin Settings', // Page Title
            'Settings',          // Menu Title
            'manage_options',    // Capability
            'my-plugin-settings', // Sub-menu Slug
            'my_plugin_settings_page' // Callback function 
        );

        // Add email templates sub-menu
        add_submenu_page(
            'my-plugin',           // Parent slug 
            'Email Templates',     // Page Title
            'Email Templates',     // Menu Title
            'manage_options',      // Capability
            'my-plugin-email-templates', // Sub-menu Slug
            'my_plugin_email_templates_page' // Callback function 
        );
    }
}


$my_plugin_admin_menu = new My_Plugin_Admin_Menu();
$my_plugin_admin_menu->init();
