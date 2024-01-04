<?php

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// In your routes/web.php or routes/api.php
Route::post('swap/payment/callback',[WebController::class,"handleSwapCallback"])->name('swap.payment.callback');
Route::post('license/payment/callback',[WebController::class,"handleLicenseCallback"])->name('license.payment.callback');
Route::post('academy-access/payment/callback',[WebController::class,"handleAcademyCallback"])->name('academy.payment.callback');
Route::post('swap-nft/payment/callback',[WebController::class,"handleAcademyCallback"])->name('swap-nft.payment.callback');



