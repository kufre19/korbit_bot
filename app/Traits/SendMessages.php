<?php
namespace App\Traits;

trait SendMessages{




    public function sendMessageToUser($chat_id)
    {
        $this->telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Hello World'
        ]);
    }
}