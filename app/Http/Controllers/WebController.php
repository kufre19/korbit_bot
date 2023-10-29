<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\SendUpdateToBot;
use Illuminate\Http\Request;
use App\Service\TestService;
use Telegram\Bot\Api as TelegramApi;

use App\Service;


class WebController extends Controller
{
   public $telegrambot;

   public function __construct()
   {
  
        $this->telegrambot = new TelegramApi();
   }

   public function confirm_payment(Request $request)
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
           
            $update_bot = new SendUpdateToBot($this->telegrambot);
            $update_bot->updateNewRegisteredUser($user->tg_id);
        }
   }

   public function test_service()
   {
      $test = new TestService();
      return $test->test();
   }
}
