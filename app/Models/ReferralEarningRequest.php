<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralEarningRequest extends Model
{
    use HasFactory;
    protected $table = "referral_earnings_requests";
    protected $fillable = ['user_id', 'usdt_address'];

}
