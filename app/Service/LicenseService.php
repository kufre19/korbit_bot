<?php
namespace App\Service;

use App\Models\User;

class LicenseService{



    public function checkUserLicense($user_id)
    {
        $user = User::where("tg_id",$user_id)->first();
        if($user)
        {
            if($user->license_status == "pending")
            {
                return false;
            }
            return true;
        }
    }

    public function startBotLicenseSession($user_id)
    {
        $sessionService = new SessionService($user_id);
        $steps = [
            "question"=>"Enter Your Email:",
            "store_anser"=>["as"=>"user_email","question"=>"Enter Your Email:"],
            "register_user"

        ];
    }

    public function continueBotSession($user_id,$user_session)
    {
        
        
    }
}