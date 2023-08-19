<?php

namespace App\Models;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // いいねされているかチェック
    public function isFavorite(int $user_id, int $tweet_id)
    {
        return (boolean) $this->favorites->where('user_id', $user_id)->where('tweet_id', $tweet_id)->first();
    }

}
