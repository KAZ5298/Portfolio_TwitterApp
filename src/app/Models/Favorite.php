<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    // いいねする
    public function favorite(int $user_id, int $tweet_id)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $tweet_id;
        $this->save();

        return;
    }

    // いいね解除する
    public function unfavorite(int $user_id, int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('tweet_id', $tweet_id)->delete();
    }

    // いいねされているかチェック
    public function isFavorite(int $user_id, int $tweet_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('tweet_id', $tweet_id)->first();
    }

    public $timestamps = false;

}