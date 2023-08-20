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

    Route::get('/tweet', [TweetController::class, 'allTweetGet'])->name('alltweetget');
    Route::get('/tweet/{user}', [TweetController::class, 'myTweetGet'])->name('mytweetget');

    // フォロー機能
    Route::post('/tweet/{user}/follow', [UserController::class, 'follow'])->name('follow');
    Route::delete('/tweet/{user}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');

    // いいね機能
    Route::post('/tweet/{tweet}/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
    Route::delete('/tweet/{tweet}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('unfavorite');

});



require __DIR__ . '/auth.php';