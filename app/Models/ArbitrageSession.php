<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArbitrageSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'restart_timer', 'user_id', 'number_of_response_left', 'total_responses'
    ];
}
