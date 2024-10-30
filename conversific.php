<?php
/*
Plugin Name: Conversific Connection
Plugin URI: https://conversific.com/
Description: This plugin helps you for connect your woocommerce store with Conversific business intelligence platform
Version: 1.0.6
Author: Conversific
License: GPLv2 or later
Text Domain: conversific
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! defined( 'CONVERSIFIC_PLUGIN_FILE' ) ) {
    define( 'CONVERSIFIC_PLUGIN_FILE', dirname( __FILE__ ) );
}

if ( ! class_exists( 'Conversific_Connection' ) ) {
    include_once dirname( __FILE__ ) . '/includes/class-conversific-connection.php';
}

add_action('wp_enqueue_scripts', array('Conversific_Connection', 'initStyleSheet'));

function run_conversific_connection() {

    $plugin = new Conversific_Connection();
    $plugin->run();

}
run_conversific_connection();
