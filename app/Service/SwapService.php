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
        // List of supported assets
        $supportedAssets = ['BTC', 'ETH', 'XRP', 'LTC', 'DAI', 'BUSD']; // Add more as needed

        // Check if both assets are supported
        if (!in_array($fromAsset, $supportedAssets) || !in_array($toAsset, $supportedAssets)) {
            return false;
        }

        // Check if assets are not the same
        if ($fromAsset === $toAsset) {
            return false;
        }

        // Check if the amount is a positive number
        if (!is_numeric($amount) || $amount <= 0) {
            return false;
        }

        // If all checks pass
        return true;
    }


    private function getExchangeRate($fromAsset, $toAsset)
    {
        // Assuming you have a table 'currency_rates' with 'currency' and 'rate' columns
        $rateFrom = CurrencyRate::where('currency', strtoupper($fromAsset))->value('rate');
        $rateTo = CurrencyRate::where('currency', strtoupper($toAsset))->value('rate');

        if (!$rateFrom || !$rateTo) {
            throw new \Exception("Exchange rates for one or both assets could not be retrieved.");
            return true;
        }

        // Calculate and return the exchange rate as a float
        // Be careful with direct division as it can lead to floating point precision issues
        // Depending on the use-case, consider using a library for precise mathematical operations
        return (float) number_format($rateTo / $rateFrom, 2, '.', '');
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
        // Fetch the current session data for the user
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'] ?? null;
    
        // Determine the step in the session and act accordingly
        switch ($step) {
            case 'get swap option':
                // The user provides the 'from' and 'to' assets
                list($fromAsset, $toAsset) = explode('_', $user_response);
                $user_session_data['from_asset'] = $fromAsset;
                $user_session_data['to_asset'] = $toAsset;

                // Update the session to move to the next step
                $user_session_data['step'] = 'get swap amount';
                $user_session->update_session($user_session_data);
    
                // Prompt the user for the amount to swap
                $this->sendMessageToUser($user_id, "How much {$fromAsset} do you want to swap to {$toAsset}?");
    
               
                break;
    
            case 'get swap amount':
                // User provides the amount to swap
                $amount = $user_response;
                $fromAsset = $user_session_data['from_asset'];
                $toAsset = $user_session_data['to_asset'];
    
                // TODO: Check if the user has the amount available (not implemented here)
                // For now, we'll assume the user has the amount
    
                // Store the amount in the session
                $user_session_data['amount'] = $amount;
    
                // Calculate the expected amount to receive after the swap
                $exchangeRate = $this->getExchangeRate($fromAsset, $toAsset);
                $receivedAmount = $amount * $exchangeRate;
    
                // Send exchange info with an inline keyboard for confirmation
                $message = "You have requested to swap {$amount} {$fromAsset} to {$toAsset}.\n"
                . "Current exchange rate: 1 {$fromAsset} = {$exchangeRate} {$toAsset}.\n\n"
                . "You will approximately receive: {$receivedAmount} {$toAsset}.\n\n"
                . "Do you want to proceed with the swap?";
                $inlineKeyboard = $this->getInlineKeyboardConfirmCancel();
    
                $this->sendMessageToUser($user_id, $message, $inlineKeyboard);
    
                // Update session to wait for user's confirmation
                $user_session_data['step'] = 'confirm swap';
                $user_session->update_session($user_session_data);
                break;
    
            case 'confirm swap':
                // Process the callback from the inline keyboard

                $amount = $user_session_data['amount'];
                $fromAsset = $user_session_data['from_asset'];
                $toAsset = $user_session_data['to_asset'];

                if ($user_response === 'confirm') {
                    // User confirmed the swap
                    if ($fromAsset && $toAsset && $amount) {
                        // Here you would call your exchange service
                        // For instance, this might be an internal method that interacts with an API
                        $swapResult = $this->swapCrypto($user_id, $fromAsset, $toAsset, $amount);
                        
                        if ($swapResult['success']) {
                            // If the swap was successful, send a success message to the user
                            $this->sendMessageToUser($user_id, "Your swap was successful. " . $swapResult['message']);
                        } else {
                            // If the swap failed, send an error message to the user
                            $this->sendMessageToUser($user_id, "There was a problem with your swap: " . $swapResult['message']);
                        }
                    } else {
                        // If any of the necessary data is missing, inform the user to start over
                        $this->sendMessageToUser($user_id, "Swap details missing. Please start over.");
                    }
                    
                    // After attempting the swap, end the session
                    $user_session->endSession(); // Make sure the endSession method actually exists and is implemented
                        
                } elseif ($user_response === 'cancel') {
                    // User cancelled the swap
                    $this->sendMessageToUser($user_id, "Swap cancelled.");
    
                    // End the session
                    $user_session->endSession(); // Replace with the actual method that ends the session
                }
                break;
    
    
            default:
                // Handle unknown step
                $this->sendMessageToUser($user_id, "I'm not sure what you're trying to do. Can you please start over?");
                break;
        }
    
        return true; // If the session should remain active, or handle ending the session if needed
    }
    
    private function getInlineKeyboardConfirmCancel() {
        // Define the inline keyboard with confirm and cancel options
        return json_encode([
            'inline_keyboard' => [
                [
                    ['text' => 'Yes, proceed', 'callback_data' => 'confirm'],
                    ['text' => 'No, cancel', 'callback_data' => 'cancel']
                ]
            ]
        ]);
    }
}
