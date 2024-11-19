<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Nfts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image', 'meta_data', 'price', 'blockchain', 'marketplace','description'
    ];


}
