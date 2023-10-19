<?php

namespace App\Traits;

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
        }else{
            $message ="function coming soon";
            $this->sendMessageToUser($this->from_chat_id,$message);
        }
        
    }
}