<?php
/*
Plugin Name: Boostrz Tag Manager 
Plugin URI: https://boostrz.io/boostrz-wordpress-plugin/
Description: This plugin allows you to easily deploy the Boostrz.io tracking tag on any WordPress website, enabling real-time tracking of user activity, conversions, and campaign performance.
Version: 1.1.4
Author: Boostrz Inc
Author URI: https://boostrz.io
Text Domain: boostrz-tag-manager
License: GNU General Public License (GPL) version 3
Company Name: Boostrz Inc
*/
// Include menu handler file


// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define a constant for the plugin directory
define( 'BOOSTRZ_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BOOSTRZ_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BOOSTRZ_API_URL', 'https://app.boostrz.com' );
define( 'BOOSTRZ_API_KEY', 'https://app.boostrz.com' );
define( 'BOOSTRZ_TABLE_NAME', 'boostrz_api' );
// time in second to cache the tag - 6 hours
define( 'BOOSTRZ_CACHE_SET_TIME', 21600 );



//wp_die(sanitize_text_field( wp_unslash('6b8ea7de70<>???//!@#$%^&*()') ));
class Boostrz_Wordpress {
    public function __construct() {

        register_activation_hook(__FILE__, array($this, 'boostrz_activate'));
        register_deactivation_hook(__FILE__, array($this, 'boostrz_deactivate'));
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/include.php');

    }

    // Function to run on plugin activation
    public function boostrz_activate() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/boostrz-activate.php');
    }
    // Function to run on plugin deactive 
    public function boostrz_deactivate(){
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/boostrz-deactivate.php');
    }
}

// Instantiate the plugin class
$boostrz_wordpress = new Boostrz_Wordpress();
