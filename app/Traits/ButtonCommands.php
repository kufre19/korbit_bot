<?php

namespace App\Traits;

use App\Models\User;
use App\Service\Exchange2ExchangeService;
use App\Service\ExchangeRateService;
use App\Service\LicenseService;
use App\Service\ReferralService;
use App\Service\SessionService;
use App\Service\SwapService;
use App\Service\UserService;
use App\Service\WalletService;
use Illuminate\Support\Facades\Config;

trait ButtonCommands
{

    public function runButtonCommand($command)
    {
        $user = UserService::fetchUserByTgID($this->from_chat_id);
        // Check if the user doesn't exist or if their license isn't active
        if (!$user) {
            // Register a new user if they don't exist
            UserService::registeredNewUser($this->from_chat_id);

            // Prepare the main keyboard layout
            $mainKeyboard = $this->startMainReplyKeyboard();

            // Generate a welcome message
            $startMessage = $this->HelloMessage($this->username);

            // Send the welcome message to the user with the main keyboard
            $this->sendMessageToUser($this->from_chat_id, $startMessage, $mainKeyboard);

            return true;
        }

        $free_pass_command = Config::get("botcommands.free_pass");
        if ($user && $user->license != "active" && !in_array($command, $free_pass_command)) {
            return true;
        }



        if ($command == "📜About Korbit") {
            $message = Config::get("messages.about_us");
            $this->sendMessageToUser($this->from_chat_id, $message);
            return true;
        }

        if ($command == "🧑‍🎓 KORBIT ARBRITRAGE ACADEMY") {
            $message = Config::get("messages.get_trained");

            $inline = $this->academyAccessButton();
            $this->sendMessageToUser($this->from_chat_id, $message, $inline);
            return true;
        }



        if ($command == "💳Buy Bot Licence") {
            // check first if user license is already active before running this command
            $licenseService = new LicenseService();
            if (!$licenseService->checkUserLicense($this->from_chat_id)) {
                // set a session action for licensing before sending question for email
                $this->user_session->set_session_route("LicenseService", "store email");
                $message = "Please enter your valid email address for license purchase confirmation and endless access to first-hand informations from korbit Team.";
                $this->sendMessageToUser($this->from_chat_id, $message);
            }

            return true;
        }
        if ($command == "☎️Customer Support") {
            $message = <<<MSG
            For any enquiries we are here to support you, contact us at korbitbotai@gmail.com.  
            If you're already a customer and require technical assistance, contact support through our website
            MSG;
            $this->sendMessageToUser($this->from_chat_id, $message);

            return true;
        }




        if ($command == "📢Invite Friends") {
            $referalService = new ReferralService();
            $referal_code = User::where("tg_id", $this->from_chat_id)->select("referral_code")->first();
            $referalService->sendReferralLink($this->from_chat_id, env("TELEGRAM_BOT_USERNAME"), $referal_code->referral_code);

            return true;
        }

        if ($command == "💱Swap Crypto") {
            $this->user_session->set_session_route("SwapService", "get swap option");
            $message = "Please select below your swap option from the available coin pairs";
            $inlineKeyboard = $this->InlineSwapOptions();
            $this->sendMessageToUser($this->from_chat_id, $message, $inlineKeyboard);
            return true;
        }

        if ($command == "💵Check Balance") {
            // Fetch the user's balance from the wallet
            $walletService = new WalletService();
            $balanceInfo = $walletService->getFormattedBalance($this->from_chat_id); // Assuming you have or will create a getFormattedBalance method

            // Send the balance information to the user
            $this->sendMessageToUser($this->from_chat_id, $balanceInfo);
            return true;
        }

        if ($command == "📋Swap History") {
            // Fetch the user's swap history
            $swapService = new SwapService();
            $swapHistory = $swapService->getFormattedSwapHistory($this->from_chat_id);

            // Send the swap history to the user
            $this->sendMessageToUser($this->from_chat_id, $swapHistory);
            return true;
        }

        if ($command == "🧮Arbitrage-calculator") {

            $response = $this->sendMessageToUser($this->from_chat_id, "🔎 Scanning Live....");
            sleep(2);
            $this->deletMessages($response, $this->from_chat_id);

            $response = $this->sendMessageToUser($this->from_chat_id, "⏬ Fetching data....");
            sleep(3);
            $this->deletMessages($response, $this->from_chat_id);

            $response = $this->sendMessageToUser($this->from_chat_id, "🛑 Do not close windows when making API request");


            $exchangeService = new ExchangeRateService();

            $rates = $exchangeService->getAssetPricesRate();
            sleep(20);
            $this->deletMessages($response, $this->from_chat_id);

            $inline = $this->getRateAmount();
            $this->sendMessageToUser($this->from_chat_id, $rates, $inline);

            $this->user_session->set_session_route("ArbitrageCalculatorService", "get rate amount");
        }

        // In your command handling method
        if ($command == "💱Exchange2Exchange API Binding") {
            $exchangeService = new Exchange2ExchangeService();
            $message = $exchangeService->getArbitrageOpportunities();
            $this->sendMessageToUser($this->from_chat_id, $message);
            return true;
        } else {
            $message = "function coming soon";
            $this->sendMessageToUser($this->from_chat_id, $message);
            return true;
        }
    }
}
