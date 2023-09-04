<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // フォロー
    public function follow(User $follower)
    {
        $loginUser = auth()->user();

        // フォローしているかチェック
        $is_following = $loginUser->isFollowing($follower->id);

        // フォローされているかチェック
        $is_followed = $loginUser->isFollowed($follower->id);

        if (!$is_following) {
            // フォローしていなければフォローする
            $loginUser->follow($follower->id);

            // 相互フォローになった場合トークルーム作成する
            if ($is_followed) {
                $loginUser->createTalkRoom($loginUser->id, $follower->id);
            }

            return back()->with('message', 'フォローしました。');
        }
    }

    // フォロー解除
    public function unfollow(User $follower)
    {
        $loginUser = auth()->user();

        // フォローしているかチェック
        $is_following = $loginUser->isFollowing($follower->id);

        // フォローされているかチェック
        $is_followed = $loginUser->isFollowed($follower->id);

        // トークルーム内にメッセージがあるか確認
        $is_message = $loginUser->checkMessageInTalkRoom($loginUser->id, $follower->id);

        if ($is_following) {
            // フォローしていればフォロー解除する
            $loginUser->unfollow($follower->id);

            // 相手にフォローされていればトークルームを削除する
            if ($is_followed) {
                $loginUser->deleteTalkRoom($loginUser->id, $follower->id);
            }

            // トークルーム内にメッセージがあれば全てのメッセージを削除する
            if ($is_message) {
                $loginUser->deleteAllMessages($loginUser->id, $follower->id);
            }

            return back()->with('message', 'フォロー解除しました。');
        }
    }

}