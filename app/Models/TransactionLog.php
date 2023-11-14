<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'from_asset', 'to_asset', 'amount', 'received_amount'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
