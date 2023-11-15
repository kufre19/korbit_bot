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
                if($user_response != "get_amount_for_exchange_rate"){
                    break;
                }
                $this->telegram_bot->sendMessageToUser($user_id,"Pleas enter an amount in usd to calculate profit... ");
                $user_session_data['step'] = 'calculate profit';
                $user_session->update_session($user_session_data);
                break;
            case "calculate profit":
                $exchangeService = new ExchangeRateService();
                $assets = $exchangeService->rates;
                $amount = $user_response;


                $profits ="LIVE SCAN RESULTS FOR PROFITS:" . "\n";
                foreach ($assets as $asset => $rate) {
                    $value  = $exchangeService->exchangeValuesForDollars($asset,$amount);
                    $profits .= "**{$asset}: $value **" . "\n" ;
                }
                $this->telegram_bot->sendMessageToUser($user_id,$profits);
                $user_session->endSession();


                break;
            default:
                # code...
                break;
        }

        return true;
    }
}