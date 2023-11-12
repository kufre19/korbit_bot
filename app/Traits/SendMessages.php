<?php

namespace App\Traits;

trait SendMessages
{




    public function sendMessageToUser($chat_id, $message, $reply_markup = null)
    {
        $this->telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup' => $reply_markup
        ]);
    }

    public function sendMessageToUserDetached($telegrambot, $chat_id, $message, $reply_markup = null)
    {

        $telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup' => $reply_markup
        ]);
    }


    public function HelloMessage($username)
    {
        $txt = <<<MSG
        Hello! Welcome $username, I'm Korbit arbitrage Bot. A machine learning model trained on Kalman filter and least square regression algorithms to help you detect volatility that exists on CEXs and DEXs and then make API calls between the crypto exchanges and via the aid of my sophisticated algorithms detects extremely minute fluctuations and errors up to 4 digits in decimals with lowest graduation up to $0.0049 that exists between top exchanges.
        Support 60+ CEXs and DEXs some of which are:
            🔰 www.binance.com
            🔰 www.huobi.com
            🔰 www.CEX.io 
            🔰 www.gate.io
            🔰 www.bibox.com
            🔰 www.okex.com
            🔰 www.coinbase.com
            🔰 www.bybit.com
            🔰 www.lbank.com
            🔰 www.bitget.com
            🔰 www.kucoin.com
            🔰 www.upbit.com
            And many others...
        Disclaimer: While I aim to provide accurate and helpful information and assists, I have been trained to not accept DEPOSITS, but only to assist you in making API calls through backlog testing between various exchanges.
        It is important to NOTE that I have been directly deployed on the Blockchain with smart contract technology and therefore have 100% autonomy with no central control. All API calls and transactions between exchanges are recorded on the blockchain and are therefore immutable with 100% transparency and security. So, at all times all funds are within your control.
        🔰 Detailed article: 
        🔰 For support, refer to the Manual guide: 
        You can proceed to select any command from the menu provided below:
        MSG;

        return $txt;
    }
}
