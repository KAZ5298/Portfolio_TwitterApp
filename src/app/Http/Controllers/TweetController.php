<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TweetRequest;

class TweetController extends Controller
{
    public function allTweetGet()
    {
        $loginUser = auth()->user();

        $tweets = Tweet::orderby('created_at', 'desc')->get();

        return view('tweet.all_index', compact('loginUser', 'tweets'));
    }

    public function myTweetGet()
    {
        $loginUser = auth()->user();

        $tweets = Tweet::where('user_id', $loginUser->id)->orderby('created_at', 'desc')->get();

        return view('tweet.owner_index', compact('loginUser', 'tweets'));
    }

    public function followTweetGet()
    {
        $loginUser = auth()->user();

        $followerId = User::find($loginUser->id)->follows->map(function ($id) {
            return $id->id;
        });

        $tweets = Tweet::whereIn('user_id', $followerId)->orderby('created_at', 'desc')->get();

        return view('tweet.follow_index', compact('loginUser', 'tweets'));
    }

    public function tweetDestroy(Tweet $tweet)
    {
        Tweet::where('id', $tweet->id)->delete();

        return back()->with('message', 'つぶやきを削除しました。');
    }

    public function tweetPost(TweetRequest $request)
    {
        $tweet = new Tweet();

        $tweet->user_id = auth()->user()->id;
        $tweet->content = $request->content;

        $tweet->save();

        return back()->with('message', 'つぶやきを投稿しました。');
    }
}
