<?php
namespace App\Traits;

trait SendMessages{




    public function sendMessageToUser($chat_id,$message,$reply_markup=null)
    {
        $this->telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup'=>$reply_markup
        ]);
    }

    public function sendMessageToUserDetached($telegrambot,$chat_id,$message,$reply_markup=null){
        
        $telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup'=>$reply_markup
        ]);
    }
}