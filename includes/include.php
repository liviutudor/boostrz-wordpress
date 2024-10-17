<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Boostrz_Includes {

    public function __construct() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/class/class-boostrz-admin-menu.php');

        // Use the admin_enqueue_scripts action hook to add the style only in the admin area
        add_action( 'admin_enqueue_scripts', array($this,'boostrz_add_admin_styles') );
        
    }


    // Hook into admin_enqueue_scripts to add the custom admin style
    function boostrz_add_admin_styles() {
        // Path to your CSS file
        wp_register_style( 'boostrz-admin-style', BOOSTRZ_PLUGIN_URL . 'assets/css/admin-style.css', [], '1.0.0' );
		wp_enqueue_style( 'boostrz-admin-style' );
    }
      
}

// Instantiate the menu class
$boostrz_includes = new Boostrz_Includes();


