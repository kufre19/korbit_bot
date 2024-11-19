<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency', 'user_id', 'amount','wallet', 'status'
    ];
}
