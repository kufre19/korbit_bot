<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Artisan;
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


// Route::get("set-webhook",function(){

//     $bot_id_url = env("TG_TOKEN_URL");
//     $url = $bot_id_url ."/"."deleteWebhook";
//     file_get_contents($url);
//     return true;
// });

// Route::get("unset-webhook",function(){
//     $bot_id_url = env("TG_TOKEN_URL");
//     $url = $bot_id_url ."/"."setWebhook?url=".route("bot.webhook");
//     file_get_contents($url);
//     return true;
// });

Route::any("bot/webhook",[BotController::class,"index"])->name("bot.webhook");

Route::get('license/payment/webhook',[WebController::class,"confirm_payment"]);


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "Cache cleared successfully";
});
