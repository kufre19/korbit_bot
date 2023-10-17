<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api as TelegramApi;



class BotController extends Controller
{
    public $bot_name;
    public function __construct()
    {
        $this->bot_name = Config::get("telegram.default");

       
    }

    public function index()
    {
      
        
        $updates = Telegram::getWebhookUpdate();
        $telegrambot = new TelegramApi();
        $chat_id = $updates->message->chat->id;
        $user_message = $updates->message->text;
        $response =$telegrambot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $user_message
        ]);
        return response("ok",200);
    }

    public function LogInput($data)
    {

        $data = json_encode($data);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
    }
}
