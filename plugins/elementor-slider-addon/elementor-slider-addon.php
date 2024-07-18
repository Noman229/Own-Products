<?php
/**
 * Plugin Name: Slider Addons For Elementor
 * Description: Unlock the full potential of Elementor and elevate your website with enhanced layouts, responsive design, and more.
 * Version:     1.0.0
 * Author:      Nk Developer
 * Author URI:  https://www.linkedin.com/in/nomankhandeveloper/
 * Text Domain: elementor-slider-addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function custom_elementor_widget_init() {
    // Check if Elementor is installed and active
    if ( did_action( 'elementor/loaded' ) ) {
        require_once plugin_dir_path( __FILE__ ) . 'includes/content-slider.php';
    }
}
add_action( 'plugins_loaded', 'custom_elementor_widget_init' );


function slider_addon_scripts() {
    wp_enqueue_style( 'slider-addon-style', plugins_url( '/assets/css/style.css', __FILE__ ) );
	wp_enqueue_script( 'slider-addon-scripts', plugins_url( '/assets/js/custom.js', __FILE__ ), array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'slider_addon_scripts' );
