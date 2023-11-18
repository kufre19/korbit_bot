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
                $msg = <<<MSG
                Pleas enter an amount in usd to get the live readings report:
                NB: price change every instant based on price violatility across spot markets.
                MSG;
                $response = $this->telegram_bot->sendMessageToUser($user_id,$msg);
                $user_session_data['step'] = 'calculate profit';
                $user_session->update_session($user_session_data);
                break;
            case "calculate profit":
                $exchangeService = new ExchangeRateService();
                $assets = $exchangeService->rates;
                $amount = $user_response;

                $msg = "📡 Scanning live.....";
                $response = $this->telegram_bot->sendMessageToUser($user_id,$msg);
                sleep(15);
                $this->telegram_bot->deletMessages($response,$user_id);



                $profits ="LIVE SCAN RESULTS FOR ANALYSIS CEXs reports:" . "\n";
                foreach ($assets as $asset => $rate) {
                    $value  = $exchangeService->exchangeValuesForDollars($asset,$amount);
                    $profits .= "<b> Amount in {$asset}: $"."$value". "</b>" . "\n" ;
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