<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserProfileController@show')->name('profile.edit');
Route::put('/profile','UserProfileController@update')->name('profile.update');
Route::get('/match', 'MatchController@match')->name('match');
Route::get('/match/history', 'MatchController@showMatchHistory')->name('match.history');
Route::put('/match', 'MatchController@settings')->name('match.settings');
Route::post('/match/{user}/like', 'MatchController@likeUser')->name('match.like');
Route::post('/match/{user}/dislike', 'MatchController@dislikeUser')->name('match.dislike');



Route::get('/test', function (){
    /** @var \App\User $users */
    $users =  User::all();
    $usersPictures = [];
    foreach ($users as $user)
    {
        $usersPictures[]= $user->profile->getPicture();
    }
    return $usersPictures;



});

Route::get('/random', function (){

    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://randomuser.me/api/');
    $response = $request->getBody();

    return $response;
});
