<?php
class Boostrz_API_Table {
    public function __construct() {
        // Call the update function when the plugin is activated
        $this->update_table();

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


     // Function to update the table and add new columns
    public static function update_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME;

        // Check if the column 'token' exists, if not, add it
        $column_exists = $wpdb->get_results("SHOW COLUMNS FROM `$table_name` LIKE 'token'");

        if (empty($column_exists)) {
            $sql = "ALTER TABLE $table_name ADD token longtext DEFAULT NULL;";
            $wpdb->query($sql); // Execute the query to add the column
        }
    }
    
}
