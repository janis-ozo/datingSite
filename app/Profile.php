<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = ['name','surname','age', 'gender', 'location','profile_picture'];

    public function getPicture()
    {
        if($this->profile_picture == null)
        {
            return  env('APP_URL') . '/pictures/default.png';
        }
        elseif (substr( $this->profile_picture, 0, 4 ) === "http")
        {
            return $this->profile_picture;
        }
        return Storage::url($this->profile_picture);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

