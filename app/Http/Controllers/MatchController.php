<?php

namespace App\Http\Controllers;

use App\Events\MatchEvent;
use App\Services\MatchHistoryService;
use App\User;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function match()
    {   /** @var User $authUser */
        $authUser = auth()->user();
        $user = $authUser
            ->filterAffection()
            ->filterAge()
            ->FilterGender()
            ->inRandomOrder()
            ->first();


        return view('match',[
            'user'=>$user,
            'authUser'=>$authUser
        ]);
    }

    public function settings(Request $request){

        /** @var User $user */
        $user = auth()->user();

        $user->settings->update([
            'min_age'=> $request->get('minAge'),
            'max_age'=>$request->get('maxAge'),
            'gender'=>$request->get('gender')
        ]);

        return redirect()
            ->route('match')
            ->with('status', __('Settings has been updated')); //pieejams tikai uz vienu sesiju  - izmantojot
    }



    public function likeUser(User $user)
    {
        $this->affect($user, 'like');


        return redirect()->back();
    }

    public function dislikeUser(User $user)
    {
        $this->affect($user, 'dislike');
        return redirect()->back();
    }

    public function affect(User $user, string $matchType)
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        if($user->hasMatchWith($authUser)){
            event(new MatchEvent($authUser, $user));
        }


        $authUser->affections()->create([
            'affection_to'=>$user->id,
            'affection_type'=> $matchType
        ]);

    }

    public function showMatchHistory()
    {
        /** @var User $user */
        $user = auth()->user();
        $history = MatchHistoryService::showHistory($user);
        var_dump($history);die;
        return view('matchHistory',[
            'history'=>$history
        ]);
    }

}
