<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapNftSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'restart_timer', 'user_id', 'number_of_response_left', 'total_responses',
        'error_json_chance','error_data_chance','not_found_chance','success_chance'
    ];
}
