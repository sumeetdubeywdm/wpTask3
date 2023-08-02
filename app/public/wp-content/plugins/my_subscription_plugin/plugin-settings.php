<?php

// Creating the plugin settings page
function my_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_plugin_settings');
            do_settings_sections('my_plugin_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register the plugin settings and fields
function my_plugin_register_settings() {
    add_settings_section(
        'my_plugin_section',
        'SMTP Email Settings',
        'my_plugin_section_callback',
        'my_plugin_settings'
    );

    add_settings_field(
        'smtp_user',  // ID
        'SMTP User', //Display
        'smtp_user_callback',  // Callback function
        'my_plugin_settings', // field added to parent
        'my_plugin_section' // slug
    );

    add_settings_field(
        'smtp_pass',
        'SMTP Password',
        'smtp_pass_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_host',
        'SMTP Host',
        'smtp_host_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_from',
        'SMTP From',
        'smtp_from_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_name',
        'SMTP Name',
        'smtp_name_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_port',
        'SMTP Port',
        'smtp_port_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_secure',
        'SMTP Secure',
        'smtp_secure_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    add_settings_field(
        'smtp_auth',
        'SMTP Auth',
        'smtp_auth_callback',
        'my_plugin_settings',
        'my_plugin_section'
    );

    register_setting('my_plugin_settings', 'smtp_user');
    register_setting('my_plugin_settings', 'smtp_pass');
    register_setting('my_plugin_settings', 'smtp_host');
    register_setting('my_plugin_settings', 'smtp_from');
    register_setting('my_plugin_settings', 'smtp_name');
    register_setting('my_plugin_settings', 'smtp_port');
    register_setting('my_plugin_settings', 'smtp_secure');
    register_setting('my_plugin_settings', 'smtp_auth');
}


function my_plugin_section_callback() {
    echo '<p>Enter your SMTP email settings below:</p>';
}


function smtp_user_callback() {
    $value = get_option('smtp_user');
    echo '<input type="text" name="smtp_user" value="' . esc_attr($value) . '" />';
}

function smtp_pass_callback() {
    $value = get_option('smtp_pass');
    echo '<input type="password" name="smtp_pass" value="' . esc_attr($value) . '" />';
}

function smtp_host_callback() {
    $value = get_option('smtp_host');
    echo '<input type="text" name="smtp_host" value="' . esc_attr($value) . '" />';
}

function smtp_from_callback() {
    $value = get_option('smtp_from');
    echo '<input type="text" name="smtp_from" value="' . esc_attr($value) . '" />';
}

function smtp_name_callback() {
    $value = get_option('smtp_name');
    echo '<input type="text" name="smtp_name" value="' . esc_attr($value) . '" />';
}

function smtp_port_callback() {
    $value = get_option('smtp_port');
    echo '<input type="text" name="smtp_port" value="' . esc_attr($value) . '" />';
}

function smtp_secure_callback() {
    $value = get_option('smtp_secure');
    echo '<input type="text" name="smtp_secure" value="' . esc_attr($value) . '" />';
}

function smtp_auth_callback() {
    $value = get_option('smtp_auth');
    echo '<input type="checkbox" name="smtp_auth" value="1" ' . checked(1, $value, false) . ' />';
}

function my_plugin_register_email_templates() {

    register_setting('my_plugin_email_templates', 'email_template_subject');
    register_setting('my_plugin_email_templates', 'email_template_header');
    register_setting('my_plugin_email_templates', 'email_template_message');
    register_setting('my_plugin_email_templates', 'my_plugin_email_templates'); 
}