<?php

class Conversific_Admin_Dashboard
{
    public static function output()
    {
        include(dirname(__FILE__) . '/views/html-admin-page-dashboard.php');
    }

    public static function check_wc()
    {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
    }

    public static function getPath()
    {
        return plugins_url("conversific");
    }

    public static function checkApiIsEnabled()
    {
        return get_option('woocommerce_api_enabled', false) == "yes" ? true : false;
    }

    public static function checkApiKeys()
    {
        global $wpdb;

        $auth_data = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}woocommerce_api_keys WHERE description = 'CONVERSIFIC_API_CONNECT';");

        return $auth_data > 0;
    }

    public static function getApiUrl()
    {
        return get_option('siteUrl');
    }
}
