<?php
// App/Service/SwapService.php

namespace App\Service;

use App\Models\CurrencyRate;
use App\Models\User;
use App\Models\Wallet;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use ServiceInterface;
use App\Traits\SendMessages; // If you have a trait for sending messages

class SwapService implements ServiceInterface
{
    use SendMessages; // Use this if you have a trait for sending messages

    /**
     * Swap cryptocurrencies.
     * 
     * @param int $userId
     * @param string $fromAsset
     * @param string $toAsset
     * @param float $amount
     * @return array
     */
    public function swapCrypto($userId, $fromAsset, $toAsset, $amount)
    {
        // Validate input...
        if (!$this->validateInput($fromAsset, $toAsset, $amount)) {
            return [
                'success' => false,
                'message' => 'Invalid input.'
            ];
        }

        // Check if user has enough balance...
        $wallet = Wallet::where('user_id', $userId)->first();
        $balanceFieldFrom = 'balance_' . strtolower($fromAsset);
        if ($wallet->$balanceFieldFrom < $amount) {
            return [
                'success' => false,
                'message' => 'Insufficient funds.'
            ];
        }

         // Fetch exchange rate
         $daiRate = CurrencyRate::where('currency', 'DAI')->value('price');
         $busdRate = CurrencyRate::where('currency', 'BUSD')->value('price');
 
         // Calculate the exchange rate
         $exchangeRate = $fromAsset === 'DAI' ? ($daiRate / $busdRate) : ($busdRate / $daiRate);

        // // Get the current exchange rate...
        // $exchangeRate = $this->getExchangeRate($fromAsset, $toAsset); // You need to implement this method

        // Calculate the amount to receive...
        $receivedAmount = $amount * $exchangeRate;

        DB::beginTransaction();
        try {
            // Fetch user's wallet
            $wallet = $wallet->lockForUpdate()->first();

            // Deduct fromAsset
            $wallet->$balanceFieldFrom -= $amount;

            // Add toAsset
            $balanceFieldTo = 'balance_' . strtolower($toAsset);
            $wallet->$balanceFieldTo += $receivedAmount;

            $wallet->save();

            // Log the transaction...
            $this->logTransaction($userId, $fromAsset, $toAsset, $amount, $receivedAmount);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Swap successful!'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function validateInput($fromAsset, $toAsset, $amount)
    {
        // Implement your validation logic here
        // Return true if valid, false otherwise
    }

    private function getExchangeRate($fromAsset, $toAsset)
    {
        // Implement the logic to fetch the current exchange rate
        // Return the exchange rate as a float
    }

    private function logTransaction($userId, $fromAsset, $toAsset, $amount, $receivedAmount)
    {
        // Log the transaction details
        TransactionLog::create([
            'user_id' => $userId,
            'from_asset' => $fromAsset,
            'to_asset' => $toAsset,
            'amount' => $amount,
            'received_amount' => $receivedAmount
        ]);
    }

    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        // Implement logic for continuing bot session
        // You can use $this->sendMessageToUser(...) if you have the SendMessages trait
    }


}
