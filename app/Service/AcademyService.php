<?php

namespace App\Service;

use App\Traits\SendMessages;
use App\Service\ServiceInterface;



class AcademyService implements ServiceInterface
{

    use SendMessages;
    public $telegram_bot;

    public function __construct()
    {
        $this->telegram_bot = new TelegramBotService();
    }
    



    public function continueBotSession($user_id, $user_session, $user_response = "")
    {

    }
}