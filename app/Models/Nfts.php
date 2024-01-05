<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image', 'meta_data','price','blockchain','marketplace' // Add other fields as necessary
    ];
}
