<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralEarningRequest extends Model
{
    use HasFactory;
    protected $table = "referral_earnings_requests";
    protected $fillable = ['user_id', 'usdt_address', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id","id");
    }

    public function getReferralBalanceAttribute()
    {
        // Assuming that the user relationship is properly defined in ReferralEarningRequest model
        return optional($this->user)->wallet->referral_balance ?? '0';
    }
}
