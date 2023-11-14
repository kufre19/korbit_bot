<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'user_id', 'from_asset', 'to_asset', 'amount', 'status'
    ];
}
