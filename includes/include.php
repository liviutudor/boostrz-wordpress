<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Boostrz_Includes {

    public function __construct() {
        require_once(BOOSTRZ_PLUGIN_DIR . 'includes/backend/class/class-boostrz-admin-menu.php');
        
    }

      
}

// Instantiate the menu class
$boostrz_includes = new Boostrz_Includes();
