<?php
class BOOSTRZ_API_WEBSITE_SCRIPT_TAG extends ENDPOINT_API {

    protected $endpoint;
    protected $endpoint_type;
    protected $boostrz_api_token;
    private $body;
    public function __construct($array) {
        global $wpdb;
        $table_name = esc_sql($wpdb->prefix . BOOSTRZ_TABLE_NAME);
        $boostrz_website_list = !empty($array['boostrz_website_list']) ? $array['boostrz_website_list'] : '';

        // Cache key based on the website list selection
        $cache_key = 'boostrz_website_script_tag_' . md5($boostrz_website_list);
        
        // Check if the result is already cached
        $website_list_cache = wp_cache_get($cache_key, 'boostrz_cache_script_tag_group');
        if ($website_list_cache === false) {

            $website_list = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM $table_name WHERE base_url = %s", 
                    $boostrz_website_list
                )
            );

            // Store the result in cache for 5 minutes (300 seconds)
            wp_cache_set($cache_key, $website_list, 'boostrz_cache_script_tag_group', BOOSTRZ_CACHE_SET_TIME);

        }
        
       
        $this->endpoint_type = 'token';
        $this->endpoint = 'api/external/site-config/'.$website_list->website_id.'/script';
        $this->boostrz_api_token = get_option('boostrz_api_token');

        parent::__construct($this); // Calling the constructor of the parent class
    }

    public function  website_script_array_modify(){

        
        // Request body
        $result = parent::get_boostrz_curl_script($this);
        
        
        if($result['success'] == false){
            return array(
            'success' => false,
            'error_message' => $result['error_message'],
            );

        }else{

            $res = $result['data'];
            if (isset($res->error)) {

                if(isset($res->message)){
                    $error_msg  =   $res->message;
                }else{
                    $error_msg  =   $res->error;
                }
    
                return array(
                'success' => false,
                'error_message' => $error_msg,
                );
    
            }elseif(empty($res)){
                return array(
                    'success' => false,
                    'error_message' => 'Do not Panic! Server error'
                    );

            }else{ 
    
                return array(
                    'success' => true,
                    'api_data'=> $res
                );
    
            }
        }


    }

}



