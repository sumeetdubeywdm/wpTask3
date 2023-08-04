<?php
// Template settings page
function email_sub_email_templates_page()
{

    $templates = get_option('emailsub_plugin_email_templates', array());

    if (isset($_POST['submit_template'])) {
        $template = array(
            'title' => sanitize_text_field($_POST['template_title']),
            'subject' => sanitize_text_field($_POST['template_subject']),
            'message' => sanitize_textarea_field($_POST['template_message']),
        );

        $templates[0] = $template;

        update_option('emailsub_plugin_email_templates', $templates);
    } elseif (isset($_POST['edit_template'])) {
        $edit_template_id = intval($_POST['edit_template']);
        $edit_template = $templates[$edit_template_id];
    } elseif (isset($_POST['cancel_template'])) {
        unset($edit_template);
    }
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <form method="post" action="">
        <input type="hidden" name="add_new_template" value="1" />
    </form>

    <?php if (isset($edit_template)) : ?>
    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th scope="row">Template Title</th>
                <td><input type="text" name="template_title" value="<?php echo esc_attr($edit_template['title']); ?>" />
                </td>
            </tr>
            <tr>
                <th scope="row">Template Subject</th>
                <td><input type="text" name="template_subject"
                        value="<?php echo esc_attr($edit_template['subject']); ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Template Message</th>
                <td><textarea name="template_message" rows="10"
                        cols="50"><?php echo esc_textarea($edit_template['message']); ?></textarea></td>
            </tr>
        </table>
        <p>
            <input type="submit" name="submit_template" class="button-primary" value="Update Template" />
            <input type="submit" name="cancel_template" class="button" value="Cancel" />
        </p>
    </form>

    <?php else : ?>

    <?php
            if (empty($templates)) {
                echo '<p>No templates available.</p>';
            } else {
            ?>
    <table class="wp-list-table widefat fixed striped" >
        <thead>
            <tr>
                <th>Template Title</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Want to Change</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        foreach ($templates as $template_id => $template) {
                        ?>
            <tr>
                <td><?php echo esc_html($template['title']); ?></td>
                <td><?php echo esc_html($template['subject']); ?></td>
                <td>
                    <pre><?php echo esc_html($template['message']); ?></pre>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="edit_template" value="<?php echo $template_id; ?>" />
                        <input type="submit" class="button" value="Edit" />
                    </form>
                </td>
            </tr>
            <?php
                        }
                        ?>
        </tbody>
    </table>
    <?php
            }
            ?>

    <?php endif; ?>
</div>
<?php
}
?>