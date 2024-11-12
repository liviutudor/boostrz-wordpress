<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Boostrz_Includes {

    public function __construct() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/class/class-boostrz-admin-menu.php');

        // Use the admin_enqueue_scripts action hook to add the style only in the admin area
        add_action( 'admin_enqueue_scripts', array($this,'boostrz_add_admin_styles') );
        add_action( 'wp_enqueue_scripts', array($this,'boostrz_add_custom_script') );


        
    }


    // Hook into admin_enqueue_scripts to add the custom admin style
    public function boostrz_add_admin_styles() {
        // Path to your CSS file
        wp_register_style( 'boostrz-admin-style', BOOSTRZ_PLUGIN_URL . 'assets/css/admin-style.css', [], '1.0.0' );
		wp_enqueue_style( 'boostrz-admin-style' );

        

    }

    public function boostrz_add_custom_script(){
        // wp_register_script('boostrz-custom-js', BOOSTRZ_PLUGIN_URL . 'assets/js/boostrz-tag-script.js', [], '',true);
        // wp_enqueue_script('boostrz-custom-js');
        // wp_add_inline_script('boostrz-custom-script', 'console.log("qqqqqqqqqqq");');
    }
      
}

// Instantiate the menu class
$boostrz_includes = new Boostrz_Includes();


