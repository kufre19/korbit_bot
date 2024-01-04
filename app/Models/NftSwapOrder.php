<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftSwapOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_id', 'nft_id', 'status', 'wallet_address','payable_amount'
    ];
}
