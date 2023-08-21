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

        // いいねしているかチェック
        $is_favorite = $favorite->isFavorite($user->id, $tweet->id);
        if (!$is_favorite) {
            // いいねしていなければいいねする
            $favorite->favorite($user->id, $tweet->id);
            return back();
        }
    }

    public function unfavorite(Favorite $favorite, Tweet $tweet)
    {
        $user = auth()->user();

        // いいねしているかチェック
        $is_favorite = $favorite->isFavorite($user->id, $tweet->id);
        if ($is_favorite) {
            // いいねしていればいいね解除する
            $favorite->unfavorite($user->id, $tweet->id);
            return back();
        }
    }
}