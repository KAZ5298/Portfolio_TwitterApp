<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use app\Models\User;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function allTweetGet()
    {
        $loginUser = auth()->user();

        $tweets = Tweet::orderby('created_at', 'desc')->get();

        return view('tweet.index', compact('loginUser', 'tweets'));
    }

    public function myTweetGet(User $user)
    {
        $loginUser = auth()->user();

        $tweets = Tweet::where('user_id', $loginUser->id)->orderby('created_at', 'desc')->get();

        return view('tweet.index', compact('loginUser', 'tweets'));
    }
}