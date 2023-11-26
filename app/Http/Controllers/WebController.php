<?php

namespace App\Http\Controllers;

use App\Models\LicenseOrder;
use App\Models\SwapOrder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Service\TestService;
use Telegram\Bot\Api as TelegramApi;
use App\Models\Wallet;
use Illuminate\Support\Facades\File;
use App\Models\TransactionLog;



use App\Service;
use App\Service\CryptomusService;
use App\Service\TelegramBotService;
use App\Service\WalletService;

class WebController extends Controller
{
    public $telegrambot;

    public function __construct()
    {

        $this->telegrambot = new TelegramApi();
    }


    public function test_service()
    {
    }

    //    public function handleDepositWebhook(Request $request)
    //     {
    //         // Extract information from the webhook payload
    //         $userEmail = $request->input('email');
    //         $amount = $request->input('amount');
    //         $assetType = $request->input('asset_type'); // e.g., 'balance_busd', 'balance_dai', 'balance_usdt'

    //         // Find the user by email
    //         $user = User::where('email', $userEmail)->first();

    //         if (!$user) {
    //             // Handle case where user is not found
    //             return response()->json(['error' => 'User not found'], 404);
    //         }

    //         // Fetch the user's wallet
    //         $wallet = $user->wallet;

    //         if (!$wallet) {
    //             // Handle case where user doesn't have a wallet
    //             return response()->json(['error' => 'User wallet not found'], 404);
    //         }

    //         // Update the wallet balance based on the asset type
    //         switch ($assetType) {
    //             case 'busd':
    //                 $wallet->balance_busd += $amount;
    //                 break;
    //             case 'dai':
    //                 $wallet->balance_dai += $amount;
    //                 break;
    //             case 'usdt':
    //                 $wallet->balance_usdt += $amount;
    //                 break;
    //             default:
    //                 // Handle invalid asset type
    //                 return response()->json(['error' => 'Invalid asset type'], 400);
    //         }

    //         // Save the updated wallet
    //         $wallet->save();

    //         // Return a success response
    //         return response()->json(['message' => 'Deposit successful'], 200);
    //     }

    public function handleSwapCallback(Request $request)
    {
        // Validate and process the callback data
        // Cryptomus should send information like the order_id and transaction status

        $orderId = $request->order_id;
        $status = $request->status; // Example: 'completed', 'pending', etc.

        $order = SwapOrder::where('order_id', $orderId)->where("status", "pending")->first();
        if (!$order) {
            return response()->json(['message' => 'Callback processed successfully']);
        }
        $user_id = $order->user_id;
        $user = User::where('id', $user_id)->first();


        if (in_array($status, ['paid', 'paid_over'])) {
            // payment received proceed with updating user balance
            $wallet_service = new WalletService();
            $order->update([
                "status" => "completed"
            ]);
            $wallet_service->updateBalance($user_id, $order->to_asset, $order->amount_to_receive);
            $this->logTransaction($user_id, $order->from_asset, $order->to_asset, $order->amount, $order->amount_to_receive);
        } elseif ($status == "cancel") {
            $order->update([
                "status" => "cancelled"
            ]);
        }
        return response()->json(['message' => 'Callback processed successfully']);
    }


    public function handleLicenseCallback(Request $request)
    {
        // Validate and process the callback data
        // Cryptomus should send information like the order_id and transaction status



        $orderId = $request->order_id;
        $status = $request->status; // Example: 'completed', 'pending', etc.

        $order = LicenseOrder::where('order_id', $orderId)->where("status", "pending")->first();
        if (!$order) {
            return response()->json(['message' => 'Callback processed successfully']);
        }
        $user_id = $order->user_id;
        $user = User::where('id', $user_id)->first();


        if (in_array($status, ['paid', 'paid_over'])) {
            // payment received proceed with updating user balance
            $order->update([
                "status" => "completed"
            ]);

            User::where("id", $user->id)->update([
                "license" => "active"
            ]);

            $update_bot = new TelegramBotService($this->telegrambot);
            $update_bot->updateNewRegisteredUser($user->tg_id);

        } elseif ($status == "cancel") {
            $order->update([
                "status" => "cancelled"
            ]);
        }
        return response()->json(['message' => 'Callback processed successfully']);
    }

    public function handleAcademyCallback(Request $request)
    {
        return response()->json(['message' => 'Callback processed successfully']);
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


    // for testing purposes
    public function LogInput($data)
    {

        $data = json_encode($data);
        $file = time() . rand() . '_file.json';
        $destinationPath = public_path() . "/upload/";
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        File::put($destinationPath . $file, $data);
    }
}
