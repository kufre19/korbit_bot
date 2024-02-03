<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'balance_busd',
        'balance_dai',
        'balance_usdt',
        'referral_balance'

    ];

    /**
     * Get the user that owns the wallet.
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
