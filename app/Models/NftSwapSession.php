<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftSwapSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'restart_timer', 'user_id', 'number_of_response_left', 'total_responses',
        'responsive_chance','unresponsive_chance','success_chance',"arbitrageable_nft"
    ];
}
