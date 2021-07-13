<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $user = auth()->user();

        return view('profile',[
            'user'=>$user,

        ]);
    }

    public function update(Request $request){

        /** @var User $user */
        $user = auth()->user();

        if ($request->hasFile('picture')) {
            Storage::delete($user->profile->profile_picture);

            $user->profile->update([
                'profile_picture' => $request->file('picture')->store('profilePictures'),
                'name'=>$request->get('name'),
                'surname' => $request->get('surname'),
                'age' => $request->get('age'),
                'gender' => $request->get('gender'),
                'location' => $request->get('location'),
            ]);


        }

        $user->profile->update([
            'name'=>$request->get('name'),
            'surname' => $request->get('surname'),
            'age' => $request->get('age'),
            'gender' => $request->get('gender'),
            'location' => $request->get('location'),
        ]);


        return redirect()
            ->route('profile.edit')
            ->with('status', __('Profile has been updated')); //pieejams tikai uz vienu sesiju  - izmantojot
    }
}
