<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Tweet;

class FavoriteController extends Controller
{
    public function favorite(Favorite $favorite, Tweet $tweet)
    {
        $user = auth()->user();
        $tweet_id = $tweet->id;

        // dd($favorite, $user, $tweet_id, $tweet);

        // いいねしているかチェック
        $is_favorite = $favorite->isFavorite($user->id, $tweet_id);
        if (!$is_favorite) {
            // いいねしていなければいいねする
            $favorite->favorite($user->id, $tweet_id);
            return redirect()->route('tweet.index');
        }
    }

    public function unfavorite(Favorite $favorite, Tweet $tweet)
    {
        $user_id = $tweet->user_id;
        $tweet_id = $tweet->id;
        $favorite_id = $tweet->favorite->id;

        // いいねしているかチェック
        $is_favorite = $favorite->isFavorite($user_id, $tweet_id);
        if ($is_favorite) {
            // いいねしていればいいね解除する
            $favorite->unfavorite($favorite_id);
            return redirect()->route('tweet.index');
        }
    }
}