<?php
namespace App\Traits;

trait ReplyMarkups {

    public function startMainReplyKeyboard()
    {
        $keyboard = [
            ["💳Buy Bot Licence"],
            ["📜About Korbit"],
            ["🧑‍🎓 Korbit Arbitrage Academy"]
        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }

    public function updatedMainReplyKeyboard()
    {
        $keyboard = [
            ["💱Exchange2Exchange Api Binding"],
            ["🧮Abritrage-calculator","📜About Korbit"],
            ["💱Swap Crypto","📋Swap History"],
            ["🖼️KorbitBot NFT/Token/Farm"],
            ['📢Invite Friends',"🧑‍🎓 Korbit Arbitrage Academy"],
            

        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }

    public function InlineSwapOptions()
    {
        $inline = [
            [
                [
                    "text" => "DAI 🔄 USDT",
                    "callback_data" => "dai_usdt"
                ]
            ],
            [
                [
                    "text" => "DAI 🔄 BUSD",
                    "callback_data" => "dai_busd"
                ]
            ],
            [
                [
                    "text" => "USDT 🔄 BUSD",
                    "callback_data" => "usdt_busd"
                ]
            ],
            [
                [
                    "text" => "USDT 🔄 DAI",
                    "callback_data" => "usdt_dai"
                ]
            ],
            [
                [
                    "text" => "BUSD 🔄 DAI",
                    "callback_data" => "busd_dai"
                ]
            ],
            [
                [
                    "text" => "BUSD 🔄 USDT",
                    "callback_data" => "busd_usdt"
                ]
            ],
        ];
    
        return json_encode(['inline_keyboard' => $inline]);
    }

    public function academyAccessButton()
    {
        $inline = [
            [
                [
                    "text" => "🛒 Get Access Now",
                    "callback_data" => "pay_academy_access"
                ]
            ],
         
          
        ];
        return json_encode(['inline_keyboard' => $inline]);
        
    }
    
}