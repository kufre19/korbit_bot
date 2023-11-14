<?php

namespace App\Service;

use App\Models\CurrencyRate;


class ExchangeRateService
{
    public function updateRates()
    {
        $this->updateCurrencyRate('DAI');
        $this->updateCurrencyRate('BUSD');
    }

    private function updateCurrencyRate($currency)
    {
        // Fetch the current rate
        $currentRate = CurrencyRate::where('currency', $currency)->first();

        // Generate a new random price
        $newPrice = $this->generateRandomPrice(0.98, 1.05);

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

