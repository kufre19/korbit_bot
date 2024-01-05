<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NftSwapOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_id', 'nft_id', 'status', 'wallet_address','payable_amount'
    ];

     // Define relationships as necessary
     public function user(): BelongsTo
     {
         return $this->belongsTo(User::class);
     }
 
     public function nft(): BelongsTo
     {
         return $this->belongsTo(Nfts::class);
     }
}
