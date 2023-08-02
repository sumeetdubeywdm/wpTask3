<?php
// Template settings page
function my_plugin_email_templates_page() {
    $show_add_template_fields = false;
    $templates = get_option('my_plugin_email_templates', array());

    if (isset($_POST['submit_template'])) {
        // Save the new template or update the existing template
        $template = array(
            'title' => sanitize_text_field($_POST['template_title']),
            'subject' => sanitize_text_field($_POST['template_subject']),
            'header' => sanitize_textarea_field($_POST['template_header']),
            'message' => sanitize_textarea_field($_POST['template_message']),
        );

        $template_id = isset($_POST['edit_template']) ? intval($_POST['edit_template']) : -1;
        if ($template_id >= 0) {
            // Update existing template
            $templates[$template_id] = $template;
        } else {
            // Save the new template
            $templates[] = $template;
        }

        update_option('my_plugin_email_templates', $templates);
    } elseif (isset($_POST['add_new_template'])) {
        // Show the fields for adding a new template
        $show_add_template_fields = true;
    } elseif (isset($_POST['edit_template'])) {
        // Show the fields for editing a template
        $edit_template_id = intval($_POST['edit_template']);
        $edit_template = $templates[$edit_template_id];
        $show_add_template_fields = true;
    } elseif (isset($_POST['delete_template'])) {
        // Delete the selected template
        $delete_template_id = intval($_POST['delete_template']);
        unset($templates[$delete_template_id]);
        update_option('my_plugin_email_templates', $templates);
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php if (!$show_add_template_fields) : ?>
            <!-- Display the "Add New Template" button -->
            <form method="post" action="">
                <input type="hidden" name="add_new_template" value="1" />
                <p><input type="submit" class="button-primary" value="Add New Template" /></p>
            </form>
        <?php else : ?>
            <?php if (isset($edit_template)) : ?>
                <!-- Display the form to edit an existing template -->
                <form method="post" action="">
                    <input type="hidden" name="edit_template" value="<?php echo intval($edit_template_id); ?>" />
                    <table class="form-table">
                        <tr>
                            <th scope="row">Template Title</th>
                            <td><input type="text" name="template_title" value="<?php echo esc_attr($edit_template['title']); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Subject</th>
                            <td><input type="text" name="template_subject" value="<?php echo esc_attr($edit_template['subject']); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Header</th>
                            <td><textarea name="template_header" rows="4" cols="50"><?php echo esc_textarea($edit_template['header']); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Message</th>
                            <td><textarea name="template_message" rows="10" cols="50"><?php echo esc_textarea($edit_template['message']); ?></textarea></td>
                        </tr>
                    </table>
                    <p>
                        <input type="submit" name="submit_template" class="button-primary" value="Update Template" />
                        <input type="submit" name="cancel_template" class="button" value="Cancel" />
                    </p>
                </form>
            <?php else : ?>
                <!-- Display the form to add a new template -->
                <form method="post" action="">
                    <table class="form-table">
                        <tr>
                            <th scope="row">Template Title</th>
                            <td><input type="text" name="template_title" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Subject</th>
                            <td><input type="text" name="template_subject" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Header</th>
                            <td><textarea name="template_header" rows="4" cols="50"></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Template Message</th>
                            <td><textarea name="template_message" rows="10" cols="50"></textarea></td>
                        </tr>
                    </table>
                    <p>
                        <input type="submit" name="submit_template" class="button-primary" value="Save Template" />
                        <input type="submit" name="cancel_template" class="button" value="Cancel" />
                    </p>
                </form>
            <?php endif; ?>
        <?php endif; ?>

        <h2>Available Templates</h2>
        <?php
        if (empty($templates)) {
            echo '<p>No templates available.</p>';
        } else {
            ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Template Title</th>
                        <th>Subject</th>
                        <th>Header</th>
                        <th>Message</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($templates as $template_id => $template) {
                        ?>
                        <tr>
                            <td><?php echo esc_html($template['title']); ?></td>
                            <td><?php echo esc_html($template['subject']); ?></td>
                            <td><pre><?php echo esc_html($template['header']); ?></pre></td>
                            <td><pre><?php echo esc_html($template['message']); ?></pre></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="edit_template" value="<?php echo $template_id; ?>" />
                                    <input type="submit" class="button" value="Edit" />
                                </form>
                                <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete this template?');">
                                    <input type="hidden" name="delete_template" value="<?php echo $template_id; ?>" />
                                    <input type="submit" class="button" value="Delete" />
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
    </div>
    <?php
}
