<?php
namespace App\Service;

use App\Service\ServiceInterface;
use App\Traits\SendMessages;
use Illuminate\Support\Facades\Log;

class ArbitrageCalculatorService implements ServiceInterface
{
    use SendMessages;
    public $telegram_bot;

    public function __construct()
    {
        $this->telegram_bot = new TelegramBotService();
    }

    public function continueBotSession($user_id, $user_session, $user_response = "")
    {

        Log::error("continue arbitrage calculation");
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'];

        switch ($step) {
            case 'get rate amount':
                $this->telegram_bot->sendMessageToUser($user_id, "{$user_response}");
                break;
            
            default:
                # code...
                break;
        }

        return true;
    }
}