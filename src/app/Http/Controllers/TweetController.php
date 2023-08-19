<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Follower;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function allTweetGet()
    {
        $loginUser = auth()->user();

        $tweets = Tweet::orderby('created_at', 'desc')->get();

        $followers = Follower::where('following_id', $loginUser->id)->get();

        // dd($followers);

        return view('tweet.index', compact('loginUser', 'tweets', 'followers'));
    }
}