<?php

// Template settings page
function email_sub_email_templates_page()
{
    $templates = get_option('emailsub_plugin_email_templates', array());

    if (isset($_POST['submit_template'])) {
        $template = array(

            'subject' => sanitize_text_field($_POST['template_subject']),
            'message' => sanitize_textarea_field($_POST['template_message']),
        );

        $templates[0] = $template;

        update_option('emailsub_plugin_email_templates', $templates);
    }

?>

    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <div style="display: flex;">
            <form method="post" action="">
                <table class="form-table">

                    <tr>
                        <th scope="row">Template Subject</th>
                        <td><input type="text" name="template_subject" value="<?php echo esc_attr(isset($templates[0]['subject']) ? $templates[0]['subject'] : ''); ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Template Message</th>
                        <td>
                            <textarea name="template_message" rows="10" cols="50"><?php echo esc_textarea(isset($templates[0]['message']) ? $templates[0]['message'] : ''); ?></textarea>
                        </td>
                    </tr>
                </table>
                <p>
                    <input type="submit" name="submit_template" class="button-primary" value="Update Template" />
                </p>
            </form>

            <div style="margin-left: 100px;">
                <h2>Placeholders</h2>
                <ul>
                    <li>User Email: <code>{useremail}</code></li>
                </ul>
            </div>
        </div>
    </div>
<?php
}
?>