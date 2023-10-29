<?php

namespace App\Traits;

use App\Service\LicenseService;
use App\Service\SessionService;
use Illuminate\Support\Facades\Config;

trait ButtonCommands{

    public function runButtonCommand($command)
    {
        if($command == "📜About KorbitBot")
        {
            $message = Config::get("messages.about_us");
            $this->sendMessageToUser($this->from_chat_id,$message);
        }
        
        if($command == "🧑‍🎓Get Trained")
        {
            $message = Config::get("messages.get_trained");
            $this->sendMessageToUser($this->from_chat_id,$message);
        }
        
        
        
        if($command == "💳Buy Bot Licence")
        {
            // check first if user license is already active before running this command
            $licenseService = new LicenseService();
            if(!$licenseService->checkUserLicense($this->from_chat_id))
            {
                // set a session action for licensing before sending question for email
                $this->user_session->set_session_route("checkUserLicense","store email");
                $message = "Please enter your valid email address below to let us confirm your payment and send follow up information:";
                $this->sendMessageToUser($this->from_chat_id,$message);
            }
          
        }else{
            $message ="function coming soon";
            $this->sendMessageToUser($this->from_chat_id,$message);
        }
        
    }
}