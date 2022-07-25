<?php
/**
* Plugin Name: Elementor Widget - Bootstrap Carousel
* Plugin URI: https://artisansweb.net
* Description: Creates a Bootstrap Carousel.
* Author: Artisans Web
* Version: 1.0
* Author URI: https://artisansweb.net
*/
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
function artisansweb_elementor_addon() {
 
    // Load plugin file
    require_once( __DIR__ . '/includes/plugin.php' );
 
    // Run the plugin
    \Artisansweb_Elementor_Addon\Plugin::instance();
 
}
add_action( 'plugins_loaded', 'artisansweb_elementor_addon' );