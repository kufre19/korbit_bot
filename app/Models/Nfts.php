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
        'name', 'image', 'meta_data', 'price', 'blockchain', 'marketplace' // Add other fields as necessary
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($nft) {
    //         // Check if the image attribute is set and not already a URL
    //         if ($nft->image) {
    //             // Construct the full URL for the image

    //             $imageUrl = url('nfts/' . $nft->image);

    //             // Update the image attribute with the full URL
    //             $nft->image = $imageUrl;
    //             $nft->save();
    //         }
    //     });
    // }

    public function store(Request $request)
    {
        $nft = new Nfts();
        // info("was here");


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $fullFilename = $filename . '.' . $extension;

            // Move the file to the public directory
            $file->move(public_path('nfts'), $fullFilename);

            // Update the database record with the URL
            $nft->image = url('nfts/' . $fullFilename);
        }

        // Handle other fields like 'name', 'meta_data', etc.
        $nft->name = $request->input('name');
        $nft->meta_data = $request->input('meta_data');
        // ... other fields

        $nft->save();

        // Redirect or return response
    }

    // public function getImageAttribute($value)
    // {
    //     $url = url('nfts/' . $value);
    //     Log::info("Generated Image URL: " . $url);
    //     return $url;
    // }
}
