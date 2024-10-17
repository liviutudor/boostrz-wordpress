<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Check if form was submitted and save data
if ( isset( $_POST['submit_boostrz_settings'] ) && check_admin_referer( 'boostrz_save_settings', 'boostrz_nonce_field' ) ) {
    // api 
    require_once(BOOSTRZ_PLUGIN_DIR . 'endpoints/endpoint-api.php'); 

    require_once(BOOSTRZ_PLUGIN_DIR . 'endpoints/endpoint-api-token.php');
    require_once(BOOSTRZ_PLUGIN_DIR . 'endpoints/endpoint-api-website-list.php');


    $username = sanitize_text_field( $_POST['boostrz_username'] );
    $password = sanitize_text_field( $_POST['boostrz_password'] );

    if (empty($username) || empty($password)) {
        echo '<div class="notice notice-error"><p>Please fill in both fields.</p></div>';
        return true;
    }
    $array_sanitized    =   [];
    $array_sanitized['boostrz_username']  = isset( $_POST['boostrz_username'] ) ? sanitize_email( $_POST['boostrz_username'] ) : '';
    $array_sanitized['boostrz_password'] = isset( $_POST['boostrz_password'] ) ?  $_POST['boostrz_password'] : '';
    


    $boostrz_api_token = new BOOSTRZ_API_TOKEN($array_sanitized);
    $boostrz_api_token = $boostrz_api_token->token_array_modify(); 

    if(isset($boostrz_api_token) && !$boostrz_api_token['success']){
        echo '<div class="notice notice-error"><p>'.esc_html($boostrz_api_token['error_message']).'.</p></div>';
        return true;
    }else{
        if($boostrz_api_token['api_data']){
                // Save the settings in the database
            // update_option( 'boostrz_username', $username );
            // update_option( 'boostrz_password', $password );
            update_option( 'boostrz_api_token', $boostrz_api_token['api_data']->token );
            update_option( 'boostrz_api_token_expiry', $boostrz_api_token['api_data']->tokenExpiry );
            
            $boostrz_api_website_list = new BOOSTRZ_API_WEBSITE_LIST($array_sanitized);
            $boostrz_api_website_list = $boostrz_api_website_list->website_list_array_modify();

            if(isset($boostrz_api_website_list['success'])){
               
                if(isset($boostrz_api_website_list['api_data'])){
                    $website_api_data = $boostrz_api_website_list['api_data']; 

                    foreach($website_api_data as $w_api_data){
                        
                        $responsive_data = api_data_store_in_DB($w_api_data);

                    }


                }

            }

        }
        
        echo '<div class="updated"><p>Settings saved successfully!</p></div>';
        return true;
    }

    
    //echo '<div class="updated"><p>Settings saved successfully!</p></div>';



    
}

function api_data_store_in_DB($api_data){

    global $wpdb;
    $table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME;
    $save_data = [];

    if($api_data){
        
        $save_data['website_id'] = $api_data->id;
        $save_data['base_url'] = $api_data->baseUrl;
        $save_data['name'] = $api_data->name;
        $save_data['api_version'] = $api_data->apiVersion;
        $save_data['website_json'] = json_encode($api_data);
        $save_data['status'] = 'active';
        $save_data['token'] = get_option('boostrz_api_token');

        if($wpdb->get_row(
            $wpdb->prepare("SELECT * FROM $table_name WHERE base_url = %s", $api_data->baseUrl)
        )){
            $where = array('base_url' => $api_data->baseUrl);

            $inserted = $wpdb->update($table_name, $save_data, $where);

        }else{
            $inserted = $wpdb->insert($table_name, $save_data);
        }

        

        // Check if insert was successful
        if ($inserted === false) {
            // Handle error
            $error = $wpdb->last_error;
            return array(
                'success' => false,
                'error' => $error
            );
        } else {
            // Get the last inserted ID
            $last_insert_id = $wpdb->insert_id;

            // Fetch the inserted row
            $inserted_data = $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $last_insert_id)
            );

            return array(
                'success' => true,
                'last_insert_id' => $last_insert_id,
                'inserted_data' => $inserted_data
            );
        }

    }
}