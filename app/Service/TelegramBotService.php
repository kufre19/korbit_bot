<?php

namespace App\Service;

use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;
use App\Models\User;


use Telegram\Bot\Api as TelegramApi;

/**
 * this class will perfom actions 
 * then send an update to the chatbot
 *  */
class TelegramBotService
{
    use ReplyMarkups, SendMessages;

    public $telegrambot;

    public function __construct()
    {

        $this->telegrambot =  new TelegramApi();
    }


    public function updateNewRegisteredUser($tg_id)
    {
        // creat and send the updated keyboard to user
        $new_keyboard = $this->updatedMainReplyKeyboard();
        $msg = "Congratulation your license has been activated";
        $this->sendMessage($tg_id, $msg, $new_keyboard);
        return response("ok", 200);
    }

    public function sendDepositNotification($userId, $amount, $assetType)
    {
        $user = User::find($userId);

        if ($user && $user->tg_id) {
            $message = "Hello, your deposit of {$amount} {$assetType} has been successfully credited to your account.";

            try {
                $this->telegrambot->sendMessage([
                    'chat_id' => $user->tg_id,
                    'text' => $message
                ]);
            } catch (\Exception $e) {
                // Handle any exceptions (e.g., user not found on Telegram, API issues)
                // Log the error for debugging
            }
        }
    }

    // public function sendMessage($chat_id, $message,$reply_markup=null)
    // {
    //     return $this->telegrambot->sendMessage([
    //         'chat_id' => $chat_id,
    //         'text' => $message,
    //         "parse_mode"=>"html",
    //         'reply_markup'=>$reply_markup
    //     ]);
    // }

    public function sendMessage($chat_id, $message, $reply_markup = null, $image = null)
    {
        if ($image) {
            return $this->telegrambot->sendPhoto([
                'chat_id' => $chat_id,
                'photo' => $image,
                'caption' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $reply_markup
            ]);
        } else {
            return $this->telegrambot->sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $reply_markup
            ]);
        }
    }


    public function deletMessages($response, $chat_id)
    {
        $messageId = $response->getMessageId();
        return $this->telegrambot->deleteMessage([
            'chat_id' => $chat_id,
            'message_id' => $messageId
        ]);
    }
}
