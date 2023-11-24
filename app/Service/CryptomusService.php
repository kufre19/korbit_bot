<?php
namespace App\Service;

use Cryptomus\Api\Client as Cryptomus;

class CryptomusService {
    protected $cryptomus;
    protected $networks = ["DAI"=>"dai"];

    public function __construct() {
        $this->cryptomus = new Cryptomus()  ;
    }

    public function createPayment($amount, $currency, $orderId,$callback_url) {
        try {
            $payment_obj = $this->cryptomus::payment(env('CRYPTOMUS_API_KEY'),env('CRYPTOMUS_MERCHANT_UUID'));

            $data = [
                'amount' => '16',
                'currency' => 'USD',
                'network' => 'ETH',
                'order_id' => "ghjdfyujhwefjwejb77685687qwgyfy",
                'url_return' => 'https://example.com/return',
                'url_callback' => 'https://example.com/callback',
                'is_payment_multiple' => false,
                'lifetime' => '7200',
                'to_currency' => 'ETH'
            ];
            
            $response = $payment_obj->create($data);

            if (isset($response->address) && $response->address != null) {
                return [true,$response];
                
            } else {
                return [false,"There was an error fetching address"];
            }
        }  catch (\Cryptomus\Api\RequestBuilderException $e) {
            log('Error request Cryptomus to method ' . $e->getMethod() . ': ' . $e->getMessage());
        }
    }
}
