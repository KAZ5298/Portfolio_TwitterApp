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

        // フォローされているかチェック
        $is_followed = $follower->isFollowed($user->id);

        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);

            // 相互フォローになった場合トークルーム作成する
            if ($is_followed) {
                $follower->createTalkRoom($follower->id, $user->id);
            }

            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();

        // フォローしているかチェック
        $is_following = $follower->isFollowing($user->id);

        // フォローされているかチェック
        $is_followed = $follower->isFollowed($user->id);

        if ($is_following) {
            // フォローしていればフォロー解除する
            $follower->unfollow($user->id);

            // 相手にフォローされていればトークルームを削除する
            if ($is_followed) {
                $follower->deleteTalkRoom($follower->id, $user->id);
            }

            return back();
        }
    }
}
