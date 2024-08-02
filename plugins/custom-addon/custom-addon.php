<?php

/**
 * Plugin Name: Custom Elementor Addon
 * Plugin URI:  https://noman229.github.io/portfolio/
 * Description: Custom addons for Elementor page builder
 * Version:     1.0
 * Author:      Noman Khan
 * Author URI:  https://www.linkedin.com/in/nomankhandeveloper/
 * Text Domain: custom-elementor-addon
 *
 */



	function register_image_and_content_box_with_slider( $widgets_manager ) {
		require_once( __DIR__ . '/widgets/image-and-content-box-with-slider.php' );
		$widgets_manager->register( new \Elementor_Image_And_Content_Box_With_Slider() );
	}
	add_action( 'elementor/widgets/register', 'register_image_and_content_box_with_slider' );

	function enqueue_slick_slider_for_frontend() {
		wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
		wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
		wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'custom-js', plugin_dir_url(__FILE__) . '/widgets/assets/custom.js', array('jquery'), null, true );
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_slick_slider_for_frontend' );
	
	function enqueue_slick_slider_for_admin() {
		// Enqueue the same files if needed in the Elementor editor
		wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
		wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
		wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'custom-js', plugin_dir_url(__FILE__) . 'widgets/assets/custom.js', array('jquery'), null, true );
	}
	add_action( 'elementor/editor/after_enqueue_scripts', 'enqueue_slick_slider_for_admin' );
	