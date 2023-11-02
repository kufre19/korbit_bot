<?php

namespace App\Service;

use App\Models\CurrencyRate;

class ExchangeRateService
{
    public function updateRates()
    {
        $daiPrice = $this->generateRandomPrice();
        $busdPrice = $this->generateRandomPrice();

        CurrencyRate::updateOrCreate(
            ['currency' => 'DAI'],
            ['price' => $daiPrice]
        );

        CurrencyRate::updateOrCreate(
            ['currency' => 'BUSD'],
            ['price' => $busdPrice]
        );

        // Call method to calculate and log the percentage change...
    }

    private function generateRandomPrice()
    {
        // Assuming the price range for DAI and BUSD is between $0.98 to $1.05
        return rand(9800, 10500) / 10000;
    }
}
