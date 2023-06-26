<?php
defined( 'ABSPATH' ) || exit;
class NP {

    public $api_url;
    public $api_key;

    public function __construct() {
        $config = WC()->shipping->get_shipping_methods()['simple_np_shipping_method'] ?? '';
        $config = (array)$config;
        $this->api_url = 'https://api.novaposhta.ua/v2.0/json/';
        $this->api_key = $config['settings']['np_api_key'] ?? '';
        // add_action( 'wp_ajax_get_billing_city', array( $this, 'search_settlements' ) );
    }


    public function search_settlements() {
        $data = array(
            'body' => array(
                'apiKey' => $this->api_key,
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
                'methodProperties' => array(
                    'FindByString' => (!empty($_POST['city'])) ? sanitize_text_field($_POST['city']) : '',
                    'Limit' => (!empty($_POST['limit'])) ? sanitize_text_field($_POST['limit']) : 5,
                ) 
            )
        );

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode( $data['body'] )
        );
        $result = wp_remote_post( $this->api_url, $args );
             

        if(is_array($result) && !empty($result['body'])){
            var_dump(json_decode($result['body'], JSON_UNESCAPED_UNICODE));
        }
        else{
        	echo json_encode(array( 'success' => false));
        }
        
        //die();
    }

}