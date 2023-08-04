<?php

class wdmEmailSubAdminMenu
{

    public function init()
    {
        add_action('admin_menu', array($this, 'add_main_menu'));
        add_action('admin_menu', array($this, 'add_submenus'));
        add_action('wp_enqueue_scripts', array($this, 'email_sub_enqueue_styles'));
    }


    public function add_main_menu()
    {
        add_menu_page(
            'Email Subscription Plugin',       // Page Title
            'Email Subscription Plugin',       // Menu Title
            'manage_options',  // Capability
            'email-plugin',       // Menu Slug 
            'email_sub_settings_page',
            'dashicons-email'  // Icon URL or Dashicon class
        );
    }



    public function add_submenus()
    {

        add_submenu_page(
            'email-plugin',           // Parent slug 
            'Email Templates',     // Page Title
            'Email Templates',     // Menu Title
            'manage_options',      // Capability
            'email-plugin-email-templates', // Sub-menu Slug
            'email_sub_email_templates_page' // Callback function 
        );
    }

    public function email_sub_enqueue_styles()
    {
        $css_file_url = plugin_dir_url(__FILE__) . '../css/emailsub.css';
        wp_enqueue_style('emailsub', $css_file_url);
    }
}


$wdmEmailSubAdminMenu = new wdmEmailSubAdminMenu();
$wdmEmailSubAdminMenu->init();
