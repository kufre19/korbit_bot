<?php
namespace App\Traits;
// use Telegram\Bot\Laravel\Facades\Telegram;


trait ReplyMarkups {

    public function MainReplyKeyboard()
    {
        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['1', '2', '3'],
            ['1', '2', '3'],
                 ['0']
        ];

        
        // $reply_markup = $this->telegrambot->replyKeyboardMarkup([
        //     'keyboard' => $keyboard,
        //     'resize_keyboard' => true
        // ]);

        return $keyboard;
        
    }
}