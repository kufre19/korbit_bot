<?php

namespace App\Traits;

use App\Models\User;
use App\Service\AcademyService;
use App\Service\Exchange2ExchangeService;
use App\Service\ExchangeRateService;
use App\Service\LicenseService;
use App\Service\ReferralService;
use App\Service\SessionService;
use App\Service\SwapService;
use App\Service\UserService;
use App\Service\WalletService;
use Illuminate\Support\Facades\Config;

trait CallbackCommands
{

    public function runCallbackQueryButtonCommand($command)
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
        if ($user && $user->license != "active") {
            return true;
        }




        // In your command handling method
        if ($command == "pay_academy_access") {
            $academy_service = new AcademyService();
            $academy_service->orderAcademyAccess($this->from_chat_id);
            return true;
        } else {
            $message = "function coming soon";
            $this->sendMessageToUser($this->from_chat_id, $message);
            return true;
        }
    }
}
