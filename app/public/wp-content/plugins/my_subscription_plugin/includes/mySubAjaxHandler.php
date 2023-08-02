<?php

class mySubAjaxHandler{

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('my_subscription_form', array($this, 'form_shortcode'));
        add_action('wp_ajax_my_subscription_ajax', array($this, 'ajax_handler'));
        add_action('wp_ajax_nopriv_my_subscription_ajax', array($this, 'ajax_handler'));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('my-subscription-script', plugin_dir_url(__FILE__) . '../js/my_subscription_script.js');

        wp_localize_script('my-subscription-script', 'my_subscription_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }

    public function form_shortcode() {
        ob_start();
        ?>
        <form id="my-subscription-form">
            <input type="email" name="email" required placeholder="Enter your email">
            <button type="submit">Subscribe Me</button>
        </form>
        <div id="subscription-message"></div>
        <?php
         return ob_get_clean();
        
    }


    public function ajax_handler() {
        if (isset($_POST['email'])) {
            $email = sanitize_email($_POST['email']);
    
            // Get the selected email template details
            $template_id = intval($_POST['Email Subscription template']);
            $templates = get_option('my_plugin_email_templates', array());
            $template = isset($templates[$template_id]) ? $templates[$template_id] : null;
    
            if (!$template) {
                wp_send_json_error('Invalid email template.');
            }
    
            $subject = $template['subject'];
            $header = $template['header'];
            $message = $template['message'];
    
            // Add additional headers if needed
            $headers = array(
                'From: <phptest912@gmail.com>',
                'Content-Type: text/html; charset=UTF-8',
            );
    
            // Combine header and message
            $full_message = $header . "\n\n" . $message;
    
            $result = wp_mail($email, $subject, $full_message, $headers);
    
            if ($result) {
                wp_send_json_success('success');
            } else {
                wp_send_json_error('An error occurred while sending the email.');
            }
        }
        wp_die();
    }
    




    
}

new mySubAjaxHandler();