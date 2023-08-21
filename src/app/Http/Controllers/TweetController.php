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

    public function followerTweetGet()
    {
        $user = new User();
        $loginUser = auth()->user();

        // $followers_id = User::find($loginUser->id)->follows();

        // foreach ($followers_id->follows as $ids){
        //     dd($ids->pivot->followed_id, $ids->pivot->following_id);
        // }



        // dd(Tweet::whereIn('tweets.user_id', [2, 3]));

        // dd($followers_ids->follows->pivot->followed_id);

        $tweets = User::find($loginUser->id)->follows[0]->tweets;


        // dd(User::find($loginUser->id)->follows->toArray());

        // $tweets = Tweet::where('user_id', $follower_ids)->orderby('created_at', 'desc')->get();

        return view('tweet.index', compact('loginUser', 'tweets'));
    }

    public function tweetDestroy(Tweet $tweet)
    {
        Tweet::where('id', $tweet->id)->delete();

        return back();
    }

    public function tweetPost(Request $request)
    {
        $tweet = new Tweet();

        $tweet->user_id = auth()->user()->id;
        $tweet->content = $request->content;

        $tweet->save();

        return back();
    }
}
