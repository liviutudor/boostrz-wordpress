<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Boostrz_Admin_Menu {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );


    add_action('wp_footer', array($this, 'add_custom_script_to_footer'),999);
    }

    // Function to add the admin menu
    public function add_admin_menu() {
        add_menu_page(
            'Boostrz Settings',   // Page title
            'Boostrz',            // Menu title
            'manage_options',     // Capability
            'boostrz-settings',   // Menu slug
            array( $this, 'display_settings_page' ), // Callback function
            // 'dashicons-admin-generic', // Icon
            BOOSTRZ_PLUGIN_URL."img/svg_logo.svg",
            6                    // Position
        );
    }

    // Callback function to display the settings page
    public function display_settings_page() {
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

    function add_custom_script_to_footer() {
        $current_website_selected = get_option( 'boostrz_current_website_selected' );
        if($current_website_selected){
            global $wpdb;
            $table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME;
            $get_website = $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $table_name WHERE base_url = %s", $current_website_selected)
            );

            $script =  json_decode($get_website->script_tag);
        }


        ?>
        <script type="text/javascript">
            // Your JavaScript code here
            <?php echo $script; ?>
            console.log('This script is added before </body> tag.');
        </script>
        <?php
    }
    
}

// Instantiate the menu class
$boostrz_admin_menu = new Boostrz_Admin_Menu();