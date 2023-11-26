<?php

namespace App\Service;

use App\Models\AcademyOrder;
use App\Traits\SendMessages;
use App\Service\ServiceInterface;
use Illuminate\Support\Str;



class AcademyService implements ServiceInterface
{

    use SendMessages;
    public $telegram_bot;

    public function __construct()
    {
        $this->telegram_bot = new TelegramBotService();
    }
    


    public function orderAcademyAccess($user_id)
    {
        $user = UserService::fetchUserByTgID($user_id);
        $order_id = Str::uuid();

        $cryptomus_service = new CryptomusService();

        $callbackurl = route("academy.payment.callback");
        $payment_details = $cryptomus_service->createPayment("300","usdt",$order_id,$callbackurl);

        if($payment_details[0])
        {
            $payment_details = $payment_details[1];

            AcademyOrder::create([
                "order_id"=>$order_id,
                "user_id"=>$user->id,
                "amount"=>"300",
                "status"=>"pending"
            ]);

            $msg = <<<MSG
            Get access to the KORBIT ARBITRAGE ACADEMY, pay <b>{$payment_details["amount"]} USDT {$payment_details["network"]}</b> to the wallet address below: 
            
            <code>{$payment_details["address"]}</code>
            MSG;
            $this->telegram_bot->sendMessage($user_id,$msg);
        }else {
            $this->telegram_bot->sendMessage($user_id,$payment_details[1]);
            // close session action
        }
       

    }

    public function activationMessage($user_id)
    {
        $msg = "Your access to the Korbit Arbitrage Academy has been activated";
        $this->telegram_bot->sendMessage($user_id,$msg);

    }
    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'];

    }
}