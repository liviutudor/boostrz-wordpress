<?php
class Boostrz_API_Table {
    public function __construct() {

    }
    public static function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME; // Replace with your desired table name
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            
            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                website_id bigint(20) DEFAULT NULL,
                base_url varchar(255) DEFAULT NULL,
                name varchar(255) DEFAULT NULL,
                api_version varchar(50) DEFAULT NULL,
                website_json JSON DEFAULT NULL,
                script_tag longtext DEFAULT NULL,
                status varchar(50) DEFAULT NULL,
                modified datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                created datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
    

    
}
