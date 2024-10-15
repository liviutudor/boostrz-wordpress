<?php
  
// Check if form was submitted and save data
if ( isset( $_POST['submit_boostrz_website_tag'] ) ) {
    // api
    require_once(BOOSTRZ_PLUGIN_DIR . 'endpoints/endpoint-api.php'); 

    require_once(BOOSTRZ_PLUGIN_DIR . 'endpoints/endpoint-api-website-script-tag.php');
    

    $boostrz_website = sanitize_text_field( $_POST['boostrz_website_list'] );

    if (empty($boostrz_website)) {
        echo '<div class="notice notice-error"><p>Please select website fields.</p></div>';
        return true;
    }


    $boostrz_website_script_tag = new BOOSTRZ_API_WEBSITE_SCRIPT_TAG($_POST);
    $boostrz_website_script_tag = $boostrz_website_script_tag->website_script_array_modify(); 
    if(isset($boostrz_website_script_tag) && !$boostrz_website_script_tag['success']){
        echo '<div class="notice notice-error"><p>'.$boostrz_website_script_tag['error_message'].'.</p></div>';
        return true;
    }else{
        //boostrz_current_website_selected
        update_option( 'boostrz_current_website_selected', $_POST['boostrz_website_list'] );
        $responsive_data = api_script_data_update_in_DB($boostrz_website_script_tag['api_data'],$_POST);
        
        echo '<div class="updated"><p>Settings saved successfully!</p></div>';
        return true;
    }

    
    //echo '<div class="updated"><p>Settings saved successfully!</p></div>';



    
}

function api_script_data_update_in_DB($api_data,$array){

    global $wpdb;
    $table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME;
    $save_data = [];


    if($api_data){

        $boostrz_website_url = $array['boostrz_website_list'];
        
        //$save_data['base_url'] = $boostrz_website_url;
        $save_data['script_tag'] = $api_data;
        $where = array('base_url' => $boostrz_website_url);

        $updted = $wpdb->update($table_name, $save_data, $where);

        // Check if insert was successful
        if ($updted === false) {
            // Handle error
            $error = $wpdb->last_error;
            return array(
                'success' => false,
                'error' => $error
            );
        } else {

            // Fetch the inserted row
            $inserted_data = $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $table_name WHERE base_url = %s", $boostrz_website_url)
            );

            return array(
                'success' => true,
                'last_insert_id' => $inserted_data->id,
                'inserted_data' => $inserted_data
            );
        }

    }
}