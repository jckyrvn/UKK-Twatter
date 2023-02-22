<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;
use App\Models\Comment;

class WelcomeController extends Controller
{
    public function index(){
        $tweet_all = Tweet::with("user")->get();
        $comment_all = Comment::all();
        return view('welcome', [
            'tweet'=>$tweet_all,
            'comment'=>$comment_all,
        ]);
    }
}
