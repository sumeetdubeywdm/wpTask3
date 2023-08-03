<?php

class email_subscription_Admin_Menu
{

    public function init()
    {
        // Add the main menu to the admin menu
        add_action('admin_menu', array($this, 'add_main_menu'));
        add_action('admin_menu', array($this, 'add_submenus'));
        add_action('wp_enqueue_scripts', array($this,'email_sub_enqueue_styles'));
       
    }


    public function add_main_menu()
    {
        add_menu_page(
            'Email Subscription',       // Page Title
            'Email Subscription',       // Menu Title
            'manage_options',  // Capability
            'email-subscriptitonid-plugin',       // Menu Slug
            array($this, 'display_main_page'), // Callback function 
            'dashicons-email'  // Icon URL or Dashicon class
        );
    }

    // Display heading
    public function display_main_page()
    {
?>
        <h1>Welcome to Email Subscription Plugin</h1>

<?php
    }

    // Adding submenu in Email subscription menu
    public function add_submenus()
    {

        add_submenu_page(
            'email-subscriptitonid-plugin',        // Parent slug 
            'Email subscription Plugin Settings', // Page Title
            'Settings',          // Menu Title
            'manage_options',    // Capability
            'email-subscriptitonid-plugin-settings', // Sub-menu Slug
            'Email_subscription_settings_page' // Callback function 
        );

        // Add email templates sub-menu
        add_submenu_page(
            'email-subscriptitonid-plugin',           // Parent slug 
            'Email Templates',     // Page Title
            'Email Templates',     // Menu Title
            'manage_options',      // Capability
            'email-subscriptitonid-plugin-email-templates', // Sub-menu Slug
            'email_subscription_plugin_email_template_page' // Callback function 
        );
    }

    // Addin css for disabling button
    public function email_sub_enqueue_styles() {
        $css_file_url = plugin_dir_url(__FILE__) . '../css/emailsub.css';
        wp_enqueue_style('emailsub', $css_file_url);
    }

      
      
      
}


$email_subscription_admin_menu = new email_subscription_Admin_Menu();
$email_subscription_admin_menu->init();
