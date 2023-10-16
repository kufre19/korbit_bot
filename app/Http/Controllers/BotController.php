<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;




class BotController extends Controller
{
    public $bot_name;
    public function __construct()
    {
        $this->bot_name = Config::get("telegram.default");

       
    }

    public function index(Request $request)
    {
        Log::error("message");
        
        $updates = Telegram::getWebhookUpdate();

        return response("ok");
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
