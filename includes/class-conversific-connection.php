<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class Conversific_Connection
{
    protected static $_instance = null;

    /**
     * Conversific_Connection constructor.
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'initStyleSheet'));
        add_action('wp_ajax_conversific_remove_api_keys', array($this, 'removePreviousApiKeys'));
        add_action('plugins_loaded', array($this, 'loadTextDomain'));
        include( dirname( __FILE__ ) . '/admin/class-conversific-admin-dashboard.php' );
    }

    public function initStyleSheet()
    {
        wp_enqueue_style('conversific-style', plugin_dir_url(__FILE__) . '../assets/css/conversific-style.css');

    }

    public function loadTextDomain()
    {
        load_plugin_textdomain('conversific', false, dirname( dirname( plugin_basename( __FILE__ ) ) )  . '/languages/');
    }

    /**
     * Get the plugin url.
     *
     * @return string
     */
    public function plugin_url() {
        return untrailingslashit( plugins_url( '/', CONVERSIFIC_PLUGIN_FILE ) );
    }

    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( CONVERSIFIC_PLUGIN_FILE ) );
    }

    public function run()
    {
        add_action('admin_menu', array($this, 'add_menu'));
    }

    public function add_menu()
    {
        add_menu_page(__('Conversific Connection', 'conversific'),
            'Conversific',
            'manage_options',
            'conversific-dashboard',
            array($this, 'dashboard'),
            'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NDEuNyA1MTAiPg0KICA8dGl0bGU+Y29udjwvdGl0bGU+DQogIDxwYXRoIGQ9Ik0yNTcuMywxLjEsMzYuNSwxMjguNnYyNTVMMjU3LjMsNTExLjEsNDc4LjIsMzgzLjZ2LTI1NVpNMzkwLjgsMzMxLjRsLTEzMy40LDc3LTEzMy40LTc3VjE3Ny4zbDEzMy40LTc3LDEzMy40LDc3Wk0yNTcuMywxMjUuNlYyNTQuM0wxNDUuOSwxOTBWMzE4LjdsMTExLjUsNjQuNCwxMTEuNS02NC40VjE5MFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zNi41IC0xLjEpIiBmaWxsPSIjZjBmNWZhIi8+DQo8L3N2Zz4NCg==',
            '55.7');
    }

    /**
     * Init the settings page.
     */
    public function dashboard()
    {
        Conversific_Admin_Dashboard::output();
    }

    public function removePreviousApiKeys()
    {
        global $wpdb;
        $wpdb->delete($wpdb->prefix . 'woocommerce_api_keys', array('description' => 'CONVERSIFIC_API_CONNECT'));

        return true;
    }
}