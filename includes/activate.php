<?php
class Activate {
    public function __construct() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'tables/boostrz-api-table.php');
        
        $this->activate();
    }

    public function activate(){
        
        if ( ! get_option( 'boostrz_option' ) ) {
            add_option( 'boostrz_option', 'default_value' );
        }

        $boostrz_api_table = new Boostrz_API_Table();
        $boostrz_api_table->create_table();
        
        
    }
   

        
}

// Instantiate the plugin class
$activate = new Activate();