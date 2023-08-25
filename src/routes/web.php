<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/allTweets', function () {
    return view('tweet.index');
})->middleware(['auth', 'verified'])->name('allTweetGet');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile_check', function () {
        return view('profile.check');
    });

    Route::get('/profile_done', function () {
        return view('profile.done');
    });

    // Route::get('/loginRedirect/{user}', [RegisteredUserController::class, 'loginRedirect'])->name('loginRedirect');

    Route::post('/profile_check', [ProfileController::class, 'show'])->name('profileCheck');

    // つぶやき関連View
    Route::get('/allTweets', function () {
        return view('tweet.index');
    });

    // つぶやき一覧表示機能
    Route::get('/allTweets', [TweetController::class, 'allTweetGet'])->name('allTweetGet');
    Route::get('/myTweets', [TweetController::class, 'myTweetGet'])->name('myTweetGet');
    Route::get('/followerTweets', [TweetController::class, 'followerTweetGet'])->name('followerTweetGet');

    // つぶやき投稿機能
    Route::post('/tweetPost', [TweetController::class, 'tweetPost'])->name('tweetPost');

    // つぶやき削除機能
    Route::delete('/tweet/{tweet}/destroy', [TweetController::class, 'tweetDestroy'])->name('tweetDestroy');

    // フォロー機能
    Route::post('/tweet/{user}/follow', [UserController::class, 'follow'])->name('follow');

    // フォロー解除機能
    Route::delete('/tweet/{user}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');

    // いいね機能
    Route::post('/tweet/{tweet}/favorite', [FavoriteController::class, 'favorite'])->name('favorite');

    // いいね取消
    Route::delete('/tweet/{tweet}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('unfavorite');

    // トークルーム関連View
    Route::get('/talkRoom', function () {
        return view('room.index');
    });

    // トークルーム一覧表示
    Route::get('/talkRoom', [RoomController::class, 'talkRoomIndex'])->name('talkRoom');

    // 各トークルーム
    Route::get('/talkRoom/{room}', [RoomController::class, 'talkRoomShow'])->name('talkRoomShow');

    // トークルーム内のメッセージ投稿機能
    Route::post('/talkRoom/{room}', [MessageController::class, 'messagePost'])->name('messagePost');

    // フォロワー一覧View
    Route::get('/followerList', function () {
        return view('follow.index');
    });

    // フォロワー一覧表示
    Route::get('/followerList', [FollowerController::class, 'allFollowerGet'])->name('followerList');
});

require __DIR__ . '/auth.php';