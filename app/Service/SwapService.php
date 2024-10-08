<?php
// App/Service/SwapService.php

namespace App\Service;

use App\Models\CurrencyRate;
use App\Models\SwapOrder;
use App\Models\User;
use App\Models\Wallet;
use App\Models\TransactionLog;
use App\Models\WithdrawOrder;
use App\Service\ServiceInterface as ServiceServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Traits\SendMessages;

class SwapService implements ServiceServiceInterface
{
    use SendMessages;
    public $telegram_bot;

    public function __construct()
    {
        $this->telegram_bot = new TelegramBotService();
    }

    /**
     * Swap cryptocurrencies.
     * 
     * @param int $userId
     * @param string $fromAsset
     * @param string $toAsset
     * @param float $amount
     * @return array
     */
   


    private function validateInput($fromAsset, $toAsset, $amount)
    {
        // List of supported assets
        $supportedAssets = ['usdt', 'dai', 'busd']; // Add more as needed

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
        $rateFrom = CurrencyRate::where('currency', strtoupper($fromAsset))->value('price');
        $rateTo = CurrencyRate::where('currency', strtoupper($toAsset))->value('price');

        if (!$rateFrom || !$rateTo) {
            throw new \Exception("Exchange rates for one or both assets could not be retrieved.");
            return true;
        }

        // Calculate and return the exchange rate as a float
        // Be careful with direct division as it can lead to floating point precision issues
        // Depending on the use-case, consider using a library for precise mathematical operations
        return (float) number_format($rateTo / $rateFrom, 4, '.', '');
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
                $fromAsset = ($fromAsset== "dai") ? ucfirst($fromAsset) : strtoupper($fromAsset);
                $toAsset = ($toAsset== "dai") ? ucfirst($toAsset) : strtoupper($toAsset);

                $this->telegram_bot->sendMessageToUser($user_id, "How much {$fromAsset} do you want to swap to {$toAsset}?");


                break;

            case 'get swap amount':
                // User provides the amount to swap
                $amount = $user_response;
                $fromAsset = $user_session_data['from_asset'];
                $toAsset = $user_session_data['to_asset'];

                $fromAsset = ($fromAsset== "dai") ? ucfirst($fromAsset) : strtoupper($fromAsset);


                if ($amount < 50) {
                    $this->telegram_bot->sendMessageToUser($user_id, "The minimum amount for a swap is 50 {$fromAsset}");
                    break;
                }

                // TODO: Check if the user has the amount available (not implemented here)
                // For now, we'll assume the user has the amount

                // Store the amount in the session
                $user_session_data['amount'] = $amount;

                // Calculate the expected amount to receive after the swap
                $exchangeRate = $this->getExchangeRate($fromAsset, $toAsset);
                $receivedAmount = $amount * $exchangeRate;

                // Store the amount to receive in the session
                $user_session_data['amount_to_receive'] = $receivedAmount;

                $response = $this->telegram_bot->sendMessageToUser($user_id, "🔁 Processing...");
                sleep(10);
                $this->telegram_bot->deletMessages($response, $user_id);
                // Send exchange info with an inline keyboard for confirmation
                $message = $this->swapAmountNotice($amount, $fromAsset, $toAsset,$receivedAmount);
                $inlineKeyboard = $this->getInlineKeyboardConfirmCancel();
                sleep(rand(3,6));

                $this->telegram_bot->sendMessageToUser($user_id, $message, $inlineKeyboard);

                // Update session to wait for user's confirmation
                $user_session_data['step'] = 'confirm swap';
                $user_session->update_session($user_session_data);
                break;

            case 'confirm swap':

                // now after user has been sent wallet a swap order should be created for this user (table and model will be needed )
                $amount = $user_session_data['amount'];
                $amount_to_receive = $user_session_data['amount_to_receive'];


                $fromAsset = $user_session_data['from_asset'];
                $toAsset = $user_session_data['to_asset'];

                if ($user_response === 'confirm') {
                    $notify_confirm = <<<MSG
                    📡 Making API call........
                    MSG;
                    $response = $this->telegram_bot->sendMessageToUser($user_id, $notify_confirm);
                    sleep(rand(3, 6));
                    $this->telegram_bot->deletMessages($response, $user_id);

                    $notify_confirm = <<<MSG
                    🛑 Do not close window while making API calls
                    MSG;
                    $response = $this->telegram_bot->sendMessageToUser($user_id, $notify_confirm);

                    sleep(25);
                    $this->telegram_bot->deletMessages($response, $user_id);


                    // Create a swap order record in the database
                    $user = UserService::fetchUserByTgID($user_id);

                    $cryptomus_service = new CryptomusService();
                    $order_id = $cryptomus_service->generateOrderID();

                    $callbackurl = "https://iamconst-m.com/korbit_bot/api/swap/payment/callback";
                    $payment_details = $cryptomus_service->createPayment($amount, $fromAsset, $order_id, $callbackurl);


                    if ($payment_details[0]) {
                        $payment_details = $payment_details[1];
                        SwapOrder::create([
                            'user_id' => $user->id,
                            'from_asset' => $fromAsset,
                            'to_asset' => $toAsset,
                            'amount' => $payment_details['amount'],
                            'amount_to_receive' => $amount_to_receive,
                            "order_id" => $order_id,
                            'status' => 'pending' // Or any appropriate status
                        ]);


                        $amount = number_format($payment_details['amount'],4) ;

                        $notify_confirm = $this->useWalletGenerated($amount, $fromAsset, $payment_details['address'], $payment_details['network'], $order_id, "swap");
                        sleep(rand(3,6));

                        $this->telegram_bot->sendMessageToUser($user_id, $notify_confirm);
                        $user_session->endSession();
                    } else {
                        $this->telegram_bot->sendMessageToUser($user_id, "Sorry there was an error fetching information CEX");
                        $user_session->endSession();
                    }
                } elseif ($user_response === 'cancel') {
                    // User cancelled the swap
                    $this->telegram_bot->sendMessageToUser($user_id, "Swap cancelled.");

                    // End the session
                    $user_session->endSession(); 
                }
                break;

            case 'save withdraw order':
                $order_id = $user_session_data['order_id'];
                $wallet = $user_response;
                $order = SwapOrder::where("order_id",$order_id)->where("status","completed")->first();
                $user = UserService::fetchUserByTgID($user_id);

                WithdrawOrder::create([
                    "user_id"=>$user->id,
                    "amount"=>$order->amount_to_receive,
                    "status"=>"pending",
                    "wallet"=>$wallet,
                    "currency"=>$order->to_asset
                ]);
                $asset_to = ($order->to_asset == "dai") ? ucfirst($order->to_asset) : strtoupper($order->to_asset);


                $msg = "Korbit is triggering CEX swap of {$order->amount_to_receive} {$asset_to} to the specified wallet. Please note that transfer time may vary depending on the blockchain network's current processing speed.";
                $this->telegram_bot->sendMessageToUser($user_id,$msg );
                $user_session->endSession(); 
                break;


            default:
                // Handle unknown step
                $this->telegram_bot->sendMessageToUser($user_id, "I'm not sure what you're trying to do. Can you please start over?");
                break;
        }

