<?php

namespace App\Http\Controllers;

use App\Events\MatchEvent;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        /** @var User $authUser */
        $authUser = auth()->user();
        $user = User::all()->random(3);


        return view('home',[
            'user'=>$user,
        ]);
    }


}
