<?php

namespace App\Traits;

use App\Models\User;
use App\Service\LicenseService;
use App\Service\ReferralService;
use App\Service\SessionService;
use Illuminate\Support\Facades\Config;

trait ButtonCommands{

    public function runButtonCommand($command)
    {
        if($command == "📜About KorbitBot")
        {
            $message = Config::get("messages.about_us");
            $this->sendMessageToUser($this->from_chat_id,$message);
            return true;
        }
        
        if($command == "🧑‍🎓Get Trained")
        {
            $message = Config::get("messages.get_trained");
            $this->sendMessageToUser($this->from_chat_id,$message);
            return true;

        }
        
        
        
        if($command == "💳Buy Bot Licence")
        {
            // check first if user license is already active before running this command
            $licenseService = new LicenseService();
            if(!$licenseService->checkUserLicense($this->from_chat_id))
            {
                // set a session action for licensing before sending question for email
                $this->user_session->set_session_route("LicenseService","store email");
                $message = "Please enter your valid email address below to let us confirm your payment and send follow up information:";
                $this->sendMessageToUser($this->from_chat_id,$message);
            }
          
            return true;

        }
        
        if($command == "📢Invite Friends")
        {
           $referalService = new ReferralService();
           $referal_code = User::where("tg_id",$this->from_chat_id)->select("referral_code")->first();
           $referalService->sendReferralLink($this->from_chat_id,env("TELEGRAM_BOT_USERNAME"),$referal_code->referral_code);

           return true;

          
        }
        
        if ($command == "💱Swap Crypto") {
            $message = "Please select below your swap option";
            $inlineKeyboard = $this->InlineSwapOptions();
            $this->sendMessageToUser($this->from_chat_id, $message,$inlineKeyboard);
            return true;
        }else{
            $message ="function coming soon";
            $this->sendMessageToUser($this->from_chat_id,$message);
        }
        
    }
}