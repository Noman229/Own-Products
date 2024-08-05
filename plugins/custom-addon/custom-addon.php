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
	function register_content_carousel( $widgets_manager ) {
		require_once( __DIR__ . '/widget/content_carousel.php' );
		$widgets_manager->register( new \Elementor_Content_Carousel() );
	}
	add_action( 'elementor/widgets/register', 'register_content_carousel' );
	
	function elementor_widgets_dependencies() {

		/* Scripts */
		// wp_register_script( 'jquery' );
		wp_register_script(  'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true );
		wp_register_script( 'custom-js', plugin_dir_url(__FILE__) . '/assets/custom.js', array('jquery'), null, true  );

		/* Styles */
		wp_register_style(  'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
		wp_register_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
	}
	add_action( 'wp_enqueue_scripts', 'elementor_widgets_dependencies' );