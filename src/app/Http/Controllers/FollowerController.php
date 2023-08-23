<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\User;

class FollowerController extends Controller
{
        // フォロワー一覧表示
        public function allFollowerGet()
        {
            $loginUser = auth()->user();
    
            $followerId = User::find($loginUser->id)->follows->map(function ($id){
                return $id->id;
            });
    
            $followers = User::whereIn('id', $followerId)->get();
    

            // $followers = Follower::where('following_id', $loginUser->id)->get();

            // dd($followers);
    
            return view('follow.index', compact('loginUser', 'followers'));
        }
    
}
