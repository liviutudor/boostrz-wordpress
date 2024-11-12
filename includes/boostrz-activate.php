<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class BoostrzActivate {
    public function __construct() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'tables/boostrz-api-table.php');
        
        $this->boostrz_activate();
    }

    public function boostrz_activate(){
        
        if ( ! get_option( 'boostrz_option' ) ) {
            add_option( 'boostrz_option', 'default_value' );
        }

        $boostrz_api_table = new Boostrz_API_Table();
        $boostrz_api_table->create_table();
        
        
    }
   

        
}

// Instantiate the plugin class
$activate = new BoostrzActivate();