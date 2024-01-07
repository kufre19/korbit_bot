<?php
namespace App\Traits;

trait ReplyMarkups {

    public function startMainReplyKeyboard()
    {
        $keyboard = [
            ["💳Buy Bot Licence"],
            ["📜About Korbit"],
            ["☎️Customer Support"],
            ["🧑‍🎓 KORBIT ARBITRAGE ACADEMY"]
        ];

        return json_encode(['keyboard'=>$keyboard,'resize_keyboard' => true]);
        
    }

    public function updatedMainReplyKeyboard()
    {
        $keyboard = [
            ["💱Exchange2Exchange API Binding","🖼️Swap NFT"],
            ["🧮Arbitrage-calculator","📜About Korbit"],
            ["💱Swap Crypto","📋Swap History"],
            ["🖼️KorbitBot NFT/Token/Farm","☎️Customer Support"],
            ['📢Invite Friends',"🧑‍🎓 KORBIT ARBITRAGE ACADEMY"],
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


    public function getRateAmount()
    {
        $inline = [
            [
                [
                    "text" => "Enter an amount in USD for rates",
                    "callback_data" => "get_amount_for_exchange_rate"
                ]
            ],
         
          
        ];
        return json_encode(['inline_keyboard' => $inline]);
        
    }



    public function nftTracker()
    {
        $inline = [
            [
                [
                    "text" => "NFT Delta Tracker",
                    "callback_data" => "nft_tracker"
                ]
            ],
         
          
        ];
        return json_encode(['inline_keyboard' => $inline]);
        
    }

    public function nftSwapToc()
    {
        $inline = [
            [
                [
                    "text" => "Accept",
                    "callback_data" => "accept_nftSwapToc"
                ],
                [
                    "text" => "Cancel",
                    "callback_data" => "cancel_nftSwapToc"
                ]
            ],
         
          
        ];
        return json_encode(['inline_keyboard' => $inline]);
    }

    public function nftswapConfirm()
    {
        $inline = [
            [
                [
                    "text" => "Proceed",
                    "callback_data" => "accept_swap"
                ],
                [
                    "text" => "Cancel",
                    "callback_data" => "cancel_swap"
                ]
            ],
         
          
        ];
        return json_encode(['inline_keyboard' => $inline]);
    }

    public function callNftSwapAPI()
    {
        $inline = [
            [
                [
                    "text" => "Make API Call ",
                    "callback_data" => "call_api_swap_nft"
                ]
            ],
             
        ];

        return json_encode(['inline_keyboard' => $inline]);
        
    }


    public function createNftInlineKeyboard($nftId) {
        return json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => ' Arbitrage opportunity', // Text displayed on the button
                        'callback_data' => 'nft_selected_' . $nftId // Callback data sent when the button is clicked
                    ]
                ]
            ]
        ]);
    }
    
}