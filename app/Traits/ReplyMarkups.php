<?php
namespace App\Traits;

trait ReplyMarkups {

    public function MainReplyKeyboard()
    {
        $keyboard = [
            ["Buy Bot Licence","Exchange2Exchange"],
            ["Deposit","Withdraw Profit"],
            ["DAI2BUSD Swap","Swap History"],
            ["Check Balance","About KorbitBot"],
            ["KorbitBot NFT/Token/Farm"],
            ['Invite Friends',"Get Trained"]
        ];


        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }
}