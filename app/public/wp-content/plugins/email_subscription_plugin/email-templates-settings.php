<?php
// Template settings page
function email_subscription_plugin_email_template_page()
{
    $templates = get_option('email_subscription_plugin_email_template', array());

?>
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
                            <pre><?php echo esc_html($template['header']); ?></pre>
                        </td>
                        <td>
                            <pre><?php echo esc_html($template['message']); ?></pre>
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
