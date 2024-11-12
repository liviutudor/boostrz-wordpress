<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class BoostrzDeactivate {
    public function __construct() {
        $this->boostrz_deactivate();
    }

    public function boostrz_deactivate(){

        // delete_option( 'boostrz_option' );
        // delete_option( 'boostrz_username' );
        // delete_option( 'boostrz_password' );
        // delete_option( 'boostrz_api_token' );
        // delete_option( 'boostrz_api_token_expiry' );

    }

   
}

// Instantiate the plugin class
$deactivate = new BoostrzDeactivate();