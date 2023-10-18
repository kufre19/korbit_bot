<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait IndexTrait{

    // public $commands ;
    public $user_sent_text;
    public $from_chat_id;

    public function userCommand($command)
    {
        $this->user_sent_text = $command->message->text;
        $this->from_chat_id = $command->message->chat->id;
        $this->sendMessageToUser($this->from_chat_id,"hello world");
        return true;

        


        // check if user sent tet is message, command or button
        // cheack first if command exists
        // if it does route to the right Traits(call the method from the trait)
        if(isset($command->message->entities))
        {
            $entityType = $command->message->entities->type;
            if($entityType == "bot_command")
            {
                if($this->checkIfCommandExists($this->user_sent_text))
                {
                    if($this->user_sent_text == "/start")
                    {

                    }
                }
            }
            if($entityType == "reply_button")
            {
                // if($this->checkIfCommandExists($this->user_sent_text))
                // {
        
                // }
            }
            
        }
        

    }



    public function checkIfCommandExists($command)
    {
        $commands = Config::get("botcommands.commands");
        if(!in_array($command,$commands))
        {
            return false;

        }
        return true;
    }
}