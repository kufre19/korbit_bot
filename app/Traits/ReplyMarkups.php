<?php
namespace App\Traits;

trait ReplyMarkups {

    public function startMainReplyKeyboard()
    {
        $keyboard = [
            ["💳Buy Bot Licence"],
            ["🏦Deposit","💰Withdraw Profit"],
            ["💵Check Balance","📜About KorbitBot"],
            ["🖼️KorbitBot NFT/Token/Farm"],
            ['📢Invite Friends',"🧑‍🎓Get Trained"]
        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }
}