<?php

namespace App\Traits;

use App\Service\ReferralService;
use App\Service\UserService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

trait IndexTrait
{

    // public $commands ;
    public $user_sent_text;
    public $from_chat_id;
    public $username;
    public $tg_user_id;


    public function userCommand($command)
    {

        if (isset($command->data)) {
            $this->user_sent_text =  $command->data ?? '';
        } else {
            $this->user_sent_text =  $command->message->text ?? '';
        }
        // $command->message->text ?? $command->data;
        $this->from_chat_id = $command->message->chat->id;
        $this->username = $command->message->chat->username;

        // Check if the user sent text is a button.
        if ($this->checkIfTextIsButton($this->user_sent_text)) {
            Log::error("checked for butn command");

            // run method/commands for buttons here
            $this->runButtonCommand($this->user_sent_text);
            return true;
        }


        if (isset($command->message->entities)) {
            $entityType = $command->message->entities[0]->type;
            if ($entityType == "bot_command") {
                if ($this->checkIfCommandExists($this->user_sent_text) || strpos($this->user_sent_text, "/start") !== false) {

                    if (strpos($this->user_sent_text, "/start")  !== false) {
                        Log::error("came for command");

                        if (!UserService::isUserAlreadyCreated($this->from_chat_id)) {
                            UserService::registeredNewUser($this->from_chat_id);
                            // check if user is registered so you can send the registered/licensed user keyboard or instead the beginner keyboard

                            // Handle referral code if present in the /start command
                            $this->handleReferralCode($this->user_sent_text);

                            $mainKeyboard = $this->startMainReplyKeyboard();
                            $startMessage = "Hello Welcome {$this->username}, I'm Korbit arbitrage Bot. You can select any command from the menu provided below";
                            $this->sendMessageToUser($this->from_chat_id, $startMessage, $mainKeyboard);
                            return true;
                        } else {
                            // User already exists, you can send a message or perform any action.
                            // $message = "You're already registered!";
                            // $this->sendMessageToUser($this->from_chat_id, $message);
                            return true;
                        }
                    }
                }
            }
        } else {
            // Continue with the session action if any.
            Log::error("knew to continue here");
            $this->continueSessionAction($this->user_session, $command);
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

    public function continueSessionAction($user_session, $webhookUpdates)
    {
        Log::error("tried to continue session");
        $user_session_data = $user_session->getUserSessionData();

        if (isset($user_session_data['active_command']) && $user_session_data['active_command'] == "yes") {
            // Assuming the user's response is in the text field of the message
            if (isset($webhookUpdates->data)) {
                $user_response = $webhookUpdates->data ?? '';
            } else {
                $user_response = $webhookUpdates->message->text ?? '';
            }
            $user_session->run_action_session($user_response);
        }
    }

    protected function handleReferralCode($text)
    {
        if (preg_match('/^\/start\s+(\w+)/', $text, $matches)) {
            $referralCode = $matches[1];

            // Assuming you have an instance of ReferralService here
            $referralService = new ReferralService();
            $result = $referralService->processReferralCode($referralCode, $this->from_chat_id);

            if (!$result) {
                // Handle the scenario where the referral code processing failed
                // You can send a message to the user or log the error
            }
        }
    }
}
