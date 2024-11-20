<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapProfitControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'maximun',
        'minimum',
        'divide_by',
    ];
    
}
