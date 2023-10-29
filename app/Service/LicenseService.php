<?php

namespace App\Service;

use App\Models\User;
use App\Traits\SendMessages;
use App\Service\UserService;
use Telegram\Bot\Api as TelegramApi;

class LicenseService
{

    
    use SendMessages;

    public function checkUserLicense($user_id)
    {
        $user = User::where("tg_id", $user_id)->first();
        if ($user) {
            if ($user->license_status == "pending") {
                return false;
            }
            return true;
        }
    }



    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'];
        $answers_from_session = $user_session_data['answered_questions'];

        if ($step == "store email") {
            // update the list of answers in the session
            array_push($answers_from_session, $user_response);
            $user_session->add_value_to_session("answered_questions", $answers_from_session);

            // update the user email
            UserService::updateUserEmail($user_id,$user_response);

            // initialize teh TG bot sdk
            $telegrambot = new TelegramApi();
            // Send message to user
            $msg = "You can pay the license fee of $21 to this address 0x1252jfnknjklofhsskbsvkjsbvjk";
            $this->sendMessageToUserDetached($telegrambot,$user_id,$msg);
            // close session action
            $user_session->add_value_to_session("active_command","no");
            return true;
        }
    }
}