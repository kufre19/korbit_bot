<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait IndexTrait
{

    // public $commands ;
    public $user_sent_text;
    public $from_chat_id;
    public $username;
    public $tg_user_id ;


    public function userCommand($command)
    {
        $this->user_sent_text = $command->message->text;
        $this->from_chat_id = $command->message->chat->id;
        $this->username = $command->message->chat->username;


        // check if user sent tet is message, command or button
        // cheack first if command exists
        // if it does route to the right Traits(call the method from the trait)
        if (isset($command->message->entities)) {
            $entityType = $command->message->entities[0]->type;
            if ($entityType == "bot_command") {
                if ($this->checkIfCommandExists($this->user_sent_text)) {
                    if ($this->user_sent_text == "/start") {
                        $mainKeyboard = $this->startMainReplyKeyboard();
                        $startMessage = "Hello Welcome {$this->username}, I'm Korbit arbitrage Bot. You can select any command from the menu provided below";
                        $this->sendMessageToUser($this->from_chat_id, $startMessage, $mainKeyboard);
                        return true;
                    }
                }
            }
        }
        if ($this->checkIfTextIsButton($this->user_sent_text)) {
            // run method/commands for buttons here
            $this->runButtonCommand($this->user_sent_text);
            return true;
        }


        return true;
    }

    /** 
     * this method only checks is the command sent by user exists on our list
    */
    public function checkIfCommandExists($command)
    {
        $commands = Config::get("botcommands.commands");
        if (!in_array($command, $commands)) {
            return false;
        }
        return true;
    }


    /** 
     * this method only checks is the button sent by user exists on our list
    */
    public function checkIfTextIsButton($command)
    {
        $commands = Config::get("botcommands.buttons");
        if (!in_array($command, $commands)) {
            return false;
        }
        return true;
    }
}
