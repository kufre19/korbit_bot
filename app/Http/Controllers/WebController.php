<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Service\TestService;
use Telegram\Bot\Api as TelegramApi;
use App\Models\Wallet;


use App\Service;
use App\Service\TelegramBotService;

class WebController extends Controller
{
   public $telegrambot;

   public function __construct()
   {
  
        $this->telegrambot = new TelegramApi();
   }

   public function license_payment(Request $request)
   {
      /**
       * collect user emaill from webhook data
       * collect payment status
       * if successfull update user lincense to active
       * then send the new keyboard to user
       */
        $user_email = $request->input("email");
        $payment_status = $request->input("payment_status");

        if($payment_status == "success")
        {
            $user = User::where("email",$user_email)->first();
            if($user)
            {
               User::where("id",$user->id)->update([
                  "license"=>"active"
               ]);
            }
           
            $update_bot = new TelegramBotService($this->telegrambot);
            $update_bot->updateNewRegisteredUser($user->tg_id);
        }
   }

   public function test_service()
   {
      $test = new TestService();
      return $test->test();
   }

   public function handleDepositWebhook(Request $request)
    {
        // Extract information from the webhook payload
        $userEmail = $request->input('email');
        $amount = $request->input('amount');
        $assetType = $request->input('asset_type'); // e.g., 'balance_busd', 'balance_dai', 'balance_usdt'

        // Find the user by email
        $user = User::where('email', $userEmail)->first();

        if (!$user) {
            // Handle case where user is not found
            return response()->json(['error' => 'User not found'], 404);
        }

        // Fetch the user's wallet
        $wallet = $user->wallet;

        if (!$wallet) {
            // Handle case where user doesn't have a wallet
            return response()->json(['error' => 'User wallet not found'], 404);
        }

        // Update the wallet balance based on the asset type
        switch ($assetType) {
            case 'busd':
                $wallet->balance_busd += $amount;
                break;
            case 'dai':
                $wallet->balance_dai += $amount;
                break;
            case 'usdt':
                $wallet->balance_usdt += $amount;
                break;
            default:
                // Handle invalid asset type
                return response()->json(['error' => 'Invalid asset type'], 400);
        }

        // Save the updated wallet
        $wallet->save();

        // Return a success response
        return response()->json(['message' => 'Deposit successful'], 200);
    }
}
