<?php
class BOOSTRZ_API_WEBSITE_LIST extends ENDPOINT_API {

    protected $endpoint;
    protected $endpoint_type;
    protected $boostrz_api_token;
    private $body;
    public function __construct($array) {
       
        $this->endpoint_type = 'token';
        $this->endpoint = 'api/external/tools/websites';
        $this->boostrz_api_token = get_option('boostrz_api_token');

        parent::__construct($this); // Calling the constructor of the parent class
    }

    public function  website_list_array_modify(){
        // Request body
        $result = parent::get_boostrz_curl($this);

        
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



