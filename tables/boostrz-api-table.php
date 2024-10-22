<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class Boostrz_API_Table {
    public function __construct() {
        // Call the update function when the plugin is activated
        

    }
    public static function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = esc_sql($wpdb->prefix . BOOSTRZ_TABLE_NAME); // Replace with your desired table name
        // Cache key for the table check
        $cache_key = 'boostrz_table_exists_' . md5($table_name);
                
        // Check if the result is already cached
        $table_exists = wp_cache_get($cache_key, 'boostrz_cache_for_table_api_group');


        if($table_exists === false){

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            
                $sql = "CREATE TABLE $table_name (
                    id bigint(20) NOT NULL AUTO_INCREMENT,
                    website_id bigint(20) DEFAULT NULL,
                    base_url varchar(255) DEFAULT NULL,
                    name varchar(255) DEFAULT NULL,
                    api_version varchar(50) DEFAULT NULL,
                    website_json JSON DEFAULT NULL,
                    script_tag longtext DEFAULT NULL,
                    token longtext DEFAULT NULL,
                    status varchar(50) DEFAULT NULL,
                    modified datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    created datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);

                // Store the result in cache for 5 minutes (300 seconds)
                wp_cache_set($cache_key, true, 'boostrz_cache_for_table_api_group', BOOSTRZ_CACHE_SET_TIME);  // 300 seconds = 5 minutes
            }
        }
    }


    
}
