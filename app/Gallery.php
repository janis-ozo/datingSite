<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['pictures_location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
