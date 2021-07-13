<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function settings()
    {
        return $this->hasOne(Settings::class);
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
    public function matchHistory()
    {
        return $this->hasMany(MatchHistory::class);
    }

    public function affections()
    {
        return $this->hasMany(Affection::class);
    }

    public function scopeFilterAffection($query)
    {

        $affections = $this->affections()->pluck('affection_to');

        $query->where('id', '<>', $this->id)
            ->whereNotIn('id', $affections->all());
    }

    public function scopeFilterAge($query)
    {
        $minAge = $this->settings->min_age;
        $maxAge = $this->settings->max_age;

        $query->whereHas('profile', function ($query) use ($minAge, $maxAge) {
            $query->whereBetween('age', [$minAge,$maxAge]);
        });

    }

    public function scopeFilterGender($query)
    {
        $gender = $this->settings->gender;
        if($gender){
            $query->whereHas('profile', function ($query) use ($gender) {
                $query->where('gender', $gender);
            });
        }





    }

    public function hasMatchWith(User $user):bool
    {
        $user_id =$user->id;
        return $this->affections()
            ->where('affection_type','like')
            ->where('affection_to', $user_id)
            ->exists();
    }






}
