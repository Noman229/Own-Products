<?php

// Add the admin menu
function ocp_add_admin_menu() {
    add_menu_page(
        'OCP Dashboard',
        'OCP',
        'manage_options',
        'ocp-dashboard',
        'ocp_dashboard_page',
        'dashicons-admin-generic',
        20
    );
}
add_action('admin_menu', 'ocp_add_admin_menu');

// Display the admin page
function ocp_dashboard_page() {
    global $wpdb;

    // Start output buffering to prevent headers sent issue
    ob_start();

    // Handle form submission for adding/editing record
    if (isset($_POST['submit_ocp_form'])) {
        $record_id = intval($_POST['record_id']); // Hidden field to store record ID for editing
        $user_id = intval($_POST['username']);
        $pay_amount = sanitize_text_field($_POST['pay_amount']);
        $status = sanitize_text_field($_POST['status']);
        $date = sanitize_text_field($_POST['date']);
        $username = $wpdb->get_var($wpdb->prepare("SELECT display_name FROM {$wpdb->users} WHERE ID = %d", $user_id));

        if ($username) {
            $table_name = $wpdb->prefix . 'ocp_data';

            if ($record_id) {
                // Update existing record
                $wpdb->update(
                    $table_name,
                    array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'amount' => $pay_amount,
                        'status' => $status,
                        'date' => $date
                    ),
                    array('id' => $record_id),
                    array('%d', '%s', '%s', '%s', '%s'),
                    array('%d')
                );
                echo '<div class="updated"><p>Record updated successfully!</p></div>';
            } else {
                // Insert new record
                $wpdb->insert(
                    $table_name,
                    array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'amount' => $pay_amount,
                        'status' => $status,
                        'date' => $date
                    ),
                    array('%d', '%s', '%s', '%s', '%s')
                );
                echo '<div class="updated"><p>Record added successfully!</p></div>';
            }

            // Redirect to the same page to clear the form
            // wp_safe_redirect(admin_url('admin.php?page=ocp-dashboard'));
            // exit;
        } else {
            echo '<div class="error"><p>Error: User not found.</p></div>';
        }
    }

    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $record_id = intval($_GET['id']);
        $nonce = $_GET['_wpnonce'];

        if (wp_verify_nonce($nonce, 'delete_record_' . $record_id)) {
            $table_name = $wpdb->prefix . 'ocp_data';
            $wpdb->delete($table_name, array('id' => $record_id), array('%d'));
            echo '<div class="updated"><p>Record deleted successfully!</p></div>';
        } else {
            echo '<div class="error"><p>Error: Invalid nonce.</p></div>';
        }

        // Redirect to the same page after deletion
        // wp_safe_redirect(admin_url('admin.php?page=ocp-dashboard'));
        // exit;
    }

    // Get all users with the role "subscriber"
    $args = array(
        'role' => 'subscriber',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $subscribers = get_users($args);

    // Fetch existing record for editing, if applicable
    $edit_record = false;
    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        $edit_record_id = intval($_GET['id']);
        $table_name = $wpdb->prefix . 'ocp_data';
        $edit_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $edit_record_id), ARRAY_A);
    }
    ?>

    <!-- Form for adding/editing records -->
    <form id="ocp_form" method="post" action="">
        <input type="hidden" name="record_id" value="<?php echo $edit_record ? esc_attr($edit_record['id']) : ''; ?>">
        <div>
            <label for="username">Username:</label>
            <select name="username" id="username">
                <option value="">Choose an option</option>
                <?php foreach ($subscribers as $user) {
                    echo '<option value="' . esc_attr($user->ID) . '"' . selected($edit_record ? $edit_record['user_id'] : '', $user->ID, false) . '>' . esc_html($user->display_name) . '</option>';
                } ?>
            </select>
        </div>

        <div>
            <label for="pay_amount">Pay amount:</label>
            <input type="text" id="pay_amount" name="pay_amount" value="<?php echo $edit_record ? esc_attr(number_format($edit_record['amount'], 0)) : ''; ?>">
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">Choose an option</option>
                <option value="Paid" <?php selected($edit_record ? $edit_record['status'] : '', 'Paid'); ?>>Paid</option>
                <option value="Unpaid" <?php selected($edit_record ? $edit_record['status'] : '', 'Unpaid'); ?>>Unpaid</option>
            </select>
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $edit_record ? esc_attr($edit_record['date']) : ''; ?>">
        </div>
        <div style="display: flex; align-items: end;">
            <input type="submit" id="sbmtBtn" name="submit_ocp_form" value="<?php echo $edit_record ? 'Update Record' : 'Add Record'; ?>">
        </div>
    </form>

    <!-- Table for displaying records -->
    <table id="ocp-table" class="wp-list-table widefat fixed">
        <thead>
            <tr>
                <th style="font-weight: 700">Username</th>
                <th style="font-weight: 700">Pay Amount</th>
                <th style="font-weight: 700">Status</th>
                <th style="font-weight: 700">Date</th>
                <th style="font-weight: 700">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $table_name = $wpdb->prefix . 'ocp_data';
            $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

            foreach ($results as $row) {
                echo '<tr>';
                echo '<td>' . esc_html($row['username']) . '</td>';
                echo '<td>' . esc_html(number_format($row['amount'], 0)) . '</td>';
                echo '<td>' . esc_html($row['status']) . '</td>';
                echo '<td>' . esc_html($row['date']) . '</td>';
                echo '<td class="table-action">';
                echo '<a href="' . esc_url(add_query_arg(array('action' => 'edit', 'id' => $row['id']))) . '">Edit</a> ';
                echo '<a href="' . esc_url(add_query_arg(array('action' => 'delete', 'id' => $row['id'], '_wpnonce' => wp_create_nonce('delete_record_' . $row['id'])))) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <?php
    ob_end_flush(); // Flush the output buffer
}
?>