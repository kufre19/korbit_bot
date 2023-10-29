<?php

namespace App\Service;

use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;

/**
 * this class will perfom actions 
 * then send an update to the chatbot
 *  */
class SendUpdateToBot{
    use ReplyMarkups, SendMessages;

    public $telegrambot;

    public function __construct($telegramBotInstance)
    {
        $this->telegrambot = $telegramBotInstance;
    }


    public function updateNewRegisteredUser($tg_id)
    {

        // creat and send the updated keyboard to user
        $new_keyboard = $this->updatedMainReplyKeyboard();
        $msg = "Congratulation your license was just activated";
        $this->sendMessageToUser($tg_id,$msg,$new_keyboard);
        return response("ok",200);
    }
}