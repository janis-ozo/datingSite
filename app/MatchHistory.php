<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchHistory extends Model
{
    protected $fillable = ['user_id','matched_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
