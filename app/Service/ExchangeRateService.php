<?php

namespace App\Service;

use App\Models\CurrencyRate;


class ExchangeRateService
{

    private $rates = [
        "DAI"=>["min"=>0.9589,"max"=>0.9702],
        "BUSD"=>["min"=>0.9980,"max"=>1.020],
        "USDT"=>["min"=>0.9999,"max"=>1.001],
    ];
    public function updateRates()
    {
        $this->updateCurrencyRate('DAI');
        $this->updateCurrencyRate('BUSD');
        $this->updateCurrencyRate('USDT');

    }



    private function updateCurrencyRate($currency)
    {
        // Fetch the current rate
        $currentRate = CurrencyRate::where('currency', $currency)->first() ;
        if(!$currentRate)
        {
            $currentRate = 0;
        }

        // Generate a new random price
        $newPrice = $this->generateRandomPrice($this->rates[$currency]['min'], $this->rates[$currency]['max']);

        // Update the record with the old and new prices
        CurrencyRate::updateOrCreate(
            ['currency' => $currency],
            [
                'old_price' => $currentRate ? $currentRate->price : null,
                'price' => $newPrice
            ]
        );
    }

    private function generateRandomPrice($min, $max)
    {
        return rand($min * 10000, $max * 10000) / 10000;
    }

    

    public function getAssetPrices()
    {

    }
}

