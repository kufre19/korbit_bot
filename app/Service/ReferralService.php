<?php

namespace App\Service;

use App\Models\User;
use App\Models\Wallet;
use App\Service\TelegramBotService;
use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;

class ReferralService
{
    use SendMessages, ReplyMarkups;
    private $telegramBot;

    public function __construct()
    {
        $this->telegramBot = new TelegramBotService();
    }

    public function processReferralCode($referralCode, $newUserId)
    {
        $referrer = User::where('referral_code', $referralCode)->first();
        if (!$referrer) {
            $errorMessage = "The referral code you provided is invalid. Please check the code and try again.";
            $this->telegramBot->sendMessage($newUserId, $errorMessage);
            return false;
        }

        // Link the new user to the referrer
        User::where('tg_id', $newUserId)->update(['referrer_id' => $referrer->id]);

        // Send a notification to the referrer about the new referral
        $notificationText = "You have a new referral: User ID {$newUserId}.";
        $this->telegramBot->sendMessage($referrer->tg_id, $notificationText);
        $this->rewardPoint($referrer->tg_id);



        return true;
    }

    public function sendReferralLink($userId, $botUsername, $referralCode)
    {
        $referralLink = "https://t.me/{$botUsername}?start={$referralCode}";
        $message = $this->InviteLinkMessage($referralLink);
        $inline_btn = $this->ReferalInlineKeyboard();

        // Use the TelegramBotService to send a message to the user
        $this->telegramBot->sendMessage($userId, $message,$inline_btn);
    }

    public function rewardPoint($referrer)
    {
        $balance_model = new Wallet();
        $user_service = new UserService();

        $user = $user_service->fetchUserByTgID($referrer);
        $user_wallet  = $balance_model->where('user_id',$user->id)->first();

        $old = $user_wallet->referral_balance;
        $new = $old + 5;

        $balance_model->referral_balance = $new;
        $balance_model->save();

    }


}
