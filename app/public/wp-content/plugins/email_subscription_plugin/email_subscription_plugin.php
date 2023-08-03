<?php

/*
Plugin Name: Email Subscription Plugin
Version: 1.00.1
Author: Sumeet Dubey
Description: A simple plugin to handle email subscriptions.
*/


require_once plugin_dir_path(__FILE__) . './includes/mySubAjaxHandler.php';
require_once(plugin_dir_path(__FILE__) . './includes/email_subscription_admin_menu.php');
require_once plugin_dir_path(__FILE__) . 'smtp-email-setting.php';
require_once plugin_dir_path(__FILE__) . 'plugin-settings.php';
require_once plugin_dir_path(__FILE__) . 'email-templates-settings.php';


add_action('admin_init', 'email_subscription_Plugin_register_settings');
add_action('admin_init', 'email_subscription_Plugin_register_email_templates');


// Send email via SMTP
add_action('phpmailer_init', 'my_phpmailer_fun');
function my_phpmailer_fun($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_HOST;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->Username = SMTP_USER;
    $phpmailer->Password = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_NAME;
}

