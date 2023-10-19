<?php
namespace App\Traits;

trait ReplyMarkups {

    public function startMainReplyKeyboard()
    {
        $keyboard = [
            ["💳Buy Bot Licence","🏦Deposit"],
            ["📜About KorbitBot"],
            ["🖼️KorbitBot NFT/Token/Farm"],
            ['📢Invite Friends',"🧑‍🎓Get Trained"]
        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }

    public function updatedMainReplyKeyboard()
    {
        $keyboard = [
            ["💳Buy Bot Licence","💱Exchange2Exchange"],
            ["🏦Deposit","💰Withdraw Profit"],
            ["💱DAI2BUSD Swap","📋Swap History"],
            ["💵Check Balance","📜About KorbitBot"],
            ["🖼️KorbitBot NFT/Token/Farm"],
            ['📢Invite Friends',"🧑‍🎓Get Trained"]
        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }
}