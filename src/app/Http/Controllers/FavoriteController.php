<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Tweet;
use App\Models\User;

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
            return back()->with('message', 'いいねしました。');
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
            return back()->with('message', 'いいね解除しました。');
        }
    }

    public function favoriteGet()
    {
        $loginUser = auth()->user();

        $favoriteTweetId = User::find($loginUser->id)->favorites->map(function ($id) {
            return $id->tweet_id;
        });

        $favorites = Tweet::whereIn('id', $favoriteTweetId)->orderby('created_at', 'desc')->get();

        return view('favorite.index', compact('loginUser', 'favorites'));
    }
}
