<?php

use App\Http\Controllers\BotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("set-webhook",function(){

    $bot_id_url = env("TG_TOKEN_URL");
    $url = $bot_id_url ."/"."setWebhook?url=".route("bot.webhook");
    return file_get_contents($url);
});


Route::get("bot/webhook",[BotController::class,"index"])->name("bot.webhook");