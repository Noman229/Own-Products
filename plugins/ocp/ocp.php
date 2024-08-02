<?php
    /*
    * Plugin Name:       Online Comitte Portal
    * Plugin URI:        https://noman229.github.io/portfolio/
    * Description:       Handle the basics of online comitte portal with this plugin.
    * Version:           1.0
    * Requires at least: 6.1
    * Requires PHP:      7.2
    * Author:            Noman Khan
    * Author URI:        https://author.example.com/
    * License:           GPL v2 or later
    * License URI:       https://example.com/
    * Update URI:        https://example.com/
    * Text Domain:       ocp
    */
    defined( 'ABSPATH' ) || exit;

    include_once plugin_dir_path(__FILE__) . 'includes/dashboard.php';
    include_once plugin_dir_path(__FILE__) . 'includes/table.php';

    
    // Enqueue admin assets
    function ocp_admin_enqueue() {
        wp_enqueue_style('ocp-admin-select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
        wp_enqueue_style('ocp-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');

        wp_enqueue_script('ocp-admin-select2-script', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);
        wp_enqueue_script('ocp-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), null, true);
    }
    add_action('admin_enqueue_scripts', 'ocp_admin_enqueue');


    // Enqueue frontend CSS
    function ocp_frontend_enqueue() {
        wp_enqueue_style('ocp-frontend-style', plugin_dir_url(__FILE__) . 'assets/css/frontend-style.css');
        wp_enqueue_script('ocp-frontend-script', plugin_dir_url(__FILE__) . 'assets/js/frontend-script.js', array('jquery'), null, true);
    }
    add_action('wp_enqueue_scripts', 'ocp_frontend_enqueue');
    
    // Activation hook
    function ocp_activate() {
        ocp_create_database_table();
    }
    register_activation_hook(__FILE__, 'ocp_activate');
    
    // Deactivation hook
    function ocp_deactivate() {
    // Code to run during deactivation
    }
    register_deactivation_hook(__FILE__, 'ocp_deactivate');




   