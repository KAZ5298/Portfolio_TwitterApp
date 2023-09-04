<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Tweet;
use App\Models\Favorite;
use App\Models\Room;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nickname',
        'icon',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    // フォローする
    public function follow(int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているかチェック
    public function isFollowing(int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているかチェック
    public function isFollowed(int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    // トークルーム作成
    public function createTalkRoom(int $loginUser, int $follower)
    {
        if ($loginUser < $follower) {
            $roomId = 'room:' . $loginUser . '.' . $follower;
        } else {
            $roomId = 'room:' . $follower . '.' . $loginUser;
        }

        $rooms = [
            ["id" => $roomId, "user_id" => $loginUser],
            ["id" => $roomId, "user_id" => $follower]
        ];

        Room::insert($rooms);
    }

    // トークルーム削除
    public function deleteTalkRoom(int $loginUser, int $follower)
    {
        if ($loginUser < $follower) {
            $roomId = 'room:' . $loginUser . '.' . $follower;
        } else {
            $roomId = 'room:' . $follower . '.' . $loginUser;
        }

        $this->rooms()->find($roomId)->delete();
    }

    // トークルーム内にメッセージがあるか確認
    public function checkMessageInTalkRoom(int $loginUser, int $follower)
    {
        if ($loginUser < $follower) {
            $roomId = 'room:' . $loginUser . '.' . $follower;
        } else {
            $roomId = 'room:' . $follower . '.' . $loginUser;
        }

        return (boolean) $this->messages()->where('room_id', $roomId)->first(['room_id']);
    }

    // トークルームの全メッセージ削除
    public function deleteAllMessages(int $loginUser, int $follower)
    {
        if ($loginUser < $follower) {
            $roomId = 'room:' . $loginUser . '.' . $follower;
        } else {
            $roomId = 'room:' . $follower . '.' . $loginUser;
        }

        $this->messages()->where('room_id', $roomId)->delete();
    }
}