<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\Tweet;

class FollowerController extends Controller
{
    public function followerGet(Tweet $tweet)
    {
        $follower = new Follower;

        $follower->following_id = auth()->user()->id;
        $follower->followed_id = $tweet->user->id;

        // dd($follower);
// $follower = $request;


        $follower->save();

        return redirect()->route('tweet.index');
    }
}