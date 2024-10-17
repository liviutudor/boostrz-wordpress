<?php
class BOOSTRZ_API_TOKEN extends ENDPOINT_API {

    protected $endpoint_type;
    protected $endpoint;
    private $body;
    public function __construct($array) {
       parent::__construct(); // Calling the constructor of the parent class
        $this->endpoint = 'auth/api-token';
        $this->endpoint_type = 'token';
        $this->body['username'] = isset($array['boostrz_username']) ? $array['boostrz_username'] : '';
        $this->body['password'] = isset($array['boostrz_password']) ? $array['boostrz_password'] : '';
        $this->body['pluginId'] = "boostrz-wordpress";
        $this->body['version']  = "1.0.0";

    }

    public function  token_array_modify(){
        // Request body
        $result = parent::boostrz_curl($this->body);
        
        
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



