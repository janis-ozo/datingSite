<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['min_age','max_age','gender'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMinAge()
    {
        return $this->min_age;
    }

    public function getMaxAge()
    {
        return $this->max_age;
    }

    public function getGender()
    {
        return $this->gender;
    }


}
