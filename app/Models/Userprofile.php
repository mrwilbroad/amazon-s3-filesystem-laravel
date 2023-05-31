<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Userprofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_picture'
    ];

    // this help to append storage Extension to the file
    public function getProfilePictureAttribute($value)
    {
        $url = Storage::url($value);
        return $url;
      
    }
}
