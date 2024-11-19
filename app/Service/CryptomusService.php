<?php
namespace App\Service;

use Cryptomus\Api\Client as Cryptomus;
use Illuminate\Support\Facades\Log;

class CryptomusService {
    protected $cryptomus;
    protected $networks = ["DAI"=>"BSC","USDT"=>"BSC","BUSD"=>"BSC","ETH"=>"ETH","SOL"=>"Solana","MATIC"=>"POLYGON"];

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

    public function generateOrderID($length = 16) {
        $numbers = '0123456789';
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $orderID = '';
    
        // Ensure at least one letter and one number
        $orderID .= $letters[rand(0, strlen($letters) - 1)];
        $orderID .= $numbers[rand(0, strlen($numbers) - 1)];
    
        // Generate the rest of the string
        for ($i = 2; $i < $length; $i++) {
            $choice = rand(0, 1);
            if ($choice) {
                // Add a letter
                $orderID .= $letters[rand(0, strlen($letters) - 1)];
            } else {
                // Add a number
                $orderID .= $numbers[rand(0, strlen($numbers) - 1)];
            }
        }
    
        // Shuffle the string to ensure randomness
        $orderID = str_shuffle($orderID);
    
        return $orderID;
    }
}