        return true; // If the session should remain active, or handle ending the session if needed
    }

    private function getInlineKeyboardConfirmCancel()
    {
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

    private function getInlineKeyboard()
    {
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


    /**
     * Notify user about a successful swap transaction.
     *
     * @param SwapOrder $swapOrder The swap order object containing the transaction details.
     */
    public function notifySuccessfullSwap(SwapOrder $swapOrder)
    {
        // Fetch the user associated with the swap order
        $user = User::where('id', $swapOrder->user_id)->first();

        if (!$user) {
            // Handle case where user is not found
            // Log error or take necessary action
            return;
        }

        // Prepare the message content
        $message = $this->prepareSwapSuccessMessage($swapOrder);

         // Prepare an inline keyboard with the "Automate Transfer" button
        $inlineKeyboard = $this->prepareInlineKeyboardForAutomateTransfer($swapOrder);


        // Send the message to the user using Telegram Bot
        $this->telegram_bot->sendMessageToUser($user->tg_id, $message,$inlineKeyboard);
    }

    /**
     * Prepare a formatted message for swap success notification.
     *
     * @param SwapOrder $swapOrder The swap order object.
     * @return string The formatted message.
     */
    private function prepareSwapSuccessMessage(SwapOrder $swapOrder)
    {
        // Format the swap details into a user-friendly message
        $asset_to = ($swapOrder->to_asset == "dai") ? ucfirst($swapOrder->to_asset) : strtoupper($swapOrder->to_asset);
        $asset_from = ($swapOrder->from_asset == "dai") ? ucfirst($swapOrder->from_asset) : strtoupper($swapOrder->from_asset);

        $message = "Coin Successfully swapped on CEXs\n"
            . "--------------------------------\n"
            . "From: " . $asset_from . "\n"
            . "To: " . $asset_to . "\n"
            . "Amount: " . number_format($swapOrder->amount, 4) . " " . $asset_from  . "\n"
            . "Received: " . number_format($swapOrder->amount_to_receive, 4) . " " . $asset_to . "\n"
            . "Order ID: " . $swapOrder->order_id . "\n"
            . "--------------------------------\n";
            

        return $message;
    }


    
    private function prepareInlineKeyboardForAutomateTransfer(SwapOrder $swapOrder)
    {
        return json_encode([
            'inline_keyboard' => [
                [
                    ['text' => 'Automate Transfer to wallet', 'callback_data' => 'automate_transfer_' . $swapOrder->order_id]
                ]
            ]
        ]);
    }


 


    /**
     * Get formatted swap history for the user.
     *
     * @param int $user_id The ID of the user
     * @return string
     */
    public function getFormattedSwapHistory($user_id)
    {
        $user = UserService::fetchUserByTgID($user_id);

        $swapHistories = TransactionLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10) // Limiting to the last 10 transactions for example
            ->get();

        if ($swapHistories->isEmpty()) {
            return "You have no swap history.";
        }

        $formattedHistory = "🔄 Your Recent Swap History:\n" .
            "---------------------------------\n";

        foreach ($swapHistories as $history) {
            $from_asset = ($history->from_asset == "dai") ? ucfirst($history->from_asset) : strtoupper($history->from_asset);
            $to_asset = ($history->to_asset == "dai") ? ucfirst($history->to_asset) : strtoupper($history->to_asset);

            $formattedHistory .= "📅 " . $history->created_at->format('Y-m-d H:i:s') . ":\n" .
                "💱 " . $from_asset . " to " . $to_asset . "\n" .
                "🪙 Amount: " . number_format($history->amount, 4) . "\n\n" .
                "🪙 Amount Received: " . number_format($history->received_amount, 4) . "\n\n";
        }

        return $formattedHistory;
    }
}
