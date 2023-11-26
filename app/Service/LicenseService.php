<?php

namespace App\Service;

use App\Models\LicenseOrder;
use App\Models\User;
use App\Service\ServiceInterface as ServiceServiceInterface;
use App\Traits\SendMessages;
use App\Service\UserService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LicenseService implements ServiceServiceInterface
{

    
    use SendMessages;

    public function checkUserLicense($user_id)
    {
        $user = User::where("tg_id", $user_id)->first();
        if ($user) {
            if ($user->license == "pending") {
                return false;
            }
            return true;
        }
    }



    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        // Log::error("continue lincening");
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'];
        $answers_from_session = $user_session_data['answered_questions'];
        $answers_from_session["email"] = $user_response;

        if ($step == "store email") {
            $telegrambot = new TelegramBotService();

            // update the list of answers in the session
            $user_session->add_value_to_session("answered_questions", );

            // update the user email
            $updateEmail = UserService::updateUserEmail($user_id,$user_response);
            if(!$updateEmail)
            {
                $msg = "This email is already in use by another user";
                $telegrambot->sendMessage($user_id,$msg);
                return true;
            }

            // initialize the TG bot sdk
            // Send message to user
            $cryptomus_service = new CryptomusService();
            $order_id = Str::uuid();
            $callbackurl = "https://iamconst-m.com/korbit_bot/api/license/payment/callback";
            $payment_details = $cryptomus_service->createPayment("21","usdt",$order_id,$callbackurl);
           
            if($payment_details[0])
            {
                $user = UserService::fetchUserByTgID($user_id);

                LicenseOrder::create([
                    "order_id"=>$order_id,
                    "user_id"=>$user->id,
                    "amount"=>"21",
                    "status"=>"pending"
                ]);
                $payment_details = $payment_details[1];
                $msg = <<<MSG
                Obtain the bot license by making a one time payment fee of <b>{$payment_details["amount"]} USDT {$payment_details["network"]}</b> to the wallet address below: 
                
                <code>{$payment_details["address"]}</code>
    
                Note: The bot license comes with validity of one year.
                MSG;
                $telegrambot->sendMessage($user_id,$msg);
                // close session action
                $user_session->endSession();
            }else {


                $telegrambot->sendMessage($user_id,$payment_details[1]);
                // close session action
                $user_session->endSession();
            }
           
            return true;
        }
    }
}
