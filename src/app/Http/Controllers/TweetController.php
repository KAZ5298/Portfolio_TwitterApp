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
        $loginUser = $user;

        $tweets = Tweet::where('user_id', $loginUser->id)->orderby('created_at', 'desc')->get();

        return view('tweet.index', compact('loginUser', 'tweets'));
    }

    public function followerTweetGet(User $user)
    {
        $user1 = new User();
        $loginUser = $user;

        // dd($loginUser);

        $follower_id = $user1->follows()->where('followed_id', $loginUser->id)->first(['id']);

        $tweets = Tweet::where('user_id', $follower_id)->orderby('created_at', 'desc')->get();

        return view('tweet.index', compact('loginUser', 'tweets'));
    }

    public function tweetDestroy(Tweet $tweet)
    {
        Tweet::where('id', $tweet->id)->delete();

        return redirect()->route('tweet.index');
    }

    public function tweetPost(Request $request)
    {
        $tweet = new Tweet();

        $tweet->user_id = auth()->user()->id;
        $tweet->content = $request->content;

        $tweet->save();

        return redirect()->route('tweet.index');
    }
}