<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Boostrz_Admin_Menu
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));


        add_action('wp_enqueue_scripts', array($this, 'add_custom_script_to_footer'), 999);
    }

    // Function to add the admin menu
    public function add_admin_menu()
    {
        add_menu_page(
            'Boostrz Settings',   // Page title
            'Boostrz',            // Menu title
            'manage_options',     // Capability
            'boostrz-settings',   // Menu slug
            array($this, 'display_settings_page'), // Callback function
            // 'dashicons-admin-generic', // Icon
            BOOSTRZ_PLUGIN_URL . "img/svg_logo.svg",
            6                    // Position
        );
    }

    // Callback function to display the settings page
    public function display_settings_page()
    {
        echo '<h1>Boostrz Wordpress Plugin Options</h1>';
        //echo '<p>Here you can configure Boostrz settings.</p>';

        // action 
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/actions/authenticate.php');
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/actions/website-script-tag.php');


        // html include
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/html/authenticate-html.php');
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/html/list-website-html.php');

        // Endpoint API



    }

    function add_custom_script_to_footer()
    {
        $current_website_selected = get_option('boostrz_current_website_selected');
        if ($current_website_selected) {
            global $wpdb;
            $table_name = esc_sql($wpdb->prefix . BOOSTRZ_TABLE_NAME);

            // Create a cache key based on the base URL
            $script_to_cache_key = 'boostrz_api_update_url_' . md5($current_website_selected);

            // Try to retrieve the cached result
            $script_data = wp_cache_get($script_to_cache_key, 'boostrz_cache_api_script_group');

            if ($script_data === false) {
                $custom_wpdb = $wpdb;
                $script_data = $custom_wpdb->get_row(
                    $custom_wpdb->prepare("SELECT * FROM {$table_name} WHERE base_url = %s", $current_website_selected)
                );

                // Cache the result for 5 minutes (300 seconds)
                wp_cache_set($script_to_cache_key, $script_data, 'boostrz_cache_api_script_group', BOOSTRZ_CACHE_SET_TIME);
            }

            $script_safe = json_decode($script_data->script_tag);
        }

        if (isset($script_safe)) {
            wp_enqueue_script('boostrz-script', '//boostrz.io/boostrz-script');
            wp_add_inline_script('boostrz-script', $script_safe);
        } else {
            error_log( "Boostrz script not set.");
        }
    }
}

// Instantiate the menu class
$boostrz_admin_menu = new Boostrz_Admin_Menu();
