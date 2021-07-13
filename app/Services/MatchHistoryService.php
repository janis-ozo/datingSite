<?php

namespace App\Services;

use App\MatchHistory;
use App\User;

Class MatchHistoryService
{
    public static function store (User $authUser, User $user){

        $authUser->matchHistory()->create([
            'matched_user_id'=> $user->id
        ]);

        $user->matchHistory()->create([
            'matched_user_id'=> $authUser->id
        ]);

    }

    public static function showHistory(User $user){

        $matchHistory = MatchHistory::all();

        return $user->matchHistoy->all();
    }

}
