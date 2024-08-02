<?php


function ocp_create_database_table() {
    global $wpdb;

    // Set the table name (use $wpdb->prefix for table prefix)
    $table_name = $wpdb->prefix . 'ocp_data';

    // Define the SQL query for creating the table
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        username varchar(100) NOT NULL,
        amount decimal(10, 2) NOT NULL,
        status varchar(20) NOT NULL,
        date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Include the WordPress file to handle database upgrades
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}