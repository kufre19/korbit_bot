<?php

namespace App\Http\Controllers;

use App\Traits\ButtonCommands;
use App\Traits\IndexTrait;
use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api as TelegramApi;
use App\Service\SessionService;

class BotController extends Controller
{
    use IndexTrait,SendMessages,ReplyMarkups,ButtonCommands;
    public $bot_name;
    public $telegrambot;
    public $user_session;
    public $user_session_data;

    public function __construct()
    {
        $this->bot_name = Config::get("telegram.default");

       
    }

    public function index()
    {
     

        $this->telegrambot = new TelegramApi();
        $webhookUpdates = $this->telegrambot->getWebhookUpdate();


        $this->user_session = new SessionService($webhookUpdates->message->chat->id);
        $this->user_session_data = $this->user_session->getUserSessionData();
        
    
        // run a user command
        $this->userCommand($webhookUpdates);
        $this->LogInput($webhookUpdates);
        return response("returned from botcontroller index",200);
    }

    

    // for testing purposes
    public function LogInput($data)
    {

        $data = json_encode($data);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
    }
}
