<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();

        // フォローしているかチェック
        $is_following = $follower->isFollowing($user->id);
        // dd($user);
        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return redirect()->route('tweet.index');
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();

        // フォローしているかチェック
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            // フォローしていればフォロー解除する
            $follower->unfollow($user->id);
            return redirect()->route('tweet.index');
        }
    }
}