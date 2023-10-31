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

Route::get('webhook/payment/license',[WebController::class,"license_payment"]);
Route::get('/webhook/payment/deposit', [WebController::class, 'handleDepositWebhook']);


Route::get('test',[WebController::class,"test_service"]);

// http://0.0.0.0:8000/webhook/payment/license?email=whitemaxwell5@gmail.com&payment_status=success

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "Cache cleared successfully";
});
