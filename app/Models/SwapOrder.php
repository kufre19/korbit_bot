<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Service\TelegramBotService;
use App\Service\UserService;
use App\Service\WalletService;
use App\Service\SwapService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TransactionLog;


class SwapOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'user_id', 'from_asset', 'to_asset', 'amount', 'status','amount_to_receive'
    ];

    /**
     * Get the user that owns the SwapOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($swap) {
            if ($swap->wasChanged('status') && $swap->status === 'completed') {
                $telegramService = new TelegramBotService();
                $wallet_service = new WalletService();
                $wallet_service->updateBalance($swap->user_id, $swap->to_asset, $swap->amount_to_receive);
                WalletService::logTransaction($swap->user_id, $swap->from_asset, $swap->to_asset, $swap->amount, $swap->amount_to_receive);
                $swapService = new SwapService();
                $swapService->notifySuccessfullSwap($swap);
            }

           
        });
    }
}
