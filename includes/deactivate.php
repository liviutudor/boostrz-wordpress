<?php
class Deactivate {
    public function __construct() {
        $this->deactivate();
    }

    public function deactivate(){

        // delete_option( 'boostrz_option' );
        // delete_option( 'boostrz_username' );
        // delete_option( 'boostrz_password' );
        // delete_option( 'boostrz_api_token' );
        // delete_option( 'boostrz_api_token_expiry' );

    }

   
}

// Instantiate the plugin class
$deactivate = new Deactivate();