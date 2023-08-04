<?php

class wdmEmailSubAjaxHandler
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('email_subscription_code', array($this, 'form_shortcode'));
        add_action('wp_ajax_my_subscription_ajax', array($this, 'ajax_handler'));
        add_action('wp_ajax_nopriv_my_subscription_ajax', array($this, 'ajax_handler'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('email-subscription-script', plugin_dir_url(__FILE__) . '../js/email-subscription-script.js');

        wp_localize_script('email-subscription-script', 'my_subscription_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }

    public function form_shortcode()
    {
        ob_start();
?>
        <form id="email-subscription-form">
            <input type="email" name="email" required placeholder="Enter your email">
            <button type="submit" id="subscribe-button">Subscribe Me</button>
        </form>
        <div id="subscription-message"></div>
<?php
        return ob_get_clean();
    }



    public function ajax_handler()
    {
        if (isset($_POST['email'])) {
            $email = sanitize_email($_POST['email']);

            $template_id = intval($_POST['Email Subscription template']);
            $templates = get_option('emailsub_plugin_email_templates', array());
            $template = isset($templates[$template_id]) ? $templates[$template_id] : null;

            if (!$template) {
                wp_send_json_error('Invalid email template.');
            }

            $subject = $template['subject'];
            $message = $template['message'];
            $value = get_option('smtp_from');

            $header = array(
                'From:' . $value,
                'Content-Type: text/html; charset=UTF-8',
            );

            $full_message = 'Hey!! ' . $email . "\n\n" . $message;

            $result = wp_mail($email, $subject, $full_message, $header);


            if ($result) {
                wp_send_json_success('success');
            } else {
                wp_send_json_error('An error occurred while sending the email.');
            }
        }
        wp_die();
    }
}

new wdmEmailSubAjaxHandler();
