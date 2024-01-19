<?php

namespace App\Traits;

trait SendMessages
{




    // public function sendMessageToUser($chat_id, $message, $reply_markup = null)
    // {
    //     return $this->telegrambot->sendMessage([
    //         'chat_id' => $chat_id,
    //         'text' => $message,
    //         "parse_mode"=>"html",
    //         'reply_markup' => $reply_markup
    //     ]);
    // }

    // public function sendMessageToUserDetached($telegrambot, $chat_id, $message, $reply_markup = null)
    // {

    //     return $telegrambot->sendMessage([
    //         'chat_id' => $chat_id,
    //         'text' => $message,
    //         "parse_mode"=>"html",
    //         'reply_markup' => $reply_markup
    //     ]);
    // }


    public function sendMessageToUser($chat_id, $message, $reply_markup = null, $image = null)
    {
        if ($image) {
            return $this->telegrambot->sendPhoto([
                'chat_id' => $chat_id,
                'photo' => \Telegram\Bot\FileUpload\InputFile::create($image),
                'caption' => $message,
                'parse_mode' => 'HTML',
                'reply_markup' => $reply_markup
            ]);
        } else {
            return $this->telegrambot->sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'HTML',
                'reply_markup' => $reply_markup
            ]);
        }
    }


    public function addMessageForDeleting($response)
    {
        
    }


    public function sendMessageToUserDetached($telegrambot, $chat_id, $message, $reply_markup = null, $image = null)
    {
        if ($image) {
            return $telegrambot->sendPhoto([
                'chat_id' => $chat_id,
                'photo' => \Telegram\Bot\FileUpload\InputFile::create($image),
                'caption' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $reply_markup
            ]);
        } else {
            return $telegrambot->sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $reply_markup
            ]);
        }
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


    public function InviteLinkMessage($link)
    {
        $txt = <<<MSG
        Korbit Affiliate Program 🚀💰 The official way to invite your friends. Get rewarded up to 22% commission for every friend you refer to make a purchase of the BOT 🌐💻
        Experience a new way of earning by inviting your friends to buy BOT license 🌟👥
        Here's your unique referral link: $link  📎✨
        MSG;

        return $txt;
    }

    public function swapAmountNotice($amount, $fromAsset, $toAsset)
    {

        $fromAsset = strtoupper($fromAsset);
        $toAsset = strtoupper($toAsset);
        $txt = <<<MSG
        You are about to make an API call to a CEX. Please note, API calls and funds transfers occur solely between CEX/DEX. Korbit only facilitates the API call and request between wallet A (your wallet) and wallet B (destination exchange).
    
        Allow me to send an API request to CEX to purchase $toAsset with <b>$amount $fromAsset</b>💸.
    
        DISCLAIMER 🚨: In addition to the core functionalities, there's an extra API feature with backlog functionality🔄. It allows you to terminate transactions halfway and return to the previous page if you decide not to complete the transaction.
        Explore more about exciting arbitrage opportunities at Korbit Arbitrage Academy📚💹.
        MSG;
    

        return $txt;
    }

    public function swapNftNotice($amount, $profit, $toAsset)
    {
        $toAsset = strtoupper($toAsset);

        $txt = <<<MSG
        You are about to make an API call to a CEX. Please note,API calls and funds transfers occur solely between CEX/DEX. Korbit only makes the API call and request between wallet A (your wallet) and wallet B (destination exchange).
        
        Allow me to send an API request to CEX to purchase $toAsset with <b>$amount for profit of $profit</b>.
        

        DISCLAIMER 🚨: In addition to the core functionalities, there's an extra API feature with backlog functionality🔄. It allows you to terminate transactions halfway and return to the previous page if you decide not to complete the transaction.
        Explore more about exciting arbitrage opportunities at Korbit Arbitrage Academy📚💹.
        
        MSG;

        return $txt;
    }

    public function deletMessages($response, $chat_id,$messageId=null)
    {
        if($messageId == null)
        {
            $messageId = $response->getMessageId();
        }
        return $this->telegrambot->deleteMessage([
            'chat_id' => $chat_id,
            'message_id' => $messageId
        ]);
    }

    public function useWalletGenerated($amount, $asset, $wallet, $network, $order_id, $extra_msg = "payment")
    {
        $asset = strtoupper($asset);

        $txt = <<<MSG
        API wallet addresses successfully retrieved from CEX ✨ 
        Ref ID : $order_id

        🚀Proceed with <b>"{$amount} {$asset}"</b> $extra_msg to the API wallet address below : 
        
        <code>$wallet</code>

        Blockchain Network: $network 🌐

        🚨 Note: These API wallet addresses, generated for each call, are valid for up to 30 minutes. ⏳
        MSG;

        return $txt;
    }

    public function swapSuccessNotice()
    {
    }
}
