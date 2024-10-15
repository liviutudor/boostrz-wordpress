<?php
class ENDPOINT_API {
    private $api_key;
    private $headers;
    private $api_url;

    public function __construct() {
            // Set the API key
            
            
        $this->api_url = BOOSTRZ_API_URL;

        // Set the headers
        if(isset($this->endpoint_type)  && $this->endpoint_type == 'token'){
            

            $this->headers = array(
                'Authorization' => 'Bearer ' . $this->boostrz_api_token,
                'Content-Type' => 'application/json'
            );

        }else{
            $this->headers = array(
                'Content-Type' => 'application/json'
            );

        }
        
    }

    public function boostrz_curl($body){

        $url = $this->api_url.'/'.$this->endpoint;
        $response = wp_remote_post($url, array(
            'headers' => $this->headers,
            'body' => json_encode($body),
            'timeout' => 30,
        ));
        // Check for errors
        if (is_wp_error($response)) {
            $error_msg = $response->get_error_message();
            return array(
                'success' => false,
                'error_message' => "Something went wrong: $error_msg",
                'client'=>  null
                );

        } else {
            // Get the response body
            return array(
                'success' => true,
                'data'=>  json_decode(wp_remote_retrieve_body($response))
                );
             

        }

    }

    public function get_boostrz_curl($params){

        $url = $this->api_url . '/' . $this->endpoint;
        
        // Append parameters to the URL
        //$url = add_query_arg($params, $url);

        // Make the request
        $response = wp_remote_get($url, array(
            'headers' => $this->headers,
        ));
        // Check for errors
        if (is_wp_error($response)) {
            $error_msg = $response->get_error_message();
            return array(
                'success' => false,
                'error_message' => "Something went wrong: $error_msg",
            );
        } else {
            // Get the response body
            return array(
                'success' => true,
                'data' => json_decode(wp_remote_retrieve_body($response))
            );
        }
    }

    public function get_boostrz_curl_script($params){

        $url = $this->api_url . '/' . $this->endpoint;
        
        // Append parameters to the URL
        //$url = add_query_arg($params, $url);

        // Make the request
        $response = wp_remote_get($url, array(
            'headers' => $this->headers,
        ));
        // Check for errors
        if (is_wp_error($response)) {
            $error_msg = $response->get_error_message();
            return array(
                'success' => false,
                'error_message' => "Something went wrong: $error_msg",
            );
        } else {
            // Get the response body
            return array(
                'success' => true,
                'data' => json_encode(wp_remote_retrieve_body($response))
            );
        }
    }

   
    

}