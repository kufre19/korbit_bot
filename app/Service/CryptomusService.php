<?php
namespace App\Service;

use Cryptomus\Api\Client as Cryptomus;
use Illuminate\Support\Facades\Log;

class CryptomusService {
    protected $cryptomus;
    protected $networks = ["DAI"=>"BSC","USDT"=>"BSC","BUSD"=>"BSC"];

    public function __construct() {
        $this->cryptomus = new Cryptomus()  ;
    }

    public function createPayment($amount, $currency, $orderId,$callback_url) {
        try {
            $payment_obj = $this->cryptomus::payment(env('CRYPTOMUS_PAYMENT_KEY'),env('CRYPTOMUS_MERCHANT_UUID'));
            $currency = strtoupper($currency);

            $network = $this->networks[$currency];

         

            $data = [
                'amount' => $amount,
                'currency' => $currency,
                'order_id' => $orderId,
                'url_callback' => $callback_url,
                'is_payment_multiple' => false,
                'lifetime' => '7200',
                'network' => $network
            ];


            
            $response = $payment_obj->create($data);

         
          

            if (isset($response['address']) && $response['address'] != null) {
                return [true,$response];
                
            } else {
                return [false,"An error occured in please try again"];
            }
        }  catch (\Cryptomus\Api\RequestBuilderException $e) {
            Log::error('Error request Cryptomus to method ' . $e->getMethod() . ': ' . $e->getMessage());
        }
    }
}
