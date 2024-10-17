<?php
/*
Plugin Name: Boostrz Tag Manager 
Plugin URI: https://boostrz.io/boostrz-wordpress-plugin/
Description: This plugin allows you to easily deploy the Boostrz.io tracking tag on any WordPress website, enabling real-time tracking of user activity, conversions, and campaign performance.
Version: 1.0.0
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
define( 'BOOSTRZ_API_URL', 'https://app.boostrz.io' );
define( 'BOOSTRZ_API_KEY', 'https://app.boostrz.io' );
define( 'BOOSTRZ_MAIN_DIR', ABSPATH );
define( 'BOOSTRZ_TABLE_NAME', 'boostrz_api' );

class Boostrz_Wordpress {
    public function __construct() {

        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/include.php');

    }

    // Function to run on plugin activation
    public function activate() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/activate.php');
    }
    // Function to run on plugin deactive 
    public function deactivate(){
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/deactivate.php');
    }
}

// Instantiate the plugin class
$boostrz_wordpress = new Boostrz_Wordpress();
