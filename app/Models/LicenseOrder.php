<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Service\TelegramBotService;


class LicenseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'user_id', 'amount', 'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($license) {
            if ($license->wasChanged('status') && $license->status === 'completed') {
                $user_id = $license->user_id;
                $user = User::where('id', $user_id)->first();

                User::where("id", $user->id)->update([
                    "license" => "active"
                ]);

                $telegramService = new TelegramBotService();
                $telegramService->updateNewRegisteredUser($user->tg_id);
            }

            
        });
    }
}
