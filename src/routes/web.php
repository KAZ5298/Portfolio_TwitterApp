<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tweet', function () {
        return view('tweet.index');
    });

    // つぶやき一覧表示機能
    Route::get('/tweet', [TweetController::class, 'allTweetGet'])->name('tweet.index');
    Route::get('/tweet/{user}', [TweetController::class, 'myTweetGet'])->name('myTweetGet');
    Route::get('/tweet/{followed_id}', [TweetController::class, 'followerTweetGet'])->name('followerTweetGet');

    // つぶやき投稿機能

    // つぶやき削除機能
    Route::delete('tweet/{tweet}/destroy', [TweetController::class, 'tweetDestroy'])->name('tweetdestroy');

    // フォロー機能
    Route::post('/tweet/{user}/follow', [UserController::class, 'follow'])->name('follow');
    Route::delete('/tweet/{user}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');

    // いいね機能
    Route::post('/tweet/{tweet}/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
    Route::delete('/tweet/{tweet}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('unfavorite');

});



require __DIR__ . '/auth.php';