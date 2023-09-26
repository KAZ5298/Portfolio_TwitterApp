<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // フォロー
    public function follow(User $follow)
    {
        $loginUser = auth()->user();

        // フォローしているかチェック
        $is_following = $loginUser->isFollowing($follow->id);

        // フォローされているかチェック
        $is_followed = $loginUser->isFollowed($follow->id);

        if (!$is_following) {
            // フォローしていなければフォローする
            $loginUser->follow($follow->id);

            // 相互フォローになった場合トークルーム作成する
            if ($is_followed) {
                $loginUser->createTalkRoom($loginUser->id, $follow->id);
            }

            return back()->with('message', 'フォローしました。');
        }
    }

    // フォロー解除
    public function unfollow(User $follow)
    {
        $loginUser = auth()->user();

        // フォローしているかチェック
        $is_following = $loginUser->isFollowing($follow->id);

        // フォローされているかチェック
        $is_followed = $loginUser->isFollowed($follow->id);

        // トークルーム内にメッセージがあるか確認
        $is_message = $loginUser->checkMessageInTalkRoom($loginUser->id, $follow->id);

        if ($is_following) {
            // フォローしていればフォロー解除する
            $loginUser->unfollow($follow->id);

            // 相手にフォローされていればトークルームを削除する
            if ($is_followed) {
                $loginUser->deleteTalkRoom($loginUser->id, $follow->id);
            }

            // トークルーム内にメッセージがあれば全てのメッセージを削除する
            if ($is_message) {
                $loginUser->deleteAllMessages($loginUser->id, $follow->id);
            }

            return back()->with('message', 'フォロー解除しました。');
        }
    }
}
