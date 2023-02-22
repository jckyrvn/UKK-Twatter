<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [UserController::class, "index"])->name('auth.login');

Route::post('/login',[UserController::class, "login"])->name('login');

Route::post('/logout', [UserController::class, "logout"])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register',[UserController::class, "register"])->name('register');

Route::get('/', [WelcomeController::class, "index"])->middleware('auth')->name('welcome');


Route::get('/tweet', function() {
    return view('main.tweet');
})->name('main.tweet');


Route::post('/tweet', [TweetController::class, "create"])->name('tweet');

Route::get('/update', function(Request $request) {
    $findtweet = Tweet::where("id", $request->id_update)->first();
    return view('main.update', [
        "id"=>$request->id_update,
        "tweet"=>$findtweet,
    ]);
})->name('main.update');

Route::post('/update', [TweetController::class, "update"])->name('updateTweet');

Route::post('/delete', [TweetController::class, "delete"])->name("deleteTweet");

Route::get('/comment/{id}', function($id){
    $tweet_detail_all = Tweet::with(['comment.user', 'user'])->where('id', $id)->first();
    // $comment_all = Comment::where('tweet_id', $id)->get();

    return view('main.comment', [
        'id' => $id,
        'tweet_detail_all'=> $tweet_detail_all,
    ]);
})->name('main.comment');
Route::post('/comment/{id}', [TweetController::class, "comment"])->name('comment');
Route::post('/comment/{id}', [TweetController::class, "updateComment"])->name('updateComment');

Route::post('/tweet/search', [TweetController::class, 'search'])->name('tweet/search');

Route::get('/profile/{id}', function($id){
    $tweet_detail_all = User::with(['tweet'])->where('id', $id)->first();
    return view('main.profile' , [
        'id' => $id,
        'tweet_detail_all'=> $tweet_detail_all,
    ]);
})->name('profileView');


Route::get('/editProfile', function(){
    return view('main.editProfile');
})->name('main.editProfile');

Route::post('/profileUpdate', [UserController::class, 'profileUpdate'])->name('profileUpdate');

