<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademyOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'user_id', 'amount', 'status'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
